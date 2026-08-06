<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Home | Axial Construct</title>
        
        
        

        
        <?php wp_head(); ?>
</head>
    <body>
        <header class="header" data-page="home" data-page-parent="home">
            <div class="container d-flex">
                <a class="brand" href="index.html">
                    <img class="brand_logo" src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt="Axial Construct" />
                    <span class="brand_name"> Axial <span class="highlight">Construct</span> </span>
                </a>
                <nav class="header_nav collapse" id="headerMenu">
                    <ul class="header_nav-list">
                        <li class="header_nav-list_item dropdown">
                            <a
                                class="nav-link nav-item dropdown-toggle"
                                href="index.html"
                                data-bs-toggle="collapse"
                                data-bs-target="#homeMenu"
                                data-trigger="dropdown"
                                data-main-link="true"
                                aria-expanded="false"
                                aria-controls="homeMenu"
                                data-page="home"
                                data-page-parent="home"
                            >
                                <span class="nav-item_text"> Home </span>
                                <span class="icon icon-chevron_right"></span>
                            </a>
                            <div class="dropdown-menu collapse" id="homeMenu">
                                <ul class="dropdown-list">
                                    <li class="list-item">
                                        <a class="dropdown-item nav-item" data-page="home" data-page-parent="home" href="index.html">
                                            Home 1
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a class="dropdown-item nav-item" data-page="home2" data-page-parent="home" href="index2.html">
                                            Home 2
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header_nav-list_item">
                            <a class="nav-item nav-link" href="about.html" data-page="about" data-single="true">
                                <span class="nav-item_text">About</span>
                            </a>
                        </li>
                        <li class="header_nav-list_item dropdown">
                            <a
                                class="nav-link nav-item dropdown-toggle"
                                href="services.html"
                                data-bs-toggle="collapse"
                                data-bs-target="#servicesMenu"
                                data-trigger="dropdown"
                                data-page-parent="services"
                                data-main-link="true"
                                aria-expanded="false"
                                aria-controls="servicesMenu"
                            >
                                <span class="nav-item_text"> Services </span>
                                <span class="icon icon-chevron_right"></span>
                            </a>
                            <div class="dropdown-menu collapse" id="servicesMenu">
                                <ul class="dropdown-list">
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="services"
                                            data-page-parent="services"
                                            href="services.html"
                                            data-main="true"
                                        >
                                            Services
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="single-service"
                                            data-page-parent="services"
                                            href="single-service.html"
                                        >
                                            Single Service
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a class="dropdown-item nav-item" data-page="team" data-page-parent="services" href="team.html">
                                            Team
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header_nav-list_item dropdown">
                            <a
                                class="nav-link nav-item dropdown-toggle"
                                href="projects.html"
                                data-bs-toggle="collapse"
                                data-bs-target="#projectsMenu"
                                data-trigger="dropdown"
                                data-page-parent="projects"
                                data-main-link="true"
                                aria-expanded="false"
                                aria-controls="projectsMenu"
                            >
                                <span class="nav-item_text"> Projects </span>
                                <span class="icon icon-chevron_right"></span>
                            </a>
                            <div class="dropdown-menu collapse" id="projectsMenu">
                                <ul class="dropdown-list">
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="projects"
                                            data-page-parent="projects"
                                            href="projects.html"
                                            data-main="true"
                                        >
                                            Projects 1
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="projects2"
                                            data-page-parent="projects"
                                            href="projects2.html"
                                        >
                                            Projects 2
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="single-project"
                                            data-page-parent="projects"
                                            href="single-project.html"
                                        >
                                            Single project
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header_nav-list_item dropdown">
                            <a
                                class="nav-link nav-item dropdown-toggle"
                                href="blog.html"
                                data-bs-toggle="collapse"
                                data-bs-target="#blogMenu"
                                data-trigger="dropdown"
                                data-page-parent="blog"
                                data-main-link="true"
                                aria-expanded="false"
                                aria-controls="blogMenu"
                            >
                                <span class="nav-item_text"> Blog </span>
                                <span class="icon icon-chevron_right"></span>
                            </a>
                            <div class="dropdown-menu collapse" id="blogMenu">
                                <ul class="dropdown-list">
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="blog"
                                            data-page-parent="blog"
                                            href="blog.html"
                                            data-main="true"
                                        >
                                            Blog 1
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a class="dropdown-item nav-item" data-page="blog2" data-page-parent="blog" href="blog2.html">
                                            Blog 2
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="single-post"
                                            data-page-parent="blog"
                                            href="single-post.html"
                                        >
                                            Single post
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="header_nav-list_item dropdown">
                            <a
                                class="nav-link nav-item dropdown-toggle"
                                href="contacts.html"
                                data-bs-toggle="collapse"
                                data-bs-target="#contactsMenu"
                                data-trigger="dropdown"
                                data-page-parent="contacts"
                                data-main-link="true"
                                aria-expanded="false"
                                aria-controls="contactsMenu"
                            >
                                <span class="nav-item_text"> Contacts </span>
                                <span class="icon icon-chevron_right"></span>
                            </a>
                            <div class="dropdown-menu collapse" id="contactsMenu">
                                <ul class="dropdown-list">
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="contacts"
                                            data-page-parent="contacts"
                                            href="contacts.html"
                                            data-main="true"
                                        >
                                            Contacts 1
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="contacts2"
                                            data-page-parent="contacts"
                                            href="contacts2.html"
                                        >
                                            Contacts 2
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="header_nav-list_item dropdown">
                            <a
                                class="nav-link nav-item dropdown-toggle"
                                href="#"
                                data-bs-toggle="collapse"
                                data-bs-target="#pagesMenu"
                                data-trigger="dropdown"
                                data-page-parent="pages"
                                aria-expanded="false"
                                aria-controls="pagesMenu"
                            >
                                <span class="nav-item_text"> Pages </span>
                                <span class="icon icon-chevron_right"></span>
                            </a>
                            <div class="dropdown-menu collapse" id="pagesMenu">
                                <ul class="dropdown-list">
                                    <li class="list-item">
                                        <a class="dropdown-item nav-item" data-page="faq" data-page-parent="pages" href="faq.html"> FAQ </a>
                                    </li>
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="gallery-grid"
                                            data-page-parent="pages"
                                            href="gallery-grid.html"
                                        >
                                            Gallery grid
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a
                                            class="dropdown-item nav-item"
                                            data-page="gallery-masonry"
                                            data-page-parent="pages"
                                            href="gallery-masonry.html"
                                        >
                                            Gallery masonry
                                        </a>
                                    </li>
                                    <li class="list-item">
                                        <a class="dropdown-item nav-item" data-page="error" data-page-parent="pages" href="404.html">
                                            404
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
                <button
                    class="header_trigger"
                    data-bs-toggle="collapse"
                    data-bs-target="#headerMenu"
                    aria-controls="headerMenu"
                    aria-expanded="false"
                >
                    <span class="line line--short"></span>
                    <span class="line"></span>
                    <span class="line line--short"></span>
                    <span class="line"></span>
                </button>
            </div>
        </header>
        <!--  homepage content start  -->
        
