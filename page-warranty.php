<?php
/* Template Name: Warranty Claim */
global $custom_css; $custom_css = 'faq'; 
get_header();

global $wpdb;
$search_result = null;
$error_msg = '';
$success_msg = '';
$searched_id = '';

// HANDLE SUBMIT KLAIM
if (isset($_POST['action']) && $_POST['action'] === 'submit_claim') {
    $claim_barcode = sanitize_text_field($_POST['barcode_id_claim']);
    $jenis = sanitize_text_field($_POST['jenis_pengajuan']);
    $deskripsi = sanitize_textarea_field($_POST['deskripsi']);
    $whatsapp = sanitize_text_field($_POST['whatsapp']);
    $alamat = sanitize_textarea_field($_POST['alamat']);
    
    // Upload File Multiple
    $uploaded_urls = [];
    if (!empty($_FILES['bukti_file']['name'][0])) {
        $file_count = count($_FILES['bukti_file']['name']);
        if ($file_count < 3) {
            $error_msg = "Pengajuan Gagal: Harap lampirkan minimal 3 file foto/video.";
        } elseif ($file_count > 5) {
            $error_msg = "Pengajuan Gagal: Maksimal 5 file foto/video yang diperbolehkan.";
        } else {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            for ($i = 0; $i < $file_count; $i++) {
                if ($_FILES['bukti_file']['name'][$i]) {
                    $uploadedfile = array(
                        'name'     => $_FILES['bukti_file']['name'][$i],
                        'type'     => $_FILES['bukti_file']['type'][$i],
                        'tmp_name' => $_FILES['bukti_file']['tmp_name'][$i],
                        'error'    => $_FILES['bukti_file']['error'][$i],
                        'size'     => $_FILES['bukti_file']['size'][$i]
                    );
                    $upload_overrides = array( 'test_form' => false );
                    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
                    if ( $movefile && ! isset( $movefile['error'] ) ) {
                        $uploaded_urls[] = $movefile['url'];
                    }
                }
            }
            
            $uploaded_url = !empty($uploaded_urls) ? implode("
Link File: ", $uploaded_urls) : '- Tidak ada file -';
            
            // Map category text to integer
            $category_map = [
                'Klaim Garansi' => 1,
                'Servis Berbayar' => 2,
                'Konsultasi Kendala' => 3,
                'Minta Sparepart' => 4,
                'Other' => 5
            ];
            $category_id = isset($category_map[$jenis]) ? $category_map[$jenis] : 5;
            
            // Setup proof files (fill missing with empty string to avoid errors)
            $proof_1 = isset($uploaded_urls[0]) ? $uploaded_urls[0] : '';
            $proof_2 = isset($uploaded_urls[1]) ? $uploaded_urls[1] : '';
            $proof_3 = isset($uploaded_urls[2]) ? $uploaded_urls[2] : '';
            $proof_4 = isset($uploaded_urls[3]) ? $uploaded_urls[3] : '';
            $proof_5 = isset($uploaded_urls[4]) ? $uploaded_urls[4] : '';
            
            // Insert to wp_request
            $wpdb->insert(
                'wp_request',
                array(
                    'barcodeid' => $claim_barcode,
                    
                    'category' => $category_id,
                    'phone' => $whatsapp,
                    'lokasi' => $alamat,
                    'deskripsi' => $deskripsi,
                    'proof_1' => $proof_1,
                    'proof_2' => $proof_2,
                    'proof_3' => $proof_3,
                    'proof_4' => $proof_4,
                    'proof_5' => $proof_5,
                    'created_at' => current_time('mysql')
                )
            );
            
            // Update status
            $wpdb->update('wp_barcode', array('status' => 2), array('BarcodeID' => $claim_barcode));
            
            // Kirim email
            $admin_email = 'griyadjayaupvc@gmail.com';
            $subject = "Pengajuan Kendala Baru - Barcode: " . $claim_barcode;
            $message = "Terdapat pengajuan kendala baru!\n\n";
            $message .= "Barcode ID: " . $claim_barcode . "\n";
            $message .= "Jenis Pengajuan: " . $jenis . "\n";
            $message .= "WhatsApp: " . $whatsapp . "\n";
            $message .= "Alamat/Titik Jemput: " . $alamat . "\n";
            $message .= "Deskripsi Kendala: " . $deskripsi . "\n";
            $message .= "Link File Bukti: \nLink File: " . $uploaded_url . "\n";
            
            wp_mail($admin_email, $subject, $message);
            
            $wa_data = $wpdb->get_row($wpdb->prepare("SELECT customer, material_description FROM wp_barcode WHERE BarcodeID = %s", $claim_barcode));
            if ($wa_data) {
                $wa_msg = "Halo Bapak/Ibu *{$wa_data->customer}*,

Terima kasih telah menghubungi Griya Djaya Sentosa.
Pengajuan *$jenis* untuk material *{$wa_data->material_description}* (ID: *$claim_barcode*) telah berhasil masuk ke sistem kami.

Tim kami akan segera meninjau laporan Anda. Mohon kesediaannya menunggu informasi atau jadwal survei lebih lanjut.

Salam hangat,
Tim Griya Djaya Sentosa";
                gjs_send_whatsapp($whatsapp, $wa_msg);
            }
            
            // --- NOTIFIKASI KANTOR (OFFICE) ---
            $office_wa = '08111021088';
            $office_wa_msg = "Terdapat pengajuan kendala baru!

";
            $office_wa_msg .= "*Barcode ID:* " . $claim_barcode . "
";
            $office_wa_msg .= "*Jenis:* " . $jenis . "
";
            $office_wa_msg .= "*Nama/WA:* " . ($wa_data ? $wa_data->customer : 'N/A') . " / " . $whatsapp . "
";
            $office_wa_msg .= "*Alamat:* " . $alamat . "
";
            $office_wa_msg .= "*Deskripsi:* " . $deskripsi . "
";
            $office_wa_msg .= "*Bukti:* " . $uploaded_url . "

";
            $office_wa_msg .= "Silakan cek Dashboard untuk info lebih lanjut.";
            
            gjs_send_whatsapp($office_wa, $office_wa_msg);

            
            $success_msg = "Pengajuan Anda telah berhasil dikirim!";
            
            // Re-fetch data so it stays on screen
            $searched_id = $claim_barcode;
        }
    } else {
        $error_msg = "Pengajuan Gagal: Harap lampirkan foto bukti kerusakan.";
        $searched_id = $claim_barcode;
    }
}

// HANDLE SEARCH BARCODE (or re-fetch after error/success)
// Allow auto-search via URL parameter (e.g., ?id=MONAOC26080001)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $searched_id = sanitize_text_field($_GET['id']);
}

if ((isset($_POST['action']) && $_POST['action'] === 'search_barcode') || !empty($searched_id)) {
    if (empty($searched_id)) {
        $searched_id = sanitize_text_field($_POST['barcode_id']);
    }
    
    if (!empty($searched_id)) {
        $query = $wpdb->prepare("
            SELECT 
                b.BarcodeID,
                b.material_description,
                b.date_transaction,
                b.warranty_exp,
                b.location,
                b.status,
                b.customer AS customer_nama
            FROM wp_barcode b
            WHERE b.BarcodeID = %s
        ", $searched_id);
        
        $search_result = $wpdb->get_row($query);
        
        if ($search_result) {
            $claim_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM wp_request WHERE barcodeid = %s", $search_result->BarcodeID));
        }
        
        if (!$search_result && !isset($_POST['barcode_id_claim'])) {
            $error_msg = "Maaf, Barcode ID tidak ditemukan.";
        }
    }
}
?>

<?php echo '<style>.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }
.bp-preview-container { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 15px; }
.bp-preview-item { position: relative; width: 80px; height: 80px; border-radius: 8px; overflow: hidden; border: 1px solid #ddd; background: #f9f9f9; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
.bp-preview-img { width: 100%; height: 100%; object-fit: cover; }
.bp-preview-file { font-size: 10px; text-align: center; padding: 5px; word-break: break-all; color: #555; font-weight: 600; line-height: 1.2; }
.bp-remove-btn { position: absolute; top: 5px; right: 5px; background: rgba(220, 53, 69, 0.9); color: white; border: none; border-radius: 50%; width: 20px; height: 20px; font-size: 14px; cursor: pointer; display: flex; align-items: center; justify-content: center; line-height: 1; padding: 0; transition: background 0.2s; z-index: 10; }
.bp-remove-btn:hover { background: #c82333; }

.warranty-responsive-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
}
@media (max-width: 768px) {
    .warranty-responsive-grid {
        grid-template-columns: 1fr !important;
    }
}
</style>'; ?>

<div class="container" style="background-color: #fafbfc; min-height: 100vh; padding: 140px 20px 80px; font-family: 'Outfit', sans-serif; width: 100%; max-width: 100%; overflow: hidden;">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; gap: 60px; align-items: center;">
        
        <!-- Kiri: Judul -->
        <div style="flex: 1; min-width: 280px;">
            <h1 style="color: #0f172a; font-weight: 800; font-size: 54px; margin-bottom: 20px; line-height: 1.1;">Pusat Klaim Garansi</h1>
            <p style="color: #334155; font-size: 18px; line-height: 1.6; max-width: 450px;">
                Produk Anda butuh perhatian? Masukkan Barcode ID transaksi Anda di bawah ini, lalu kami bantu dari sini.
            </p>
        </div>
        
        <!-- Kanan: Card Form -->
        <div style="flex: 1.2; min-width: 280px; background: #ffffff; border-radius: 20px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.05); position: relative; overflow: hidden; border: 1px solid #f1f5f9;">
            <!-- Top Green Border -->
            <div style="height: 10px; background-color: #10b981; width: 100%;"></div>
            
            <div style="padding: clamp(20px, 5vw, 40px);">
                
                <?php if ($success_msg): ?>
                    <div style="margin-bottom: 25px; padding: 15px; background-color: #d1fae5; border-radius: 10px; color: #065f46; text-align: center; font-weight: 600;">
                        <?php echo $success_msg; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_msg): ?>
                    <div style="margin-bottom: 25px; padding: 15px; background-color: #fee2e2; border-radius: 10px; color: #b91c1c; text-align: center; font-weight: 600;">
                        <?php echo $error_msg; ?>
                    </div>
                <?php endif; ?>

                <!-- Form Search -->
                <form method="POST" action="">
                    <input type="hidden" name="action" value="search_barcode">
                    <label style="font-weight: 700; color: #0f172a; font-size: 15px; display: block; margin-bottom: 10px;">Masukkan Barcode ID Anda</label>
                    <div style="display: flex; gap: 15px; margin-bottom: 5px; flex-wrap: wrap;">
                        <input type="text" name="barcode_id" value="<?php echo esc_attr($searched_id); ?>" placeholder="Masukkan Barcode ID Anda" style="flex: 1 1 200px; padding: 14px 20px; border: 1px solid #94a3b8; border-radius: 50px; font-size: 14px; outline: none; transition: border 0.3s;" onfocus="this.style.borderColor='#10b981'" onblur="this.style.borderColor='#94a3b8'" required>
                        <button type="submit" style="background-color: #0f172a; color: white; border: none; padding: 14px 30px; border-radius: 50px; font-weight: 600; font-size: 13px; cursor: pointer; letter-spacing: 0.5px; flex: 1 1 150px; white-space: nowrap;">CARI TRANSAKSI</button>
                    </div>
                </form>

                <?php if ($search_result): ?>
                
                <hr style="border: none; border-top: 1px dashed #e2e8f0; margin: 30px 0;">
                
                <!-- Detail Transaksi -->
                <h4 style="font-weight: 700; color: #0f172a; font-size: 16px; margin-bottom: 20px;">Detail Transaksi Ditemukan</h4>
                
                <div class="warranty-responsive-grid" style="gap: 20px;">
                    <!-- Barcode ID -->
                    <div style="display: flex; gap: 15px;">
                        <div style="color: #64748b; padding-top: 2px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 5v14M8 5v14M12 5v14M17 5v14M21 5v14"/></svg>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 2px;">Barcode ID</div>
                            <div style="font-size: 14px; font-weight: 600; color: #0f172a;"><?php echo esc_html($search_result->BarcodeID); ?></div>
                        </div>
                    </div>
                    
                    <!-- Tanggal Beli -->
                    <div style="display: flex; gap: 15px;">
                        <div style="color: #64748b; padding-top: 2px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 2px;">Tanggal Beli</div>
                            <div style="font-size: 14px; font-weight: 600; color: #0f172a;"><?php echo date('d F Y', strtotime($search_result->date_transaction)); ?></div>
                        </div>
                    </div>
                    
                    <!-- Nama Customer -->
                    <div style="display: flex; gap: 15px;">
                        <div style="color: #64748b; padding-top: 2px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 2px;">Nama Customer</div>
                            <div style="font-size: 14px; font-weight: 600; color: #0f172a;"><?php echo esc_html($search_result->customer_nama); ?></div>
                        </div>
                    </div>
                    
                    <!-- Garansi Expired -->
                    <div style="display: flex; gap: 15px;">
                        <div style="color: #64748b; padding-top: 2px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 2px;">Garansi Expired</div>
                            <div style="font-size: 14px; font-weight: 600; color: #0f172a;">
                                <?php 
                                    $exp_date = strtotime($search_result->warranty_exp);
                                    $now = strtotime('today');
                                    $exp_date_only = strtotime(date('Y-m-d', $exp_date));
                                    $diff_days = ($exp_date_only - $now) / (60 * 60 * 24);
                                    $is_expired = ($diff_days < 0);
                                    
                                    echo date('d F Y', $exp_date);
                                    if ($diff_days < 0) {
                                        echo ' <span style="color: #ef4444;">(Expired)</span>';
                                    } elseif ($diff_days <= 7) {
                                        echo ' <span style="color: #d97706;">(Akan Berakhir)</span>';
                                    } else {
                                        echo ' <span style="color: #10b981;">(Aktif)</span>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Material -->
                    <div style="display: flex; gap: 15px;">
                        <div style="color: #64748b; padding-top: 2px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 2px;">Material</div>
                            <div style="font-size: 14px; font-weight: 600; color: #0f172a;"><?php echo esc_html($search_result->material_description); ?></div>
                        </div>
                    </div>
                    
                    <!-- Lokasi -->
                    <div style="display: flex; gap: 15px;">
                        <div style="color: #64748b; padding-top: 2px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 2px;">Lokasi</div>
                            <div style="font-size: 14px; font-weight: 600; color: #0f172a;"><?php echo esc_html($search_result->location); ?></div>
                        </div>
                    </div>
                    
                    
                    
                    <!-- Status -->
                    <div style="display: flex; gap: 15px;">
                        <div style="color: #64748b; padding-top: 2px;">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                        </div>
                        <div>
                            <div style="font-size: 12px; color: #64748b; margin-bottom: 2px;">Status Saat Ini</div>
                            <div style="font-size: 14px; font-weight: 600; color: #0f172a;">
                                <?php 
                                    if ($search_result->status == 1) echo 'Belum ada pengajuan';
                                    elseif ($search_result->status == 2) echo 'Dalam permintaan';
                                    elseif ($search_result->status == 3) echo 'Sedang dikerjakan';
                                    elseif ($search_result->status == 4) echo 'Penolakan';
                                    elseif ($search_result->status == 5) echo 'Sudah selesai';
                                    
                                    if (!empty($claim_count) && $claim_count > 0) {
                                        echo ' <span style="font-size:12px; font-weight:700; color:#b45309;">(Pengajuan Ke-' . $claim_count . ')</span>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr style="border: none; border-top: 1px dashed #e2e8f0; margin: 30px 0;">
                
                <?php 
                if ($search_result->status == 2 || $search_result->status == 3): 
                    $status_alert = ($search_result->status == 2) 
                        ? "Pengajuan Anda sudah masuk dalam daftar permintaan dan sedang menunggu antrean." 
                        : "Pengajuan Anda saat ini sedang dalam proses pengerjaan oleh tim kami.";
                ?>
                    <div style="margin-top: 25px; padding: 20px; background-color: #fffbeb; border: 1px solid #fef3c7; border-radius: 10px; color: #92400e; text-align: center;">
                        <svg viewBox="0 0 24 24" width="30" height="30" stroke="currentColor" stroke-width="2" fill="none" style="margin-bottom: 10px;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <h5 style="font-weight: 700; margin-bottom: 5px; font-size: 16px;">Pengajuan Sedang Diproses</h5>
                        <p style="font-size: 14px; margin: 0; font-weight: 500;"><?php echo $status_alert; ?></p>
                    </div>
                <?php elseif (!$is_expired): ?>
                
                <!-- Form Pengajuan -->
                <h4 style="font-weight: 700; color: #0f172a; font-size: 16px; margin-bottom: 20px;">Form Pengajuan Kendala</h4>
                <form method="POST" action="" enctype="multipart/form-data" id="claimForm">
                    <input type="hidden" name="action" value="submit_claim">
                    <input type="hidden" name="barcode_id_claim" value="<?php echo esc_attr($search_result->BarcodeID); ?>">
                    
                    <div class="warranty-responsive-grid" style="gap: 15px; margin-bottom: 15px;">
                        <select name="jenis_pengajuan" style="padding: 12px 20px; border: 1px solid #cbd5e1; border-radius: 50px; font-size: 13px; color: #475569; appearance: none; background: url('data:image/svg+xml;utf8,<svg fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' viewBox=\'0 0 24 24\' xmlns=\'http://www.w3.org/2000/svg\'><path d=\'M6 9l6 6 6-6\'></path></svg>') no-repeat right 15px center/15px; outline:none;" required>
                            <option value="">Jenis Pengajuan</option>
                            <option value="Klaim Garansi">Klaim Garansi</option>
                            <option value="Servis Berbayar">Servis Berbayar</option>
                            <option value="Konsultasi Kendala">Konsultasi Kendala</option>
                            <option value="Minta Sparepart">Minta Sparepart</option>
                            <option value="Other">Lainnya</option>
                        </select>
                        
                        <input type="text" name="whatsapp" placeholder="Nomor WhatsApp Aktif / Alternatif" style="padding: 12px 20px; border: 1px solid #cbd5e1; border-radius: 50px; font-size: 13px; color: #475569; outline:none;" required>
                        
                        <input type="text" name="alamat" placeholder="Alamat Lengkap / Titik Jemput" style="padding: 12px 20px; border: 1px solid #cbd5e1; border-radius: 50px; font-size: 13px; color: #475569; outline:none;" required>
                        
                        <input type="text" name="deskripsi" placeholder="Deskripsi Kendala" style="padding: 12px 20px; border: 1px solid #cbd5e1; border-radius: 50px; font-size: 13px; color: #475569; outline:none;" required>
                    </div>
                    
                    <!-- Upload Box -->
                    <div style="margin-bottom: 25px;">
                        <div style="position: relative; border: 1px dashed #cbd5e1; background-color: #f8fafc; border-radius: 12px; padding: 30px; text-align: center; cursor: pointer; transition: all 0.3s;" onclick="document.getElementById('file-upload').click()" ondragover="event.preventDefault(); this.style.borderColor='#10b981'; this.style.backgroundColor='#ecfdf5';" ondragleave="this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc';" ondrop="event.preventDefault(); this.style.borderColor='#cbd5e1'; this.style.backgroundColor='#f8fafc'; handleDroppedFiles(event)">
                            <div style="color: #64748b; margin-bottom: 10px; display: flex; justify-content: center; align-items: center; gap: 8px;">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                                <span style="font-size: 16px;">+</span>
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                            </div>
                            <div style="font-size: 13px; color: #0f172a; font-weight: 500;">
                                Seret file ke sini atau <span style="font-weight: 700; color: #10b981;">Pilih File</span> (Minimal 3, Maksimal 5 File)
                            </div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 5px;">
                                Bisa pilih sekaligus, atau pilih satu per satu.
                            </div>
                            
                            <input type="file" id="file-upload" multiple accept="image/*,video/*" style="display: none;" onchange="handleSelectedFiles(this)">
                        </div>
                        
                        <!-- Real hidden input that gets submitted -->
                        <input type="file" name="bukti_file[]" id="real-file-upload" multiple style="display: none;">
                        
                        <div id="file-list-container" style="margin-top: 15px; display: none;">
                            <div style="font-size: 12px; font-weight: 600; color: #334155; margin-bottom: 8px;">File Terpilih:</div>
                            <div id="file-list" class="bp-preview-container"></div>
                            <div id="file-count-text" style="font-size: 12px; color: #ef4444; margin-top: 10px; font-weight: 600;">Kurang 3 file lagi</div>
                        </div>
                    </div>
                    
                    <button type="submit" style="width: 100%; background-color: #10b981; color: white; border: none; padding: 15px; border-radius: 50px; font-weight: 600; font-size: 15px; cursor: pointer; transition: background 0.3s;" onmouseover="this.style.backgroundColor='#059669'" onmouseout="this.style.backgroundColor='#10b981'">Kirim Pengajuan Sekarang</button>
                    
                    <div style="text-align: center; margin-top: 10px; font-size: 11px; color: #94a3b8;">
                        Catatan: unggah minimal 3 dan maksimal 5 foto/video agar teknisi kami dapat menilai kendala Anda dengan tepat.
                    </div>
                </form>
                
                <script>
                // We use DataTransfer to accumulate files selected one by one
                const dataTransfer = new DataTransfer();
                
                function handleDroppedFiles(event) {
                    const files = event.dataTransfer.files;
                    addFiles(files);
                }
                
                function handleSelectedFiles(input) {
                    const files = input.files;
                    addFiles(files);
                    // Reset input so the same file can be selected again if needed
                    input.value = ''; 
                }
                
                function addFiles(files) {
                    let currentCount = dataTransfer.files.length;
                    let filesToAdd = files.length;
                    
                    if (currentCount + filesToAdd > 5) {
                        alert('Maksimal hanya boleh mengunggah 5 file!');
                        // Only add up to the limit of 5
                        let allowed = 5 - currentCount;
                        for (let i = 0; i < allowed; i++) {
                            dataTransfer.items.add(files[i]);
                        }
                    } else {
                        for (let i = 0; i < filesToAdd; i++) {
                            dataTransfer.items.add(files[i]);
                        }
                    }
                    updateUI();
                }
                
                function removeFile(index) {
                    dataTransfer.items.remove(index);
                    updateUI();
                }
                
                function updateUI() {
                    const realInput = document.getElementById('real-file-upload');
                    realInput.files = dataTransfer.files;
                    
                    const container = document.getElementById('file-list-container');
                    const list = document.getElementById('file-list');
                    const text = document.getElementById('file-count-text');
                    
                    if (dataTransfer.files.length > 0) {
                        container.style.display = 'block';
                        list.innerHTML = '';
                        
                        Array.from(dataTransfer.files).forEach((file, index) => {
                            const item = document.createElement('div');
                            item.className = 'bp-preview-item';
                            
                            const removeBtn = document.createElement('button');
                            removeBtn.className = 'bp-remove-btn';
                            removeBtn.innerHTML = '&times;';
                            removeBtn.type = 'button';
                            removeBtn.onclick = function(e) {
                                e.preventDefault();
                                e.stopPropagation();
                                removeFile(index);
                            };
                            
                            if (file.type.startsWith('image/')) {
                                const img = document.createElement('img');
                                img.className = 'bp-preview-img';
                                const reader = new FileReader();
                                reader.onload = function(e) { img.src = e.target.result; }
                                reader.readAsDataURL(file);
                                item.appendChild(img);
                            } else {
                                const fileDiv = document.createElement('div');
                                fileDiv.className = 'bp-preview-file';
                                const displayName = file.name.length > 15 ? file.name.substring(0,12) + '...' : file.name;
                                fileDiv.innerText = displayName;
                                item.appendChild(fileDiv);
                            }
                            
                            item.appendChild(removeBtn);
                            list.appendChild(item);
                        });
                        
                        if (dataTransfer.files.length < 3) {
                            text.style.color = '#ef4444';
                            text.innerHTML = 'Kurang ' + (3 - dataTransfer.files.length) + ' file lagi (Minimal 3)';
                        } else {
                            text.style.color = '#10b981';
                            text.innerHTML = dataTransfer.files.length + ' file siap di-upload (Maksimal 5)';
                        }
                    } else {
                        container.style.display = 'none';
                    }
                }
                
                document.getElementById('claimForm').onsubmit = function(e) {
                    if (dataTransfer.files.length < 3) {
                        e.preventDefault();
                        alert('Harap pilih minimal 3 file foto/video!');
                        return false;
                    }
                    if (dataTransfer.files.length > 5) {
                        e.preventDefault();
                        alert('Maksimal hanya boleh 5 file foto/video!');
                        return false;
                    }
                    return true;
                };
                </script>
                
                <?php endif; ?>
                
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- PANDUAN KLAIM GAMBAR -->
    <div style="max-width: 1200px; margin: 80px auto 0; text-align: center;">
        <img src="<?php echo get_template_directory_uri(); ?>/img/warranty-steps.png" alt="Panduan Klaim Garansi" style="width: 100%; max-width: 1100px; height: auto; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); border: 1px solid #e2e8f0;">
    </div>
</div>

<?php // Skip get_footer() if it messes with the clean full height design, but we probably should keep it
get_footer(); 
?>
