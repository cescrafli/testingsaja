<?php
/**
 * Template Name: Employee Dashboard
 */

session_start();

// Helper to make Google Maps links clickable
function gjs_render_location($loc) {
    if (empty($loc)) return '-';
    $escaped = esc_html($loc);
    // Convert URLs to clickable links using ~ as delimiter to avoid escaping forward slashes
    return preg_replace('~(https?://[^\s]+)~', '<a href="$1" target="_blank" style="color: #3b82f6; text-decoration: underline; font-weight: 500;">Buka Maps &nearr;</a>', $escaped);
}


// Handle Logout
if ( isset($_GET['action']) && $_GET['action'] === 'logout' ) {
    session_destroy();
    echo '<script>window.location.replace("' . home_url( '/griyadjayamasuk/' ) . '");</script>';
    exit;
}

// Cek apakah user sudah login
if ( ! isset( $_SESSION['emp_id'] ) || ! isset( $_SESSION['emp_role'] ) ) {
    echo '<script>window.location.replace("' . home_url( '/griyadjayamasuk/' ) . '");</script>';
    exit;
}

$role = (int) $_SESSION['emp_role'];
$emp_id = $_SESSION['emp_id'];

global $wpdb;



$has_email = $wpdb->get_results("SHOW COLUMNS FROM `wp_barcode` LIKE 'email'");
if (empty($has_email)) {
    $wpdb->query("ALTER TABLE `wp_barcode` ADD `email` VARCHAR(255) NULL");
}

// Ensure new columns exist for wp_barcode
$has_nopen = $wpdb->get_results("SHOW COLUMNS FROM `wp_barcode` LIKE 'no_penawaran'");
if (empty($has_nopen)) {
    $wpdb->query("ALTER TABLE `wp_barcode` ADD `no_penawaran` VARCHAR(255) NULL");
}


$has_email = $wpdb->get_results("SHOW COLUMNS FROM `wp_barcode` LIKE 'email'");
if (empty($has_email)) {
    $wpdb->query("ALTER TABLE `wp_barcode` ADD `email` VARCHAR(255) NULL");
}

// Ensure new columns exist for wp_barcode
$has_spk = $wpdb->get_results("SHOW COLUMNS FROM `wp_barcode` LIKE 'SPKID'");
if (empty($has_spk)) {
    $wpdb->query("ALTER TABLE `wp_barcode` ADD `SPKID` VARCHAR(50) NULL");
}
$has_emp_id = $wpdb->get_results("SHOW COLUMNS FROM `wp_barcode` LIKE 'employee_id'");
if (empty($has_emp_id)) {
    $wpdb->query("ALTER TABLE `wp_barcode` ADD `employee_id` VARCHAR(50) NULL");
}

// Ensure columns exist for wp_employee
$has_name = $wpdb->get_results("SHOW COLUMNS FROM `wp_employee` LIKE 'name'");
if (empty($has_name)) {
    $wpdb->query("ALTER TABLE `wp_employee` ADD `name` VARCHAR(255) NULL");
    $wpdb->query("ALTER TABLE `wp_employee` ADD `phone` VARCHAR(50) NULL");
    $wpdb->query("ALTER TABLE `wp_employee` ADD `email` VARCHAR(100) NULL");
    $wpdb->query("ALTER TABLE `wp_employee` ADD `address` TEXT NULL");
}

$table_barcode = 'wp_barcode';
$table_employee = 'wp_employee';


$message = '';
$message_type = 'success';

// Handle Actions (POST)
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
        $action = isset( $_POST['action'] ) ? sanitize_text_field( $_POST['action'] ) : '';

    // EXPORT CSV
    if ($action === 'export_csv' && $role === 2) {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Data_Transaksi_Template.csv');
        $output = fopen('php://output', 'w');
        
        // Add UTF-8 BOM so Excel automatically recognizes columns correctly
        fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Force Excel to use semicolon separator by explicitly declaring it
        fputs($output, "sep=;
");
        
        fputcsv($output, array('Barcode ID', 'No Penawaran', 'No. Project', 'Nama Customer', 'Material', 'Tanggal', 'Garansi Exp', 'Status', 'Email', 'Phone', 'Marketing ID', 'Location', 'Kota', 'Provinsi', 'Kode Pos', 'Nilai Project'), ';');
        
        $rows = $wpdb->get_results("SELECT * FROM wp_barcode ORDER BY date_transaction DESC", ARRAY_A);
        foreach($rows as $row) {
            fputcsv($output, array(
                $row['BarcodeID'],
                $row['no_penawaran'],
                $row['SPKID'],
                $row['customer'],
                $row['material_description'],
                $row['date_transaction'],
                $row['warranty_exp'],
                $row['status'],
                $row['email'],
                $row['phone_customer'],
                $row['employee_id'],
                $row['location'],
                $row['kota'],
                $row['provinsi'],
                $row['kode_pos'],
                $row['nilai_project']
            ), ';');
        }
        fclose($output);
        exit;
    }

    // IMPORT CSV
    if ($action === 'import_csv' && $role === 2) {
        if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {
            $file = $_FILES['csv_file']['tmp_name'];
            if (($handle = fopen($file, "r")) !== FALSE) {
                // Skip BOM if present
                $bom = fread($handle, 3);
                if ($bom !== b"﻿") {
                    rewind($handle);
                }
                
                // Read first line
                $header = fgetcsv($handle, 1000, ";");
                // If the first line is our "sep=;" hack, skip it and read the next line as header
                if ($header !== FALSE && stripos($header[0], 'sep=') !== FALSE) {
                    $header = fgetcsv($handle, 1000, ";");
                }
                
                // Fallback to comma if user manually removed the semicolon and saved as comma CSV
                if ($header && count($header) < 15) {
                    rewind($handle);
                    $bom = fread($handle, 3);
                    if ($bom !== b"﻿") rewind($handle);
                    $header = fgetcsv($handle, 1000, ",");
                    if ($header !== FALSE && stripos($header[0], 'sep=') !== FALSE) {
                        $header = fgetcsv($handle, 1000, ",");
                    }
                    $delimiter = ",";
                } else {
                    $delimiter = ";";
                }

                if ($header && trim($header[0]) === 'Barcode ID') {
                    $count_updated = 0;
                    $count_inserted = 0;
                    
                    while (($data = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                        if (count($data) < 16) continue;
                        
                        $r_barcode = sanitize_text_field($data[0]);
                        $r_nopen = sanitize_text_field($data[1]);
                        $r_noproject = sanitize_text_field($data[2]);
                        $r_cust = sanitize_text_field($data[3]);
                        $r_mat = sanitize_text_field($data[4]);
                        $r_date = sanitize_text_field($data[5]);
                        $r_war = sanitize_text_field($data[6]);
                        $r_stat = (int) $data[7];
                        $r_email = sanitize_email($data[8]);
                        $r_phone = sanitize_text_field($data[9]);
                        $r_empid = sanitize_text_field($data[10]);
                        $r_loc = sanitize_text_field($data[11]);
                        $r_kota = sanitize_text_field($data[12]);
                        $r_prov = sanitize_text_field($data[13]);
                        $r_kode = sanitize_text_field($data[14]);
                        $r_nilai = sanitize_text_field($data[15]);
                        
                        // Parse dates securely to YYYY-MM-DD
                        // Note: strtotime() treats slashes (m/d/y) differently than dashes (d-m-y).
                        // In Indonesia, Excel exports DD/MM/YYYY. We replace slashes with dashes so it's parsed correctly.
                        $norm_date = str_replace('/', '-', trim($r_date));
                        $r_date_ts = strtotime($norm_date);
                        if ($r_date_ts) $r_date = date('Y-m-d', $r_date_ts);
                        
                        $norm_war = str_replace('/', '-', trim($r_war));
                        $r_war_ts = strtotime($norm_war);
                        if ($r_war_ts) $r_war = date('Y-m-d', $r_war_ts);
                        
                        // DETERMINE SPKID FOR THIS ROW (Works for both INSERT and UPDATE)
                        if (!empty($r_noproject)) {
                            $final_spk = $r_noproject;
                        } else {
                            // If they left it blank, check if existing record already has one
                            $existing_spk = $r_barcode ? $wpdb->get_var($wpdb->prepare("SELECT SPKID FROM wp_barcode WHERE BarcodeID = %s", $r_barcode)) : null;
                            if (!empty($existing_spk)) {
                                $final_spk = $existing_spk;
                            } else {
                                // Auto-generate new SPKID
                                $trx_year = date('Y', strtotime($r_date));
                                $last_spk = $wpdb->get_var($wpdb->prepare("SELECT SPKID FROM wp_barcode WHERE YEAR(date_transaction) = %s AND SPKID LIKE 'P %' ORDER BY CAST(SUBSTRING(SPKID, 3) AS UNSIGNED) DESC LIMIT 1", $trx_year));
                                $last_num = $last_spk ? (int) preg_replace('/[^0-9]/', '', $last_spk) : 0;
                                $final_spk = 'P ' . str_pad($last_num + 1, 4, '0', STR_PAD_LEFT);
                                
                                // To prevent duplicate SPKIDs in a single bulk upload loop, we must trick the system
                                // by fetching the absolute highest including the one we just assigned if any.
                                // But wpdb->get_var hits the DB directly, so as long as we insert/update immediately, the next loop sees it.
                            }
                        }
                        
                        if (empty($r_barcode)) {
                            // GENERATE NEW BARCODE
                            $material_clean = str_replace(' ', '', $r_mat);
                            $kode_material = strtoupper(substr($material_clean, 0, 3));
                            
                            $cust_name_clean = str_replace(' ', '', $r_cust);
                            $kode_kedua = strtoupper(substr($cust_name_clean, 0, 3));
                            
                            $yymm = date('ym', strtotime($r_date));
                            $prefix = $kode_material . $kode_kedua . $yymm;
                            
                            $last_barcode = $wpdb->get_var($wpdb->prepare(
                                "SELECT barcodeID FROM wp_barcode WHERE barcodeID LIKE %s ORDER BY barcodeID DESC LIMIT 1",
                                $wpdb->esc_like($prefix) . '%'
                            ));
                            
                            $new_number = $last_barcode ? ((int) substr($last_barcode, -4)) + 1 : 1;
                            $nomor_urut = str_pad($new_number, 4, '0', STR_PAD_LEFT);
                            $new_barcode = $prefix . $nomor_urut;
                            
                            $wpdb->insert('wp_barcode', array(
                                'BarcodeID' => $new_barcode,
                                'no_penawaran' => $r_nopen,
                                'SPKID' => $final_spk,
                                'material_description' => $r_mat,
                                'status' => $r_stat,
                                'date_transaction' => $r_date,
                                'warranty_exp' => $r_war,
                                'location' => $r_loc,
                                'customer' => $r_cust,
                                'phone_customer' => $r_phone,
                                'email' => $r_email,
                                'kota' => $r_kota,
                                'provinsi' => $r_prov,
                                'kode_pos' => $r_kode,
                                'nilai_project' => $r_nilai,
                                'employee_id' => $r_empid
                            ));
                            $count_inserted++;
                        } else {
                            // UPDATE EXISTING
                            $update_data = array(
                                'no_penawaran' => $r_nopen,
                                'SPKID' => $final_spk,
                                'material_description' => $r_mat,
                                'status' => $r_stat,
                                'date_transaction' => $r_date,
                                'warranty_exp' => $r_war,
                                'location' => $r_loc,
                                'customer' => $r_cust,
                                'phone_customer' => $r_phone,
                                'email' => $r_email,
                                'kota' => $r_kota,
                                'provinsi' => $r_prov,
                                'kode_pos' => $r_kode,
                                'nilai_project' => $r_nilai,
                                'employee_id' => $r_empid
                            );
                            
                            $wpdb->update('wp_barcode', $update_data, array('BarcodeID' => $r_barcode));
                            $count_updated++;
                        }
                    }
                    $message = "Upload CSV berhasil: $count_inserted transaksi baru, $count_updated transaksi diperbarui.";
                } else {
                    $message = "Format CSV tidak valid. Pastikan menggunakan format Download Template (Kolom pertama harus 'Barcode ID').";
                    $message_type = "error";
                }
                fclose($handle);
            } else {
                $message = "Gagal membaca file CSV.";
                $message_type = "error";
            }
        }
    }


    // INSERT TRANSACTION (Role 2 & 3)
    if ( $action === 'add_transaction' && ( $role === 2 || $role === 3 ) ) {
        $material = sanitize_text_field($_POST['material_description'] ?? '');
        $status = (int) ($_POST['status'] ?? 1);
        $date_trx = sanitize_text_field($_POST['date_transaction'] ?? '');
        $warranty = sanitize_text_field($_POST['warranty_exp'] ?? '');
        $b_customer = sanitize_text_field($_POST['customer_id'] ?? '');
        $marketing_id = sanitize_text_field($_POST['marketing_id'] ?? '');
        $no_penawaran = sanitize_text_field($_POST['no_penawaran'] ?? '');
        $nilai_project = sanitize_text_field($_POST['nilai_project'] ?? '');

        // Fetch existing details as fallback
        $existing = $wpdb->get_row($wpdb->prepare("SELECT phone_customer, email, location, kota, provinsi, kode_pos FROM wp_barcode WHERE customer = %s LIMIT 1", $b_customer));
        
        $b_phone = !empty($_POST['customer_phone']) ? sanitize_text_field($_POST['customer_phone']) : ($existing ? $existing->phone_customer : '');
        $b_email = !empty($_POST['customer_email']) ? sanitize_email($_POST['customer_email']) : ($existing ? $existing->email : '');
        $b_kota = !empty($_POST['kota']) ? sanitize_text_field($_POST['kota']) : ($existing ? $existing->kota : '');
        $b_provinsi = !empty($_POST['provinsi']) ? sanitize_text_field($_POST['provinsi']) : ($existing ? $existing->provinsi : '');
        $b_kodepos = !empty($_POST['kodepos']) ? sanitize_text_field($_POST['kodepos']) : ($existing ? $existing->kode_pos : '');
        $location = !empty($_POST['location']) ? sanitize_text_field($_POST['location']) : ($existing ? $existing->location : '');

        // --- LOGIKA BARCODE OTOMATIS ---
        $material_clean = str_replace(' ', '', $material);
        $kode_material = strtoupper(substr($material_clean, 0, 3));
        
        $cust_name_clean = str_replace(' ', '', $b_customer);
        $kode_kedua = strtoupper(substr($cust_name_clean, 0, 3));
        
        $yymm = date('ym', strtotime($date_trx));
        $prefix = $kode_material . $kode_kedua . $yymm;
        
        $last_barcode = $wpdb->get_var($wpdb->prepare(
            "SELECT barcodeID FROM wp_barcode WHERE barcodeID LIKE %s ORDER BY barcodeID DESC LIMIT 1",
            $wpdb->esc_like($prefix) . '%'
        ));
        
        if ($last_barcode) {
            $last_number = (int) substr($last_barcode, -4);
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }
        $nomor_urut = str_pad($new_number, 4, '0', STR_PAD_LEFT);
        $barcodeID = $prefix . $nomor_urut;
        // --- END LOGIKA BARCODE ---
        
        // Generate SPK
        $trx_year = date('Y', strtotime($date_trx));
        $last_spk = $wpdb->get_var($wpdb->prepare("SELECT SPKID FROM wp_barcode WHERE YEAR(date_transaction) = %s AND SPKID LIKE 'P %' ORDER BY CAST(SUBSTRING(SPKID, 3) AS UNSIGNED) DESC LIMIT 1", $trx_year));
        if ($last_spk) {
            // Extracts numbers after 'P '
            $last_num = (int) preg_replace('/[^0-9]/', '', $last_spk);
            $new_num = $last_num + 1;
        } else {
            $new_num = 1;
        }
        $new_spk = 'P ' . str_pad($new_num, 4, '0', STR_PAD_LEFT);

        $inserted = $wpdb->insert(
            $table_barcode,
            array(
                'BarcodeID' => $barcodeID,
                'no_penawaran' => $no_penawaran,
                'material_description' => $material,
                'status' => $status,
                'date_transaction' => $date_trx,
                'warranty_exp' => $warranty,
                'location' => $location,
                'customer' => $b_customer,
                'phone_customer' => $b_phone,
                'email' => $b_email,
                'kota' => $b_kota,
                'provinsi' => $b_provinsi,
                'kode_pos' => $b_kodepos,
                'nilai_project' => $nilai_project,
                'employee_id' => $marketing_id,
                'SPKID' => $new_spk
            )
        );
        
        if($inserted) {
            $message = "Transaksi $barcodeID berhasil ditambahkan!";
        } else {
            $message = "Gagal menambahkan transaksi. Error: " . $wpdb->last_error;
            $message_type = 'error';
        }
    }

    // DELETE TRANSACTION (Role 2 Only)
    if ( $action === 'delete_transaction' && $role === 2 ) {
        $del_id = sanitize_text_field($_POST['barcodeID']);
        $wpdb->delete( $table_barcode, array( 'BarcodeID' => $del_id ) );
        $message = "Transaksi $del_id berhasil dihapus!";
    }

    // EDIT TRANSACTION (Role 2 Only)
    if ( $action === 'edit_transaction' && $role === 2 ) {
        $old_barcode = sanitize_text_field($_POST['original_barcodeID']);
        $new_barcode = sanitize_text_field($_POST['barcodeID']); // Currently readonly, but we'll include it safely
        
        $upd_data = array(
            'BarcodeID' => $old_barcode, // Barcode ID is NOT allowed to change per user request, so we force old_barcode
            'no_penawaran' => sanitize_text_field($_POST['no_penawaran'] ?? ''),
            'material_description' => sanitize_text_field($_POST['material_description'] ?? ''),
            'date_transaction' => sanitize_text_field($_POST['date_transaction'] ?? ''),
            'warranty_exp' => sanitize_text_field($_POST['warranty_exp'] ?? ''),
            'status' => (int) ($_POST['status'] ?? 1),
            'customer' => sanitize_text_field($_POST['customer_nama'] ?? ''),
            'phone_customer' => sanitize_text_field($_POST['customer_phone'] ?? ''),
            'email' => sanitize_email($_POST['customer_email'] ?? ''),
            'location' => sanitize_text_field($_POST['location'] ?? ''),
            'kota' => sanitize_text_field($_POST['kota'] ?? ''),
            'provinsi' => sanitize_text_field($_POST['provinsi'] ?? ''),
            'kode_pos' => sanitize_text_field($_POST['kodepos'] ?? ''),
            'nilai_project' => sanitize_text_field($_POST['nilai_project'] ?? ''),
            'employee_id' => sanitize_text_field($_POST['employee_id'] ?? '')
        );
        
        $updated = $wpdb->update(
            $table_barcode,
            $upd_data, array('BarcodeID' => $old_barcode));
        if ($updated !== false) {
            $message = "Transaksi $old_barcode berhasil diperbarui!";
        } else {
            $message = "Gagal memperbarui transaksi. Error: " . $wpdb->last_error;
            $message_type = 'error';
        }
    }

        
    // SELESAI REQUEST
    if (isset($_POST['action']) && $_POST['action'] === 'selesai_request') {
        $barcode_id = sanitize_text_field($_POST['barcode_id']);
        $deskripsi = sanitize_textarea_field($_POST['selesai_deskripsi']);
        $tanggal = sanitize_text_field($_POST['selesai_tanggal']);
        
        // Ensure columns exist
        $has_col1 = $wpdb->get_results("SHOW COLUMNS FROM `wp_request` LIKE 'date_repaired'");
        if (empty($has_col1)) {
            $wpdb->query("ALTER TABLE `wp_request` ADD `date_repaired` DATE NULL, ADD `description_warranty` TEXT NULL, ADD `proof_warranty_1` VARCHAR(255) NULL, ADD `proof_warranty_2` VARCHAR(255) NULL, ADD `proof_warranty_3` VARCHAR(255) NULL, ADD `proof_warranty_4` VARCHAR(255) NULL, ADD `proof_warranty_5` VARCHAR(255) NULL");
        }
        
        // Upload Photos
        $uploaded_urls = [];
        if (!empty($_FILES['selesai_foto']['name'][0])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            
            $files = $_FILES['selesai_foto'];
            foreach ($files['name'] as $key => $value) {
                if ($files['name'][$key]) {
                    $file = array(
                        'name'     => $files['name'][$key],
                        'type'     => $files['type'][$key],
                        'tmp_name' => $files['tmp_name'][$key],
                        'error'    => $files['error'][$key],
                        'size'     => $files['size'][$key]
                    );
                    $movefile = wp_handle_upload($file, array('test_form' => false));
                    if ($movefile && !isset($movefile['error'])) {
                        $uploaded_urls[] = $movefile['url'];
                    }
                }
            }
        }
        
        $p1 = isset($uploaded_urls[0]) ? $uploaded_urls[0] : '';
        $p2 = isset($uploaded_urls[1]) ? $uploaded_urls[1] : '';
        $p3 = isset($uploaded_urls[2]) ? $uploaded_urls[2] : '';
        $p4 = isset($uploaded_urls[3]) ? $uploaded_urls[3] : '';
        $p5 = isset($uploaded_urls[4]) ? $uploaded_urls[4] : '';
        
        // Update request
        // Get the current max claim_warranty for this barcode
        $has_col2 = $wpdb->get_results("SHOW COLUMNS FROM `wp_request` LIKE 'claim_warranty'");
        if (empty($has_col2)) {
            $wpdb->query("ALTER TABLE `wp_request` ADD `claim_warranty` INT DEFAULT 0");
        }
        
        $current_claim = $wpdb->get_var($wpdb->prepare("SELECT MAX(claim_warranty) FROM `wp_request` WHERE barcodeid = %s", $barcode_id));
        $new_claim_number = $current_claim ? (int)$current_claim + 1 : 1;

        $request_id = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;
        if ($request_id > 0) {
            $wpdb->update('wp_request', array(
                'description_warranty' => $deskripsi,
                'date_repaired' => $tanggal,
                'proof_warranty_1' => $p1,
                'proof_warranty_2' => $p2,
                'proof_warranty_3' => $p3,
                'proof_warranty_4' => $p4,
                'proof_warranty_5' => $p5,
                'claim_warranty' => $new_claim_number
            ), array('id' => $request_id));
        } else {
            $wpdb->update('wp_request', array('description_warranty' => $deskripsi, 'date_repaired' => $tanggal, 'proof_warranty_1' => $p1, 'proof_warranty_2' => $p2, 'proof_warranty_3' => $p3, 'proof_warranty_4' => $p4, 'proof_warranty_5' => $p5, 'claim_warranty' => $new_claim_number), array('barcodeid' => $barcode_id));
        }
        
        // Update status back to 1 (Reset) so they can claim again
        $wpdb->update('wp_barcode', array('status' => 1), array('BarcodeID' => $barcode_id));
        
        $wa_data = $wpdb->get_row($wpdb->prepare("SELECT b.customer, b.phone_customer, b.material_description, r.category, r.description_warranty, r.phone as alt_phone FROM wp_barcode b LEFT JOIN wp_request r ON b.BarcodeID = r.barcodeid WHERE r.id = %d", $request_id));
        $target_phone = ($wa_data && !empty($wa_data->alt_phone)) ? $wa_data->alt_phone : ($wa_data ? $wa_data->phone_customer : '');
        if ($wa_data && !empty($target_phone)) {
            $kategori = 'Pengajuan';
            if ($wa_data->category == 1) $kategori = 'Klaim Garansi';
            elseif ($wa_data->category == 2) $kategori = 'Servis Berbayar';
            elseif ($wa_data->category == 3) $kategori = 'Konsultasi Kendala';
            elseif ($wa_data->category == 4) $kategori = 'Minta Sparepart';
            $wa_msg = "Halo Bapak/Ibu *$wa_data->customer*,

Kami informasikan bahwa pengerjaan untuk *$kategori* pada material *$wa_data->material_description* Anda (ID: *$barcode_id*) telah *SELESAI* dengan baik pada tanggal *$tanggal*.

*Detail Pekerjaan:*
_{$wa_data->description_warranty}_

Terima kasih telah mempercayakan layanan Anda kepada Griya Djaya Sentosa. Semoga hasilnya memuaskan!";
            $fotos = [$p1, $p2, $p3, $p4, $p5];
            gjs_send_whatsapp($target_phone, $wa_msg, $fotos);
        }
        
        $message = "Pekerjaan untuk Barcode ID $barcode_id telah diselesaikan!";
    }

    // APPROVE REQUEST
    if ( $action === 'approve_request' && ( $role === 1 || $role === 2 ) ) {
        $barcode_id = sanitize_text_field($_POST['barcode_id']);
        $wpdb->update('wp_barcode', array('status' => 3), array('BarcodeID' => $barcode_id));
        
        $wa_data = $wpdb->get_row($wpdb->prepare("SELECT b.customer, b.phone_customer, b.material_description, r.category, r.phone as alt_phone FROM wp_barcode b LEFT JOIN wp_request r ON b.BarcodeID = r.barcodeid WHERE b.BarcodeID = %s ORDER BY r.id DESC LIMIT 1", $barcode_id));
        $target_phone = ($wa_data && !empty($wa_data->alt_phone)) ? $wa_data->alt_phone : ($wa_data ? $wa_data->phone_customer : '');
        if ($wa_data && !empty($target_phone)) {
            $kategori = 'Pengajuan';
            if ($wa_data->category == 1) $kategori = 'Klaim Garansi';
            elseif ($wa_data->category == 2) $kategori = 'Servis Berbayar';
            elseif ($wa_data->category == 3) $kategori = 'Konsultasi Kendala';
            elseif ($wa_data->category == 4) $kategori = 'Minta Sparepart';
            $wa_msg = "Halo Bapak/Ibu *$wa_data->customer*,

Kabar gembira! Pengajuan *$kategori* untuk material *$wa_data->material_description* Anda (ID: *$barcode_id*) telah *DISETUJUI* oleh tim kami.

Kami akan segera menjadwalkan dan memproses pengerjaan Anda. Teknisi/tim kami akan menghubungi Anda sesaat lagi jika ada koordinasi lebih lanjut terkait kedatangan.

Terima kasih atas kepercayaannya!";
            gjs_send_whatsapp($target_phone, $wa_msg);
        }
        $message = "Permintaan garansi $barcode_id berhasil disetujui (Status 3).";
    }

    // DECLINE REQUEST
    if ( $action === 'decline_request' && ( $role === 1 || $role === 2 ) ) {
        $barcode_id = sanitize_text_field($_POST['barcode_id']);
        $request_id = isset($_POST['request_id']) ? (int)$_POST['request_id'] : 0;
        $alasan = sanitize_textarea_field($_POST['alasan_penolakan']);
        $cust_email = sanitize_email($_POST['cust_email']);
        
        $has_alasan = $wpdb->get_results("SHOW COLUMNS FROM `wp_request` LIKE 'description_decline'");
        if (empty($has_alasan)) {
            $wpdb->query("ALTER TABLE `wp_request` ADD `description_decline` TEXT NULL");
        }
        
        if ($request_id > 0) {
            $wpdb->update('wp_request', array('description_decline' => $alasan), array('id' => $request_id));
        } else {
            $wpdb->update('wp_request', array('description_decline' => $alasan), array('barcodeid' => $barcode_id));
        }
        $wpdb->update('wp_barcode', array('status' => 4), array('BarcodeID' => $barcode_id));
        
        $wa_data = $wpdb->get_row($wpdb->prepare("SELECT b.customer, b.phone_customer, b.material_description, r.category, r.description_decline, r.phone as alt_phone FROM wp_barcode b LEFT JOIN wp_request r ON b.BarcodeID = r.barcodeid WHERE r.id = %d", $request_id));
        $target_phone = ($wa_data && !empty($wa_data->alt_phone)) ? $wa_data->alt_phone : ($wa_data ? $wa_data->phone_customer : '');
        if ($wa_data && !empty($target_phone)) {
            $kategori = 'Pengajuan';
            if ($wa_data->category == 1) $kategori = 'Klaim Garansi';
            elseif ($wa_data->category == 2) $kategori = 'Servis Berbayar';
            elseif ($wa_data->category == 3) $kategori = 'Konsultasi Kendala';
            elseif ($wa_data->category == 4) $kategori = 'Minta Sparepart';
            $wa_msg = "Halo Bapak/Ibu *$wa_data->customer*,

Kami informasikan bahwa pengajuan *$kategori* untuk material *$wa_data->material_description* Anda (ID: *$barcode_id*) mohon maaf belum dapat kami proses lebih lanjut pada saat ini.

*Keterangan:*
_{$wa_data->description_decline}_

Apabila ada pertanyaan lebih lanjut, silakan balas pesan ini. Terima kasih atas pengertiannya.";
            gjs_send_whatsapp($target_phone, $wa_msg);
        }
        $message = "Permintaan garansi $barcode_id berhasil ditolak.";
    }

    // DELETE EMPLOYEE (Role 1 Only)
    if ( $action === 'delete_employee' && $role === 1 ) {
        $target_id = sanitize_text_field($_POST['target_emp_id']);
        // Hanya bisa menghapus role 2 dan 3
        $wpdb->query( $wpdb->prepare("DELETE FROM {$table_employee} WHERE employee_id = %s AND role IN (2,3)", $target_id) );
        $message = "Akun karyawan berhasil dihapus permanen!";
    }
    
    // TAMBAH KARYAWAN (KHUSUS ROLE 1)
    if ( $action === 'add_employee_account' && $role === 1 ) {
        $emp_name = sanitize_text_field($_POST['emp_name']);
        $emp_username = sanitize_text_field($_POST['emp_username']);
        $emp_password = sanitize_text_field($_POST['emp_password']);
        $emp_phone = sanitize_text_field($_POST['emp_phone']);
        $emp_email = sanitize_email($_POST['emp_email']);
        $emp_address = sanitize_textarea_field($_POST['emp_address']);
        $emp_role = (int) $_POST['emp_role'];
        
        // Auto-migrate table if needed
        $has_name = $wpdb->get_results("SHOW COLUMNS FROM `{$table_employee}` LIKE 'name'");
        if (empty($has_name)) {
            $wpdb->query("ALTER TABLE `{$table_employee}` ADD `name` VARCHAR(255) NULL AFTER `employee_id`");
            $wpdb->query("ALTER TABLE `{$table_employee}` ADD `phone` VARCHAR(50) NULL AFTER `password`");
            $wpdb->query("ALTER TABLE `{$table_employee}` ADD `email` VARCHAR(100) NULL AFTER `phone`");
            $wpdb->query("ALTER TABLE `{$table_employee}` ADD `address` TEXT NULL AFTER `email`");
        }
        
        $random_emp_id = 'EMP-' . mt_rand(10000, 99999);
        $inserted = $wpdb->insert(
            $table_employee,
            [
                'employee_id' => $random_emp_id,
                'name' => $emp_name,
                'username' => $emp_username,
                'password' => $emp_password,
                'phone' => $emp_phone,
                'email' => $emp_email,
                'address' => $emp_address,
                'role' => $emp_role,
                'status' => 1
            ]
        );
        
        if ($inserted) {
            $message = "Berhasil! Akun karyawan baru (".$emp_username.") telah ditambahkan.";
        } else {
            $message = "Gagal! Username mungkin sudah digunakan.";
            $message_type = "error";
        }
    }

    // LOGOUT
    if ( $action === 'logout' ) {
        session_destroy();
        wp_redirect( home_url( '/griyadjayamasuk/' ) );
        exit;
    }
}

// Data Fetching berdasarkan Role
$analytics_data = [];
$employees_list = [];
$transactions_list = [];
$customers_list = [];
if ( $role === 2 || $role === 3 ) {
    $customers_list = $wpdb->get_results("SELECT DISTINCT customer AS nama FROM wp_barcode WHERE customer IS NOT NULL AND customer != '' ORDER BY customer ASC");
}
$start_date = isset($_GET['start_date']) ? sanitize_text_field($_GET['start_date']) : date('Y-m-01'); // Default awal bulan
$end_date = isset($_GET['end_date']) ? sanitize_text_field($_GET['end_date']) : date('Y-m-d'); // Default hari ini
    // Ambil data pengajuan klaim garansi (untuk semua role)
    $requests_list = $wpdb->get_results("
        SELECT 
              r.id,
              r.barcodeid, 
              b.SPKID as spk_id,
              b.customer as customer_nama, 
              b.phone_customer as cust_phone,
              b.material_description as material, 
              b.location as cust_location,
              b.kota as cust_kota,
              b.provinsi as cust_provinsi,
              b.kode_pos as cust_kode_pos,
              b.status as barcode_status,
              r.created_at, 
              r.category, 
              r.phone, 
              r.lokasi, 
              r.deskripsi, 
              r.proof_1, r.proof_2, r.proof_3, r.proof_4, r.proof_5,
              r.date_repaired, r.description_warranty, 
              r.proof_warranty_1, r.proof_warranty_2, r.proof_warranty_3, r.proof_warranty_4, r.proof_warranty_5,
              r.claim_warranty, r.description_decline
          FROM wp_request r
          LEFT JOIN wp_barcode b ON r.barcodeid = b.BarcodeID
          ORDER BY r.created_at DESC
    ");



if ( $role === 1 ) {
    // KARYAWAN ATAS
    // 1. Analitik Transaksi
    // Analytics for Warranty Requests (Pengajuan Garansi) over time
    $analytics_data = $wpdb->get_results( $wpdb->prepare("
        SELECT 
            DATE(r.created_at) as req_date,
            CASE 
                WHEN r.date_repaired IS NOT NULL AND r.date_repaired != '' THEN 'Selesai'
                WHEN r.description_decline IS NOT NULL AND r.description_decline != '' THEN 'Ditolak'
                WHEN b.status = 3 THEN 'Dikerjakan'
                WHEN b.status = 2 THEN 'Permintaan'
                ELSE 'Lainnya'
            END as req_status,
            COUNT(*) as total
        FROM wp_request r
        LEFT JOIN wp_barcode b ON r.barcodeid = b.BarcodeID
        WHERE DATE(r.created_at) >= %s AND DATE(r.created_at) <= %s
        GROUP BY req_date, req_status
        ORDER BY req_date ASC
    ", $start_date, $end_date) );
    
    // 2. Data Karyawan (Last Login)
    $employees_list = $wpdb->get_results("SELECT employee_id, username, role, status, last_login FROM {$table_employee} ORDER BY role ASC");
} elseif ( $role === 2 ) {
    // KARYAWAN MENENGAH

    
    // Ambil list transaksi untuk bisa dihapus
    $transactions_list = $wpdb->get_results("
        SELECT 
              b.*, 
              b.customer AS customer_nama, 
              b.email AS customer_email, b.phone_customer AS customer_phone, 
              b.location AS lokasi, b.kota, b.provinsi, b.kode_pos AS kodepos,
              e.name AS marketing_nama,
              e.phone AS marketing_phone
          FROM {$table_barcode} b
          LEFT JOIN wp_employee e ON b.employee_id = e.employee_id
          ORDER BY b.date_transaction DESC 
          LIMIT 50
    ");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard | Griya Djaya Sentosa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #fdfbf7;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            border-right: 1px solid #fde047;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        .logo-area {
            padding: 30px 20px;
            text-align: center;
        }
        .logo-area img {
            max-width: 60px;
            margin-bottom: 10px;
        }
        .logo-text {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 18px;
            color: #854d0e;
        }
        .menu-heading {
            padding: 20px 25px;
            font-weight: 700;
            font-size: 15px;
            color: #0f172a;
        }
        .menu-item {
            margin: 0 15px;
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            transition: 0.2s;
            display: block;
            text-decoration: none;
        }
        .menu-item.active {
            background: linear-gradient(90deg, #fef3c7 0%, #fde68a 100%);
            color: #92400e;
            box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.1);
        }
        .menu-item.inactive {
            background: transparent;
            color: #64748b;
        }
        .menu-item.inactive:hover {
            background: #f8fafc;
            color: #334155;
        }
        .logout {
            margin-top: auto;
            padding: 30px 25px;
        }
        .logout a {
            color: #0f172a;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 50px;
            overflow-y: auto;
        }
        .page-title {
            font-family: 'Playfair Display', serif;
            font-size: 32px;
            color: #78350f;
            margin-bottom: 25px;
            font-weight: 700;
        }
        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            font-weight: 500;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .alert.success { background-color: #fef3c7; color: #92400e; }
        .alert.error { background-color: #fee2e2; color: #991b1b; }

        .card {
            background: #ffffff;
            border: 1px solid #fde047;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }
        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 22px;
            color: #854d0e;
            margin-bottom: 25px;
            font-weight: 600;
        }

        /* Forms */
        .grid-1 { display: grid; grid-template-columns: 1fr; gap: 20px; margin-bottom: 20px; }
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 8px;
        }
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-family: inherit;
            font-size: 13px;
            color: #334155;
            outline: none;
            transition: 0.3s;
        }
        .form-control:focus { border-color: #ca8a04; }

        .btn {
            background: linear-gradient(135deg, #b45309 0%, #92400e 100%);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            font-family: inherit;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 4px 6px -1px rgba(146, 64, 14, 0.2);
        }
        .btn:hover { opacity: 0.9; }
        
        .btn-outline {
            background: transparent;
            border: 1px solid #ca8a04;
            color: #92400e;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            box-shadow: none;
            display: inline-block;
            margin-right: 5px;
        }
        .btn-outline:hover { background: #fef3c7; }

        /* Tables */
        .table-responsive { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th {
            background: #e5e5e5;
            padding: 12px 15px;
            text-transform: uppercase;
            font-size: 11px;
            color: #78350f;
            font-weight: 700;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #f1f5f9;
            color: #1e293b;
            font-weight: 600;
            font-size: 13px;
        }
        .badge {
            background: #e2e8f0;
            color: #334155;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 11px;
            white-space: nowrap;
        }
        .badge-1 { background: #e2e8f0; }
        .badge-2 { background: #fef08a; color: #854d0e; }
        .badge-3 { background: #bfdbfe; color: #1e40af; }
        .badge-4 { background: #fecaca; color: #991b1b; }
        .badge-5 { background: #bbf7d0; color: #166534; }
        
        .proof-btn {
            background: transparent;
            border: 1px solid #d97706;
            color: #b45309;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            text-decoration: none;
            display: inline-block;
            font-weight: 700;
        }
        
        .inline-edit-form {
            display: flex; flex-wrap: wrap; gap: 10px; padding: 15px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px;
        }
    
        .pagination-btn {
            background-color: #1e293b;
            color: #d4b572;
            border: 1px solid #334155;
            padding: 5px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
            font-family: 'Outfit', sans-serif;
            font-size: 13px;
        }
        .pagination-btn:hover:not(:disabled):not(.active) {
            background-color: #334155;
            color: #fde68a;
        }
        .pagination-btn.active {
            background-color: #d4b572;
            color: #0f172a;
            border-color: #d4b572;
            font-weight: bold;
            cursor: default;
        }
        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
                  </style>
    <!-- Select2 for searchable dropdowns -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .select2-container .select2-selection--single { height: 42px; border: 1px solid #cbd5e1; border-radius: 4px; padding: 6px; }
        .select2-container--default .select2-selection--single .select2-selection__arrow { height: 40px; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo-area">
            <!-- Fetch standard logo SVG -->
            <img src="<?php echo get_template_directory_uri(); ?>/svg/logo.svg" alt="Logo" style="filter: invert(34%) sepia(51%) saturate(735%) hue-rotate(1deg) brightness(91%) contrast(92%);">
            <div class="logo-text">Griya Djaya Sentosa</div>
        </div>
        
        <div class="menu-heading">Karyawan Portal</div>
        
        <?php $view = isset($_GET['view']) ? $_GET['view'] : 'dashboard'; ?>
        
        <a href="?view=dashboard" class="menu-item <?php echo $view === 'dashboard' ? 'active' : 'inactive'; ?>" style="margin-bottom: 10px;">Dashboard Utama</a>
        
        <?php if ($role === 1): ?>
        <a href="?view=add_employee" class="menu-item <?php echo $view === 'add_employee' ? 'active' : 'inactive'; ?>">Tambah Karyawan</a>
        <?php endif; ?>
        
        <div class="logout">
            <a href="#" onclick="event.preventDefault(); window.location.replace('?action=logout');">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:8px;"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                Log Out
            </a>
            <div style="font-size: 10px; color: #94a3b8; margin-top: 25px; opacity: 0.7;">&copy; cescrafli</div>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <h1 class="page-title">Selamat datang, <?php echo esc_html($_SESSION['emp_username']); ?>!</h1>

        <?php if ( ! empty( $message ) ) : ?>
            <div class="alert <?php echo $message_type; ?>">
                <?php echo esc_html($message); ?>
            </div>
        <?php endif; ?>

        <?php if ($view === 'add_employee' && $role === 1): ?>
            <div class="card">
                <h3 class="card-title">Tambah Akun Karyawan Baru</h3>
                <form action="?view=add_employee" method="POST">
                    <input type="hidden" name="action" value="add_employee_account">
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="emp_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="emp_username" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="emp_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Role / Jabatan</label>
                            <select name="emp_role" class="form-control" required>
                                <option value="1">1 - Karyawan Atas (Manajemen)</option>
                                <option value="2">2 - Karyawan Menengah (Edit/Hapus Transaksi)</option>
                                <option value="3">3 - Karyawan Bawah (Hanya Input Transaksi)</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nomor Telepon / WA</label>
                            <input type="text" name="emp_phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="emp_email" class="form-control" required>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label>Alamat Lengkap</label>
                            <textarea name="emp_address" class="form-control" rows="3" style="width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 6px; font-family: inherit; font-size: 13px; color: #334155; outline: none;" required></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn">Simpan Akun Karyawan</button>
                </form>
            </div>
            
        <?php else: ?>
        
        <!-- KHUSUS KARYAWAN ATAS (ANALITIK & KELOLA AKUN) -->
        <?php if ( $role === 1 ) : ?>
            <div class="card">
                <h3 class="card-title">Analitik Status Transaksi</h3>
                <form action="" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px; align-items: flex-end;">
                    <div style="flex: 1; max-width: 200px;">
                        <label style="font-size: 12px; font-weight: bold;">Dari Tanggal</label>
                        <input type="date" name="start_date" value="<?php echo esc_attr($start_date); ?>" class="form-control">
                    </div>
                    <div style="flex: 1; max-width: 200px;">
                        <label style="font-size: 12px; font-weight: bold;">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="<?php echo esc_attr($end_date); ?>" class="form-control">
                    </div>
                    <button type="submit" class="btn">Filter</button>
                </form>

                <?php
                // Process data for Timeseries Chart
                $dates_map = [];
                // Initialize range
                $current = strtotime($start_date);
                $end = strtotime($end_date);
                while ($current <= $end) {
                    $date_str = date('Y-m-d', $current);
                    $dates_map[$date_str] = ['Permintaan' => 0, 'Dikerjakan' => 0, 'Ditolak' => 0, 'Selesai' => 0];
                    $current = strtotime('+1 day', $current);
                }
                
                foreach($analytics_data as $data) {
                    $d = $data->req_date;
                    $st = $data->req_status;
                    if(isset($dates_map[$d]) && isset($dates_map[$d][$st])) {
                        $dates_map[$d][$st] = (int)$data->total;
                    }
                }
                
                $labels = array_keys($dates_map);
                $data_permintaan = array_column($dates_map, 'Permintaan');
                $data_dikerjakan = array_column($dates_map, 'Dikerjakan');
                $data_ditolak = array_column($dates_map, 'Ditolak');
                $data_selesai = array_column($dates_map, 'Selesai');
                ?>
                <div style="background: #ffffff; border: 1px solid #e5e7eb; padding: 20px; border-radius: 12px; height: 400px; margin-top: 10px;">
                    <canvas id="analyticsChart"></canvas>
                </div>
                
                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                document.addEventListener("DOMContentLoaded", function() {
    if(jQuery().select2) {
        $('#customer_id_select').select2({tags: true});
        $('#marketing_id_select').select2();
    }
                    const ctx = document.getElementById('analyticsChart').getContext('2d');
                  new Chart(ctx, {
                      type: 'line',
                      data: {
                          labels: <?php echo json_encode($labels); ?>,
                          datasets: [
                              {
                                  label: 'Dalam Permintaan',
                                  data: <?php echo json_encode($data_permintaan); ?>,
                                  borderColor: '#eab308', // Kuning
                                  backgroundColor: 'rgba(234, 179, 8, 0.1)',
                                  borderWidth: 2,
                                  fill: true,
                                  tension: 0.3
                              },
                              {
                                  label: 'Sedang Dikerjakan',
                                  data: <?php echo json_encode($data_dikerjakan); ?>,
                                  borderColor: '#3b82f6', // Biru
                                  backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                  borderWidth: 2,
                                  fill: true,
                                  tension: 0.3
                              },
                              {
                                  label: 'Penolakan',
                                  data: <?php echo json_encode($data_ditolak); ?>,
                                  borderColor: '#ef4444', // Merah
                                  backgroundColor: 'rgba(239, 68, 68, 0.1)',
                                  borderWidth: 2,
                                  fill: true,
                                  tension: 0.3
                              },
                              {
                                  label: 'Sudah Selesai',
                                  data: <?php echo json_encode($data_selesai); ?>,
                                  borderColor: '#22c55e', // Hijau
                                  backgroundColor: 'rgba(34, 197, 94, 0.1)',
                                  borderWidth: 2,
                                  fill: true,
                                  tension: 0.3
                              }
                          ]
                      },
                      options: {
                          responsive: true,
                          maintainAspectRatio: false,
                          interaction: {
                              mode: 'index',
                              intersect: false,
                          },
                          scales: {
                              y: {
                                  beginAtZero: true,
                                  ticks: { stepSize: 1 }
                              }
                          },
                          plugins: {
                              legend: { position: 'top' },
                              tooltip: {
                                  callbacks: {
                                      title: function(context) {
                                          return 'Tanggal: ' + context[0].label;
                                      }
                                  }
                              }
                          }
                      }
                  });
                });
                </script>
            </div>

            <div class="card">
                <h3 class="card-title">Daftar Karyawan Aktif</h3>
                <div class="table-responsive">
                    <table id="tableKaryawan">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($employees_list)): foreach($employees_list as $emp) : ?>
                            <tr>
                                <td><?php echo esc_html($emp->employee_id); ?></td>
                                <td><?php echo esc_html($emp->username); ?></td>
                                <td>
                                    <?php 
                                        if($emp->role == 1) echo 'Atas (Manajemen)';
                                        elseif($emp->role == 2) echo 'Menengah (Hapus/Edit)';
                                        else echo 'Bawah (Input Saja)';
                                    ?>
                                </td>
                                <td><?php echo $emp->status == 1 ? '<span class="badge badge-5">Aktif</span>' : '<span class="badge badge-4">Nonaktif</span>'; ?></td>
                                <td><?php echo $emp->last_login ? esc_html($emp->last_login) : 'Belum pernah'; ?></td>
                                <td>
                                    <?php if($emp->role != 1): ?>
                                    <form action="" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun ini permanen?');">
                                        <input type="hidden" name="action" value="delete_employee">
                                        <input type="hidden" name="target_emp_id" value="<?php echo esc_attr($emp->employee_id); ?>">
                                        <button type="submit" class="btn-outline" style="color:#dc2626; border-color:#dc2626;">Delete</button>
                                    </form>
                                    <?php else: ?>
                                        <span style="color:#94a3b8; font-size:11px;">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; else: ?>
                                <tr><td colspan="6">Tidak ada data.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- KHUSUS KARYAWAN MENENGAH DAN BAWAH (BISA INPUT DATA) -->
        <?php if ( $role === 2 || $role === 3 ) : ?>
            <div class="card">
                <h3 class="card-title">Input Transaksi Baru (Barcode)</h3>
                  <form action="" method="POST">
                      <input type="hidden" name="action" value="add_transaction">
                      
                      <div class="grid-2">
                          <div class="form-group">
                              <label>Nama Customer</label>
                              <select name="customer_id" id="customer_id_select" class="form-control" required style="width: 100%;">
                                  <option value="">-- Pilih / Ketik Customer --</option>
                                  <?php if(!empty($customers_list)): foreach($customers_list as $cust): ?>
                                      <option value="<?php echo esc_attr($cust->nama); ?>"><?php echo esc_html($cust->nama); ?></option>
                                  <?php endforeach; endif; ?>
                              </select>
                              <small style="color:#64748b; font-size:11px;">(Ketik nama baru jika belum ada)</small>
                          </div>
                          <div class="form-group">
                              <label>Marketing</label>
                              <select name="marketing_id" id="marketing_id_select" class="form-control select2" style="width:100%;" required>
                                  <option value="">-- Pilih Marketing --</option>
                                  <?php 
                                  $marketers = $wpdb->get_results("SELECT employee_id, name FROM wp_employee WHERE role IN (2,3) ORDER BY name ASC");
                                  foreach($marketers as $m): ?>
                                      <option value="<?php echo esc_attr($m->employee_id); ?>"><?php echo esc_html($m->employee_id . ' - ' . $m->name); ?></option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                      </div>
                      
                      <div class="grid-2">
                          <div class="form-group">
                              <label>No Penawaran</label>
                              <input type="text" name="no_penawaran" class="form-control" placeholder="No Penawaran">
                          </div>
                          <div class="form-group">
                              <label>Nilai Project</label>
                              <input type="text" name="nilai_project" class="form-control" placeholder="Contoh: Rp 10.000.000">
                          </div>
                      </div>
  
                      <div class="grid-1">
                          <div class="form-group">
                              <label>Material Description</label>
                              <input type="text" name="material_description" class="form-control" required>
                          </div>
                      </div>
                      
                      <div class="grid-2">
                          <div class="form-group">
                              <label>Date Transaction</label>
                              <input type="date" name="date_transaction" class="form-control" required>
                          </div>
                          <div class="form-group">
                              <label>Warranty Expired</label>
                              <input type="date" name="warranty_exp" class="form-control" required>
                          </div>
                      </div>
  
                      <div class="grid-2">
                          <div class="form-group">
                              <label>Phone Customer</label>
                              <input type="text" name="customer_phone" class="form-control" placeholder="Kosongkan untuk memakai data lama">
                          </div>
                          <div class="form-group">
                              <label>Email Customer</label>
                              <input type="email" name="customer_email" class="form-control" placeholder="Kosongkan untuk memakai data lama">
                          </div>
                      </div>
  
                      <div class="grid-2">
                          <div class="form-group" style="grid-column: span 2;">
                              <label>Location (Alamat)</label>
                              <input type="text" name="location" class="form-control" placeholder="Kosongkan untuk memakai data lama">
                          </div>
                          <div class="form-group">
                              <label>Kota</label>
                              <input type="text" name="kota" class="form-control" placeholder="Kosongkan untuk memakai data lama">
                          </div>
                          <div class="form-group">
                              <label>Provinsi</label>
                              <input type="text" name="provinsi" class="form-control" placeholder="Kosongkan untuk memakai data lama">
                          </div>
                          <div class="form-group">
                              <label>Kode Pos</label>
                              <input type="text" name="kodepos" class="form-control" placeholder="Kosongkan untuk memakai data lama">
                          </div>
                          <div class="form-group">
                              <label>Status</label>
                              <select name="status" class="form-control" required>
                                  <option value="1">1 - Belum ada pengajuan</option>
                                  <option value="2">2 - Dalam permintaan</option>
                                  <option value="3">3 - Sedang dalam pengerjaan</option>
                                  <option value="4">4 - Penolakan</option>
                                  <option value="5">5 - Sudah selesai</option>
                              </select>
                          </div>
                      </div>
                      
                      <button type="submit" class="btn" style="width: 100%; padding: 15px;">Simpan Transaksi</button>
                  </form>
            </div>
        <?php endif; ?>

        <!-- KHUSUS KARYAWAN MENENGAH (BISA HAPUS/EDIT DATA) -->
        <?php if ( $role === 2 ) : ?>
            
            <div class="card">
                <h3 class="card-title" style="margin-bottom: 15px;">Data Transaksi Terakhir</h3>
                  <div style="display: flex; align-items: center; justify-content: space-between; gap: 15px; border: 1px solid #d4b572; border-radius: 8px; padding: 10px; margin-bottom: 20px; flex-wrap: wrap; background: #fff;">
                      
                      <!-- Left side: Search & Status -->
                      <div style="display: flex; gap: 10px; flex: 1; min-width: 300px;">
                          <!-- Search Box with Icon -->
                          <div style="position: relative; flex: 1;">
                              <input type="text" id="searchTransaksi" class="form-control" placeholder="Cari transaksi (Nama, ID, dll)..." onkeyup="filterTableMulti('searchTransaksi', 'sliceTransaksi', 'tableTransaksi', 5)" style="width: 100%; border: 1px solid #d4b572; padding-right: 30px; border-radius: 6px; font-size: 13px;">
                              <i class="fa fa-search" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #d4b572; font-size: 14px;"></i>
                          </div>
                          
                          <!-- Status Dropdown -->
                          <select id="sliceTransaksi" class="form-control" style="width: 180px; border: 1px solid #1e293b; color: #1e293b; border-radius: 6px; font-size: 13px; font-weight: 500;" onchange="filterTableMulti('searchTransaksi', 'sliceTransaksi', 'tableTransaksi', 5)">
                              <option value="">Semua Status</option>
                              <option value="1 - ">Belum ada pengajuan</option>
                              <option value="2 - ">Dalam permintaan</option>
                              <option value="3 - ">Sedang dalam pengerjaan</option>
                              <option value="4 - ">Penolakan</option>
                              <option value="5 - ">Sudah selesai</option>
                          </select>
                      </div>

                      <!-- Right side: Actions -->
                      <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                          
                          <!-- Bulk Upload Form -->
                          <form method="POST" enctype="multipart/form-data" style="margin:0; display:flex; gap:10px; align-items: center;">
                              <input type="hidden" name="action" value="import_csv">
                              <input type="file" name="csv_file" accept=".csv" class="form-control" style="padding: 5px; font-size:12px; width:200px; border: 1px solid #e2e8f0; border-radius: 6px;" required>
                              <button type="submit" class="btn" style="background:#0f172a; color:#d4b572; padding: 10px 20px; font-size:13px; font-weight:600; border-radius: 6px; border:none; cursor:pointer; font-family: 'Outfit', sans-serif;">Bulk Upload</button>
                          </form>

                          <!-- Download CSV Form -->
                          <form method="POST" style="margin:0;">
                              <input type="hidden" name="action" value="export_csv">
                              <button type="submit" class="btn" style="background:#d4b572; color:#fff; padding: 10px 20px; font-size:13px; font-weight:600; border-radius: 6px; border:none; cursor:pointer; font-family: 'Outfit', sans-serif;">Download Template (CSV)</button>
                          </form>
                      </div>

                  </div>
                  <div class="table-responsive">
                    <table id="tableTransaksi">
                        <thead>
                            <tr>
                                <th>Barcode ID</th>
                                <th>No Penawaran</th>
                                <th>Nama Customer</th>
                                <th>Material</th>
                                <th>Tanggal</th>
                                <th>Garansi Exp</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Marketing</th>
                                <th>Phone Marketing</th>
                                <th>Location</th>
                                <th>Kota</th>
                                <th>Provinsi</th>
                                <th>Kode Pos</th>
                                <th>Nilai Project</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($transactions_list)): ?>
                                <tr><td colspan="17">Belum ada transaksi.</td></tr>
                            <?php else: ?>
                                <?php 
                                $status_map = [
                                    1 => '1 - Belum ada pengajuan',
                                    2 => '2 - Dalam permintaan',
                                    3 => '3 - Sedang dalam pengerjaan',
                                    4 => '4 - Penolakan',
                                    5 => '5 - Sudah selesai'
                                ];
                                foreach($transactions_list as $trx) : ?>
                                <tr id="view-<?php echo esc_attr($trx->BarcodeID); ?>">
                                    <td style="font-weight: 700;"><?php echo esc_html($trx->BarcodeID); ?></td>
                                    <td><?php echo esc_html($trx->no_penawaran); ?></td>
                                    <td><?php echo esc_html(($trx->SPKID ? $trx->SPKID . " - " : "") . $trx->customer_nama); ?></td>
                                    <td><?php echo esc_html($trx->material_description); ?></td>
                                    <td><?php echo esc_html($trx->date_transaction); ?></td>
                                    <td><?php echo esc_html($trx->warranty_exp); ?></td>
                                    <td><span class="badge badge-<?php echo esc_attr($trx->status); ?>"><?php echo esc_html(isset($status_map[$trx->status]) ? $status_map[$trx->status] : 'Status ' . $trx->status); ?></span></td>
                                    <td><?php echo esc_html($trx->customer_email); ?></td>
                                    <td><?php echo esc_html($trx->customer_phone); ?></td>
                                    <td><?php echo esc_html($trx->marketing_nama); ?></td>
                                    <td><?php echo esc_html($trx->marketing_phone); ?></td>
                                    <td><?php echo gjs_render_location($trx->lokasi); ?></td>
                                    <td><?php echo esc_html($trx->kota); ?></td>
                                    <td><?php echo esc_html($trx->provinsi); ?></td>
                                    <td><?php echo esc_html($trx->kodepos); ?></td>
                                    <td><?php $np = trim($trx->nilai_project); echo preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $np) ? number_format((float)$np, 0, ',', '.') : esc_html($np); ?></td>
                                    <td style="white-space: nowrap;">
                                        <button type="button" class="btn-outline" onclick="document.getElementById('view-<?php echo esc_attr($trx->BarcodeID); ?>').style.display='none'; document.getElementById('edit-<?php echo esc_attr($trx->BarcodeID); ?>').style.display='table-row';">Edit</button>
                                        <button type="button" class="btn-outline" data-info='<?php echo esc_attr(json_encode($trx)); ?>' onclick="printBarcode(this.dataset.info)">Print Kartu</button>
                                        <form action="" method="POST" onsubmit="return confirm('Hapus transaksi ini secara permanen?');" style="display:inline-block;">
                                            <input type="hidden" name="action" value="delete_transaction">
                                            <input type="hidden" name="barcodeID" value="<?php echo esc_attr($trx->BarcodeID); ?>">
                                            <button type="submit" class="btn-outline">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr id="edit-<?php echo esc_attr($trx->BarcodeID); ?>" style="display:none;">
                                    <td colspan="10" style="padding:0; border:none;">
                                        <div style="background-color: #f8fafc; padding: 15px; border-bottom: 1px solid #f1f5f9;">
                                            <form action="" method="POST" class="inline-edit-form">
    <input type="hidden" name="action" value="edit_transaction">
    <input type="hidden" name="original_barcodeID" value="<?php echo esc_attr($trx->BarcodeID); ?>">
    
    <!-- Top Row -->
    <div style="flex: 1; min-width: 120px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Barcode ID</span>
        <input type="text" name="barcodeID" value="<?php echo esc_attr($trx->BarcodeID); ?>" class="form-control" style="background:#e2e8f0; cursor:not-allowed;" readonly></label>
    </div>
    <div style="flex: 1; min-width: 120px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">No Penawaran</span>
        <input type="text" name="no_penawaran" value="<?php echo esc_attr($trx->no_penawaran); ?>" class="form-control"></label>
    </div>
    <div style="flex: 2; min-width: 150px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Material</span>
        <input type="text" name="material_description" value="<?php echo esc_attr($trx->material_description); ?>" class="form-control" required></label>
    </div>
    <div style="flex: 1; min-width: 120px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Tanggal</span>
        <input type="date" name="date_transaction" value="<?php echo esc_attr($trx->date_transaction); ?>" class="form-control" required></label>
    </div>
    <div style="flex: 1; min-width: 120px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Garansi Exp</span>
        <input type="date" name="warranty_exp" value="<?php echo esc_attr($trx->warranty_exp); ?>" class="form-control" required></label>
    </div>
    
    <!-- Customer Row -->
    <div style="flex: 1; min-width: 150px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Nama Customer</span>
        <input type="text" name="customer_nama" value="<?php echo esc_attr($trx->customer_nama); ?>" class="form-control"></label>
    </div>
    <div style="flex: 1; min-width: 120px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Phone Customer</span>
        <input type="text" name="customer_phone" value="<?php echo esc_attr($trx->customer_phone); ?>" class="form-control"></label>
    </div>
    <div style="flex: 1; min-width: 150px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Email Customer</span>
        <input type="email" name="customer_email" value="<?php echo esc_attr($trx->customer_email); ?>" class="form-control"></label>
    </div>
    
    <!-- Location Row -->
    <div style="flex: 2; min-width: 150px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Alamat Lengkap</span>
        <input type="text" name="location" value="<?php echo esc_attr($trx->lokasi); ?>" class="form-control"></label>
    </div>
    <div style="flex: 1; min-width: 120px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Kota</span>
        <input type="text" name="kota" value="<?php echo esc_attr($trx->kota); ?>" class="form-control"></label>
    </div>
    <div style="flex: 1; min-width: 120px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Provinsi</span>
        <input type="text" name="provinsi" value="<?php echo esc_attr($trx->provinsi); ?>" class="form-control"></label>
    </div>
    <div style="flex: 1; min-width: 100px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Kode Pos</span>
        <input type="text" name="kodepos" value="<?php echo esc_attr($trx->kodepos); ?>" class="form-control"></label>
    </div>
    
    <!-- Details Row -->
    <div style="flex: 1; min-width: 150px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Nilai Project</span>
        <input type="text" name="nilai_project" value="<?php echo esc_attr($trx->nilai_project); ?>" class="form-control"></label>
    </div>
    <div style="flex: 1; min-width: 150px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Marketing</span>
        <select name="employee_id" class="form-control">
            <?php 
            global $wpdb; 
            $mkts = $wpdb->get_results("SELECT employee_id, name FROM wp_employee WHERE role IN (2,3) ORDER BY name ASC");
            foreach($mkts as $m) {
                $sel = ($trx->employee_id == $m->employee_id) ? 'selected' : '';
                echo '<option value="'.esc_attr($m->employee_id).'" '.$sel.'>'.esc_html($m->employee_id . ' - ' . $m->name).'</option>';
            }
            ?>
        </select></label>
    </div>
    <div style="flex: 2; min-width: 180px;">
        <label class="form-group"><span style="font-size:10px;color:#64748b;display:block;">Status</span>
        <select name="status" class="form-control" required>
            <option value="1" <?php selected($trx->status, 1); ?>>1 - Belum ada pengajuan</option>
            <option value="2" <?php selected($trx->status, 2); ?>>2 - Dalam permintaan</option>
            <option value="3" <?php selected($trx->status, 3); ?>>3 - Sedang dalam pengerjaan</option>
            <option value="4" <?php selected($trx->status, 4); ?>>4 - Penolakan</option>
            <option value="5" <?php selected($trx->status, 5); ?>>5 - Sudah selesai</option>
        </select></label>
    </div>
    
    <div style="flex: 100%; text-align: right; margin-top: 5px;">
        <button type="button" class="btn-outline" style="border-color:#94a3b8; color:#64748b;" onclick="document.getElementById('edit-<?php echo esc_attr($trx->BarcodeID); ?>').style.display='none'; document.getElementById('view-<?php echo esc_attr($trx->BarcodeID); ?>').style.display='table-row';">Cancel</button>
        <button type="submit" class="btn" style="padding: 6px 15px; font-size:12px;">Save Changes</button>
    </div>
</form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- Data Pengajuan Garansi (ALL ROLES) -->
        <div class="card">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; margin-bottom: 20px; gap: 10px;">
                <h3 class="card-title" style="margin-bottom: 0;">Data Pengajuan Garansi</h3>
                <div style="display: flex; gap: 10px; flex: 1; justify-content: flex-end; flex-wrap: wrap;">
                    <select id="slicePengajuan" class="form-control" style="max-width: 200px;" onchange="filterTableMulti('searchPengajuan', 'slicePengajuan', 'tablePengajuan', 4)">
                        <option value="">Semua Jenis</option>
                        <option value="Klaim Garansi">Klaim Garansi</option>
                        <option value="Servis Berbayar">Servis Berbayar</option>
                        <option value="Konsultasi Kendala">Konsultasi Kendala</option>
                        <option value="Minta Sparepart">Minta Sparepart</option>
                        <option value="Other">Other</option>
                    </select>
                    <input type="text" id="searchPengajuan" class="form-control" placeholder="Cari pengajuan (Nama, ID, dll)..." onkeyup="filterTableMulti('searchPengajuan', 'slicePengajuan', 'tablePengajuan', 4)" style="max-width: 250px;">
                </div>
            </div>
            <div class="table-responsive">
                <table id="tablePengajuan">
                    <thead>
                        <tr>
                            <th>Barcode ID</th>
                            <th>Nama Customer</th>
                            <th>Material</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Jenis Pengajuan</th>
                            <th>Phone</th>
                            <th>Phone Alternatif</th>
                            <th>Lokasi</th>
                            <th>Kota</th>
                            <th>Provinsi</th>
                            <th>Kode Pos</th>
                            <th>Lokasi Alternatif</th>
                            <th>Deskripsi</th>
                            <th>Foto Bukti</th>
                            <th>Tanggal Penyelesaian</th>
                            <th>Deskripsi Pekerjaan</th>
                            <th>Foto Hasil</th>
                            <th>Description Decline</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($requests_list)): ?>
                            <tr><td colspan="19" style="text-align:center; color:#94a3b8;">Belum ada data pengajuan.</td></tr>
                        <?php else: foreach($requests_list as $req): ?>
                            <tr>
                                <td style="font-weight:700; color:#b45309;"><?php echo esc_html($req->barcodeid); ?></td>
                                <td><?php echo esc_html(($req->spk_id ? $req->spk_id . " - " : "") . $req->customer_nama); ?></td>
                                <td><?php echo esc_html($req->material); ?></td>
                                <td style="white-space: nowrap;"><?php echo date('d M Y H:i', strtotime($req->created_at)); ?></td>
                                <td>
                                    <?php
                                        $cat_text = 'Other';
                                        if ($req->category == 1) $cat_text = 'Klaim Garansi';
                                        elseif ($req->category == 2) $cat_text = 'Servis Berbayar';
                                        elseif ($req->category == 3) $cat_text = 'Konsultasi Kendala';
                                        elseif ($req->category == 4) $cat_text = 'Minta Sparepart';
                                        
                                        echo '<div style="display:flex; flex-direction:column; align-items:flex-start; gap:4px;">';
                                        echo '<span class="badge badge-1">' . esc_html($cat_text) . '</span>';
                                        if (!empty($req->claim_warranty)) {
                                            echo '<span style="font-size:10px; font-weight:700; color:#b45309; white-space:nowrap;">(Ke-' . esc_html($req->claim_warranty) . ')</span>';
                                        }
                                        echo '</div>';
                                    ?>
                                </td>
                                <td><?php echo esc_html($req->cust_phone); ?></td>
                                <td><?php echo esc_html($req->phone); ?></td>
                                <td><?php echo gjs_render_location($req->cust_location); ?></td>
                                <td><?php echo esc_html($req->cust_kota); ?></td>
                                <td><?php echo esc_html($req->cust_provinsi); ?></td>
                                <td><?php echo esc_html($req->cust_kode_pos); ?></td>
                                <td><?php echo gjs_render_location($req->lokasi); ?></td>
                                <td style="max-width:150px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="<?php echo esc_attr($req->deskripsi); ?>"><?php echo esc_html($req->deskripsi); ?></td>
                                <td>
                                    <div style="display:flex; gap:5px; flex-wrap:wrap;">
                                        <?php 
                                        $proofs = [$req->proof_1, $req->proof_2, $req->proof_3, $req->proof_4, $req->proof_5];
                                        $p_count = 1;
                                        foreach($proofs as $p) {
                                            if(!empty($p)) {
                                                echo '<a href="javascript:void(0);" onclick="openModal(\''.esc_url($p).'\')" class="proof-btn">#'.$p_count.'</a>';
                                            }
                                            $p_count++;
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td style="white-space: nowrap;"><?php echo !empty($req->date_repaired) && $req->date_repaired != '0000-00-00' ? esc_html(date('d M Y', strtotime($req->date_repaired))) : '-'; ?></td>
                                <td style="max-width:150px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="<?php echo esc_attr($req->description_warranty); ?>"><?php echo esc_html($req->description_warranty ? $req->description_warranty : '-'); ?></td>
                                <td>
                                    <div style="display:flex; gap:5px; flex-wrap:wrap;">
                                        <?php 
                                        $proofs_selesai = [$req->proof_warranty_1, $req->proof_warranty_2, $req->proof_warranty_3, $req->proof_warranty_4, $req->proof_warranty_5];
                                        $ps_count = 1;
                                        foreach($proofs_selesai as $ps) {
                                            if(!empty($ps)) {
                                                echo '<a href="javascript:void(0);" onclick="openModal(\''.esc_url($ps).'\')" class="proof-btn">#'.$ps_count.'</a>';
                                            }
                                            $ps_count++;
                                        }
                                        if (empty(array_filter($proofs_selesai))) {
                                            echo '-';
                                        }
                                        ?>
                                    </div>
                                </td>
                                <td style="max-width:150px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="<?php echo esc_attr($req->description_decline); ?>"><?php echo esc_html($req->description_decline ? $req->description_decline : '-'); ?></td>
                                <td>
                                    <div style="display:flex; gap:5px; flex-wrap:wrap;">
                                        <?php if (!empty($req->date_repaired) && $req->date_repaired != '0000-00-00'): ?>
                                            <span style="color:#10b981; font-weight:600; font-size:12px;">Selesai</span>
                                        <?php elseif (!empty($req->description_decline)): ?>
                                            <span style="color:#ef4444; font-weight:600; font-size:12px;">Ditolak</span>
                                        <?php elseif ($req->barcode_status == 3): ?>
                                            <button type="button" class="btn-outline" style="background-color: #3b82f6; color: white; border: none; padding: 5px 10px;" onclick="openSelesaiModal('<?php echo esc_js($req->barcodeid); ?>', '<?php echo esc_js($req->id); ?>')">Selesai</button>
                                        <?php else: ?>
                                            <button type="button" class="btn-outline" style="background-color: #10b981; color: white; border: none; padding: 5px 10px;" onclick="approveRequest('<?php echo esc_js($req->barcodeid); ?>', '<?php echo esc_js($req->customer_nama); ?>', '<?php echo esc_js($req->material); ?>', '<?php echo esc_js(date('d M Y H:i', strtotime($req->created_at))); ?>', '<?php echo esc_js($cat_text); ?>', '<?php echo esc_js($req->phone); ?>', '<?php echo esc_js($req->lokasi); ?>', '<?php echo esc_js($req->deskripsi); ?>', '<?php echo esc_js(implode(', ', array_filter([$req->proof_1, $req->proof_2, $req->proof_3, $req->proof_4, $req->proof_5]))); ?>')">Approve</button>
                                            <button type="button" class="btn-outline" style="background-color: #ef4444; color: white; border: none; padding: 5px 10px;" onclick="openDeclineModal('<?php echo esc_js($req->barcodeid); ?>', '<?php echo esc_js($req->phone ? $req->phone : $req->cust_phone); ?>', '<?php echo esc_js($req->customer_email); ?>', '<?php echo esc_js($req->customer_nama); ?>', '<?php echo esc_js($req->id); ?>')">Decline</button>
                                        <?php endif; ?>
                                        
                                        <form id="form_approve_<?php echo esc_attr($req->barcodeid); ?>" method="POST" style="display:none;">
                                            <input type="hidden" name="action" value="approve_request">
                                            <input type="hidden" name="barcode_id" value="<?php echo esc_attr($req->barcodeid); ?>">
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    
        <?php endif; ?> <!-- End of view check -->
        <!-- Image Modal -->
        <div id="imageModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.8); align-items:center; justify-content:center; backdrop-filter: blur(5px);">
            <span style="position:absolute; top:20px; right:35px; color:#f1f1f1; font-size:40px; font-weight:bold; cursor:pointer; transition:0.3s;" onclick="closeModal()" onmouseover="this.style.color='#fde047'" onmouseout="this.style.color='#f1f1f1'">&times;</span>
            <img id="modalImg" style="margin:auto; display:block; max-width:90%; max-height:90%; border-radius:8px; box-shadow: 0 10px 25px rgba(0,0,0,0.5);">
        </div>
    </main>

    <!-- Canvas tersembunyi untuk merender Barcode sebelum diprint -->
    <canvas id="hiddenBarcodeCanvas" style="display:none;"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    
    <script>
    

    

        function printBarcode(infoStr) {
    function toTitleCase(str) {
        if(!str) return "-";
        return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
    }
        var info = JSON.parse(infoStr);
        var barcodeId = info.BarcodeID;
        
        // Buat QR Code yang mengarah ke link warranty
        var qrCanvas = document.createElement('canvas');
        var qr = new QRious({
            element: qrCanvas,
            value: 'https://griyadjayasentosa.id/warranty/?id=' + barcodeId,
            size: 250,
            level: 'M'
        });
        var barcodeDataUrl = qrCanvas.toDataURL();
        
        var noSpk = info.SPKID || "-";
        var merk = toTitleCase(info.material_description);
        
        var tgl = "-";
        if (info.date_transaction && info.date_transaction !== "0000-00-00") {
            var dateObj = new Date(info.date_transaction);
            var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            tgl = dateObj.getDate() + ' ' + months[dateObj.getMonth()] + ' ' + dateObj.getFullYear();
        }
        
        var nama = toTitleCase(info.customer_nama);
        var alamat = toTitleCase(info.lokasi);
        
        var kotaPart = toTitleCase([info.kota, info.provinsi, info.kodepos].filter(Boolean).join(" / "));
        if (!kotaPart) kotaPart = "-";
        
        var telp = info.customer_phone || "-";
        var email = info.customer_email || "-";
        var marketing = toTitleCase(info.marketing_nama);
        var telpMark = info.marketing_phone || "-";
        
        var siteUrl = "<?php echo get_template_directory_uri(); ?>";
        var imgFront = siteUrl + "/img/warranty_front.png?v=" + new Date().getTime();
        var imgBack = siteUrl + "/img/warranty_back.png?v=" + new Date().getTime();
        
        var html = `<html>
        <head>
            <title>Print Kartu Garansi - ${barcodeId}</title>
            <style>
                @page { size: 1024px 721px landscape; margin: 0; }
                body { margin: 0; padding: 0; font-family: 'Arial', sans-serif; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
                .page { width: 1024px; height: 721px; position: relative; background-size: cover; background-repeat: no-repeat; page-break-after: always; overflow: hidden; }
                .text-val { position: absolute; font-size: 19px; color: #000; font-weight: 500; }
                  .capitalize { text-transform: capitalize; }
                  .lowercase { text-transform: lowercase; }
                
                /* Specific positions based on the 1024x721 image */
                .val-spk { top: 148px; left: 225px; font-weight: bold; }
                .val-merk { top: 185px; left: 225px; }
                
                .val-tgl { top: 231px; left: 270px; }
                .val-nama { top: 269px; left: 270px; }
                .val-alamat { top: 307px; left: 270px; width: 730px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
                .val-kota { top: 346px; left: 270px; }
                .val-telp { top: 382px; left: 270px; }
                .val-email { top: 419px; left: 270px; }
                .val-marketing { top: 455px; left: 270px; }
                .val-telpmark { top: 491px; left: 270px; }
                
                .barcode-container { position: absolute; bottom: 90px; left: 38px; width: 100px; height: 100px; background: transparent; border: none; padding: 0; box-sizing: border-box; display: flex; align-items: center; justify-content: center; }
                .barcode-container img { width: 100px; height: 100px; object-fit: contain; border: 2px solid #a68a3f; padding: 3px; background: white; box-sizing: border-box; }
                  .signature-line { position: absolute; bottom: 95px; right: 35px; width: 190px; border-top: 1px solid #000; }
              </style>
        </head>
        <body>
            <!-- FRONT PAGE -->
            <div class="page" style="background-image: url('${imgFront}');">
                <div class="text-val val-spk">${noSpk}</div>
                <div class="text-val val-merk">${merk}</div>
                
                <div class="text-val val-tgl">${tgl}</div>
                <div class="text-val val-nama">${nama}</div>
                <div class="text-val val-alamat">${alamat}</div>
                <div class="text-val val-kota">${kotaPart}</div>
                <div class="text-val val-telp">${telp}</div>
                <div class="text-val val-email lowercase">${email}</div>
                <div class="text-val val-marketing">${marketing}</div>
                <div class="text-val val-telpmark">${telpMark}</div>
                  <div class="signature-line"></div>
                  <div class="barcode-container"><img src="${barcodeDataUrl}" /></div>
                  <div style="position: absolute; bottom: 35px; left: 38px; font-size: 12px; font-family: 'Arial', sans-serif; line-height: 1.4; color: #333;">
                      <table style="border:none; border-collapse: collapse; margin: 0; padding: 0;">
                          <tr><td style="padding:0 8px 0 0; border:none; font-style:italic;">Telp</td><td style="padding:0; border:none; font-style:italic;">: 08111021088</td></tr>
                          <tr><td style="padding:0 8px 0 0; border:none; font-style:italic;">Website</td><td style="padding:0; border:none; font-style:italic;">: https://griyadjayasentosa.id/</td></tr>
                          <tr><td style="padding:0 8px 0 0; border:none; font-style:italic;">Email</td><td style="padding:0; border:none; font-style:italic;">: griyadjayaupvc@gmail.com</td></tr>
                      </table>
                  </div>
            </div>
            
            <!-- BACK PAGE -->
            <div class="page" style="background-image: url('${imgBack}');"></div>
        
</body>
        </html>`;
        
        var printWindow = window.open('', '_blank', 'width=1050,height=750');
        printWindow.document.write(html);
        printWindow.document.close();
        
        setTimeout(function() {
            printWindow.focus();
            printWindow.print();
        }, 800);
    }

    
    // Pagination and Filtering Logic
    const configRowsPerPage = 10;
    const tableStates = {};

    function initTablePagination(tableId) {
        const table = document.getElementById(tableId);
        if (!table) return;
        
        tableStates[tableId] = {
            currentPage: 1,
            rowsPerPage: configRowsPerPage,
            table: table
        };
        
        // Create pagination container
        const paginationDiv = document.createElement('div');
        paginationDiv.className = 'pagination-container';
        paginationDiv.id = 'pagination-' + tableId;
        paginationDiv.style.display = 'flex';
        paginationDiv.style.justifyContent = 'flex-end';
        paginationDiv.style.marginTop = '15px';
        paginationDiv.style.gap = '5px';
        
        table.parentNode.insertBefore(paginationDiv, table.nextSibling);
        
        // Initial setup for empty row class
        const tbody = table.getElementsByTagName("tbody")[0];
        if (tbody) {
            const tr = tbody.getElementsByTagName("tr");
            if (tr.length === 1 && tr[0].getElementsByTagName("td").length === 1 && tr[0].getElementsByTagName("td")[0].colSpan > 4) {
                tr[0].classList.add('no-data-row');
            }
        }
        
        updateTableView(tableId);
    }

    function filterTableMulti(inputId, selectId, tableId, sliceColIndex) {
        var input = document.getElementById(inputId);
        var select = document.getElementById(selectId);
        
        var filterText = input ? input.value.toLowerCase() : "";
        var filterSlice = select ? select.value.toLowerCase() : "";
        
        var table = document.getElementById(tableId);
        var tr = table.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
        
        for (var i = 0; i < tr.length; i++) {
            if (tr[i].id && tr[i].id.startsWith('edit-')) continue;
            if (tr[i].classList.contains('no-data-row')) continue;
            
            var matchText = false;
            var matchSlice = false;
            var td = tr[i].getElementsByTagName("td");
            
            // Check Slice
            if (sliceColIndex !== null && td[sliceColIndex]) {
                var sliceValue = td[sliceColIndex].textContent || td[sliceColIndex].innerText;
                if (filterSlice === "" || sliceValue.toLowerCase().indexOf(filterSlice) > -1) {
                    matchSlice = true;
                }
            } else {
                matchSlice = true; // No slice filter
            }
            
            // Check Search
            if (filterText === "") {
                matchText = true;
            } else {
                for (var j = 0; j < td.length; j++) {
                    if (td[j]) {
                        var txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toLowerCase().indexOf(filterText) > -1) {
                            matchText = true;
                            break;
                        }
                    }
                }
            }
            
            if (matchText && matchSlice) {
                tr[i].classList.remove('filtered-out');
            } else {
                tr[i].classList.add('filtered-out');
            }
        }
        
        // Reset to page 1 on search
        if (tableStates[tableId]) {
            tableStates[tableId].currentPage = 1;
            updateTableView(tableId);
        }
    }

    function updateTableView(tableId) {
        const state = tableStates[tableId];
        const tbody = state.table.getElementsByTagName("tbody")[0];
        if (!tbody) return;
        
        const tr = tbody.getElementsByTagName("tr");
        
        // Collect visible rows (not filtered out and not edit rows)
        const visibleRows = [];
        for (let i = 0; i < tr.length; i++) {
            if (tr[i].id && tr[i].id.startsWith('edit-')) {
                tr[i].style.display = "none"; // Hide edit rows by default on redraw
                continue;
            }
            if (tr[i].classList.contains('no-data-row')) {
                tr[i].style.display = ""; // Always show empty state if present
                continue;
            }
            
            if (!tr[i].classList.contains('filtered-out')) {
                visibleRows.push(tr[i]);
            } else {
                tr[i].style.display = "none";
            }
        }
        
        const totalRows = visibleRows.length;
        const totalPages = Math.ceil(totalRows / state.rowsPerPage) || 1;
        
        if (state.currentPage > totalPages) state.currentPage = totalPages;
        if (state.currentPage < 1) state.currentPage = 1;
        
        const start = (state.currentPage - 1) * state.rowsPerPage;
        const end = start + state.rowsPerPage;
        
        for (let i = 0; i < totalRows; i++) {
            if (i >= start && i < end) {
                visibleRows[i].style.display = "";
            } else {
                visibleRows[i].style.display = "none";
            }
        }
        
        renderPagination(tableId, totalPages);
    }

    function renderPagination(tableId, totalPages) {
        const state = tableStates[tableId];
        const container = document.getElementById('pagination-' + tableId);
        container.innerHTML = '';
        
        if (totalPages <= 1) return; // No pagination needed
        
        const createBtn = (text, page, disabled, active) => {
            const btn = document.createElement('button');
            btn.innerHTML = text;
            btn.className = 'pagination-btn';
            if (disabled) btn.disabled = true;
            if (active) btn.classList.add('active');
            
            if (!disabled && !active) {
                btn.onclick = () => {
                    state.currentPage = page;
                    updateTableView(tableId);
                };
            }
            return btn;
        };
        
        // Prev
        container.appendChild(createBtn('Prev', state.currentPage - 1, state.currentPage === 1, false));
        
        // Numbers
        for (let i = 1; i <= totalPages; i++) {
            container.appendChild(createBtn(i, i, false, i === state.currentPage));
        }
        
        // Next
        container.appendChild(createBtn('Next', state.currentPage + 1, state.currentPage === totalPages, false));
    }

    // Initialize all tables on load
    document.addEventListener("DOMContentLoaded", function() {
    if(jQuery().select2) {
        $('#customer_id_select').select2({tags: true});
        $('#marketing_id_select').select2();
    }
        initTablePagination('tableKaryawan');
        initTablePagination('tableTransaksi');
        initTablePagination('tablePengajuan');
    });


    function filterTable(inputId, tableId) {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById(inputId);
        filter = input.value.toLowerCase();
        table = document.getElementById(tableId);
        tr = table.getElementsByTagName("tr");
        
        for (i = 1; i < tr.length; i++) {
            // Ignore edit rows
            if (tr[i].id && tr[i].id.startsWith('edit-')) continue;
            
            tr[i].style.display = "none";
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break;
                    }
                }
            }
        }
    }

    function openModal(imgSrc) {
        var modal = document.getElementById('imageModal');
        var modalImg = document.getElementById('modalImg');
        modal.style.display = "flex";
        modalImg.src = imgSrc;
    }

    function closeModal() {
        document.getElementById('imageModal').style.display = "none";
    }
    
    // Close modal if clicked outside the image
    window.onclick = function(event) {
        var modal = document.getElementById('imageModal');
        if (event.target == modal) {
            closeModal();
        }
    }
    </script>

<!-- Decline Modal -->
<div id="declineModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; padding:20px; border-radius:8px; width:90%; max-width:400px; box-shadow:0 10px 25px rgba(0,0,0,0.2);">
        <h4 style="margin-top:0; font-weight:700;">Alasan Penolakan</h4>
        <form method="POST" action="" id="declineForm" onsubmit="return handleDeclineSubmit()">
            <input type="hidden" name="action" value="decline_request">
            <input type="hidden" name="barcode_id" id="decline_barcode_id" value="">
            <input type="hidden" name="request_id" id="decline_request_id" value="">
            <input type="hidden" name="cust_phone" id="decline_cust_phone" value="">
            <input type="hidden" name="cust_email" id="decline_cust_email" value="">
            <input type="hidden" id="decline_cust_name" value="">
            <div style="margin-bottom:15px;">
                <textarea name="alasan_penolakan" id="decline_alasan" rows="4" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:4px;" placeholder="Tuliskan alasan penolakan agar customer tahu..." required></textarea>
            </div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <button type="button" onclick="document.getElementById('declineModal').style.display='none'" style="padding:8px 15px; border:1px solid #cbd5e1; background:transparent; border-radius:4px; cursor:pointer;">Batal</button>
                <button type="submit" style="padding:8px 15px; background:#ef4444; color:#fff; border:none; border-radius:4px; cursor:pointer;">Kirim Penolakan</button>
            </div>
        </form>
    </div>
</div>

<script>
function approveRequest(barcodeId, customerName, material, dateReq, typeReq, phone, location, desc, photoUrls) {
    if (confirm("Setujui pengajuan " + barcodeId + "? (Pesan WhatsApp persetujuan akan otomatis dikirim ke Customer)")) {
        document.getElementById('form_approve_' + barcodeId).submit();
    }
}

function openDeclineModal(barcodeId, custPhone, custEmail, custName, reqId) {
    document.getElementById('decline_barcode_id').value = barcodeId;
    document.getElementById('decline_request_id').value = reqId;
    document.getElementById('decline_cust_phone').value = custPhone;
    document.getElementById('decline_cust_email').value = custEmail;
    document.getElementById('decline_cust_name').value = custName;
    document.getElementById('declineModal').style.display = 'flex';
}

function handleDeclineSubmit() {
    return true; // continue submitting form to PHP
}
</script>




<!-- Selesai Modal -->
<div id="selesaiModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; align-items:center; justify-content:center;">
    <div style="background:#fff; padding:20px; border-radius:8px; width:90%; max-width:500px; box-shadow:0 10px 25px rgba(0,0,0,0.2);">
        <h4 style="margin-top:0; font-weight:700;">Penyelesaian Pekerjaan</h4>
        <form method="POST" action="" enctype="multipart/form-data" id="selesaiForm">
            <input type="hidden" name="action" value="selesai_request">
            <input type="hidden" name="barcode_id" id="selesai_barcode_id" value="">
            <input type="hidden" name="request_id" id="selesai_request_id" value="">
            
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:12px;">Tanggal Penyelesaian</label>
                <input type="date" name="selesai_tanggal" class="form-control" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:4px;" required>
            </div>
            
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:12px;">Deskripsi Pekerjaan</label>
                <textarea name="selesai_deskripsi" rows="3" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:4px;" placeholder="Tuliskan apa saja yang sudah dikerjakan..." required></textarea>
            </div>
            
            <div style="margin-bottom:15px;">
                <label style="display:block; margin-bottom:5px; font-weight:600; font-size:12px;">Foto Hasil (Bisa Pilih Banyak)</label>
                <input type="file" id="selesai_foto_input" accept="image/*" multiple style="margin-bottom:10px;">
                <!-- Hidden input to store actual files to submit -->
                <input type="file" name="selesai_foto[]" id="selesai_foto_real" multiple style="display:none;">
                
                <div id="selesai_preview_container" style="display:flex; flex-wrap:wrap; gap:10px; margin-top:10px;">
                    <!-- Previews will go here -->
                </div>
            </div>
            
            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
                <button type="button" onclick="document.getElementById('selesaiModal').style.display='none'" style="padding:8px 15px; border:1px solid #cbd5e1; background:transparent; border-radius:4px; cursor:pointer;">Batal</button>
                <button type="submit" style="padding:8px 15px; background:#3b82f6; color:#fff; border:none; border-radius:4px; cursor:pointer;">Simpan & Selesai</button>
            </div>
        </form>
    </div>
</div>

<script>
function openSelesaiModal(barcodeId, reqId) {
    document.getElementById('selesai_barcode_id').value = barcodeId;
    document.getElementById('selesai_request_id').value = reqId;
    document.getElementById('selesaiModal').style.display = 'flex';
}

// JS to handle image previews and deletion
const dt = new DataTransfer(); // Allows manipulating FileList

document.getElementById('selesai_foto_input').addEventListener('change', function(e) {
    const container = document.getElementById('selesai_preview_container');
    const realInput = document.getElementById('selesai_foto_real');
    
    for(let i = 0; i < this.files.length; i++) {
        let fileBlock = document.createElement('div');
        fileBlock.style = 'position:relative; width:80px; height:80px; border:1px solid #ddd; border-radius:4px; overflow:hidden;';
        
        let img = document.createElement('img');
        img.src = URL.createObjectURL(this.files[i]);
        img.style = 'width:100%; height:100%; object-fit:cover;';
        
        let delBtn = document.createElement('button');
        delBtn.innerHTML = '&times;';
        delBtn.style = 'position:absolute; top:2px; right:2px; background:red; color:white; border:none; border-radius:50%; width:20px; height:20px; cursor:pointer; font-size:12px; line-height:1; padding:0;';
        
        // Add to DataTransfer
        dt.items.add(this.files[i]);
        let fileIndex = dt.items.length - 1;
        
        delBtn.onclick = function() {
            container.removeChild(fileBlock);
            dt.items.remove(fileIndex);
            realInput.files = dt.files; // update real input
        };
        
        fileBlock.appendChild(img);
        fileBlock.appendChild(delBtn);
        container.appendChild(fileBlock);
    }
    
    realInput.files = dt.files;
    this.value = ''; // clear visual input so same files can be selected again
});

document.getElementById('selesaiForm').addEventListener('submit', function(e) {
    if (dt.files.length < 3 || dt.files.length > 5) {
        e.preventDefault();
        alert('Mohon upload minimal 3 foto dan maksimal 5 foto pengerjaan.');
    }
});
</script>

</body>

</html>
