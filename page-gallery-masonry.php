<?php
/* Template Name: Gallery Masonry */
global $custom_css; $custom_css = 'gallery-masonry'; get_header();
?><header class="page primary-bg">
            <div class="container">
                <div class="section_header">
                    <span class="subtitle subtitle--extended">Project details</span>
                    <h1 class="title">Gallery Masonry</h1>
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs_item">
                            <a href="<?php echo home_url('/'); ?>">Home</a>
                        </li>

                        <li class="breadcrumbs_item breadcrumbs_item--current">
                            <span>Gallery</span>
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
        <!-- gallery masonry content start -->
        <main class="gallery section">
            <div class="container">
                <ul class="gallery_filters">
                    <li class="list-item">
                        <a data-target="all" class="gallery_filters-filter current" href="#">All</a>
                    </li>
                    <li class="list-item">
                        <a data-target="construction" class="gallery_filters-filter" href="#">Construction</a>
                    </li>
                    <li class="list-item">
                        <a data-target="electrical" class="gallery_filters-filter" href="#">Electrical</a>
                    </li>
                    <li class="list-item">
                        <a data-target="process" class="gallery_filters-filter" href="#">Process</a>
                    </li>
                    <li class="list-item">
                        <a data-target="chemistry" class="gallery_filters-filter" href="#">Chemistry</a>
                    </li>
                    <li class="list-item">
                        <a data-target="metallurgy" class="gallery_filters-filter" href="#">Metallurgy</a>
                    </li>
                    <li class="list-item">
                        <a data-target="special" class="gallery_filters-filter" href="#">Special Projects</a>
                    </li>
                </ul>
                <div class="gallery_masonry" data-role="gallery">
                    <figure class="gallery_masonry-item" data-groups='["construction", "metallurgy"]'>
                        <a class="aspect aspect--1x1" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["special", "electrical"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["chemistry", "process", "metallurgy"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["construction"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["construction"]'>
                        <a class="aspect aspect--1x1" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["construction"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["chemistry", "special", "construction", "electrical"]'>
                        <a class="aspect aspect--1x1" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["chemistry", "process", "electrical"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["chemistry", "process", "construction"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>
                </div>
            </div>
        </main>
        <!-- gallery masonry content end -->
        

<?php
get_footer();
?>




















