<?php
/**
 * ACP - halaman detail (redesign).
 * Di-include dari page-product-fasad.php. Header & footer tema tidak diubah.
 * Variabel tersedia: $upload_dir
 */

$cw_wa_number = '628111021088';
$cw_wa_text   = rawurlencode('Halo Griya Djaya Sentosa, saya tertarik dengan fasad ACP dan ingin konsultasi serta survey untuk proyek saya.');
$cw_wa_link   = 'https://api.whatsapp.com/send/?phone=' . $cw_wa_number . '&text=' . $cw_wa_text . '&type=phone_number&app_absent=0';

$cw_hero_img = $upload_dir . 'ACP-2-1.png';

// Foto galeri: ambil dari post CPT "gjs_produk" bernama fasad-curtain-wall (jika ada)
$cw_gallery = array();
$cw_posts = get_posts(array(
    'name'        => 'fasad-acp',
    'post_type'   => 'gjs_produk',
    'post_status' => 'publish',
    'numberposts' => 1,
));
if ($cw_posts) {
    $cw_raw = apply_filters('the_content', $cw_posts[0]->post_content);
    preg_match_all('/<img[^>]+src="([^">]+)"/', $cw_raw, $cw_m);
    if (!empty($cw_m[1])) { $cw_gallery = array_values(array_unique($cw_m[1])); }
    if (empty($cw_gallery) && has_post_thumbnail($cw_posts[0]->ID)) {
        $cw_gallery[] = get_the_post_thumbnail_url($cw_posts[0]->ID, 'large') ?: get_the_post_thumbnail_url($cw_posts[0]->ID, 'full');
    }
}
$cw_gal_count = count($cw_gallery);
if (empty($cw_gallery)) { $cw_gallery = array($cw_hero_img); }
$cw_gallery = array_slice($cw_gallery, 0, 9);

$cw_features = array(
    array('Warna Tetap Segar', 'ACP tipe eksterior memakai coating khusus yang tahan panas, hujan, dan polusi.', 'M12 3v18M3 12h18M5.6 5.6l12.8 12.8M18.4 5.6L5.6 18.4'),
    array('Ringan, Struktur Tetap Aman', 'Bobot panel ringan sehingga tidak membebani struktur, namun tetap kokoh dan tahan benturan.', 'M14.7 6.3a4 4 0 0 0-5.4 5.4L3 18l3 3 6.3-6.3a4 4 0 0 0 5.4-5.4l-2.5 2.5-2.3-.6-.6-2.3 2.4-2.6z'),
    array('Warna & Tekstur Sesuai Selera', 'Dari solid dan metallic hingga motif kayu dan batu. Kebebasan desain ada di tangan Anda.', 'M3 21V8l9-5 9 5v13H3zM9 21v-6h6v6'),
    array('Renovasi Lebih Praktis', 'Mudah dipotong dan dilipat sesuai desain, dan cukup dilap untuk membersihkannya.', 'M3 15a4 4 0 0 0 4 4h10a4 4 0 0 0 .5-7.97A6 6 0 0 0 6 9.5 4 4 0 0 0 3 15z'),
);

$cw_systems = array(
    array(
        'tab'   => 'PVDF (Eksterior)',
        'title' => 'Coating PVDF untuk Luar Ruangan',
        'desc'  => 'Dirancang khusus untuk fasad luar ruangan. Lapisan PVDF tahan sinar UV, cuaca ekstrem, dan polusi udara sehingga warna lebih awet di iklim tropis.',
        'pts'   => array('Pas untuk fasad gedung, ruko, dan signage', 'Warna lebih tahan pudar', 'Andal menghadapi panas dan hujan'),
    ),
    array(
        'tab'   => 'PE (Interior)',
        'title' => 'Coating PE untuk Dalam Ruangan',
        'desc'  => 'Pilihan ekonomis untuk area interior atau yang terlindung dari sinar matahari langsung. Permukaannya halus dan mudah dibersihkan.',
        'pts'   => array('Cocok untuk partisi, plafon, dan dinding interior', 'Harga lebih bersahabat', 'Permukaan halus dan elegan'),
    ),
    array(
        'tab'   => 'FR (Tahan Api)',
        'title' => 'Fire Retardant (Mineral Core)',
        'desc'  => 'Memakai inti mineral yang tidak mudah terbakar. Disarankan untuk bangunan tinggi dan ruang publik yang mengutamakan standar keselamatan.',
        'pts'   => array('Membantu memperlambat penjalaran api', 'Standar keselamatan lebih tinggi', 'Struktur panel kuat dan stabil'),
    ),
    array(
        'tab'   => 'Perforated',
        'title' => 'Custom Perforated ACP',
        'desc'  => 'Panel dipotong CNC membentuk pola geometris, motif, atau desain custom. Menambah karakter dan nilai seni pada fasad Anda.',
        'pts'   => array('Fasad yang unik dan sulit ditiru', 'Dapat berfungsi sebagai tabir cahaya dan ventilasi', 'Potongan CNC rapi dan presisi'),
    ),
);

$cw_specs = array(
    array('Material Panel', 'Dua lapis aluminium dengan inti Polyethylene (PE) atau mineral Fire Retardant (FR) sesuai kebutuhan keselamatan.'),
    array('Ketebalan Panel', 'Tersedia berbagai ketebalan panel dan kulit aluminium, disesuaikan untuk interior maupun eksterior.'),
    array('Rangka Dudukan', 'Rangka hollow aluminium atau besi galvanis anti karat, dihitung sesuai beban dan bentang bangunan.'),
    array('Sealant & Sambungan', 'Sambungan rapi dengan sealant tahan cuaca untuk mencegah rembesan air ke struktur di dalam.'),
    array('Garansi & Layanan', 'Pemasangan oleh tim berpengalaman. Garansi pabrik mengikuti merek dan tipe panel yang dipilih, dijelaskan dalam penawaran.'),
);

$cw_steps = array(
    array('Konsultasi', 'Ceritakan kondisi bangunan dan tampilan yang Anda inginkan. Kami bantu arahkan pilihannya.'),
    array('Survey & Ukur', 'Pengukuran langsung di lokasi agar kebutuhan panel dan rangka tepat.'),
    array('Desain & Penawaran', 'Pilih warna dan tekstur, lengkap dengan RAB yang rinci dan transparan.'),
    array('Fabrikasi Panel', 'Panel dipotong, dilipat, atau dibentuk presisi sesuai desain.'),
    array('Pemasangan & Serah Terima', 'Instalasi rapi, finishing bersih, dan bangunan Anda siap tampil dengan wajah baru.'),
);

$cw_faq = array(
    array('Berapa harga ACP per meter persegi?', 'Harga bergantung pada merek, tipe coating (PE atau PVDF), ketebalan, dan kerumitan pemasangan rangka. Hubungi kami untuk estimasi sesuai proyek Anda.'),
    array('Apa beda ACP tipe PVDF dan PE?', 'PVDF dirancang untuk luar ruangan sehingga warnanya lebih tahan terhadap sinar matahari dan cuaca. PE lebih cocok untuk interior atau area yang teduh.'),
    array('Apakah bisa renovasi tanpa bongkar total?', 'Dalam banyak kasus, ACP dipasang pada rangka baru yang menempel di dinding yang ada, sehingga tidak perlu bongkar total. Kepastiannya kami cek saat survey.'),
    array('Bagaimana jika proyek saya kecil?', 'Bisa. ACP cocok untuk ruko, rumah, maupun gedung. Ceritakan ukuran dan kebutuhan Anda, kami arahkan opsi yang paling pas.'),
    array('Apakah warna ACP bisa memudar?', 'ACP eksterior berkualitas dengan coating PVDF jauh lebih tahan pudar. Masa garansi warna mengikuti ketentuan pabrik masing-masing merek.'),
    array('Bagaimana cara merawat fasad ACP?', 'Cukup mudah. Bersihkan berkala dengan air dan sabun lembut serta spons halus agar debu dan polutan tidak mengerak.'),
    array('Bisa dipadukan dengan Curtain Wall atau kaca?', 'Sangat bisa. Kombinasi ACP dan kaca adalah tren fasad komersial modern, dan kami menangani keduanya dalam satu tim.'),
);
?>
<script>document.documentElement.classList.add("cw-js");</script>
<style>
/* ===== Curtain Wall redesign - semua class diawali "cw-" ===== */
.cw-page { font-family: 'Outfit', 'Roboto', sans-serif; color: #1a202c; background: #fff; overflow-x: hidden; }
.cw-page * { box-sizing: border-box; }
.cw-wrap { width: 100%; max-width: 1200px; margin: 0 auto; padding: 0 20px; }
.cw-eyebrow { font-size: 13px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #cba85d; margin-bottom: 12px; }
.cw-h2 { font-size: clamp(26px, 4vw, 38px); font-weight: 800; line-height: 1.2; margin: 0 0 14px; color: #0b1f3a; }
.cw-lead { font-size: 16px; line-height: 1.7; color: #4a5568; max-width: 640px; margin: 0 0 40px; }
.cw-section { padding: clamp(56px, 8vw, 96px) 0; }
.cw-center { text-align: center; }
.cw-center .cw-lead { margin-left: auto; margin-right: auto; }

/* Buttons */
.cw-btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; padding: 14px 28px; border-radius: 6px; font-weight: 700; font-size: 15px; text-decoration: none !important; border: 2px solid transparent; transition: transform .25s, background .25s, color .25s, box-shadow .25s; cursor: pointer; position: relative; overflow: hidden; }
.cw-btn:hover { transform: translateY(-2px); }
.cw-btn-gold { background: #cba85d; color: #041e3a !important; box-shadow: 0 8px 20px rgba(203,168,93,.35); }
.cw-btn-gold:hover { background: #dcc07a; }
.cw-btn-outline { background: transparent; color: #fff !important; border-color: rgba(255,255,255,.45); }
.cw-btn-outline:hover { background: rgba(255,255,255,.1); border-color: #fff; }
.cw-btn-gold::after { content: ''; position: absolute; top: 0; left: -80%; width: 50%; height: 100%; background: linear-gradient(120deg, transparent, rgba(255,255,255,.35), transparent); transform: skewX(-20deg); transition: left .6s; }
.cw-btn-gold:hover::after { left: 130%; }

/* Hero */
.cw-hero { background: #041e3a; color: #fff; padding: 150px 0 64px; position: relative; min-height: 100vh; display: flex; align-items: center; overflow: hidden; }
.cw-hero-video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 1; z-index: 0; pointer-events: none; }
.cw-hero::before { content: ""; position: absolute; inset: 0; z-index: 1; background: linear-gradient(90deg, rgba(4,30,58,.92) 0%, rgba(4,30,58,.70) 50%, rgba(4,30,58,.45) 100%); pointer-events: none; }
.cw-hero > .cw-wrap { position: relative; z-index: 2; width: 100%; }
.cw-back { display: inline-block; margin-bottom: 22px; font-size: 13px; color: rgba(255,255,255,.7) !important; text-decoration: none !important; transition: color .2s; }
.cw-back:hover { color: #cba85d !important; }
.cw-crumb { display: flex; flex-wrap: wrap; gap: 8px; align-items: center; font-size: 13px; color: rgba(255,255,255,.65); margin-bottom: 36px; }
.cw-crumb a { color: rgba(255,255,255,.85); text-decoration: none; }
.cw-crumb a:hover { color: #cba85d; }
.cw-hero-grid { display: grid; grid-template-columns: 1fr 1.3fr; gap: 64px; align-items: center; }
.cw-hero h1 { font-size: clamp(30px, 5vw, 52px); font-weight: 800; line-height: 1.12; margin: 0 0 18px; color: #fff; }
.cw-hero h1 span { color: #cba85d; }
.cw-hero p { font-size: 17px; line-height: 1.7; color: rgba(255,255,255,.8); margin: 0 0 32px; max-width: 520px; }
.cw-hero-cta { display: flex; flex-wrap: wrap; gap: 14px; }
.cw-hero-note { align-self: center; font-size: 13px; color: rgba(255,255,255,.7); }
.cw-hero-media { position: relative; }
.cw-hero-media img { width: 100%; aspect-ratio: 4/3; max-height: 70vh; object-fit: cover; border-radius: 12px; border: 1px solid rgba(255,255,255,.18); box-shadow: 0 30px 60px rgba(0,0,0,.45); display: block; will-change: transform; }
.cw-hero-badge { position: absolute; left: -16px; bottom: 24px; background: #fff; color: #0b1f3a; padding: 12px 18px; border-radius: 10px; font-weight: 700; font-size: 14px; box-shadow: 0 12px 30px rgba(0,0,0,.25); }
.cw-hero-badge small { display: block; font-weight: 500; color: #718096; font-size: 12px; }
.cw-stats { background: rgba(255,255,255,.06); border-top: 1px solid rgba(255,255,255,.12); }
.cw-stats-grid { display: grid; grid-template-columns: repeat(3, 1fr); text-align: center; }
.cw-stat { padding: 26px 10px; }
.cw-stat + .cw-stat { border-left: 1px solid rgba(255,255,255,.12); }
.cw-stat b { display: block; font-size: clamp(24px, 4vw, 36px); color: #cba85d; font-weight: 800; }
.cw-stat span { font-size: 13px; color: rgba(255,255,255,.75); }

/* Features */
.cw-feat-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
.cw-feat { background: #fff; border: 1px solid #e8ecf1; border-radius: 12px; padding: 28px 24px; transition: transform .3s, box-shadow .3s, border-color .3s; }
.cw-feat:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(11,31,58,.12); border-color: #cba85d; }
.cw-ico { width: 52px; height: 52px; border-radius: 12px; background: #f6efd9; display: flex; align-items: center; justify-content: center; margin-bottom: 18px; }
.cw-ico svg { width: 26px; height: 26px; stroke: #a68a36; fill: none; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; }
.cw-feat h3 { font-size: 18px; font-weight: 700; margin: 0 0 8px; color: #0b1f3a; }
.cw-feat p { font-size: 14px; line-height: 1.65; color: #5a6676; margin: 0; }

/* Tabs */
.cw-bg-soft { background: #f5f7fa; }
.cw-tabs { display: flex; flex-wrap: wrap; justify-content: center; gap: 8px; margin-bottom: 36px; }
.cw-tab { background: #fff; border: 1px solid #dde3ea; padding: 11px 22px; border-radius: 999px; font-weight: 600; font-size: 14px; color: #4a5568; cursor: pointer; transition: all .25s; font-family: inherit; }
.cw-tab:hover { border-color: #cba85d; color: #0b1f3a; }
.cw-tab.is-active { background: #0b1f3a; color: #fff; border-color: #0b1f3a; }
.cw-panel { display: none; grid-template-columns: 1.15fr 1fr; gap: 36px; align-items: center; background: #fff; border-radius: 16px; padding: 40px; box-shadow: 0 10px 40px rgba(11,31,58,.08); }
.cw-panel.is-active { display: grid; animation: cwFade .4s ease; }
@keyframes cwFade { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: none; } }
.cw-panel img { width: 100%; height: 300px; object-fit: cover; border-radius: 12px; display: block; }
.cw-panel h3 { font-size: 24px; font-weight: 800; margin: 0 0 12px; color: #0b1f3a; }
.cw-panel p { font-size: 15px; line-height: 1.75; color: #4a5568; margin: 0 0 18px; }
.cw-panel ul { list-style: none; margin: 0; padding: 24px; background: #f5f7fa; border-radius: 12px; border-left: 4px solid #cba85d; }
.cw-panel li { position: relative; padding-left: 28px; margin-bottom: 10px; font-size: 14px; color: #2d3748; }
.cw-panel li::before { content: ''; position: absolute; left: 0; top: 4px; width: 16px; height: 16px; border-radius: 50%; background: #cba85d url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12l5 5L20 7'/%3E%3C/svg%3E") center/10px no-repeat; }

/* Gallery */
.cw-gal-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; }
.cw-gal-item { position: relative; border-radius: 12px; overflow: hidden; cursor: zoom-in; background: #0a2f57; aspect-ratio: 4/3; border: 0; padding: 0; }
.cw-gal-item img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .5s; }
.cw-gal-item:hover img { transform: scale(1.08); }
.cw-gal-item::after { content: 'Lihat Foto'; position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; background: rgba(4,30,58,.55); color: #fff; font-weight: 700; letter-spacing: 1px; opacity: 0; transition: opacity .3s; }
.cw-gal-item:hover::after { opacity: 1; }
.cw-gal-grid.cw-single { grid-template-columns: 1fr; max-width: 720px; margin: 0 auto; }

/* Accordion */
.cw-acc { max-width: 820px; margin: 0 auto; }
.cw-acc-item { border: 1px solid #e3e8ee; border-radius: 10px; margin-bottom: 12px; background: #fff; overflow: hidden; transition: border-color .25s, box-shadow .25s; }
.cw-acc-item.is-open { border-color: #cba85d; box-shadow: 0 8px 24px rgba(11,31,58,.08); }
.cw-acc-btn { width: 100%; background: none; border: 0; text-align: left; padding: 20px 24px; font-size: 16px; font-weight: 700; color: #0b1f3a; display: flex; justify-content: space-between; align-items: center; gap: 16px; cursor: pointer; font-family: inherit; }
.cw-acc-btn i { flex: 0 0 auto; width: 26px; height: 26px; border-radius: 50%; background: #f6efd9; position: relative; transition: transform .3s, background .3s; }
.cw-acc-btn i::before, .cw-acc-btn i::after { content: ''; position: absolute; left: 50%; top: 50%; width: 12px; height: 2px; background: #a68a36; transform: translate(-50%, -50%); }
.cw-acc-btn i::after { transform: translate(-50%, -50%) rotate(90deg); transition: transform .3s; }
.cw-acc-item.is-open .cw-acc-btn i { transform: rotate(180deg); background: #cba85d; }
.cw-acc-item.is-open .cw-acc-btn i::before, .cw-acc-item.is-open .cw-acc-btn i::after { background: #fff; }
.cw-acc-item.is-open .cw-acc-btn i::after { transform: translate(-50%, -50%) rotate(0); }
.cw-acc-body { max-height: 0; overflow: hidden; transition: max-height .35s ease; }
.cw-acc-body p { padding: 0 24px 22px; margin: 0; font-size: 15px; line-height: 1.75; color: #4a5568; }

/* Timeline */
.cw-dark { background: #041e3a; color: #fff; }
.cw-dark .cw-h2 { color: #fff; }
.cw-dark .cw-lead { color: rgba(255,255,255,.75); }
.cw-steps { display: grid; grid-template-columns: repeat(5, 1fr); gap: 20px; position: relative; counter-reset: cwstep; }
.cw-steps::before { content: ''; position: absolute; top: 28px; left: 10%; right: 10%; height: 2px; background: linear-gradient(90deg, #cba85d, rgba(203,168,93,.2)); }
.cw-step { position: relative; text-align: center; padding: 0 6px; }
.cw-step-n { width: 56px; height: 56px; margin: 0 auto 18px; border-radius: 50%; background: #041e3a; border: 2px solid #cba85d; color: #cba85d; font-weight: 800; font-size: 20px; display: flex; align-items: center; justify-content: center; position: relative; z-index: 1; transition: background .3s, color .3s; }
.cw-step:hover .cw-step-n { background: #cba85d; color: #041e3a; }
.cw-step h3 { font-size: 16px; font-weight: 700; margin: 0 0 6px; color: #fff; }
.cw-step p { font-size: 13px; line-height: 1.6; color: rgba(255,255,255,.7); margin: 0; }

/* CTA */
.cw-cta { background: linear-gradient(135deg, #0a2f57, #041e3a); color: #fff; text-align: center; border-radius: 18px; padding: clamp(36px, 6vw, 64px) 24px; }
.cw-cta h2 { font-size: clamp(24px, 4vw, 36px); font-weight: 800; margin: 0 0 12px; color: #fff; }
.cw-cta p { color: rgba(255,255,255,.8); max-width: 560px; margin: 0 auto 28px; line-height: 1.7; }

:is(.cw-btn, .cw-tab, .cw-acc-btn, .cw-gal-item, .cw-back):focus-visible { outline: 3px solid #cba85d; outline-offset: 3px; }

/* Reveal */
.cw-js .cw-reveal { opacity: 0; transform: translateY(26px); transition: opacity .6s ease, transform .6s ease; }
.cw-js .cw-reveal.is-in { opacity: 1; transform: none; }
.cw-d1 { transition-delay: .08s; } .cw-d2 { transition-delay: .16s; } .cw-d3 { transition-delay: .24s; }

/* Lightbox */
.cw-lb { position: fixed; inset: 0; background: rgba(0,0,0,.92); z-index: 999999; display: none; align-items: center; justify-content: center; }
.cw-lb.is-open { display: flex; }
.cw-lb img { max-width: 92%; max-height: 86vh; object-fit: contain; border-radius: 6px; }
.cw-lb button { position: absolute; background: rgba(255,255,255,.12); border: 0; color: #fff; width: 48px; height: 48px; border-radius: 50%; font-size: 26px; cursor: pointer; transition: background .2s; }
.cw-lb button:hover { background: rgba(255,255,255,.25); }
.cw-lb-x { top: 20px; right: 20px; } .cw-lb-p { left: 16px; top: 50%; transform: translateY(-50%); } .cw-lb-n { right: 16px; top: 50%; transform: translateY(-50%); }

/* Sticky WA (mobile) */
.cw-sticky { display: none; position: fixed; left: 0; right: 0; bottom: 0; z-index: 9990; padding: 10px 14px; background: rgba(4,30,58,.96); transform: translateY(100%); transition: transform .35s; }
.cw-sticky.is-show { transform: none; }
.cw-sticky .cw-btn { width: 100%; padding: 13px; }

/* Responsive */
@media (max-width: 991px) {
    .cw-feat-grid { grid-template-columns: repeat(2, 1fr); }
    .cw-hero-grid { grid-template-columns: 1fr; gap: 36px; }
    .cw-hero-badge { left: 12px; }
    .cw-panel { grid-template-columns: 1fr; padding: 24px; }
    .cw-panel img { height: 240px; }
    .cw-gal-grid { grid-template-columns: repeat(2, 1fr); }
    .cw-steps { grid-template-columns: 1fr; gap: 0; max-width: 460px; margin: 0 auto; }
    .cw-steps::before { top: 0; bottom: 0; left: 27px; right: auto; width: 2px; height: auto; }
    .cw-step { display: flex; gap: 18px; text-align: left; padding: 0 0 28px; }
    .cw-step-n { margin: 0; flex: 0 0 56px; }
}
@media (max-width: 575px) {
    .cw-hero { padding-top: 110px; padding-bottom: 40px; }
    .cw-hero-media img { aspect-ratio: 16/10; max-height: 34vh; }
    .cw-hero-grid { gap: 28px; }
    .cw-feat-grid { grid-template-columns: 1fr; }
    .cw-gal-grid { gap: 10px; }
    .cw-hero-cta .cw-btn { width: 100%; }
    .cw-sticky { display: block; }
    body.cw-sticky-on .wa-float-btn { display: none !important; }
    .cw-page { padding-bottom: 0; }
}
@media (prefers-reduced-motion: reduce) {
    .cw-js .cw-reveal { opacity: 1; transform: none; transition: none; }
    .cw-panel.is-active { animation: none; }
    .cw-btn, .cw-feat, .cw-gal-item img { transition: none; }
}
</style>

<div class="cw-page">

    <!-- HERO -->
    <section class="cw-hero">
        <video class="cw-hero-video" muted loop playsinline preload="none" aria-hidden="true" data-src="<?php echo esc_url(get_template_directory_uri() . '/img/videogedung.mp4'); ?>"></video>
        <div class="cw-wrap">
            <a class="cw-back" href="?">&larr; Semua Fasad</a>
            <div class="cw-hero-grid">
                <div class="cw-reveal">
                    
                    <div class="cw-eyebrow">ACP &middot; Aluminium Composite Panel</div>
                    <h1>Wajah Baru Bangunan, <span>Tampil Mewah Bertahun-tahun</span></h1>
                    <p>Fasad kusam atau cat mengelupas? ACP memberi bangunan Anda tampilan modern yang rapi dan tahan cuaca. Kami menangani desain sampai pemasangan.</p>
                    <div class="cw-hero-cta">
                        <a class="cw-btn cw-btn-gold" href="<?php echo esc_url($cw_wa_link); ?>" target="_blank" rel="noopener">Minta Penawaran via WhatsApp</a>
                        <span class="cw-hero-note">Kirim foto bangunan, kami balas secepatnya.</span>
                    </div>
                </div>
                <div class="cw-hero-media cw-reveal cw-d2">
                    <img id="cw-hero-img" src="<?php echo esc_url($cw_hero_img); ?>" alt="ACP Griya Djaya Sentosa" onerror="this.src='<?php echo esc_url(get_template_directory_uri()); ?>/img/placeholder.jpg';">
                    
                </div>
            </div>
        </div>
        </section>

    <!-- KEUNGGULAN -->
    <section class="cw-section">
        <div class="cw-wrap">
            <div class="cw-center cw-reveal">
                <div class="cw-eyebrow">Kenapa ACP</div>
                <h2 class="cw-h2">Tampil Mewah Tanpa Ribet Perawatan</h2>
                <p class="cw-lead">Material fasad yang ringan, fleksibel, dan tahan cuaca, favorit untuk renovasi maupun bangunan baru.</p>
            </div>
            <div class="cw-feat-grid">
                <?php foreach ($cw_features as $i => $f): ?>
                <div class="cw-feat cw-reveal cw-d<?php echo ($i % 3) + 1; ?>">
                    <div class="cw-ico"><svg viewBox="0 0 24 24"><path d="<?php echo esc_attr($f[2]); ?>"/></svg></div>
                    <h3><?php echo esc_html($f[0]); ?></h3>
                    <p><?php echo esc_html($f[1]); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SISTEM (TABS) -->
    <section class="cw-section cw-bg-soft">
        <div class="cw-wrap">
            <div class="cw-center cw-reveal">
                <div class="cw-eyebrow">Pilihan Tipe</div>
                <h2 class="cw-h2">Pilih Tipe ACP yang Tepat untuk Kebutuhan Anda</h2>
                <p class="cw-lead">Setiap tipe punya keunggulan sendiri. Pilih tab di bawah untuk membandingkan.</p>
            </div>
            <div class="cw-tabs" role="tablist">
                <?php foreach ($cw_systems as $i => $s): ?>
                <button class="cw-tab <?php echo $i === 0 ? 'is-active' : ''; ?>" role="tab" data-cw-tab="<?php echo $i; ?>"><?php echo esc_html($s['tab']); ?></button>
                <?php endforeach; ?>
            </div>
            <?php foreach ($cw_systems as $i => $s): ?>
            <div class="cw-panel <?php echo $i === 0 ? 'is-active' : ''; ?>" data-cw-panel="<?php echo $i; ?>" role="tabpanel">
                <div class="cw-panel-main">
                    <h3><?php echo esc_html($s['title']); ?></h3>
                    <p><?php echo esc_html($s['desc']); ?></p>
                </div>
                    <ul>
                        <?php foreach ($s['pts'] as $pt): ?><li><?php echo esc_html($pt); ?></li><?php endforeach; ?>
                    </ul>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- GALERI -->
    <section class="cw-section" id="cw-gallery">
        <div class="cw-wrap">
            <div class="cw-center cw-reveal">
                <div class="cw-eyebrow">Portofolio</div>
                <h2 class="cw-h2">Lihat Sendiri Hasilnya</h2>
                <p class="cw-lead">Intip hasil pekerjaan kami. Ketuk foto untuk melihatnya lebih dekat.</p>
            </div>
            <div class="cw-gal-grid <?php echo count($cw_gallery) === 1 ? 'cw-single' : ''; ?>">
                <?php foreach ($cw_gallery as $i => $g): ?>
                <button type="button" class="cw-gal-item cw-reveal" data-cw-lb="<?php echo $i; ?>" aria-label="Perbesar foto <?php echo $i + 1; ?>">
                    <img src="<?php echo esc_url($g); ?>" alt="Proyek Curtain Wall <?php echo $i + 1; ?>" loading="lazy">
                </button>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- SPESIFIKASI -->
    <section class="cw-section cw-bg-soft">
        <div class="cw-wrap">
            <div class="cw-center cw-reveal">
                <div class="cw-eyebrow">Di Balik Fasad</div>
                <h2 class="cw-h2">Material & Spesifikasi yang Kami Pakai</h2>
                <p class="cw-lead">Gambaran material dan opsi yang tersedia. Detail akhir disesuaikan dengan proyek Anda.</p>
            </div>
            <div class="cw-acc cw-reveal" data-cw-acc>
                <?php foreach ($cw_specs as $i => $sp): ?>
                <div class="cw-acc-item <?php echo $i === 0 ? 'is-open' : ''; ?>">
                    <button class="cw-acc-btn" type="button" aria-expanded="<?php echo $i === 0 ? 'true' : 'false'; ?>"><?php echo esc_html($sp[0]); ?><i></i></button>
                    <div class="cw-acc-body"><p><?php echo esc_html($sp[1]); ?></p></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- TAHAPAN KERJA -->
    <section class="cw-section cw-dark">
        <div class="cw-wrap">
            <div class="cw-center cw-reveal">
                <div class="cw-eyebrow">Proses Kerja</div>
                <h2 class="cw-h2">Dari Konsultasi hingga Wajah Baru Bangunan Anda</h2>
                <p class="cw-lead">Lima langkah yang jelas dan terukur, sehingga Anda selalu tahu progres proyek.</p>
            </div>
            <div class="cw-steps">
                <?php foreach ($cw_steps as $i => $st): ?>
                <div class="cw-step cw-reveal cw-d<?php echo ($i % 3) + 1; ?>">
                    <div class="cw-step-n"><?php echo $i + 1; ?></div>
                    <div>
                        <h3><?php echo esc_html($st[0]); ?></h3>
                        <p><?php echo esc_html($st[1]); ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="cw-section">
        <div class="cw-wrap">
            <div class="cw-center cw-reveal">
                <div class="cw-eyebrow">Tanya Jawab</div>
                <h2 class="cw-h2">Masih Ada Pertanyaan? Ini Jawabannya</h2>
            </div>
            <div class="cw-acc cw-reveal" data-cw-acc>
                <?php foreach ($cw_faq as $fq): ?>
                <div class="cw-acc-item">
                    <button class="cw-acc-btn" type="button" aria-expanded="false"><?php echo esc_html($fq[0]); ?><i></i></button>
                    <div class="cw-acc-body"><p><?php echo esc_html($fq[1]); ?></p></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CTA PENUTUP -->
    <section style="padding: 0 0 clamp(56px, 8vw, 96px);">
        <div class="cw-wrap">
            <div class="cw-cta cw-reveal">
                <h2>Siap Memberi Bangunan Anda Wajah Baru?</h2>
                <p>Kirim foto bangunan Anda lewat WhatsApp. Kami bantu pilih tipe dan warna, lalu siapkan penawaran yang jelas.</p>
                <a class="cw-btn cw-btn-gold" href="<?php echo esc_url($cw_wa_link); ?>" target="_blank" rel="noopener">Kirim Foto Bangunan Anda</a>
            </div>
        </div>
    </section>

    <!-- Sticky CTA mobile -->
    <div class="cw-sticky" id="cw-sticky">
        <a class="cw-btn cw-btn-gold" href="<?php echo esc_url($cw_wa_link); ?>" target="_blank" rel="noopener">Tanya via WhatsApp</a>
    </div>

    <!-- Lightbox -->
    <div class="cw-lb" id="cw-lb" aria-hidden="true">
        <button class="cw-lb-x" type="button" aria-label="Tutup">&times;</button>
        <button class="cw-lb-p" type="button" aria-label="Sebelumnya">&lsaquo;</button>
        <img id="cw-lb-img" src="" alt="">
        <button class="cw-lb-n" type="button" aria-label="Berikutnya">&rsaquo;</button>
    </div>
</div>

<script>
(function () {
    var gallery = <?php echo wp_json_encode(array_values($cw_gallery)); ?>;

    // Scroll reveal
    var reveals = document.querySelectorAll('.cw-reveal');
    if ('IntersectionObserver' in window) {
        var io = new IntersectionObserver(function (es) {
            es.forEach(function (e) { if (e.isIntersecting) { e.target.classList.add('is-in'); io.unobserve(e.target); } });
        }, { threshold: 0.12 });
        reveals.forEach(function (el) { io.observe(el); });
    } else { reveals.forEach(function (el) { el.classList.add('is-in'); }); }

    // Counter
    var counters = document.querySelectorAll('[data-count]');
    function runCounter(el) {
        var target = parseInt(el.getAttribute('data-count'), 10), suffix = el.getAttribute('data-suffix') || '', start = null;
        function step(ts) {
            if (!start) start = ts;
            var p = Math.min((ts - start) / 1400, 1);
            el.textContent = Math.floor(target * (1 - Math.pow(1 - p, 3))) + suffix;
            if (p < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }
    if ('IntersectionObserver' in window) {
        var cio = new IntersectionObserver(function (es) {
            es.forEach(function (e) { if (e.isIntersecting) { runCounter(e.target); cio.unobserve(e.target); } });
        }, { threshold: 0.5 });
        counters.forEach(function (c) { cio.observe(c); });
    } else { counters.forEach(runCounter); }

    // Tabs
    var tabs = document.querySelectorAll('[data-cw-tab]'), panels = document.querySelectorAll('[data-cw-panel]');
    function activate(t, focus) {
        var i = t.getAttribute('data-cw-tab');
        tabs.forEach(function (x) { var on = x === t; x.classList.toggle('is-active', on); x.setAttribute('aria-selected', on ? 'true' : 'false'); x.setAttribute('tabindex', on ? '0' : '-1'); });
        panels.forEach(function (p) { p.classList.toggle('is-active', p.getAttribute('data-cw-panel') === i); });
        if (focus) t.focus();
    }
    tabs.forEach(function (t, idx) {
        t.setAttribute('aria-selected', t.classList.contains('is-active') ? 'true' : 'false');
        t.setAttribute('tabindex', t.classList.contains('is-active') ? '0' : '-1');
        t.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowRight') { e.preventDefault(); activate(tabs[(idx + 1) % tabs.length], true); }
            else if (e.key === 'ArrowLeft') { e.preventDefault(); activate(tabs[(idx - 1 + tabs.length) % tabs.length], true); }
        });
        t.addEventListener('click', function () {
            var i = t.getAttribute('data-cw-tab');
            tabs.forEach(function (x) { x.classList.toggle('is-active', x === t); });
            activate(t, false);
        });
    });

    // Accordion (satu terbuka per grup)
    document.querySelectorAll('[data-cw-acc]').forEach(function (group) {
        var items = group.querySelectorAll('.cw-acc-item');
        function setOpen(item, open) {
            var body = item.querySelector('.cw-acc-body');
            item.classList.toggle('is-open', open);
            item.querySelector('.cw-acc-btn').setAttribute('aria-expanded', open ? 'true' : 'false');
            body.style.maxHeight = open ? body.scrollHeight + 'px' : '0';
        }
        items.forEach(function (item) {
            if (item.classList.contains('is-open')) setOpen(item, true);
            item.querySelector('.cw-acc-btn').addEventListener('click', function () {
                var wasOpen = item.classList.contains('is-open');
                items.forEach(function (o) { setOpen(o, false); });
                if (!wasOpen) setOpen(item, true);
            });
        });
    });

    // Lightbox
    var lb = document.getElementById('cw-lb'), lbImg = document.getElementById('cw-lb-img'), cur = 0, touchX = null;
    function show(i) {
        cur = (i + gallery.length) % gallery.length;
        lbImg.src = gallery[cur];
        var many = gallery.length > 1;
        lb.querySelector('.cw-lb-p').style.display = many ? '' : 'none';
        lb.querySelector('.cw-lb-n').style.display = many ? '' : 'none';
    }
    function open(i) { show(i); lb.classList.add('is-open'); lb.setAttribute('aria-hidden', 'false'); document.body.style.overflow = 'hidden'; }
    function close() { lb.classList.remove('is-open'); lb.setAttribute('aria-hidden', 'true'); document.body.style.overflow = ''; }
    document.querySelectorAll('[data-cw-lb]').forEach(function (b) {
        b.addEventListener('click', function () { open(parseInt(b.getAttribute('data-cw-lb'), 10)); });
    });
    lb.querySelector('.cw-lb-x').addEventListener('click', close);
    lb.querySelector('.cw-lb-p').addEventListener('click', function (e) { e.stopPropagation(); show(cur - 1); });
    lb.querySelector('.cw-lb-n').addEventListener('click', function (e) { e.stopPropagation(); show(cur + 1); });
    lb.addEventListener('click', function (e) { if (e.target === lb) close(); });
    document.addEventListener('keydown', function (e) {
        if (!lb.classList.contains('is-open')) return;
        if (e.key === 'Escape') close();
        else if (e.key === 'ArrowLeft') show(cur - 1);
        else if (e.key === 'ArrowRight') show(cur + 1);
    });
    lb.addEventListener('touchstart', function (e) { touchX = e.changedTouches[0].clientX; }, { passive: true });
    lb.addEventListener('touchend', function (e) {
        if (touchX === null) return;
        var dx = e.changedTouches[0].clientX - touchX;
        if (Math.abs(dx) > 50) show(cur + (dx < 0 ? 1 : -1));
        touchX = null;
    }, { passive: true });

    // Sticky CTA (mobile) + parallax halus hero
    // Video latar: hanya dimuat jika layar cukup lebar, tidak hemat data, dan tidak memilih kurangi animasi
    (function () {
        var v = document.querySelector('.cw-hero-video');
        if (!v) return;
        var rm = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var sd = navigator.connection && navigator.connection.saveData;
        if (rm || sd || window.innerWidth < 768) { v.parentNode.removeChild(v); return; }
        v.src = v.getAttribute('data-src');
        var pp = v.play(); if (pp && pp.catch) pp.catch(function () {});
    })();

    var sticky = document.getElementById('cw-sticky'), heroImg = document.getElementById('cw-hero-img');
    var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    window.addEventListener('scroll', function () {
        var y = window.pageYOffset;
        if (sticky) { sticky.classList.toggle('is-show', y > 500); document.body.classList.toggle('cw-sticky-on', y > 500); }
        if (heroImg && !reduce && y < 700 && window.innerWidth > 991) heroImg.style.transform = 'translateY(' + (y * 0.05) + 'px)';
    }, { passive: true });
})();
</script>
