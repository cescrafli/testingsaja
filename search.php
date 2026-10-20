<?php
/* Template Name: Blog */
global $custom_css; $custom_css = 'blog'; get_header();
?><header class="page primary-bg">
            <div class="container">
                <div class="section_header">
                    <span class="subtitle subtitle--extended">Our blog</span>
                    <h1 class="title">Blog</h1>
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs_item">
                            <a href="<?php echo home_url('/'); ?>">Home</a>
                        </li>

                        <li class="breadcrumbs_item breadcrumbs_item--current">
                            <span>Blog</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="media">
                <picture>
                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="media" />
                </picture>
            </div>
        </header>
        <!-- blog content start -->
        <main class="blog section">
            <div class="container">
                <div class="blog_wrapper">
                    <ul class="blog_feed">
<?php
$blog_args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'paged' => max(1, get_query_var('paged'), get_query_var('page', 1)),
    'post_status' => 'publish'
);
$blog_query = new WP_Query($blog_args);
if (have_posts()) :
    while (have_posts()) : the_post();
        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
        if (!$thumbnail) {
            $thumbnail = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
        }
        $categories = get_the_category();
        $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
        $category_link = !empty($categories) ? esc_url(get_category_link($categories[0]->term_id)) : '#';
?>
        <li class="blog_feed-item">
            <div class="media">
                <picture>
                    <source data-srcset="<?php echo esc_url($thumbnail); ?>" srcset="<?php echo esc_url($thumbnail); ?>"  />
                    <img class="lazy" data-src="<?php echo esc_url($thumbnail); ?>" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                </picture>
            </div>
            <div class="main">
                <div class="metadata">
                    <a class="category" href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a>
                    <i class="icon icon-dot"></i>
                    <span class="date"><?php echo get_the_date(); ?></span>
                </div>
                <h4 class="main_title"><?php the_title(); ?></h4>
                <p class="main_text"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                <a class="link link-arrow" href="<?php the_permalink(); ?>"> Read post <i class="icon-arrow_right icon"></i> </a>
            </div>
        </li>
<?php
    endwhile;
else :
    echo "<li style=\"width:100%\"><p>No results found for your query. Please try again with different keywords.</p></li>";
endif;
?>
</ul>
                    <?php cobain_pagination(); ?>
                </div>
                <aside class="widgets">
                    <form class="widgets_widget--search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET">
    <input class="field required" type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search" />
    <button class="btn btn--static" type="submit" aria-label="Search in blog">
        <i class="icon-search"></i>
    </button>
</form>
                    
                    <div class="widgets_widget widgets_widget--latest">
    <h3 class="widgets_widget-title">Hot Articles</h3>
    <ul class="list">
    <?php
    $hot_args = array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'post_status' => 'publish'
    );
    $hot_query = new WP_Query($hot_args);
    $hot_index = 0;
    if ($hot_query->have_posts()) :
        while ($hot_query->have_posts()) : $hot_query->the_post();
            $hot_index++;
            ?>
            <li class="list-item">
                <?php if ($hot_index === 1) : 
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    if (!$thumbnail) {
                        $thumbnail = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                    }
                ?>
                <div class="media">
                    <picture>
                        <source data-srcset="<?php echo esc_url($thumbnail); ?>" srcset="<?php echo esc_url($thumbnail); ?>"  />
                        <img class="lazy" data-src="<?php echo esc_url($thumbnail); ?>" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                    </picture>
                </div>
                <?php endif; ?>
                <h4 class="title"><?php the_title(); ?></h4>
                <a class="link link-arrow" href="<?php the_permalink(); ?>">
                    Read now
                    <i class="icon-arrow_right icon"></i>
                </a>
            </li>
            <?php
        endwhile;
        wp_reset_postdata();
    else:
        // Fallback to recent posts if no views yet
        $hot_args['orderby'] = 'date';
        $hot_args['order'] = 'DESC';
        unset($hot_args['meta_key']);
        $hot_query = new WP_Query($hot_args);
        while ($hot_query->have_posts()) : $hot_query->the_post();
            $hot_index++;
            ?>
            <li class="list-item">
                <?php if ($hot_index === 1) : 
                    $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
                    if (!$thumbnail) {
                        $thumbnail = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                    }
                ?>
                <div class="media">
                    <picture>
                        <source data-srcset="<?php echo esc_url($thumbnail); ?>" srcset="<?php echo esc_url($thumbnail); ?>"  />
                        <img class="lazy" data-src="<?php echo esc_url($thumbnail); ?>" src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
                    </picture>
                </div>
                <?php endif; ?>
                <h4 class="title"><?php the_title(); ?></h4>
                <a class="link link-arrow" href="<?php the_permalink(); ?>">
                    Read now
                    <i class="icon-arrow_right icon"></i>
                </a>
            </li>
            <?php
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
    </ul>
</div>
                    
                    
                    

<div class="widgets_widget widgets_widget--comments">
    <h3 class="widgets_widget-title">Recent Comments</h3>
    <ul class="list">
        <?php
        $recent_comments = get_comments(array(
            'number'      => 3,
            'status'      => 'approve',
            'post_status' => 'publish'
        ));
        if ($recent_comments) {
            foreach ((array) $recent_comments as $comment) {
                ?>
                <li class="list-item">
                    <i class="icon-comment icon--bubble"></i>
                    <a class="link" href="<?php echo esc_url(get_comment_link($comment)); ?>">
                        <span class="username"><?php echo get_comment_author($comment); ?></span>
                        in <?php echo get_the_title($comment->comment_post_ID); ?>
                    </a>
                </li>
                <?php
            }
        }
        ?>
    </ul>
</div>
                    <div class="widgets_widget widgets_widget--archives">
    <h3 class="widgets_widget-title">Archives</h3>
    <ul class="list">
    <?php
    global $wpdb;
    $months = $wpdb->get_results("SELECT DISTINCT MONTH(post_date) AS month, YEAR(post_date) AS year FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post' GROUP BY year, month ORDER BY year DESC, month DESC LIMIT 3");
    if ($months) {
        foreach($months as $month) :
            $month_name = date_i18n("F", mktime(0, 0, 0, $month->month, 1, $month->year));
            $archive_url = get_month_link($month->year, $month->month);
    ?>
        <li class="list-item">
            <a class="link d-flex align-items-center" href="<?php echo esc_url($archive_url); ?>">
                <i class="icon-arrow_right icon--arrow"></i>
                <?php echo esc_html($month_name); ?>
            </a>
        </li>
    <?php 
        endforeach;
    }
    ?>
    </ul>
</div>
                    
                </aside>
            </div>
        </main>
        <!-- blog content end -->
        

<?php
get_footer();
?>




















