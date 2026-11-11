<?php
/**
 * The template for displaying search results pages
 */
global $custom_css; $custom_css = 'blog'; 
get_header();
?>
<style>
/* Force solid blue header */
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }

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
    font-size: clamp(24px, 3.5vw, 38px);
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
    color: #64748b;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.bh-breadcrumbs a {
    color: #64748b;
    text-decoration: none;
    transition: color 0.2s;
}
.bh-breadcrumbs a:hover {
    color: #041e3a;
}
.bh-breadcrumbs .curr {
    color: #cba85d;
    font-weight: 700;
}

/* Content Container */
.blog-content-layout {
    width: min(100% - 32px, 1280px);
    margin-inline: auto;
    padding-top: 40px;
    padding-bottom: 60px;
}
@media (max-width: 768px) {
    .blog-content-layout {
        padding-top: 24px;
        padding-bottom: 40px;
    }
}
.blog-main-wrapper {
    display: flex;
    gap: 40px;
    align-items: flex-start;
}
.blog-posts-col {
    flex: 1 1 0%;
    min-width: 0;
}
.blog-posts-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
}
.blog-sidebar {
    flex: 0 0 360px;
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
    padding: 24px 22px;
    display: flex;
    flex-direction: column;
    flex: 1 0 auto;
}
.blog-card-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12.5px;
    color: #94a3b8;
    margin-bottom: 10px;
}
.blog-card-meta-date {
    color: #cba85d;
    font-weight: 600;
}
.blog-card-meta-dot {
    width: 3px;
    height: 3px;
    border-radius: 50%;
    background: #cbd5e1;
}
.blog-card-title {
    font-size: 18px;
    font-weight: 800;
    color: #041e3a;
    line-height: 1.35;
    margin: 0 0 10px;
    font-family: 'Outfit', 'Inter', -apple-system, sans-serif;
    transition: color 0.2s ease;
}
.blog-card:hover .blog-card-title {
    color: #cba85d;
}
.blog-card-excerpt {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.6;
    margin: 0 0 18px;
    flex-grow: 1;
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
}
.b-list li:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.b-list a {
    color: #334155;
    text-decoration: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: color 0.2s;
}
.b-list a:hover {
    color: #cba85d;
}

/* Latest Post List in Sidebar */
.b-latest-post {
    display: flex;
    gap: 12px;
    align-items: center;
    text-decoration: none;
    padding: 10px 0;
    border-bottom: 1px solid #f1f5f9;
}
.b-latest-post:last-child {
    border-bottom: none;
    padding-bottom: 0;
}
.b-latest-post-img {
    width: 60px;
    height: 60px;
    border-radius: 6px;
    object-fit: cover;
    flex-shrink: 0;
    background: #e2e8f0;
}
.b-latest-post-info {
    flex-grow: 1;
    min-width: 0;
}
.b-latest-post-title {
    font-size: 13px;
    font-weight: 700;
    color: #1e293b;
    line-height: 1.4;
    margin: 0 0 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    transition: color 0.2s;
}
.b-latest-post:hover .b-latest-post-title {
    color: #cba85d;
}
.b-latest-post-date {
    font-size: 11.5px;
    color: #94a3b8;
}

/* CTA Card */
.b-cta-card {
    background: linear-gradient(135deg, #0a2f57, #041e3a);
    color: #ffffff;
    border-radius: 12px;
    padding: 26px 20px;
    text-align: center;
    margin-bottom: 24px;
}
.b-cta-title {
    color: #ffffff;
    font-size: 17px;
    font-weight: 800;
    margin: 0 0 10px;
    font-family: 'Outfit', sans-serif;
}
.b-cta-desc {
    color: rgba(255,255,255,0.8);
    font-size: 13px;
    line-height: 1.6;
    margin: 0 0 18px;
}
.b-cta-btn {
    display: inline-block;
    background: #cba85d;
    color: #041e3a;
    font-weight: 700;
    font-size: 13px;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    transition: background 0.2s, transform 0.2s;
}
.b-cta-btn:hover {
    background: #dfc384;
    transform: translateY(-2px);
}
</style>

<main class="blog-page-main">
    <!-- Header Banner -->
    <header class="blog-header-custom">
        <h1 class="bh-title">Hasil Pencarian: &ldquo;<?php echo esc_html(get_search_query()); ?>&rdquo;</h1>
        <p class="bh-subtitle">Menampilkan artikel, panduan teknis, dan portofolio terkait kata kunci pencarian Anda</p>
        <div class="bh-accent-line"></div>
        <div class="bh-breadcrumbs">
            <a href="<?php echo home_url('/'); ?>">Beranda</a>
            <span>/</span>
            <a href="<?php echo home_url('/blog/'); ?>">Blog</a>
            <span>/</span>
            <span class="curr"><?php echo esc_html(get_search_query()); ?></span>
        </div>
    </header>

    <!-- Content Layout -->
    <div class="blog-content-layout">
        <div class="blog-main-wrapper">
            <!-- Posts Grid Column -->
            <div class="blog-posts-col">
                <div class="blog-posts-grid">
                    <?php
                    if (have_posts()) :
                        while (have_posts()) : the_post();
                            $thumbnail = (get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: get_the_post_thumbnail_url(get_the_ID(), 'full'));
                            if (!$thumbnail) {
                                $thumbnail = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                            }
                            $categories = get_the_category();
                            $cat_name = !empty($categories) ? esc_html($categories[0]->name) : 'Artikel';
                    ?>
                        <article class="blog-card">
                            <a href="<?php the_permalink(); ?>" class="blog-card-img-wrap" aria-label="<?php the_title_attribute(); ?>">
                                <img src="<?php echo esc_url($thumbnail); ?>" alt="<?php the_title_attribute(); ?>" class="blog-card-img" loading="lazy" />
                            </a>
                            <div class="blog-card-body">
                                <div class="blog-card-meta">
                                    <span class="blog-card-meta-date"><?php echo get_the_date('d M Y'); ?></span>
                                    <span class="blog-card-meta-dot"></span>
                                    <span><?php echo get_the_author(); ?></span>
                                </div>
                                <h2 class="blog-card-title"><a href="<?php the_permalink(); ?>" style="color:inherit;text-decoration:none;"><?php the_title(); ?></a></h2>
                                <p class="blog-card-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 16); ?></p>
                                <a href="<?php the_permalink(); ?>" class="blog-card-btn">
                                    <span>Baca Selengkapnya</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </a>
                            </div>
                        </article>
                    <?php
                        endwhile;
                    else :
                    ?>
                        <div style="grid-column: 1 / -1; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 40px 24px; text-align: center;">
                            <h3 style="color: #041e3a; font-size: 20px; font-weight: 700; margin-bottom: 12px;">Tidak Ada Hasil Ditemukan</h3>
                            <p style="color: #64748b; font-size: 15px; max-width: 500px; margin: 0 auto 24px; line-height: 1.6;">
                                Maaf, kami tidak menemukan artikel atau proyek dengan kata kunci &ldquo;<strong><?php echo esc_html(get_search_query()); ?></strong>&rdquo;. Silakan coba dengan kata kunci lain atau telusuri artikel terbaru kami.
                            </p>
                            <a href="<?php echo home_url('/blog/'); ?>" style="display: inline-block; background: #cba85d; color: #041e3a; padding: 12px 28px; border-radius: 6px; font-weight: 700; text-decoration: none; font-size: 14px;">Lihat Semua Artikel</a>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->
                <div style="margin-top: 40px; display: flex; justify-content: center;">
                    <?php cobain_pagination(); ?>
                </div>
            </div>

            <!-- Sidebar -->
            <aside class="blog-sidebar">
                <!-- Search Widget -->
                <div class="b-widget">
                    <form class="b-search" action="<?php echo esc_url(home_url('/')); ?>" method="GET">
                        <input type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="Cari artikel lain..." required />
                        <button type="submit" aria-label="Cari">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                        </button>
                    </form>
                </div>

                <!-- Consultation CTA Card -->
                <div class="b-cta-card">
                    <h3 class="b-cta-title">Konsultasi Proyek Gratis</h3>
                    <p class="b-cta-desc">Punya kebutuhan kusen UPVC, aluminium, fasad, atau kanopi kaca untuk bangunan Anda? Diskusikan dengan tim teknis kami.</p>
                    <a href="https://api.whatsapp.com/send/?phone=628111021088&text=Hi%2C+Saya+ingin+konsultasi+mengenai+proyek+saya" target="_blank" rel="noopener" class="b-cta-btn">Hubungi via WhatsApp</a>
                </div>

                <!-- Latest Posts Widget -->
                <div class="b-widget">
                    <h3 class="b-widget-title">Artikel Terbaru</h3>
                    <?php
                    $recent_posts = new WP_Query(array(
                        'post_type' => 'post',
                        'posts_per_page' => 4,
                        'post_status' => 'publish'
                    ));
                    if ($recent_posts->have_posts()) :
                        while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            $r_thumb = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?: get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                    ?>
                        <a href="<?php the_permalink(); ?>" class="b-latest-post">
                            <img src="<?php echo esc_url($r_thumb); ?>" alt="<?php the_title_attribute(); ?>" class="b-latest-post-img" loading="lazy">
                            <div class="b-latest-post-info">
                                <h4 class="b-latest-post-title"><?php the_title(); ?></h4>
                                <span class="b-latest-post-date"><?php echo get_the_date('d M Y'); ?></span>
                            </div>
                        </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>

                <!-- Recent Projects Widget -->
                <div class="b-widget">
                    <h3 class="b-widget-title">Proyek Terbaru</h3>
                    <?php
                    $recent_proj = new WP_Query(array(
                        'post_type' => 'project',
                        'posts_per_page' => 3,
                        'post_status' => 'publish'
                    ));
                    if ($recent_proj->have_posts()) :
                        while ($recent_proj->have_posts()) : $recent_proj->the_post();
                            $p_thumb = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail') ?: get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                    ?>
                        <a href="<?php the_permalink(); ?>" class="b-latest-post">
                            <img src="<?php echo esc_url($p_thumb); ?>" alt="<?php the_title_attribute(); ?>" class="b-latest-post-img" loading="lazy">
                            <div class="b-latest-post-info">
                                <h4 class="b-latest-post-title"><?php the_title(); ?></h4>
                                <span class="b-latest-post-date"><?php echo get_the_date('d M Y'); ?></span>
                            </div>
                        </a>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </aside>
        </div>
    </div>
</main>

<?php get_footer(); ?>
