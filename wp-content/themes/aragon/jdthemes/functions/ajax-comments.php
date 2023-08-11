<?php

if ( ! defined( 'ABSPATH' ) ) {
    die ( 'Please do not load this page directly. Thanks!' );
}

function aragon_add_ajax_comment() {
    global $wpdb;
    $comment_post_ID = isset( $_POST['comment_post_ID'] ) ? (int) $_POST['comment_post_ID'] : 0;

    $post = get_post( $comment_post_ID );

    if ( empty( $post->comment_status ) ) :
        do_action( 'comment_id_not_found', $comment_post_ID );
        exit;
    endif;

    $status = get_post_status( $post );

    $status_obj = get_post_status_object( $status );


    if ( ! comments_open( $comment_post_ID ) ) :

        do_action( 'comment_closed', $comment_post_ID );
        wp_die( esc_html__( 'Sorry, comments are closed for this item.', 'aragon' ) );

    elseif ( 'trash' == $status ) :

        do_action( 'comment_on_trash', $comment_post_ID );
        exit;

    elseif ( ! $status_obj->public && ! $status_obj->private ) :

        do_action( 'comment_on_draft', $comment_post_ID );
        exit;

    elseif ( post_password_required( $comment_post_ID ) ) :

        do_action( 'comment_on_password_protected', $comment_post_ID );
        exit;

    else :

        do_action( 'pre_comment_on_post', $comment_post_ID );

    endif;

    $comment_author       = ( isset( $_POST['author'] ) ) ? trim( strip_tags( $_POST['author'] ) ) : null;
    $comment_author_email = ( isset( $_POST['email'] ) ) ? trim( $_POST['email'] ) : null;
    $comment_author_url   = ( isset( $_POST['url'] ) ) ? trim( $_POST['url'] ) : null;
    $comment_content      = ( isset( $_POST['comment'] ) ) ? trim( $_POST['comment'] ) : null;

    /*	check, login  */

    $user = wp_get_current_user();
    if ( $user->exists() ) :

        if ( empty( $user->display_name ) ) :
            $user->display_name = $user->user_login;
        endif;

        $comment_author       = esc_sql( $user->display_name );
        $comment_author_email = esc_sql( $user->user_email );
        $comment_author_url   = esc_sql( $user->user_url );
        $user_ID              = get_current_user_id();

        if ( current_user_can( 'unfiltered_html' ) ) :

            if ( wp_create_nonce( 'unfiltered-html-comment_' . $comment_post_ID ) != $_POST['_wp_unfiltered_html_comment'] ) :

                kses_remove_filters(); // start with a clean slate
                kses_init_filters(); // set up the filters

            endif;

        endif;

    else:

        if ( get_option( 'comment_registration' ) || 'private' == $status ) :

            wp_die( esc_html__( 'You must be %1$slogged in%2$s to post a comment.', 'aragon' ) );

        endif;

    endif;

    $comment_type = '';

    /* check, fields */
    if ( get_option( 'require_name_email' ) && ! $user->exists() ) :

        if ( 6 > strlen( $comment_author_email ) || '' == $comment_author ) :

            wp_die( esc_html__( 'Error: please fill all required fields', 'aragon' ) );

        elseif ( ! is_email( $comment_author_email ) ) :

            wp_die( esc_html__( 'Error: incorrect email', 'aragon' ) );

        endif;

    endif;

    if ( '' == trim( $comment_content ) || '<p><br></p>' == $comment_content ) :

        wp_die( esc_html__( 'Error: please type comment ', 'aragon' ) );

    endif;

    /* add comment id db */
    $comment_parent = isset( $_POST['comment_parent'] ) ? absint( $_POST['comment_parent'] ) : 0;
    $commentdata    = compact( 'comment_post_ID',
        'comment_author',
        'comment_author_email',
        'comment_author_url',
        'comment_content',
        'comment_type',
        'comment_parent',
        'user_ID' );
    $comment_id     = wp_new_comment( $commentdata );
    $comment        = get_comment( $comment_id );

    /* get cookies */
    do_action( 'set_comment_cookies', $comment, $user );

    $comment_depth = 1;
    while ( $comment_parent ) :

        $comment_depth ++;
        $parent_comment = get_comment( $comment_parent );
        $comment_parent = $parent_comment->comment_parent;

    endwhile;

    $GLOBALS['comment']       = $comment;
    $GLOBALS['comment_depth'] = $depth;

    ?>

    <li <?php comment_class( 'comment-item' ); ?> id="li-comment-<?php comment_ID() ?>">
        <div class="comment-wrap comment-body" id="comment-<?php comment_ID(); ?>">
            <img class="comment-avatar" src="<?php echo get_avatar_url( $comment ); ?>" alt="<?php echo get_comment_author(); ?>">
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
    </li>

    <?php
    die();
}

add_action( 'wp_ajax_aragon_comments', 'aragon_add_ajax_comment' );
add_action( 'wp_ajax_nopriv_aragon_comments', 'aragon_add_ajax_comment' );