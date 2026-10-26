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
                    <div class="media">
                        <picture>
                            <img class="lazy" data-src="<?php echo esc_url( $thumb ); ?>" src="<?php echo esc_url( $thumb ); ?>" alt="<?php the_title_attribute(); ?>" />
                        </picture>
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
        <div class="gallery presentation" data-role="gallery">
            <?php foreach ( $gallery as $img ) : 
                $lightbox_img = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($img, 'lightbox') : $img;
                $display_img  = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($img, 'large') : $img;
            ?>
            <div class="gallery_item">
                <a class="media" href="<?php echo esc_url( $lightbox_img ); ?>" data-caption="<?php the_title_attribute(); ?>" data-role="gallery-link">
                    <picture>
                        <img class="lazy" data-src="<?php echo esc_url( $display_img ); ?>" src="<?php echo esc_url( $display_img ); ?>" alt="<?php the_title_attribute(); ?>" />
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
get_footer();
