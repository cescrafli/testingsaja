<header class="page primary-bg">
    <?php
    $banner_bg_url = '';
    $obj_id = get_queried_object_id();
    if ($obj_id) {
        $banner_bg_url = get_the_post_thumbnail_url($obj_id, 'large') ?: get_the_post_thumbnail_url($obj_id, 'full');
    }
    if (!$banner_bg_url) {
        $banner_bg_url = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
    }
    ?>
    <div class="container">
        <div class="section_header">
            <span class="subtitle subtitle--extended">Griya Djaya Sentosa</span>
            <h1 class="title"><?php global $custom_page_title; echo isset($custom_page_title) ? $custom_page_title : (is_404() ? "Page Not Found" : (is_archive() ? get_the_archive_title() : get_the_title())); ?></h1>
            <ul class="breadcrumbs">
                <li class="breadcrumbs_item">
                    <a href="<?php echo home_url('/'); ?>">Home</a>
                </li>
                <li class="breadcrumbs_item breadcrumbs_item--current">
                    <span><?php echo is_404() ? "404" : (is_archive() ? get_the_archive_title() : get_the_title()); ?></span>
                </li>
            </ul>
        </div>
    </div>
    <div class="media">
        <picture>
            <source data-srcset="<?php echo esc_url($banner_bg_url); ?>" srcset="<?php echo esc_url($banner_bg_url); ?>" />
            <img class="lazy" data-src="<?php echo esc_url($banner_bg_url); ?>" src="<?php echo esc_url($banner_bg_url); ?>" alt="Banner Background" style="object-fit: cover;" />
        </picture>
    </div>
</header>
<main>