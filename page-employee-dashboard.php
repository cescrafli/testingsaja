<?php
/**
 * Template Name: Employee Dashboard
 */

session_start();

// Cek apakah user sudah login
if ( ! isset( $_SESSION['emp_id'] ) || ! isset( $_SESSION['emp_role'] ) ) {
    wp_redirect( home_url( '/griyadjayamasuk/' ) ); // Redirect ke halaman rahasia
    exit;
}

$role = (int) $_SESSION['emp_role'];
$emp_id = $_SESSION['emp_id'];

global $wpdb;
$table_barcode = 'wp_barcode';
$table_employee = 'wp_employee';
$table_customer = 'wp_customer';

$message = '';
$message_type = 'success';

// Handle Actions (POST)
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
    $action = isset( $_POST['action'] ) ? sanitize_text_field( $_POST['action'] ) : '';

    // INSERT TRANSACTION (Role 2 & 3)
    if ( $action === 'add_transaction' && ( $role === 2 || $role === 3 ) ) {
        $barcodeID = sanitize_text_field($_POST['barcodeID']);
        $material = sanitize_text_field($_POST['material_description']);
        $status = (int) $_POST['status'];
        $date_trx = sanitize_text_field($_POST['date_transaction']);
        $warranty = sanitize_text_field($_POST['warranty_exp']);
        $customer_id = (int) $_POST['customer_id'];
        
        $inserted = $wpdb->insert(
            $table_barcode,
            array(
                'barcodeID' => $barcodeID,
                'material_description' => $material,
                'status' => $status,
                'date_transaction' => $date_trx,
                'warranty_exp' => $warranty,
                'customer_id' => $customer_id,
                'employee_id' => $emp_id
            )
        );
        
        if($inserted) {
            $message = "Transaksi $barcodeID berhasil ditambahkan!";
        } else {
            $message = "Gagal menambahkan transaksi.";
            $message_type = 'error';
        }
    }

    // DELETE TRANSACTION (Role 2 Only)
    if ( $action === 'delete_transaction' && $role === 2 ) {
        $del_id = sanitize_text_field($_POST['barcodeID']);
        $wpdb->delete( $table_barcode, array( 'barcodeID' => $del_id ) );
        $message = "Transaksi $del_id berhasil dihapus!";
    }

    // DEACTIVATE EMPLOYEE (Role 1 Only)
    if ( $action === 'deactivate_employee' && $role === 1 ) {
        $target_id = (int) $_POST['target_emp_id'];
        // Hanya bisa menonaktifkan role 2 dan 3
        $wpdb->query( $wpdb->prepare("UPDATE {$table_employee} SET status = 2 WHERE employee_id = %d AND role IN (2,3)", $target_id) );
        $message = "Akun karyawan berhasil dinonaktifkan!";
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
$start_date = isset($_GET['start_date']) ? sanitize_text_field($_GET['start_date']) : date('Y-m-01'); // Default awal bulan
$end_date = isset($_GET['end_date']) ? sanitize_text_field($_GET['end_date']) : date('Y-m-d'); // Default hari ini

if ( $role === 1 ) {
    // KARYAWAN ATAS
    // 1. Analitik Transaksi
    $analytics_data = $wpdb->get_results( $wpdb->prepare("
        SELECT status, COUNT(*) as count 
        FROM {$table_barcode} 
        WHERE date_transaction >= %s AND date_transaction <= %s 
        GROUP BY status
    ", $start_date, $end_date) );
    
    // 2. Data Karyawan (Last Login)
    $employees_list = $wpdb->get_results("SELECT employee_id, username, role, status, last_login FROM {$table_employee} ORDER BY role ASC");
} elseif ( $role === 2 ) {
    // KARYAWAN MENENGAH
    // Ambil list transaksi untuk bisa dihapus
    $transactions_list = $wpdb->get_results("SELECT barcodeID, material_description, status, date_transaction FROM {$table_barcode} ORDER BY date_transaction DESC LIMIT 50");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard | Griya Djaya Sentosa</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Outfit', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #f8fafc;
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 280px;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255,255,255,0.1);
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }
        .sidebar img { width: 60px; margin-bottom: 1rem; }
        .sidebar h2 { font-size: 1.25rem; color: #b69b32; margin-bottom: 0.25rem; }
        .sidebar p { color: #94a3b8; font-size: 0.9rem; margin-bottom: 2rem; }
        .sidebar-menu { list-style: none; flex: 1; }
        .sidebar-menu li { margin-bottom: 0.5rem; }
        .sidebar-menu a {
            display: block; padding: 0.75rem 1rem; color: #cbd5e1; text-decoration: none;
            border-radius: 8px; transition: 0.3s; font-weight: 500;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background: rgba(182, 155, 50, 0.2); color: #b69b32;
        }
        .logout-btn {
            background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);
            width: 100%; padding: 0.75rem; border-radius: 8px; cursor: pointer; font-family: inherit;
            font-weight: 600; transition: 0.3s; text-align: center; margin-top: auto;
        }
        .logout-btn:hover { background: #ef4444; color: #fff; }

        /* Main Content */
        .main-content {
            flex: 1; padding: 2.5rem; overflow-y: auto; height: 100vh;
        }
        .header-title { font-size: 1.8rem; margin-bottom: 2rem; color: #fff; }
        
        .alert {
            padding: 1rem; border-radius: 8px; margin-bottom: 2rem;
            background: rgba(16, 185, 129, 0.2); border: 1px solid #10b981; color: #6ee7b7;
        }
        .alert.error { background: rgba(239, 68, 68, 0.2); border-color: #ef4444; color: #fca5a5; }

        /* Card (Glassmorphism) */
        .card {
            background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px); border-radius: 16px; padding: 1.5rem; margin-bottom: 2rem;
        }
        .card h3 { color: #b69b32; margin-bottom: 1.5rem; font-size: 1.25rem; }

        /* Forms & Tables */
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-size: 0.85rem; color: #94a3b8; margin-bottom: 0.5rem; }
        .form-control {
            width: 100%; padding: 0.75rem 1rem; background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 8px; color: #fff; font-family: inherit;
        }
        .form-control:focus { outline: none; border-color: #b69b32; }
        .btn {
            background: #b69b32; color: #fff; border: none; padding: 0.75rem 1.5rem; border-radius: 8px;
            cursor: pointer; font-weight: 600; font-family: inherit; transition: 0.3s;
        }
        .btn:hover { background: #8e7825; }
        .btn-danger { background: #ef4444; } .btn-danger:hover { background: #dc2626; }
        .btn-small { padding: 0.4rem 0.8rem; font-size: 0.8rem; }

        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 1rem; text-align: left; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        th { color: #94a3b8; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; }
        tr:hover { background: rgba(255, 255, 255, 0.02); }
        
        .badge {
            padding: 0.25rem 0.75rem; border-radius: 99px; font-size: 0.75rem; font-weight: 600;
        }
        .badge-1 { background: rgba(100, 116, 139, 0.2); color: #94a3b8; } /* Belum ada */
        .badge-2 { background: rgba(245, 158, 11, 0.2); color: #fcd34d; } /* Permintaan */
        .badge-3 { background: rgba(59, 130, 246, 0.2); color: #93c5fd; } /* Pengerjaan */
        .badge-4 { background: rgba(239, 68, 68, 0.2); color: #fca5a5; } /* Penolakan */
        .badge-5 { background: rgba(16, 185, 129, 0.2); color: #6ee7b7; } /* Selesai */
        
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .stat-box {
            background: rgba(15, 23, 42, 0.4); border-radius: 12px; padding: 1.5rem; text-align: center; border: 1px solid rgba(255,255,255,0.05);
        }
        .stat-box h4 { color: #94a3b8; font-size: 0.85rem; margin-bottom: 0.5rem; text-transform: uppercase; }
        .stat-box .num { font-size: 2.5rem; font-weight: 700; color: #fff; }

        /* Hilangkan elemen bawaan WordPress */
        #wpadminbar { display: none !important; }
        html { margin-top: 0 !important; }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <img src="<?php echo get_template_directory_uri(); ?>/svg/logo.svg" alt="Logo">
        <h2>Karyawan Portal</h2>
        <p>
            Role: 
            <?php 
                if($role === 1) echo "Karyawan Atas (Admin)";
                elseif($role === 2) echo "Karyawan Menengah (Manager)";
                else echo "Karyawan Bawah (Staff)";
            ?>
        </p>
        
        <ul class="sidebar-menu">
            <li><a href="#" class="active">Dashboard Utama</a></li>
        </ul>

        <form action="" method="POST">
            <input type="hidden" name="action" value="logout">
            <button type="submit" class="logout-btn">Log Out</button>
        </form>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <h1 class="header-title">Selamat datang, <?php echo esc_html($_SESSION['emp_username']); ?>!</h1>

        <?php if ( ! empty( $message ) ) : ?>
            <div class="alert <?php echo $message_type; ?>">
                <?php echo esc_html($message); ?>
            </div>
        <?php endif; ?>

        <!-- KHUSUS KARYAWAN ATAS (ROLE 1) -->
        <?php if ( $role === 1 ) : ?>
            
            <div class="card">
                <h3>Analitik Klaim Asuransi</h3>
                <form action="" method="GET" style="display: flex; gap: 1rem; align-items: flex-end; margin-bottom: 2rem;">
                    <div class="form-group" style="margin: 0;">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="<?php echo esc_attr($start_date); ?>" required>
                    </div>
                    <div class="form-group" style="margin: 0;">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" value="<?php echo esc_attr($end_date); ?>" required>
                    </div>
                    <button type="submit" class="btn">Filter Data</button>
                </form>

                <div class="grid-2">
                    <?php 
                        $status_labels = [
                            1 => 'Belum Ada Pengajuan',
                            2 => 'Dalam Permintaan',
                            3 => 'Sedang Pengerjaan',
                            4 => 'Penolakan',
                            5 => 'Sudah Selesai'
                        ];
                        $total_transaksi = 0;
                        if(!empty($analytics_data)){
                            foreach($analytics_data as $row) {
                                $total_transaksi += $row->count;
                            }
                        }
                    ?>
                    <div class="stat-box" style="grid-column: span 2; border-color: #b69b32;">
                        <h4>Total Transaksi (Periode Terpilih)</h4>
                        <div class="num" style="color: #b69b32;"><?php echo $total_transaksi; ?></div>
                    </div>
                    <?php 
                        // Tampilkan status
                        foreach($status_labels as $kode => $label):
                            $count = 0;
                            if(!empty($analytics_data)) {
                                foreach($analytics_data as $row) {
                                    if($row->status == $kode) { $count = $row->count; break; }
                                }
                            }
                    ?>
                    <div class="stat-box">
                        <h4><?php echo $label; ?></h4>
                        <div class="num"><?php echo $count; ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="card">
                <h3>Manajemen Akses Karyawan</h3>
                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Last Login</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($employees_list as $emp) : ?>
                            <tr>
                                <td><?php echo esc_html($emp->username); ?></td>
                                <td>Role <?php echo esc_html($emp->role); ?></td>
                                <td><?php echo esc_html($emp->last_login); ?></td>
                                <td>
                                    <?php if($emp->status == 1): ?>
                                        <span class="badge badge-5">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-4">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($emp->status == 1 && $emp->role != 1): ?>
                                    <form action="" method="POST" onsubmit="return confirm('Yakin ingin menonaktifkan akun ini?');">
                                        <input type="hidden" name="action" value="deactivate_employee">
                                        <input type="hidden" name="target_emp_id" value="<?php echo esc_attr($emp->employee_id); ?>">
                                        <button type="submit" class="btn btn-danger btn-small">Deactivate</button>
                                    </form>
                                    <?php else: ?>
                                        <span style="color:#64748b; font-size:0.8rem;">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>

        <!-- KHUSUS KARYAWAN MENENGAH DAN BAWAH (BISA INPUT DATA) -->
        <?php if ( $role === 2 || $role === 3 ) : ?>
            <div class="card">
                <h3>Input Transaksi Baru (Barcode)</h3>
                <form action="" method="POST">
                    <input type="hidden" name="action" value="add_transaction">
                    
                    <div class="grid-2">
                        <div class="form-group">
                            <label>Barcode ID (Contoh: TRX-001)</label>
                            <input type="text" name="barcodeID" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Customer ID</label>
                            <input type="number" name="customer_id" class="form-control" required>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label>Material Description</label>
                            <input type="text" name="material_description" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Date Transaction</label>
                            <input type="date" name="date_transaction" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Warranty Expired</label>
                            <input type="date" name="warranty_exp" class="form-control" required>
                        </div>
                        <div class="form-group" style="grid-column: span 2;">
                            <label>Status (1-5)</label>
                            <select name="status" class="form-control" required>
                                <option value="1">1 - Belum ada pengajuan</option>
                                <option value="2">2 - Dalam permintaan</option>
                                <option value="3">3 - Sedang dalam pengerjaan</option>
                                <option value="4">4 - Penolakan</option>
                                <option value="5">5 - Sudah selesai</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="margin-top: 1rem;">Simpan Transaksi</button>
                </form>
            </div>
        <?php endif; ?>

        <!-- KHUSUS KARYAWAN MENENGAH (BISA HAPUS DATA) -->
        <?php if ( $role === 2 ) : ?>
            <div class="card">
                <h3>Data Transaksi Terakhir</h3>
                <div style="overflow-x:auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>Barcode ID</th>
                                <th>Material</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($transactions_list as $trx) : ?>
                            <tr>
                                <td><?php echo esc_html($trx->barcodeID); ?></td>
                                <td><?php echo esc_html($trx->material_description); ?></td>
                                <td><?php echo esc_html($trx->date_transaction); ?></td>
                                <td><span class="badge badge-<?php echo esc_attr($trx->status); ?>">Status <?php echo esc_html($trx->status); ?></span></td>
                                <td>
                                    <form action="" method="POST" onsubmit="return confirm('Hapus transaksi ini secara permanen?');">
                                        <input type="hidden" name="action" value="delete_transaction">
                                        <input type="hidden" name="barcodeID" value="<?php echo esc_attr($trx->barcodeID); ?>">
                                        <button type="submit" class="btn btn-danger btn-small">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            <?php if(empty($transactions_list)): ?>
                            <tr><td colspan="5" style="text-align:center; color:#64748b;">Belum ada data.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </main>

</body>
</html>
