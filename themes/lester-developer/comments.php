<?php
/**
 * Template for displaying comments
 *
 * @package Lester_Developer
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ($comment_count === 1) {
                echo '1 Comment';
            } else {
                printf('%s Comments', number_format_i18n($comment_count));
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 40,
                'callback'    => 'lester_developer_comment',
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => '← Older Comments',
            'next_text' => 'Newer Comments →',
        ));

        if (!comments_open()) :
        ?>
            <p class="no-comments">Comments are closed.</p>
        <?php endif; ?>

    <?php endif; ?>

    <?php
    comment_form(array(
        'title_reply'          => 'Leave a Comment',
        'title_reply_to'       => 'Reply to %s',
        'cancel_reply_link'    => 'Cancel',
        'label_submit'         => 'Post Comment',
        'comment_field'        => '<p class="comment-form-comment"><label for="comment">Comment</label><textarea id="comment" name="comment" cols="45" rows="6" maxlength="65525" required></textarea></p>',
        'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s submit" value="%4$s" />',
    ));
    ?>
</div>
