<?php
/*
Template Name: Contacts2 Page
*/
get_header();
?>
<main>
            <section class="contact section">
                <div class="container">
                    <div class="main">
                        <div class="contact_header section_header">
                            <span class="subtitle">Contact us</span>
                            <h2 class="title">Get <span class="highlight">In Touch</span></h2>
                            <p class="text">
                                Pellentesque sit amet porttitor eget dolor morbi non arcu. Vitae justo eget magna fermentum iaculis eu non
                            </p>
                        </div>
                        <?php echo do_shortcode('[contact-form-7 id="87e6ad6" title="Contact form 1"]'); ?>
                    </div>
                    <div class="secondary">
                        <ul class="contact_info contact-info">
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
            <div class="contacts_map">
                <div id="map"></div>
            </div>
        </main>
<?php get_footer(); ?>

