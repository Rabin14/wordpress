<?php
function aragon_import_files() {
    return array(
        array(
            'import_file_name'         => 'aragon Demo',
            'categories'               => array( 'Main', 'Creative', 'Portfolio', 'Agency' ),
            'import_file_url'          => 'https://jd-host.ru/themeforest/demo-import/aragon_wp/aragon-demo-content.xml',
            'import_widget_file_url'   => 'https://jd-host.ru/themeforest/demo-import/aragon_wp/aragon-demo-widgets.wie',
            'import_preview_image_url' => ARAGON_THEME_URL . '/screenshot.png',
            'preview_url'              => 'http://jd-host.ru/themeforest/wp/aragon/',
        ),
    );
}

add_filter( 'pt-ocdi/import_files', 'aragon_import_files' );

function aragon_after_import_setup() {

    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations',
        array(
            'header-menu' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home Start Up' );
    $blog_page_id  = get_page_by_title( 'Latest News' );

    // Update options
    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}

add_action( 'pt-ocdi/after_import', 'aragon_after_import_setup' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

