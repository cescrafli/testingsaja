<?php
/**
 * The template for displaying Archive & Category pages
 */
global $custom_css; $custom_css = 'blog'; 
get_header();
?>
<style>
/* Force blue header */
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }

/* Header Layout */
.blog-header-custom { padding: 180px 0 50px; text-align: center; background: #fff; }
.bh-title { color: #041e3a; font-size: 38px; font-weight: 700; line-height: 1.2; margin-bottom: 0; font-family: 'Times New Roman', Times, serif; }
.bh-breadcrumbs { font-size: 15px; font-weight: 500; color: #111; margin-top: 5px; }
.bh-breadcrumbs a { color: #111; text-decoration: none; }
.bh-breadcrumbs a:hover { color: #cba85d; }
.bh-breadcrumbs span { color: #eab308; }

/* Main Wrapper */
.blog-main-wrapper { display: flex; flex-wrap: wrap; gap: 30px; padding-bottom: 80px; }
.blog-posts-grid { flex: 1 1 70%; display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; align-content: start; }
.blog-sidebar { flex: 1 1 25%; min-width: 250px; }
@media (max-width: 991px) { .blog-posts-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 768px) { .blog-posts-grid { grid-template-columns: 1fr; } }

/* Post Card */
.blog-card { background: #fff; border: 1px solid #dfc384; border-radius: 6px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 15px rgba(0,0,0,0.03); transition: transform 0.3s; text-decoration: none; }
.blog-card:hover { transform: translateY(-5px); }
.blog-card-img { width: 100%; aspect-ratio: 4/3; object-fit: cover; }
.blog-card-body { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; }
.blog-card-title { font-size: 16px; font-weight: 700; color: #111; margin-bottom: 10px; line-height: 1.4; }
.blog-card-excerpt { font-size: 13px; color: #555; margin-bottom: 15px; line-height: 1.5; flex-grow: 1; }
.blog-card-btn { display: inline-block; align-self: flex-start; background: #cba85d; color: #fff; padding: 6px 15px; border-radius: 4px; font-size: 13px; font-weight: 600; }

/* Sidebar Widgets */
.b-widget { background: #fafafa; padding: 20px; margin-bottom: 20px; border-radius: 4px; border: 1px solid #f1f1f1; }
.b-widget-title { font-size: 18px; color: #111; font-weight: 800; margin-bottom: 15px; }

/* Search widget */
.b-search { display: flex; }
.b-search input { flex-grow: 1; border: 1px solid #ddd; padding: 10px 12px; outline: none; border-radius: 4px 0 0 4px; font-size: 14px; }
.b-search button { background: #cba85d; border: none; color: #fff; padding: 0 15px; cursor: pointer; border-radius: 0 4px 4px 0; }

/* Lists */
.b-list { list-style: none; padding: 0; margin: 0; }
.b-list li { margin-bottom: 12px; font-size: 13px; color: #333; display: flex; gap: 8px; line-height: 1.4; }
.b-list li::before { content: "\2022"; color: #cba85d; font-weight: bold; font-size: 18px; line-height: 1; }
.b-list li a { color: #333; text-decoration: none; }
.b-list li a:hover { color: #cba85d; }

/* Comments */
.b-comment { margin-bottom: 15px; font-size: 13px; }
.b-comment-name { color: #cba85d; font-weight: 700; font-size: 13px; display: block; margin-bottom: 2px; }
.b-comment-text { color: #555; line-height: 1.4; }
.b-comment-text a { color: #555; text-decoration: none; }

/* Pagination */
.blog-pagination { grid-column: 1 / -1; display: flex; justify-content: center; gap: 10px; margin-top: 20px; }
.blog-pagination .page-numbers { padding: 8px 15px; background: #f1f1f1; color: #111; text-decoration: none; border-radius: 4px; font-weight: 600; }
.blog-pagination .page-numbers.current, .blog-pagination .page-numbers:hover { background: #cba85d; color: #fff; }
</style>

<div class="blog-header-custom container">
    <h1 class="bh-title"><?php the_archive_title(); ?></h1>
    <svg width="300" height="15" viewBox="0 0 300 15" style="margin: 10px auto 20px; display: block;">
        <path d="M 0,12 Q 150,0 300,12" stroke="#cba85d" stroke-width="2.5" fill="none" stroke-linecap="round"/>
    </svg>
    <div class="bh-breadcrumbs">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> &nbsp;/&nbsp; 
        <a href="<?php echo esc_url(home_url('/blog/')); ?>">Blog</a> &nbsp;/&nbsp; 
        <span><?php single_term_title(); ?></span>
    </div>
</div>

<main class="container blog-main-wrapper">
    <!-- Posts Grid (Left) -->
    <div class="blog-posts-grid">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
                if (!$thumbnail) $thumbnail = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
        ?>
        <a href="<?php echo get_permalink(); ?>" class="blog-card">
            <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card-img">
            <div class="blog-card-body">
                <div class="blog-card-title"><?php the_title(); ?></div>
                <div class="blog-card-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?>
                </div>
                <span class="blog-card-btn">Baca Artikel &rarr;</span>
            </div>
        </a>
        <?php
            endwhile;
            
            // Pagination
            the_posts_pagination(array(
                'prev_text' => '&laquo;',
                'next_text' => '&raquo;',
                'class'     => 'blog-pagination'
            ));
        else:
            echo '<p style="grid-column: 1 / -1; padding: 40px 0; text-align: center; color: #666;">Belum ada artikel dalam kategori ini.</p>';
        endif;
        ?>
    </div>
    
    <!-- Sidebar (Right) -->
    <div class="blog-sidebar">
        <div class="b-widget">
            <form class="b-search" action="<?php echo esc_url(home_url('/')); ?>" method="GET">
                <input type="text" name="s" placeholder="Search..." value="<?php echo get_search_query(); ?>" required>
                <button type="submit"><i class="icon-search"></i></button>
            </form>
        </div>
        
        <div class="b-widget">
            <h3 class="b-widget-title">Artikel Terbaru</h3>
            <ul class="b-list">
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 4,
                    'post_status' => 'publish'
                ));
                foreach( $recent_posts as $recent ) {
                    echo '<li><a href="' . get_permalink($recent["ID"]) . '">' . esc_html($recent["post_title"]) . '</a></li>';
                }
                ?>
            </ul>
        </div>
        
        <div class="b-widget">
            <h3 class="b-widget-title">Kategori</h3>
            <ul class="b-list">
                <?php
                $categories = get_categories(array('hide_empty' => true));
                foreach( $categories as $cat ) {
                    echo '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . ' (' . $cat->count . ')</a></li>';
                }
                ?>
            </ul>
        </div>

        <div class="b-widget">
            <h3 class="b-widget-title">Komentar Terbaru</h3>
            <div class="b-comments-list">
                <?php
                $recent_comments = get_comments(array(
                    'number'      => 4,
                    'status'      => 'approve',
                    'post_status' => 'publish'
                ));
                if ($recent_comments) {
                    foreach ((array) $recent_comments as $comment) {
                        ?>
                        <div class="b-comment">
                            <span class="b-comment-name"><?php echo esc_html(get_comment_author($comment)); ?></span>
                            <div class="b-comment-text">
                                <a href="<?php echo esc_url(get_comment_link($comment)); ?>">
                                    <?php echo esc_html(wp_trim_words($comment->comment_content, 10, '...')); ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p style="font-size:13px;color:#777;">Belum ada komentar.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
