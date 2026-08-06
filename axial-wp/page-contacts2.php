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
                        <form
                            action="form.php"
                            class="contact_form contact-form d-flex flex-wrap justify-content-between"
                            method="POST"
                            name="feedbackForm"
                            data-type="feedback"
                        >
                            <input
                                class="contact-form_field contact-form_field--half field required"
                                name="feedbackName"
                                id="feedbackName"
                                type="text"
                                placeholder="Full name"
                            />
                            <input
                                class="contact-form_field contact-form_field--half field required"
                                data-type="tel"
                                type="text"
                                name="feedbackTel"
                                id="feedbackTel"
                                placeholder="Phone"
                            />
                            <input
                                class="contact-form_field field required"
                                data-type="email"
                                type="text"
                                name="feedbackEmail"
                                id="feedbackEmail"
                                placeholder="Email Address"
                            />
                            <textarea
                                class="contact-form_field field required"
                                data-type="message"
                                name="feedbackMessage"
                                id="feedbackMessage"
                                placeholder="Message"
                            ></textarea>
                            <button type="submit" class="contact-form_btn btn">Send message</button>
                        </form>
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
