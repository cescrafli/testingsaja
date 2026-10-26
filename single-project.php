<?php
/* Template Name: Single Project */
global $custom_css; $custom_css = 'single-project';
get_header();
?>
<style>
/* Solid Dark Blue Header for Single Project */
.header {
    background-color: #041e3a !important;
    position: fixed !important;
    top: 0 !important;
    width: 100% !important;
    z-index: 9999 !important;
    padding: 18px 0 !important;
}
body.admin-bar .header {
    top: 32px !important;
}
@media (max-width: 782px) {
    body.admin-bar .header {
        top: 46px !important;
    }
}
.about {
    padding-top: 180px !important;
}
body.admin-bar .about {
    padding-top: 220px !important;
}
@media (max-width: 991px) {
    .header {
        padding: 14px 0 !important;
    }
    .about {
        padding-top: 130px !important;
    }
    body.admin-bar .about {
        padding-top: 170px !important;
    }
}

/* Hero Featured Image Styling */
.about_article .media {
    position: relative !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    background: #0f172a !important;
    margin-bottom: 25px !important;
}
.about_article .media a.gjs-lightbox-hero-trigger {
    display: block !important;
    position: relative !important;
    width: 100% !important;
    height: 100% !important;
    cursor: pointer !important;
    text-decoration: none !important;
}
.about_article .media img {
    width: 100% !important;
    display: block !important;
    transition: transform 0.45s ease !important;
}
.about_article .media:hover img {
    transform: scale(1.025) !important;
}
.gjs-hero-zoom-badge {
    position: absolute;
    bottom: 16px;
    right: 16px;
    background: rgba(4, 30, 58, 0.88);
    backdrop-filter: blur(6px);
    -webkit-backdrop-filter: blur(6px);
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 30px;
    display: flex;
    align-items: center;
    gap: 8px;
    pointer-events: none;
    border: 1px solid rgba(203, 168, 93, 0.5);
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
    z-index: 3;
}
.about_article .media:hover .gjs-hero-zoom-badge {
    background: #041e3a;
    border-color: #cba85d;
    color: #cba85d;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.4);
}

/* Gallery Section & Grid Styling */
.project-gallery-section {
    padding: 60px 0 30px;
    background: #fbfbfb;
    border-top: 1px solid #f0f0f0;
}
.project-gallery-header {
    margin-bottom: 30px;
}
.presentation {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 15px !important;
    padding: 0 20px !important;
}
@media (max-width: 1199px) {
    .presentation {
        grid-template-columns: repeat(3, 1fr) !important;
    }
}
@media (max-width: 768px) {
    .presentation {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
        padding: 0 15px !important;
    }
}
@media (max-width: 480px) {
    .presentation {
        grid-template-columns: 1fr !important;
    }
}
.gallery_item {
    height: 320px !important;
    border-radius: 8px !important;
    overflow: hidden !important;
    background: #f0f0f0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
}
.gallery_item .media {
    display: block !important;
    width: 100% !important;
    height: 100% !important;
    position: relative !important;
    cursor: pointer !important;
}
.gallery_item .media img {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    transition: transform 0.4s ease;
}
.gallery_item:hover .media img {
    transform: scale(1.05);
}
.gallery_item .media .overlay {
    border-radius: 8px !important;
}

/* Related Posts Section Styling */
.related-projects-container {
    padding-top: 50px !important;
    padding-bottom: 70px !important;
}

/* =========================================================
   GRIYA DJAYA SENTOSA DEDICATED LIGHTBOX MODAL STYLES
   ========================================================= */
.gjs-lightbox {
    position: fixed !important;
    inset: 0 !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    z-index: 9999999 !important;
    display: none;
    align-items: center;
    justify-content: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.25s ease, visibility 0.25s ease;
    box-sizing: border-box !important;
}
.gjs-lightbox.gjs-active {
    opacity: 1 !important;
    visibility: visible !important;
}
.gjs-lightbox-backdrop {
    position: absolute !important;
    inset: 0 !important;
    top: 0 !important;
    left: 0 !important;
    width: 100% !important;
    height: 100% !important;
    background: rgba(4, 30, 58, 0.96) !important;
    backdrop-filter: blur(10px) !important;
    -webkit-backdrop-filter: blur(10px) !important;
    z-index: 1 !important;
}
.gjs-lightbox-shell {
    position: relative !important;
    z-index: 2 !important;
    width: 100% !important;
    height: 100% !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: space-between !important;
    align-items: center !important;
    padding: 16px 24px !important;
    box-sizing: border-box !important;
    user-select: none !important;
}
.gjs-lightbox-bar {
    width: 100% !important;
    max-width: 1300px !important;
    display: flex !important;
    align-items: center !important;
    box-sizing: border-box !important;
    z-index: 10 !important;
}
.gjs-lightbox-bar-top {
    justify-content: space-between !important;
    padding: 6px 0 12px !important;
}
.gjs-lightbox-meta {
    display: flex !important;
    align-items: center !important;
    gap: 12px !important;
}
.gjs-lightbox-badge {
    background: #cba85d !important;
    color: #041e3a !important;
    font-size: 11px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    padding: 4px 10px !important;
    border-radius: 4px !important;
}
.gjs-lightbox-counter {
    color: #e2e8f0 !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    letter-spacing: 0.5px !important;
    background: rgba(255, 255, 255, 0.08) !important;
    padding: 4px 12px !important;
    border-radius: 20px !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
}
.gjs-lightbox-close {
    background: rgba(255, 255, 255, 0.12) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    color: #ffffff !important;
    width: 44px !important;
    height: 44px !important;
    border-radius: 50% !important;
    font-size: 32px !important;
    line-height: 1 !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.2s ease !important;
    padding: 0 !important;
}
.gjs-lightbox-close:hover {
    background: #cba85d !important;
    color: #041e3a !important;
    border-color: #cba85d !important;
    transform: scale(1.08) !important;
}
.gjs-lightbox-stage {
    position: relative !important;
    flex: 1 !important;
    width: 100% !important;
    max-width: 1300px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: space-between !important;
    overflow: hidden !important;
    box-sizing: border-box !important;
}
.gjs-lightbox-nav {
    background: rgba(255, 255, 255, 0.12) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    color: #ffffff !important;
    width: 52px !important;
    height: 52px !important;
    border-radius: 50% !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.2s ease !important;
    z-index: 10 !important;
    flex-shrink: 0 !important;
    padding: 0 !important;
}
.gjs-lightbox-nav:hover {
    background: #cba85d !important;
    color: #041e3a !important;
    border-color: #cba85d !important;
    transform: scale(1.1) !important;
}
.gjs-lightbox-view {
    position: relative !important;
    flex: 1 !important;
    height: 100% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    padding: 0 15px !important;
    box-sizing: border-box !important;
}
/* Crucial: override global single-project.min.css img styles */
#gjsProjectLightbox img.gjs-lightbox-image {
    display: block !important;
    width: auto !important;
    max-width: 100% !important;
    height: auto !important;
    max-height: calc(100vh - 170px) !important;
    object-fit: contain !important;
    border-radius: 6px !important;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.55) !important;
    opacity: 0 !important;
    transform: scale(0.96) !important;
    transition: opacity 0.25s ease, transform 0.25s ease !important;
}
#gjsProjectLightbox img.gjs-lightbox-image.gjs-loaded {
    opacity: 1 !important;
    transform: scale(1) !important;
}
.gjs-lightbox-spinner {
    position: absolute !important;
    inset: 0 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    z-index: 5 !important;
}
.gjs-spin-ring {
    width: 48px !important;
    height: 48px !important;
    border: 4px solid rgba(255, 255, 255, 0.15) !important;
    border-top-color: #cba85d !important;
    border-radius: 50% !important;
    animation: gjsSpinAnim 0.75s linear infinite !important;
}
@keyframes gjsSpinAnim {
    to { transform: rotate(360deg); }
}
.gjs-lightbox-bar-bottom {
    justify-content: center !important;
    padding: 10px 0 6px !important;
}
.gjs-lightbox-caption {
    color: #f1f5f9 !important;
    font-size: 15px !important;
    font-weight: 500 !important;
    text-align: center !important;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.6) !important;
    max-width: 900px !important;
}

@media (max-width: 768px) {
    .gjs-lightbox-shell {
        padding: 12px !important;
    }
    .gjs-lightbox-nav {
        position: absolute !important;
        width: 42px !important;
        height: 42px !important;
        background: rgba(4, 30, 58, 0.75) !important;
    }
    .gjs-lightbox-prev {
        left: 8px !important;
    }
    .gjs-lightbox-next {
        right: 8px !important;
    }
    #gjsProjectLightbox img.gjs-lightbox-image {
        max-height: calc(100vh - 140px) !important;
    }
    .gjs-lightbox-caption {
        font-size: 13px !important;
        padding: 0 10px !important;
    }
}
</style>
<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();
    $pid      = get_the_ID();
    $client   = get_post_meta( $pid, '_project_client', true );
    $location = get_post_meta( $pid, '_project_location', true );
    $category = get_post_meta( $pid, '_project_category', true );
    $thumb    = get_the_post_thumbnail_url( $pid, 'large' ) ?: get_the_post_thumbnail_url( $pid, 'full' );
    if ( ! $thumb ) {
        $thumb = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
    } else {
        $thumb = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($thumb, 'large') : $thumb;
    }

    $gallery = array();
    for ( $i = 1; $i <= 24; $i++ ) {
        $g = get_post_meta( $pid, '_project_gallery_' . $i, true );
        if ( $g ) $gallery[] = $g;
    }

    // Jika Location berupa link Google Maps, jadikan tautan
    $loc_is_url = $location && preg_match( '#^https?://#i', $location );

    // Hapus hook otomatis Jetpack Related Posts agar tidak masuk di dalam the_content
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        remove_filter( 'the_content', array( $jprp, 'filter_add_target_to_dom' ), 40 );
    }
?>
<main>
    <div class="about section-nopb">
        <div class="container">
            <div class="about_content">
                <article class="about_article">
                    <nav aria-label="Breadcrumb" style="font-size:13px; color:#64748b; margin-bottom:14px;">
                        <a href="<?php echo esc_url( home_url('/') ); ?>" style="color:#64748b; text-decoration:none;">Beranda</a> &nbsp;/&nbsp;
                        <a href="<?php echo esc_url( home_url('/projects/') ); ?>" style="color:#64748b; text-decoration:none;">Proyek</a> &nbsp;/&nbsp;
                        <span style="color:#cba85d; font-weight:600;"><?php the_title(); ?></span>
                    </nav>
                    <h1 class="about_article-header" style="font-size:32px;margin-bottom:20px;"><?php the_title(); ?></h1>
                    
                    <?php
                    $raw_hero = get_the_post_thumbnail_url( $pid, 'full' );
                    $hero_lightbox = $raw_hero ? (function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($raw_hero, 'lightbox') : $raw_hero) : $thumb;
                    ?>
                    <div class="media">
                        <a class="gjs-lightbox-hero-trigger" href="<?php echo esc_url( $hero_lightbox ); ?>" data-full-src="<?php echo esc_url( $hero_lightbox ); ?>" data-raw-src="<?php echo esc_url( $raw_hero ?: $thumb ); ?>" data-caption="<?php the_title_attribute(); ?> - Foto Utama" title="Klik untuk melihat foto utama full-size">
                            <picture>
                                <img class="lazy" data-src="<?php echo esc_url( $thumb ); ?>" src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" />
                            </picture>
                            <div class="gjs-hero-zoom-badge">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                                <span>Perbesar Foto</span>
                            </div>
                        </a>
                    </div>

                    <h3 class="about_article-header">Description</h3>
                    <div class="about_article-text">
                        <?php the_content(); ?>
                    </div>
                </article>
                <div class="about_aside">
                    <div class="about_info about_aside-item">
                        <div class="wrapper">
                            <div class="wrapper--helper">
                                <h3 class="about_info-title title">Information About the Project</h3>
                                <table class="about_info-table">
                                    <tbody>
                                        <?php if ( $client ) : ?>
                                         <tr class="about_info-table_row">
                                            <td class="property">Client</td>
                                            <td class="value"><?php echo esc_html( $client ); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php if ( $location ) : ?>
                                        <tr class="about_info-table_row">
                                            <td class="property">Location</td>
                                            <td class="value">
                                                <?php if ( $loc_is_url ) : ?>
                                                    <a href="<?php echo esc_url( $location ); ?>" target="_blank" rel="noopener">Lihat di Maps</a>
                                                <?php else : echo esc_html( $location ); endif; ?>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <?php if ( $category ) : ?>
                                        <tr class="about_info-table_row">
                                            <td class="property">Category</td>
                                            <td class="value"><?php echo esc_html( $category ); ?></td>
                                        </tr>
                                        <?php endif; ?>
                                        <tr class="about_info-table_row">
                                            <td class="property">Date</td>
                                            <td class="value"><?php echo esc_html( get_the_date() ); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a class="link link-arrow" href="<?php echo esc_url( home_url('/contacts/') ); ?>"> Order service <i class="icon-arrow_right icon"></i> </a>
                        </div>
                    </div>
                    <div class="about_contact about_aside-item primary-bg">
                        <div class="wrapper">
                            <h3 class="about_contact-title title">Are You Going to Implement Project?</h3>
                            <ul class="contact-info">
                                <li class="contact-info_group">
                                    <span class="name">Address</span>
                                    <span class="content">Jl. Raya Transyogi No 8 Cileungsi, Bogor, Jawa Barat</span>
                                </li>
                                <li class="contact-info_group">
                                    <span class="name">Email</span>
                                    <span class="content d-inline-flex flex-column">
                                        <a class="link" href="mailto:info@griyadjayasentosa.id">info@griyadjayasentosa.id</a>
                                        <a class="link" href="mailto:griyadjayaupvc@gmail.com">griyadjayaupvc@gmail.com</a>
                                    </span>
                                </li>
                                <li class="contact-info_group">
                                    <span class="name">Phone</span>
                                    <span class="content d-inline-flex flex-column">
                                        <a class="link" href="https://wa.me/628111021088" target="_blank">+6281-1102-1088</a>
                                        <a class="link" href="tel:+622180476151">+6221 - 8047 6151</a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 1. FOTO PROJECT (GALLERY): Ditampilkan DI ATAS Related -->
    <?php if ( ! empty( $gallery ) ) : ?>
    <section class="project-gallery-section">
        <div class="container project-gallery-header">
            <div class="section_header" style="margin-bottom:0;">
                <span class="subtitle">Dokumentasi Pengerjaan</span>
                <h2 class="title" style="font-size:26px;margin-bottom:0;">Foto <span class="highlight">Project</span></h2>
            </div>
        </div>
        <div class="gallery presentation" id="gjsGalleryGrid">
            <?php foreach ( $gallery as $g_index => $img ) : 
                $lightbox_img = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($img, 'lightbox') : $img;
                $display_img  = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($img, 'large') : $img;
            ?>
            <div class="gallery_item">
                <a class="media gjs-lightbox-trigger" href="<?php echo esc_url( $lightbox_img ); ?>" data-full-src="<?php echo esc_url( $lightbox_img ); ?>" data-raw-src="<?php echo esc_url( $img ); ?>" data-caption="<?php the_title_attribute(); ?> - Foto <?php echo ($g_index + 1); ?>" data-index="<?php echo $g_index; ?>" title="Klik untuk melihat foto full-size">
                    <picture>
                        <img class="lazy" data-src="<?php echo esc_url( $display_img ); ?>" src="<?php echo esc_url( $display_img ); ?>" alt="<?php the_title_attribute(); ?> - Foto <?php echo ($g_index + 1); ?>" />
                    </picture>
                    <div class="overlay">
                        <div class="overlay_header section_header">
                            <span class="subtitle">Our gallery</span>
                        </div>
                        <h4 class="overlay_caption"><?php the_title(); ?></h4>
                        <?php if ( $category ) : ?><span class="overlay_label"><?php echo esc_html( $category ); ?></span><?php endif; ?>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>

    <!-- 2. RELATED PROJECTS & INTERNAL NAVIGATION (Server-Rendered HTML for 100% Google Indexing) -->
    <section class="related-projects-section" style="padding: 60px 0 80px; background: #ffffff; border-top: 1px solid #f0f0f0;">
        <div class="container">
            <?php
            $prev_proj = get_previous_post();
            $next_proj = get_next_post();
            if ( $prev_proj || $next_proj ) :
            ?>
            <div style="display:flex; justify-content:space-between; flex-wrap:wrap; gap:20px; padding-bottom:45px; margin-bottom:45px; border-bottom:1px solid #eaeaea;">
                <div>
                    <?php if ( $prev_proj ) : ?>
                    <span style="display:block; font-size:12px; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">&larr; Proyek Sebelumnya</span>
                    <a href="<?php echo esc_url( get_permalink( $prev_proj->ID ) ); ?>" style="font-size:16px; font-weight:700; color:#041e3a; text-decoration:none;"><?php echo esc_html( get_the_title( $prev_proj->ID ) ); ?></a>
                    <?php endif; ?>
                </div>
                <div style="text-align:right;">
                    <?php if ( $next_proj ) : ?>
                    <span style="display:block; font-size:12px; color:#64748b; text-transform:uppercase; letter-spacing:1px; margin-bottom:6px;">Proyek Selanjutnya &rarr;</span>
                    <a href="<?php echo esc_url( get_permalink( $next_proj->ID ) ); ?>" style="font-size:16px; font-weight:700; color:#041e3a; text-decoration:none;"><?php echo esc_html( get_the_title( $next_proj->ID ) ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <div class="section_header" style="margin-bottom: 35px; text-align:center;">
                <span class="subtitle" style="color:#cba85d; font-weight:700; text-transform:uppercase; letter-spacing:1.5px; font-size:13px;">Portofolio Lainnya</span>
                <h2 class="title" style="font-size:28px; color:#041e3a; margin-top:8px;">Proyek Terkait <span class="highlight">Griya Djaya Sentosa</span></h2>
            </div>

            <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:25px;">
                <?php
                $rel_args = array(
                    'post_type'      => 'project',
                    'posts_per_page' => 4,
                    'post__not_in'   => array( $pid ),
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                );
                $rel_query = new WP_Query( $rel_args );
                if ( $rel_query->have_posts() ) :
                    while ( $rel_query->have_posts() ) : $rel_query->the_post();
                        $r_thumb = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ?: get_the_post_thumbnail_url( get_the_ID(), 'full' );
                        if ( ! $r_thumb ) {
                            $r_thumb = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                        }
                        $r_cat = get_post_meta( get_the_ID(), '_project_category', true );
                ?>
                <a href="<?php the_permalink(); ?>" style="display:flex; flex-direction:column; background:#fff; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden; text-decoration:none; box-shadow:0 4px 12px rgba(0,0,0,0.03); transition:transform 0.3s;">
                    <div style="width:100%; aspect-ratio:4/3; overflow:hidden; background:#f1f5f9;">
                        <img src="<?php echo esc_url( $r_thumb ); ?>" alt="<?php echo esc_attr( get_the_title() . ' - Griya Djaya Sentosa' ); ?>" loading="lazy" style="width:100%; height:100%; object-fit:cover;" />
                    </div>
                    <div style="padding:18px; flex:1; display:flex; flex-direction:column; justify-content:space-between;">
                        <div>
                            <?php if ( $r_cat ) : ?>
                            <span style="display:inline-block; font-size:11px; font-weight:700; color:#cba85d; text-transform:uppercase; margin-bottom:6px;"><?php echo esc_html( $r_cat ); ?></span>
                            <?php endif; ?>
                            <h3 style="font-size:16px; font-weight:700; color:#0f172a; line-height:1.4; margin:0 0 12px;"><?php the_title(); ?></h3>
                        </div>
                        <span style="font-size:13px; font-weight:700; color:#cba85d;">Lihat Detail Proyek &rarr;</span>
                    </div>
                </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
</main>
<?php
endwhile; endif;
?>

<!-- Custom GJS Project Lightbox Modal -->
<div id="gjsProjectLightbox" class="gjs-lightbox" role="dialog" aria-modal="true" aria-hidden="true" style="display:none;">
    <div class="gjs-lightbox-backdrop"></div>
    <div class="gjs-lightbox-shell">
        <!-- Top Bar -->
        <div class="gjs-lightbox-bar gjs-lightbox-bar-top">
            <div class="gjs-lightbox-meta">
                <span class="gjs-lightbox-badge" id="gjsLightboxBadge">Portofolio</span>
                <span class="gjs-lightbox-counter" id="gjsLightboxCounter">1 / 1</span>
            </div>
            <button type="button" class="gjs-lightbox-close" id="gjsLightboxClose" aria-label="Tutup Galeri (Esc)">&times;</button>
        </div>

        <!-- Stage Container -->
        <div class="gjs-lightbox-stage" id="gjsLightboxStage">
            <button type="button" class="gjs-lightbox-nav gjs-lightbox-prev" id="gjsLightboxPrev" aria-label="Foto Sebelumnya (Panah Kiri)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
            </button>
            
            <div class="gjs-lightbox-view">
                <div class="gjs-lightbox-spinner" id="gjsLightboxSpinner">
                    <div class="gjs-spin-ring"></div>
                </div>
                <img id="gjsLightboxImg" class="gjs-lightbox-image" src="" alt="" />
            </div>

            <button type="button" class="gjs-lightbox-nav gjs-lightbox-next" id="gjsLightboxNext" aria-label="Foto Selanjutnya (Panah Kanan)">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
        </div>

        <!-- Bottom Bar / Caption -->
        <div class="gjs-lightbox-bar gjs-lightbox-bar-bottom">
            <div class="gjs-lightbox-caption" id="gjsLightboxCaption"><?php the_title(); ?></div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    function initGjsLightbox() {
        var modal = document.getElementById('gjsProjectLightbox');
        if (!modal) return;

        var imgEl      = document.getElementById('gjsLightboxImg');
        var spinner    = document.getElementById('gjsLightboxSpinner');
        var counter    = document.getElementById('gjsLightboxCounter');
        var caption    = document.getElementById('gjsLightboxCaption');
        var badge      = document.getElementById('gjsLightboxBadge');
        var prevBtn    = document.getElementById('gjsLightboxPrev');
        var nextBtn    = document.getElementById('gjsLightboxNext');
        var closeBtn   = document.getElementById('gjsLightboxClose');
        var backdrop   = modal.querySelector('.gjs-lightbox-backdrop');

        var items = [];
        var heroItem = null;
        var currentIndex = 0; // -1 represents hero, 0..N-1 represents gallery
        var isOpen = false;

        function collectItems() {
            items = [];
            var triggers = document.querySelectorAll('.gjs-lightbox-trigger');
            triggers.forEach(function(el, idx) {
                el.setAttribute('data-index', idx);
                items.push({
                    src: el.getAttribute('data-full-src') || el.getAttribute('href'),
                    rawSrc: el.getAttribute('data-raw-src') || '',
                    caption: el.getAttribute('data-caption') || ('Foto ' + (idx + 1))
                });
            });

            var heroEl = document.querySelector('.gjs-lightbox-hero-trigger');
            if (heroEl) {
                heroItem = {
                    src: heroEl.getAttribute('data-full-src') || heroEl.getAttribute('href'),
                    rawSrc: heroEl.getAttribute('data-raw-src') || '',
                    caption: heroEl.getAttribute('data-caption') || 'Foto Utama'
                };
            }
        }

        collectItems();

        function renderItem(idx) {
            currentIndex = idx;
            var curItem = null;
            var totalCount = items.length;

            if (currentIndex === -1 && heroItem) {
                curItem = heroItem;
                if (badge) badge.textContent = 'Foto Utama';
                if (counter) {
                    counter.textContent = totalCount > 0 ? ('Utama (Total ' + (totalCount + 1) + ' Foto)') : '1 / 1';
                }
            } else {
                if (currentIndex < 0) {
                    if (heroItem) {
                        currentIndex = -1;
                        curItem = heroItem;
                    } else {
                        currentIndex = totalCount > 0 ? (totalCount - 1) : 0;
                        curItem = items[currentIndex];
                    }
                } else if (currentIndex >= totalCount) {
                    if (heroItem) {
                        currentIndex = -1;
                        curItem = heroItem;
                    } else {
                        currentIndex = 0;
                        curItem = items[currentIndex];
                    }
                } else {
                    curItem = items[currentIndex];
                }

                if (curItem !== heroItem) {
                    if (badge) badge.textContent = 'Galeri Proyek';
                    if (counter) {
                        counter.textContent = (currentIndex + 1) + ' / ' + totalCount;
                    }
                } else {
                    if (badge) badge.textContent = 'Foto Utama';
                    if (counter) {
                        counter.textContent = totalCount > 0 ? ('Utama (Total ' + (totalCount + 1) + ' Foto)') : '1 / 1';
                    }
                }
            }

            if (!curItem) return;

            if (caption) {
                caption.textContent = curItem.caption || '';
            }

            // Show loading spinner while high-res image loads
            spinner.style.display = 'flex';
            imgEl.classList.remove('gjs-loaded');

            var testImg = new Image();
            testImg.onload = function() {
                imgEl.src = testImg.src;
                imgEl.alt = curItem.caption || '';
                spinner.style.display = 'none';
                imgEl.classList.add('gjs-loaded');
            };
            testImg.onerror = function() {
                // If Photon/CDN fails, automatically fall back to raw direct WordPress upload URL
                if (curItem.rawSrc && testImg.src !== curItem.rawSrc) {
                    console.warn('GJS Lightbox: Primary image source failed, falling back to raw upload:', curItem.rawSrc);
                    testImg.src = curItem.rawSrc;
                } else {
                    spinner.style.display = 'none';
                    imgEl.alt = 'Gagal memuat gambar';
                }
            };
            testImg.src = curItem.src;

            // Nav buttons visibility
            var effectiveTotal = totalCount + (heroItem ? 1 : 0);
            if (effectiveTotal <= 1) {
                if (prevBtn) prevBtn.style.display = 'none';
                if (nextBtn) nextBtn.style.display = 'none';
            } else {
                if (prevBtn) prevBtn.style.display = 'flex';
                if (nextBtn) nextBtn.style.display = 'flex';
            }
        }

        function openLightbox(idx) {
            collectItems();
            isOpen = true;
            modal.style.display = 'flex';
            modal.setAttribute('aria-hidden', 'false');
            setTimeout(function() {
                modal.classList.add('gjs-active');
            }, 10);
            document.body.style.overflow = 'hidden';
            renderItem(idx);
        }

        function closeLightbox() {
            if (!isOpen) return;
            isOpen = false;
            modal.classList.remove('gjs-active');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            setTimeout(function() {
                if (!isOpen) {
                    modal.style.display = 'none';
                    imgEl.src = '';
                }
            }, 250);
        }

        function showNext() {
            if (!isOpen) return;
            var totalCount = items.length;
            if (currentIndex === -1) {
                // From hero to first gallery item (or back to hero if no gallery)
                renderItem(totalCount > 0 ? 0 : -1);
            } else {
                var nextIdx = currentIndex + 1;
                if (nextIdx >= totalCount) {
                    renderItem(heroItem ? -1 : 0);
                } else {
                    renderItem(nextIdx);
                }
            }
        }

        function showPrev() {
            if (!isOpen) return;
            var totalCount = items.length;
            if (currentIndex === -1) {
                // From hero to last gallery item (or back to hero if no gallery)
                renderItem(totalCount > 0 ? (totalCount - 1) : -1);
            } else {
                var prevIdx = currentIndex - 1;
                if (prevIdx < 0) {
                    renderItem(heroItem ? -1 : (totalCount - 1));
                } else {
                    renderItem(prevIdx);
                }
            }
        }

        // Intercept all clicks on gallery & hero images in capture phase
        document.addEventListener('click', function(e) {
            var trigger = e.target.closest('.gjs-lightbox-trigger');
            if (trigger) {
                e.preventDefault();
                e.stopPropagation();
                if (typeof e.stopImmediatePropagation === 'function') {
                    e.stopImmediatePropagation();
                }
                var idx = parseInt(trigger.getAttribute('data-index') || '0', 10);
                openLightbox(idx);
                return false;
            }

            var heroTrigger = e.target.closest('.gjs-lightbox-hero-trigger');
            if (heroTrigger) {
                e.preventDefault();
                e.stopPropagation();
                if (typeof e.stopImmediatePropagation === 'function') {
                    e.stopImmediatePropagation();
                }
                openLightbox(-1);
                return false;
            }
        }, true); // useCapture = true ensures this runs before baguetteBox or any other listener!

        if (closeBtn) closeBtn.addEventListener('click', closeLightbox);
        if (backdrop) backdrop.addEventListener('click', closeLightbox);
        if (nextBtn) nextBtn.addEventListener('click', function(e) { e.stopPropagation(); showNext(); });
        if (prevBtn) prevBtn.addEventListener('click', function(e) { e.stopPropagation(); showPrev(); });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!isOpen) return;
            if (e.key === 'Escape' || e.keyCode === 27) {
                closeLightbox();
            } else if (e.key === 'ArrowRight' || e.keyCode === 39) {
                showNext();
            } else if (e.key === 'ArrowLeft' || e.keyCode === 37) {
                showPrev();
            }
        });

        // Touch swipe gestures for mobile devices
        var touchStartX = 0;
        var touchEndX = 0;
        var minSwipeDistance = 45;

        modal.addEventListener('touchstart', function(e) {
            if (e.changedTouches && e.changedTouches[0]) {
                touchStartX = e.changedTouches[0].clientX;
            }
        }, { passive: true });

        modal.addEventListener('touchend', function(e) {
            if (e.changedTouches && e.changedTouches[0]) {
                touchEndX = e.changedTouches[0].clientX;
                var diff = touchEndX - touchStartX;
                if (Math.abs(diff) > minSwipeDistance) {
                    if (diff < 0) {
                        showNext(); // Swipe left -> Next
                    } else {
                        showPrev(); // Swipe right -> Prev
                    }
                }
            }
        }, { passive: true });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initGjsLightbox);
    } else {
        initGjsLightbox();
    }
})();
</script>
<?php
get_footer();
