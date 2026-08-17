<?php
/* Template Name: 404 */
get_header();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Page not found | Griya Djaya Sentosa</title>
        <link rel="stylesheet preload" as="style" href="<?php echo get_template_directory_uri(); ?>/css/preload.min.css" />
        <link rel="stylesheet preload" as="style" href="<?php echo get_template_directory_uri(); ?>/css/icomoon.css" />
        <link rel="stylesheet preload" as="style" href="<?php echo get_template_directory_uri(); ?>/css/libs.min.css" />

        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/error.min.css" />
    </head>
    <body>
        <!-- page 404 content start -->
        <main class="error">
            <div class="container">
                <span class="error_number">404</span>
                <div class="error_message">
                    <div class="error_message-header">
                        <span class="subtitle">Oops!</span>
                        <h3 class="title">Page not Found</h3>
                    </div>
                    <p class="error_message-text">We are sorry, the page you requested cannot be found</p>
                    <a class="btn" href="index.html">Home page</a>
                </div>
            </div>
        </main>
        <!-- page 404 content end -->
    </body>
</html>

<?php
get_footer();
?>
