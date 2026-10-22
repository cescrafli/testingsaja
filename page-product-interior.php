<?php
/* Template Name: Product - Interior */
global $custom_css; 
$custom_css = 'services';
get_header();

$theme_uri = get_template_directory_uri();
$wa_phone  = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('wa_phone', '628111021088') : '628111021088';

// Helper for WhatsApp links
if (!function_exists('gjs_interior_wa_link')) {
    function gjs_interior_wa_link($phone, $message) {
        return 'https://api.whatsapp.com/send/?phone=' . $phone . '&text=' . rawurlencode($message) . '&type=phone_number&app_absent=0';
    }
}

// Helper to parse line-by-line feature points
if (!function_exists('gjs_interior_parse_points')) {
    function gjs_interior_parse_points($raw) {
        $lines = explode("\n", str_replace("\r", "", trim($raw)));
        $result = array();
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '') continue;
            if (strpos($line, ':') !== false) {
                list($bold, $text) = explode(':', $line, 2);
                $result[] = '<strong>' . esc_html(trim($bold)) . ':</strong> ' . esc_html(trim($text));
            } else {
                $result[] = esc_html($line);
            }
        }
        return $result;
    }
}

// Default dynamic links
$wa_general   = gjs_interior_wa_link($wa_phone, 'Halo Griya Djaya Sentosa, saya tertarik dengan layanan Interior Design & Fitting Out dan ingin konsultasi mengenai proyek saya.');
$wa_design    = gjs_interior_wa_link($wa_phone, 'Halo Griya Djaya Sentosa, saya ingin konsultasi mengenai jasa Interior Design (perencanaan layout 2D, 3D render & gambar kerja DED).');
$wa_fitout    = gjs_interior_wa_link($wa_phone, 'Halo Griya Djaya Sentosa, saya ingin konsultasi mengenai jasa Fitting Out & Fabrikasi Interior (eksekusi lapangan & workshop custom joinery).');
$wa_survey    = gjs_interior_wa_link($wa_phone, 'Halo Griya Djaya Sentosa, saya ingin menjadwalkan survey lokasi untuk proyek interior saya.');

// Curated default interior items
$default_interior_items = array(
    'partisi-kaca' => array(
        'id'        => 'partisi-kaca',
        'badge'     => 'Partisi Kaca',
        'meta_cat'  => 'Arsitektural Glass',
        'meta_sub'  => 'Tempered 10-12mm',
        'title'     => 'Partisi Kaca Frameless & Fluted Glass',
        'desc'      => 'Penyekat ruangan elegan dengan kaca tempered bening atau fluted motif bertekstur. Mempertahankan kelapangan visual dan transmisi cahaya alami dengan privasi dan kekedapan suara optimal.',
        'img'       => $theme_uri . '/img/interior/glass-wood-fabrication.jpg',
        'gallery'   => array(
            $theme_uri . '/img/interior/glass-wood-fabrication.jpg',
            $theme_uri . '/img/Pintu-Sliding-2.png',
        ),
        'tags'      => array('Slimline Aluminum', 'Safety Film', 'Kedap Suara'),
        'specs'     => array(
            'Kaca Tempered 10–12mm standar SNI dengan opsi laminated safety film',
            'Frame Slimline Aluminium Powder Coating / Anodized anti-karat',
            'Tersedia varian kaca: Clear, Fluted Ribbed, Frosted, Smoked Grey, dan Tinted Bronze',
            'Peredam getaran & sealant akustik terintegrasi untuk isolasi suara maksimal'
        ),
        'btn_text'  => 'Tanya Partisi Kaca (WA)',
        'wa_msg'    => 'Halo Griya Djaya Sentosa, saya tertarik dengan produk Partisi Kaca Minimalis & Fluted Glass untuk interior.',
    ),
    'wall-panel' => array(
        'id'        => 'wall-panel',
        'badge'     => 'Wall Cladding',
        'meta_cat'  => 'Akustik & Aksen',
        'meta_sub'  => 'Slatted Design',
        'title'     => 'Wall Panel Kisi-Kisi Kayu & WPC',
        'desc'      => 'Panel dinding kisi-kisi vertikal berbahan solid wood veneer atau WPC komposit anti-rayap. Memberikan nuansa hangat, mewah, sekaligus meredam gema ruangan secara akustik.',
        'img'       => $theme_uri . '/img/Kisi-Kisi.png',
        'gallery'   => array(
            $theme_uri . '/img/Kisi-Kisi.png',
            $theme_uri . '/img/interior/interior-hero.jpg',
        ),
        'tags'      => array('Anti-Rayap', 'Tahan Air/Lembap', 'Backing Akustik'),
        'specs'     => array(
            'Bahan komposit WPC tahan lembap, anti-rayap, dan tidak merambat api',
            'Pilihan finishing natural wood veneer (Teak, Walnut, Oak) atau duco matte',
            'Dilengkapi acoustic felt backing hitam tebal peredam dengung/gema suara',
            'Pemasangan rapi sistem hidden clip tanpa paku terlihat di permukaan'
        ),
        'btn_text'  => 'Tanya Wall Panel (WA)',
        'wa_msg'    => 'Halo Griya Djaya Sentosa, saya tertarik dengan produk Wall Panel Kisi-Kisi Kayu & Akustik WPC.',
    ),
    'custom-wardrobe' => array(
        'id'        => 'custom-wardrobe',
        'badge'     => 'Custom Joinery',
        'meta_cat'  => 'Walk-in Closet',
        'meta_sub'  => 'Plywood Grade A',
        'title'     => 'Custom Built-in Wardrobe & Cabinetry',
        'desc'      => 'Lemari pakaian kustom full ceiling dengan pintu kaca smoked glass atau duco matte, rak display tas/aksesoris bervitrin, dan sistem sensor lampu LED strip tersembunyi.',
        'img'       => $theme_uri . '/img/interior/custom-wardrobe.jpg',
        'gallery'   => array(
            $theme_uri . '/img/interior/custom-wardrobe.jpg',
            $theme_uri . '/img/interior/interior-gallery-1.jpg',
        ),
        'tags'      => array('Multipleks Plywood', 'Soft-Close Hardware', 'Sensor LED Strip'),
        'specs'     => array(
            'Bahan dasar multipleks plywood 18mm grade A padat (bukan MDF/partikel)',
            'Finishing kombinasi HPL Taco/Carta, cat duco polyurethane, atau smoked glass',
            'Hardware engsel dan rel laci soft-closing Blum atau Hafele Jerman',
            'Sistem pencahayaan tersembunyi dengan sensor gerak otomatis (PIR sensor)'
        ),
        'btn_text'  => 'Tanya Custom Wardrobe (WA)',
        'wa_msg'    => 'Halo Griya Djaya Sentosa, saya ingin konsultasi pembuatan Custom Built-in Cabinetry & Walk-in Closet.',
    ),
    'kitchen-set' => array(
        'id'        => 'kitchen-set',
        'badge'     => 'Custom Millwork',
        'meta_cat'  => 'Dapur & Pantry',
        'meta_sub'  => 'Water-Resistant',
        'title'     => 'Luxury Kitchen Set & Island Table',
        'desc'      => 'Kitchen set ergonomis tahan lembap dengan kabinet anti-air, countertop marmer/quartzite tahan gores, dan kompartemen fungsional untuk dapur basah & kering.',
        'img'       => $theme_uri . '/img/interior/kitchen-set.jpg',
        'gallery'   => array(
            $theme_uri . '/img/interior/kitchen-set.jpg',
            $theme_uri . '/img/interior/luxury-penthouse.jpg',
        ),
        'tags'      => array('Kabinet Anti-Air', 'Marmer/Quartzite', 'Ergonomic Layout'),
        'specs'     => array(
            'Bahan kabinet bawah PVC foam board anti-air 100% tahan kebocoran wastafel',
            'Countertop opsi Marmer Nero Marquina, Carrara, atau Quartzite tahan gores',
            'Aksesoris laci bumbu tarik, rak piring stainless 304, dan sudut magic corner',
            'Instalasi terpadu untuk kompor tanam, sink undermount, dan cooker hood'
        ),
        'btn_text'  => 'Tanya Kitchen Set (WA)',
        'wa_msg'    => 'Halo Griya Djaya Sentosa, saya ingin konsultasi pembuatan Kitchen Set Mewah & Island Table.',
    ),
    'pintu-sliding-kaca' => array(
        'id'        => 'pintu-sliding-kaca',
        'badge'     => 'Architectural Doors',
        'meta_cat'  => 'Partisi Geser',
        'meta_sub'  => 'Top-Hung System',
        'title'     => 'Pintu Sliding Kaca Minimalis Interior',
        'desc'      => 'Sistem pintu geser gantung (top-hung) tanpa rel bawah di lantai. Gerakan meluncur halus, hemat ruang, dan menghubungkan ruang makan ke ruang keluarga secara fleksibel.',
        'img'       => $theme_uri . '/img/Pintu-Sliding-2.png',
        'gallery'   => array(
            $theme_uri . '/img/Pintu-Sliding-2.png',
            $theme_uri . '/img/interior/glass-wood-fabrication.jpg',
        ),
        'tags'      => array('Tanpa Rel Lantai', 'Soft-Close Damper', 'Kaca Tempered'),
        'specs'     => array(
            'Mekanisme rel gantung atas heavy duty (bebas sandungan di lantai)',
            'Dilengkapi damper soft-close dua arah untuk meredam benturan saat ditutup',
            'Profil frame aluminium ultra-slim modern finish black anodized / bronzed',
            'Pilihan kaca tempered 8–10mm jernih atau kaca motif fluted privacy'
        ),
        'btn_text'  => 'Tanya Pintu Sliding (WA)',
        'wa_msg'    => 'Halo Griya Djaya Sentosa, saya tertarik dengan produk Pintu Sliding Kaca Minimalis untuk interior.',
    ),
    'drop-ceiling' => array(
        'id'        => 'drop-ceiling',
        'badge'     => 'Plafon & MEP',
        'meta_cat'  => 'Drop Ceiling',
        'meta_sub'  => 'Architectural Lighting',
        'title'     => 'Plafon Drop Ceiling & Cove Lighting',
        'desc'      => 'Plafon bertingkat gypsum dengan lekukan cove tersembunyi untuk strip LED warm white, profil shadow line minimalis, dan tata letak titik lampu downlight yang proporsional.',
        'img'       => $theme_uri . '/img/interior/interior-gallery-1.jpg',
        'gallery'   => array(
            $theme_uri . '/img/interior/interior-gallery-1.jpg',
            $theme_uri . '/img/interior/luxury-penthouse.jpg',
        ),
        'tags'      => array('Rangka Hollow', 'Lampu Cove 3000K', 'Shadow Line'),
        'specs'     => array(
            'Rangka hollow galvanis anti-karat dengan modul gantungan gording kokoh',
            'Papan gypsum JayaBoard 9mm / Knauf dengan finishing kompon halus rata',
            'Aksen shadow line profil aluminium keliling dinding untuk kesan melayang',
            'Jalur kelistrikan tersembunyi dan instalasi lampu strip LED cove warm 3000K'
        ),
        'btn_text'  => 'Tanya Drop Ceiling (WA)',
        'wa_msg'    => 'Halo Griya Djaya Sentosa, saya ingin konsultasi pengerjaan Drop Ceiling Plafon & Architectural Lighting.',
    ),
);

// View switch
$view    = isset($_GET['view']) ? sanitize_key($_GET['view']) : 'main';
$item_id = isset($_GET['item']) ? sanitize_title($_GET['item']) : '';
?>

<!-- Google Fonts for Editorial Luxury Architecture -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&family=Newsreader:ital,opsz,wght@0,6..72,300;0,6..72,400;0,6..72,500;1,6..72,400&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Structured Data (JSON-LD) for SEO & Google Rich Results -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "ProfessionalService",
      "@id": "https://griyadjayasentosa.id/#organization",
      "name": "Griya Djaya Sentosa",
      "url": "https://griyadjayasentosa.id",
      "logo": "<?php echo esc_url( get_template_directory_uri() . '/svg/logo.svg' ); ?>",
      "image": "<?php echo esc_url( get_template_directory_uri() . '/img/interior-hero.jpg' ); ?>",
      "telephone": "+<?php echo esc_attr($wa_phone); ?>",
      "priceRange": "$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jl. Raya Transyogi No 8",
        "addressLocality": "Cileungsi, Bogor",
        "addressRegion": "Jawa Barat",
        "postalCode": "16820",
        "addressCountry": "ID"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": -6.3983,
        "longitude": 106.9687
      },
      "areaServed": {
        "@type": "AdministrativeArea",
        "name": "Jabodetabek"
      }
    },
    {
      "@type": "Service",
      "@id": "https://griyadjayasentosa.id/product/interior/#service",
      "name": "Interior Design & Turnkey Fitting Out Griya Djaya Sentosa",
      "serviceType": "Interior Architectural Design & Turnkey Contractor",
      "provider": {
        "@id": "https://griyadjayasentosa.id/#organization"
      },
      "areaServed": "Jabodetabek, Indonesia",
      "description": "Layanan desain interior arsitektural 3D dan kontraktor fitting out terpadu dengan workshop mandiri untuk residensial mewah dan properti komersial."
    }
  ]
}
</script>

<link rel="stylesheet" href="<?php echo esc_url($theme_uri . '/css/interior.css'); ?>?v=<?php echo @filemtime(get_template_directory() . '/css/interior.css'); ?>" />
<style>
/* Force blue header matching other product pages */
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }

/* Lightbox Modal */
.gjs-int-lightbox { display: none; position: fixed; z-index: 999999; padding-top: 60px; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(4,30,58,0.94); backdrop-filter: blur(8px); }
.gjs-int-lightbox-content { margin: auto; display: block; max-width: 90%; max-height: 85vh; object-fit: contain; border-radius: 12px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); }
.gjs-int-lightbox-close { position: absolute; top: 20px; right: 35px; color: #f1f1f1; font-size: 40px; font-weight: bold; cursor: pointer; transition: 0.3s; line-height: 1; }
.gjs-int-lightbox-close:hover { color: #cba85d; }
</style>

<main class="gjs-interior-wrapper">

<?php if ($view === 'single' && !empty($item_id)) : 
    // ============================================================
    // SINGLE PRODUCT DETAIL VIEW (?view=single&item=...)
    // ============================================================
    $single_title   = '';
    $single_cat     = 'Interior • Komponen Arsitektur';
    $single_desc    = '';
    $single_gallery = array();
    $single_specs   = array();
    $single_wa_msg  = '';

    // 1. Check if post exists in CPT gjs_produk
    $cpt_post = get_posts(array(
        'name'        => $item_id,
        'post_type'   => 'gjs_produk',
        'post_status' => 'publish',
        'numberposts' => 1
    ));

    if (!empty($cpt_post)) {
        $cp = $cpt_post[0];
        $single_title = $cp->post_title;
        $content_raw  = apply_filters('the_content', $cp->post_content);
        
        // Extract images from content
        preg_match_all('/<img[^>]+src="([^">]+)"/', $content_raw, $img_matches);
        if (!empty($img_matches[1])) {
            $single_gallery = array_values(array_unique($img_matches[1]));
        }
        if (empty($single_gallery) && has_post_thumbnail($cp->ID)) {
            $single_gallery[] = get_the_post_thumbnail_url($cp->ID, 'full');
        }

        // Clean text content
        $single_desc = wp_strip_all_tags($content_raw);
        if (empty($single_desc)) {
            $single_desc = !empty($cp->post_excerpt) ? $cp->post_excerpt : 'Komponen fabrikasi interior presisi tinggi hasil produksi workshop mandiri Griya Djaya Sentosa.';
        }

        $single_specs = array(
            'Material berstandar spesifikasi arsitektural presisi tinggi',
            'Fabrikasi langsung di bengkel workshop mandiri GJS',
            'Disesuaikan dengan ukuran kustom dan denah ruangan proyek Anda',
            'Dilengkapi jaminan garansi pemeliharaan resmi dan dukungan teknis'
        );
        $single_wa_msg = 'Halo Griya Djaya Sentosa, saya tertarik dengan produk ' . $single_title . ' dan ingin konsultasi serta survey lokasi.';
    } elseif (isset($default_interior_items[$item_id])) {
        // 2. Found in default curated array
        $def = $default_interior_items[$item_id];
        $single_title   = $def['title'];
        $single_cat     = 'Interior • ' . $def['badge'];
        $single_desc    = $def['desc'];
        $single_gallery = $def['gallery'];
        $single_specs   = $def['specs'];
        $single_wa_msg  = $def['wa_msg'];
    } else {
        // Fallback to first default item
        $def = reset($default_interior_items);
        $single_title   = $def['title'];
        $single_cat     = 'Interior • ' . $def['badge'];
        $single_desc    = $def['desc'];
        $single_gallery = $def['gallery'];
        $single_specs   = $def['specs'];
        $single_wa_msg  = $def['wa_msg'];
    }

    if (empty($single_gallery)) {
        $single_gallery = array($theme_uri . '/img/interior/glass-wood-fabrication.jpg');
    }

    $single_wa_url = gjs_interior_wa_link($wa_phone, $single_wa_msg);
?>
    <!-- SINGLE DETAIL CONTAINER -->
    <div class="gjs-int-single-wrap">
        <div class="gjs-int-container">
            
            <a href="<?php echo esc_url(home_url('/product/interior/#katalog-produk')); ?>" class="gjs-int-back-link">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Katalog Interior
            </a>

            <div class="gjs-int-single-grid">
                
                <!-- Left: Interactive Gallery -->
                <div>
                    <div class="gjs-int-gallery-main">
                        <img id="gjsSingleMainImg" 
                             src="<?php echo esc_url($single_gallery[0]); ?>" 
                             alt="<?php echo esc_attr($single_title); ?>"
                             onclick="gjsOpenLightbox(this.src)" />
                    </div>

                    <?php if (count($single_gallery) > 1) : ?>
                        <div class="gjs-int-gallery-thumbs">
                            <?php foreach ($single_gallery as $idx => $g_img) : ?>
                                <div class="gjs-int-gallery-thumb <?php echo $idx === 0 ? 'active' : ''; ?>" 
                                     onclick="gjsSetGalleryImage('<?php echo esc_url($g_img); ?>', this)">
                                    <img src="<?php echo esc_url($g_img); ?>" alt="Thumbnail <?php echo $idx + 1; ?>" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Product Information & CTAs -->
                <div>
                    <span class="gjs-int-single-cat"><?php echo esc_html($single_cat); ?></span>
                    <h1 class="gjs-int-single-title"><?php echo esc_html($single_title); ?></h1>
                    
                    <p class="gjs-int-single-desc">
                        <?php echo nl2br(esc_html($single_desc)); ?>
                    </p>

                    <div class="gjs-int-single-specs-title">
                        <svg width="18" height="18" fill="none" stroke="#cba85d" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Keunggulan &amp; Standar Fabrikasi
                    </div>

                    <ul class="gjs-int-single-specs-list">
                        <?php foreach ($single_specs as $sp) : ?>
                            <li>
                                <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                <span><?php echo esc_html($sp); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="gjs-int-single-actions">
                        <a href="<?php echo esc_url($single_wa_url); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-single-wa">
                            <svg width="18" height="18" fill="#cba85d" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.071.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                            Konsultasi via WhatsApp
                        </a>
                        <a href="<?php echo esc_url($wa_survey); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-single-survey">
                            Jadwalkan Survey Lokasi
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Lightbox Modal -->
    <div id="gjsLightbox" class="gjs-int-lightbox" onclick="if(event.target !== document.getElementById('gjsLightboxImg')) gjsCloseLightbox()">
        <span class="gjs-int-lightbox-close" onclick="gjsCloseLightbox()">&times;</span>
        <img id="gjsLightboxImg" class="gjs-int-lightbox-content" src="" alt="Zoom Image">
    </div>

    <script>
    function gjsSetGalleryImage(src, el) {
        document.getElementById('gjsSingleMainImg').src = src;
        document.querySelectorAll('.gjs-int-gallery-thumb').forEach(function(t) { t.classList.remove('active'); });
        if (el) el.classList.add('active');
    }
    function gjsOpenLightbox(src) {
        document.getElementById('gjsLightboxImg').src = src;
        document.getElementById('gjsLightbox').style.display = 'block';
    }
    function gjsCloseLightbox() {
        document.getElementById('gjsLightbox').style.display = 'none';
    }
    </script>

<?php else : 
    // ============================================================
    // MAIN LANDING PAGE VIEW
    // ============================================================
    $hero_tag   = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('hero_tag', 'Solusi Interior Terpadu Satu Atap') : 'Solusi Interior Terpadu Satu Atap';
    $hero_title = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('hero_title', 'Desain Interior & Fitting Out Berstandar Arsitektur Presisi') : 'Desain Interior & Fitting Out Berstandar Arsitektur Presisi';
    $hero_desc  = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('hero_desc', 'Wujudkan ruang tinggal residensial mewah dan properti komersial yang fungsional, bernilai estetika tinggi, serta awet jangka panjang. Griya Djaya Sentosa menghadirkan ekosistem terpadu: perancangan visual 3D fotorealistik yang dieksekusi langsung oleh bengkel workshop fabrikasi mandiri kami tanpa perantara.') : 'Wujudkan ruang tinggal residensial mewah dan properti komersial yang fungsional, bernilai estetika tinggi, serta awet jangka panjang. Griya Djaya Sentosa menghadirkan ekosistem terpadu: perancangan visual 3D fotorealistik yang dieksekusi langsung oleh bengkel workshop fabrikasi mandiri kami tanpa perantara.';
?>

    <!-- 2. HERO SECTION -->
    <section class="gjs-int-hero-sec">
        <div class="gjs-int-container">
            <div class="gjs-int-hero-grid">
                
                <!-- Left: Copywriting & High-Converting CTAs -->
                <div>
                    <div class="gjs-int-tag-badge">
                        <svg width="14" height="14" fill="#cba85d" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <?php echo esc_html($hero_tag); ?>
                    </div>

                    <h1 class="gjs-int-hero-h1">
                        <?php echo esc_html($hero_title); ?>
                    </h1>

                    <p class="gjs-int-hero-lead">
                        <?php echo esc_html($hero_desc); ?>
                    </p>

                    <!-- Trust Micro-Pills -->
                    <div class="gjs-int-micro-pills">
                        <div class="gjs-int-micro-pill">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            <span>Workshop Mandiri</span>
                        </div>
                        <div class="gjs-int-micro-pill">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            <span>Akurasi 3D ke Fisik</span>
                        </div>
                        <div class="gjs-int-micro-pill">
                            <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                            <span>RAB Transparan Rinci</span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="gjs-int-hero-btns">
                        <a href="<?php echo esc_url($wa_general); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-primary">
                            <svg width="16" height="16" fill="#cba85d" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.071.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                            Konsultasi Ruang via WhatsApp
                        </a>
                        <a href="#layanan-utama" class="gjs-int-btn-outline">
                            Lihat 2 Pilar Layanan &darr;
                        </a>
                    </div>
                </div>

                <!-- Right: Hero Showcase Image -->
                <div>
                    <div class="gjs-int-hero-img-box">
                        <img src="<?php echo esc_url($theme_uri . '/img/interior/interior-hero.jpg'); ?>" 
                             alt="Desain Interior Residensial Mewah Griya Djaya Sentosa" 
                             loading="eager" fetchpriority="high" decoding="async" width="1200" height="900" />
                        <div class="gjs-int-hero-img-overlay"></div>
                        <div class="gjs-int-hero-img-caption">
                            <div>
                                <span class="sub">Standard Eksekusi GJS</span>
                                <h4 class="title">Living &amp; Architectural Lounge</h4>
                            </div>
                            <span class="tag">Turnkey Ready</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 3. STICKY ANCHOR NAV & TRUST ASSURANCE BAR -->
    <nav class="gjs-int-anchornav" aria-label="Navigasi halaman interior">
        <ul>
            <li><a href="#layanan-utama">Layanan</a></li>
            <li><a href="#katalog-produk">Produk</a></li>
            <li><a href="#proses-kerja">Proses Kerja</a></li>
            <li><a href="#faq-interior">FAQ</a></li>
        </ul>
    </nav>

    <section class="gjs-int-trust-sec">
        <div class="gjs-int-container">
            <div class="gjs-int-trust-grid">
                
                <?php 
                $trust_defaults = array(
                    1 => array('num' => '01', 'title' => 'Workshop Mandiri', 'desc' => 'Fabrikasi joinery kustom, kaca arsitektural, dan profil aluminium di bengkel sendiri tanpa oper pihak ketiga.'),
                    2 => array('num' => '02', 'title' => '1 Penanggung Jawab', 'desc' => 'Arsitek desain dan tim kontraktor lapangan terkoordinasi erat, meniadakan selisih ukuran dan lempar tanggung jawab.'),
                    3 => array('num' => '03', 'title' => 'Zero Budget Blown', 'desc' => 'Rencana Anggaran Biaya (RAB) terperinci dan mengikat sejak awal, disesuaikan dengan plafon budget Anda.'),
                    4 => array('num' => '04', 'title' => 'Garansi Purna Jual', 'desc' => 'Jaminan kualitas pengerjaan, kekokohan struktur mebel, kehalusan finishing, serta dukungan purna jual terpercaya.'),
                );

                for ($ti = 1; $ti <= 4; $ti++) : 
                    $t_num   = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt("trust{$ti}_num", $trust_defaults[$ti]['num']) : $trust_defaults[$ti]['num'];
                    $t_title = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt("trust{$ti}_title", $trust_defaults[$ti]['title']) : $trust_defaults[$ti]['title'];
                    $t_desc  = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt("trust{$ti}_desc", $trust_defaults[$ti]['desc']) : $trust_defaults[$ti]['desc'];
                ?>
                    <div class="gjs-int-trust-item">
                        <div class="gjs-int-trust-num"><?php echo esc_html($t_num); ?></div>
                        <div>
                            <h4><?php echo esc_html($t_title); ?></h4>
                            <p><?php echo esc_html($t_desc); ?></p>
                        </div>
                    </div>
                <?php endfor; ?>

            </div>
        </div>
    </section>

    <!-- 4. CORE SERVICES: DUA PILAR UTAMA (INTERIOR DESIGN & FITTING OUT) -->
    <?php
    $sec_tag   = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('services_tag', 'Dua Layanan Utama Kami') : 'Dua Layanan Utama Kami';
    $sec_title = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('services_title', 'Interior Design & Turnkey Fitting Out') : 'Interior Design & Turnkey Fitting Out';
    $sec_sub   = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('services_sub', 'Kami menyediakan dua opsi fleksibel: Anda dapat memilih layanan perencanaan desain saja, eksekusi fitting out saja untuk gambar kerja yang sudah Anda miliki, atau menggabungkan keduanya dalam satu paket terpadu Turnkey Design & Build.') : 'Kami menyediakan dua opsi fleksibel: Anda dapat memilih layanan perencanaan desain saja, eksekusi fitting out saja untuk gambar kerja yang sudah Anda miliki, atau menggabungkan keduanya dalam satu paket terpadu Turnkey Design & Build.';

    // Pilar 1 Data
    $p1_badge   = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar1_badge', 'Fase 01 • Perencanaan Ruang') : 'Fase 01 • Perencanaan Ruang';
    $p1_subtext = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar1_subtext', '3D & Gambar Kerja') : '3D & Gambar Kerja';
    $p1_title   = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar1_title', 'Bespoke Interior Design') : 'Bespoke Interior Design';
    $p1_tagline = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar1_tagline', 'Space Planning • 3D Rendering • DED • Material Moodboard') : 'Space Planning • 3D Rendering • DED • Material Moodboard';
    $p1_desc    = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar1_desc', 'Kami merancang pengalaman ruang yang ergonomis dan menyatu dengan gaya hidup Anda. Melalui riset spasial menyeluruh, tim arsitek interior GJS memetakan zonasi ruang, sirkulasi pencahayaan alami, akustik ruangan, hingga kurasi palet material yang harmonis sebelum biaya konstruksi dikeluarkan.') : 'Kami merancang pengalaman ruang yang ergonomis dan menyatu dengan gaya hidup Anda. Melalui riset spasial menyeluruh, tim arsitek interior GJS memetakan zonasi ruang, sirkulasi pencahayaan alami, akustik ruangan, hingga kurasi palet material yang harmonis sebelum biaya konstruksi dikeluarkan.';
    $p1_target  = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar1_target', 'Residensial, Penthouse, Kantor, Showroom & Cafe') : 'Residensial, Penthouse, Kantor, Showroom & Cafe';
    $p1_btn     = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar1_btn_text', 'Konsultasi Desain (WA) →') : 'Konsultasi Desain (WA) →';
    $p1_raw_pts = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar1_points', "3D Photorealistic Rendering: Visualisasi 360° dengan pencahayaan dan tekstur material akurat menyerupai hasil nyata.\n2D Space Planning & Layout: Penataan denah perabot proporsional, efisiensi sirkulasi tanpa area terbuang (dead space).\nDetailed Engineering Drawing (DED): Gambar kerja teknis lengkap untuk plafon, titik lampu/MEP, pipa, dan potongan furnitur kustom.\nCurated Material Moodboard: Sampel fisik marmer, veneer kayu, finishing HPL/duco, kain pelapis, dan aksen logam.\nRAB Transparan Mengikat: Kalkulasi anggaran biaya rinci item-per-item berdasarkan volume riil material.") : "3D Photorealistic Rendering: Visualisasi 360° dengan pencahayaan dan tekstur material akurat menyerupai hasil nyata.\n2D Space Planning & Layout: Penataan denah perabot proporsional, efisiensi sirkulasi tanpa area terbuang (dead space).\nDetailed Engineering Drawing (DED): Gambar kerja teknis lengkap untuk plafon, titik lampu/MEP, pipa, dan potongan furnitur kustom.\nCurated Material Moodboard: Sampel fisik marmer, veneer kayu, finishing HPL/duco, kain pelapis, dan aksen logam.\nRAB Transparan Mengikat: Kalkulasi anggaran biaya rinci item-per-item berdasarkan volume riil material.";
    $p1_points  = gjs_interior_parse_points($p1_raw_pts);

    // Pilar 2 Data
    $p2_badge   = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar2_badge', 'Fase 02 • Konstruksi & Fabrikasi') : 'Fase 02 • Konstruksi & Fabrikasi';
    $p2_subtext = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar2_subtext', 'Turnkey Contractor') : 'Turnkey Contractor';
    $p2_title   = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar2_title', 'Turnkey Fitting Out & Millwork') : 'Turnkey Fitting Out & Millwork';
    $p2_tagline = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar2_tagline', 'In-House Workshop • Sipil • MEP • Kaca & Kisi-Kisi') : 'In-House Workshop • Sipil • MEP • Kaca & Kisi-Kisi';
    $p2_desc    = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar2_desc', 'Jembatan krusial antara gambar desain dan kenyataan fisik. Didukung oleh fasilitas bengkel workshop manufaktur mandiri milik GJS, kami memproduksi mebel built-in, partisi kaca tempered, dan wall panel secara presisi tinggi. Seluruh pengerjaan sipil dan instalasi lapangan diawasi harian oleh tim supervisor profesional.') : 'Jembatan krusial antara gambar desain dan kenyataan fisik. Didukung oleh fasilitas bengkel workshop manufaktur mandiri milik GJS, kami memproduksi mebel built-in, partisi kaca tempered, dan wall panel secara presisi tinggi. Seluruh pengerjaan sipil dan instalasi lapangan diawasi harian oleh tim supervisor profesional.';
    $p2_target  = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar2_target', 'Pemilik Rumah Baru, Renovasi Total, Fit-Out Kantor') : 'Pemilik Rumah Baru, Renovasi Total, Fit-Out Kantor';
    $p2_btn     = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar2_btn_text', 'Konsultasi Fit-Out (WA) →') : 'Konsultasi Fit-Out (WA) →';
    $p2_raw_pts = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt('pilar2_points', "In-House Custom Cabinetry: Fabrikasi kitchen set, walk-in closet, credenza, dan backdrop TV menggunakan multipleks grade A & hardware Blum/Hafele.\nArchitectural Glass & Partition: Pemasangan partisi kaca tempered, fluted glass, shower screen, dan cermin bronze presisi.\nAcoustic Wood & Fluted Panel: Pemasangan kisi-kisi kayu solid atau WPC bernilai estetika tinggi peredam gema ruangan.\nFull MEP & Lighting Setup: Instalasi kelistrikan aman, penataan titik saklar, lampu indirect ambient cove, dan ventilasi udara.\nDedicated Site Supervisor: Satu pengawas lapangan khusus untuk setiap proyek demi ketepatan jadwal kurva-S & kerapian hasil.") : "In-House Custom Cabinetry: Fabrikasi kitchen set, walk-in closet, credenza, dan backdrop TV menggunakan multipleks grade A & hardware Blum/Hafele.\nArchitectural Glass & Partition: Pemasangan partisi kaca tempered, fluted glass, shower screen, dan cermin bronze presisi.\nAcoustic Wood & Fluted Panel: Pemasangan kisi-kisi kayu solid atau WPC bernilai estetika tinggi peredam gema ruangan.\nFull MEP & Lighting Setup: Instalasi kelistrikan aman, penataan titik saklar, lampu indirect ambient cove, dan ventilasi udara.\nDedicated Site Supervisor: Satu pengawas lapangan khusus untuk setiap proyek demi ketepatan jadwal kurva-S & kerapian hasil.";
    $p2_points  = gjs_interior_parse_points($p2_raw_pts);
    ?>

    <section class="gjs-int-services-sec" id="layanan-utama">
        <div class="gjs-int-container">
            
            <div class="gjs-int-sec-header">
                <span class="gjs-int-sec-tag"><?php echo esc_html($sec_tag); ?></span>
                <h2 class="gjs-int-sec-h2"><?php echo esc_html($sec_title); ?></h2>
                <p class="gjs-int-sec-sub">
                    <?php echo esc_html($sec_sub); ?>
                </p>
            </div>

            <!-- Two Big Pillar Showcase Cards (DYNAMIC 2 CARDS) -->
            <div class="gjs-int-services-grid">
                
                <!-- Pillar 1: INTERIOR DESIGN -->
                <div class="gjs-int-service-card" id="interior-design">
                    <div>
                        <div class="gjs-int-service-head">
                            <span class="gjs-int-service-badge"><?php echo esc_html($p1_badge); ?></span>
                            <span class="gjs-int-service-subtext"><?php echo esc_html($p1_subtext); ?></span>
                        </div>

                        <h3 class="gjs-int-service-title"><?php echo esc_html($p1_title); ?></h3>
                        <p class="gjs-int-service-tagline"><?php echo esc_html($p1_tagline); ?></p>
                        
                        <p class="gjs-int-service-desc">
                            <?php echo esc_html($p1_desc); ?>
                        </p>

                        <h4 class="gjs-int-check-title">Lingkup Output yang Anda Dapatkan:</h4>
                        <ul class="gjs-int-check-list">
                            <?php foreach ($p1_points as $pt) : ?>
                                <li>
                                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                    <span><?php echo $pt; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="gjs-int-service-footer">
                        <div class="gjs-int-service-target">
                            <strong>Cocok untuk:</strong>
                            <?php echo esc_html($p1_target); ?>
                        </div>
                        <a href="<?php echo esc_url($wa_design); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-sm">
                            <?php echo esc_html($p1_btn); ?>
                        </a>
                    </div>
                </div>

                <!-- Pillar 2: FITTING OUT -->
                <div class="gjs-int-service-card" id="fitting-out">
                    <div>
                        <div class="gjs-int-service-head">
                            <span class="gjs-int-service-badge gold"><?php echo esc_html($p2_badge); ?></span>
                            <span class="gjs-int-service-subtext"><?php echo esc_html($p2_subtext); ?></span>
                        </div>

                        <h3 class="gjs-int-service-title"><?php echo esc_html($p2_title); ?></h3>
                        <p class="gjs-int-service-tagline"><?php echo esc_html($p2_tagline); ?></p>
                        
                        <p class="gjs-int-service-desc">
                            <?php echo esc_html($p2_desc); ?>
                        </p>

                        <h4 class="gjs-int-check-title">Keunggulan Eksekusi Lapangan GJS:</h4>
                        <ul class="gjs-int-check-list">
                            <?php foreach ($p2_points as $pt) : ?>
                                <li>
                                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>
                                    <span><?php echo $pt; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <div class="gjs-int-service-footer">
                        <div class="gjs-int-service-target">
                            <strong>Cocok untuk:</strong>
                            <?php echo esc_html($p2_target); ?>
                        </div>
                        <a href="<?php echo esc_url($wa_fitout); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-sm gold">
                            <?php echo esc_html($p2_btn); ?>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- 5. VALUE PROPOSITION: BENGKEL SENDIRI -->
    <section class="gjs-int-value-sec">
        <div class="gjs-int-container">
            <div class="gjs-int-sec-header">
                <span class="gjs-int-sec-tag">Kenapa Griya Djaya Sentosa?</span>
                <h2 class="gjs-int-sec-h2" style="margin-bottom:16px;">
                    Jaminan Kualitas dengan In-House Fabrication
                </h2>
                <p class="gjs-int-sec-sub">
                    Mayoritas kendala interior bermula dari vendor perantara. Di Griya Djaya Sentosa, setiap potongan kayu, kaca tempered, dan kisi-kisi diproduksi langsung di workshop fabrikasi mandiri kami.
                </p>
            </div>

            <div class="gjs-int-value-grid">
                
                <div class="gjs-int-value-card">
                    <div class="gjs-int-value-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                            <path d="M3 21h18" stroke="#041e3a" stroke-width="2" stroke-linecap="round"/>
                            <path d="M5 21V9l7-5 7 5v12" stroke="#041e3a" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M9 13h6v8H9z" class="gjs-gold-part" fill="rgba(203,168,93,0.18)" stroke="#cba85d" stroke-width="1.8"/>
                            <path d="M10 8h4" class="gjs-gold-part" stroke="#cba85d" stroke-width="2" stroke-linecap="round"/>
                            <circle cx="12" cy="16" r="1" fill="#cba85d"/>
                        </svg>
                    </div>
                    <h3 class="gjs-int-value-title">Bengkel Workshop Sendiri</h3>
                    <p class="gjs-int-value-desc">
                        Kami mengoperasikan fasilitas workshop perkayuan, perakitan aluminium, dan pengolahan kaca mandiri di Cileungsi &amp; Bekasi. Tanpa biaya markup broker atau pihak ketiga.
                    </p>
                </div>

                <div class="gjs-int-value-card">
                    <div class="gjs-int-value-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9.5" stroke="#041e3a" stroke-width="1.8"/>
                            <path d="M12 2.5v3M12 18.5v3M2.5 12h3M18.5 12h3" stroke="#041e3a" stroke-width="1.8" stroke-linecap="round"/>
                            <path d="M12 6.5l3.5 10.5-3.5-3-3.5 3L12 6.5z" class="gjs-gold-part" fill="rgba(203,168,93,0.22)" stroke="#cba85d" stroke-width="1.8" stroke-linejoin="round"/>
                            <circle cx="12" cy="12" r="1.5" fill="#cba85d"/>
                        </svg>
                    </div>
                    <h3 class="gjs-int-value-title">Presisi Gambar ke Fisik</h3>
                    <p class="gjs-int-value-desc">
                        Tingkat deviasi antara gambar 3D render dengan hasil fisik terpasang mendekati nol. Standar sambungan rapi (hairline joint), flush surface, dan keselarasan garis lurus.
                    </p>
                </div>

                <div class="gjs-int-value-card">
                    <div class="gjs-int-value-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                            <path d="M12 2.5l7.5 3.5v5.5c0 5-3.2 9.5-7.5 11-4.3-1.5-7.5-6-7.5-11V6L12 2.5z" stroke="#041e3a" stroke-width="2" stroke-linejoin="round"/>
                            <path d="M8.5 11.5l2.5 2.5 5-5" class="gjs-gold-part" stroke="#cba85d" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="12" r="6.5" stroke="rgba(203,168,93,0.3)" stroke-width="1" stroke-dasharray="2 2"/>
                        </svg>
                    </div>
                    <h3 class="gjs-int-value-title">Biaya Tetap Tanpa Kejutan</h3>
                    <p class="gjs-int-value-desc">
                        Rencana Anggaran Biaya (RAB) disusun transparan item-per-item sejak awal. Tidak ada biaya siluman di tengah proyek berkat spesifikasi material yang disepakati di muka.
                    </p>
                </div>

                <div class="gjs-int-value-card">
                    <div class="gjs-int-value-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none">
                            <circle cx="12" cy="12" r="9" stroke="#041e3a" stroke-width="2"/>
                            <path d="M12 7v5l3 2" stroke="#041e3a" stroke-width="2" stroke-linecap="round"/>
                            <path d="M12 3a9 9 0 0 1 9 9" class="gjs-gold-part" stroke="#cba85d" stroke-width="2.8" stroke-linecap="round"/>
                            <circle cx="21" cy="12" r="2" class="gjs-gold-part" fill="#cba85d"/>
                        </svg>
                    </div>
                    <h3 class="gjs-int-value-title">Ketepatan Waktu Terukur</h3>
                    <p class="gjs-int-value-desc">
                        Progres pengerjaan dikontrol menggunakan kurva-S dan jadwal harian. Anda menerima laporan foto/video perkembangan berkala dari site supervisor tanpa harus repot mengawasi.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. DYNAMIC PRODUCTS CATALOG -->
    <section class="gjs-int-products-sec" id="katalog-produk">
        <div class="gjs-int-container">
            
            <div class="gjs-int-sec-header">
                <span class="gjs-int-sec-tag">Katalog Elemen Arsitektural</span>
                <h2 class="gjs-int-sec-h2">Produk &amp; Komponen Fabrikasi Interior</h2>
                <p class="gjs-int-sec-sub">
                    Seluruh elemen arsitektural interior ini diproduksi dan dipasang langsung oleh tim spesialis Griya Djaya Sentosa dengan standar presisi tinggi. Kustomisasi dimensi &amp; material tersedia.
                </p>
            </div>

            <!-- Products Grid: Dynamically Query CPT gjs_produk with Fallback -->
            <div class="gjs-int-products-grid">
                
                <?php
                // Query CPT gjs_produk where kategori_produk in ('interior', 'interior-design', 'fitting-out')
                $cpt_query = new WP_Query(array(
                    'post_type'      => 'gjs_produk',
                    'post_status'    => 'publish',
                    'posts_per_page' => 12,
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'kategori_produk',
                            'field'    => 'slug',
                            'terms'    => array('interior', 'interior-design', 'fitting-out'),
                        ),
                    ),
                ));

                if ($cpt_query->have_posts()) :
                    while ($cpt_query->have_posts()) : $cpt_query->the_post();
                        $post_id     = get_the_ID();
                        $post_slug   = get_post_field('post_name', $post_id);
                        $post_title  = get_the_title();
                        $post_img    = has_post_thumbnail($post_id) ? get_the_post_thumbnail_url($post_id, 'large') : $theme_uri . '/img/interior/glass-wood-fabrication.jpg';
                        $post_desc   = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 20);
                        $post_terms  = wp_get_post_terms($post_id, 'kategori_produk');
                        $post_badge  = !empty($post_terms) ? $post_terms[0]->name : 'Interior';
                        $single_url  = add_query_arg(array('view' => 'single', 'item' => $post_slug), home_url('/product/interior/'));
                        $card_wa_url = gjs_interior_wa_link($wa_phone, 'Halo Griya Djaya Sentosa, saya tertarik dengan produk ' . $post_title . ' untuk interior.');
                ?>
                    <div class="gjs-int-prod-card">
                        <div>
                            <a href="<?php echo esc_url($single_url); ?>" style="text-decoration:none; color:inherit;">
                                <div class="gjs-int-prod-img">
                                    <img src="<?php echo esc_url($post_img); ?>" 
                                         alt="<?php echo esc_attr($post_title); ?>" 
                                         loading="lazy" decoding="async" />
                                    <span class="gjs-int-prod-badge"><?php echo esc_html($post_badge); ?></span>
                                </div>
                            </a>
                            <div class="gjs-int-prod-body">
                                <div class="gjs-int-prod-meta">
                                    <span class="cat">Fabrikasi Mandiri</span>
                                    <span>Custom Presisi</span>
                                </div>
                                <h3 class="gjs-int-prod-title">
                                    <a href="<?php echo esc_url($single_url); ?>" style="color:inherit; text-decoration:none;">
                                        <?php echo esc_html($post_title); ?>
                                    </a>
                                </h3>
                                <p class="gjs-int-prod-desc">
                                    <?php echo esc_html($post_desc); ?>
                                </p>
                            </div>
                        </div>
                        <div class="gjs-int-prod-footer" style="display:flex; flex-direction:column; gap:8px;">
                            <a href="<?php echo esc_url($single_url); ?>" class="gjs-int-btn-prod-wa" style="background:#041e3a; color:#fff !important; border-color:#041e3a;">
                                Lihat Spesifikasi &amp; Detail &rarr;
                            </a>
                            <a href="<?php echo esc_url($card_wa_url); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-prod-wa">
                                Konsultasi via WA
                            </a>
                        </div>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback to default curated items
                    foreach ($default_interior_items as $item_key => $item) :
                        $item_single_url = add_query_arg(array('view' => 'single', 'item' => $item['id']), home_url('/product/interior/'));
                        $item_wa_url     = gjs_interior_wa_link($wa_phone, $item['wa_msg']);
                ?>
                    <div class="gjs-int-prod-card">
                        <div>
                            <a href="<?php echo esc_url($item_single_url); ?>" style="text-decoration:none; color:inherit;">
                                <div class="gjs-int-prod-img <?php echo $item_key === 'wall-panel' ? 'contain-fit' : ''; ?>">
                                    <img src="<?php echo esc_url($item['img']); ?>" 
                                         alt="<?php echo esc_attr($item['title']); ?> Griya Djaya Sentosa" 
                                         loading="lazy" decoding="async" />
                                    <span class="gjs-int-prod-badge"><?php echo esc_html($item['badge']); ?></span>
                                </div>
                            </a>
                            <div class="gjs-int-prod-body">
                                <div class="gjs-int-prod-meta">
                                    <span class="cat"><?php echo esc_html($item['meta_cat']); ?></span>
                                    <span><?php echo esc_html($item['meta_sub']); ?></span>
                                </div>
                                <h3 class="gjs-int-prod-title">
                                    <a href="<?php echo esc_url($item_single_url); ?>" style="color:inherit; text-decoration:none;">
                                        <?php echo esc_html($item['title']); ?>
                                    </a>
                                </h3>
                                <p class="gjs-int-prod-desc">
                                    <?php echo esc_html($item['desc']); ?>
                                </p>
                                <div class="gjs-int-prod-tags">
                                    <?php foreach ($item['tags'] as $tg) : ?>
                                        <span class="gjs-int-tag"><?php echo esc_html($tg); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="gjs-int-prod-footer" style="display:flex; flex-direction:column; gap:8px;">
                            <a href="<?php echo esc_url($item_single_url); ?>" class="gjs-int-btn-prod-wa" style="background:#041e3a; color:#fff !important; border-color:#041e3a;">
                                Lihat Spesifikasi &amp; Detail &rarr;
                            </a>
                            <a href="<?php echo esc_url($item_wa_url); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-prod-wa">
                                <?php echo esc_html($item['btn_text']); ?>
                            </a>
                        </div>
                    </div>
                <?php 
                    endforeach;
                endif; 
                ?>

            </div>

        </div>
    </section>

    <!-- 7. MASTER PROJECT SHOWCASE -->
    <section class="gjs-int-showcase-sec">
        <div class="gjs-int-container">
            
            <div class="gjs-int-sec-header">
                <span class="gjs-int-sec-tag">Showcase Eksekusi Ruang</span>
                <h2 class="gjs-int-sec-h2">Harmoni Material Arsitektural dalam Satu Ruang</h2>
                <p class="gjs-int-sec-sub">
                    Saksikan bagaimana perpaduan partisi kaca, kisi-kisi kayu, dan custom joinery yang diproduksi di workshop GJS menyatu menciptakan ruang keluarga dan ruang baca bernilai seni tinggi.
                </p>
            </div>

            <!-- Showcase Container with Touch-Friendly Pins -->
            <div class="gjs-int-showcase-box">
                <div class="gjs-int-showcase-img">
                    <img src="<?php echo esc_url($theme_uri . '/img/interior/luxury-penthouse.jpg'); ?>" 
                         alt="Showcase Eksekusi Interior Griya Djaya Sentosa" 
                         loading="lazy" decoding="async" />
                    
                    <div class="gjs-int-showcase-overlay"></div>

                    <!-- Hotspot 1: Glass Partition -->
                    <div class="gjs-int-pin" style="top: 40%; left: 25%;">
                        <button class="gjs-int-pin-btn" aria-label="Detail Partisi Kaca">
                            <span class="gjs-int-pin-core"></span>
                        </button>
                        <div class="gjs-int-pin-popover">
                            <span class="tag">Komponen 01</span>
                            <h5>Partisi Kaca Bronze &amp; Aluminium</h5>
                            <p>Kaca tempered berlapis bronze finish dengan profil kusen ultra-slimline presisi tinggi.</p>
                        </div>
                    </div>

                    <!-- Hotspot 2: Slatted Wall Panel -->
                    <div class="gjs-int-pin" style="top: 30%; right: 28%;">
                        <button class="gjs-int-pin-btn" aria-label="Detail Wall Panel Kisi-Kisi">
                            <span class="gjs-int-pin-core"></span>
                        </button>
                        <div class="gjs-int-pin-popover">
                            <span class="tag">Komponen 02</span>
                            <h5>Wall Panel Kisi-Kisi Kayu Akustik</h5>
                            <p>Kisi-kisi kayu vertikal solid veneer peredam pantulan gema suara dalam ruangan.</p>
                        </div>
                    </div>

                    <!-- Hotspot 3: Custom Credenza & Built-in Furniture -->
                    <div class="gjs-int-pin" style="bottom: 25%; left: 45%;">
                        <button class="gjs-int-pin-btn" aria-label="Detail Custom Credenza">
                            <span class="gjs-int-pin-core"></span>
                        </button>
                        <div class="gjs-int-pin-popover">
                            <span class="tag">Komponen 03</span>
                            <h5>Custom Floating Credenza</h5>
                            <p>Kabinet gantung custom multipleks grade A dengan finishing duco matte dan aksen kuningan.</p>
                        </div>
                    </div>
                </div>

                <!-- Bottom Bar -->
                <div class="gjs-int-showcase-bar">
                    <div class="gjs-int-showcase-bar-content">
                        <div>
                            <span class="sub">Tipe Proyek Showcase</span>
                            <h4>Penthouse Residensial Privat &bull; Turnkey Fit-Out</h4>
                        </div>
                        <a href="<?php echo esc_url($wa_general); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-gold">
                            Diskusikan Proyek Serupa
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- 8. STEP-BY-STEP WORKFLOW -->
    <section class="gjs-int-workflow-sec" id="proses-kerja">
        <div class="gjs-int-container">
            
            <div class="gjs-int-sec-header">
                <span class="gjs-int-sec-tag">Proses Terstruktur GJS</span>
                <h2 class="gjs-int-sec-h2">5 Langkah Menuju Ruang Impian Anda</h2>
                <p class="gjs-int-sec-sub">
                    Setiap tahapan dirancang sistematis dan transparan demi memastikan hasil akhir sesuai ekspektasi tanpa stres.
                </p>
            </div>

            <div class="gjs-int-workflow-grid">
                
                <div class="gjs-int-step-card">
                    <div class="gjs-int-step-num">01</div>
                    <h3 class="gjs-int-step-title">Konsultasi &amp; Moodboard</h3>
                    <p class="gjs-int-step-desc">
                        Diskusi awal seputar kebutuhan fungsi ruang, preferensi estetika, dan estimasi anggaran yang Anda alokasikan.
                    </p>
                </div>

                <div class="gjs-int-step-card">
                    <div class="gjs-int-step-num">02</div>
                    <h3 class="gjs-int-step-title">Survey Lapangan &amp; Ukur</h3>
                    <p class="gjs-int-step-desc">
                        Tim teknis kami turun langsung melakukan pengukuran laser presisi dan pengecekan jalur pipa &amp; kelistrikan MEP.
                    </p>
                </div>

                <div class="gjs-int-step-card">
                    <div class="gjs-int-step-num">03</div>
                    <h3 class="gjs-int-step-title">3D Render &amp; Gambar DED</h3>
                    <p class="gjs-int-step-desc">
                        Penyusunan gambar 3D fotorealistik hingga disetujui, dilanjutkan pembuatan gambar teknis DED dan penawaran RAB final.
                    </p>
                </div>

                <div class="gjs-int-step-card">
                    <div class="gjs-int-step-num">04</div>
                    <h3 class="gjs-int-step-title">Fabrikasi Workshop &amp; Instalasi</h3>
                    <p class="gjs-int-step-desc">
                        Mebel dan partisi difabrikasi di workshop mandiri, lalu dirakit di lokasi proyek dengan pengawasan ketat supervisor.
                    </p>
                </div>

                <div class="gjs-int-step-card">
                    <div class="gjs-int-step-num">05</div>
                    <h3 class="gjs-int-step-title">Serah Terima &amp; Garansi</h3>
                    <p class="gjs-int-step-desc">
                        Pemeriksaan bersama (checklist serah terima), pembersihan akhir, dan penyerahan sertifikat garansi purna jual resmi.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- 9. DYNAMIC FAQ ACCORDION -->
    <section class="gjs-int-faq-sec" id="faq-interior">
        <div class="gjs-int-container">
            
            <div class="gjs-int-sec-header">
                <span class="gjs-int-sec-tag">Informasi &amp; Tanya Jawab</span>
                <h2 class="gjs-int-sec-h2">Pertanyaan yang Sering Diajukan</h2>
                <p class="gjs-int-sec-sub">
                    Jawaban seputar layanan desain interior, estimasi biaya, dan sistem pelaksanaan di Griya Djaya Sentosa.
                </p>
            </div>

            <div class="gjs-int-faq-wrap">
                
                <?php
                $faq_defaults = array(
                    1 => array(
                        'q' => 'Apakah saya bisa memakai jasa Interior Design saja tanpa fitting out (atau sebaliknya)?',
                        'a' => 'Tentu bisa. Anda dapat memesan paket perancangan desain saja (lengkap dengan visualisasi 3D, denah layout 2D, Detailed Engineering Drawing/DED, dan rincian RAB). Sebaliknya, jika Anda sudah memiliki gambar desain dari arsitek lain, bengkel workshop dan tim fitting out GJS siap langsung mengeksekusi pengerjaan fisiknya.'
                    ),
                    2 => array(
                        'q' => 'Bagaimana cara perhitungan biaya interior di Griya Djaya Sentosa?',
                        'a' => 'Kalkulasi biaya kami sangat transparan dan menggunakan sistem Rencana Anggaran Biaya (RAB) terperinci per item volume pekerjaan (misal per meter lari untuk kabinet, per meter persegi untuk partisi kaca/wall panel, dan per titik untuk instalasi MEP). Kami tidak mengenakan biaya tersembunyi, sehingga Anda mengetahui persis spesifikasi material yang Anda bayar.'
                    ),
                    3 => array(
                        'q' => 'Apakah Griya Djaya Sentosa melayani proyek komersial (kantor, resto, toko)?',
                        'a' => 'Ya. Selain melayani residensial mewah (rumah tinggal, villa, dan apartemen penthouse), kami memiliki divisi spesialis untuk fitting out properti komersial, seperti partisi kaca ruang kantor (meeting room & workstation), interior kafe, restoran, klinik kesehatan, maupun gerai retail showroom.'
                    ),
                    4 => array(
                        'q' => 'Berapa lama rata-rata durasi pengerjaan proyek interior?',
                        'a' => 'Untuk tahap desain 3D dan penyusunan gambar teknis DED umumnya memakan waktu 1 hingga 2 minggu. Untuk tahap fabrikasi workshop dan konstruksi fitting out lapangan rata-rata berlangsung antara 4 hingga 8 minggu, tergantung luas area dan tingkat kerumitan detail kustomisasi ruangan Anda.'
                    ),
                    5 => array(
                        'q' => 'Apakah ada garansi pemeliharaan setelah proyek selesai diserahterimakan?',
                        'a' => 'Ya. Kami memberikan garansi pemeliharaan resmi pasca serah terima untuk menjamin kekuatan struktur joinery kabinet, kerapihan sambungan partisi kaca, fungsi mekanis engsel/rel laci, serta instalasi kelistrikan. Kepuasan dan kenyamanan jangka panjang klien adalah komitmen utama kami.'
                    ),
                );

                for ($fi = 1; $fi <= 5; $fi++) :
                    $fq = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt("faq{$fi}_q", $faq_defaults[$fi]['q']) : $faq_defaults[$fi]['q'];
                    $fa = function_exists('gjs_get_interior_opt') ? gjs_get_interior_opt("faq{$fi}_a", $faq_defaults[$fi]['a']) : $faq_defaults[$fi]['a'];
                ?>
                    <details class="gjs-int-faq-item">
                        <summary>
                            <span><?php echo esc_html($fq); ?></span>
                            <svg class="gjs-int-faq-chevron" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                        </summary>
                        <div class="gjs-int-faq-body">
                            <?php echo nl2br(esc_html($fa)); ?>
                        </div>
                    </details>
                <?php endfor; ?>

            </div>

        </div>
    </section>

    <!-- 10. CLOSING HIGH-IMPACT CTA BANNER -->
    <section class="gjs-int-cta-sec">
        <div class="gjs-int-container">
            <div class="gjs-int-cta-banner">
                
                <div class="gjs-int-cta-glow"></div>

                <div class="gjs-int-cta-content">
                    <span class="gjs-int-cta-tag">Mulai Transformasi Ruang Anda</span>
                    <h2 class="gjs-int-cta-h2">Ingin Mewujudkan Interior Idaman dengan Presisi Arsitektur?</h2>
                    <p class="gjs-int-cta-p">
                        Diskusikan visi interior hunian residensial atau ruang usaha komersial Anda bersama tim arsitek dan kontraktor fabrikasi Griya Djaya Sentosa. Dapatkan konsultasi tata ruang perdana dan estimasi anggaran awal tanpa komitmen.
                    </p>

                    <div class="gjs-int-cta-btns">
                        <a href="<?php echo esc_url($wa_general); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-cta-gold">
                            <svg width="16" height="16" fill="#041e3a" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.071.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
                            Konsultasi Cepat via WhatsApp
                        </a>
                        <a href="<?php echo esc_url($wa_survey); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-cta-outline">
                            Jadwalkan Survey Lokasi
                        </a>
                    </div>

                    <div class="gjs-int-cta-trust">
                        <span><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> Bebas Biaya Diskusi Awal</span>
                        <span><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> Respon Cepat Tim Teknis</span>
                        <span><svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> Melayani Area Jabodetabek &amp; Sekitarnya</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

<?php endif; ?>

</main>
<script>
(function(){
    var l = document.querySelectorAll('.gjs-int-anchornav a');
    if (!l.length || !('IntersectionObserver' in window)) return;
    var m = {};
    l.forEach(function(a){
        var href = a.getAttribute('href');
        if (href && href.indexOf('#') === 0) {
            m[href.slice(1)] = a;
        }
    });
    var o = new IntersectionObserver(function(e){
        e.forEach(function(x){
            if (x.isIntersecting && m[x.target.id]) {
                l.forEach(function(a){ a.classList.remove('is-active'); });
                m[x.target.id].classList.add('is-active');
            }
        });
    }, {rootMargin: '-40% 0px -55% 0px'});
    Object.keys(m).forEach(function(id){
        var s = document.getElementById(id);
        if (s) o.observe(s);
    });
})();
</script>

<!-- MOBILE STICKY CONTACT BAR -->
<div class="gjs-int-mobile-sticky">
    <div class="gjs-int-mobile-sticky-row">
        <a href="<?php echo esc_url($wa_general); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-sticky-wa">
            <svg width="15" height="15" fill="#cba85d" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.173.086.275.071.376-.044.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.043.073.043.419-.101.824z"/></svg>
            Konsultasi WA
        </a>
        <a href="<?php echo esc_url($wa_survey); ?>" target="_blank" rel="noopener noreferrer" class="gjs-int-btn-sticky-survey">
            Survey
        </a>
    </div>
</div>

<?php get_footer(); ?>
