<?php
/**
 * Cobain Theme functions and definitions
 */

if ( ! function_exists( 'cobain_setup' ) ) :
	function cobain_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'cobain' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'cobain_setup' );

/**
 * SEO & Single Document Title Management
 * Ensures only 1 <title> tag is output site-wide via wp_head() / title-tag,
 * and handles edge-cases for Homepage, Interior page, and title normalization.
 */
function gjs_get_custom_document_title() {
	$req_uri = $_SERVER['REQUEST_URI'] ?? '';
	$is_interior = (
		is_page('interior') ||
		is_page_template('page-product-interior.php') ||
		(!empty($req_uri) && preg_match('#/(product/)?interior/?(\?|$)#', $req_uri))
	);
	if ($is_interior) {
		return 'Interior Design & Fitting Out Jakarta | Griya Djaya Sentosa';
	}

	if (is_front_page() || is_home()) {
		return 'Griya Djaya Sentosa | Spesialis Fabrikasi Kusen, Fasad, Besi & Kaca';
	}

	return null;
}

// 1. Hook into WordPress Core title generation (pre_get_document_title)
add_filter( 'pre_get_document_title', 'gjs_filter_pre_get_document_title', 99 );
function gjs_filter_pre_get_document_title( $title ) {
	$custom = gjs_get_custom_document_title();
	if ( $custom !== null ) {
		return $custom;
	}
	return $title;
}

// 2. Hook into WordPress Core title parts (document_title_parts)
add_filter( 'document_title_parts', 'gjs_filter_document_title_parts', 99 );
function gjs_filter_document_title_parts( $parts ) {
	$custom = gjs_get_custom_document_title();
	if ( $custom !== null ) {
		$parts['title'] = $custom;
		unset($parts['site'], $parts['tagline'], $parts['page']);
		return $parts;
	}

	// Capitalize Alumunium
	if ( !empty($parts['title']) ) {
		$parts['title'] = preg_replace('/^alumunium\b/i', 'Alumunium', $parts['title']);
		// If brand is already inside title, prevent double suffix
		if ( stripos($parts['title'], 'Griya Djaya Sentosa') !== false ) {
			unset($parts['site']);
		}
	}
	return $parts;
}

// 3. Hook into SEO plugins (Yoast SEO & Rank Math)
add_filter( 'wpseo_title', 'gjs_filter_seo_plugin_title', 99 );
add_filter( 'rank_math/frontend/title', 'gjs_filter_seo_plugin_title', 99 );
function gjs_filter_seo_plugin_title( $title ) {
	$custom = gjs_get_custom_document_title();
	if ( $custom !== null ) {
		return $custom;
	}

	if ( empty($title) ) {
		return $title;
	}

	// Capitalize Alumunium
	$title = preg_replace('/^alumunium\b/i', 'Alumunium', $title);

	// Remove redundant trailing brand if brand already in title
	if ( preg_match('/Griya Djaya Sentosa.+[\-\|]\s*Griya Djaya Sentosa$/i', $title) ) {
		$title = preg_replace('/\s*[\-\|]\s*Griya Djaya Sentosa$/i', '', $title);
	}

	// Trim dangling separators (e.g. "Griya Djaya Sentosa -")
	$title = preg_replace('/\s*[\-\|]\s*$/', '', $title);

	return trim($title);
}

/**
 * SEO & Single Meta Description Management
 * Ensures only 1 <meta name="description"> tag is output site-wide via wp_head(),
 * provides unique page-specific fallback descriptions for pages not set in SEO plugins,
 * and prevents multiple or duplicate meta descriptions.
 */
function gjs_get_fallback_meta_description() {
	$req_uri = $_SERVER['REQUEST_URI'] ?? '';
	$req_path = trim(parse_url($req_uri, PHP_URL_PATH) ?? '', '/');
	$home_path = trim(parse_url(home_url(), PHP_URL_PATH) ?? '', '/');
	if (!empty($home_path) && strpos($req_path, $home_path) === 0) {
		$req_path = trim(substr($req_path, strlen($home_path)), '/');
	}

	// 1. Interior Page
	$is_interior = (
		is_page('interior') ||
		is_page_template('page-product-interior.php') ||
		$req_path === 'product/interior' ||
		$req_path === 'interior' ||
		(!empty($req_uri) && preg_match('#/(product/)?interior/?(\?|$)#', $req_uri))
	);
	if ($is_interior) {
		return 'Jasa interior design dan fitting out turnkey: partisi kaca, wall panel kayu, kitchen set dan custom cabinetry dengan workshop sendiri. Konsultasi dan survey lokasi via WhatsApp.';
	}

	// 2. Homepage
	if (is_front_page() || is_home() || empty($req_path)) {
		return 'Satu Mitra Fabrikasi untuk Seluruh Kebutuhan Kusen Aluminium, UPVC, Fasad, Besi & Kaca Proyek Anda. Konsultasi & survei proyek gratis.';
	}

	// 3. Specific Product Categories
	if (is_page('upvc') || is_page_template('page-product-upvc.php') || $req_path === 'product/upvc') {
		return 'Spesialis fabrikasi dan pemasangan kusen, pintu, dan jendela UPVC profil Conch berkualitas tinggi. Kedap suara, anti rayap, dan bergaransi resmi.';
	}
	if (is_page('alumunium') || is_page_template('page-product-alumunium.php') || $req_path === 'product/alumunium') {
		return 'Fabrikasi dan pemasangan kusen aluminium Alexindo, YKK, dan profil premium untuk hunian, kantor, dan gedung komersial.';
	}
	if (is_page('fasad') || is_page_template('page-product-fasad.php') || $req_path === 'product/fasad') {
		return 'Pemasangan fasad curtain wall dan ACP (Aluminium Composite Panel) modern, kokoh, dan presisi untuk gedung bertingkat dan bangunan komersial.';
	}
	if (is_page('kaca') || is_page_template('page-product-kaca.php') || $req_path === 'product/kaca') {
		return 'Penyedia partisi kaca tempered, pintu kaca shower, canopy kaca, dan railing tangga kaca berkualitas presisi dengan standar keamanan tinggi.';
	}
	if (is_page('besi-stainless') || is_page_template('page-product-besi.php') || $req_path === 'product/besi-stainless') {
		return 'Pekerjaan besi dan stainless steel: railing, kanopi, pintu gerbang, dan struktur arsitektural tahan karat dengan finishing rapi dan kokoh.';
	}
	if (is_page('product') || is_page_template('page-product.php') || $req_path === 'product') {
		return 'Katalog produk fabrikasi Griya Djaya Sentosa: UPVC, Aluminium, Fasad, Kaca Tempered, Besi Stainless, dan Interior Design fitting out.';
	}

	// 4. Corporate & Information Pages
	if (is_page('about') || is_page_template('page-about.php') || $req_path === 'about') {
		return 'Tentang Griya Djaya Sentosa: Mitra terpercaya fabrikasi kusen UPVC, aluminium, fasad bangunan, dan interior dengan fasilitas workshop mandiri.';
	}
	if (is_page('projects') || is_page_template('page-projects.php') || $req_path === 'projects') {
		return 'Dokumentasi portofolio proyek kusen aluminium, UPVC, fasad curtain wall, kaca tempered, dan interior di berbagai wilayah Indonesia.';
	}
	if (is_page('blog') || is_page_template('page-blog.php') || $req_path === 'blog') {
		return 'Kumpulan artikel, tips, panduan material arsitektural, kusen UPVC, aluminium, fasad gedung, dan interior design terkini.';
	}
	if (is_page('warranty') || is_page_template('page-warranty.php') || $req_path === 'warranty') {
		return 'Informasi garansi resmi dan sistem pengecekan barcode kartu garansi produk fabrikasi Griya Djaya Sentosa.';
	}
	if (is_page('contacts') || is_page_template('page-contacts.php') || $req_path === 'contacts') {
		return 'Hubungi tim Griya Djaya Sentosa untuk konsultasi teknis, estimasi RAB, dan survey lokasi proyek fabrikasi kusen, fasad, dan interior.';
	}
	if (is_page('faq') || is_page_template('page-faq.php') || $req_path === 'faq') {
		return 'Pertanyaan umum seputar layanan fabrikasi, proses pemesanan, pengiriman, pemasangan kusen UPVC, aluminium, kaca, dan garansi proyek.';
	}

	// 5. Single Post / Project fallback
	if (is_singular()) {
		$post = get_queried_object();
		if ($post && !empty($post->post_excerpt)) {
			return wp_strip_all_tags($post->post_excerpt);
		} elseif ($post && !empty($post->post_content)) {
			$text = wp_strip_all_tags(strip_shortcodes($post->post_content));
			$text = preg_replace('/\s+/', ' ', $text);
			if (mb_strlen($text) > 155) {
				return mb_substr(trim($text), 0, 152) . '...';
			}
			return trim($text);
		} elseif ($post && !empty($post->post_title)) {
			return $post->post_title . ' dikerjakan oleh Griya Djaya Sentosa dengan standar presisi dan material berkualitas tinggi.';
		}
	}

	return 'Satu Mitra Fabrikasi untuk Seluruh Kebutuhan Kusen Aluminium, UPVC, Fasad, Besi & Kaca Proyek Anda.';
}

// Hook into SEO plugins (Yoast SEO & Rank Math)
add_filter( 'wpseo_metadesc', 'gjs_filter_seo_plugin_metadesc', 99 );
add_filter( 'rank_math/frontend/description', 'gjs_filter_seo_plugin_metadesc', 99 );
function gjs_filter_seo_plugin_metadesc( $desc ) {
	if ( !empty($desc) ) {
		return $desc; // Keep custom description entered in plugin
	}
	$fallback = gjs_get_fallback_meta_description();
	return !empty($fallback) ? $fallback : $desc;
}

// Hook into wp_head buffer to ensure exactly ONE <meta name="description"> tag is printed
add_action( 'wp_head', 'gjs_start_head_buffer', 0 );
function gjs_start_head_buffer() {
	ob_start();
}

add_action( 'wp_head', 'gjs_end_head_buffer', 9999 );
function gjs_end_head_buffer() {
	$content = ob_get_clean();

	// Check existing meta description tags in wp_head
	if ( preg_match_all('/<meta\s+name=["\']description["\'][^>]*>/i', $content, $matches) ) {
		// If multiple meta descriptions exist, deduplicate and keep only the last one
		if ( count($matches[0]) > 1 ) {
			$keep_tag = end($matches[0]);
			$content = preg_replace('/<meta\s+name=["\']description["\'][^>]*>/i', '', $content);
			$content = "    " . $keep_tag . "\n" . $content;
		}
	} else {
		// If NO meta description was output by plugins, output our single fallback tag
		$desc = gjs_get_fallback_meta_description();
		if ( !empty($desc) ) {
			$meta_tag = '<meta name="description" content="' . esc_attr($desc) . '" />';
			$content = "    " . $meta_tag . "\n" . $content;
		}
	}

	echo $content;
}

/**
 * Enqueue scripts and styles.
 */
function cobain_scripts() {
	// CSS
	wp_enqueue_style( 'cobain-preload', get_template_directory_uri() . '/css/preload2.min.css', array(), '4.0.0' );
	wp_enqueue_style( 'cobain-icomoon', get_template_directory_uri() . '/css/icomoon.css', array(), '4.0.0' );
	wp_enqueue_style( 'cobain-libs', get_template_directory_uri() . '/css/libs.min.css', array(), '4.0.0' );
		
	// Theme stylesheet
	wp_enqueue_style( 'cobain-style', get_stylesheet_uri(), array(), '4.0.0' );

	// JS
	wp_enqueue_script( 'cobain-common', get_template_directory_uri() . '/js/common.min.js', array(), '4.0.0', true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cobain_scripts' );













function get_demo_post_url() {
    $recent = wp_get_recent_posts(array('numberposts' => 1, 'post_status' => 'publish'));
    if (count($recent) > 0) {
        return get_permalink($recent[0]['ID']);
    }
    return home_url('/');
}


// Disable WordPress Admin Bar for all users on frontend
add_filter('show_admin_bar', '__return_false');

function cobain_custom_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    $is_reply = $depth > 1 ? 'data-type="reply"' : '';
    ?>
    <li class="list-item" <?php echo $is_reply; ?> id="comment-<?php comment_ID(); ?>">
        <div class="comment-card">
            <div class="avatar" style="width: 44px; height: 44px; min-width: 44px; border-radius: 50%; overflow: hidden;">
                <?php echo get_avatar($comment, 44, '', '', array('class' => 'lazy', 'style' => 'width:100%;height:100%; object-fit: cover;')); ?>
            </div>
            <div class="comment-body" style="flex: 1; min-width: 0;">
                <div class="comment-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                    <span class="author-name" style="font-weight: 700; color: #111; font-size: 15px;"><?php comment_author(); ?></span>
                    <span class="comment-date" style="color: #999; font-size: 12px;"><?php comment_date('d F Y'); ?> &bull; <?php comment_time(); ?></span>
                </div>
                <div class="comment-content" style="color: #333; font-size: 14px; margin-bottom: 12px; line-height: 1.5;">
                    <?php comment_text(); ?>
                </div>
                <div class="comment-footer" style="display: flex; justify-content: flex-end; align-items: center; margin-top: 10px;">
                    <?php comment_reply_link(array_merge($args, array(
                        'reply_text' => '<svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" style="margin-right:4px;"><path d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/></svg> REPLY',
                        'depth'      => $depth,
                        'max_depth'  => $args['max_depth'],
                        'add_below'  => 'comment',
                        'before'     => '<span class="reply-button" style="color: #4CAF50; font-size: 13px; font-weight: 800; display: flex; align-items: center; cursor: pointer; letter-spacing: 0.5px;">',
                        'after'      => '</span>'
                    ))); ?>
                </div>
            </div>
        </div>
    <?php
}
function cobain_pagination($query = null) {
    if (!$query) {
        global $wp_query;
        $query = $wp_query;
    }
    $total_pages = $query->max_num_pages;
    if ($total_pages <= 1) return;
    $current_page = max(1, get_query_var('paged'), get_query_var('page', 1));

    echo '<div class="pagination swiper-controls">';
    
    if ($current_page > 1) {
        echo '<a class="pagination_control swiper-button" href="' . esc_url(get_pagenum_link($current_page - 1)) . '"><i class="icon-arrow_left icon"></i></a>';
    } else {
        echo '<a class="pagination_control swiper-button" aria-disabled="true"><i class="icon-arrow_left icon"></i></a>';
    }
    
    echo '<ul class="pagination_list">';
    $links = paginate_links(array(
        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format'    => '?paged=%#%',
        'current'   => $current_page,
        'total'     => $total_pages,
        'type'      => 'array',
        'prev_next' => false,
    ));
    if ($links) {
        foreach ($links as $link) {
            $link = str_replace('page-numbers', 'pagination_list-item_link', $link);
            $link = str_replace('<span aria-current="page"', '<a href="#"', $link);
            $link = str_replace('</span>', '</a>', $link);
            echo '<li class="pagination_list-item">' . $link . '</li>';
        }
    }
    echo '</ul>';

    if ($current_page < $total_pages) {
        echo '<a class="pagination_control swiper-button" href="' . esc_url(get_pagenum_link($current_page + 1)) . '"><i class="icon-arrow_right icon"></i></a>';
    } else {
        echo '<a class="pagination_control swiper-button" aria-disabled="true"><i class="icon-arrow_right icon"></i></a>';
    }
    
    echo '</div>';
}
// Function to track post views
function cobain_set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}


// Restrict search results to blog posts only
function cobain_search_filter($query) {
    if ($query->is_search && !is_admin() && $query->is_main_query()) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_action('pre_get_posts', 'cobain_search_filter');

// Register Custom Post Type for Projects
function cobain_register_projects_cpt() {
    $labels = array(
        'name'                  => _x( 'Projects', 'Post Type General Name', 'cobain' ),
        'singular_name'         => _x( 'Project', 'Post Type Singular Name', 'cobain' ),
        'menu_name'             => __( 'Projects', 'cobain' ),
        'add_new'               => __( 'Add New Project', 'cobain' ),
        'add_new_item'          => __( 'Add New Project', 'cobain' ),
        'edit_item'             => __( 'Edit Project', 'cobain' ),
    );
    $args = array(
        'label'                 => __( 'Project', 'cobain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ),
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-building',
        'show_in_nav_menus'     => true,
        'has_archive'           => false,
        'rewrite'               => array( 'slug' => 'project' ),
    );
    register_post_type( 'project', $args );
}
add_action( 'init', 'cobain_register_projects_cpt', 0 );

// Add Meta Boxes for Project Details
function cobain_add_project_meta_boxes() {
    add_meta_box( 'project_details', 'Project Details', 'cobain_project_details_callback', 'project', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'cobain_add_project_meta_boxes' );

function cobain_project_details_callback( $post ) {
    wp_nonce_field( 'cobain_save_project_details', 'cobain_project_details_nonce' );
    $client = get_post_meta( $post->ID, '_project_client', true );
    $location = get_post_meta( $post->ID, '_project_location', true );
    $category = get_post_meta( $post->ID, '_project_category', true );
    $gallery1 = get_post_meta( $post->ID, '_project_gallery_1', true );
    $gallery2 = get_post_meta( $post->ID, '_project_gallery_2', true );
    $gallery3 = get_post_meta( $post->ID, '_project_gallery_3', true );
    $gallery4 = get_post_meta( $post->ID, '_project_gallery_4', true );
    ?>
    <p>
        <label for="project_client"><strong>Client Name:</strong></label><br>
        <input type="text" id="project_client" name="project_client" value="<?php echo esc_attr( $client ); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="project_location"><strong>Location:</strong></label><br>
        <input type="text" id="project_location" name="project_location" value="<?php echo esc_attr( $location ); ?>" style="width:100%;" />
    </p>
    <p>
        <label for="project_category"><strong>Category:</strong></label><br>
        <input type="text" id="project_category" name="project_category" value="<?php echo esc_attr( $category ); ?>" style="width:100%;" />
    </p>
    <hr>
    <h4>Gallery Images (Optional)</h4>
    <p>Upload or select images for the 4-image gallery section.</p>
    <?php for($i=1; $i<=24; $i++): $val = get_post_meta( $post->ID, '_project_gallery_'.$i, true ); ?>
    <p>
        <label><strong>Gallery Image <?php echo $i; ?>:</strong></label><br>
        <input type="text" id="project_gallery_<?php echo $i; ?>" name="project_gallery_<?php echo $i; ?>" value="<?php echo esc_attr( $val ); ?>" style="width:75%;" />
        <input type="button" class="button upload_gallery_btn" data-target="project_gallery_<?php echo $i; ?>" value="Upload / Select" />
    </p>
    <?php endfor; ?>
    
    <script>
    jQuery(document).ready(function($){
        $('.upload_gallery_btn').click(function(e){
            e.preventDefault();
            var target_input = $('#' + $(this).data('target'));
            var custom_uploader = wp.media({
                title: 'Select Gallery Image',
                button: { text: 'Use this image' },
                multiple: false
            }).on('select', function() {
                var attachment = custom_uploader.state().get('selection').first().toJSON();
                target_input.val(attachment.url);
            }).open();
        });
    });
    </script>
    <?php
}

function cobain_save_project_details( $post_id ) {
    if ( ! isset( $_POST['cobain_project_details_nonce'] ) || ! wp_verify_nonce( $_POST['cobain_project_details_nonce'], 'cobain_save_project_details' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['project_client'] ) ) update_post_meta( $post_id, '_project_client', sanitize_text_field( $_POST['project_client'] ) );
    if ( isset( $_POST['project_location'] ) ) update_post_meta( $post_id, '_project_location', sanitize_text_field( $_POST['project_location'] ) );
    if ( isset( $_POST['project_category'] ) ) update_post_meta( $post_id, '_project_category', sanitize_text_field( $_POST['project_category'] ) );
    for($i=1; $i<=24; $i++) {
        if ( isset( $_POST['project_gallery_'.$i] ) ) {
            update_post_meta( $post_id, '_project_gallery_'.$i, esc_url_raw( $_POST['project_gallery_'.$i] ) );
        }
    }
}
add_action( 'save_post', 'cobain_save_project_details' );

// Enqueue Media Uploader for Project Meta Box
function cobain_enqueue_admin_scripts($hook) {
    global $typenow;
    if ($typenow == 'project') {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'cobain_enqueue_admin_scripts');

// ==========================================
// Custom Post Type for Products (GJS Produk)
// ==========================================
function gjs_register_product_cpt() {
    $labels = array(
        'name'                  => 'Produk GJS',
        'singular_name'         => 'Produk',
        'menu_name'             => 'Produk GJS',
        'name_admin_bar'        => 'Produk',
        'add_new'               => 'Tambah Produk Baru',
        'add_new_item'          => 'Tambah Produk Baru',
        'new_item'              => 'Produk Baru',
        'edit_item'             => 'Edit Produk',
        'view_item'             => 'Lihat Produk',
        'all_items'             => 'Semua Produk',
        'search_items'          => 'Cari Produk',
        'not_found'             => 'Tidak ada produk ditemukan.',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,
        'publicly_queryable' => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => false,
        'rewrite'            => false,
        'exclude_from_search'=> true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-cart',
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    );

    register_post_type( 'gjs_produk', $args );

    // Register Category for Products
    $tax_labels = array(
        'name'              => 'Kategori Produk',
        'singular_name'     => 'Kategori Produk',
        'search_items'      => 'Cari Kategori',
        'all_items'         => 'Semua Kategori',
        'parent_item'       => 'Induk Kategori',
        'parent_item_colon' => 'Induk Kategori:',
        'edit_item'         => 'Edit Kategori',
        'update_item'       => 'Update Kategori',
        'add_new_item'      => 'Tambah Kategori Baru',
        'new_item_name'     => 'Nama Kategori Baru',
        'menu_name'         => 'Kategori Produk',
    );

    $tax_args = array(
        'hierarchical'      => true,
        'labels'            => $tax_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'public'            => false,
        'publicly_queryable'=> false,
        'query_var'         => false,
        'rewrite'           => false,
    );

    register_taxonomy( 'kategori_produk', array( 'gjs_produk' ), $tax_args );
}
add_action( 'init', 'gjs_register_product_cpt' );

// Exclude gjs_produk & kategori_produk from XML Sitemaps (Yoast SEO, Rank Math, WordPress Core)
add_filter( 'wpseo_sitemap_exclude_post_type', function( $exclude, $post_type ) {
    if ( $post_type === 'gjs_produk' ) return true;
    return $exclude;
}, 10, 2 );

add_filter( 'wpseo_sitemap_exclude_taxonomy', function( $exclude, $tax ) {
    if ( $tax === 'kategori_produk' ) return true;
    return $exclude;
}, 10, 2 );

add_filter( 'wp_sitemaps_post_types', function( $post_types ) {
    unset( $post_types['gjs_produk'] );
    return $post_types;
} );

add_filter( 'wp_sitemaps_taxonomies', function( $taxonomies ) {
    unset( $taxonomies['kategori_produk'] );
    return $taxonomies;
} );

// =========================================================================
// Jetpack & Image Sitemap Filters (Fix 4XX and 3XX entries in image sitemap)
// =========================================================================

// 1. Ensure Jetpack sitemap only includes post, page, project (exclude gjs_produk)
add_filter( 'jetpack_sitemap_post_types', function( $post_types ) {
    if ( is_array( $post_types ) ) {
        $key = array_search( 'gjs_produk', $post_types, true );
        if ( false !== $key ) {
            unset( $post_types[ $key ] );
        }
    }
    return $post_types;
} );

// 2. Filter image attachments in Jetpack image-sitemap-1.xml
// Excludes unattached media (post_parent == 0) and attachments linked to non-public/invalid parents
add_filter( 'jetpack_sitemap_image_skip_post', function( $skip, $post ) {
    if ( $skip ) {
        return true;
    }

    // Skip unattached media (avoids 301 redirecting Attachment Page URLs like /clean_indonesia_map_graphic/)
    if ( empty( $post->post_parent ) || (int) $post->post_parent <= 0 ) {
        return true;
    }

    $parent = get_post( $post->post_parent );
    if ( ! $parent ) {
        return true; // Parent does not exist (avoids 404s like p=319, p=327)
    }

    // Only allow published parents of public post types (post, page, project)
    if ( $parent->post_status !== 'publish' ) {
        return true;
    }

    $allowed_parent_types = array( 'post', 'page', 'project' );
    if ( ! in_array( $parent->post_type, $allowed_parent_types, true ) ) {
        return true; // Excludes gjs_produk and other internal types
    }

    return false;
}, 10, 2 );

// 3. One-time DB cleanup and Jetpack sitemap cache invalidator
add_action( 'init', 'gjs_cleanup_sitemap_attachments_v1' );
function gjs_cleanup_sitemap_attachments_v1() {
    if ( get_option( 'gjs_sitemap_cleaned_v1' ) === 'yes' ) {
        return;
    }

    global $wpdb;

    // A. Detach any media attachment whose post_parent is 319, 327, or any gjs_produk post
    $wpdb->query( "
        UPDATE {$wpdb->posts} 
        SET post_parent = 0 
        WHERE post_type = 'attachment' 
          AND (
            post_parent IN (319, 327) 
            OR post_parent IN (SELECT ID FROM (SELECT ID FROM {$wpdb->posts} WHERE post_type = 'gjs_produk') AS gjs_ids)
          )
    " );

    // B. Delete cached Jetpack sitemap entries so image-sitemap-1.xml regenerates cleanly
    $wpdb->query( "
        DELETE FROM {$wpdb->posts} 
        WHERE post_type IN ('jp_img_sitemap', 'jp_sitemap', 'jp_sitemap_master')
    " );

    // C. Delete any Jetpack sitemap transients
    $wpdb->query( "
        DELETE FROM {$wpdb->options} 
        WHERE option_name LIKE '%jp_sitemap%' 
           OR option_name LIKE '%jetpack_sitemap%'
    " );

    // D. Trigger Jetpack sitemap regeneration hook if available
    if ( function_exists( 'wp_schedule_single_event' ) ) {
        wp_schedule_single_event( time(), 'jp_sitemap_cron_hook' );
    }

    update_option( 'gjs_sitemap_cleaned_v1', 'yes' );
}


// --- GJS Database Migration ---
add_action('init', 'gjs_migrate_customer_to_barcode');
function gjs_migrate_customer_to_barcode() {
    if (get_option('gjs_customer_migrated_v2')) {
        return;
    }
    
    global $wpdb;
    
    // 1. Add new columns to wp_barcode
    $columns = [
        'customer' => 'VARCHAR(255) NULL',
        'phone_customer' => 'VARCHAR(50) NULL',
        'location' => 'TEXT NULL',
        'kota' => 'VARCHAR(100) NULL',
        'provinsi' => 'VARCHAR(100) NULL',
        'kode_pos' => 'VARCHAR(20) NULL'
    ];

    foreach ($columns as $col => $def) {
        $has_col = $wpdb->get_results("SHOW COLUMNS FROM wp_barcode LIKE '$col'");
        if (empty($has_col)) {
            $wpdb->query("ALTER TABLE wp_barcode ADD COLUMN $col $def");
        }
    }

    // 2. Migrate existing data from wp_customer
    $has_customer_table = $wpdb->get_results("SHOW TABLES LIKE 'wp_customer'");
    if (!empty($has_customer_table)) {
        $customers = $wpdb->get_results("SELECT * FROM wp_customer");
        if ($customers) {
            foreach ($customers as $c) {
                // Ignore missing columns safely if they were already dropped
                $nama = isset($c->nama) ? $c->nama : '';
                $phone = isset($c->phone) ? $c->phone : '';
                $alamat = isset($c->alamat) ? $c->alamat : '';
                $kota = isset($c->kota) ? $c->kota : '';
                $provinsi = isset($c->provinsi) ? $c->provinsi : '';
                $kode_pos = isset($c->kode_pos) ? $c->kode_pos : '';

                $wpdb->update('wp_barcode', [
                    'customer' => $nama,
                    'phone_customer' => $phone,
                    'location' => $alamat,
                    'kota' => $kota,
                    'provinsi' => $provinsi,
                    'kode_pos' => $kode_pos
                ], ['customerid' => $c->customerid]);
            }
        }
        
        // 3. Drop the table
        $wpdb->query("DROP TABLE wp_customer");
    }

    update_option('gjs_customer_migrated_v2', true);
}

// Run DB migration for SPK format conversion
add_action('init', 'gjs_migrate_spk_format');
function gjs_migrate_spk_format() {
    if (get_option('gjs_spk_format_migrated') !== 'yes') {
        global $wpdb;
        $table_barcode = 'wp_barcode';
        $rows = $wpdb->get_results("SELECT BarcodeID, SPKID FROM $table_barcode WHERE SPKID LIKE 'SPK-%'");
        foreach ($rows as $row) {
            $num = (int) substr($row->SPKID, 4); // SPK-1 -> 1
            $new_spk = 'P ' . str_pad($num, 4, '0', STR_PAD_LEFT);
            $wpdb->update($table_barcode, array('SPKID' => $new_spk), array('BarcodeID' => $row->BarcodeID));
        }
        update_option('gjs_spk_format_migrated', 'yes');
    }
}


// Fonnte WhatsApp API Helper
function gjs_send_whatsapp($target, $message, $urls = []) {
    if (empty($target)) return false;
    
    $token = 'JFRNjggrHKdXgTzeR38H';
    
    // Clean target number (replace leading 0 with 62)
    $target = preg_replace('/^0/', '62', $target);
    $target = preg_replace('/[^0-9]/', '', $target);

    // If urls is a string, make it an array
    if (!is_array($urls)) {
        $urls = !empty($urls) ? [$urls] : [];
    }
    // Remove empty URLs
    $urls = array_filter($urls);
    $urls = array_values($urls);

    $first_url = isset($urls[0]) ? $urls[0] : '';
    
    $body = array(
        'target' => $target,
        'message' => $message,
    );
    // UNCOMMENT DI BAWAH INI JIKA PAKET FONNTE SUDAH MENDUKUNG MEDIA
    /*
    if (!empty($first_url)) {
        $body['url'] = $first_url;
    }
    */

    wp_remote_post('https://api.fonnte.com/send', array(
        'blocking' => true, 'timeout' => 5, // Asynchronous
        'headers' => array(
            'Authorization' => $token
        ),
        'body' => $body
    ));

    // UNCOMMENT BLOK DI BAWAH INI JIKA INGIN MENGIRIM MULTIPLE FOTO OTOMATIS
    /*
    // Send subsequent images with a delay
    if (count($urls) > 1) {
        for ($i = 1; $i < count($urls); $i++) {
            if (!empty($urls[$i])) {
                wp_remote_post('https://api.fonnte.com/send', array(
                    'blocking' => true, 'timeout' => 5,
                    'headers' => array(
                        'Authorization' => $token
                    ),
                    'body' => array(
                        'target' => $target,
                        'message' => '', 
                        'url' => $urls[$i],
                        'delay' => '2' 
                    )
                ));
            }
        }
    }
    }
    */

}

// SEO URL Routing & 301 Permanent Redirects for 404 & Orphan Prevention
add_action('template_redirect', 'gjs_seo_template_redirects', 1);
function gjs_seo_template_redirects() {
    if (is_admin()) return;

    $req_uri = $_SERVER['REQUEST_URI'] ?? '';
    $req_path = trim(parse_url($req_uri, PHP_URL_PATH) ?? '', '/');
    $home_path = trim(parse_url(home_url(), PHP_URL_PATH) ?? '', '/');
    if (!empty($home_path) && strpos($req_path, $home_path) === 0) {
        $req_path = trim(substr($req_path, strlen($home_path)), '/');
    }

    // 1. Route /product/interior/ and /interior/ automatically to page-product-interior.php with HTTP 200 OK
    if ($req_path === 'product/interior' || $req_path === 'interior') {
        global $wp_query;
        $wp_query->is_404 = false;
        $wp_query->is_page = true;
        status_header(200);
        $interior_template = get_template_directory() . '/page-product-interior.php';
        if (file_exists($interior_template)) {
            include $interior_template;
            exit;
        }
    }

    // 2. 301 Permanent Redirect /team/ to /about/
    if ($req_path === 'team' || preg_match('#^team/?(\?|$)#i', $req_path)) {
        wp_safe_redirect(home_url('/about/'), 301);
        exit;
    }

    // 3. 301 Permanent Redirect all Author Archives (including /author/firbertt/) to Homepage
    if (is_author() || $req_path === 'author' || strpos($req_path, 'author/') === 0) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }

    // 4. 301 Permanent Redirect for unused demo/template pages (/single-project/, /gallery-masonry/, /gallery-grid/)
    $unused_templates = array('single-project', 'gallery-masonry', 'gallery-grid');
    if (in_array($req_path, $unused_templates, true) || is_page($unused_templates)) {
        $target_page = get_page_by_path('projects');
        if (!$target_page) {
            $target_page = get_page_by_path('proyek');
        }
        $target_url = $target_page ? get_permalink($target_page->ID) : home_url('/');
        if (trailingslashit(get_permalink()) !== trailingslashit($target_url)) {
            wp_safe_redirect($target_url, 301);
            exit;
        }
    }

    // 5. 301 Permanent Redirect for ?post_type=gjs_produk (including p=319, p=327) & /item/*
    $post_type = $_GET['post_type'] ?? '';
    $post_id   = isset($_GET['p']) ? intval($_GET['p']) : 0;
    $is_item_path = ($req_path === 'item' || strpos($req_path, 'item/') === 0);

    if ($post_type === 'gjs_produk' || $is_item_path) {
        $target_url = home_url('/product/');

        $cpt_post = null;
        if ($post_id > 0) {
            $cpt_post = get_post($post_id);
        } elseif ($is_item_path) {
            $slug = basename($req_path);
            $posts = get_posts(array(
                'name'        => $slug,
                'post_type'   => 'gjs_produk',
                'numberposts' => 1
            ));
            if (!empty($posts)) {
                $cpt_post = $posts[0];
            }
        }

        if ($cpt_post && $cpt_post->post_status === 'publish') {
            $terms = wp_get_post_terms($cpt_post->ID, 'kategori_produk');
            $cat_slug = !empty($terms) ? $terms[0]->slug : '';
            if (in_array($cat_slug, ['interior', 'interior-design', 'fitting-out'])) {
                $target_url = home_url('/product/interior/?view=single&item=' . $cpt_post->post_name);
            } elseif (in_array($cat_slug, ['upvc'])) {
                $target_url = home_url('/product/upvc/?view=single&item=' . $cpt_post->post_name);
            } elseif (in_array($cat_slug, ['alumunium', 'aluminium'])) {
                $target_url = home_url('/product/alumunium/?view=single&item=' . $cpt_post->post_name);
            } elseif (in_array($cat_slug, ['fasad', 'curtain-wall', 'acp'])) {
                $target_url = home_url('/product/fasad/?view=single&item=' . $cpt_post->post_name);
            } elseif (in_array($cat_slug, ['kaca'])) {
                $target_url = home_url('/product/kaca/?view=single&item=' . $cpt_post->post_name);
            } elseif (in_array($cat_slug, ['besi', 'besi-stainless', 'stainless'])) {
                $target_url = home_url('/product/besi-stainless/?view=single&item=' . $cpt_post->post_name);
            }
        }

        wp_safe_redirect($target_url, 301);
        exit;
    }

    // 6. 301 Permanent Redirect for Crawler/Historical requests to template demo links (*.html & */img/placeholder.jpg)
    if (preg_match('#(?:^|/)img/placeholder\.jpg$#i', $req_path)) {
        wp_safe_redirect(get_template_directory_uri() . '/img/placeholder.jpg', 301);
        exit;
    }

    if (preg_match('#(?:^|/)(?:contacts|kontak)\.html$#i', $req_path)) {
        wp_safe_redirect(home_url('/contacts/'), 301);
        exit;
    }

    if (preg_match('#(?:^|/)(?:about|tentang|team|tim)\.html$#i', $req_path)) {
        wp_safe_redirect(home_url('/about/'), 301);
        exit;
    }

    if (preg_match('#(?:^|/)(?:blog|single-post)\.html$#i', $req_path)) {
        wp_safe_redirect(home_url('/blog/'), 301);
        exit;
    }

    if (preg_match('#(?:^|/)(?:services|single-service)\.html$#i', $req_path)) {
        wp_safe_redirect(home_url('/product/'), 301);
        exit;
    }

    if (preg_match('#(?:^|/)(?:projects|single-project)\.html$#i', $req_path)) {
        wp_safe_redirect(home_url('/projects/'), 301);
        exit;
    }

    if (preg_match('#\.html$#i', $req_path)) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
}

// ============================================================================
// DISABLE JETPACK NOTIFICATIONS & LIKES COOKIE-CHECK (Fix 403 & atob error)
// ============================================================================
add_filter( 'wpl_is_likes_enabled', '__return_false', 999 );
add_action( 'wp_before_admin_bar_render', function() {
    global $wp_admin_bar;
    if ( is_object( $wp_admin_bar ) ) {
        $wp_admin_bar->remove_node( 'notes' );
    }
}, 999 );
add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_script( 'wpcom-notes-admin-bar' );
    wp_dequeue_script( 'jetpack-notes-cookie-check' );
    wp_dequeue_style( 'jetpack_likes' );
}, 999 );

// Move Jetpack Related Posts below Gallery on Single Project pages
add_action( 'wp', function() {
    if ( is_singular( 'project' ) && class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        remove_filter( 'the_content', array( $jprp, 'filter_add_target_to_dom' ), 40 );
    }
}, 20 );



// Load Dynamic Settings for Interior Page (WP Admin > Produk > Pengaturan Interior)
require_once get_template_directory() . '/inc-interior-admin.php';


// ============================================================================
// PENANGANAN SEO ORPHAN PAGES & SITEMAP CLEANUP - GRIYA DJAYA SENTOSA
// ============================================================================

// 1. Set Meta Robots "noindex, nofollow, noarchive" untuk Halaman Internal (/griyadjayamasuk/, /detail-transaksi/)
add_action('wp_head', 'gds_noindex_internal_system_pages', 1);
function gds_noindex_internal_system_pages() {
    $req_uri  = $_SERVER['REQUEST_URI'] ?? '';
    $req_path = trim(parse_url($req_uri, PHP_URL_PATH) ?? '', '/');
    $is_internal = (
        is_page(array('griyadjayamasuk', 'detail-transaksi', 'login', 'portal-karyawan')) ||
        is_page_template(array('page-login.php', 'page-detail-transaksi.php', 'page-employee-dashboard.php')) ||
        in_array($req_path, array('griyadjayamasuk', 'detail-transaksi', 'login'), true)
    );
    if ($is_internal) {
        echo '<meta name="robots" content="noindex, nofollow, noarchive" />' . "\n";
    }
}

// Kompatibilitas filter robots untuk Yoast SEO
add_filter('wpseo_robots', 'gds_yoast_robots_override', 999);
function gds_yoast_robots_override($robots) {
    $req_uri  = $_SERVER['REQUEST_URI'] ?? '';
    $req_path = trim(parse_url($req_uri, PHP_URL_PATH) ?? '', '/');
    if (is_page(array('griyadjayamasuk', 'detail-transaksi')) || in_array($req_path, array('griyadjayamasuk', 'detail-transaksi'), true)) {
        return 'noindex, nofollow';
    }
    return $robots;
}

// Kompatibilitas filter robots untuk Rank Math SEO
add_filter('rank_math/frontend/robots', 'gds_rankmath_robots_override', 999);
function gds_rankmath_robots_override($robots) {
    $req_uri  = $_SERVER['REQUEST_URI'] ?? '';
    $req_path = trim(parse_url($req_uri, PHP_URL_PATH) ?? '', '/');
    if (is_page(array('griyadjayamasuk', 'detail-transaksi')) || in_array($req_path, array('griyadjayamasuk', 'detail-transaksi'), true)) {
        if (is_array($robots)) {
            $robots['index']  = 'noindex';
            $robots['follow'] = 'nofollow';
        } else {
            $robots = 'noindex, nofollow';
        }
    }
    return $robots;
}

// Tambahkan X-Robots-Tag pada HTTP Header untuk halaman internal
add_action('send_headers', 'gds_send_noindex_headers');
function gds_send_noindex_headers() {
    $req_uri  = $_SERVER['REQUEST_URI'] ?? '';
    $req_path = trim(parse_url($req_uri, PHP_URL_PATH) ?? '', '/');
    if (is_page(array('griyadjayamasuk', 'detail-transaksi')) || in_array($req_path, array('griyadjayamasuk', 'detail-transaksi'), true)) {
        header('X-Robots-Tag: noindex, nofollow', true);
    }
}

// 2. Hapus Halaman Sistem & Demo dari XML Sitemap (Yoast, Rank Math, WP Core)
function gds_get_excluded_sitemap_page_ids() {
    $slugs_to_exclude = array(
        'griyadjayamasuk',
        'detail-transaksi',
        'single-project',
        'gallery-masonry',
        'gallery-grid',
    );

    $excluded_ids = array();
    foreach ($slugs_to_exclude as $slug) {
        $page = get_page_by_path($slug);
        if ($page && isset($page->ID)) {
            $excluded_ids[] = (int) $page->ID;
        }
    }
    return $excluded_ids;
}

add_filter('wpseo_exclude_from_sitemap_by_post_ids', 'gds_exclude_pages_from_yoast_sitemap');
function gds_exclude_pages_from_yoast_sitemap($excluded_posts_ids) {
    if (!is_array($excluded_posts_ids)) {
        $excluded_posts_ids = array();
    }
    return array_unique(array_merge($excluded_posts_ids, gds_get_excluded_sitemap_page_ids()));
}

add_filter('rank_math/sitemap/entry', 'gds_exclude_pages_from_rankmath_sitemap', 10, 3);
function gds_exclude_pages_from_rankmath_sitemap($url, $type, $object) {
    if ($type === 'post' && isset($object->ID)) {
        if (in_array((int) $object->ID, gds_get_excluded_sitemap_page_ids(), true)) {
            return false;
        }
    }
    return $url;
}

add_filter('wp_sitemaps_posts_query_args', 'gds_exclude_pages_from_wp_core_sitemap', 10, 2);
function gds_exclude_pages_from_wp_core_sitemap($args, $post_type) {
    if ($post_type === 'page') {
        $excluded_ids = gds_get_excluded_sitemap_page_ids();
        if (!empty($excluded_ids)) {
            $args['post__not_in'] = isset($args['post__not_in'])
                ? array_unique(array_merge($args['post__not_in'], $excluded_ids))
                : $excluded_ids;
        }
    }
    return $args;
}

// 3. Nonaktifkan Author Sitemap (author-sitemap.xml) secara menyeluruh
add_filter('wp_sitemaps_add_provider', function($provider, $name) {
    if ($name === 'users') {
        return false;
    }
    return $provider;
}, 10, 2);

add_filter('wpseo_sitemap_exclude_author', '__return_empty_array');
add_filter('wpseo_Idx_author_sitemap', '__return_false');
add_filter('rank_math/sitemap/author/exclude', '__return_true');
