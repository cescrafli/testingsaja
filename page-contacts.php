<?php
/* Template Name: Contacts */
global $custom_css; $custom_css = 'contacts'; get_header();

$message_status = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_blueprint'])) {
    if (!isset($_POST['gjs_contact_blueprint_nonce']) || !wp_verify_nonce($_POST['gjs_contact_blueprint_nonce'], 'gjs_contact_blueprint_action')) {
        $message_status = 'error';
        $error_msg = 'Sesi keamanan kedaluwarsa. Silakan muat ulang halaman dan coba lagi.';
    } else {
        $nama_pengirim = sanitize_text_field($_POST['nama_pengirim']);
        $nomor_telpon = sanitize_text_field($_POST['nomor_telpon']);
        $perusahaan = sanitize_text_field($_POST['perusahaan']);
        $tipe = sanitize_text_field($_POST['tipe']);
        $material = sanitize_text_field($_POST['material']);
        $estimasi = sanitize_text_field($_POST['estimasi']);
        $catatan = sanitize_textarea_field($_POST['catatan']);
        
        $to = 'griyadjayaupvc@gmail.com';
        $subject = 'Pengajuan Proyek Baru dari ' . $nama_pengirim;
        $body = "Nama Pengirim: $nama_pengirim\nNomor Telepon / WA: $nomor_telpon\nNama Perusahaan / Proyek: $perusahaan\nTipe / Kategori Proyek: $tipe\nSpesifikasi Material / Estimasi Volume: $material\nEstimasi Linimasa: $estimasi\n\nKebutuhan Teknis & Catatan Khusus:\n$catatan";
        $headers = array('Content-Type: text/plain; charset=UTF-8', 'From: Website GJS <no-reply@griyadjayasentosa.id>');
        
        $attachments = array();
        $has_blueprint = false;
        
        if (!empty($_FILES['blueprint_files']['name'][0])) {
            $has_blueprint = true;
            $files = $_FILES['blueprint_files'];
            $count = count($files['name']);
            
            if ($count > 5) {
                $message_status = 'error';
                $error_msg = 'Maksimal 5 file lampiran blueprint yang diperbolehkan.';
            } else {
                for ($i = 0; $i < $count; $i++) {
                    if (!empty($files['name'][$i])) {
                        $uploadedfile = array(
                            'name'     => $files['name'][$i],
                            'type'     => $files['type'][$i],
                            'tmp_name' => $files['tmp_name'][$i],
                            'error'    => $files['error'][$i],
                            'size'     => $files['size'][$i]
                        );
                        
                        $res = function_exists('gjs_secure_handle_upload') 
                            ? gjs_secure_handle_upload($uploadedfile, array('image', 'blueprint'), 10485760)
                            : wp_handle_upload($uploadedfile, array('test_form' => false));
                        
                        if ($res && !isset($res['error']) && !empty($res['file'])) {
                            $attachments[] = $res['file'];
                        } else {
                            $message_status = 'error';
                            $error_msg = isset($res['error']) ? $res['error'] : 'Gagal mengunggah file blueprint.';
                            // Bersihkan file yang sempat terupload jika terjadi error
                            foreach ($attachments as $att) {
                                if (file_exists($att)) {
                                    @unlink($att);
                                }
                            }
                            $attachments = [];
                            break;
                        }
                    }
                }
            }
        }
        
        if ($message_status !== 'error') {
            $sent = wp_mail($to, $subject, $body, $headers, $attachments);
            if ($sent) {
                $message_status = 'success';
            } else {
                $message_status = 'error';
                $error_msg = 'Gagal mengirim email penawaran. Anda juga dapat langsung mengirimkan dokumen spesifikasi via WhatsApp resmi kami.';
            }
        }
        
        // Bersihkan file attachment sementara setelah pengiriman email demi keamanan & penyimpanan
        if (!empty($attachments)) {
            foreach ($attachments as $att_file) {
                if (file_exists($att_file)) {
                    @unlink($att_file);
                }
            }
        }
    }
}
?>

<style>
/* Header & Watermark Banner Standard */
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }
.page.primary-bg { padding: 104px 0 36px !important; }
@media (max-width: 768px) { .page.primary-bg { padding: 84px 0 28px !important; } }
.page .media {
    -webkit-transform: none !important;
    transform: none !important;
    opacity: 0.12 !important;
    right: 2% !important;
    bottom: -15% !important;
    max-width: 480px !important;
}

/* Base Wrapper Full-Width Protection */
main {
    width: 100% !important;
    background-color: #ffffff !important;
    flex: 1 0 auto !important;
    margin: 0 !important;
    padding: 0 !important;
}

/* Quick Contact Info Cards Strip */
.contact-quick-strip {
    background: #ffffff;
    padding: 44px 0 36px;
    border-bottom: 1px solid #e2e8f0;
    width: 100%;
}
.contact-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.contact-card-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px 22px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.contact-card-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(4,30,58,0.08);
}
.contact-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 14px;
}
.contact-card-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.contact-card-title {
    font-size: 17px;
    font-weight: 700;
    color: #041e3a;
    font-family: 'Outfit', sans-serif;
    margin: 0;
}
.contact-card-body {
    font-size: 14px;
    color: #475569;
    line-height: 1.6;
    margin-bottom: 18px;
    flex-grow: 1;
}
.contact-card-action a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13px;
    font-weight: 700;
    text-decoration: none;
    border-radius: 6px;
    padding: 9px 16px;
    transition: all 0.2s ease;
}

/* Main Section: Two Columns */
.contact-main-section {
    background-color: #f8fafc;
    padding: 50px 0 60px;
    width: 100%;
}
.contact-main-grid {
    display: grid;
    grid-template-columns: 1.15fr 0.85fr;
    gap: 40px;
    align-items: start;
}

/* Form Box */
.contact-form-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 36px 32px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.contact-form-title {
    font-size: clamp(22px, 3vw, 28px);
    font-weight: 800;
    color: #041e3a;
    font-family: 'Outfit', sans-serif;
    margin-bottom: 10px;
    line-height: 1.25;
}
.contact-form-desc {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 28px;
}
.form-row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}
.form-group-custom {
    margin-bottom: 16px;
}
.form-group-custom label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 6px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.form-group-custom input,
.form-group-custom select,
.form-group-custom textarea {
    width: 100%;
    padding: 12px 14px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 14px;
    color: #0f172a;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    background: #ffffff;
    box-sizing: border-box;
    font-family: inherit;
}
.form-group-custom input:focus,
.form-group-custom select:focus,
.form-group-custom textarea:focus {
    border-color: #041e3a;
    box-shadow: 0 0 0 3px rgba(4,30,58,0.08);
}
.form-group-custom textarea {
    resize: vertical;
    min-height: 100px;
}

/* Upload Dropzone */
.bp-upload-zone {
    border: 2px dashed #cba85d;
    background: #fdfbf7;
    border-radius: 10px;
    padding: 28px 20px;
    text-align: center;
    position: relative;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-top: 8px;
    margin-bottom: 20px;
}
.bp-upload-zone:hover, .bp-upload-zone.dragover {
    background: #fef8eb;
    border-color: #b8923f;
}
.bp-upload-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 10;
}
.bp-upload-icon svg {
    width: 44px;
    height: 44px;
    color: #cba85d;
    margin-bottom: 10px;
}
.bp-upload-title {
    font-size: 16px;
    font-weight: 700;
    color: #041e3a;
    font-family: 'Outfit', sans-serif;
    margin-bottom: 6px;
}
.bp-upload-desc {
    font-size: 12px;
    color: #64748b;
    line-height: 1.5;
    margin-bottom: 12px;
}
.bp-upload-btn-fake {
    display: inline-block;
    background: #041e3a;
    color: #ffffff;
    font-size: 12px;
    font-weight: 700;
    padding: 7px 16px;
    border-radius: 4px;
    letter-spacing: 0.5px;
}
.bp-preview-container {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 16px;
    justify-content: center;
}
.bp-preview-item {
    position: relative;
    width: 85px;
    height: 85px;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #cbd5e1;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
}
.bp-preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.bp-preview-file {
    font-size: 10px;
    text-align: center;
    padding: 6px;
    word-break: break-all;
    color: #334155;
    font-weight: 600;
    line-height: 1.2;
}
.bp-remove-btn {
    position: absolute;
    top: 4px;
    right: 4px;
    background: rgba(239, 68, 68, 0.95);
    color: #ffffff;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 13px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    line-height: 1;
    padding: 0;
    transition: background 0.2s;
    z-index: 15;
}
.bp-remove-btn:hover { background: #dc2626; }

/* Submit Button */
.btn-submit-contact {
    width: 100%;
    background: #041e3a;
    color: #ffffff;
    border: none;
    padding: 15px 24px;
    border-radius: 8px;
    font-size: 15px;
    font-weight: 700;
    font-family: 'Outfit', sans-serif;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}
.btn-submit-contact:hover {
    background: #062b53;
    box-shadow: 0 4px 15px rgba(4,30,58,0.2);
}

/* Notice */
.bp-notice {
    padding: 16px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 24px;
    line-height: 1.5;
}
.bp-notice.success {
    background: #ecfdf5;
    color: #065f46;
    border: 1px solid #a7f3d0;
}
.bp-notice.error {
    background: #fef2f2;
    color: #991b1b;
    border: 1px solid #fecaca;
}

/* Right Side: Info & Map Box */
.contact-sidebar-box {
    display: flex;
    flex-direction: column;
    gap: 24px;
}
.contact-side-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 28px 24px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
}
.contact-side-title {
    font-size: 18px;
    font-weight: 800;
    color: #041e3a;
    font-family: 'Outfit', sans-serif;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 12px;
    border-bottom: 1px solid #f1f5f9;
}
.workshop-address-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.workshop-address-item {
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px dashed #e2e8f0;
}
.workshop-address-item:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
}
.workshop-tag {
    display: inline-block;
    font-size: 11px;
    font-weight: 800;
    text-transform: uppercase;
    color: #041e3a;
    background: #e2e8f0;
    padding: 3px 8px;
    border-radius: 4px;
    margin-bottom: 5px;
    letter-spacing: 0.5px;
}
.workshop-name {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 3px;
}
.workshop-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.5;
}

/* Trust Badges */
.trust-badge-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 14px;
}
.trust-badge-item:last-child {
    margin-bottom: 0;
}
.trust-badge-icon {
    width: 22px;
    height: 22px;
    color: #0f9d58;
    flex-shrink: 0;
    margin-top: 2px;
}
.trust-badge-text {
    font-size: 13px;
    color: #334155;
    line-height: 1.5;
}
.trust-badge-text strong {
    color: #041e3a;
}

/* Map Iframe Wrapper */
.map-embed-wrapper {
    width: 100%;
    border-radius: 10px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    margin-bottom: 12px;
}

/* Responsive Media Queries */
@media (max-width: 991px) {
    .contact-cards-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .contact-main-grid {
        grid-template-columns: 1fr;
        gap: 32px;
    }
    .contact-form-box {
        padding: 24px 20px;
    }
}
@media (max-width: 576px) {
    .form-row-2 {
        grid-template-columns: 1fr;
        gap: 0;
    }
    .contact-quick-strip {
        padding: 28px 0 20px;
    }
    .contact-main-section {
        padding: 32px 0 44px;
    }
}
</style>

<?php get_template_part("template-parts/page-banner"); ?>

<!-- Strip Kartu Kontak Cepat -->
<section class="contact-quick-strip">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="contact-cards-grid">
            
            <!-- Card 1: WhatsApp & Telepon -->
            <div class="contact-card-item">
                <div class="contact-card-header">
                    <div class="contact-card-icon" style="background: #e8f5e9; color: #25d366;">
                        <svg width="24" height="24" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                    </div>
                    <div>
                        <h3 class="contact-card-title">Konsultasi WhatsApp</h3>
                        <span style="font-size: 12px; color: #16a34a; font-weight: 700;">Fast Response</span>
                    </div>
                </div>
                <div class="contact-card-body">
                    Tanya estimasi harga, konsultasi denah, atau jadwal survei lokasi langsung dengan teknisi kami.
                    <div style="margin-top: 8px; font-weight: 700; color: #041e3a;">
                        WA: +62 811-102-1088<br>
                        Telp: (021) 8047 6151
                    </div>
                </div>
                <div class="contact-card-action">
                    <a href="https://wa.me/628111021088?text=Halo%20Griya%20Djaya%20Sentosa,%20saya%20ingin%20konsultasi%20mengenai%20kebutuhan%20proyek%20saya" target="_blank" style="background: #25d366; color: #fff;">
                        <svg width="15" height="15" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1z"/></svg>
                        Chat WhatsApp Sekarang
                    </a>
                </div>
            </div>

            <!-- Card 2: Lokasi Kantor & Workshop -->
            <div class="contact-card-item">
                <div class="contact-card-header">
                    <div class="contact-card-icon" style="background: #eff6ff; color: #0284c7;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    </div>
                    <div>
                        <h3 class="contact-card-title">Kantor & Workshop</h3>
                        <span style="font-size: 12px; color: #0284c7; font-weight: 700;">Bogor &amp; Bekasi</span>
                    </div>
                </div>
                <div class="contact-card-body">
                    <strong>Workshop I:</strong> Jl. Raya Transyogi No 8 Cileungsi, Bogor.<br>
                    <strong>Workshop II:</strong> Jl. Raya Jati Asih No 3, Bekasi.<br>
                    <strong>Gudang:</strong> Kapuk Cengkareng, Jakarta Barat.
                </div>
                <div class="contact-card-action">
                    <a href="https://maps.google.com/?q=Griya+Djaya+Sentosa+Cileungsi" target="_blank" style="background: #041e3a; color: #fff;">
                        Petunjuk Arah Maps &rarr;
                    </a>
                </div>
            </div>

            <!-- Card 3: Jam Layanan & Dukungan -->
            <div class="contact-card-item">
                <div class="contact-card-header">
                    <div class="contact-card-icon" style="background: #fffbeb; color: #d97706;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    </div>
                    <div>
                        <h3 class="contact-card-title">Jam Operasional</h3>
                        <span style="font-size: 12px; color: #d97706; font-weight: 700;">Senin &ndash; Sabtu</span>
                    </div>
                </div>
                <div class="contact-card-body">
                    <strong>Workshop & Kantor:</strong> 08:00 &ndash; 17:00 WIB.<br>
                    <strong>Konsultasi Online:</strong> Tersedia setiap hari.<br>
                    <strong>Email:</strong> info@griyadjayasentosa.id
                </div>
                <div class="contact-card-action">
                    <a href="mailto:info@griyadjayasentosa.id" style="background: #f1f5f9; color: #041e3a; border: 1px solid #cbd5e1;">
                        Kirim Email Resmi
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Konten Utama: Formulir Konsultasi Proyek & Peta Workshop -->
<section class="contact-main-section">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="contact-main-grid">
            
            <!-- Kolom Kiri: Formulir Spesifikasi Proyek & Upload Blueprint -->
            <div class="contact-form-box">
                <div style="display: inline-block; font-size: 12px; font-weight: 800; color: #cba85d; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Mulai Proyek Anda</div>
                <h2 class="contact-form-title">Ceritakan Kebutuhan Proyek Anda</h2>
                <p class="contact-form-desc">
                    Unggah gambar kerja (CAD/DWG/PDF), denah arsitektur, atau tuliskan spesifikasi kebutuhan Anda. Tim engineering Griya Djaya Sentosa akan meninjau dokumen Anda dan memberikan rincian penawaran (RAB) terbaik.
                </p>

                <?php if ($message_status === 'success'): ?>
                    <div class="bp-notice success">
                        <strong>Berhasil Terkirim!</strong> <?php echo $has_blueprint ? 'Spesifikasi dan berkas blueprint proyek Anda berhasil diterima. Tim teknis kami akan segera menganalisis dokumen dan menghubungi Anda.' : 'Pesan Anda berhasil diterima. Tim konsultan kami akan segera menghubungi Anda kembali.'; ?>
                    </div>
                <?php elseif ($message_status === 'error'): ?>
                    <div class="bp-notice error">
                        <strong>Perhatian:</strong> <?php echo esc_html($error_msg); ?>
                    </div>
                <?php endif; ?>

                <form method="POST" enctype="multipart/form-data" id="contact-blueprint-form">
                    <?php wp_nonce_field( 'gjs_contact_blueprint_action', 'gjs_contact_blueprint_nonce' ); ?>
                    
                    <div class="form-row-2">
                        <div class="form-group-custom">
                            <label for="nama_pengirim">Nama Lengkap Anda *</label>
                            <input type="text" id="nama_pengirim" name="nama_pengirim" placeholder="cth. Ir. Budi Santoso" required>
                        </div>
                        <div class="form-group-custom">
                            <label for="nomor_telpon">Nomor Telepon / WhatsApp *</label>
                            <input type="text" id="nomor_telpon" name="nomor_telpon" placeholder="cth. 081234567890" required>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div class="form-group-custom">
                            <label for="perusahaan">Nama Perusahaan / Proyek (Opsional)</label>
                            <input type="text" id="perusahaan" name="perusahaan" placeholder="cth. PT Adhi Maju / Rumah Tinggal">
                        </div>
                        <div class="form-group-custom">
                            <label for="tipe">Kategori Produk &amp; Tipe Pekerjaan *</label>
                            <select id="tipe" name="tipe" required>
                                <option value="" disabled selected>Pilih Kategori Produk...</option>
                                <option value="Kusen & Pintu/Jendela UPVC Conch">Kusen &amp; Pintu/Jendela UPVC Conch</option>
                                <option value="Kusen Aluminium YKK / Alexindo">Kusen Aluminium YKK / Alexindo</option>
                                <option value="Fasad Curtain Wall & Spider Glass">Fasad Curtain Wall &amp; Spider Glass</option>
                                <option value="Aluminium Composite Panel (ACP Seven/Alucobond)">Aluminium Composite Panel (ACP Seven/Alucobond)</option>
                                <option value="Pintu Kaca Tempered & Shower Screen">Pintu Kaca Tempered &amp; Shower Screen</option>
                                <option value="Railing Tangga & Balkon Besi/Stainless">Railing Tangga &amp; Balkon Besi/Stainless</option>
                                <option value="Kombinasi / Renovasi Keseluruhan">Kombinasi / Renovasi Keseluruhan</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row-2">
                        <div class="form-group-custom">
                            <label for="material">Spesifikasi Material / Estimasi Volume *</label>
                            <input type="text" id="material" name="material" placeholder="cth. UPVC Putih 14 Unit / Aluminium Hitam 3 Lantai" required>
                        </div>
                        <div class="form-group-custom">
                            <label for="estimasi">Estimasi Linimasa Pengerjaan *</label>
                            <input type="text" id="estimasi" name="estimasi" placeholder="cth. Segera / Bulan Depan / Q1 2026" required>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label for="catatan">Catatan &amp; Detail Kebutuhan Proyek *</label>
                        <textarea id="catatan" name="catatan" rows="4" placeholder="Uraikan detail denah ukuran, preferensi warna, ketebalan kaca (Clear/Stopsol/Tempered), lokasi proyek, atau tenggat pengerjaan..." required></textarea>
                    </div>

                    <!-- Area Unggah Blueprint / Gambar Kerja -->
                    <div class="form-group-custom">
                        <label>Lampiran Dokumen / Blueprint (Opsional)</label>
                        <div class="bp-upload-zone" id="bp-dropzone">
                            <input type="file" name="blueprint_files[]" class="bp-upload-input" id="bp-file-input" multiple accept="image/*,.pdf,.dwg,.dxf,.step">
                            <div class="bp-upload-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="12" y1="18" x2="12" y2="12"></line><polyline points="9 15 12 12 15 15"></polyline></svg>
                            </div>
                            <h4 class="bp-upload-title">Tarik &amp; Lepas File Dokumen / Blueprint ke Sini</h4>
                            <p class="bp-upload-desc">Mendukung format CAD (DWG, DXF), PDF, STEP, atau Foto (JPG, PNG).<br>Maksimal 10MB per file (Maksimum 5 file lampiran).</p>
                            <div class="bp-upload-btn-fake">PILIH FILE DARI PERANGKAT</div>
                            <div id="bp-preview-container" class="bp-preview-container"></div>
                        </div>
                    </div>

                    <button type="submit" name="submit_blueprint" class="btn-submit-contact">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        KIRIM SPESIFIKASI &amp; MINTA PENAWARAN (RAB)
                    </button>
                    <div style="text-align: center; font-size: 11px; color: #94a3b8; margin-top: 12px;">
                        Data blueprint dan kontak Anda dijamin aman &amp; tidak disebarluaskan kepada pihak ketiga.
                    </div>
                </form>
            </div>

            <!-- Kolom Kanan: Peta Google Maps, Workshop, & Keunggulan Layanan -->
            <div class="contact-sidebar-box">
                
                <!-- Card 1: Google Maps Embed & Alamat Workshop -->
                <div class="contact-side-card">
                    <h3 class="contact-side-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#041e3a" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        Kunjungi Workshop Kami
                    </h3>
                    
                    <div class="map-embed-wrapper">
                        <iframe 
                            src="https://maps.google.com/maps?q=Griya%20Djaya%20Sentosa%20Jl.%20Raya%20Transyogi%20No%208%20Cileungsi%20Bogor&t=&z=14&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="240" 
                            style="border:0; display:block;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>

                    <ul class="workshop-address-list">
                        <li class="workshop-address-item">
                            <span class="workshop-tag">Head Office &amp; Work Shop I</span>
                            <div class="workshop-name">Jl. Raya Transyogi No 8, Cileungsi</div>
                            <div class="workshop-desc">Bogor, Jawa Barat 16820 (Pusat Fabrikasi UPVC Conch &amp; Aluminium)</div>
                        </li>
                        <li class="workshop-address-item">
                            <span class="workshop-tag">Work Shop II</span>
                            <div class="workshop-name">Jl. Raya Jati Asih No 3, RT 06 RW 05</div>
                            <div class="workshop-desc">Jati Asih, Kota Bekasi, Jawa Barat (Fabrikasi Kaca &amp; Finishing)</div>
                        </li>
                        <li class="workshop-address-item">
                            <span class="workshop-tag">Material Warehouse</span>
                            <div class="workshop-name">Jl. Raya Kapuk Cengkareng Gudang No 10</div>
                            <div class="workshop-desc">Cengkareng, Jakarta Barat (Pusat Distribusi Bahan Baku)</div>
                        </li>
                    </ul>

                    <a href="https://maps.google.com/?q=Griya+Djaya+Sentosa+Cileungsi" target="_blank" style="display: block; text-align: center; margin-top: 16px; background: #041e3a; color: #fff; padding: 10px 16px; border-radius: 6px; font-weight: 700; font-size: 13px; text-decoration: none;">
                        Buka di Google Maps Langsung &rarr;
                    </a>
                </div>

                <!-- Card 2: 4 Komitmen Mutu Layanan GJS -->
                <div class="contact-side-card" style="background: #ffffff;">
                    <h3 class="contact-side-title">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#041e3a" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                        Keunggulan Griya Djaya Sentosa
                    </h3>
                    
                    <div class="trust-badge-item">
                        <svg class="trust-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <div class="trust-badge-text">
                            <strong>Garansi Resmi 10 Tahun:</strong> Perlindungan garansi material profil UPVC Conch terhadap perubahan warna, getas, dan rayap.
                        </div>
                    </div>
                    
                    <div class="trust-badge-item">
                        <svg class="trust-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <div class="trust-badge-text">
                            <strong>Gratis Survei &amp; RAB:</strong> Pengukuran presisi langsung di lokasi proyek Anda se-Jabodetabek tanpa dipungut biaya tambahan.
                        </div>
                    </div>

                    <div class="trust-badge-item">
                        <svg class="trust-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <div class="trust-badge-text">
                            <strong>Fabrikasi Workshop Sendiri:</strong> Dikerjakan dengan mesin presisi modern dan kontrol kualitas (QC) ketat oleh teknisi berpengalaman sejak 2011.
                        </div>
                    </div>

                    <div class="trust-badge-item">
                        <svg class="trust-badge-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        <div class="trust-badge-text">
                            <strong>Material 100% Original:</strong> Spesifikasi aluminium YKK / Alexindo dan UPVC Conch bersertifikasi resmi pabrik.
                        </div>
                    </div>
                </div>

                <!-- Card 3: Kotak Chat WhatsApp Cepat -->
                <div class="contact-side-card" style="background: linear-gradient(135deg, #041e3a 0%, #082d54 100%); color: #ffffff;">
                    <div style="font-size: 12px; font-weight: 800; color: #25d366; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 6px;">Butuh Respons Kilat?</div>
                    <h4 style="font-size: 19px; font-weight: 800; font-family: 'Outfit', sans-serif; color: #fff; margin-bottom: 10px;">Konsultasi Online via WhatsApp</h4>
                    <p style="font-size: 13px; color: #cbd5e1; line-height: 1.6; margin-bottom: 18px;">
                        Kirimkan sketsa coretan denah atau pertanyaan Anda secara instan langsung ke tim konsultasi kami.
                    </p>
                    <a href="https://wa.me/628111021088?text=Halo%20Griya%20Djaya%20Sentosa,%20saya%20ingin%20tanya%20seputar%20layanan%20dan%20estimasi%20biaya" target="_blank" style="display: flex; align-items: center; justify-content: center; gap: 8px; background: #25d366; color: #ffffff; padding: 12px 20px; border-radius: 8px; font-weight: 700; font-size: 14px; text-decoration: none; box-shadow: 0 4px 15px rgba(37,211,102,0.3);">
                        <svg width="18" height="18" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                        Hubungi Kami via WhatsApp
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
</main>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const dt = new DataTransfer();
    const fileInput = document.getElementById('bp-file-input');
    const previewContainer = document.getElementById('bp-preview-container');
    const dropZone = document.getElementById('bp-dropzone');
    
    if (fileInput && previewContainer && dropZone) {
        fileInput.addEventListener('change', function(e) {
            for (let i = 0; i < this.files.length; i++) {
                if (this.files[i].size > 10 * 1024 * 1024) {
                    alert('File "' + this.files[i].name + '" melebihi ukuran maksimal 10MB.');
                    continue;
                }
                if (dt.items.length >= 5) {
                    alert('Maksimal 5 file lampiran blueprint yang diperbolehkan.');
                    break;
                }
                dt.items.add(this.files[i]);
            }
            updatePreview();
        });
        
        function updatePreview() {
            previewContainer.innerHTML = '';
            fileInput.files = dt.files;
            
            Array.from(dt.files).forEach((file, index) => {
                const item = document.createElement('div');
                item.className = 'bp-preview-item';
                
                const removeBtn = document.createElement('button');
                removeBtn.className = 'bp-remove-btn';
                removeBtn.innerHTML = '&times;';
                removeBtn.type = 'button';
                removeBtn.title = 'Hapus file ini';
                removeBtn.onclick = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dt.items.remove(index);
                    updatePreview();
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
                    const displayName = file.name.length > 18 ? file.name.substring(0,15) + '...' : file.name;
                    fileDiv.innerText = displayName;
                    item.appendChild(fileDiv);
                }
                
                item.appendChild(removeBtn);
                previewContainer.appendChild(item);
            });
        }
        
        // Drag and Drop
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, function(e) {
                e.preventDefault();
                e.stopPropagation();
            }, false);
        });
        
        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.add('dragover'), false);
        });
        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => dropZone.classList.remove('dragover'), false);
        });
        
        dropZone.addEventListener('drop', function(e) {
            const droppedFiles = e.dataTransfer.files;
            for (let i = 0; i < droppedFiles.length; i++) {
                if (droppedFiles[i].size > 10 * 1024 * 1024) {
                    alert('File "' + droppedFiles[i].name + '" melebihi ukuran maksimal 10MB.');
                    continue;
                }
                if (dt.items.length >= 5) {
                    alert('Maksimal 5 file lampiran blueprint yang diperbolehkan.');
                    break;
                }
                dt.items.add(droppedFiles[i]);
            }
            updatePreview();
        });
    }
});
</script>

<?php get_footer(); ?>
