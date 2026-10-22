<?php
if ( post_password_required() ) {
    return;
}
?>

<section class="post_comments" id="comments">
    <?php if ( have_comments() ) : ?>
        <h2 class="title">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf( '1 Comment' );
            } else {
                printf( '%s Comments', esc_html( $comment_count ) );
            }
            ?>
        </h2>

        <ul class="list">
            <?php
            wp_list_comments( array(
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 30,
                'callback'    => 'cobain_custom_comment',
                'per_page'    => 5
            ) );
            ?>
        
        </ul>
        
        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
        <nav class="comment-navigation" style="margin: 30px 0; display: flex; justify-content: space-between; font-weight: 600; text-transform: uppercase; font-size: 14px;">
            <div class="nav-previous"><?php previous_comments_link( '&larr; Older Comments' ); ?></div>
            <div class="nav-next"><?php next_comments_link( 'Newer Comments &rarr;' ); ?></div>
        </nav>
        <?php endif; ?>


        <?php the_comments_navigation(); ?>

        <?php if ( ! comments_open() ) : ?>
            <p class="no-comments">Comments are closed.</p>
        <?php endif; ?>
    <?php endif; ?>
</section>

<section class="post_reply">
    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );

    $fields =  array(
        'author' =>
            '<div class="main"><input class="field required" data-type="name" type="text" name="author" id="author" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="Full name"' . $aria_req . ' />',
        'email' =>
            '<input class="field required" name="email" id="email" data-type="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" placeholder="Email"' . $aria_req . ' /></div>',
    );

    $comments_args = array(
        'title_reply'          => 'Leave a Comment',
        'title_reply_before'   => '<h3 class="title">',
        'title_reply_after'    => '</h3>',
        'fields'               => $fields,
        'comment_field'        => '<div class="main"><textarea class="field required" data-type="message" name="comment" id="comment" placeholder="Comment" aria-required="true"></textarea></div>',
        'class_form'           => 'form',
        'class_submit'         => 'btn',
        'name_submit'          => 'submit',
        'submit_button'        => '<button class="btn" type="submit">Post comment</button>',
        'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
        'comment_notes_before' => '<label style="display: flex !important; align-items: center; cursor: pointer; margin-bottom: 15px; font-weight: 500;"><input type="checkbox" id="anonymous-toggle" style="margin-right: 10px; width: 18px; height: 18px;"> Post as Anonymous</label>',
    );

    comment_form($comments_args);
    ?>
</section>

<style>
/* Hide Jetpack Comment & Post Subscription Checkboxes */
.comment-subscription-form,
.comment-form-subscriptions,
#subscribe_comments,
#subscribe_blog,
#subscribe-label,
#subscribe-blog-label,
p.comment-subscription-form,
p.comment-form-subscriptions,
p:has(#subscribe_comments),
p:has(#subscribe_blog) {
    display: none !important;
    visibility: hidden !important;
    height: 0 !important;
    margin: 0 !important;
    padding: 0 !important;
    opacity: 0 !important;
    pointer-events: none !important;
}

/* New Comment Card Styling */
.post_comments .list-item {
    position: relative;
    display: block; /* override flex */
}
.comment-card {
    background: #ffffff !important;
    border: 1px solid #e0e0e0 !important;
    border-radius: 12px;
    padding: 20px;
    display: flex !important;
    gap: 16px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1) !important;
    width: 100%;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
    align-items: flex-start;
}

/* Threaded lines */
ul.children {
    padding-left: 60px !important;
    list-style: none;
    margin: 0;
    width: 100%;
}
ul.children::before {
    content: '';
    position: absolute;
    top: 40px; /* starts behind parent card */
    bottom: 50px; 
    left: 42px; /* Center of parent avatar (padding 20 + half avatar 22) */
    width: 2px;
    background-color: #e5e5e5;
    z-index: 1;
}

/* Child reply layout */
.post_comments .list-item[data-type="reply"] {
    margin-left: 0 !important;
    margin-right: 0 !important;
    margin-bottom: 0;
}
.post_comments .list-item[data-type="reply"] .comment-card {
    margin-bottom: 15px;
}

/* Curved connection line */
.post_comments .list-item[data-type="reply"]::before {
    content: '';
    position: absolute;
    top: 30px; /* align with middle of child card */
    left: -18px; /* distance back to vertical line (60px indent - 42px) */
    width: 18px;
    height: 30px; 
    border-bottom: 2px solid #e5e5e5;
    border-left: 2px solid #e5e5e5;
    border-bottom-left-radius: 12px;
    transform: translateY(-100%);
    z-index: 1;
}

/* View more button */
.view-more-replies-btn {
    background: none;
    border: none;
    color: #0da574;
    cursor: pointer;
    font-weight: 600;
    margin-top: 5px;
    margin-left: 0;
    text-transform: uppercase;
}

/* Override previous P styles */
.comment-content p {
    margin: 0;
    padding: 0;
}

/* Reduce font size for replies by 5px (from 14px to 9px) */
.post_comments .list-item[data-type="reply"] .comment-content {
    font-size: 9px !important;
}
.post_comments .list-item[data-type="reply"] .author-name {
    font-size: 12px !important;
}
.post_comments .list-item[data-type="reply"] .comment-date {
    font-size: 9px !important;
}
.post_comments .list-item[data-type="reply"] .like-button,
.post_comments .list-item[data-type="reply"] .reply-button {
    font-size: 10px !important;
}

</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Remove Jetpack comment subscription elements from DOM
    var subEls = document.querySelectorAll('.comment-subscription-form, .comment-form-subscriptions, #subscribe_comments, #subscribe_blog');
    subEls.forEach(function(el) {
        var p = el.closest('p') || el;
        if (p) p.remove();
    });

// Anonymous comment toggle logic
    var anonToggle = document.getElementById('anonymous-toggle');
    var authorInput = document.getElementById('author');
    var emailInput = document.getElementById('email');
    
    if (anonToggle && authorInput && emailInput) {
        anonToggle.addEventListener('change', function() {
            if (this.checked) {
                authorInput.value = 'Anonymous';
                emailInput.value = 'anonymous@example.com';
                authorInput.parentElement.style.display = 'none';
            } else {
                authorInput.value = '';
                emailInput.value = '';
                authorInput.parentElement.style.display = 'block'; // Or flex, depending on CSS. Wait, original is block? Actually let's just reset to ''
                authorInput.parentElement.style.display = '';
            }
        });
    }

    var threads = document.querySelectorAll('ul.children');
    threads.forEach(function(thread) {
        var replies = thread.querySelectorAll(':scope > li');
        if (replies.length > 2) {
            // Hide replies beyond the first 2
            for (var i = 2; i < replies.length; i++) {
                replies[i].style.display = 'none';
            }
            // Add a "View More" button
            var btn = document.createElement('button');
            btn.className = 'view-more-replies-btn';
            btn.textContent = 'View More Replies (' + (replies.length - 2) + ')';
            thread.appendChild(btn);
            
            var visibleCount = 2;
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                var toShow = 5; // user requested cap to 5 per click
                var shown = 0;
                for (var i = visibleCount; i < replies.length; i++) {
                    if (shown < toShow) {
                        replies[i].style.display = 'block'; // matches the display:flex of .list-item
                        shown++;
                        visibleCount++;
                    }
                }
                var remaining = replies.length - visibleCount;
                if (remaining > 0) {
                    btn.textContent = 'View More Replies (' + remaining + ')';
                } else {
                    btn.style.display = 'none';
                }
            });
        }
    });
});
</script>
