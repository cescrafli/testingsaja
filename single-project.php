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
    $thumb    = get_the_post_thumbnail_url( $pid, 'full' );
    if ( ! $thumb ) $thumb = get_template_directory_uri() . '/img/placeholder.jpg?v=2';

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
            <?php foreach ( $gallery as $img ) : ?>
            <div class="gallery_item">
                <a class="media" href="<?php echo esc_url( $img ); ?>" data-caption="<?php the_title_attribute(); ?>" data-role="gallery-link">
                    <picture>
                        <img class="lazy" data-src="<?php echo esc_url( $img ); ?>" src="<?php echo esc_url( $img ); ?>" alt="<?php the_title_attribute(); ?>" />
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

    <!-- 2. RELATED POSTS: Ditampilkan DI BAWAH Foto Project -->
    <?php if ( class_exists( 'Jetpack_RelatedPosts' ) ) : ?>
    <section class="related-projects-section" style="border-top:1px solid #f0f0f0;">
        <div class="container related-projects-container">
            <?php echo do_shortcode( '[jetpack-related-posts]' ); ?>
        </div>
    </section>
    <?php endif; ?>
</main>
<?php
endwhile; endif;
get_footer();
