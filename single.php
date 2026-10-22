<?php
/* Template Name: Single Post */
global $custom_css; $custom_css = 'single-post'; get_header(); if (is_single()) { cobain_set_post_views(get_the_ID()); }
if (have_posts()) : while (have_posts()) : the_post();
?>
<style>
/* New Header Hero */

/* Force Header Solid Blue */
.header {
    background-color: #041e3a !important; 
    position: fixed !important;
    top: 0 !important;
    width: 100% !important;
    z-index: 9999 !important;
}
/* Push Hero down below the header */
.single-hero {
    margin-top: 110px;

    width: 100%;
    height: 65vh;
    min-height: 400px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
    /* Optional overlay if text needs to be readable, but mockup image already has text baked in */
}
/* Main Content Wrapper */
.single-main-wrapper {
    background-color: #f7f9fa;
    padding-bottom: 80px;
}
/* Article Box */
.single-article-box {
    background: #fff;
    padding: 60px 80px;
    margin: -150px auto 50px auto;
    position: relative;
    z-index: 10;
    max-width: 900px;
    border-radius: 8px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.05);
}
@media (max-width: 768px) {
    .single-article-box { padding: 40px 30px; margin-top: -100px; }
}
.single-meta-top {
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 800;
    color: #eab308;
    margin-bottom: 20px;
    letter-spacing: 1px;
}
.single-title {
    font-size: 38px;
    font-weight: 800;
    color: #111;
    margin-bottom: 25px;
    line-height: 1.3;
}
.single-meta-bottom {
    font-size: 14px;
    color: #666;
    margin-bottom: 40px;
    padding-bottom: 25px;
    border-bottom: 1px solid #eaeaea;
}
.single-meta-bottom span { font-weight: 600; color: #333; }
.single-bottom-nav { max-width: 900px; margin: 0 auto; }

/* Hide Jetpack Comment & Post Subscriptions */
.comment-subscription-form,
.comment-form-subscriptions,
#subscribe_comments,
#subscribe_blog,
#subscribe-label,
#subscribe-blog-label,
p.comment-subscription-form,
p.comment-form-subscriptions,
p:has(#subscribe_comments),
p:has(#subscribe_blog) {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* Typography Spacing Fixes for Gutenberg Content - MAXIMUM STRICTNESS */
.post_content_body p, .post_content_body .wp-block-paragraph { margin-bottom: 24px !important; line-height: 1.8 !important; }
.post_content_body h1, .post_content_body h2, .post_content_body h3, .post_content_body h4, .post_content_body h5, .post_content_body h6, .post_content_body .wp-block-heading { margin-top: 40px !important; margin-bottom: 20px !important; line-height: 1.4 !important; font-weight: 700 !important; color: #111 !important; }
.post_content_body ul, .post_content_body .wp-block-list { margin-bottom: 24px !important; padding-left: 20px !important; list-style-position: outside !important; list-style-type: disc !important; margin-left: 20px !important; }
.post_content_body ol { margin-bottom: 24px !important; padding-left: 20px !important; list-style-position: outside !important; list-style-type: decimal !important; margin-left: 20px !important; }
.post_content_body li { margin-bottom: 10px !important; line-height: 1.8 !important; display: list-item !important; }
.post_content_body figure { margin-bottom: 30px !important; margin-top: 30px !important; }
.post_content_body img { border-radius: 8px; }
.post_content_body blockquote { border-left: 4px solid #d4b572 !important; padding-left: 20px !important; margin-bottom: 24px !important; font-style: italic !important; color: #555 !important; }

</style>

<?php 
$img_url = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_the_post_thumbnail_url(get_the_ID(), 'full');
if (!$img_url) $img_url = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
?>
<div class="single-hero" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>

<main class="single-main-wrapper">
    <div class="container">
        <article class="single-article-box">
            <div class="single-meta-top">
                <?php 
                $categories = get_the_category();
                if ( ! empty( $categories ) ) {
                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" style="color: inherit; text-decoration: none;">' . esc_html( $categories[0]->name ) . '</a>';   
                } else {
                    echo 'ALL';
                }
                ?>
            </div>
            
            <h1 class="single-title"><?php the_title(); ?></h1>
            
            <!-- <div class="single-meta-bottom">
                <?php echo get_the_date(); ?>
            </div> -->
            
            <div class="post_content_body" style="font-size: 16px; line-height: 1.8; color: #333;">
                <?php the_content(); ?>
            </div>
            
            <div class="post_article-footer" style="margin-top: 50px;">
                <ul class="socials">
                    <li class="socials_item"><a class="socials_item-link" href="https://www.instagram.com/griyajayaupvc/" target="_blank"><i class="icon-instagram"></i></a></li>
                    <li class="socials_item"><a class="socials_item-link" href="https://www.tiktok.com/@griyadjayaupvc" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="1em" height="1em" fill="currentColor"><path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/></svg></a></li>
                    <li class="socials_item"><a class="socials_item-link" href="https://www.youtube.com/@GRIYAJAYAUPVC" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="1em" height="1em" fill="currentColor"><path d="M549.655 124.083c-6.281-23.65-24.787-42.276-48.284-48.597C458.781 64 288 64 288 64S117.22 64 74.629 75.486c-23.497 6.322-42.003 24.947-48.284 48.597-11.412 42.867-11.412 132.305-11.412 132.305s0 89.438 11.412 132.305c6.281 23.65 24.787 41.5 48.284 47.821C117.22 448 288 448 288 448s170.78 0 213.371-11.486c23.497-6.321 42.003-24.171 48.284-47.821 11.412-42.867 11.412-132.305 11.412-132.305s0-89.438-11.412-132.305zm-317.51 213.508V175.185l142.739 81.205-142.739 81.201z"/></svg></a></li>
                    <li class="socials_item"><a class="socials_item-link" href="https://api.whatsapp.com/send/?phone=628111021088" target="_blank"><i class="icon-whatsapp"></i></a></li>
                </ul>
            </div>
        </article>
        
        <div class="single-bottom-nav">
            <?php
            $prev_post = get_previous_post();
            $next_post = get_next_post();
            if ($prev_post || $next_post) :
            ?>
            <div class="post_nav swiper-controls" style="margin-bottom: 40px;">
                <?php if ($prev_post) : ?>
                <div class="post_nav-item post_nav-item--prev">
                    <a class="post_nav-item_control swiper-button" href="<?php echo get_permalink($prev_post->ID); ?>">
                        <i class="icon-arrow_left icon"></i>
                    </a>
                    <div class="post_nav-item_hint">
                        <span class="label">Artikel Sebelumnya</span>
                        <h4 class="title"><a href="<?php echo get_permalink($prev_post->ID); ?>"><?php echo esc_html(get_the_title($prev_post->ID)); ?></a></h4>
                    </div>
                </div>
                <?php else: ?>
                <div class="post_nav-item post_nav-item--prev" style="visibility: hidden;"></div>
                <?php endif; ?>
                
                <?php if ($next_post) : ?>
                <div class="post_nav-item post_nav-item--next">
                    <div class="post_nav-item_hint">
                        <span class="label">Artikel Selanjutnya</span>
                        <h4 class="title"><a href="<?php echo get_permalink($next_post->ID); ?>"><?php echo esc_html(get_the_title($next_post->ID)); ?></a></h4>
                    </div>
                    <a class="post_nav-item_control swiper-button" href="<?php echo get_permalink($next_post->ID); ?>">
                        <i class="icon-arrow_right icon"></i>
                    </a>
                </div>
                <?php else: ?>
                <div class="post_nav-item post_nav-item--next" style="visibility: hidden;"></div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
            <?php 
            if (comments_open() || get_comments_number()) {
                comments_template();
            }
            ?>
        </div>
    </div>
</main>

<aside class="latest section" style="background: #fff;">
    <div class="container">
        <div class="blog_header section_header" style="text-align: center; margin-bottom: 50px;">
            <span class="subtitle">Our blog</span>
            <h2 class="title">Latest Posts</h2>
        </div>
        <ul class="blog_feed" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <?php
            $latest_args = array('post_type' => 'post', 'posts_per_page' => 3, 'post__not_in' => array(get_the_ID()));
            $latest_query = new WP_Query($latest_args);
            if ($latest_query->have_posts()) :
                while ($latest_query->have_posts()) : $latest_query->the_post();
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: get_the_post_thumbnail_url(get_the_ID(), 'full');
                    if (!$thumbnail) $thumbnail = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                    $cat = get_the_category();
                    $cat_name = !empty($cat) ? esc_html($cat[0]->name) : 'Uncategorized';
            ?>
            <li class="blog_feed-item" style="border: 1px solid #eee; border-radius: 8px; overflow: hidden; background: #fafafa;">
                <div class="media" style="width: 100%; height: 200px;">
                    <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;" />
                </div>
                <div class="main" style="padding: 20px;">
                    <div class="metadata" style="margin-bottom: 10px; font-size: 12px; color: #eab308; text-transform: uppercase;">
                        <?php echo $cat_name; ?>
                    </div>
                    <h4 class="main_title" style="font-size: 18px; margin-bottom: 15px; line-height: 1.4;"><a href="<?php the_permalink(); ?>" style="color: #111;"><?php the_title(); ?></a></h4>
                    <a class="link link-arrow" href="<?php the_permalink(); ?>" style="font-size: 14px;"> Read post <i class="icon-arrow_right icon"></i> </a>
                </div>
            </li>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </ul>
    </div>
</aside>

<?php
endwhile; endif;
get_footer();
?>
