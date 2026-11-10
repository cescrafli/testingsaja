<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (along with style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package Cobain
 */

global $custom_css;
$custom_css = 'blog';
get_header();
?>
<style>
/* Header & Navigation Fix */
.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }

/* Page Banner */
.gjs-archive-header { padding: 104px 0 28px; text-align: center; background: #f8fafc; border-bottom: 1px solid #e2e8f0; }
.gjs-archive-title { color: #041e3a; font-size: 36px; font-weight: 700; line-height: 1.2; margin-bottom: 8px; font-family: 'Outfit', 'Inter', -apple-system, sans-serif; }
.gjs-breadcrumbs { font-size: 14px; font-weight: 500; color: #64748b; }
.gjs-breadcrumbs a { color: #041e3a; text-decoration: none; font-weight: 600; }
.gjs-breadcrumbs a:hover { color: #cba85d; }
.gjs-breadcrumbs span { color: #cba85d; }

/* Layout Wrapper */
.gjs-content-wrapper { max-width: 1200px; margin: 0 auto; padding: 36px 20px 44px; display: flex; flex-wrap: wrap; gap: 40px; }
.gjs-main-content { flex: 1 1 68%; min-width: 0; }
.gjs-sidebar { flex: 1 1 28%; min-width: 280px; }

/* Grid of Cards */
.gjs-posts-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; }
@media (max-width: 768px) {
    .gjs-archive-header { padding: 84px 15px 20px; }
    .gjs-archive-title { font-size: 28px; }
    .gjs-content-wrapper { flex-direction: column; padding: 24px 15px 36px; gap: 24px; }
    .gjs-posts-grid { grid-template-columns: 1fr; }
}

/* Card Component */
.gjs-post-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; display: flex; flex-direction: column; box-shadow: 0 4px 12px rgba(0,0,0,0.03); transition: transform 0.25s ease, box-shadow 0.25s ease; text-decoration: none; }
.gjs-post-card:hover { transform: translateY(-4px); box-shadow: 0 10px 24px rgba(0,0,0,0.08); border-color: #dfc384; }
.gjs-card-thumb-wrap { width: 100%; aspect-ratio: 16/9; background: #f1f5f9; overflow: hidden; position: relative; }
.gjs-card-thumb { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease; }
.gjs-post-card:hover .gjs-card-thumb { transform: scale(1.04); }
.gjs-card-body { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
.gjs-card-meta { font-size: 12px; color: #64748b; margin-bottom: 8px; display: flex; align-items: center; gap: 10px; }
.gjs-card-meta span { color: #cba85d; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; }
.gjs-card-title { font-size: 18px; font-weight: 700; color: #0f172a; margin: 0 0 10px; line-height: 1.4; }
.gjs-card-excerpt { font-size: 14px; color: #475569; line-height: 1.6; margin-bottom: 16px; flex-grow: 1; }
.gjs-card-link { display: inline-flex; align-items: center; gap: 6px; color: #cba85d; font-weight: 600; font-size: 13px; text-decoration: none; align-self: flex-start; }
.gjs-post-card:hover .gjs-card-link { color: #041e3a; }

/* Empty State */
.gjs-empty-state { text-align: center; padding: 60px 20px; background: #fff; border-radius: 8px; border: 1px dashed #cbd5e1; }
.gjs-empty-state h3 { font-size: 20px; color: #0f172a; margin-bottom: 8px; }
.gjs-empty-state p { color: #64748b; margin-bottom: 20px; font-size: 14px; }
.gjs-empty-state .btn-home { display: inline-block; background: #cba85d; color: #fff; padding: 10px 24px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; }

/* Pagination */
.gjs-pagination { margin-top: 35px; display: flex; justify-content: center; gap: 8px; }
.gjs-pagination .page-numbers { padding: 8px 16px; background: #fff; border: 1px solid #cbd5e1; border-radius: 6px; color: #0f172a; text-decoration: none; font-weight: 600; font-size: 13px; transition: 0.2s; }
.gjs-pagination .page-numbers.current, .gjs-pagination .page-numbers:hover { background: #041e3a; color: #fff; border-color: #041e3a; }

/* Sidebar Widgets */
.gjs-widget { background: #fff; padding: 24px; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 24px; box-shadow: 0 2px 8px rgba(0,0,0,0.02); }
.gjs-widget-title { font-size: 17px; font-weight: 700; color: #041e3a; margin: 0 0 16px; padding-bottom: 10px; border-bottom: 2px solid #dfc384; }
.gjs-search-form { display: flex; gap: 0; }
.gjs-search-input { flex-grow: 1; border: 1px solid #cbd5e1; border-right: none; padding: 10px 14px; border-radius: 6px 0 0 6px; outline: none; font-size: 14px; }
.gjs-search-input:focus { border-color: #041e3a; }
.gjs-search-btn { background: #cba85d; border: none; color: #fff; padding: 0 18px; border-radius: 0 6px 6px 0; cursor: pointer; font-weight: 600; font-size: 14px; }
.gjs-search-btn:hover { background: #b89547; }
.gjs-recent-list { list-style: none; padding: 0; margin: 0; }
.gjs-recent-list li { padding: 10px 0; border-bottom: 1px solid #f1f5f9; }
.gjs-recent-list li:last-child { border-bottom: none; padding-bottom: 0; }
.gjs-recent-list a { color: #1e293b; text-decoration: none; font-size: 14px; line-height: 1.4; display: block; font-weight: 500; }
.gjs-recent-list a:hover { color: #cba85d; }
.gjs-recent-date { font-size: 12px; color: #94a3b8; margin-top: 4px; display: block; }
</style>

<main id="primary" class="site-main">
    <div class="gjs-archive-header">
        <div class="container">
            <h1 class="gjs-archive-title">
                <?php
                if ( is_search() ) {
                    printf( esc_html__( 'Hasil Pencarian: &ldquo;%s&rdquo;', 'cobain' ), get_search_query() );
                } elseif ( is_archive() ) {
                    the_archive_title();
                } else {
                    echo esc_html__( 'Arsip & Informasi', 'cobain' );
                }
                ?>
            </h1>
            <div class="gjs-breadcrumbs">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Beranda</a> &raquo;
                <span>
                    <?php
                    if ( is_search() ) {
                        echo esc_html__( 'Pencarian', 'cobain' );
                    } elseif ( is_archive() ) {
                        single_cat_title( '', true );
                    } else {
                        echo esc_html__( 'Arsip', 'cobain' );
                    }
                    ?>
                </span>
            </div>
        </div>
    </div>

    <div class="gjs-content-wrapper">
        <div class="gjs-main-content">
            <?php if ( have_posts() ) : ?>
                <div class="gjs-posts-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'gjs-post-card' ); ?>>
                            <a href="<?php the_permalink(); ?>" class="gjs-card-thumb-wrap" aria-label="<?php the_title_attribute(); ?>">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'gjs-card-thumb', 'alt' => get_the_title() ) ); ?>
                                <?php else : ?>
                                    <img class="gjs-card-thumb" src="<?php echo esc_url( get_template_directory_uri() . '/img/placeholder.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
                                <?php endif; ?>
                            </a>
                            <div class="gjs-card-body">
                                <div class="gjs-card-meta">
                                    <span><?php echo esc_html( get_post_type() === 'project' ? 'Proyek' : 'Artikel' ); ?></span>
                                    <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'd M Y' ) ); ?></time>
                                </div>
                                <h2 class="gjs-card-title">
                                    <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;"><?php the_title(); ?></a>
                                </h2>
                                <div class="gjs-card-excerpt">
                                    <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="gjs-card-link">
                                    Baca Selengkapnya &rarr;
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="gjs-pagination">
                    <?php
                    echo paginate_links( array(
                        'prev_text' => '&laquo; Sebelumnya',
                        'next_text' => 'Selanjutnya &raquo;',
                        'type'      => 'plain',
                    ) );
                    ?>
                </div>

            <?php else : ?>
                <div class="gjs-empty-state">
                    <h3>Tidak Ada Konten Ditemukan</h3>
                    <p>Maaf, belum ada artikel atau informasi yang tersedia pada kategori atau kata kunci ini.</p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-home">Kembali ke Beranda</a>
                </div>
            <?php endif; ?>
        </div>

        <aside class="gjs-sidebar">
            <div class="gjs-widget">
                <h3 class="gjs-widget-title">Cari Artikel &amp; Proyek</h3>
                <form role="search" method="get" class="gjs-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" class="gjs-search-input" placeholder="Kata kunci..." value="<?php echo get_search_query(); ?>" name="s" required />
                    <button type="submit" class="gjs-search-btn">Cari</button>
                </form>
            </div>

            <div class="gjs-widget">
                <h3 class="gjs-widget-title">Artikel Terbaru</h3>
                <ul class="gjs-recent-list">
                    <?php
                    $recent_posts = get_posts( array(
                        'numberposts' => 5,
                        'post_status' => 'publish',
                    ) );
                    foreach ( $recent_posts as $post_item ) :
                    ?>
                        <li>
                            <a href="<?php echo esc_url( get_permalink( $post_item->ID ) ); ?>">
                                <?php echo esc_html( $post_item->post_title ); ?>
                            </a>
                            <span class="gjs-recent-date"><?php echo esc_html( get_the_date( 'd M Y', $post_item->ID ) ); ?></span>
                        </li>
                    <?php endforeach; wp_reset_postdata(); ?>
                </ul>
            </div>
        </aside>
    </div>
</main>

<?php
get_footer();
