<?php
/*
Template Name: Gallery Masonry Page
*/
get_header();
?>
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
                        <a class="aspect aspect--1x1" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["special", "electrical"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["chemistry", "process", "metallurgy"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["construction"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["construction"]'>
                        <a class="aspect aspect--1x1" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["construction"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["chemistry", "special", "construction", "electrical"]'>
                        <a class="aspect aspect--1x1" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["chemistry", "process", "electrical"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
                                </picture>
                            </div>
                            <div class="overlay">
                                <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                                <span class="overlay_label">Special Projects</span>
                            </div>
                        </a>
                    </figure>

                    <figure class="gallery_masonry-item" data-groups='["chemistry", "process", "construction"]'>
                        <a class="aspect aspect--13x9" href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" data-caption="Image caption" data-role="gallery-link">
                            <div class="aspect__inner">
                                <picture>
                                    <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                                    <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="Image caption" />
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
<?php get_footer(); ?>
