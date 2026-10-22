<?php
/* Template Name: Projects2 */
global $custom_css; $custom_css = 'projects2'; get_header();
?><header class="page primary-bg">
            <div class="container">
                <div class="section_header">
                    <span class="subtitle subtitle--extended">Building communities</span>
                    <h1 class="title">Our Projects</h1>
                    <ul class="breadcrumbs">
                        <li class="breadcrumbs_item">
                            <a href="<?php echo home_url('/'); ?>">Home</a>
                        </li>

                        <li class="breadcrumbs_item breadcrumbs_item--current">
                            <span>Our Projects</span>
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
        <!-- projects2 content start  -->
        <main class="projects section">
            <div class="container">
                <ul class="projects_list"><?php
                $args = array('post_type' => 'project', 'posts_per_page' => -1);
                $project_query = new WP_Query($args);
                if ($project_query->have_posts()) :
                    while ($project_query->have_posts()) : $project_query->the_post();
                        $location = get_post_meta(get_the_ID(), '_project_location', true);
                        if (empty($location)) $location = 'Location not set';
                        $img_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: get_the_post_thumbnail_url(get_the_ID(), 'full');
                        if (!$img_url) $img_url = get_template_directory_uri() . '/img/placeholder.jpg?v=2';
                ?>
                    <li class="projects_list-item">
                        <div class="media" data-aos="zoom-in-right">
                            <picture>
                                <source data-srcset="<?php echo esc_url($img_url); ?>" srcset="<?php echo esc_url($img_url); ?>" />
                                <img class="lazy" data-src="<?php echo esc_url($img_url); ?>" src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" />
                            </picture>
                        </div>
                        <div class="main">
                            <h3 class="main_title" data-aos="fade-in">
                                <span class="text"><?php the_title(); ?></span>
                                <span class="divider divider--line" data-aos="slide-right"></span>
                            </h3>
                            <div class="main_info">
                                <span class="location" data-aos="fade-in" data-aos-delay="50">
                                    <i class="icon-location icon"></i>
                                    <?php echo esc_html($location); ?>
                                </span>
                                <a class="link link-arrow" href="<?php the_permalink(); ?>" data-aos="fade-in" data-aos-delay="50">
                                    Details
                                    <i class="icon-arrow_right icon"></i>
                                </a>
                            </div>
                        </div>
                    </li>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <li class="projects_list-item">
                        <div class="media" data-aos="zoom-in-right">
                            <picture>
                                <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                <img
                                    class="lazy"
                                    data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"
                                    src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"
                                    alt="Food Factory Design and Construction"
                                />
                            </picture>
                        </div>
                        <div class="main">
                            <div class="main_info">
                                <span class="location" data-aos="fade-up">
                                    <i class="icon-location icon"></i> Karli Turnpike Apt. 993 Port
                                </span>
                            </div>
                            <h3 class="main_title" data-aos="fade-up" data-aos-delay="50">Food Factory Design and Construction</h3>
                            <p class="main_text" data-aos="fade-up" data-aos-delay="100">
                                Elit scelerisque mauris pellentesque pulvinar. Mattis aliquam faucibus purus in massa tempor. Diam phasellus
                                vestibulum lorem sed risus ultricies. Nisi scelerisque eu ultrices vitae auctor eu augue ut. Et sollicitudin
                                ac orci phasellus egestas tellus rutrum tellus
                            </p>
                            <a class="link link-arrow" href="<?php echo home_url('/single-project/?id=1'); ?>" data-aos="fade-in" data-aos-delay="50">
                                Details <i class="icon-arrow_right icon"></i>
                            </a>
                        </div>
                    </li>
                    <li class="projects_list-item">
                        <div class="media" data-aos="zoom-in-right">
                            <picture>
                                <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                <img
                                    class="lazy"
                                    data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"
                                    src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"
                                    alt="Fresh Concept Construction Renovation"
                                />
                            </picture>
                        </div>
                        <div class="main">
                            <div class="main_info">
                                <span class="location" data-aos="fade-up">
                                    <i class="icon-location icon"></i> Daphne Way New Reaganmouth
                                </span>
                            </div>
                            <h3 class="main_title" data-aos="fade-up" data-aos-delay="50">Fresh Concept Construction Renovation</h3>
                            <p class="main_text" data-aos="fade-up" data-aos-delay="100">
                                Vel orci porta non pulvinar neque laoreet. Erat velit scelerisque in dictum non consectetur a. Mus mauris
                                vitae ultricies leo. Malesuada fames ac turpis egestas maecenas pharetra. Adipiscing tristique risus nec
                                feugiat in
                            </p>
                            <a class="link link-arrow" href="<?php echo home_url('/single-project/?id=2'); ?>" data-aos="fade-in" data-aos-delay="50">
                                Details <i class="icon-arrow_right icon"></i>
                            </a>
                        </div>
                    </li>
                    <li class="projects_list-item">
                        <div class="media" data-aos="zoom-in-right">
                            <picture>
                                <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                <img
                                    class="lazy"
                                    data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"
                                    src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"
                                    alt="Jazzy Elite Construction Shopping Center"
                                />
                            </picture>
                        </div>
                        <div class="main">
                            <div class="main_info">
                                <span class="location" data-aos="fade-up">
                                    <i class="icon-location icon"></i> 100 Sunrise Ct Hamel, Minnesota
                                </span>
                            </div>
                            <h3 class="main_title" data-aos="fade-up" data-aos-delay="50">Jazzy Elite Construction Shopping Center</h3>
                            <p class="main_text" data-aos="fade-up" data-aos-delay="100">
                                Euismod elementum nisi quis eleifend quam adipiscing vitae proin. Consectetur purus ut faucibus pulvinar
                                elementum integer. Cursus in hac habitasse platea dictumst quisque. Ut tortor pretium viverra suspendisse
                                potenti nullam ac tortor
                            </p>
                            <a class="link link-arrow" href="<?php echo home_url('/single-project/?id=3'); ?>" data-aos="fade-in" data-aos-delay="50">
                                Details <i class="icon-arrow_right icon"></i>
                            </a>
                        </div>
                    </li>
                    <li class="projects_list-item">
                        <div class="media" data-aos="zoom-in-right">
                            <picture>
                                <source data-srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2" srcset="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"  />
                                <img
                                    class="lazy"
                                    data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"
                                    src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg?v=2"
                                    alt="Installation and Creation of a Water Supply System"
                                />
                            </picture>
                        </div>
                        <div class="main">
                            <div class="main_info">
                                <span class="location" data-aos="fade-up">
                                    <i class="icon-location icon"></i> Schoen Ramp Suite 607 Borerton
                                </span>
                            </div>
                            <h3 class="main_title" data-aos="fade-up" data-aos-delay="50">
                                Installation and Creation of a Water Supply System
                            </h3>
                            <p class="main_text" data-aos="fade-up" data-aos-delay="100">
                                Tortor id aliquet lectus proin nibh. Amet consectetur adipiscing elit pellentesque habitant morbi tristique
                                senectus et. Purus in mollis nunc sed id semper risus in hendrerit. Morbi tristique senectus et netus et
                                malesuada
                            </p>
                            <a class="link link-arrow" href="<?php echo home_url('/single-project/?id=4'); ?>" data-aos="fade-in" data-aos-delay="50">
                                Details <i class="icon-arrow_right icon"></i>
                            </a>
                        </div>
                    </li>
                <?php endif; ?></ul>
            </div>
        </main>
        <!-- projects2 content end  -->
        

<?php
get_footer();
?>




















