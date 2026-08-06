<?php
/*
Template Name: Faq Page
*/
get_header();
?>
<main>
            <section class="faq section">
                <div class="container">
                    <div class="faq_header section_header">
                        <span class="subtitle">Dealing with your worries</span>
                        <h2 class="title">
                            If Your Question Is Not Here
                            <span class="highlight">Contact Us</span>
                        </h2>
                        <p class="text">
                            Porttitor rhoncus dolor purus non enim praesent elementum facilisis. Nisi scelerisque eu ultrices vitae auctor
                            eu augue ut lectus
                        </p>
                        <div class="wrapper">
                            <a class="btn" href="contacts.html">Contact Us</a>
                        </div>
                    </div>
                    <div class="faq_accordion" id="faq_accordion">
                        <div class="faq_accordion-item">
                            <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true">
                                <span class="question h5">Where is Company Located?</span>
                                <span class="icon">
                                    <i class="icon icon-plus"></i>
                                    <i class="icon icon-minus"></i>
                                </span>
                            </button>
                            <div id="collapseThree" class="collapse show" data-bs-parent="#faq_accordion">
                                <div class="content">
                                    <p class="text">
                                        Condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Non quam lacus
                                        suspendisse faucibus interdum posuere lorem. Ut diam quam nulla porttitor.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="faq_accordion-item">
                            <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false">
                                <span class="question h5">What is a Structural Engineer?</span>
                                <span class="icon">
                                    <i class="icon icon-plus"></i>
                                    <i class="icon icon-minus"></i>
                                </span>
                            </button>
                            <div id="collapseOne" class="collapse" data-bs-parent="#faq_accordion">
                                <div class="content">
                                    <p class="text">
                                        Condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Non quam lacus
                                        suspendisse faucibus interdum posuere lorem. Ut diam quam nulla porttitor massa id neque aliquam
                                        vestibulum. Mattis rhoncus urna neque viverra justo nec ultrices dui sapien
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="faq_accordion-item">
                            <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false">
                                <span class="question h5">What are the Service Provided by Company?</span>
                                <span class="icon">
                                    <i class="icon icon-plus"></i>
                                    <i class="icon icon-minus"></i>
                                </span>
                            </button>
                            <div id="collapseTwo" class="collapse" data-bs-parent="#faq_accordion">
                                <div class="content">
                                    <p class="text">
                                        Condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Non quam lacus
                                        suspendisse faucibus interdum posuere lorem. Ut diam quam nulla porttitor massa id neque aliquam
                                        vestibulum. Mattis rhoncus urna neque viverra justo nec ultrices dui sapien. Ut diam quam nulla
                                        porttitor massa id neque aliquam vestibulum. Mattis rhoncus urna neque viverra justo nec ultrices
                                        dui sapien
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="faq_accordion-item">
                            <button class="trigger" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false">
                                <span class="question h5">How Long Does It Take to Build a House?</span>
                                <span class="icon">
                                    <i class="icon icon-plus"></i>
                                    <i class="icon icon-minus"></i>
                                </span>
                            </button>
                            <div id="collapseFour" class="collapse" data-bs-parent="#faq_accordion">
                                <div class="content">
                                    <p class="text">
                                        Condimentum id venenatis a condimentum vitae sapien pellentesque habitant. Non quam lacus
                                        suspendisse faucibus interdum posuere lorem. Ut diam quam nulla porttitor massa id neque aliquam
                                        vestibulum. Mattis rhoncus urna neque viverra justo nec ultrices dui sapien. Ut diam quam nulla
                                        porttitor massa
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="gallery presentation" data-role="gallery">
                <div class="gallery_item">
                    <a
                        class="media"
                        href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                        data-caption="Fresh Concept Construction Renovation"
                        data-role="gallery-link"
                    >
                        <picture>
                            <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                            <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="@@caption" />
                        </picture>
                        <div class="overlay">
                            <div class="overlay_header section_header">
                                <span class="subtitle">Our gallery</span>
                            </div>

                            <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                            <span class="overlay_label">Special Projects</span>
                        </div>
                    </a>
                </div>

                <div class="gallery_item">
                    <a
                        class="media"
                        href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                        data-caption="Fresh Concept Construction Renovation"
                        data-role="gallery-link"
                    >
                        <picture>
                            <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                            <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="@@caption" />
                        </picture>
                        <div class="overlay">
                            <div class="overlay_header section_header">
                                <span class="subtitle">Our gallery</span>
                            </div>

                            <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                            <span class="overlay_label">Special Projects</span>
                        </div>
                    </a>
                </div>

                <div class="gallery_item">
                    <a
                        class="media"
                        href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                        data-caption="Fresh Concept Construction Renovation"
                        data-role="gallery-link"
                    >
                        <picture>
                            <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                            <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="@@caption" />
                        </picture>
                        <div class="overlay">
                            <div class="overlay_header section_header">
                                <span class="subtitle">Our gallery</span>
                            </div>

                            <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                            <span class="overlay_label">Special Projects</span>
                        </div>
                    </a>
                </div>

                <div class="gallery_item">
                    <a
                        class="media"
                        href="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg"
                        data-caption="Fresh Concept Construction Renovation"
                        data-role="gallery-link"
                    >
                        <picture>
                            <source data-srcset="img/placeholder.jpg" srcset="img/placeholder.jpg" type="image/webp" />
                            <img class="lazy" data-src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" src="<?php echo get_template_directory_uri(); ?>/img/placeholder.jpg" alt="@@caption" />
                        </picture>
                        <div class="overlay">
                            <div class="overlay_header section_header">
                                <span class="subtitle">Our gallery</span>
                            </div>

                            <h4 class="overlay_caption">Fresh Concept Construction Renovation</h4>
                            <span class="overlay_label">Special Projects</span>
                        </div>
                    </a>
                </div>
            </div>
            <section class="contact section">
                <div class="container">
                    <div class="contact_form">
                        <div class="contact_form-header section_header">
                            <span class="subtitle">Contact us</span>
                            <h2 class="title">
                                Do You Have any
                                <span class="highlight">Questions?</span>
                            </h2>
                        </div>
                        <?php echo do_shortcode('[contact-form-7 id="87e6ad6" title="Contact form 1"]'); ?>
                    </div>
                    <div class="contact_info">
                        <h3 class="contact_info-header">Are You Going to Implement Project?</h3>
                        <ul class="contact-info">
                            <li class="contact-info_group">
                                <span class="name">Address</span>
                                <span class="content">2047 Cyrus Viaduct East Jadynchester</span>
                            </li>
                            <li class="contact-info_group">
                                <span class="name">Email</span>
                                <span class="content d-inline-flex flex-column">
                                    <a class="link" href="mailto:example.com">info@construct.com</a>
                                    <a class="link" href="mailto:example.com">support@construct.com</a>
                                </span>
                            </li>
                            <li class="contact-info_group">
                                <span class="name">Phone</span>
                                <span class="content d-inline-flex flex-column">
                                    <a class="link" href="tel:+13136453395">1 - 313 - 645 - 3395</a>
                                    <a class="link" href="tel:+14699702609">1 - 469 - 970 - 2609</a>
                                </span>
                            </li>
                        </ul>
                        <ul class="socials">
                            <li class="socials_item">
                                <a class="socials_item-link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                    <i class="icon-facebook"></i>
                                </a>
                            </li>
                            <li class="socials_item">
                                <a class="socials_item-link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                    <i class="icon-instagram"></i>
                                </a>
                            </li>
                            <li class="socials_item">
                                <a class="socials_item-link" href="#" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                                    <i class="icon-twitter"></i>
                                </a>
                            </li>
                            <li class="socials_item">
                                <a class="socials_item-link" href="#" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
                                    <i class="icon-whatsapp"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </main>
<?php get_footer(); ?>

