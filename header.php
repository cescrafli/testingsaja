<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Favicon dipindahkan ke pengaturan bawaan WordPress (Site Icon) agar dibaca Google -->

        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
                <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        
        <!-- SEO & Open Graph Meta Tags -->
        <?php $gjs_is_interior = (is_page('interior') || is_page_template('page-product-interior.php') || (isset($_SERVER['REQUEST_URI']) && preg_match('#/(product/)?interior/?(\?|$)#', $_SERVER['REQUEST_URI']))); ?>
        <?php if ($gjs_is_interior) : ?>
        <!-- description managed via wp_head() -->
        <link rel="canonical" href="<?php echo esc_url(home_url('/product/interior/')); ?>" />
        <?php else : ?>
        <!-- title handled via wp_head() -->
        <!-- description managed via wp_head() -->
        <?php endif; ?>
        
        <meta property="og:site_name" content="Griya Djaya Sentosa" />
        <meta property="og:title" content="Griya Djaya Sentosa | Kontraktor Kusen, Fasad, Besi & Kaca" />
        <meta property="og:description" content="<?php echo esc_attr(function_exists('gjs_get_fallback_meta_description') ? gjs_get_fallback_meta_description() : 'Satu Mitra Fabrikasi untuk Seluruh Kebutuhan Kusen Aluminium, UPVC, Fasad, Besi & Kaca Proyek Anda.'); ?>" />
        <meta property="og:image" content="https://griyadjayasentosa.id/wp-content/uploads/2026/08/Screenshot-2026-08-06-135320.png" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta property="og:url" content="https://griyadjayasentosa.id/" />
        <meta property="og:type" content="website" />
        <meta name="twitter:card" content="summary_large_image" />
        
        <link rel="stylesheet preload" as="style" href="<?php echo get_template_directory_uri(); ?>/css/preload2.min.css" />
        <link rel="stylesheet preload" as="style" href="<?php echo get_template_directory_uri(); ?>/css/icomoon.css?v=3" />
        <link rel="stylesheet preload" as="style" href="<?php echo get_template_directory_uri(); ?>/css/libs.min.css?v=3" />

                        <?php
                global $custom_css; $css_name = isset($custom_css) && !empty($custom_css) ? $custom_css : '';
        if (is_front_page() || is_page_template('front-page.php')) { $css_name = 'index'; }
        elseif (is_404()) { $css_name = 'error'; }
        elseif (is_page('about') || is_page_template('page-about.php')) { $css_name = 'about'; }
        elseif (is_page('product') || is_page('interior') || is_page_template('page-product.php') || is_page_template('page-product-interior.php') || is_page_template('page-product-upvc.php') || is_page_template('page-product-kaca.php') || is_page_template('page-product-besi.php') || is_page_template('page-product-alumunium.php') || is_page_template('page-product-fasad.php')) { $css_name = 'services'; }
        elseif (is_page('faq') || is_page_template('page-faq.php')) { $css_name = 'faq'; }
        elseif (is_page('warranty') || is_page_template('page-warranty.php')) { $css_name = 'faq'; /* using faq css temporarily */ }
        elseif (is_page('gallery-masonry') || is_page_template('page-gallery-masonry.php')) { $css_name = 'gallery-masonry'; }
        elseif (is_page('gallery-grid') || is_page_template('page-gallery-grid.php')) { $css_name = 'gallery-grid'; }
        elseif (is_page('blog') || is_page_template('page-blog.php') || is_home() || is_archive()) { $css_name = 'blog'; }
        elseif (is_page(array('projects', 'project')) || is_page_template('page-projects.php')) { $css_name = 'projects'; }
        elseif (is_page('contacts') || is_page_template('page-contacts.php')) { $css_name = 'contacts'; }
        elseif (is_singular('project') || is_page_template('single-project.php')) { $css_name = 'single-project'; }
        elseif (is_singular('service') || is_page_template('single-service.php')) { $css_name = 'single-service'; }
        elseif (is_single()) { $css_name = 'single-post'; }
        
        if ($css_name !== '') {
        ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/<?php echo $css_name; ?>.min.css?v=3" />
        <?php } ?>
                <style>
              /* DYNAMIC FLUID LAYOUT */
              .brand { font-size: clamp(20px, 2.5vw, 30px) !important; gap: clamp(8px, 1vw, 15px) !important; white-space: nowrap; }
              .brand_logo { width: clamp(35px, 4vw, 55px) !important; height: auto !important; }
              
              @media screen and (min-width: 992px) {
                  .header_nav-list { gap: clamp(10px, 2vw, 40px) !important; }
                  .nav-item { font-size: clamp(12px, 1vw, 14px) !important; }
              }
              
              @media screen and (max-width: 767.98px) {
                  .brand_logo { width: 40px !important; }
                  .brand { font-size: 22px !important; gap: 10px !important; }
                  
                  /* GLOBAL MOBILE ANTI-CRAMP / GA SUMPEK */
                  body { overflow-x: hidden; }
                  .container { padding-left: 24px !important; padding-right: 24px !important; }
                  section, .section { padding-top: 50px !important; padding-bottom: 50px !important; padding-left: 24px !important; padding-right: 24px !important; }
                  p { line-height: 1.7 !important; margin-bottom: 20px !important; }
                  h1, h2, h3 { line-height: 1.4 !important; margin-bottom: 15px !important; }
                  img { max-width: 100%; height: auto; }
                  .row { margin-left: -12px !important; margin-right: -12px !important; }
                  .col, [class*="col-"] { padding-left: 12px !important; padding-right: 12px !important; }
              }
</style>
        <?php wp_head(); ?>

        <style>
            /* Product Dropdown Styles */
            .dropdown-custom { position: relative; }
            .dropdown-custom > a .nav-item_text { display: flex; align-items: center; gap: 6px; }
            .dropdown-chevron { font-size: 10px; transition: transform 0.3s; margin-top: 2px; }
            .dropdown-menu-custom {
                position: absolute; top: 100%; left: -20px; background: #ffffff; min-width: 200px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.08); opacity: 0; visibility: hidden;
                transform: translateY(15px); transition: all 0.3s ease; padding: 10px 0;
                list-style: none; margin: 0; border-radius: 4px; z-index: 9999;
            }
            .dropdown-custom:hover .dropdown-menu-custom { opacity: 1; visibility: visible; transform: translateY(0); }
            .dropdown-custom:hover .dropdown-chevron { transform: rotate(180deg); }
            .dropdown-menu-custom li { margin: 0; padding: 0; }
            .dropdown-menu-custom li a {
                display: block; padding: 12px 25px; color: #111111 !important; font-size: 14px;
                font-weight: 500; text-decoration: none; transition: color 0.2s, background 0.2s;
                text-transform: uppercase; letter-spacing: 0.5px;
            }
            .dropdown-menu-custom li a:hover { color: #eab308 !important; background: #fcfcfc; }
            
            @media screen and (max-width: 991.98px) {
                .dropdown-menu-custom {
                    position: static; opacity: 1; visibility: visible; transform: none;
                    box-shadow: none; padding: 5px 0 15px 20px; background: transparent; display: none;
                }
                .dropdown-custom:hover .dropdown-menu-custom, .dropdown-custom:active .dropdown-menu-custom, .dropdown-custom.mobile-open .dropdown-menu-custom { display: block; }
                .dropdown-custom.mobile-open .dropdown-chevron { transform: rotate(180deg); }
                .dropdown-menu-custom li a { color: #ffffff !important; padding: 8px 15px; font-size: 13px; }
            }
        
            @media screen and (max-width: 991.98px) {
                .header_nav-list {
                    background-color: rgba(4, 30, 58, 0.98); /* Almost solid dark blue */
                    padding: 15px 20px 20px !important;
                    border-radius: 8px;
                    margin-top: 10px;
                    box-shadow: 0 15px 30px rgba(0,0,0,0.5);
                }
            }

            @media screen and (max-width: 991.98px) {
                .header_trigger {
                    position: relative;
                    z-index: 999999 !important;
                }
            }
</style>
</head>
    <body>
        <?php 
        $data_page = ($css_name === "index") ? "home" : $css_name; 
        if (is_page('warranty') || is_page_template('page-warranty.php')) {
            $data_page = 'warranty';
        }
        if (is_page('interior') || is_page_template('page-product-interior.php')) {
            $data_page = 'services';
        }
        ?>
        <header class="header" data-page="<?php echo $data_page; ?>" data-page-parent="<?php echo $data_page; ?>">
            <div class="container d-flex">
                <a class="brand" href="<?php echo home_url('/'); ?>">
                    <img class="brand_logo" src="<?php echo get_template_directory_uri(); ?>/svg/logo.svg" alt="Griya Djaya Sentosa" />
                    <span class="brand_name"> Griya Djaya <span class="highlight">Sentosa</span> </span>
                </a>
                                <nav class="header_nav collapse" id="headerMenu">
                    <ul class="header_nav-list">
                        <li class="header_nav-list_item">
                            <a class="nav-item nav-link" href="<?php echo home_url('/'); ?>" data-page="home" data-single="true">
                                <span class="nav-item_text">Beranda</span>
                            </a>
                        </li>
                        <li class="header_nav-list_item">
                            <a class="nav-item nav-link" href="<?php echo home_url('/about/'); ?>" data-page="about" data-single="true">
                                <span class="nav-item_text">Tentang Kami</span>
                            </a>
                        </li>
                        <li class="header_nav-list_item dropdown-custom">
                            <a class="nav-item nav-link" href="<?php echo home_url('/product/'); ?>" data-page="services" data-single="true" onclick="if(window.innerWidth <= 991 && !this.parentElement.classList.contains('mobile-open')){ event.preventDefault(); this.parentElement.classList.add('mobile-open'); }">
                                <span class="nav-item_text">Produk <svg class="dropdown-chevron" width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1L5 5L9 1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </a>
                            <ul class="dropdown-menu-custom">                                <li><a href="<?php echo home_url('/product/fasad/'); ?>">Fasad</a></li>
                                <li><a href="<?php echo home_url('/product/interior/'); ?>">Interior</a></li>
                                <li><a href="<?php echo home_url('/product/upvc/'); ?>">UPVC</a></li>
                                <li><a href="<?php echo home_url('/product/alumunium/'); ?>">Alumunium</a></li>
                                <li><a href="<?php echo home_url('/product/kaca/'); ?>">Kaca</a></li>
                                <li><a href="<?php echo home_url('/product/besi-stainless/'); ?>">Besi & Stainless</a></li>
                            </ul>
                        </li>
                        <li class="header_nav-list_item">
                            <a class="nav-item nav-link" href="<?php echo home_url('/projects/'); ?>" data-page="projects" data-single="true">
                                <span class="nav-item_text">Proyek</span>
                            </a>
                        </li>
                        <li class="header_nav-list_item">
                            <a class="nav-item nav-link" href="<?php echo home_url('/blog/'); ?>" data-page="blog" data-single="true">
                                <span class="nav-item_text">Blog</span>
                            </a>
                        </li>
                        <li class="header_nav-list_item">
                            <a class="nav-item nav-link" href="<?php echo home_url('/warranty/'); ?>" data-page="warranty" data-single="true">
                                <span class="nav-item_text">Garansi</span>
                            </a>
                        </li>
                        
                        
                        <li class="header_nav-list_item">
                            <a class="nav-item nav-link" href="<?php echo home_url('/contacts/'); ?>" data-page="contacts" data-single="true">
                                <span class="nav-item_text">Kontak</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <button
                    class="header_trigger"
                    aria-controls="headerMenu"
                    aria-expanded="false"
                >
                    <span class="line line--short"></span>
                    <span class="line"></span>
                    <span class="line line--short"></span>
                    <span class="line"></span>
                </button>
            </div>
        </header>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const trigger = document.querySelector('.header_trigger');
    const menu = document.getElementById('headerMenu');
    
    if (trigger && menu) {
        // Setup initial state if not already set
        if (trigger.getAttribute('aria-expanded') !== 'true') {
            menu.style.display = 'none';
        }
        
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isOpen = trigger.getAttribute('aria-expanded') === 'true';
            
            if (isOpen) {
                // Animate Close (Naik)
                trigger.setAttribute('aria-expanded', 'false');
                menu.style.height = menu.scrollHeight + 'px';
                menu.style.transition = 'height 0.3s ease-out';
                menu.style.overflow = 'hidden';
                
                // trigger reflow
                menu.offsetHeight; 
                
                menu.style.height = '0px';
                
                setTimeout(() => {
                    
                    menu.style.display = 'none';
                    menu.style.height = '';
                    menu.style.transition = '';
                    menu.style.overflow = '';
                }, 300);
            } else {
                // Animate Open (Turun)
                trigger.setAttribute('aria-expanded', 'true');
                
                menu.style.display = 'block';
                
                const targetHeight = menu.scrollHeight;
                
                menu.style.height = '0px';
                menu.style.transition = 'height 0.3s ease-out';
                menu.style.overflow = 'hidden';
                
                // trigger reflow
                menu.offsetHeight;
                
                menu.style.height = targetHeight + 'px';
                
                setTimeout(() => {
                    menu.style.height = 'auto';
                    menu.style.transition = '';
                    menu.style.overflow = 'visible'; // important for dropdowns!
                }, 300);
            }
        });
    }
});
</script>

        <!--  homepage content start  -->


