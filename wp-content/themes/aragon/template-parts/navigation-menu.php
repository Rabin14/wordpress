<?php
if (aragon_is_blog() || is_404()):
    $id = get_option('page_for_posts');
endif;
?>

<?php
$container_type = empty(!aragon_get_field('navbar_container_type', $id)) ? aragon_get_field('navbar_container_type', $id) :
    'wide';
$logo = empty(!aragon_get_field('navbar_logo', $id)) ? aragon_get_field('navbar_logo', $id) : ARAGON_THEME_URL . '/assets/img/logo.png';
$position = empty(!aragon_get_field('navbar_position', $id)) ? aragon_get_field('navbar_position', $id) : 'fixed';
$search = aragon_get_field('navbar_search_button', $id);
?>

<?php if (isset($position)): ?>

<?php endif; ?>

<style>
    :root {
        --navbar-position: <?php echo esc_attr($position);?>;
    <?php if($position=='fixed'): ?> --navbar-fixed-height: var(--navbar-height);
    <?php else: ?> --navbar-fixed-height: 0px;
    <?php endif; ?>
    }
</style>

<nav class="navbar <?php if ($position == 'fixed'): ?>fixed-navbar<?php else: ?><?php endif; ?>">

    <div class="navbar-container <?php if ($container_type == 'container'):
        echo 'container-medium navbar-container--default';
    elseif ($container_type == 'wide'):
        echo 'container-fluid navbar-container--wide';
    endif; ?>">

        <div class="navbar-inner d-flex justify-content-between align-items-center">

            <div class="navbar-inner--logo-wrapper d-flex align-items-center">
                <a href="<?php echo esc_url(home_url("/")); ?>" class="logo">
                    <img src="<?php echo esc_attr($logo); ?>" alt="<?php esc_attr_e('Logo', 'aragon'); ?>">
                </a>
            </div>

            <div class="navbar-inner--navigation-wrapper d-flex">
                <?php
                add_filter('wp_nav_menu_objects', 'aragon_wp_nav_menu_objects', 10, 2);
                function aragon_wp_nav_menu_objects($items, $args)
                {
                    foreach ($items as $item) {
                        $icon_trigger = aragon_get_field('menu_icon_trigger', $item);
                        $icon = aragon_get_field('menu_icon', $item);
                        $megamenu_trigger = aragon_get_field('megamenu', $item);
                        if ($megamenu_trigger):
                            array_splice($item->classes, 4);
                            array_push($item->classes, 'menu-item-has-megamenu mobile-item');
                        endif;
                        if ($icon_trigger) {
                            $title = $item->title;
                            $title = '<i class="menu-item-icon ' . $icon . '"></i>' . $title;
                            $item->title = $title;
                        }
                    }
                    return $items;
                }

                ?>
                <div class="navigation-wrapper--menu-wrapper">
                    <?php if (has_nav_menu('primary_menu')) : ?>
                        <?php wp_nav_menu([
                            'theme_location' => 'primary_menu',
                            'menu' => 'primary_menu',
                            'menu_class' => 'menu menu-desktop',
                            'container' => ''
                        ]); ?>
                        <div class="menu-mobile-container">
                            <?php wp_nav_menu([
                                'theme_location' => 'primary_menu',
                                'menu' => 'primary_menu',
                                'menu_class' => 'menu menu-mobile',
                                'container' => ''
                            ]); ?>
                        </div>
                    <?php else: ?>
                        <div class="fallback-menu">
                            <p><?php esc_html_e('Please register Top Navigation from Appearance > Menus', 'aragon'); ?></p>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if ($search): ?>
                    <div class="navigation-wrapper--search-toggle-wrapper d-flex align-items-center">
                        <div class="search-toggle d-flex justify-content-center align-items-center">
                            <i class="fa fa-search"></i>
                        </div>
                        <?php get_search_form(); ?>
                    </div>
                <?php endif; ?>

                <div class="navigation-wrapper--navbar-toggle-wrapper align-items-center justify-content-center">
                    <button class="hamburger hamburger--collapse" type="button">
                        <span class="hamburger-box">
                          <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>

            </div>

        </div>

    </div>

</nav>