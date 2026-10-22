<?php
/* Template Name: Faq */
global $custom_css; $custom_css = 'faq'; get_header();
?><?php get_template_part("template-parts/page-banner"); ?>
            <section class="faq section">
                <div class="container">
                    <div class="faq_header section_header">
                        <span class="subtitle">Pertanyaan yang Sering Diajukan</span>
                        <h2 class="title">
                            Masih Ada yang Ingin Ditanyakan?
                            <span class="highlight">Hubungi Kami</span>
                        </h2>
                        <p class="text">
                            Tim kami siap membantu kebutuhan proyek Anda, dari rumah tinggal hingga gedung komersial.
                        </p>
                        <div class="wrapper">
                            <a class="btn" href="<?php echo home_url('/' . 'contacts' . '/'); ?>">Hubungi Kami</a>
                        </div>
                    </div>
                    <div class="faq_accordion" id="faq_accordion">
                        <div class="faq_accordion-item">
                            <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false">
                                <span class="question h5">Berapa lama estimasi pengerjaan untuk proyek kusen atau fasad?</span>
                                <span class="icon">
                                    <i class="icon icon-plus"></i>
                                    <i class="icon icon-minus"></i>
                                </span>
                            </button>
                            <div id="collapseOne" class="collapse" data-bs-parent="#faq_accordion">
                                <div class="content">
                                    <p class="text">
                                        Estimasi waktu pengerjaan bergantung pada volume pesanan dan tingkat kerumitan desain. Kirimkan gambar kerja atau kebutuhan Anda, dan tim kami akan menyampaikan estimasi waktu yang jelas bersama penawaran.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="faq_accordion-item">
                            <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false">
                                <span class="question h5">Apakah produk UPVC dari Griya Djaya Sentosa bergaransi?</span>
                                <span class="icon">
                                    <i class="icon icon-plus"></i>
                                    <i class="icon icon-minus"></i>
                                </span>
                            </button>
                            <div id="collapseThree" class="collapse" data-bs-parent="#faq_accordion">
                                <div class="content">
                                    <p class="text">
                                        Ya. Produk UPVC kami dilindungi garansi hingga 10 tahun. Garansi ini berlaku khusus untuk produk UPVC. Untuk syarat dan ketentuan lengkapnya, silakan hubungi tim kami.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="faq_accordion-item">
                            <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false">
                                <span class="question h5">Di wilayah mana saja Griya Djaya Sentosa beroperasi?</span>
                                <span class="icon">
                                    <i class="icon icon-plus"></i>
                                    <i class="icon icon-minus"></i>
                                </span>
                            </button>
                            <div id="collapseFour" class="collapse" data-bs-parent="#faq_accordion">
                                <div class="content">
                                    <p class="text">
                                        Kami telah mengerjakan proyek di berbagai lokasi di Indonesia. Sampaikan lokasi proyek Anda, dan tim kami akan mengonfirmasi jangkauan layanan serta pengirimannya.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="faq_accordion-item">
                            <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false">
                                <span class="question h5">Apakah saya bisa memesan desain atau spesifikasi secara custom?</span>
                                <span class="icon">
                                    <i class="icon icon-plus"></i>
                                    <i class="icon icon-minus"></i>
                                </span>
                            </button>
                            <div id="collapseFive" class="collapse" data-bs-parent="#faq_accordion">
                                <div class="content">
                                    <p class="text">
                                        Bisa. Kami mengerjakan desain custom sesuai gambar kerja atau spesifikasi dari arsitek maupun kontraktor, mulai dari pilihan profil, finishing, hingga tipe sistem bukaan.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            // Fetch recent projects to get a variety of images
            $latest_project_args = array(
                'post_type' => 'project',
                'posts_per_page' => 10,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_status' => 'publish'
            );
            $latest_project_query = new WP_Query($latest_project_args);
            
            $projects_images = [];
            if ($latest_project_query->have_posts()) {
                while ($latest_project_query->have_posts()) {
                    $latest_project_query->the_post();
                    $faq_project_title = get_the_title();
                    $imgs = [];
                    for($i=1; $i<=10; $i++) {
                        $img = get_post_meta(get_the_ID(), '_project_gallery_'.$i, true);
                        if ($img) $imgs[] = array('url' => $img, 'caption' => $faq_project_title);
                    }
                    if (!empty($imgs)) {
                        $projects_images[] = $imgs;
                    }
                }
                wp_reset_postdata();
            }
            
            $faq_galleries = [];
            // Round-robin selection: 1st image from Proj A, 1st from Proj B... then 2nd from Proj A, etc.
            for ($image_index = 0; $image_index < 10; $image_index++) {
                foreach ($projects_images as $project_imgs) {
                    if (isset($project_imgs[$image_index])) {
                        $faq_galleries[] = $project_imgs[$image_index];
                        if (count($faq_galleries) >= 4) break 2;
                    }
                }
            }
            
            // Fallback if less than 4 images
            while(count($faq_galleries) < 4) {
                $faq_galleries[] = array(
                    'url' => get_template_directory_uri() . '/img/placeholder.jpg?v=2',
                    'caption' => 'Project Gallery'
                );
            }
            ?>
            <div class="gallery presentation">
                <?php foreach($faq_galleries as $item): 
                    $lightbox_url = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($item['url'], 'lightbox') : $item['url'];
                    $display_url  = function_exists('gjs_get_optimized_image_url') ? gjs_get_optimized_image_url($item['url'], 'large') : $item['url'];
                ?>
                <div class="gallery_item">
                    <a class="media faq-gallery-link" href="<?php echo esc_url($lightbox_url); ?>" data-caption="<?php echo esc_attr($item['caption']); ?>">
                        <picture>
                            <source data-srcset="<?php echo esc_url($display_url); ?>" srcset="<?php echo esc_url($display_url); ?>"  />
                            <img class="lazy" data-src="<?php echo esc_url($display_url); ?>" src="<?php echo esc_url($display_url); ?>" alt="<?php echo esc_attr($item['caption']); ?>" loading="lazy" decoding="async" style="object-fit: cover; width: 100%; height: 100%;" />
                        </picture>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            
            <script>
            // Bulletproof Custom Vanilla Lightbox for FAQ Page
            document.addEventListener("DOMContentLoaded", function() {
                var links = document.querySelectorAll('.faq-gallery-link');
                links.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        var src = this.getAttribute('href');
                        var caption = this.getAttribute('data-caption');
                        
                        var overlay = document.createElement('div');
                        overlay.style.position = 'fixed';
                        overlay.style.top = '0';
                        overlay.style.left = '0';
                        overlay.style.width = '100vw';
                        overlay.style.height = '100vh';
                        overlay.style.backgroundColor = 'rgba(0,0,0,0.9)';
                        overlay.style.zIndex = '999999';
                        overlay.style.display = 'flex';
                        overlay.style.flexDirection = 'column';
                        overlay.style.alignItems = 'center';
                        overlay.style.justifyContent = 'center';
                        overlay.style.cursor = 'pointer';
                        overlay.style.opacity = '0';
                        overlay.style.transition = 'opacity 0.3s ease';
                        
                        var img = document.createElement('img');
                        img.src = src;
                        img.style.maxWidth = '90%';
                        img.style.maxHeight = '80%';
                        img.style.objectFit = 'contain';
                        img.style.boxShadow = '0 5px 25px rgba(0,0,0,0.5)';
                        img.style.borderRadius = '4px';
                        
                        var text = document.createElement('div');
                        text.innerText = caption;
                        text.style.color = '#fff';
                        text.style.marginTop = '20px';
                        text.style.fontSize = '18px';
                        text.style.fontFamily = 'Archivo, sans-serif';
                        text.style.fontWeight = '600';
                        
                        var closeBtn = document.createElement('div');
                        closeBtn.innerHTML = '&times;';
                        closeBtn.style.position = 'absolute';
                        closeBtn.style.top = '20px';
                        closeBtn.style.right = '30px';
                        closeBtn.style.color = '#fff';
                        closeBtn.style.fontSize = '40px';
                        closeBtn.style.lineHeight = '1';
                        
                        overlay.appendChild(img);
                        overlay.appendChild(text);
                        overlay.appendChild(closeBtn);
                        
                        document.body.appendChild(overlay);
                        
                        // Fade in
                        setTimeout(function() { overlay.style.opacity = '1'; }, 10);
                        
                        overlay.addEventListener('click', function() {
                            overlay.style.opacity = '0';
                            setTimeout(function() {
                                if (document.body.contains(overlay)) {
                                    document.body.removeChild(overlay);
                                }
                            }, 300);
                        });
                    });
                });
            });
            </script>
            </main>
<?php
get_footer();
?>














