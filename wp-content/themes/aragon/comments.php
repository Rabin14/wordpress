<?php
if (!defined('ABSPATH')) {
    die ('Please do not load this page directly. Thanks!');
}
if (post_password_required()) {
    return;
}
?>
<?php
function aragon_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<li <?php comment_class('comment-item'); ?> id="li-comment-<?php comment_ID() ?>">
    <div class="comment-wrap " id="comment-<?php comment_ID(); ?>">
        <img class="comment-avatar" src="<?php echo get_avatar_url($comment); ?>"
             alt="<?php echo get_comment_author(); ?>">
        <div class="comment-body media-body">
            <div class="comment-item-title">
                <div class="comment-author">
                    <div class="info-wrapper">
                        <div class="author-wrapper">
                            <?php printf(aragon_wp_kses(('%s')), get_comment_author_link()) ?>
                        </div>
                        <div class="comment-date">
                            <?php printf(esc_html__('%1$s at %2$s', 'aragon'), get_comment_date(), get_comment_time()); ?>
                        </div>
                    </div>
                    <div class="edit-wrapper">
                        <?php edit_comment_link(esc_html__("Edit", 'aragon')); ?>
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                    </div>
                </div>
                <div class="comment-text"><?php if ($comment->comment_approved == '0') : ?>
                        <div class="wait"><?php esc_html_e("Your comment is awaiting moderation.", 'aragon') ?></div>
                    <?php endif; ?>
                    <?php comment_text(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <?php if (comments_open() || get_comments_number()) { ?>
        <div id="comments" class="comments-area">
            <?php
            if (have_comments()) : ?>
                <ol class="comment-list">
                    <?php
                    $reply_text = esc_html__('Reply', 'aragon');
                    $args = array(
                        'callback' => 'aragon_comment',
                        'avatar_size' => 70,
                        'style' => 'ol',
                        'short_ping' => true,
                        'reply_text' => $reply_text,
                    );
                    wp_list_comments($args);
                    ?>
                </ol>
                <?php
                $paginate_args = array(
                    'prev_text' => '<i class="fa fa-chevron-left"></i>',
                    'next_text' => '<i class="fa fa-chevron-right"></i>'
                );
                ?>
                <div class="comments-pagination mb50"><?php paginate_comments_links($paginate_args) ?></div>
            <?php endif; ?>
            <?php
            $submit_label = esc_html__('Post Comment', 'aragon');
            $commenter = wp_get_current_commenter();
            $fields = array();
            $fields['author'] = '<div class="form-flex input-column"><div class="first-input"><input id="author" name="author" type="text" 
 value="' . esc_attr($commenter['comment_author']) . '"  placeholder="' . esc_attr__('Name',
                    'aragon') . '" required ></div>';
            $fields['email'] = '<div class="second-input"><input id="email" name="email" type="email"  
 value="' . esc_attr($commenter['comment_author_email']) . '" 
 placeholder="' . esc_attr__('Email',
                    'aragon') . '" required ></div></div>';
            $comments_args = array(
                'fields' => apply_filters('comment_form_default_fields', $fields),
                'comment_field' => '<div class="textarea-column"><div class="form-flex"><textarea name="comment" id="comment"  required 
class="textarea-comment" placeholder="' . esc_attr__('Comment...',
                        'aragon') . '"></textarea></div></div>',
                'title_reply_to' => esc_html__('Leave a Reply to %s', 'aragon'),
                'title_reply' => esc_html__('Leave comment:', 'aragon'),
                'cancel_reply_link' => esc_html__('Cancel', 'aragon'),
                'comment_notes_before' => '',
                'label_submit' => $submit_label,
                'submit_field' => '%1$s %2$s',
                'submit_button' => ' <button type="submit" class="button-submit" name="submit">' . $submit_label . '</button>',
                'must_log_in' => '<p class="must-log-in">' . sprintf(esc_html__('You must be %1$slogged in%2$s to post a comment.',
                        'aragon'),
                        '<a href="' . wp_login_url(apply_filters('the_permalink', get_permalink())) . '">',
                        '</a>') . '</p>',
                'logged_in_as' => '<p class="logged-in-as">' . sprintf(esc_html__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'aragon'),
                        '<a href="' . admin_url('profile.php') . '">' . $user_identity . '</a>',
                        '<a href="' . wp_logout_url(apply_filters('the_permalink',
                            get_permalink())) . '" title="' . esc_attr__('Log out of this account', 'aragon') . '">',
                        '</a>') . '</p>',
            );
            function aragon_comment_after()
            {
                echo '</div>';
            }

            function aragon_comment_before()
            {
                echo '<div class="form comment-form-wrap">';
            }

            add_action('comment_form_after', 'aragon_comment_after');
            add_action('comment_form_before', 'aragon_comment_before');
            add_filter('comment_form_fields', 'aragon_comments_fields_order');
            function aragon_comments_fields_order($fields)
            {
                $new_fields = array();
                $myorder = array('author', 'email', 'comment');
                foreach ($myorder as $key) {
                    $new_fields[$key] = $fields[$key];
                    unset($fields[$key]);
                }
                if ($fields) {
                    foreach ($fields as $key => $val) {
                        $new_fields[$key] = $val;
                    }
                }

                return $new_fields;
            }

            ?>
            <?php comment_form($comments_args); ?>
        </div>
    <?php } ?>



