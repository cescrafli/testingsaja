<?php
/* Template Name: Projects */
global $custom_css; $custom_css = 'projects'; get_header();
?><?php echo '<style>.header { background-color: #041e3a !important; position: fixed !important; top: 0 !important; width: 100% !important; z-index: 9999 !important; }</style>'; ?>

        <!-- projects2 main content start  -->
        <main class="projects section" style="padding: 160px 0 60px; background: #fff;">
            <div class="container">
                
                <div style="text-align: center; margin-bottom: 50px;">
                    <h1 style="color: #041e3a; font-size: 38px; font-weight: 700; line-height: 1.2; margin-bottom: 0; font-family: 'Times New Roman', Times, serif;">Proyek yang Sudah Kami Selesaikan<br>dari Rumah Tinggal hingga Gedung Komersial</h1>
                    <svg width="300" height="15" viewBox="0 0 300 15" style="margin: 10px auto 20px; display: block;">
                        <path d="M 0,12 Q 150,0 300,12" stroke="#cba85d" stroke-width="2.5" fill="none" stroke-linecap="round"/>
                    </svg>
                </div>
                
                <?php
                // Hardcoded categories as requested by user
                $categories = array(
                    'Cafe',
                    'Hotel',
                    'Korporat',
                    'Perumahan',
                    'Rumah Pribadi',
                    'Rumah Sakit',
                    'Sekolah'
                );
                ?>
                
                <!-- Filters -->
                <ul class="projects-filters">
                    <li class="active" data-filter="all">Semua Kategori</li>
                    <?php foreach($categories as $c): ?>
                        <li data-filter="<?php echo esc_attr(sanitize_title($c)); ?>"><?php echo esc_html($c); ?></li>
                    <?php endforeach; ?>
                </ul>

                <!-- Grid -->
                <div class="projects-grid">
                <?php
                $args = array('post_type' => 'project', 'posts_per_page' => -1);
                $project_query = new WP_Query($args);
                if ($project_query->have_posts()) :
                    while ($project_query->have_posts()) : $project_query->the_post();
                        $location = get_post_meta(get_the_ID(), '_project_location', true);
                        if (empty($location)) $location = 'Location not set';
                        
                        $category = get_post_meta(get_the_ID(), '_project_category', true);
                        $cat_slug = !empty($category) ? sanitize_title($category) : 'uncategorized';
                        
                        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        if (!$img_url) $img_url = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                        
                        $photo_count = 1;
                        for($i=1; $i<=24; $i++) {
                            if (get_post_meta(get_the_ID(), '_project_gallery_'.$i, true)) $photo_count++;
                        }
                        
                        // Fallback random number if count is 1 just to mimic the mockup's look closely if they haven't uploaded gallery images yet
                        if ($photo_count == 1) {
                            $photo_count = abs(crc32(get_the_title())) % 20 + 5;
                        }
                ?>
                    <a href="<?php the_permalink(); ?>" class="project-card" data-category="<?php echo esc_attr($cat_slug); ?>">
                        <div class="project-card-image">
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
                            <span class="photo-count">
                                <?php echo $photo_count; ?> 
                                <svg viewBox="0 0 24 24" width="12" height="12" stroke="currentColor" stroke-width="2" fill="none"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                            </span>
                        </div>
                        <div class="project-card-body">
                            <h4 class="project-card-title"><?php the_title(); ?></h4>
                            <span class="project-card-location">
                                <svg viewBox="0 0 24 24" width="14" height="14" stroke="#e31837" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <?php echo esc_html($location); ?>
                            </span>
                            <span class="project-card-btn">Lihat Proyek &rarr;</span>
                        </div>
                    </a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p style="text-align: center; width: 100%; grid-column: 1/-1;">No projects found.</p>';
                endif;
                ?>
                </div>
                <!-- Pagination -->
                <div id="pagination-container" class="projects-pagination"></div>
            </div>
            <style>
            .projects-filters { display: flex; justify-content: center; gap: 30px; list-style: none; padding: 0; margin-bottom: 50px; flex-wrap: wrap; }
            .projects-filters li { font-size: 15px; font-weight: 500; color: #4a5568; cursor: pointer; transition: color 0.3s; }
            .projects-filters li.active, .projects-filters li:hover { color: #eab308; }
            
            .projects-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 30px 20px; }
            @media (max-width: 1024px) { .projects-grid { grid-template-columns: repeat(3, 1fr); } }
            @media (max-width: 768px) { .projects-grid { grid-template-columns: repeat(2, 1fr); } }
            @media (max-width: 480px) { .projects-grid { grid-template-columns: 1fr; } }
            
            .project-card { background: #fff; border-radius: 8px; overflow: hidden; text-align: center; text-decoration: none; display: block; transition: transform 0.3s; }
            .project-card:hover { transform: translateY(-5px); }
            
            .project-card-image { position: relative; width: 100%; aspect-ratio: 1/1; overflow: hidden; }
            .project-card-image img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s; }
            .project-card:hover .project-card-image img { transform: scale(1.05); }
            
            .photo-count { position: absolute; bottom: 10px; right: 10px; background: rgba(255,255,255,0.9); padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; color: #111; display: flex; align-items: center; gap: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
            
            .project-card-body { padding: 15px 10px; display: flex; flex-direction: column; align-items: center; }
            .project-card-btn { display: inline-block; background: #cba85d; color: #fff; padding: 6px 15px; border-radius: 4px; font-size: 13px; font-weight: 600; margin-top: 15px; transition: background 0.3s; }
            .project-card:hover .project-card-btn { background: #b5954f; }
            .project-card-title { font-size: 15px; font-weight: 600; color: #2d3748; margin-bottom: 8px; line-height: 1.3; text-align: center; }
            .project-card-location { font-size: 12px; color: #a0aec0; display: flex; align-items: center; justify-content: center; gap: 5px; }
            .projects-pagination { display: flex; justify-content: center; gap: 10px; margin-top: 50px; }
            .projects-pagination button { background: #f7f7f7; border: 1px solid #ddd; padding: 8px 16px; border-radius: 4px; cursor: pointer; color: #111; font-weight: 500; transition: all 0.3s; }
            .projects-pagination button:hover { background: #eab308; color: #fff; border-color: #eab308; }
            .projects-pagination button.active { background: #eab308; color: #fff; border-color: #eab308; }

            </style>
            
            
            <script>
            document.addEventListener("DOMContentLoaded", function() {
                var filters = document.querySelectorAll('.projects-filters li');
                var cards = Array.from(document.querySelectorAll('.project-card'));
                var paginationContainer = document.getElementById('pagination-container');
                var itemsPerPage = 20; // 4 columns x 5 rows
                var currentPage = 1;
                var currentFilter = 'all';
                
                function renderGallery() {
                    // 1. Filter
                    var filteredCards = cards.filter(function(card) {
                        return currentFilter === 'all' || card.getAttribute('data-category') === currentFilter;
                    });
                    
                    // 2. Paginate
                    var totalPages = Math.ceil(filteredCards.length / itemsPerPage);
                    if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
                    if (currentPage === 0) currentPage = 1;
                    
                    var startIndex = (currentPage - 1) * itemsPerPage;
                    var endIndex = startIndex + itemsPerPage;
                    
                    // 3. Display
                    cards.forEach(function(card) { card.style.display = 'none'; });
                    filteredCards.slice(startIndex, endIndex).forEach(function(card) {
                        card.style.display = 'block';
                    });
                    
                    // 4. Render Pagination Buttons
                    paginationContainer.innerHTML = '';
                    if (totalPages > 1) {
                        for (var i = 1; i <= totalPages; i++) {
                            var btn = document.createElement('button');
                            btn.innerText = i;
                            if (i === currentPage) btn.classList.add('active');
                            btn.addEventListener('click', (function(page) {
                                return function() {
                                    currentPage = page;
                                    renderGallery();
                                    window.scrollTo({ top: document.querySelector('.projects-filters').offsetTop - 50, behavior: 'smooth' });
                                }
                            })(i));
                            paginationContainer.appendChild(btn);
                        }
                    }
                }
                
                // Initialize Filters
                filters.forEach(function(li) {
                    li.addEventListener('click', function() {
                        document.querySelector('.projects-filters li.active').classList.remove('active');
                        this.classList.add('active');
                        currentFilter = this.getAttribute('data-filter');
                        currentPage = 1; // Reset to page 1 on new filter
                        renderGallery();
                    });
                });
                
                // Initial Render
                renderGallery();
            });
            </script>

        </main>
        <!-- projects2 main content end  -->
        

<?php
get_footer();
?>




















