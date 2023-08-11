<?php
add_action( 'wp_enqueue_scripts', 'aragon_localize' );
function aragon_localize() {
    $comments_obj   = array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'loading'  => esc_html__( 'Loading', 'aragon' ),
        'send'     => esc_html__( 'Post Comment', 'aragon' ),
        'nonce'    => wp_create_nonce( 'aragon_comments' )
    );
    wp_localize_script( 'aragon-main', 'aragonComments', $comments_obj );
}


