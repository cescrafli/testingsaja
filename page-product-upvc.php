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
        "title" => "Jendela Jungkit uPVC",
        "subtitle" => "Conch & Falken Awning / Hopper Window Architectural System",
        "img" => "Jendela-Jungkit-2.png",
        "badges" => ["Garansi Profil 10 Tahun", "Kedap Suara & Debu"],
        "green_badge" => "Double EPDM Weatherseal",
        "desc" => "<b>Jendela Jungkit (Awning Window)</b> adalah jendela dengan sistem engsel geser (<i>friction stay</i>) yang dibuka dengan cara mendorong bagian bawah daun ke arah luar atau membuka bagian atas ke arah dalam. Memungkinkan ventilasi udara tetap mengalir optimal bahkan saat hujan gerimis tanpa khawatir air tampias ke dalam ruangan.<br><br>Dilengkapi penguncian multi-titik dan karet peredam ganda EPDM yang menjamin kekedapan akustik serta efisiensi pendingin ruangan (AC).",
        "listTitle" => "PILIHAN TIPE JENDELA JUNGKIT:",
        "features" => [
            "<b>Sirkulasi Bebas Tampias:</b> Sudut bukaan miring melindungi interior dari percikan air hujan saat ventilasi terbuka.",
            "<b>Engsel Geser Stainless Steel:</b> Menggunakan friction stay heavy-duty yang kokoh menahan daun jendela pada berbagai sudut bukaan.",
            "<b>Multi-Chamber Insulation:</b> Ruang insulasi udara multi-sekat yang efektif meredam kebisingan luar dan panas matahari.",
            "<b>Kekedapan Ganda EPDM:</b> Karet gasket sintetis lentur tahan lama yang mengunci rapat celah daun jendela."
        ],
        "specs" => [
            "Arah Bukaan:" => "Jungkit Luar (Awning) / Jungkit Dalam (Hopper)",
            "Pilihan Profil:" => "uPVC Conch & Falken (White / Color Series)",
            "Spesifikasi Kaca:" => "Single Glass 5mm - 8mm / Double Glass",
            "Hardware & Engsel:" => "Friction Stay Stainless 304 & Casement Handle",
            "Rangka Penguat:" => "Galvanized Steel Core 1.5mm (Anti-Karat)"
        ],
        "short_desc" => "<b>Jendela Jungkit</b> adalah jendela yang dibuka dengan cara mendorong bagian bawah daun jendela, sehingga daun jendela terbuka miring ke depan.",
        "short_listTitle" => "Tipe -tipe Jendela Jungkit:",
        "short_list" => [
            "Jendela Jungkit Single",
            "Jendela Jungkit 1/2/3/4/5 Daun (sesuai request)",
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

/* Sub Container */
.prod-sub-container {
    padding: 140px 20px 80px !important;
    max-width: 1240px !important;
    margin: 0 auto !important;
    text-align: left !important;
    box-sizing: border-box !important;
}
.prod-sub-subtitle {
    font-size: 14px;
    font-weight: 700;
    color: #cba85d;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-bottom: 12px;
    font-family: 'Outfit', sans-serif;
    text-align: center;
}
.prod-sub-title {
    font-size: 42px;
    font-weight: 800;
    color: #041e3a;
    margin-bottom: 50px;
    font-family: 'Outfit', sans-serif;
    text-align: center;
}

/* Main & Detailed Grid for Index/Pintu/Jendela Views */
.prod-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 30px; text-align: center; justify-content: center; }
@media(max-width: 575px) { .prod-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; } }
.prod-card { display: flex; flex-direction: column; align-items: center; cursor: pointer; transition: transform 0.3s; text-decoration: none; }
.prod-card:hover { transform: translateY(-5px); }
.prod-card-img { width: 100%; aspect-ratio: 1/1; object-fit: cover; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
.prod-card-title { font-size: 24px; font-weight: 700; color: #1a202c; }

.detail-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px; margin-top: 40px; }
@media(max-width: 991px) { .detail-grid { grid-template-columns: repeat(2, 1fr); } }
@media(max-width: 575px) { .detail-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; } }

.detail-card { display: flex; flex-direction: column; text-align: center; background: #fff; cursor: pointer; transition: transform 0.3s; text-decoration: none; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.04); }
.detail-card:hover { transform: translateY(-5px); }
.detail-card-img-wrapper { padding: 0; display: flex; align-items: center; justify-content: center; width: 100%; aspect-ratio: 1/1; background: #f8fafc; position: relative; }
.detail-card-img { width: 100%; height: 100%; object-fit: contain; padding: 15px; box-sizing: border-box; }
.detail-card-text { padding: 18px 12px; }
.detail-card-cat { font-size: 13px; color: #cba85d; margin-bottom: 6px; font-weight: 600; text-transform: uppercase; }
.detail-card-title { font-size: 16px; font-weight: 700; color: #041e3a; }

/* Back Button */
.pdl-back-wrapper { margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between; }
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #f1f5f9;
    padding: 10px 20px;
    border-radius: 8px;
    color: #041e3a;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    border: 1px solid #e2e8f0;
    transition: all 0.25s ease;
}
.back-btn:hover {
    background: #041e3a;
    color: #fff;
    border-color: #041e3a;
    transform: translateX(-3px);
}

/* =========================================================
   SINGLE PRODUCT CONFIGURATOR LAYOUT (NO FOOTER COLLISION)
   ========================================================= */
.product-detail-layout {
    display: grid !important;
    grid-template-columns: minmax(350px, 480px) minmax(360px, 1fr) !important;
    gap: 45px !important;
    align-items: start !important;
    margin-bottom: 50px !important;
    box-sizing: border-box !important;
    text-align: left !important;
}

@media(max-width: 991px) {
    .product-detail-layout {
        grid-template-columns: 1fr !important;
        gap: 35px !important;
    }
}

/* --- Left Column: Interactive Visualizer Card --- */
.pdl-left {
    display: flex !important;
    flex-direction: column !important;
    gap: 16px !important;
    position: relative !important;
    top: 0 !important;
    width: 100% !important;
    box-sizing: border-box !important;
}

/* Brand Selector Buttons */
.conf-top-bar {
    display: flex;
    gap: 12px;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 5px;
}
.conf-brand-btn {
    background: #ffffff;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    padding: 8px 18px;
    cursor: pointer;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 52px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
.conf-brand-btn img {
    height: 32px;
    width: auto;
    object-fit: contain;
}
.conf-brand-btn:hover {
    border-color: #cbd5e1;
    transform: translateY(-2px);
}
.conf-brand-btn.active {
    border-color: #041e3a !important;
    background: #f8fafc !important;
    box-shadow: 0 4px 14px rgba(4, 30, 58, 0.12) !important;
}

/* Main Visualizer Stage */
.conf-main-box {
    background: #ffffff !important;
    border: 2px solid #e2e8f0 !important;
    border-radius: 16px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05) !important;
    position: relative !important;
    overflow: hidden !important;
    display: flex !important;
    flex-direction: column !important;
    width: 100% !important;
    box-sizing: border-box !important;
    transition: border-color 0.3s ease;
}
.conf-main-box:hover {
    border-color: #cbd5e1 !important;
}

.conf-image-area {
    padding: 30px 25px !important;
    height: 440px !important;
    max-height: 480px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    position: relative !important;
    background: radial-gradient(circle at center, #ffffff 0%, #f8fafc 100%) !important;
    overflow: hidden !important;
    box-sizing: border-box !important;
}

.product-color-target {
    max-width: 100% !important;
    max-height: 100% !important;
    width: auto !important;
    height: auto !important;
    object-fit: contain !important;
    cursor: zoom-in !important;
    transition: transform 0.3s ease;
    display: block !important;
    margin: 0 auto !important;
}
.product-color-target:hover {
    transform: scale(1.02);
}

/* Bottom info inside stage */
.conf-stage-footer {
    position: absolute;
    bottom: 15px;
    left: 15px;
    right: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    pointer-events: none;
    z-index: 10;
}
.conf-mekanisme {
    background: #041e3a;
    color: #ffffff;
    padding: 6px 15px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(0,0,0,0.18);
    display: inline-flex;
    align-items: center;
    gap: 6px;
    letter-spacing: 0.5px;
    border: 1px solid rgba(203, 168, 93, 0.4);
}
.conf-zoom-hint {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(4px);
    color: #475569;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    pointer-events: auto;
    cursor: pointer;
    transition: all 0.2s;
}
.conf-zoom-hint:hover {
    background: #041e3a;
    color: #ffffff;
    border-color: #041e3a;
}

/* Slider Controls (if multiple images) */
.si-arrow { position: absolute; top: 50%; transform: translateY(-50%); color: #041e3a; background: rgba(255,255,255,0.85); width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; cursor: pointer; box-shadow: 0 2px 8px rgba(0,0,0,0.15); z-index: 15; transition: 0.2s; }
.si-arrow:hover { background: #041e3a; color: #fff; }
.si-arrow-left { left: 15px; }
.si-arrow-right { right: 15px; }
.si-dots { position: absolute; bottom: 55px; left: 0; width: 100%; display: flex; justify-content: center; gap: 8px; z-index: 15; }
.si-dot { width: 8px; height: 8px; background: #cbd5e1; border-radius: 50%; cursor: pointer; transition: 0.2s; }
.si-dot.active { background: #041e3a; transform: scale(1.2); }

/* Integrated Color Selector Bar (Directly below image) */
.conf-swatches-panel {
    background: #ffffff;
    border-top: 1.5px solid #e2e8f0;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 12px;
    box-sizing: border-box;
}
.conf-swatches-left {
    display: flex;
    align-items: center;
    gap: 14px;
    flex-wrap: wrap;
}
.conf-swatches-title {
    font-size: 13px;
    font-weight: 800;
    color: #041e3a;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    white-space: nowrap;
}
.conf-swatches-list {
    display: flex;
    align-items: center;
    gap: 10px;
}
.cp-btn {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    border: 2px solid #fff;
    outline: 2px solid #e2e8f0;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    position: relative;
    box-sizing: border-box;
}
.cp-btn:hover {
    transform: scale(1.15);
    outline-color: #94a3b8;
}
.cp-btn.active {
    outline: 3px solid #041e3a !important;
    transform: scale(1.15);
    box-shadow: 0 4px 12px rgba(4, 30, 58, 0.25);
}
.c-hitam { background: #1a1a1a; }
.c-putih { background: #ffffff; border: 2px solid #e2e8f0; }
.c-coklat { background: #5c4033; }
.c-wood-golden { background: #b8860b; }
.c-wood-dark { background: #4a3c31; }

/* Falken Custom Swatches */
.f-white { background: #f8fafc; border: 2px solid #cbd5e1; }
.f-black { background: #18181b; }
.f-grey { background: #71717a; }
.f-ivory { background: #f5f5dc; border: 2px solid #e2e8f0; }
.f-bronze { background: #5c4033; }
.f-glitter { background: radial-gradient(circle, #3f3f46 0%, #18181b 100%); border: 1px solid #71717a; }
.f-stainless { background: linear-gradient(135deg, #cbd5e1 0%, #94a3b8 50%, #64748b 100%); }
.f-walnut { background: #4a2c11; }
.f-japanese-oak { background: #c2a688; }
.f-golden-oak { background: #b47d44; }
.f-dark-oak { background: #38220f; }

.conf-swatches-reset {
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    padding: 6px 12px;
    color: #64748b;
    font-size: 12px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s;
}
.conf-swatches-reset:hover {
    background: #041e3a;
    color: #ffffff;
    border-color: #041e3a;
}

/* --- Right Column: Clean Typography & Features --- */
.pdl-right {
    display: flex !important;
    flex-direction: column !important;
    box-sizing: border-box !important;
    text-align: left !important;
}
.pdl-badge-category {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(203, 168, 93, 0.15);
    color: #8b681f;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
    width: fit-content;
}
.pdl-title {
    font-size: 34px !important;
    font-weight: 800 !important;
    color: #041e3a !important;
    line-height: 1.2 !important;
    margin: 0 0 12px 0 !important;
    font-family: 'Outfit', sans-serif !important;
}
.pdl-subtitle {
    font-size: 16px !important;
    color: #64748b !important;
    font-weight: 500 !important;
    margin: 0 0 20px 0 !important;
    line-height: 1.5 !important;
}
.pdl-trust-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 22px;
}
.pdl-trust-pill {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: #475569;
    font-size: 12px;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.pdl-trust-pill.green {
    background: #ecfdf5;
    border-color: #a7f3d0;
    color: #059669;
}

.pdl-desc {
    font-size: 15px !important;
    color: #334155 !important;
    line-height: 1.8 !important;
    margin-bottom: 28px !important;
}
.pdl-desc b {
    color: #041e3a;
}

/* Feature Checklist Cards */
.pdl-section-title {
    font-size: 13px !important;
    font-weight: 800 !important;
    color: #041e3a !important;
    letter-spacing: 1px !important;
    text-transform: uppercase !important;
    margin-bottom: 14px !important;
    display: flex;
    align-items: center;
    gap: 8px;
}
.pdl-feature-grid {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 30px;
}
.pdl-feature-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 12px 16px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    transition: all 0.2s ease;
}
.pdl-feature-card:hover {
    background: #ffffff;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
    border-color: #cbd5e1;
}
.pdl-check-icon {
    width: 20px;
    height: 20px;
    background: #cba85d;
    color: #041e3a;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    margin-top: 2px;
}
.pdl-feature-text {
    font-size: 14px;
    color: #334155;
    line-height: 1.5;
}

/* Technical Specs Table */
.pdl-specs {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    margin-bottom: 32px;
    overflow: hidden;
    background: #ffffff;
}
.pdl-specs-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 20px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
}
.pdl-sh-left { font-size: 12px; font-weight: 800; color: #041e3a; letter-spacing: 0.5px; }
.pdl-sh-right { font-size: 11px; font-weight: 700; color: #cba85d; text-transform: uppercase; }
.pdl-specs-body { padding: 0 20px; }
.pdl-spec-row { display: flex; padding: 13px 0; border-bottom: 1px dashed #e2e8f0; }
.pdl-spec-row:last-child { border-bottom: none; }
.pdl-spec-k { flex: 1 1 40%; font-size: 13px; color: #64748b; font-weight: 500; }
.pdl-spec-v { flex: 1 1 60%; font-size: 13px; font-weight: 700; color: #041e3a; }

/* WhatsApp CTA Button */
.pdl-btn-rab {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    width: 100% !important;
    background: linear-gradient(135deg, #cba85d 0%, #b38e42 100%) !important;
    color: #041e3a !important;
    padding: 17px 24px !important;
    border-radius: 12px !important;
    font-weight: 800 !important;
    font-size: 16px !important;
    text-decoration: none !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 8px 25px rgba(203, 168, 93, 0.35) !important;
    letter-spacing: 0.5px !important;
    box-sizing: border-box !important;
}
.pdl-btn-rab:hover {
    background: linear-gradient(135deg, #041e3a 0%, #0a2f58 100%) !important;
    color: #ffffff !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 12px 30px rgba(4, 30, 58, 0.25) !important;
}

/* Lightbox Modal */
.lightbox { display: none; position: fixed; z-index: 999999; padding-top: 60px; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(4, 30, 58, 0.95); backdrop-filter: blur(8px); }
.lightbox-content { margin: auto; display: block; max-width: 90%; max-height: 85vh; object-fit: contain; animation: zoomIn 0.3s; border-radius: 8px; }
.lightbox-close { position: absolute; top: 20px; right: 35px; color: #ffffff; font-size: 40px; font-weight: bold; cursor: pointer; transition: 0.3s; }
.lightbox-close:hover { color: #cba85d; }
@keyframes zoomIn { from {transform:scale(0.9); opacity:0;} to {transform:scale(1); opacity:1;} }

/* Card Hover Banner */
.hover-banner {
    position: absolute; top: 50%; left: 15%; right: 15%; transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.95); padding: 12px 10px; text-align: center;
    font-size: 16px; font-weight: 900; color: #041e3a; letter-spacing: 0.5px;
    font-family: 'Outfit', sans-serif;
    text-transform: uppercase;
    border-radius: 6px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
    pointer-events: none;
    z-index: 2;
}
.prod-card-img-wrapper, .detail-card-img-wrapper { position: relative; width: 100%; overflow: hidden; }
.prod-card-img-wrapper { margin-bottom: 20px; border-radius: 8px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
.prod-card-img { margin-bottom: 0 !important; border-radius: 0 !important; box-shadow: none !important; }
.prod-card-img-wrapper::after, .detail-card-img-wrapper::after {
    content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(4, 30, 58, 0.4); opacity: 0; transition: opacity 0.3s ease; z-index: 1;
}
.prod-card:hover .prod-card-img-wrapper::after, .detail-card:hover .detail-card-img-wrapper::after { opacity: 1; }
.prod-card:hover .hover-banner, .detail-card:hover .hover-banner { opacity: 1; }
</style>

<div class="prod-sub-container container">
    <?php if ($view == 'main'): ?>
    <div style="text-align: left; margin-bottom: 20px; position: relative;">
        <a href="<?php echo home_url('/product/'); ?>" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali</a>
    </div>
    <!-- Main Options -->
    <div>
        <div style="position: relative; max-width: 700px; margin: 0 auto 60px; text-align:center;">
            <img src="<?php echo get_template_directory_uri(); ?>/img/badge_warranty.png?v=1787832010" alt="10 Year Warranty" style="position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 120px; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1)); z-index: 10;">
            <div class="prod-sub-subtitle">PRODUK ARSITEKTURAL</div>
            <h1 class="prod-sub-title" style="margin-bottom: 0;">Sistem Kusen & Pintu Jendela uPVC</h1>
        </div>
        
        <div class="prod-grid" style="max-width: 700px; margin: 0 auto;">
            <a href="?view=jendela" class="prod-card">
                <div class="prod-card-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/img/jendelaupvc.jpeg" alt="Jendela" class="prod-card-img"><div class="hover-banner">LIHAT MODEL</div></div>
                <div class="prod-card-title">Jendela uPVC</div>
            </a>
            <a href="?view=pintu" class="prod-card">
                <div class="prod-card-img-wrapper"><img src="<?php echo get_template_directory_uri(); ?>/img/pintuupvc.jpeg" alt="Pintu" class="prod-card-img"><div class="hover-banner">LIHAT MODEL</div></div>
                <div class="prod-card-title">Pintu uPVC</div>
            </a>
        </div>
    </div>
    
    <?php elseif ($view == 'jendela'): ?>
    <!-- Jendela Grid View -->
    <div>
        <div style="text-align: left;"><a href="?" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali ke Kategori</a></div>
        <div class="prod-sub-subtitle">KATALOG MODEL</div>
        <h2 class="prod-sub-title" style="margin-bottom: 40px;">Pilihan Jendela uPVC</h2>
        
        <div class="detail-grid">
            <?php foreach($jendela_items as $item): ?>
                <a href="?view=single&item=<?php echo $item['id']; ?>&parent=jendela" class="detail-card">
                    <div class="detail-card-img-wrapper">
                        <img src="<?php echo $upload_dir . $item['gif']; ?>" alt="<?php echo $item['title']; ?>" class="detail-card-img" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg';">
                        <div class="hover-banner">LIHAT DETAIL</div>
                    </div>
                    <div class="detail-card-text">
                        <div class="detail-card-cat">Jendela uPVC</div>
                        <div class="detail-card-title"><?php echo $item['title']; ?></div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php elseif ($view == 'pintu'): ?>
    <!-- Pintu Grid View -->
    <div>
        <div style="text-align: left;"><a href="?" class="back-btn"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg> Kembali ke Kategori</a></div>
        <div class="prod-sub-subtitle">KATALOG MODEL</div>
        <h2 class="prod-sub-title" style="margin-bottom: 40px;">Pilihan Pintu uPVC</h2>
        
        <div class="detail-grid">
            <?php foreach($pintu_items as $item): ?>
                <a href="?view=single&item=<?php echo $item['id']; ?>&parent=pintu" class="detail-card">
                    <div class="detail-card-img-wrapper">
                        <img src="<?php echo $upload_dir . $item['gif']; ?>" alt="<?php echo $item['title']; ?>" class="detail-card-img" onerror="this.src='<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg';">
                        <div class="hover-banner">LIHAT DETAIL</div>
                    </div>
                    <div class="detail-card-text">
                        <div class="detail-card-cat">Pintu uPVC</div>
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
        foreach (array_merge($jendela_items, $pintu_items) as $arr_item) {
            if ($arr_item['id'] === $item_id) {
                $fallback_title = $arr_item['title'];
                $fallback_gif = $arr_item['gif'];
                break;
            }
        }
        
        $data = isset($pData[$item_id]) ? $pData[$item_id] : [
            'cat' => ucfirst($parent),
            'title' => $fallback_title,
            'img' => $fallback_gif,
            'desc' => 'Deskripsi untuk produk ini belum tersedia. Silakan hubungi tim kami untuk informasi lebih detail mengenai spesifikasi teknis dan estimasi biaya pemesanan.',
            'listTitle' => 'Keunggulan Produk:',
            'list' => [
                'Material uPVC Conch & Falken bermutu tinggi',
                'Tahan cuaca tropis, kedap suara, dan anti rayap',
                'Presisi tinggi dengan perkuatan besi galvanis internal'
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
            
            preg_match_all('/<img[^>]+src="([^">]+)"/', $raw_content, $matches);
            if (!empty($matches[1])) {
                $user_images = $matches[1];
            }
            
            if (empty($user_images) && has_post_thumbnail($c_post->ID)) {
                $user_images[] = get_the_post_thumbnail_url($c_post->ID, 'large') ?: get_the_post_thumbnail_url($c_post->ID, 'full');
            }
            
            $text_content = preg_replace('/<figure[^>]*>.*?<\/figure>/is', '', $raw_content);
            $text_content = preg_replace('/<ul[^>]*wp-block-gallery[^>]*>.*?<\/ul>/is', '', $text_content);
            $text_content = preg_replace('/<img[^>]+>/is', '', $text_content);
            $user_uploaded_content = trim($text_content);
            
            if(!empty($user_uploaded_content)) {
                $data['desc'] = $user_uploaded_content;
            }
            
            $meta_subtitle = get_post_meta($c_post->ID, 'subtitle', true);
            if(!empty($meta_subtitle)) $data['subtitle'] = $meta_subtitle;
            
            $meta_listTitle = get_post_meta($c_post->ID, 'listTitle', true);
            if(!empty($meta_listTitle)) $data['listTitle'] = $meta_listTitle;
            
            $meta_badges = get_post_meta($c_post->ID, 'badges', true);
            if(!empty($meta_badges)) $data['badges'] = array_map('trim', explode(',', $meta_badges));
            
            $meta_green_badge = get_post_meta($c_post->ID, 'green_badge', true);
            if(!empty($meta_green_badge)) $data['green_badge'] = $meta_green_badge;
            
            $meta_features = get_post_meta($c_post->ID, 'features', true);
            if(!empty($meta_features)) {
                $data['features'] = array_filter(array_map('trim', explode("\n", $meta_features)));
            }
            
            $meta_specs = get_post_meta($c_post->ID, 'specs', true);
            if(!empty($meta_specs)) {
                $parsed_specs = [];
                $lines = array_filter(array_map('trim', explode("\n", $meta_specs)));
                foreach($lines as $line) {
                    $parts = explode(':', $line, 2);
                    if(count($parts) == 2) {
                        $parsed_specs[trim($parts[0])] = trim($parts[1]);
                    } else {
                        $parsed_specs[] = trim($line);
                    }
                }
                if(!empty($parsed_specs)) $data['specs'] = $parsed_specs;
            }
        }
    ?>
    <!-- Single Item View -->
    <div>
        <div class="pdl-back-wrapper">
            <a href="?view=<?php echo esc_attr($parent); ?>" class="back-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                <span>Kembali ke Katalog <?php echo ucfirst(esc_html($parent)); ?></span>
            </a>
        </div>
        
        <div class="product-detail-layout">
            <!-- Left Column: Product Visualizer -->
            <div class="pdl-left">
                <!-- Brand Selector -->
                <div class="conf-top-bar">
                    <button type="button" class="conf-brand-btn active" id="btn-conch" onclick="switchBrand('conch')" title="Pilih Profil CONCH">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/brands/brand-custom-2.png" alt="CONCH">
                    </button>
                    <button type="button" class="conf-brand-btn" id="btn-falken" onclick="switchBrand('falken')" title="Pilih Profil FALKEN">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/brands/btn-falken.png" alt="FALKEN">
                    </button>
                </div>
                
                <!-- Main Box / Window Stage -->
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
                                <img class="si-slide-img product-color-target" onclick="openLightbox(this.src)" src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($data['title']); ?>" style="<?php echo ($index == 0) ? 'display:block;' : 'display:none;'; ?>">
                            <?php endforeach; ?>
                        <?php else: ?>
                            <img src="<?php echo esc_url($upload_dir . $data['img']); ?>" alt="<?php echo esc_attr($data['title']); ?>" class="product-color-target" onclick="openLightbox(this.src)" data-base-src="<?php echo esc_url($upload_dir . $data['img']); ?>" data-item-id="<?php echo esc_attr($item_id); ?>">
                        <?php endif; ?>

                        <div class="conf-stage-footer">
                            <div id="conf-color-name" class="conf-mekanisme">
                                <span style="font-size:11px; opacity:0.8; font-weight:normal; text-transform:uppercase;">Warna:</span> <span style="color:#041e3a; font-weight:700;">CONCH</span> Black
                            </div>
                            <div class="conf-zoom-hint" onclick="document.querySelector('.product-color-target').click();" title="Klik untuk memperbesar gambar">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                                <span>Perbesar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Integrated Swatches Panel Directly Below Image -->
                    <div class="conf-swatches-panel">
                        <div class="conf-swatches-left">
                            <span class="conf-swatches-title">Pilihan Warna:</span>
                            <div id="colors-conch" class="conf-swatches-list">
                                <div class="cp-btn c-hitam active" onclick="changeColor('hitam', this, 'Black', 'conch')" title="CONCH Hitam / Black"></div>
                                <div class="cp-btn c-putih" onclick="changeColor('putih', this, 'White', 'conch')" title="CONCH Putih / White"></div>
                                <div class="cp-btn c-coklat" onclick="changeColor('coklat', this, 'Brown', 'conch')" title="CONCH Coklat / Brown"></div>
                                <div class="cp-btn c-wood-golden" onclick="changeColor('wood-golden', this, 'Golden Wood', 'conch')" title="CONCH Kayu Golden / Golden Wood"></div>
                                <div class="cp-btn c-wood-dark" onclick="changeColor('wood-dark', this, 'Dark Wood', 'conch')" title="CONCH Kayu Gelap / Dark Wood"></div>
                            </div>
                            <?php if ($item_id === 'jendela-jungkit'): ?>
                            <div id="colors-falken" class="conf-swatches-list" style="display:none; flex-wrap:wrap; gap:8px;">
                                <div class="cp-btn f-white active" onclick="changeColor('standard-white', this, 'Standard White', 'falken')" title="FALKEN Standard White"></div>
                                <div class="cp-btn f-black" onclick="changeColor('standard-black', this, 'Standard Black', 'falken')" title="FALKEN Standard Black"></div>
                                <div class="cp-btn f-grey" onclick="changeColor('laminate-grey', this, 'Laminate Grey', 'falken')" title="FALKEN Laminate Grey"></div>
                                <div class="cp-btn f-ivory" onclick="changeColor('laminate-ivory-white', this, 'Laminate Ivory White', 'falken')" title="FALKEN Laminate Ivory White"></div>
                                <div class="cp-btn f-bronze" onclick="changeColor('laminate-bronze', this, 'Laminate Bronze', 'falken')" title="FALKEN Laminate Bronze"></div>
                                <div class="cp-btn f-glitter" onclick="changeColor('laminate-black-glitter', this, 'Laminate Black Glitter', 'falken')" title="FALKEN Laminate Black Glitter"></div>
                                <div class="cp-btn f-stainless" onclick="changeColor('laminate-stainless-lux', this, 'Laminate Stainless Lux', 'falken')" title="FALKEN Laminate Stainless Lux"></div>
                                <div class="cp-btn f-walnut" onclick="changeColor('laminate-walnut', this, 'Laminate Walnut', 'falken')" title="FALKEN Laminate Walnut"></div>
                                <div class="cp-btn f-japanese-oak" onclick="changeColor('laminate-japanese-oak', this, 'Laminate Japanese Oak', 'falken')" title="FALKEN Laminate Japanese Oak"></div>
                                <div class="cp-btn f-golden-oak" onclick="changeColor('laminate-golden-oak', this, 'Laminate Golden Oak', 'falken')" title="FALKEN Laminate Golden Oak"></div>
                                <div class="cp-btn f-dark-oak" onclick="changeColor('laminate-dark-oak', this, 'Laminate Dark Oak', 'falken')" title="FALKEN Laminate Dark Oak"></div>
                            </div>
                            <?php else: ?>
                            <div id="colors-falken" class="conf-swatches-list" style="display:none;">
                                <span style="font-size:12px; color:#94a3b8; font-style:italic;">Katalog warna FALKEN segera hadir</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="conf-swatches-reset" onclick="resetToWhite()" title="Kembalikan ke warna Putih">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
                            <span>Reset</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Product Info & Actions -->
            <div class="pdl-right">
                <span class="pdl-badge-category">uPVC <?php echo isset($data['cat']) ? esc_html($data['cat']) : 'Architectural'; ?> Series</span>
                <h1 class="pdl-title"><?php echo isset($data['title']) ? esc_html($data['title']) : 'Jendela Lipat uPVC'; ?></h1>
                
                <?php if(isset($data['subtitle'])): ?>
                    <h3 class="pdl-subtitle"><?php echo esc_html($data['subtitle']); ?></h3>
                <?php endif; ?>
                
                <div class="pdl-trust-badges">
                    <?php if(isset($data['badges'])): ?>
                        <?php foreach($data['badges'] as $b): ?>
                            <span class="pdl-trust-pill">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#cba85d" stroke-width="2.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                                <?php echo esc_html($b); ?>
                            </span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if(isset($data['green_badge'])): ?>
                        <span class="pdl-trust-pill green">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            <?php echo esc_html($data['green_badge']); ?>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="pdl-desc">
                    <?php echo isset($data['desc']) ? $data['desc'] : ''; ?>
                </div>
                
                <?php if(isset($data['features'])): ?>
                    <div class="pdl-section-title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#cba85d" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <?php echo isset($data['listTitle']) ? esc_html($data['listTitle']) : 'KEUNGGULAN PRODUK:'; ?>
                    </div>
                    <div class="pdl-feature-grid">
                        <?php foreach($data['features'] as $f): ?>
                            <div class="pdl-feature-card">
                                <div class="pdl-check-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
                                <div class="pdl-feature-text"><?php echo $f; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php elseif(isset($data['list'])): ?>
                    <div class="pdl-section-title">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#cba85d" stroke-width="2.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                        <?php echo isset($data['listTitle']) ? esc_html($data['listTitle']) : 'TIPE-TIPE PILIHAN:'; ?>
                    </div>
                    <div class="pdl-feature-grid">
                        <?php foreach($data['list'] as $li): ?>
                            <div class="pdl-feature-card">
                                <div class="pdl-check-icon"><svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg></div>
                                <div class="pdl-feature-text"><?php echo $li; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
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
                                    <div class="pdl-spec-k"><?php echo esc_html($k); ?></div>
                                    <div class="pdl-spec-v"><?php echo esc_html($v); ?></div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <a href="https://api.whatsapp.com/send/?phone=628111021088&text=Hi%2C+Saya+tertarik+dengan+produk+<?php echo urlencode($data['title']); ?>&type=phone_number&app_absent=0" target="_blank" class="pdl-btn-rab">
                    <svg width="22" height="22" viewBox="0 0 448 512" fill="currentColor"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/></svg>
                    <span>KONSULTASI & ESTIMASI RAB</span>
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
    
    if(activeBrand === 'falken') {
        let whiteBtn = document.querySelector('#colors-falken .f-white');
        if(whiteBtn) {
            whiteBtn.click();
        } else {
            let firstFalken = document.querySelector('#colors-falken .cp-btn:first-child');
            if(firstFalken) firstFalken.click();
        }
    } else {
        let whiteBtn = document.querySelector('#colors-conch .c-putih');
        if(whiteBtn) {
            whiteBtn.click();
        } else {
            changeColor('putih', null, 'White', 'conch');
        }
    }
}
</script>

<!-- Lightbox Modal -->
<div id="imageLightbox" class="lightbox" onclick="if(event.target !== document.getElementById('lightboxImg')) closeLightbox()">
    <span class="lightbox-close" onclick="closeLightbox()">&times;</span>
    <img id="lightboxImg" class="lightbox-content" alt="Lightbox Preview">
</div>

<script>
function changeColor(colorName, btnElement, colorTextLabel, brand) {
    brand = brand || 'conch';
    
    // Deselect other buttons in same group
    const brandContainer = document.getElementById('colors-' + brand);
    if(brandContainer) {
        brandContainer.querySelectorAll('.cp-btn').forEach(btn => btn.classList.remove('active'));
    } else {
        document.querySelectorAll('.cp-btn').forEach(btn => btn.classList.remove('active'));
    }
    
    if(btnElement) btnElement.classList.add('active');
    
    let nameLabel = document.getElementById('conf-color-name');
    if(nameLabel && colorTextLabel) {
        const brandBadge = brand === 'falken' ? '<span style="color:#041e3a; font-weight:700;">FALKEN</span> ' : '<span style="color:#041e3a; font-weight:700;">CONCH</span> ';
        nameLabel.innerHTML = '<span style="font-size:11px; opacity:0.8; font-weight:normal; text-transform:uppercase;">Warna:</span> ' + brandBadge + colorTextLabel;
    }
    
    const mainImg = document.querySelector('.product-color-target');
    if(!mainImg) return;
    
    const themeUrl = "<?php echo get_template_directory_uri(); ?>";
    let newSrc = '';
    
    if(brand === 'falken') {
        const itemId = mainImg.getAttribute('data-item-id') || 'jendela-jungkit';
        newSrc = themeUrl + '/img/falken/' + itemId + '/' + colorName + '.jpg';
    } else {
        let currentSrc = mainImg.getAttribute('data-base-src');
        if(!currentSrc) {
            currentSrc = mainImg.src;
            mainImg.setAttribute('data-base-src', currentSrc);
        }
        let fileName = currentSrc.substring(currentSrc.lastIndexOf('/') + 1);
        let baseName = fileName.replace(/\.[^/.]+$/, "");
        baseName = baseName.replace(/-putih|-hitam|-coklat|-wood-dark|-wood-golden/g, "");
        newSrc = themeUrl + '/img/upvc-colors/' + baseName + '-' + colorName + '.png';
    }
    
    // Smooth Crossfade Animation
    const clone = mainImg.cloneNode();
    clone.style.position = 'absolute';
    clone.style.inset = '0';
    clone.style.margin = 'auto';
    clone.style.maxWidth = '100%';
    clone.style.maxHeight = '100%';
    clone.style.objectFit = 'contain';
    clone.style.transition = 'opacity 0.25s ease-in-out';
    clone.style.zIndex = '5';
    mainImg.parentNode.appendChild(clone);
    
    // Update main image and fade out clone once new image loads
    mainImg.src = newSrc;
    mainImg.onload = () => {
        clone.style.opacity = '0';
        setTimeout(() => clone.remove(), 250);
    };
    mainImg.onerror = () => {
        clone.remove();
    };
}

function switchBrand(brand) {
    document.querySelectorAll('.conf-brand-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    let activeBtn = document.getElementById('btn-' + brand);
    if(activeBtn) {
        activeBtn.classList.add('active');
    }
    
    document.getElementById('colors-conch').style.display = 'none';
    document.getElementById('colors-falken').style.display = 'none';
    
    let activeGroup = document.getElementById('colors-' + brand);
    if(activeGroup) {
        activeGroup.style.display = 'flex';
    }
    
    // Auto click first active or first color of the selected brand
    let activeSwatch = document.querySelector('#colors-' + brand + ' .cp-btn.active');
    if(!activeSwatch) {
        activeSwatch = document.querySelector('#colors-' + brand + ' .cp-btn:first-child');
    }
    if(activeSwatch) {
        activeSwatch.click();
    }
}
</script>
<?php get_footer(); ?>
