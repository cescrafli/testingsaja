
        <!--  homepage content end  -->
        <style>
.footer-new {
    background-color: #041e3a;
    background: linear-gradient(180deg, #041e3a 0%, #03162b 100%);
    padding: 56px 0 0;
    color: #e2e8f0;
    font-family: 'Outfit', sans-serif;
    font-size: 14px;
    width: 100%;
    box-sizing: border-box;
    position: relative;
    border-top: 1px solid rgba(203, 168, 93, 0.25);
    box-shadow: 0 -12px 32px rgba(0, 0, 0, 0.2);
    margin-top: auto !important;
    margin-bottom: 0 !important;
}
.footer-new::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, rgba(203,168,93,0) 0%, rgba(203,168,93,0.85) 50%, rgba(203,168,93,0) 100%);
    pointer-events: none;
}
.footer-new-container {
    max-width: 1240px;
    margin: 0 auto;
    display: flex;
    flex-wrap: wrap;
    gap: 32px 24px;
    padding: 0 24px 36px;
    justify-content: space-between;
    box-sizing: border-box;
}
.footer-new-col {
    flex: 1;
    min-width: 135px;
    box-sizing: border-box;
    transition: transform 0.25s ease;
}
.footer-new-title {
    font-size: 15px;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 22px;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    padding-bottom: 8px;
    display: inline-block;
}
.footer-new-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 28px;
    height: 2px;
    background: #cba85d;
    border-radius: 2px;
    transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.footer-new-col:hover .footer-new-title::after {
    width: 44px;
}
.footer-new-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-new-list li {
    margin-bottom: 12px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    line-height: 1.55;
}
.footer-new-list li i, .footer-new-list li svg {
    color: #cba85d;
    margin-top: 3px;
    flex-shrink: 0;
    transition: transform 0.25s ease, color 0.25s ease;
}
.footer-new-list a {
    color: #cbd5e1;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}
.footer-new-list a:hover {
    color: #cba85d;
    transform: translateX(5px);
}
.footer-new-list li:hover i,
.footer-new-list li:hover svg {
    transform: scale(1.18);
    color: #e0be6c;
}
.footer-brand-logo {
    display: inline-block;
    margin-bottom: 15px;
    text-decoration: none;
    transition: opacity 0.25s ease;
}
.footer-brand-logo:hover {
    opacity: 0.92;
}
.footer-brand-logo img {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}
.footer-brand-logo:hover img {
    transform: scale(1.08) rotate(-2deg);
}
.footer-social-link {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    color: #cbd5e1;
    text-decoration: none;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}
.footer-social-link:hover {
    color: #cba85d;
    transform: translateX(4px);
}
.footer-social-icon {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: rgba(203, 168, 93, 0.12);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid rgba(203, 168, 93, 0.25);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    flex-shrink: 0;
}
.footer-social-link:hover .footer-social-icon {
    background: #cba85d;
    border-color: #cba85d;
    transform: scale(1.12);
    box-shadow: 0 4px 10px rgba(203, 168, 93, 0.35);
}
.footer-social-link:hover .footer-social-icon svg,
.footer-social-link:hover .footer-social-icon i {
    color: #041e3a !important;
    fill: #041e3a !important;
}
.footer-seo-box {
    max-width: 1240px;
    margin: 0 auto;
    padding: 24px 24px;
    border-top: 1px solid rgba(203, 168, 93, 0.18);
    font-size: 12px;
    line-height: 1.8;
    color: #94a3b8;
    box-sizing: border-box;
}
.footer-seo-box a {
    color: #cbd5e1;
    text-decoration: none;
    transition: color 0.2s ease;
}
.footer-seo-box a:hover {
    color: #cba85d;
    text-decoration: underline;
}
.footer-new-bottom {
    background-color: #021224;
    padding: 20px 24px;
    text-align: center;
    font-size: 13px;
    color: #94a3b8;
    border-top: 1px solid rgba(255, 255, 255, 0.06);
    margin-bottom: 0 !important;
}
.footer-new-bottom a {
    color: #ffffff;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.25s ease, text-shadow 0.25s ease;
}
.footer-new-bottom a:hover {
    color: #cba85d;
    text-shadow: 0 0 8px rgba(203, 168, 93, 0.4);
}

/* Tablet (iPad portrait & small laptop) */
@media(min-width: 768px) and (max-width: 991px) {
    .footer-new-container {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 36px 28px !important;
    }
    .footer-new-col {
        max-width: 100% !important;
    }
}

/* Mobile */
@media(max-width: 767px) {
    .footer-new { padding-top: 40px; }
    .footer-new-container {
        flex-direction: column;
        gap: 28px;
        padding: 0 20px 28px;
    }
    .footer-new-col {
        max-width: 100% !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        padding-bottom: 20px;
    }
    .footer-new-col:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
}

html {
    height: 100%;
    background-color: #ffffff !important;
    margin: 0 !important;
    padding: 0 !important;
}
body,
body.page,
body.page-template,
body.wp-singular,
body.home {
    display: flex !important;
    flex-direction: column !important;
    min-height: 100vh !important;
    margin: 0 !important;
    padding: 0 !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    background-color: #ffffff !important;
}
main, .projects, .site-main, .company-profile, .about-main-wrapper, .team, .certificates, .workshop-facilities, .single-main-wrapper, .blog-main-wrapper, .blog-page-main, .blog-content-section, .gjs-interior-wrapper, .prod-page, .prod-sub-main, .prod-sub-container, .blueprint-container, .error, .faq-cta-section {
    flex: 1 0 auto;
    background-color: #ffffff;
    margin-top: 0 !important;
}
#scrollTrigger {
    position: fixed !important;
    right: 25px !important;
    bottom: 25px !important;
    z-index: 9998 !important;
    margin: 0 !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 44px !important;
    height: 44px !important;
    border-radius: 8px !important;
    background: #cba85d !important;
    color: #041e3a !important;
    border: none !important;
    cursor: pointer !important;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25) !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}
#scrollTrigger:hover {
    background: #e0be6c !important;
    transform: translateY(-4px) !important;
    box-shadow: 0 8px 20px rgba(203, 168, 93, 0.4) !important;
}
#scrollTrigger .icon {
    font-size: 14px !important;
    color: #041e3a !important;
    transform: rotate(-90deg) !important;
    display: inline-block !important;
}
</style>

<footer class="footer-new">
    <div class="footer-new-container">
        <!-- Logo / Intro -->
        <div class="footer-new-col" style="max-width: 220px;">
            <a href="<?php echo home_url('/'); ?>" class="footer-brand-logo">
                <img src="<?php echo get_template_directory_uri(); ?>/svg/logo.svg" alt="GJS Logo" style="width: 50px;">
                <div style="font-size: 22px; font-weight: 800; color: #fff; margin-top: 10px;">Griya Djaya <span style="color: #cba85d;">Sentosa</span></div>
            </a>
            <p style="margin-top: 15px; line-height: 1.6; color: #cbd5e1;">Lebih dari sekadar fabrikasi. Kami mewujudkan estetika dan fungsionalitas bangunan sejak 2011.</p>
        </div>
        
        <!-- Locations -->
        <div class="footer-new-col">
            <h4 class="footer-new-title">Lokasi Kami</h4>
            <ul class="footer-new-list">
                <li>
                    <div>
                        <strong style="color:#fff; font-weight: 700;">Head Office & Work Shop I</strong><br>
                        <i class="icon-location" style="display:inline-block; margin-right:5px; color:#cba85d;"></i>Jl. Raya Transyogi No 8 Cileungsi, Bogor, Jawa Barat Indonesia
                    </div>
                </li>
                <li style="margin-top: 15px;">
                    <div>
                        <strong style="color:#fff; font-weight: 700;">Work Shop II</strong><br>
                        <i class="icon-location" style="display:inline-block; margin-right:5px; color:#cba85d;"></i>Jl. Raya Jati Asih No 3, RT 06 RW 05, Jati Asih, Bekasi
                    </div>
                </li>
                <li style="margin-top: 15px;">
                    <div>
                        <strong style="color:#fff; font-weight: 700;">Material Warehouse</strong><br>
                        <i class="icon-location" style="display:inline-block; margin-right:5px; color:#cba85d;"></i>Jl. Raya Kapuk Cengkareng Gudang No 10, Cengkareng, Jakarta Barat
                    </div>
                </li>
            </ul>
        </div>
        
        <!-- Contact -->
        <div class="footer-new-col">
            <h4 class="footer-new-title">Informasi Kontak</h4>
            <ul class="footer-new-list">
                <li><i class="icon-whatsapp"></i> <a href="https://wa.me/628111021088" target="_blank">+6281-1102-1088</a></li>
                <li><i class="icon-call"></i> <a href="tel:+622180476151">+6221 - 8047 6151</a></li>
                <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> <a href="mailto:info@griyadjayasentosa.id">info@griyadjayasentosa.id</a></li>
                <li><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> <a href="mailto:griyadjayaupvc@gmail.com">griyadjayaupvc@gmail.com</a></li>
                <li style="margin-top: 6px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0; vertical-align:middle; margin-right:4px;"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg> <span style="color:#cbd5e1; font-size: 13px;">Senin &ndash; Sabtu, 08:00 &ndash; 17:00 WIB</span></li>
            </ul>
        </div>
        
        <!-- Social Media -->
        <div class="footer-new-col" style="max-width: 140px;">
            <h4 class="footer-new-title">Media Sosial</h4>
            <ul class="footer-new-list">
                <li>
                    <a href="https://www.instagram.com/griyajayaupvc/" target="_blank" class="footer-social-link">
                        <span class="footer-social-icon"><i class="icon-instagram"></i></span>
                        <span>Instagram</span>
                    </a>
                </li>
                <li>
                    <a href="https://www.tiktok.com/@griyadjayaupvc" target="_blank" class="footer-social-link">
                        <span class="footer-social-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="13" height="13" fill="currentColor"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></span>
                        <span>TikTok</span>
                    </a>
                </li>
                <li>
                    <a href="https://www.youtube.com/@GRIYAJAYAUPVC" target="_blank" class="footer-social-link">
                        <span class="footer-social-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="13" height="13" fill="currentColor"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg></span>
                        <span>YouTube</span>
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Quick Links -->
        <div class="footer-new-col" style="max-width: 120px;">
            <h4 class="footer-new-title">Tautan Cepat</h4>
            <ul class="footer-new-list">
                <li><a href="<?php echo home_url('/about/'); ?>">Tentang Kami</a></li>
                <li><a href="<?php echo home_url('/product/'); ?>">Produk Kami</a></li>
                <li><a href="<?php echo home_url('/projects/'); ?>">Proyek Kami</a></li>
                <li><a href="<?php echo home_url('/blog/'); ?>">Blog</a></li>
                <li><a href="<?php echo esc_url( home_url('/category/artikel/') ); ?>">Artikel</a></li>
                <li><a href="<?php echo home_url('/warranty/'); ?>">Garansi</a></li>
                <li><a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">FAQ Layanan</a></li>
                <li><a href="<?php echo home_url('/contacts/'); ?>">Hubungi Kami</a></li>
            </ul>
        </div>
        
        <!-- Products -->
        <div class="footer-new-col" style="max-width: 130px;">
            <h4 class="footer-new-title">Produk</h4>
            <ul class="footer-new-list">
                <li><a href="<?php echo home_url('/product/fasad/'); ?>">Fasad</a></li>
                <li><a href="<?php echo home_url('/product/interior/'); ?>">Interior</a></li>
                <li><a href="<?php echo home_url('/product/upvc/'); ?>">UPVC</a></li>
                <li><a href="<?php echo home_url('/product/alumunium/'); ?>">Alumunium</a></li>
                <li><a href="<?php echo home_url('/product/besi-stainless/'); ?>">Besi & Stainless</a></li>
                <li><a href="<?php echo home_url('/product/kaca/'); ?>">Kaca</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Global SEO Internal Link Directory for 100% Project & Blog Indexing -->
    <?php
    $cached_footer_seo_links = get_transient( 'gjs_footer_seo_links_html_v1' );
    if ( false === $cached_footer_seo_links ) {
        ob_start();
        ?>
        <div class="footer-seo-box">
            <div style="margin-bottom: 12px;">
                <strong style="color: #cba85d; text-transform: uppercase; letter-spacing: 0.5px; margin-right: 8px;">Portofolio Proyek:</strong>
                <?php
                $footer_projects = get_posts(array(
                    'post_type'      => 'project',
                    'posts_per_page' => 30,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                ));
                $p_links = array();
                foreach ($footer_projects as $fp) {
                    $p_links[] = '<a href="' . esc_url(get_permalink($fp->ID)) . '">' . esc_html($fp->post_title) . '</a>';
                }
                echo implode(' &bull; ', $p_links);
                ?>
            </div>
            <div>
                <strong style="color: #cba85d; text-transform: uppercase; letter-spacing: 0.5px; margin-right: 8px;">Artikel &amp; Panduan:</strong>
                <?php
                $footer_posts = get_posts(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 20,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC'
                ));
                $b_links = array();
                foreach ($footer_posts as $fb) {
                    $b_links[] = '<a href="' . esc_url(get_permalink($fb->ID)) . '">' . esc_html($fb->post_title) . '</a>';
                }
                echo implode(' &bull; ', $b_links);
                ?>
            </div>
        </div>
        <?php
        $cached_footer_seo_links = ob_get_clean();
        set_transient( 'gjs_footer_seo_links_html_v1', $cached_footer_seo_links, 12 * HOUR_IN_SECONDS );
    }
    echo $cached_footer_seo_links;
    ?>

    <div class="footer-new-bottom">
        Copyright 2026 &copy; All Rights Reserved. Developed by <a href="https://website-mrmp.vercel.app/" target="_blank" rel="noopener noreferrer">cescrafli</a>
    </div>
</footer>
        <button id="scrollTrigger" type="button">
            <i class="icon icon-arrow_right"></i>
        </button>
        <script src="<?php echo get_template_directory_uri(); ?>/js/common.min.js?v=3.2.3"></script>
                        <?php
                global $custom_js; $script_name = isset($custom_js) && !empty($custom_js) ? $custom_js : '';
        if (is_front_page() || is_page_template('front-page.php')) { $script_name = 'index'; }
        elseif (is_page('about') || is_page_template('page-about.php')) { $script_name = 'about'; }
        elseif (is_page('services') || is_page_template('page-services.php')) { $script_name = 'services'; }
        elseif (is_page('faq') || is_page_template('page-faq.php')) { $script_name = 'faq'; }
        elseif (is_page('gallery-masonry') || is_page_template('page-gallery-masonry.php')) { $script_name = 'masonry'; }
        elseif (is_singular('project') || is_page_template('single-project.php')) { $script_name = 'singleproject'; }
        elseif (is_singular('service') || is_page_template('single-service.php')) { $script_name = 'singleservice'; }
        
        if ($script_name !== '') {
        ?>
        <script src="<?php echo get_template_directory_uri(); ?>/js/<?php echo $script_name; ?>.min.js?v=3.2.3"></script>
        <?php } ?>
        <?php wp_footer(); ?>
<video class="video_content" style="display:none;"></video><a class="video_btn" style="display:none;" href="#"></a>
<!-- Floating WhatsApp Button -->
<a href="https://api.whatsapp.com/send/?phone=628111021088&text=Hi%2C+Saya+tertarik+dengan+produk+yang+ditawarkan+Griya+Djaya+Sentosa&type=phone_number&app_absent=0" 
   target="_blank" 
   class="wa-float-btn">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="currentColor">
        <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157.1zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z"/>
    </svg>
</a>
<style>
@keyframes wa-vibrate {
    0% { transform: scale(1); }
    5% { transform: scale(1.1) rotate(10deg); }
    10% { transform: scale(1.1) rotate(-10deg); }
    15% { transform: scale(1.1) rotate(10deg); }
    20% { transform: scale(1.1) rotate(-10deg); }
    25% { transform: scale(1); }
    100% { transform: scale(1); }
}
.wa-float-btn {
    animation: wa-vibrate 3s infinite;
    position: fixed;
    bottom: 120px; 
    right: 30px;
    background-color: #25d366;
    color: #FFF;
    border-radius: 50%;
    text-align: center;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.25);
    z-index: 9999;
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.3s ease;
}
.wa-float-btn:hover {
    animation-play-state: paused;
    transform: scale(1.1);
    color: #FFF;
}
.wa-float-btn svg {
    width: 35px;
    height: 35px;
    color: #fff;
}
@media (max-width: 768px) {
    .wa-float-btn {
        width: 50px;
        height: 50px;
        bottom: 100px;
        right: 20px;
    }
    .wa-float-btn svg {
        width: 30px;
        height: 30px;
    }
}
</style>
</body>
</html>




















