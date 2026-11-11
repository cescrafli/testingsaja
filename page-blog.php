<?php
/* Template Name: Blog */
global $custom_css; $custom_css = 'blog'; get_header();
?>
<style>
/* Full-width Page Main */
.blog-page-main {
    width: 100% !important;
    background-color: #ffffff !important;
    flex: 1 0 auto !important;
    display: block !important;
    margin: 0 !important;
    padding: 0 !important;
    min-height: 80vh !important;
}

/* Header Banner */
.blog-header-custom {
    width: 100% !important;
    padding: 104px 0 28px !important;
    text-align: center;
    background: #ffffff !important;
    border-bottom: 1px solid #f1f5f9;
}
@media (max-width: 768px) {
    .blog-header-custom { padding: 84px 15px 22px !important; }
}
.bh-title {
    color: #041e3a;
    font-size: clamp(28px, 3.5vw, 40px);
    font-weight: 800;
    line-height: 1.25;
    margin: 0 0 10px;
    font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
    letter-spacing: -0.5px;
}
.bh-subtitle {
    font-size: clamp(14px, 1.2vw, 16px);
    color: #64748b;
    margin: 0 auto 16px;
    max-width: 680px;
    line-height: 1.6;
    font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
}
.bh-accent-line {
    width: 60px;
    height: 3px;
    background: #cba85d;
    margin: 0 auto 14px;
    border-radius: 2px;
}
.bh-breadcrumbs {
    font-size: 13.5px;
    font-weight: 500;
    color: #94a3b8;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.bh-breadcrumbs a {
    color: #041e3a;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s ease;
}
.bh-breadcrumbs a:hover {
    color: #cba85d;
}
.bh-breadcrumbs .sep {
    color: #cbd5e1;
    font-size: 14px;
}
.bh-breadcrumbs .active {
    color: #cba85d;
    font-weight: 600;
}

/* Main Content Area */
.blog-content-section {
    width: 100% !important;
    background-color: #ffffff !important;
    padding: 36px 0 70px;
}
.blog-main-wrapper {
    max-width: 1280px;
    width: min(100% - 32px, 1280px);
    margin: 0 auto;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 36px;
    box-sizing: border-box;
}
.blog-posts-grid {
    flex: 1 1 68%;
    min-width: 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
    align-content: start;
}
.blog-sidebar {
    flex: 0 0 340px;
    max-width: 360px;
    width: 100%;
}
@media (max-width: 991px) {
    .blog-main-wrapper {
        flex-direction: column;
        gap: 32px;
    }
    .blog-sidebar {
        max-width: 100%;
        width: 100%;
    }
}
@media (max-width: 640px) {
    .blog-posts-grid {
        grid-template-columns: 1fr;
    }
}

/* Modern Card */
.blog-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    text-decoration: none;
    position: relative;
}
.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 30px rgba(4, 30, 58, 0.08);
    border-color: #cba85d;
}
.blog-card-img-wrap {
    width: 100%;
    aspect-ratio: 16/9;
    background: #f1f5f9;
    overflow: hidden;
    position: relative;
    display: block;
}
.blog-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.blog-card:hover .blog-card-img {
    transform: scale(1.04);
}
.blog-card-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: rgba(4, 30, 58, 0.88);
    color: #ffffff;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 4px 10px;
    border-radius: 4px;
    border-left: 3px solid #cba85d;
    backdrop-filter: blur(4px);
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}
.blog-card-body {
    padding: 20px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}
.blog-card-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 12px;
    color: #94a3b8;
    margin-bottom: 10px;
}
.blog-card-meta span {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.blog-card-meta svg {
    color: #cba85d;
}
.blog-card-title {
    font-size: 18px;
    font-weight: 700;
    color: #0f172a;
    margin: 0 0 10px;
    line-height: 1.4;
    transition: color 0.2s ease;
    font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
}
.blog-card:hover .blog-card-title {
    color: #cba85d;
}
.blog-card-excerpt {
    font-size: 13.5px;
    color: #64748b;
    margin-bottom: 18px;
    line-height: 1.6;
    flex-grow: 1;
}
.blog-card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid #f1f5f9;
    padding-top: 14px;
    margin-top: auto;
}
.blog-card-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #041e3a;
    font-weight: 700;
    font-size: 13px;
    text-decoration: none;
    transition: color 0.2s ease, transform 0.2s ease;
}
.blog-card:hover .blog-card-btn {
    color: #cba85d;
    transform: translateX(4px);
}

/* Sidebar Widgets */
.b-widget {
    background: #ffffff;
    padding: 22px;
    margin-bottom: 24px;
    border-radius: 10px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
}
.b-widget-title {
    font-size: 16px;
    color: #041e3a;
    font-weight: 800;
    margin: 0 0 16px;
    padding-bottom: 10px;
    border-bottom: 2px solid #dfc384;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
}

/* Search widget */
.b-search {
    display: flex;
    border-radius: 6px;
    overflow: hidden;
}
.b-search input {
    flex-grow: 1;
    border: 1px solid #cbd5e1;
    border-right: none;
    padding: 11px 14px;
    outline: none;
    border-radius: 6px 0 0 6px;
    font-size: 14px;
    color: #1e293b;
    transition: border-color 0.2s;
}
.b-search input:focus {
    border-color: #041e3a;
}
.b-search button {
    background: #cba85d;
    border: none;
    color: #ffffff;
    padding: 0 16px;
    cursor: pointer;
    border-radius: 0 6px 6px 0;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}
.b-search button:hover {
    background: #b89547;
}

/* Lists */
.b-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.b-list li {
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13.5px;
    line-height: 1.5;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 8px;
}
.b-list li:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.b-list li a {
    color: #334155;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.2s ease;
    flex-grow: 1;
}
.b-list li a:hover {
    color: #cba85d;
}
.b-list-badge {
    background: #f1f5f9;
    color: #64748b;
    font-size: 11px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 12px;
    flex-shrink: 0;
}

/* Comments */
.b-comment {
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
    font-size: 13px;
}
.b-comment:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.b-comment-name {
    color: #041e3a;
    font-weight: 700;
    font-size: 13px;
    display: block;
    margin-bottom: 3px;
}
.b-comment-text {
    color: #64748b;
    line-height: 1.5;
}
.b-comment-text a {
    color: #64748b;
    text-decoration: none;
    transition: color 0.2s ease;
}
.b-comment-text a:hover {
    color: #cba85d;
}

/* Pagination */
.blog-pagination {
    grid-column: 1 / -1;
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 30px;
}
.blog-pagination .page-numbers {
    padding: 8px 16px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    color: #0f172a;
    text-decoration: none;
    font-weight: 600;
    font-size: 13px;
    transition: all 0.2s ease;
}
.blog-pagination .page-numbers.current,
.blog-pagination .page-numbers:hover {
    background: #041e3a;
    color: #ffffff;
    border-color: #041e3a;
}
</style>

<main class="blog-page-main">
    <section class="blog-header-custom">
        <div class="container" style="max-width: 1280px; margin: 0 auto; padding: 0 20px;">
            <h1 class="bh-title">Blog &amp; Inspirasi Proyek</h1>
            <p class="bh-subtitle">Temukan ide, inovasi fabrikasi, panduan arsitektur, dan kisah di balik setiap proyek kami.</p>
            <div class="bh-accent-line" style="margin-bottom: 0;"></div>
        </div>
    </section>

    <div class="blog-content-section">
        <div class="blog-main-wrapper">
            <!-- Posts Grid (Left) -->
            <div class="blog-posts-grid">
        <?php
        $paged = max( 1, get_query_var('paged'), get_query_var('page') );
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 12,
            'paged'          => $paged,
            'post_status'    => 'publish'
        );
        $blog_query = new WP_Query($args);
        
        if ($blog_query->have_posts()) :
            while ($blog_query->have_posts()) : $blog_query->the_post();
                $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: get_the_post_thumbnail_url(get_the_ID(), 'full');
                if (!$thumbnail) $thumbnail = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                
                $cats = get_the_category();
                $cat_name = !empty($cats) ? esc_html($cats[0]->name) : 'Artikel';
                $post_date = get_the_date('d M Y');
        ?>
        <article class="blog-card">
            <a href="<?php the_permalink(); ?>" class="blog-card-img-wrap" aria-label="<?php the_title_attribute(); ?>">
                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php echo esc_attr(get_the_title() . ' - Griya Djaya Sentosa'); ?>" class="blog-card-img" loading="lazy">
                <span class="blog-card-badge"><?php echo $cat_name; ?></span>
            </a>
            <div class="blog-card-body">
                <div class="blog-card-meta">
                    <span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <?php echo esc_html($post_date); ?>
                    </span>
                    <span>&bull;</span>
                    <span>
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        Griya Djaya Sentosa
                    </span>
                </div>
                <h2 class="blog-card-title">
                    <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;"><?php the_title(); ?></a>
                </h2>
                <div class="blog-card-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                </div>
                <div class="blog-card-footer">
                    <a href="<?php the_permalink(); ?>" class="blog-card-btn">
                        Baca Artikel
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </a>
                </div>
            </div>
        </article>
        <?php
            endwhile;
            
            // Pagination
            $total_pages = $blog_query->max_num_pages;
            if ($total_pages > 1) {
                echo '<div class="blog-pagination">';
                echo paginate_links(array(
                    'base' => get_pagenum_link(1) . '%_%',
                    'format' => 'page/%#%/',
                    'current' => $paged,
                    'total' => $total_pages,
                    'prev_text' => '&laquo; Sebelumnya',
                    'next_text' => 'Selanjutnya &raquo;'
                ));
                echo '</div>';
            }
            
            wp_reset_postdata();
        else:
            echo '<div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; background: #fff; border-radius: 10px; border: 1px dashed #cbd5e1;">';
            echo '<h3 style="color: #041e3a; font-size: 20px; margin-bottom: 8px;">Belum Ada Artikel</h3>';
            echo '<p style="color: #64748b; font-size: 14px;">Silakan periksa kembali nanti untuk pembaruan artikel terbaru.</p>';
            echo '</div>';
        endif;
        ?>
    </div>
    
    <!-- Sidebar (Right) -->
    <aside class="blog-sidebar" aria-label="Sidebar Blog">
        <div class="b-widget">
            <form class="b-search" action="<?php echo esc_url(home_url('/')); ?>" method="GET">
                <input type="text" name="s" placeholder="Cari artikel..." value="<?php echo get_search_query(); ?>" required>
                <button type="submit" aria-label="Cari">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            </form>
        </div>
        
        <div class="b-widget">
            <h3 class="b-widget-title">Artikel Terbaru</h3>
            <ul class="b-list">
                <?php
                $recent_posts = wp_get_recent_posts(array(
                    'numberposts' => 6,
                    'post_status' => 'publish'
                ));
                foreach( $recent_posts as $recent ) {
                    echo '<li><a href="' . esc_url(get_permalink($recent["ID"])) . '">' . esc_html($recent["post_title"]) . '</a></li>';
                }
                ?>
            </ul>
        </div>

        <div class="b-widget">
            <h3 class="b-widget-title">Proyek Terbaru</h3>
            <ul class="b-list">
                <?php
                $recent_projects = get_posts(array(
                    'post_type'      => 'project',
                    'posts_per_page' => 6,
                    'post_status'    => 'publish'
                ));
                foreach( $recent_projects as $rproj ) {
                    echo '<li><a href="' . esc_url(get_permalink($rproj->ID)) . '">' . esc_html($rproj->post_title) . '</a></li>';
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
                                    <?php echo esc_html(wp_trim_words(wp_strip_all_tags($comment->comment_content), 12, '...')); ?>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p style="font-size:13px;color:#94a3b8;margin:0;">Belum ada komentar.</p>';
                }
                ?>
            </div>
        </div>
    </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>
