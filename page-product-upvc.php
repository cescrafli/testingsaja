<?php
/* Template Name: Product - UPVC */
get_header();
$upload_dir = get_template_directory_uri() . '/img/';

// Handle Routing via Query Parameters
$view = isset($_GET['view']) ? $_GET['view'] : 'main';
$item_id = isset($_GET['item']) ? $_GET['item'] : '';

$pData = [
        "jendela-lipat" => [
        "cat" => "Jendela",
        "title" => "Jendela Lipat uPVC Presisi Tinggi",
        "subtitle" => "Conch & Falken High-Precision Architectural Bi-Fold Window System",
        "img" => "Jendela-Lipat-1.png",
        "badges" => ["Standar Mutu ISO 9001:2015", "Garansi Profil 10 Tahun"],
        "green_badge" => "Double EPDM Gasket",
        "desc" => "Sistem jendela lipat uPVC Conch & Falken dirancang secara arsitektural untuk memaksimalkan bentang bukaan view, sirkulasi udara alami, dan pencahayaan optimal tanpa mengorbankan isolasi akustik maupun integritas struktural.<br><br>Sangat ideal sebagai penghubung interior mewah dengan patio, teras belakang, void taman samping, maupun partisi fleksibel dengan pergerakan daun yang senyap dan kedap udara.",
        "listTitle" => "KEUNGGULAN SISTEM JENDELA LIPAT:",
        "features" => [
            "<b>Profil uPVC Multi-Chamber:</b> Sekat berongga multi-ruang yang meredam radiasi panas matahari dan kebisingan secara efisien.",
            "<b>Hardware & Roda Stainless 304:</b> Rel bawah heavy-duty untuk tarikan mulus, stabil, dan bebas macet bertahun-tahun.",
            "<b>Multi-Point Locking System:</b> Penguncian multiposisi perimeter menjamin keamanan maksimal dan kekedapan angin optimal.",
            "<b>Ketahanan Cuaca Tropis Anti-UV:</b> Formulasi ASA compound tahan cuaca ekstrem tidak akan keropos, getas, atau menguning."
        ],
        "specs" => [
            "Pilihan Konfigurasi:" => "3, 4, 5, 6 s/d 8 Daun Lipat",
            "Spesifikasi Kaca:" => "Single 5mm-8mm / Double Glass 5+9A+5mm",
            "Rangka Penguat Internal:" => "Galvanized Steel Core (Anti-Karat)",
            "Aksesoris & Engsel:" => "Kinlong / Hopo / Roto Architectural Gear"
        ],
        "short_desc" => "<b>Jendela Lipat</b> memiliki keunggulan bisa membuka bukaan lebih lebar dari jenis jendela lainnya. Jendela ini sering diaplikasikan untuk area ke taman atau penyekat ruangan indoor.",
        "short_listTitle" => "Tipe -tipe Jendela Lipat:",
        "short_list" => [
            "Jendela Lipat 3 Daun",
            "Jendela Lipat 4 Daun",
            "Jendela Lipat 5 Daun",
            "Jendela Lipat 6 Daun",
            "Dll"
        ]
    ],
    "jendela-jungkit" => [
        "cat" => "Jendela",
        "title" => "Jendela Jungkit",
        "img" => "Jendela-Jungkit-2.png",
        "desc" => "<b>Jendela Jungkit</b> adalah jendela yang dibuka dengan cara mendorong bagian bawah daun jendela, sehingga daun jendela terbuka miring ke depan. Tipe jendela ini memiliki dua macam arah bukaan yaitu buka atas dan buka bawah. Pada dasarnya jungkit atas atau jungkit bawah memiliki sifat yang sama hanya beda pada tumpuan engsel baik di atas atau di bawah. Udara yang keluar lebih sedikit ketika daun jendela terbuka.",
        "listTitle" => "Tipe -tipe Jendela Jungkit:",
        "list" => [
            "Jendela Jungkit Single",
            "Jendela Jungkit 1/2/3/4/5 Daun (<i>sesuai request</i>)",
            "Jendela Jungkit Kaca + Ornament",
            "Jendela Jungkit Kombinasi",
            "Dll"
        ]
    ]
];

$jendela_items = [
    ['id' => 'jendela-jungkit', 'title' => 'Jendela Jungkit', 'gif' => 'Jendela-Jungkit-2.png'],
    ['id' => 'jendela-lipat', 'title' => 'Jendela Lipat', 'gif' => 'Jendela-Lipat-1.png'],
    ['id' => 'jendela-pivot', 'title' => 'Jendela Pivot', 'gif' => 'Jendela-Pivot-1.png'],
    ['id' => 'jendela-sliding', 'title' => 'Jendela Sliding', 'gif' => 'Jendela-Sliding-1.png'],
    ['id' => 'jendela-sliding-vertikal', 'title' => 'Jendela Sliding Vertikal', 'gif' => 'Jendela-Sliding-Atas-1.png'],
    ['id' => 'jendela-swing', 'title' => 'Jendela Swing', 'gif' => 'Jendela-Swing-1.png'],
    ['id' => 'kacamati', 'title' => 'Kacamati', 'gif' => 'Jendela-Pivot-1.png'],
];

$pintu_items = [
    ['id' => 'pintu-ekonomis', 'title' => 'Pintu Ekonomis', 'gif' => 'Pintu-Ekonomis-1.png'],
    ['id' => 'pintu-garasi', 'title' => 'Pintu Garasi', 'gif' => 'Pintu-Garasi-1.png'],
    ['id' => 'pintu-lipat', 'title' => 'Pintu Lipat', 'gif' => 'Pintu-Lipat-1 (1).png'],
    ['id' => 'pintu-sliding', 'title' => 'Pintu Sliding', 'gif' => 'Pintu-Sliding-2.png'],
    ['id' => 'pintu-swing', 'title' => 'Pintu Swing', 'gif' => 'Pintu-Swing-3.png'],
];

?>
<style>
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }
.prod-sub-container { padding: 180px 0 100px; max-width: 1200px; margin: 0 auto; text-align: center; }
.prod-sub-subtitle { font-size: 14px; font-weight: 700; color: #cba85d; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px; font-family: 'Outfit', sans-serif; }
.prod-sub-title { font-size: 46px; font-weight: 800; color: #1a202c; margin-bottom: 80px; font-family: 'Outfit', sans-serif; }

/* Main Grid */
.prod-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; text-align: center; justify-content: center; }
@media(max-width: 575px) { .prod-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; } }
.prod-card { display: flex; flex-direction: column; align-items: center; cursor: pointer; transition: transform 0.3s; text-decoration: none; }
.prod-card:hover { transform: translateY(-5px); }
.prod-card-img { width: 100%; aspect-ratio: 1/1; object-fit: cover; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
.prod-card-title { font-size: 24px; font-weight: 700; color: #1a202c; }

/* Detailed Grid */
.detail-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; margin-top: 40px; }
@media(max-width: 991px) { .detail-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 575px) { .detail-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; } }

.detail-card { display: flex; flex-direction: column; text-align: center; background: #fff; cursor: pointer; transition: transform 0.3s; text-decoration: none; }
.detail-card:hover { transform: translateY(-5px); }
.detail-card-img-wrapper { padding: 0; display: flex; align-items: center; justify-content: center; width: 100%; aspect-ratio: 1/1; }
.detail-card-img { width: 100%; height: 100%; object-fit: contain; padding: 10px; }
.detail-card-text { padding: 20px 10px; }
.detail-card-cat { font-size: 13px; color: #bfa145; margin-bottom: 6px; }
.detail-card-title { font-size: 16px; font-weight: 700; color: #111; }
  @media(max-width: 575px) { .detail-card-title { font-size: 13px; } .detail-card-cat { font-size: 11px; } .detail-card-text { padding: 15px 5px; } }
  @media(max-width: 575px) { .detail-card-title { font-size: 13px; } .detail-card-cat { font-size: 11px; } .detail-card-text { padding: 15px 5px; } }
  @media(max-width: 575px) { .detail-card-title { font-size: 13px; } .detail-card-cat { font-size: 11px; } .detail-card-text { padding: 15px 5px; } }

.back-btn { display: inline-flex; align-items: center; gap: 8px; background: #f1f1f1; padding: 10px 20px; border-radius: 4px; color: #333; text-decoration: none; font-weight: 600; font-size: 14px; cursor: pointer; border: none; margin-bottom: 30px; transition: background 0.3s; }
.back-btn:hover { background: #e2e2e2; }

/* Single Item View */
.si-grid { display: flex; flex-wrap: wrap; gap: 50px; margin-top: 20px; text-align: left; }
.si-left { flex: 1 1 45%; background: #e0e0e0; position: relative; display: flex; align-items: center; justify-content: center; padding: 40px; border-radius: 4px; }
.si-left img { max-width: 100%; height: auto;  }
/* Fake slider arrows for aesthetic */
.si-arrow { position: absolute; top: 50%; transform: translateY(-50%); color: #fff; font-size: 30px; cursor: pointer; opacity: 0.7; }
.si-arrow:hover { opacity: 1; }
.si-arrow-left { left: 20px; }
.si-arrow-right { right: 20px; }
.si-dots { position: absolute; bottom: 15px; left: 0; width: 100%; display: flex; justify-content: center; gap: 8px; }
.si-dot { width: 6px; height: 6px; background: #999; border-radius: 50%; }
.si-dot.active { background: #555; }

.si-right { flex: 1 1 45%; }
.si-cat { font-size: 14px; color: #bfa145; font-weight: 600; margin-bottom: 10px; }
.si-title { font-size: 32px; font-weight: 800; color: #1a202c; margin-bottom: 25px; }
.si-desc { font-size: 15px; color: #4a5568; line-height: 1.8; margin-bottom: 25px; }
.si-list-title { font-size: 15px; font-weight: 700; color: #1a202c; margin-bottom: 15px; }
.si-list { padding-left: 20px; margin-bottom: 40px; }
.si-list li { font-size: 15px; color: #4a5568; margin-bottom: 8px; }

.si-wa-btn { display: inline-flex; align-items: center; gap: 10px; background: #bfa145; color: #fff; padding: 12px 25px; font-size: 14px; font-weight: 700; border-radius: 4px; text-decoration: none; transition: background 0.3s; }
.si-wa-btn:hover { background: #a68a36; color: #fff; }


.color-picker-ui {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    z-index: 10;
}
.cp-btn {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 2px solid #eee;
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.2s, border-color 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}
.cp-btn:hover {
    transform: scale(1.1);
}
.cp-btn.active {
    border-color: #bfa145;
    border-width: 3px;
}
.c-putih { background: #ffffff; }
.c-hitam { background: #111111; }
.c-coklat { background: #6b4423; }
.c-wood-golden { background: #a67b45; }
.c-wood-dark { background: #3d2314; }
.c-reset { background: #f37145; border:none; }




.configurator-wrapper { background: #f8fafc; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); max-width: 1200px; margin: 0 auto; position: relative; }
.conf-top-bar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; flex-wrap: wrap; gap: 20px; }
.conf-brands { display: flex; gap: 15px; }
.conf-brand-btn { background: #fff; border: 2px solid #e2e8f0; border-radius: 12px; padding: 10px 20px; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; height: 60px; min-width: 160px; }
.conf-brand-btn img { max-height: 40px; object-fit: contain; }
.conf-brand-btn.active { border-color: #041e3a; box-shadow: 0 4px 15px rgba(4,30,58,0.1); }
.conf-top-right { display: flex; align-items: center; gap: 15px; }
.conf-badge { background: #fff; border: 1px solid #e2e8f0; padding: 8px 15px; border-radius: 8px; font-size: 14px; font-weight: 600; color: #4a5568; display: flex; align-items: center; gap: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.02); }
.conf-icon-btn { width: 40px; height: 40px; background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #4a5568; box-shadow: 0 2px 5px rgba(0,0,0,0.02); transition: all 0.2s; }
.conf-icon-btn:hover { background: #f1f5f9; color: #000; }

.conf-body { position: relative; display: flex; align-items: stretch; margin-bottom: 30px; padding-right: 40px; }
.conf-main-box { flex: 1; background: #fff; border: 3px solid #111827; border-radius: 16px; display: flex; flex-wrap: wrap; overflow: hidden; position: relative; box-shadow: 0 20px 40px rgba(0,0,0,0.05); }

.conf-image-area { flex: 1 1 50%; padding: 40px; background: #f8fafc; position: relative; display: flex; align-items: center; justify-content: center; min-height: 400px; border-right: 1px solid #e2e8f0; }
.conf-details-area { flex: 1 1 50%; padding: 50px 40px; background: #fff; display: flex; flex-direction: column; justify-content: center; }

.conf-mekanisme { position: absolute; bottom: 20px; left: 20px; background: #1e293b; color: #fff; padding: 12px 20px; border-radius: 8px; font-size: 14px; font-weight: 700; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }

.conf-color-picker { position: absolute; right: 0; top: 50%; transform: translateY(-50%); background: #fff; border-radius: 40px; padding: 20px 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; z-index: 10; width: 80px; display: flex; flex-direction: column; align-items: center; }
.cp-group { display: flex; flex-direction: column; align-items: center; gap: 15px; width: 100%; }
.cp-title { text-align: center; font-size: 12px; font-weight: 900; color: #041e3a; margin-bottom: 10px; line-height: 1.2; letter-spacing: 0.5px; }
.cp-title span { font-weight: 500; font-size: 10px; color: #64748b; }

.conf-footer { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; padding-top: 20px; border-top: 1px solid #e2e8f0; }
.conf-active-color { font-size: 14px; color: #64748b; display: flex; align-items: center; gap: 10px; font-weight: 500; }
.conf-badge-black { background: #fff; border: 1px solid #e2e8f0; padding: 8px 15px; border-radius: 8px; font-size: 13px; font-weight: 800; color: #111827; box-shadow: 0 2px 5px rgba(0,0,0,0.02); display: inline-flex; align-items: center; gap: 6px; }
.conf-glass-info { font-size: 14px; color: #64748b; font-weight: 500; }

@media(max-width: 991px) {
    .conf-body { padding-right: 0; flex-direction: column; }
    .conf-color-picker { position: relative; right: auto; top: auto; transform: none; width: 100%; flex-direction: row; border-radius: 12px; margin-top: 20px; justify-content: center; }
    .cp-group { flex-direction: row; justify-content: center; }
    .cp-title { margin-right: 15px; margin-bottom: 0; text-align: left; }
    
    .conf-image-area { border-right: none; border-bottom: 1px solid #e2e8f0; }
}



/* New Layout CSS */
.product-detail-layout { display: flex; flex-wrap: wrap; gap: 50px; align-items: flex-start; max-width: 1300px; margin: 0 auto; text-align: left; }
.pdl-left { flex: 1 1 50%; min-width: 500px; position: sticky; top: 120px; background: transparent; padding: 0; position: relative; }
.pdl-right { flex: 1 1 45%; min-width: 320px; }

.conf-main-box { background: #f8fafc; border: 3px solid #111827; border-radius: 16px; display: flex; flex-wrap: wrap; overflow: hidden; position: relative; box-shadow: 0 20px 40px rgba(0,0,0,0.05); flex: 1; margin: 0; }
.conf-image-area { padding: 30px; min-height: 350px; flex: 1 1 100%; position: relative; display: flex; align-items: center; justify-content: center; background: #f8fafc; }
.conf-details-area { flex: 1 1 50%; padding: 40px; display: flex; flex-direction: column; justify-content: center; }

.conf-mekanisme { position: absolute; bottom: 20px; left: 20px; background: #1e293b; color: #fff; padding: 12px 20px; border-radius: 8px; font-size: 14px; font-weight: 700; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }

.conf-color-picker { position: relative; right: auto; top: auto; transform: none; background: #fff; border-radius: 40px; padding: 20px 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 1px solid #e2e8f0; display: flex; flex-direction: column; align-items: center; z-index: 10; width: 65px; }
.cp-group { display: flex; flex-direction: column; align-items: center; gap: 15px; width: 100%; margin-bottom: 20px; }
.cp-group:last-child { margin-bottom: 0; }
.cp-title { text-align: center; font-size: 12px; font-weight: 900; color: #041e3a; margin-bottom: 10px; line-height: 1.2; letter-spacing: 0.5px; }
.cp-title span { font-weight: 500; font-size: 10px; color: #64748b; }
.cp-btn { width: 30px; height: 30px; border-radius: 50%; cursor: pointer; border: 2px solid transparent; transition: 0.3s; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
.cp-btn.active { border-color: #041e3a; transform: scale(1.1); box-shadow: 0 4px 10px rgba(4,30,58,0.2); }
.c-hitam { background: #1a1a1a; }
.c-putih { background: #f8f9fa; border: 1px solid #e2e8f0; }
.c-coklat { background: #5c4033; }
.c-wood-golden { background: #b8860b; }
.c-wood-dark { background: #4a3c31; }

.pdl-title { font-size: 38px; font-weight: 900; color: #111827; line-height: 1.1; margin-bottom: 12px; font-family: 'Outfit', sans-serif; letter-spacing: -0.5px; }
.pdl-subtitle { font-size: 17px; color: #64748b; font-weight: 400; margin-bottom: 25px; line-height: 1.5; }
.pdl-badges { display: flex; flex-wrap: wrap; gap: 12px; margin-bottom: 30px; }
.pdl-badge-gray { background: #f8fafc; color: #475569; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 6px; border: 1px solid #e2e8f0; }
.pdl-badge-green { background: #ecfdf5; color: #059669; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; display: flex; align-items: center; border: 1px solid #a7f3d0; }
.pdl-desc { font-size: 16px; color: #475569; line-height: 1.8; margin-bottom: 40px; }
.pdl-section-title { font-size: 13px; font-weight: 800; color: #111827; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 15px; }
.pdl-features { display: flex; flex-direction: column; gap: 12px; margin-bottom: 40px; }
.pdl-feature-card { background: #fff; border: 1px solid #f1f5f9; padding: 16px; border-radius: 10px; display: flex; align-items: flex-start; gap: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); }
.pdl-check { width: 22px; height: 22px; background: #fbbf24; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px; }
.pdl-ftext { font-size: 15px; color: #475569; line-height: 1.6; }
.pdl-ftext b { color: #111827; font-weight: 700; }
.pdl-specs { border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 40px; overflow: hidden; }
.pdl-specs-header { display: flex; justify-content: space-between; align-items: center; padding: 16px 20px; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
.pdl-sh-left { font-size: 13px; font-weight: 800; color: #111827; letter-spacing: 0.5px; }
.pdl-sh-right { font-size: 12px; font-weight: 600; color: #94a3b8; }
.pdl-specs-body { padding: 0 20px; }
.pdl-spec-row { display: flex; padding: 15px 0; border-bottom: 1px dashed #e2e8f0; }
.pdl-spec-row:last-child { border-bottom: none; }
.pdl-spec-k { flex: 1 1 35%; font-size: 14px; color: #64748b; }
.pdl-spec-v { flex: 1 1 65%; font-size: 14px; font-weight: 700; color: #111827; }
.pdl-btn-rab { display: block; width: 100%; text-align: center; background: #bfa145; color: #fff; padding: 18px; border-radius: 12px; font-weight: 800; font-size: 16px; text-decoration: none; transition: 0.3s; box-shadow: 0 10px 20px rgba(191,161,69,0.2); }
.pdl-btn-rab:hover { background: #a68a36; transform: translateY(-3px); box-shadow: 0 15px 25px rgba(191,161,69,0.3); color: #fff; }

@media(max-width: 991px) {
    .pdl-left { position: relative; top: 0; min-width: 100%; padding: 20px; border-radius: 12px; }
    .conf-main-box { flex-direction: column; }
    .conf-image-area { border-right: none; border-bottom: 1px solid #e2e8f0; min-height: 250px; }
    .conf-color-picker { position: relative; right: auto; top: auto; transform: none; width: 100%; flex-direction: row; box-shadow: none; border: 1px solid #e2e8f0; border-radius: 12px; padding: 15px; margin-top: 20px; justify-content: center; gap: 30px; }
    .cp-group { margin-bottom: 0; }
}
/* End Layout CSS */

/* Lightbox Styles */
.lightbox { display: none; position: fixed; z-index: 999999; padding-top: 60px; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.9); }
.lightbox-content { margin: auto; display: block; max-width: 90%; max-height: 85vh; object-fit: contain; animation: zoomIn 0.3s; }
.lightbox-close { position: absolute; top: 20px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer; transition: 0.3s; }
.lightbox-close:hover { color: #bbb; }
@keyframes zoomIn { from {transform:scale(0)} to {transform:scale(1)} }

/* Hover effect styles injected by AI */
.hover-banner {
    position: absolute; top: 50%; left: 15%; right: 15%; transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9); padding: 12px 10px; text-align: center;
    font-size: 18px; font-weight: 900; color: #000; letter-spacing: 0.5px;
    font-family: 'Oswald', 'Arial Black', sans-serif;
    text-transform: uppercase;
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
    pointer-events: none;
    z-index: 2;
}
.prod-card-img-wrapper, .detail-card-img-wrapper {
    position: relative;
    width: 100%;
    overflow: hidden;
    /* aspect-ratio set specifically for detail wrapper below */
}
.prod-card-img-wrapper {
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.05);
}
.prod-card-img {
    margin-bottom: 0 !important;
    border-radius: 0 !important;
    box-shadow: none !important;
}
.prod-card-img-wrapper::after, .detail-card-img-wrapper::after {
    content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(0, 0, 0, 0.5); opacity: 0; transition: opacity 0.3s ease; z-index: 1;
}
.prod-card:hover .prod-card-img-wrapper::after, .detail-card:hover .detail-card-img-wrapper::after { opacity: 1; }
.prod-card:hover .hover-banner, .detail-card:hover .hover-banner { opacity: 1; }

</style>


<div class="prod-sub-container container">
    
        <?php if ($view == 'main'): ?>
    <div style="text-align: left; margin-bottom: 20px; position: relative;">
        
        <a href="<?php echo home_url('/product/'); ?>" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali</a></div>
    <!-- Main Options -->
    <div>
        <div style="position: relative; max-width: 700px; margin: 0 auto 80px;">
            <img src="<?php echo get_template_directory_uri(); ?>/img/badge_warranty.png?v=1787832010" alt="10 Year Warranty" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 130px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1)); z-index: 10;">
            <div class="prod-sub-subtitle">PRODUCT</div>
            <h1 class="prod-sub-title" style="margin-bottom: 0;">UPVC</h1>
        </div>
        
        <div class="prod-grid" style="max-width: 700px; margin: 0 auto;">
            <a href="?view=jendela" class="prod-card">
                <div class="prod-card-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/img/jendelaupvc.jpeg" alt="Jendela" class="prod-card-img"><div class="hover-banner">VIEW MORE</div></div>
                <div class="prod-card-title">Jendela</div>
            </a>
            <a href="?view=pintu" class="prod-card">
                <div class="prod-card-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/img/pintuupvc.jpeg" alt="Pintu" class="prod-card-img"><div class="hover-banner">VIEW MORE</div></div>
                <div class="prod-card-title">Pintu</div>
            </a>
        </div>
    </div>
    
    <?php elseif ($view == 'jendela'): ?>
    <!-- Jendela Grid View -->
    <div>
        <div style="text-align: left;"><a href="?" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali</a></div>
        <div class="prod-sub-subtitle">PRODUCT</div>
        <h2 class="prod-sub-title" style="margin-bottom: 50px;">Jendela</h2>
        
        <div class="detail-grid">
            <?php foreach($jendela_items as $item): ?>
                <a href="?view=single&item=<?php echo $item['id']; ?>&parent=jendela" class="detail-card">
                    <div class="detail-card-img-wrapper">
                        <img src="<?php echo $upload_dir . $item['gif']; ?>" alt="<?php echo $item['title']; ?>" class="detail-card-img" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg';">
                        <div class="hover-banner">VIEW MORE</div>
</div>
                    <div class="detail-card-text">
                        <div class="detail-card-cat">Jendela</div>
                        <div class="detail-card-title"><?php echo $item['title']; ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php elseif ($view == 'pintu'): ?>
    <!-- Pintu Grid View -->
    <div>
        <div style="text-align: left;"><a href="?" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali</a></div>
        <div class="prod-sub-subtitle">PRODUCT</div>
        <h2 class="prod-sub-title" style="margin-bottom: 50px;">Pintu</h2>
        
        <div class="detail-grid">
            <?php foreach($pintu_items as $item): ?>
                <a href="?view=single&item=<?php echo $item['id']; ?>&parent=pintu" class="detail-card">
                    <div class="detail-card-img-wrapper">
                        <img src="<?php echo $upload_dir . $item['gif']; ?>" alt="<?php echo $item['title']; ?>" class="detail-card-img" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg';">
                        <div class="hover-banner">VIEW MORE</div>
</div>
                    <div class="detail-card-text">
                        <div class="detail-card-cat">Pintu</div>
                        <div class="detail-card-title"><?php echo $item['title']; ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php elseif ($view == 'single'): 
        
        $parent = isset($_GET['parent']) ? $_GET['parent'] : 'jendela';
        
        // Find generic fallback data
        $fallback_title = ucwords(str_replace('-', ' ', $item_id));
        $fallback_gif = '';
        
        $search_array = ($parent == 'pintu') ? $pintu_items : $jendela_items;
        foreach($search_array as $arr_item) {
            if($arr_item['id'] == $item_id) {
                $fallback_title = $arr_item['title'];
                $fallback_gif = $arr_item['gif'];
                break;
            }
        }
        
        $data = isset($pData[$item_id]) ? $pData[$item_id] : [
            'cat' => ucfirst($parent),
            'title' => $fallback_title,
            'img' => $fallback_gif,
            'desc' => 'Deskripsi untuk produk ini belum tersedia. Silakan hubungi kami melalui tombol di bawah untuk informasi lebih detail mengenai spesifikasi dan pemesanan.',
            'listTitle' => 'Keunggulan:',
            'list' => [
                'Material UPVC berkualitas tinggi',
                'Tahan lama dan anti rayap',
                'Desain elegan dan presisi'
            ]
        ];

        // CHECK IF USER UPLOADED THEIR OWN PRODUCT VIA CPT
        $user_images = array();
        $user_uploaded_content = '';
        
        $args = array(
            'name'        => $item_id,
            'post_type'   => 'gjs_produk',
            'post_status' => 'publish',
            'numberposts' => 1
        );
        $custom_posts = get_posts($args);
        if($custom_posts) {
            $c_post = $custom_posts[0];
            $data['title'] = $c_post->post_title;
            $raw_content = apply_filters('the_content', $c_post->post_content);
            
            // Extract all images from content
            preg_match_all('/<img[^>]+src="([^">]+)"/', $raw_content, $matches);
            if (!empty($matches[1])) {
                $user_images = $matches[1];
            }
            
            // If they still used featured image as fallback
            if (empty($user_images) && has_post_thumbnail($c_post->ID)) {
                $user_images[] = get_the_post_thumbnail_url($c_post->ID, 'full');
            }
            
            // Remove images and galleries from text content
            $text_content = preg_replace('/<figure[^>]*>.*?<\/figure>/is', '', $raw_content);
            $text_content = preg_replace('/<ul[^>]*wp-block-gallery[^>]*>.*?<\/ul>/is', '', $text_content);
            $text_content = preg_replace('/<img[^>]+>/is', '', $text_content);
            $user_uploaded_content = trim($text_content);
            
            // Override desc if user put content in WP editor
            if(!empty($user_uploaded_content)) {
                $data['desc'] = $user_uploaded_content;
            }
            
            // Dynamic Custom Fields overrides
            $meta_subtitle = get_post_meta($c_post->ID, 'subtitle', true);
            if(!empty($meta_subtitle)) $data['subtitle'] = $meta_subtitle;
            
            $meta_listTitle = get_post_meta($c_post->ID, 'listTitle', true);
            if(!empty($meta_listTitle)) $data['listTitle'] = $meta_listTitle;
            
            // Support comma-separated strings for badges
            $meta_badges = get_post_meta($c_post->ID, 'badges', true);
            if(!empty($meta_badges)) $data['badges'] = array_map('trim', explode(',', $meta_badges));
            
            $meta_green_badge = get_post_meta($c_post->ID, 'green_badge', true);
            if(!empty($meta_green_badge)) $data['green_badge'] = $meta_green_badge;
            
            // Support newline-separated strings for features
            $meta_features = get_post_meta($c_post->ID, 'features', true);
            if(!empty($meta_features)) {
                $data['features'] = array_filter(array_map('trim', explode("
", $meta_features)));
            }
            
            // Support Key:Value newline-separated strings for specs
            $meta_specs = get_post_meta($c_post->ID, 'specs', true);
            if(!empty($meta_specs)) {
                $parsed_specs = [];
                $lines = array_filter(array_map('trim', explode("
", $meta_specs)));
                foreach($lines as $line) {
                    $parts = explode(':', $line, 2);
                    if(count($parts) == 2) {
                        $parsed_specs[trim($parts[0])] = trim($parts[1]);
                    } else {
                        $parsed_specs[] = trim($line); // Fallback if no colon
                    }
                }
                if(!empty($parsed_specs)) $data['specs'] = $parsed_specs;
            }
        }
    ?>
    <!-- Single Item View -->
    <div>
        <div style="text-align: left;"><a href="?view=<?php echo $parent; ?>" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali</a></div>
        
        <div class="product-detail-layout">
    <div class="pdl-left">
        
        
        <!-- Top Bar: Brands -->
        <div class="conf-top-bar" style="margin-bottom: 20px; display: flex; gap: 15px; justify-content: flex-start;">
            <button class="conf-brand-btn active" id="btn-conch" onclick="switchBrand('conch')" style="padding: 5px 15px; background: #fff; border: 2px solid #041e3a; border-radius: 8px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <img src="<?php echo get_template_directory_uri(); ?>/img/brands/brand-custom-2.png" alt="CONCH" style="height: 40px; width: 100%; object-fit: contain;">
            </button>
            <button class="conf-brand-btn" id="btn-falken" onclick="switchBrand('falken')" style="padding: 5px 15px; background: #fff; border: 2px solid transparent; border-radius: 8px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                <img src="<?php echo get_template_directory_uri(); ?>/img/brands/btn-falken.png" alt="FALKEN" style="height: 40px; width: 100%; object-fit: contain;">
            </button>
        </div>
        
        <div style="display: flex; gap: 30px; align-items: center; position: relative;">
          <div class="conf-main-box">
            <div class="conf-image-area" id="si-slider-container">
                <?php if(!empty($user_images)): ?>
                    <?php if(count($user_images) > 1): ?>
                        <div class="si-arrow si-arrow-left" onclick="moveSlider(-1)">&lsaquo;</div>
                        <div class="si-arrow si-arrow-right" onclick="moveSlider(1)">&rsaquo;</div>
                        <div class="si-dots">
                            <?php foreach($user_images as $index => $img): ?>
                                <div class="si-dot <?php echo ($index == 0) ? 'active' : ''; ?>" onclick="setSlider(<?php echo $index; ?>)"></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php foreach($user_images as $index => $img): ?>
                        <img class="si-slide-img product-color-target" onclick="openLightbox(this.src)" src="<?php echo $img; ?>" alt="Gallery Image" style="<?php echo ($index == 0) ? 'display:block;' : 'display:none;'; ?> width:100%; object-fit:contain; max-height:400px; cursor: zoom-in;">
                    <?php endforeach; ?>
                <?php else: ?>
                    <img src="<?php echo $upload_dir . $data['img']; ?>" alt="<?php echo $data['title']; ?>" class="product-color-target" style="width:100%; object-fit:contain; cursor:zoom-in;" onclick="openLightbox(this.src)">
                <?php endif; ?>
                <div id="conf-color-name" class="conf-mekanisme">Black</div>
            </div>
            
            
        </div>
        
        <!-- Combined Color Picker -->
        <div class="conf-color-picker">
            <div id="colors-conch" class="cp-group">
                <div class="cp-title">CONCH<br><span>Mono</span></div>
                <div class="cp-btn c-hitam active" onclick="changeColor('hitam', this, 'Black')"></div>
                <div class="cp-btn c-putih" onclick="changeColor('putih', this, 'White')"></div>
                <div class="cp-btn c-coklat" onclick="changeColor('coklat', this, 'Brown')"></div>
                <div class="cp-btn c-wood-golden" onclick="changeColor('wood-golden', this, 'Golden Wood')"></div>
                <div class="cp-btn c-wood-dark" onclick="changeColor('wood-dark', this, 'Dark Wood')"></div>
            </div>
            <div id="colors-falken" class="cp-group" style="display:none;">
                <div class="cp-title" style="color:#bfa145;">FALKEN<br><span style="color:#bfa145; font-weight:normal;">Luxury</span></div>
                <!-- Menunggu update warna falken -->
            </div>
            
            <hr style="width: 80%; border-top: 1px solid #e2e8f0; margin: 5px 0;">
            <div class="cp-btn" onclick="resetToWhite()" style="display:flex; align-items:center; justify-content:center; background:#f8fafc; border:1px solid #e2e8f0; cursor:pointer;" title="Reset Color">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
            </div>
        </div>
        </div>
    </div>
    
    <div class="pdl-right">
        <h1 class="pdl-title"><?php echo isset($data['title']) ? $data['title'] : 'Jendela Lipat uPVC'; ?></h1>
        <?php if(isset($data['subtitle'])): ?>
            <h3 class="pdl-subtitle"><?php echo $data['subtitle']; ?></h3>
        <?php endif; ?>
        

        
        <div class="pdl-desc">
            <?php echo isset($data['desc']) ? $data['desc'] : ''; ?>
        </div>
        
        <?php if(isset($data['features'])): ?>
            <div class="pdl-section-title"><?php echo isset($data['listTitle']) ? $data['listTitle'] : 'KEUNGGULAN:'; ?></div>
            <div class="pdl-features">
                <?php foreach($data['features'] as $f): ?>
                    <div class="pdl-feature-card">
                        <div class="pdl-check"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg></div>
                        <div class="pdl-ftext"><?php echo $f; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif(isset($data['list'])): ?>
            <div class="pdl-section-title"><?php echo isset($data['listTitle']) ? $data['listTitle'] : 'KEUNGGULAN:'; ?></div>
            <ul class="si-list">
                <?php foreach($data['list'] as $li): ?>
                    <li><?php echo $li; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        
        <?php if(isset($data['specs'])): ?>
            <div class="pdl-specs">
                <div class="pdl-specs-header">
                    <span class="pdl-sh-left">RINGKASAN SPESIFIKASI TEKNIS</span>
                    <span class="pdl-sh-right">CUSTOM SIZE AVAILABLE</span>
                </div>
                <div class="pdl-specs-body">
                    <?php foreach($data['specs'] as $k => $v): ?>
                        <div class="pdl-spec-row">
                            <div class="pdl-spec-k"><?php echo $k; ?></div>
                            <div class="pdl-spec-v"><?php echo $v; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        
        <a href="https://api.whatsapp.com/send/?phone=628111021088&text=Hi%2C+Saya+tertarik+dengan+produk+<?php echo urlencode($data['title']); ?>&type=phone_number&app_absent=0" target="_blank" class="pdl-btn-rab">
            <i class="icon-whatsapp" style="margin-right:8px; font-size: 20px; vertical-align:middle;"></i> KONSULTASI & ESTIMASI RAB
        </a>
      </div>
  </div>
  </div> <!-- Closes Single Item View div -->
  
  <?php endif; ?>
</div>
<script>
let currentSlide = 0;
function showSlide(index) {
    const slides = document.querySelectorAll('.si-slide-img');
    const dots = document.querySelectorAll('.si-dot');
    if (slides.length === 0) return;
    
    if (index >= slides.length) currentSlide = 0;
    else if (index < 0) currentSlide = slides.length - 1;
    else currentSlide = index;
    
    slides.forEach(slide => slide.style.display = 'none');
    dots.forEach(dot => dot.classList.remove('active'));
    
    slides[currentSlide].style.display = 'block';
    if(dots[currentSlide]) dots[currentSlide].classList.add('active');
}
function moveSlider(direction) {
    showSlide(currentSlide + direction);
}
function setSlider(index) {
    showSlide(index);
}

function openLightbox(src) {
    document.getElementById('lightboxImg').src = src;
    
    const mainImg = document.querySelector('.product-color-target');
    const lightboxImg = document.getElementById('lightboxImg');
    if(mainImg && lightboxImg) {
        const filterClassMatch = mainImg.className.match(/filter-[a-zA-Z-]+/);
        lightboxImg.className = 'lightbox-content'; 
        if (filterClassMatch) {
            lightboxImg.classList.add(filterClassMatch[0]);
        }
    }
    
    document.getElementById('imageLightbox').style.display = 'block';
}
function closeLightbox() {
    document.getElementById('imageLightbox').style.display = 'none';
}


function resetToWhite() {
    let activeBtn = document.querySelector('.conf-brand-btn.active');
    let activeBrand = activeBtn ? activeBtn.id.replace('btn-', '') : 'conch';
    
    let whiteBtn = document.querySelector('#colors-' + activeBrand + ' .c-putih');
    if(whiteBtn) {
        whiteBtn.click();
    } else {
        // Fallback if the brand has no white button yet
        changeColor('putih', null, 'White');
    }
}
</script>



<!-- Lightbox Modal -->
<div id="imageLightbox" class="lightbox" onclick="if(event.target !== document.getElementById('lightboxImg')) closeLightbox()">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img id="lightboxImg" class="lightbox-content">
</div>


<script>
function changeColor(colorName, btnElement, colorTextLabel) {
    document.querySelectorAll('.cp-btn').forEach(btn => btn.classList.remove('active'));
    
    if(btnElement) btnElement.classList.add('active');
    let nameLabel = document.getElementById('conf-color-name');
    if(nameLabel && colorTextLabel) {
        nameLabel.innerHTML = colorTextLabel;
    }
    
    const mainImg = document.querySelector('.product-color-target');
    if(!mainImg) return;
    
    // Get the base src (e.g. Jendela-Jungkit-2.png)
    let currentSrc = mainImg.getAttribute('data-base-src');
    if(!currentSrc) {
        currentSrc = mainImg.src;
        mainImg.setAttribute('data-base-src', currentSrc);
    }
    
    // Extract base filename without extension
    let fileName = currentSrc.substring(currentSrc.lastIndexOf('/') + 1);
    let baseName = fileName.replace(/\.[^/.]+$/, "");
    
    // In case the base src somehow already has a suffix, clean it
    baseName = baseName.replace(/-putih|-hitam|-coklat|-wood-dark|-wood-golden/g, "");
    
    // Determine extension (all files are now .png with transparent backgrounds)
    let ext = '.png';
    
    // Construct new src pointing to the theme directory
    const themeUrl = "<?php echo get_template_directory_uri(); ?>";
    let newSrc = themeUrl + '/img/upvc-colors/' + baseName + '-' + colorName + ext;
    
    // Smooth Crossfade Animation
    const clone = mainImg.cloneNode();
    clone.style.position = 'absolute';
    clone.style.inset = '0';
    clone.style.margin = 'auto';
    clone.style.maxWidth = '100%';
    clone.style.maxHeight = '400px';
    clone.style.objectFit = 'contain';
    clone.style.transition = 'opacity 0.3s ease-in-out';
    clone.style.zIndex = '5';
    mainImg.parentNode.appendChild(clone);
    
    // Update main image and fade out clone once new image loads
    mainImg.src = newSrc;
    mainImg.onload = () => {
        clone.style.opacity = '0';
        setTimeout(() => clone.remove(), 300);
    };
}


function switchBrand(brand) {
    document.querySelectorAll('.conf-brand-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.style.borderColor = 'transparent';
    });
    
    let activeBtn = document.getElementById('btn-' + brand);
    if(activeBtn) {
        activeBtn.classList.add('active');
        activeBtn.style.borderColor = brand === 'conch' ? '#041e3a' : '#bfa145';
    }
    
    document.getElementById('colors-conch').style.display = 'none';
    document.getElementById('colors-falken').style.display = 'none';
    
    let activeGroup = document.getElementById('colors-' + brand);
    if(activeGroup) {
        activeGroup.style.display = 'flex';
    }
    
    // Auto click first color of the selected brand
    let firstBtn = document.querySelector('#colors-' + brand + ' .cp-btn:nth-child(2)');
    if(firstBtn) {
        firstBtn.click();
    }
}
</script>
<?php get_footer(); ?>

