<?php
/*
Template Name: Contact Page
*/
get_header();
?>
<main>
            <section class="info section-nopb">
                <div class="container">
                    <div class="info_data">
                        <div class="info_header section_header">
                            <span class="subtitle" data-aos="fade-right">Contact us</span>
                            <h2 class="title" data-aos="fade-right" data-aos-delay="30">
                                <span class="highlight">Contacts</span> Information
                            </h2>
                        </div>
                        <div class="info_data-card" data-aos="fade-left">
                            <div class="wrapper">
                                <i class="icon-location icon"></i>
                                <h4 class="title">Address</h4>
                                <span class="content">2047 Cyrus Viaduct East Jadynchester</span>
                            </div>
                        </div>
                        <div class="info_data-card" data-aos="fade-left" data-aos-delay="20">
                            <div class="wrapper">
                                <i class="icon-inbox icon"></i>
                                <h4 class="title">Email</h4>
                                <span class="content d-flex flex-column">
                                    <a href="mailto:example.com" class="link">info@construct.com</a>
                                    <a href="mailto:example.com" class="link">support@construct.com</a>
                                </span>
                            </div>
                        </div>
                        <div class="info_data-card" data-aos="fade-left" data-aos-delay="40">
                            <div class="wrapper">
                                <i class="icon-call icon"></i>
                                <h4 class="title">Phone</h4>
                                <span class="content d-flex flex-column">
                                    <a href="tel:+13136453395" class="link">1 - 313 - 645 - 3395</a>
                                    <a href="tel:+14699702609" class="link">1 - 469 - 970 - 2609</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="contacts_map">
                        <div id="map"></div>
                    </div>
                </div>
            </section>
            <section class="partners section">
                <div class="container">
                    <div class="partners_grid">
                        <div class="partners_header section_header">
                            <span class="subtitle">Where we work</span>
                            <h2 class="title"><span class="highlight">Top Ranking</span> Company</h2>
                        </div>
                        <div class="partners_grid-card" data-aos="fade-up">
                            <img class="media" src="<?php echo get_template_directory_uri(); ?>/svg/remedy.svg" alt="logo" />
                        </div>
                        <div class="partners_grid-card" data-aos="fade-up">
                            <img class="media" src="<?php echo get_template_directory_uri(); ?>/svg/brickblock.svg" alt="logo" />
                        </div>
                        <div class="partners_grid-card" data-aos="fade-up">
                            <img class="media" src="<?php echo get_template_directory_uri(); ?>/svg/stateofdesign.svg" alt="logo" />
                        </div>
                        <div class="partners_grid-card" data-aos="fade-up">
                            <img class="media" src="<?php echo get_template_directory_uri(); ?>/svg/arup.svg" alt="logo" />
                        </div>
                        <div class="partners_grid-card" data-aos="fade-up">
                            <img class="media" src="<?php echo get_template_directory_uri(); ?>/svg/fluor.svg" alt="logo" />
                        </div>
                    </div>
                </div>
            </section>
        </main>
<?php get_footer(); ?>
