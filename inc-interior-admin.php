<?php
/**
 * Pengaturan Dinamis Halaman Interior Griya Djaya Sentosa
 * Menyediakan Admin Page di WP Admin > Produk > Pengaturan Interior
 * dan helper functions untuk page-product-interior.php
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Helper untuk mengambil nilai opsi dinamis interior dengan fallback
 */
function gjs_get_interior_opt($key, $default = '') {
    $val = get_option('gjs_int_' . $key);
    if ($val !== false && $val !== '' && $val !== null) {
        return $val;
    }
    return $default;
}

/**
 * Daftarkan submenu di bawah Menu "Produk" (CPT gjs_produk)
 */
add_action('admin_menu', 'gjs_interior_add_admin_menu');
function gjs_interior_add_admin_menu() {
    add_submenu_page(
        'edit.php?post_type=gjs_produk',
        'Pengaturan Halaman Interior',
        'Pengaturan Interior',
        'manage_options',
        'gjs-interior-settings',
        'gjs_interior_render_admin_page'
    );
}

/**
 * Handle form submission simpan pengaturan
 */
add_action('admin_init', 'gjs_interior_handle_settings_save');
function gjs_interior_handle_settings_save() {
    if (!isset($_POST['gjs_interior_save'])) {
        return;
    }

    if (!current_user_can('manage_options')) {
        wp_die('Akses ditolak.');
    }

    check_admin_referer('gjs_interior_settings_action', 'gjs_interior_settings_nonce');

    // List of option keys to save
    $text_keys = array(
        'wa_phone',
        'hero_tag',
        'hero_title',
        'services_tag',
        'services_title',
        'services_sub',
        'pilar1_badge',
        'pilar1_subtext',
        'pilar1_title',
        'pilar1_tagline',
        'pilar1_target',
        'pilar1_btn_text',
        'pilar2_badge',
        'pilar2_subtext',
        'pilar2_title',
        'pilar2_tagline',
        'pilar2_target',
        'pilar2_btn_text',
        'trust1_num',
        'trust1_title',
        'trust1_desc',
        'trust2_num',
        'trust2_title',
        'trust2_desc',
        'trust3_num',
        'trust3_title',
        'trust3_desc',
        'trust4_num',
        'trust4_title',
        'trust4_desc',
        'faq1_q',
        'faq1_a',
        'faq2_q',
        'faq2_a',
        'faq3_q',
        'faq3_a',
        'faq4_q',
        'faq4_a',
        'faq5_q',
        'faq5_a',
    );

    $html_keys = array(
        'hero_desc',
        'pilar1_desc',
        'pilar1_points',
        'pilar2_desc',
        'pilar2_points',
    );

    foreach ($text_keys as $k) {
        if (isset($_POST[$k])) {
            update_option('gjs_int_' . $k, sanitize_text_field(wp_unslash($_POST[$k])));
        }
    }

    foreach ($html_keys as $k) {
        if (isset($_POST[$k])) {
            update_option('gjs_int_' . $k, wp_kses_post(wp_unslash($_POST[$k])));
        }
    }

    // Redirect to avoid resubmit on refresh
    wp_safe_redirect(add_query_arg(
        array(
            'post_type' => 'gjs_produk',
            'page'      => 'gjs-interior-settings',
            'updated'   => 'true'
        ),
        admin_url('edit.php')
    ));
    exit;
}

/**
 * Tampilkan halaman pengaturan di WP Admin
 */
function gjs_interior_render_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'layanan';
    ?>
    <div class="wrap">
        <h1 style="font-weight:700; margin-bottom: 20px;">
            <span class="dashicons dashicons-admin-customizer" style="font-size:32px; width:32px; height:32px; margin-right:8px;"></span>
            Pengaturan Dinamis Halaman Interior
        </h1>

        <?php if (isset($_GET['updated']) && $_GET['updated'] === 'true') : ?>
            <div class="notice notice-success is-dismissible">
                <p><strong>Pengaturan Halaman Interior berhasil disimpan!</strong> Perubahan langsung aktif di <a href="<?php echo esc_url(home_url('/product/interior/')); ?>" target="_blank">halaman interior</a>.</p>
            </div>
        <?php endif; ?>

        <nav class="nav-tab-wrapper" style="margin-bottom: 20px;">
            <a href="?post_type=gjs_produk&page=gjs-interior-settings&tab=layanan" class="nav-tab <?php echo $active_tab === 'layanan' ? 'nav-tab-active' : ''; ?>">
                2 Pilar Layanan Utama (#layanan-utama)
            </a>
            <a href="?post_type=gjs_produk&page=gjs-interior-settings&tab=hero" class="nav-tab <?php echo $active_tab === 'hero' ? 'nav-tab-active' : ''; ?>">
                Hero &amp; Kontak WhatsApp
            </a>
            <a href="?post_type=gjs_produk&page=gjs-interior-settings&tab=trust" class="nav-tab <?php echo $active_tab === 'trust' ? 'nav-tab-active' : ''; ?>">
                Bar Trust &amp; Statistik
            </a>
            <a href="?post_type=gjs_produk&page=gjs-interior-settings&tab=faq" class="nav-tab <?php echo $active_tab === 'faq' ? 'nav-tab-active' : ''; ?>">
                Tanya Jawab (FAQ)
            </a>
            <a href="?post_type=gjs_produk&page=gjs-interior-settings&tab=produk" class="nav-tab <?php echo $active_tab === 'produk' ? 'nav-tab-active' : ''; ?>">
                Info Katalog &amp; CPT
            </a>
        </nav>

        <form method="post" action="">
            <?php wp_nonce_field('gjs_interior_settings_action', 'gjs_interior_settings_nonce'); ?>
            <input type="hidden" name="gjs_interior_save" value="1">

            <!-- TAB 1: LAYANAN UTAMA -->
            <?php if ($active_tab === 'layanan') : ?>
                <div class="card" style="max-width: 1000px; padding: 25px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 8px;">
                    <h2 style="margin-top:0; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Header Bagian Layanan</h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="services_tag">Tag / Kategori Kecil</label></th>
                            <td>
                                <input type="text" name="services_tag" id="services_tag" class="regular-text" 
                                       value="<?php echo esc_attr(gjs_get_interior_opt('services_tag', 'Dua Layanan Utama Kami')); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="services_title">Judul Utama Bagian</label></th>
                            <td>
                                <input type="text" name="services_title" id="services_title" class="large-text" 
                                       value="<?php echo esc_attr(gjs_get_interior_opt('services_title', 'Interior Design & Turnkey Fitting Out')); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="services_sub">Deskripsi Pengantar</label></th>
                            <td>
                                <textarea name="services_sub" id="services_sub" rows="3" class="large-text"><?php echo esc_textarea(gjs_get_interior_opt('services_sub', 'Kami menyediakan dua opsi fleksibel: Anda dapat memilih layanan perencanaan desain saja, eksekusi fitting out saja untuk gambar kerja yang sudah Anda miliki, atau menggabungkan keduanya dalam satu paket terpadu Turnkey Design & Build.')); ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- PILAR 1: INTERIOR DESIGN -->
                <div class="card" style="max-width: 1000px; padding: 25px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 8px; border-left: 4px solid #041e3a;">
                    <h2 style="margin-top:0; color:#041e3a; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        Pilar 1: Interior Design (Perencanaan Ruang)
                    </h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="pilar1_badge">Badge / Tahap</label></th>
                            <td><input type="text" name="pilar1_badge" id="pilar1_badge" class="regular-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar1_badge', 'Fase 01 • Perencanaan Ruang')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar1_subtext">Sub-teks Kanan</label></th>
                            <td><input type="text" name="pilar1_subtext" id="pilar1_subtext" class="regular-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar1_subtext', '3D & Gambar Kerja')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar1_title">Judul Layanan</label></th>
                            <td><input type="text" name="pilar1_title" id="pilar1_title" class="large-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar1_title', 'Bespoke Interior Design')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar1_tagline">Tagline / Spesialisasi</label></th>
                            <td><input type="text" name="pilar1_tagline" id="pilar1_tagline" class="large-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar1_tagline', 'Space Planning • 3D Rendering • DED • Material Moodboard')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar1_desc">Paragraf Penjelasan</label></th>
                            <td><textarea name="pilar1_desc" id="pilar1_desc" rows="4" class="large-text"><?php echo esc_textarea(gjs_get_interior_opt('pilar1_desc', 'Kami merancang pengalaman ruang yang ergonomis dan menyatu dengan gaya hidup Anda. Melalui riset spasial menyeluruh, tim arsitek interior GJS memetakan zonasi ruang, sirkulasi pencahayaan alami, akustik ruangan, hingga kurasi palet material yang harmonis sebelum biaya konstruksi dikeluarkan.')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar1_points">Poin Output (1 per baris, format: Judul: Keterangan)</label></th>
                            <td>
                                <textarea name="pilar1_points" id="pilar1_points" rows="6" class="large-text"><?php 
                                    $default_pts1 = "3D Photorealistic Rendering: Visualisasi 360° dengan pencahayaan dan tekstur material akurat menyerupai hasil nyata.\n2D Space Planning & Layout: Penataan denah perabot proporsional, efisiensi sirkulasi tanpa area terbuang (dead space).\nDetailed Engineering Drawing (DED): Gambar kerja teknis lengkap untuk plafon, titik lampu/MEP, pipa, dan potongan furnitur kustom.\nCurated Material Moodboard: Sampel fisik marmer, veneer kayu, finishing HPL/duco, kain pelapis, dan aksen logam.\nRAB Transparan Mengikat: Kalkulasi anggaran biaya rinci item-per-item berdasarkan volume riil material.";
                                    echo esc_textarea(gjs_get_interior_opt('pilar1_points', $default_pts1)); 
                                ?></textarea>
                                <p class="description">Pisahkan setiap poin dengan baris baru (Enter). Gunakan titik dua (:) untuk memisahkan judul tebal dan keterangannya.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar1_target">Target Penggunaan (Cocok untuk)</label></th>
                            <td><input type="text" name="pilar1_target" id="pilar1_target" class="large-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar1_target', 'Residensial, Penthouse, Kantor, Showroom & Cafe')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar1_btn_text">Teks Tombol Konsultasi</label></th>
                            <td><input type="text" name="pilar1_btn_text" id="pilar1_btn_text" class="regular-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar1_btn_text', 'Konsultasi Desain (WA) →')); ?>" /></td>
                        </tr>
                    </table>
                </div>

                <!-- PILAR 2: FITTING OUT -->
                <div class="card" style="max-width: 1000px; padding: 25px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 8px; border-left: 4px solid #cba85d;">
                    <h2 style="margin-top:0; color:#cba85d; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                        Pilar 2: Fitting Out &amp; Fabrikasi (Turnkey Contractor)
                    </h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="pilar2_badge">Badge / Tahap</label></th>
                            <td><input type="text" name="pilar2_badge" id="pilar2_badge" class="regular-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar2_badge', 'Fase 02 • Konstruksi & Fabrikasi')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar2_subtext">Sub-teks Kanan</label></th>
                            <td><input type="text" name="pilar2_subtext" id="pilar2_subtext" class="regular-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar2_subtext', 'Turnkey Contractor')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar2_title">Judul Layanan</label></th>
                            <td><input type="text" name="pilar2_title" id="pilar2_title" class="large-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar2_title', 'Turnkey Fitting Out & Millwork')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar2_tagline">Tagline / Spesialisasi</label></th>
                            <td><input type="text" name="pilar2_tagline" id="pilar2_tagline" class="large-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar2_tagline', 'In-House Workshop • Sipil • MEP • Kaca & Kisi-Kisi')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar2_desc">Paragraf Penjelasan</label></th>
                            <td><textarea name="pilar2_desc" id="pilar2_desc" rows="4" class="large-text"><?php echo esc_textarea(gjs_get_interior_opt('pilar2_desc', 'Jembatan krusial antara gambar desain dan kenyataan fisik. Didukung oleh fasilitas bengkel workshop manufaktur mandiri milik GJS, kami memproduksi mebel built-in, partisi kaca tempered, dan wall panel secara presisi tinggi. Seluruh pengerjaan sipil dan instalasi lapangan diawasi harian oleh tim supervisor profesional.')); ?></textarea></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar2_points">Poin Keunggulan (1 per baris, format: Judul: Keterangan)</label></th>
                            <td>
                                <textarea name="pilar2_points" id="pilar2_points" rows="6" class="large-text"><?php 
                                    $default_pts2 = "In-House Custom Cabinetry: Fabrikasi kitchen set, walk-in closet, credenza, dan backdrop TV menggunakan multipleks grade A & hardware Blum/Hafele.\nArchitectural Glass & Partition: Pemasangan partisi kaca tempered, fluted glass, shower screen, dan cermin bronze presisi.\nAcoustic Wood & Fluted Panel: Pemasangan kisi-kisi kayu solid atau WPC bernilai estetika tinggi peredam gema ruangan.\nFull MEP & Lighting Setup: Instalasi kelistrikan aman, penataan titik saklar, lampu indirect ambient cove, dan ventilasi udara.\nDedicated Site Supervisor: Satu pengawas lapangan khusus untuk setiap proyek demi ketepatan jadwal kurva-S & kerapian hasil.";
                                    echo esc_textarea(gjs_get_interior_opt('pilar2_points', $default_pts2)); 
                                ?></textarea>
                                <p class="description">Pisahkan setiap poin dengan baris baru (Enter). Gunakan titik dua (:) untuk memisahkan judul tebal dan keterangannya.</p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar2_target">Target Penggunaan (Cocok untuk)</label></th>
                            <td><input type="text" name="pilar2_target" id="pilar2_target" class="large-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar2_target', 'Pemilik Rumah Baru, Renovasi Total, Fit-Out Kantor')); ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="pilar2_btn_text">Teks Tombol Konsultasi</label></th>
                            <td><input type="text" name="pilar2_btn_text" id="pilar2_btn_text" class="regular-text" value="<?php echo esc_attr(gjs_get_interior_opt('pilar2_btn_text', 'Konsultasi Fit-Out (WA) →')); ?>" /></td>
                        </tr>
                    </table>
                </div>

            <!-- TAB 2: HERO & KONTAK -->
            <?php elseif ($active_tab === 'hero') : ?>
                <div class="card" style="max-width: 900px; padding: 25px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 8px;">
                    <h2 style="margin-top:0; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Kontak WhatsApp</h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="wa_phone">Nomor WhatsApp Admin</label></th>
                            <td>
                                <input type="text" name="wa_phone" id="wa_phone" class="regular-text" 
                                       value="<?php echo esc_attr(gjs_get_interior_opt('wa_phone', '628111021088')); ?>" />
                                <p class="description">Gunakan format internasional tanpa spasi atau tanda plus (contoh: <code>628111021088</code>).</p>
                            </td>
                        </tr>
                    </table>

                    <h2 style="margin-top:30px; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Hero Section</h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><label for="hero_tag">Tagline / Badge Atas</label></th>
                            <td>
                                <input type="text" name="hero_tag" id="hero_tag" class="large-text" 
                                       value="<?php echo esc_attr(gjs_get_interior_opt('hero_tag', 'Solusi Interior Terpadu Satu Atap')); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="hero_title">Judul Utama Hero (H1)</label></th>
                            <td>
                                <input type="text" name="hero_title" id="hero_title" class="large-text" 
                                       value="<?php echo esc_attr(gjs_get_interior_opt('hero_title', 'Desain Interior & Fitting Out Berstandar Arsitektur Presisi')); ?>" />
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><label for="hero_desc">Deskripsi Hero</label></th>
                            <td>
                                <textarea name="hero_desc" id="hero_desc" rows="4" class="large-text"><?php echo esc_textarea(gjs_get_interior_opt('hero_desc', 'Wujudkan ruang tinggal residensial mewah dan properti komersial yang fungsional, bernilai estetika tinggi, serta awet jangka panjang. Griya Djaya Sentosa menghadirkan ekosistem terpadu: perancangan visual 3D fotorealistik yang dieksekusi langsung oleh bengkel workshop fabrikasi mandiri kami tanpa perantara.')); ?></textarea>
                            </td>
                        </tr>
                    </table>
                </div>

            <!-- TAB 3: TRUST BAR -->
            <?php elseif ($active_tab === 'trust') : ?>
                <div class="card" style="max-width: 900px; padding: 25px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 8px;">
                    <h2 style="margin-top:0; border-bottom: 1px solid #ddd; padding-bottom: 10px;">4 Poin Trust Bar (Bawah Hero)</h2>
                    <table class="form-table">
                        <?php for ($i = 1; $i <= 4; $i++) : ?>
                            <tr>
                                <th colspan="2" style="background:#f9f9f9; padding: 8px 12px; font-weight:700;">Item 0<?php echo $i; ?></th>
                            </tr>
                            <tr>
                                <th scope="row"><label for="trust<?php echo $i; ?>_num">Nomor Urut</label></th>
                                <td><input type="text" name="trust<?php echo $i; ?>_num" id="trust<?php echo $i; ?>_num" style="width:70px;" value="<?php echo esc_attr(gjs_get_interior_opt('trust'.$i.'_num', sprintf('%02d', $i))); ?>" /></td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="trust<?php echo $i; ?>_title">Judul Keunggulan</label></th>
                                <td>
                                    <?php 
                                    $default_titles = array(1 => 'Workshop Mandiri', 2 => '1 Penanggung Jawab', 3 => 'Zero Budget Blown', 4 => 'Garansi Purna Jual');
                                    ?>
                                    <input type="text" name="trust<?php echo $i; ?>_title" id="trust<?php echo $i; ?>_title" class="regular-text" value="<?php echo esc_attr(gjs_get_interior_opt('trust'.$i.'_title', $default_titles[$i])); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="trust<?php echo $i; ?>_desc">Penjelasan Ringkas</label></th>
                                <td>
                                    <?php 
                                    $default_descs = array(
                                        1 => 'Fabrikasi joinery kustom, kaca arsitektural, dan profil aluminium di bengkel sendiri tanpa oper pihak ketiga.',
                                        2 => 'Arsitek desain dan tim kontraktor lapangan terkoordinasi erat, meniadakan selisih ukuran dan lempar tanggung jawab.',
                                        3 => 'Rencana Anggaran Biaya (RAB) terperinci dan mengikat sejak awal, disesuaikan dengan plafon budget Anda.',
                                        4 => 'Jaminan kualitas pengerjaan, kekokohan struktur mebel, kehalusan finishing, serta dukungan purna jual terpercaya.'
                                    );
                                    ?>
                                    <textarea name="trust<?php echo $i; ?>_desc" id="trust<?php echo $i; ?>_desc" rows="2" class="large-text"><?php echo esc_textarea(gjs_get_interior_opt('trust'.$i.'_desc', $default_descs[$i])); ?></textarea>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>

            <!-- TAB 4: FAQ -->
            <?php elseif ($active_tab === 'faq') : ?>
                <div class="card" style="max-width: 900px; padding: 25px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 8px;">
                    <h2 style="margin-top:0; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Daftar Pertanyaan &amp; Jawaban (FAQ)</h2>
                    <table class="form-table">
                        <?php 
                        $default_faqs = array(
                            1 => array(
                                'q' => 'Apakah saya bisa memakai jasa Interior Design saja tanpa fitting out (atau sebaliknya)?',
                                'a' => 'Tentu bisa. Anda dapat memesan paket desain saja lengkap dengan 3D render dan gambar kerja DED untuk dieksekusi kontraktor Anda. Sebaliknya, bila Anda sudah memiliki gambar kerja sendiri, workshop GJS siap mengeksekusi fitting out & fabrikasi mebel secara profesional.'
                            ),
                            2 => array(
                                'q' => 'Apakah biaya RAB bisa disesuaikan dengan plafon budget saya?',
                                'a' => 'Ya, sangat bisa. Pada tahap awal konsultasi dan moodboard, kami mengumpulkan preferensi kebutuhan serta batas anggaran Anda. Arsitek kami kemudian merekayasa spesifikasi material dan alternatif finishing yang tepat agar ekspektasi desain tercapai tanpa melebihi plafon biaya.'
                            ),
                            3 => array(
                                'q' => 'Berapa lama rata-rata durasi pengerjaan interior residensial?',
                                'a' => 'Durasi bergantung pada luasan dan lingkup pekerjaan. Fase desain 3D & DED umumnya memakan waktu 2–4 minggu. Fase fitting out & fabrikasi workshop berkisar 4–8 minggu untuk apartemen/rumah tinggal standar, dengan jadwal tahapan (kurva-S) yang dilaporkan rutin setiap minggu.'
                            ),
                            4 => array(
                                'q' => 'Apakah Griya Djaya Sentosa menyediakan survei lokasi gratis?',
                                'a' => 'Ya, kami menyediakan konsultasi awal dan penjadwalan survey lokasi untuk wilayah Jabodetabek. Tim kami akan melakukan pengukuran dimensi riil, inspeksi titik instalasi MEP, dan diskusi langsung di lokasi proyek Anda.'
                            ),
                            5 => array(
                                'q' => 'Apakah pekerjaan interior dan mebel custom GJS bergaransi?',
                                'a' => 'Setiap proyek interior kami dilengkapi jaminan garansi pemeliharaan resmi hingga 1 tahun untuk kekokohan struktur cabinetry, aksesoris fitting (engsel/rel laci), serta finishing material terpasang.'
                            ),
                        );
                        ?>
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <tr>
                                <th colspan="2" style="background:#f4f6f8; padding: 8px 12px; font-weight:700;">FAQ #<?php echo $i; ?></th>
                            </tr>
                            <tr>
                                <th scope="row"><label for="faq<?php echo $i; ?>_q">Pertanyaan #<?php echo $i; ?></label></th>
                                <td>
                                    <input type="text" name="faq<?php echo $i; ?>_q" id="faq<?php echo $i; ?>_q" class="large-text" 
                                           value="<?php echo esc_attr(gjs_get_interior_opt('faq'.$i.'_q', $default_faqs[$i]['q'])); ?>" />
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><label for="faq<?php echo $i; ?>_a">Jawaban #<?php echo $i; ?></label></th>
                                <td>
                                    <textarea name="faq<?php echo $i; ?>_a" id="faq<?php echo $i; ?>_a" rows="3" class="large-text"><?php echo esc_textarea(gjs_get_interior_opt('faq'.$i.'_a', $default_faqs[$i]['a'])); ?></textarea>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    </table>
                </div>

            <!-- TAB 5: INFO KATALOG & CPT -->
            <?php elseif ($active_tab === 'produk') : ?>
                <div class="card" style="max-width: 900px; padding: 25px; margin-bottom: 25px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-radius: 8px;">
                    <h2 style="margin-top:0; border-bottom: 1px solid #ddd; padding-bottom: 10px;">Katalog Produk Dinamis (CPT gjs_produk)</h2>
                    <p style="font-size:15px; line-height:1.6;">
                        Halaman Interior saat ini mendukung <strong>dua mode dinamis</strong> sekaligus:
                    </p>
                    <ol style="font-size:14px; line-height:1.8; margin-left:20px;">
                        <li>
                            <strong>Mode CPT Otomatis:</strong> Setiap kali Anda menambahkan produk baru di 
                            <a href="<?php echo esc_url(admin_url('post-new.php?post_type=gjs_produk')); ?>" target="_blank">Produk &gt; Tambah Baru</a> 
                            dan memilih Kategori Produk <code>Interior</code> (atau slug <code>interior</code>), produk tersebut akan otomatis muncul di grid katalog halaman interior!
                        </li>
                        <li>
                            <strong>Mode Fallback Cerdas:</strong> Jika Anda belum menambahkan item di menu Produk atau belum ada kategori Interior, sistem secara otomatis menampilkan 6 produk unggulan curated (Partisi Kaca, Wall Panel Kisi-Kisi, Custom Wardrobe, Kitchen Set, Pintu Sliding Kaca, dan Drop Ceiling) agar halaman Anda selalu tampak lengkap dan profesional.
                        </li>
                        <li>
                            <strong>Single Product View:</strong> Pengunjung dapat mengklik kartu produk untuk membuka halaman detail tunggal (<code>?view=single&item=...</code>) lengkap dengan lightbox gambar, spesifikasi, dan tombol konsultasi WhatsApp!
                        </li>
                    </ol>
                    <div style="margin-top:20px;">
                        <a href="<?php echo esc_url(admin_url('edit.php?post_type=gjs_produk')); ?>" class="button button-secondary">
                            Kelola Semua Produk
                        </a>
                        <a href="<?php echo esc_url(admin_url('edit-tags.php?taxonomy=kategori_produk&post_type=gjs_produk')); ?>" class="button button-secondary" style="margin-left:8px;">
                            Kelola Kategori Produk
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <p class="submit" style="margin-top: 25px;">
                <input type="submit" name="submit" id="submit" class="button button-primary button-large" value="Simpan Semua Pengaturan" style="padding: 4px 24px; font-size:15px; height:auto;">
                <a href="<?php echo esc_url(home_url('/product/interior/')); ?>" target="_blank" class="button button-secondary button-large" style="margin-left: 10px; padding: 4px 18px; font-size:15px; height:auto;">
                    Lihat Halaman Interior &nearr;
                </a>
            </p>
        </form>
    </div>
    <?php
}
