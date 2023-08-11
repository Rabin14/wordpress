<?php

function aragon_load_textdomain() {
    load_theme_textdomain( 'aragon', get_template_directory() . '/lang/tgm' );
}

add_action( 'init', 'aragon_load_textdomain', 1 );

function aragon_register_required_plugins() {
    $plugins = array(
        array(
            'name'               => 'ACF Pro',
            'slug'               => 'advanced-custom-fields-pro',
            'source'             => ARAGON_THEME_PATH . '/plugins/advanced-custom-fields-pro.zip',
            'required'           => true,
            'version'            => '',
            'force_activation'   => false,
            'force_deactivation' => false,
            'external_url'       => '',
        ),
        array(
            'name' => 'KingComposer',
            'slug' => 'kingcomposer',
            'source' => ARAGON_THEME_PATH . '/plugins/kingcomposer.zip',
            'required' => true,
            'force_activation' => false,
        ),
        array(
            'name'             => 'Aragon KC-Addons',
            'slug'             => 'aragon-kc-addons',
            'source'           => ARAGON_THEME_PATH . '/plugins/aragon-kc-addons.zip',
            'required'         => true,
            'force_activation' => false,
        ),
        array(
            'name'             => 'Aragon Widgets',
            'slug'             => 'aragon-widgets',
            'source'           => ARAGON_THEME_PATH . '/plugins/aragon-widgets.zip',
            'required'         => true,
            'force_activation' => false,
        ),
        array(
            'name'             => 'Aragon Views',
            'slug'             => 'aragon-views',
            'source'           => ARAGON_THEME_PATH . '/plugins/aragon-views.zip',
            'required'         => true,
            'force_activation' => false,
        ),
        array(
            'name'             => 'Aragon Likes',
            'slug'             => 'aragon-likes',
            'source'           => ARAGON_THEME_PATH . '/plugins/aragon-likes.zip',
            'required'         => true,
            'force_activation' => false,
        ),
        array(
            'name'     => 'Contact Form 7',
            'slug'     => 'contact-form-7',
            'required' => true,
        ),
        array(
            'name'     => 'Demo Import',
            'slug'     => 'one-click-demo-import',
            'required' => true,
        ),
        array(
            'name'      => 'MailChimp for WordPress',
            'slug'      => 'mailchimp-for-wp',
            'required' => true,
        ),
        array(
            'name' => 'Visual Portfolio',
            'slug' => 'visual-portfolio',
            'required' => true,
        ),
        array(
            'name' => 'Advanced Custom Fields: Font Awesome',
            'slug' => 'advanced-custom-fields-font-awesome',
            'required' => true,
        ),
    );

    $config = array(
        'id'           => 'aragon',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'aragon_register_required_plugins' );
