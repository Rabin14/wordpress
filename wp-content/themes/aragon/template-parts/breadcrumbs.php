<?php
if (aragon_is_blog()):
    $id = get_option('page_for_posts');
endif;
?>

<?php
$page_header_toggle = aragon_get_field('page_header', $id);
$page_header_type = empty(!aragon_get_field('page_header_toggle', $id)) ? aragon_get_field('page_header_toggle',
    $id) : "simple";
$page_header_background = empty(!aragon_get_field('page_header_background', $id)) ? aragon_get_field('page_header_background', $id) : "#f6f6f6";
$page_header_height = empty(!aragon_get_field('page_header_height', $id)) ? aragon_get_field('page_header_height',
    $id) : '250';
?>

<?php
if (!isset($page_header_toggle)):
    $page_header_toggle = true;
endif;
?>

<?php if (!is_single() && !is_404()): ?>
    <?php if ($page_header_toggle): ?>
        <?php if ($page_header_type == 'default'): ?>
            <header class="page-header default-page-header breadcrumbs"
                    style="height: <?php echo esc_attr($page_header_height); ?>px">
                <div class="page-header-inner  page-header-overlay"
                     style="background-image: url(<?php echo esc_attr($page_header_background); ?>);">
                    <div class="container-medium breadcrumbs-inner d-flex align-items-center flex-column
                <?php if (!is_single()): ?>
                justify-content-center
                <?php else: ?>
                justify-content-end
                <?php endif; ?>">
                        <div>
                            <div>
                                <h1 class="current-page-title z-index-100">
                                    <?php echo esc_html(aragon_page_title()); ?>
                                </h1>
                            </div>
                            <?php aragon_custom_breadcrumbs(); ?>
                        </div>
                    </div>
                </div>
            </header>
        <?php elseif ($page_header_type == 'simple'): ?>
            <header class="page-header breadcrumbs simple-page-header"
                    style="height: <?php echo esc_attr($page_header_height); ?>px">
                <div class="page-header-inner"
                     style="background-color:<?php echo esc_attr($page_header_background); ?>">
                    <div class="container-medium breadcrumbs-inner d-flex align-items-center justify-content-center">
                        <div>
                            <div>
                                <h1 class="current-page-title z-index-100">
                                    <?php echo esc_html(aragon_page_title()); ?>
                                </h1>
                            </div>
                            <?php aragon_custom_breadcrumbs(); ?>
                        </div>
                    </div>
                </div>
            </header>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>