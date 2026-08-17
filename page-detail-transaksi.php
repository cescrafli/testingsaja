<?php
/**
 * Template Name: Detail Transaksi
 */

// Mendapatkan Barcode ID dari parameter URL, contoh: /detail-transaksi/?id=TRX-123
$barcode_id = isset( $_GET['id'] ) ? sanitize_text_field( $_GET['id'] ) : '';

$data_found = false;
$data = null;

if ( ! empty( $barcode_id ) ) {
    global $wpdb;

    // QUERY SQL MENGGUNAKAN METODE "JOIN"
    // Inilah solusi dari pertanyaan Anda: Kita menyambungkan (JOIN) tabel wp_barcode dengan wp_customer menggunakan customer_id
    // dan juga dengan wp_employee (asumsi menggunakan employee_id) untuk mengambil location.
    
    $query = $wpdb->prepare( "
        SELECT 
            b.barcodeID, 
            b.material_description, 
            b.status, 
            b.date_transaction, 
            b.warranty_exp, 
            c.customer_name, 
            e.location 
        FROM wp_barcode b 
        LEFT JOIN wp_customer c ON b.customer_id = c.customer_id 
        LEFT JOIN wp_employee e ON b.employee_id = e.employee_id 
        WHERE b.barcodeID = %s
    ", $barcode_id );

    $data = $wpdb->get_row( $query );

    if ( $data ) {
        $data_found = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi | Griya Djaya Sentosa</title>
    
    <!-- Google Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Outfit', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8fafc; /* Warna background bersih yang elegan */
            color: #334155;
            padding: 2rem;
        }

        /* Desain Card Berdasarkan Referensi Sketsa Anda */
        .transaction-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 900px;
            overflow: hidden;
            border: 2px solid #000000; /* Outline tegas seperti sketsa */
        }

        @media(min-width: 768px) {
            .transaction-card {
                flex-direction: row;
                min-height: 400px;
            }
        }

        /* Bagian Kiri (Area QR Code) */
        .card-left {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #ffffff;
        }

        .qr-container {
            border: 4px solid #ef4444; /* Kotak merah seperti di sketsa Anda */
            padding: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            margin-bottom: 1.5rem;
            width: 250px;
            height: 250px;
        }

        .qr-text {
            font-size: 1.1rem;
            font-weight: 600;
            color: #000;
            text-align: center;
        }
        
        .qr-subtext {
            font-size: 0.85rem;
            color: #64748b;
            text-align: center;
            margin-top: 0.25rem;
        }

        /* Garis Pemisah Tengah */
        .card-divider {
            width: 100%;
            height: 4px;
            background: #000000; /* Garis hitam pemisah seperti di sketsa */
        }

        @media(min-width: 768px) {
            .card-divider {
                width: 4px;
                height: auto;
            }
        }

        /* Bagian Kanan (Detail Data) */
        .card-right {
            flex: 1.5;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .card-right h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .detail-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1.25rem;
        }

        .detail-item {
            font-size: 1.05rem;
            line-height: 1.4;
            color: #000000;
            display: flex;
            flex-direction: column;
        }

        .detail-item strong {
            color: #475569;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.25rem;
        }

        /* Tampilan Jika Data Tidak Ditemukan */
        .not-found {
            text-align: center;
            padding: 4rem;
            width: 100%;
        }
        .not-found h2 { color: #ef4444; margin-bottom: 1rem; }
        .not-found p { color: #64748b; }
        
        /* Hilangkan elemen bawaan WordPress jika ter-render */
        #wpadminbar { display: none !important; }
        html { margin-top: 0 !important; }
    </style>
</head>
<body>

    <?php if ( empty( $barcode_id ) ) : ?>
        <div class="transaction-card">
            <div class="not-found">
                <h2>Parameter ID Kosong</h2>
                <p>Silakan akses halaman ini menggunakan hasil scan QR Code yang valid.</p>
            </div>
        </div>
    <?php elseif ( ! $data_found ) : ?>
        <div class="transaction-card">
            <div class="not-found">
                <h2>Data Transaksi Tidak Ditemukan</h2>
                <p>Tidak ada data untuk transaksi dengan ID: <strong><?php echo esc_html($barcode_id); ?></strong></p>
            </div>
        </div>
    <?php else : ?>
        <div class="transaction-card">
            
            <!-- BAGIAN KIRI: QR CODE -->
            <div class="card-left">
                <div class="qr-container" id="qrcode">
                    <!-- QR Code akan di-generate oleh JavaScript di sini -->
                </div>
                <div class="qr-text">Barcode Picture</div>
                <div class="qr-subtext">Generated by <?php echo esc_html($data->barcodeID); ?></div>
            </div>

            <!-- GARIS TENGAH -->
            <div class="card-divider"></div>

            <!-- BAGIAN KANAN: DETAIL TRANSAKSI -->
            <div class="card-right">
                <h2>Detail Transaksi</h2>
                <ul class="detail-list">
                    <li class="detail-item">
                        <strong>Material Description</strong>
                        <span><?php echo esc_html($data->material_description); ?></span>
                    </li>
                    <li class="detail-item">
                        <strong>Status</strong>
                        <span><?php echo esc_html($data->status); ?></span>
                    </li>
                    <li class="detail-item">
                        <strong>Date Transaction</strong>
                        <span><?php echo esc_html($data->date_transaction); ?></span>
                    </li>
                    <li class="detail-item">
                        <strong>Warranty Expired</strong>
                        <span><?php echo esc_html($data->warranty_exp); ?></span>
                    </li>
                    <li class="detail-item">
                        <strong>Customer Name</strong>
                        <span><?php echo esc_html($data->customer_name); ?></span>
                    </li>
                    <li class="detail-item">
                        <strong>Location</strong>
                        <span><?php echo esc_html($data->location); ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Library QR Code Generator (Sangat Ringan, Cepat, Tanpa PHP Library) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
        <script>
            // Generate QR Code otomatis saat halaman dimuat
            // QR Code ini akan berisi link website persis ke halaman transaksi ini
            const currentUrl = window.location.href;
            
            new QRCode(document.getElementById("qrcode"), {
                text: currentUrl,
                width: 210,
                height: 210,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
        </script>
    <?php endif; ?>

</body>
</html>
