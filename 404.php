<?php
/* Template Name: 404 */
global $custom_css; $custom_css = 'error'; get_header();
?>
<!-- page 404 content start -->
<main class="error">
    <div class="container">
        <span class="error_number">404</span>
        <div class="error_message">
            <div class="error_message-header">
                <span class="subtitle">Ups!</span>
                <h3 class="title">Halaman Tidak Ditemukan</h3>
            </div>
            <p class="error_message-text">Maaf, halaman yang Anda cari tidak dapat ditemukan. Silakan kembali ke beranda atau hubungi kami.</p>
            <a class="btn" href="<?php echo home_url('/'); ?>">Kembali ke Beranda</a>
        </div>
    </div>
</main>
<!-- page 404 content end -->
<?php
get_footer();
?>
