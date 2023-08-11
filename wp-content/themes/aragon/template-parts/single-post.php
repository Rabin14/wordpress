<header class="page-header
<?php if ((!has_post_format() || has_post_format('image') || (has_post_format('gallery') && !function_exists('get_field'))) && has_post_thumbnail()): ?>
default-page-header page-header-overlay
<?php elseif ((has_post_format('gallery') && function_exists('get_field'))
    || has_post_format('video')
    || has_post_format('aside')
    || has_post_format('link')
    || has_post_format('audio')
    || !has_post_thumbnail()): ?>
simple-page-header
<?php endif; ?>
breadcrumbs post-page-header">
    <div class="page-header-inner"
         style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
        <div class="container-medium breadcrumbs-inner">
            <div class="info-wrapper d-flex flex-column align-items-center">
                <?php if (!has_post_format('link')): ?>
                    <h1 class="current-post-title z-index-100">
                        <?php if (is_sticky()) : ?>
                            <div class="sticky-icon">
                                <i class="fa fa-thumbtack"></i>
                            </div>
                        <?php endif; ?>
                        <?php the_title(); ?>
                    </h1>
                <?php else: ?>
                    <?php
                    $link = aragon_get_field('post_link');
                    $icon = aragon_get_field('post_link_icon');
                    ?>
                    <h1 class="link-post-title z-index-100">
                        <a href="<?php echo esc_url($link); ?>">
                            <?php if (!empty($icon)): ?>
                                <i class="link-icon <?php echo esc_attr($icon); ?>"></i>
                            <?php endif; ?>
                            <?php the_title(); ?>
                        </a>
                    </h1>
                <?php endif; ?>
                <div class="info-post">
                    <div class="info-part info-part-static">
                        <i class="far fa-clock"></i>
                        <?php echo esc_html(get_the_date()); ?>
                    </div>
                    <div class="info-part info-part-link">
                        <i class="fa fa-user"></i>
                        <?php the_author_posts_link(); ?>
                    </div>
                    <div class="info-part info-part-meta">
                        <i class="fa fa-folder-open"></i>
                        <?php the_category('<span class="delimiter">,</span>', 'single'); ?>
                    </div>
                    <?php if (has_tag()): ?>
                        <div class="info-part info-part-meta">
                            <i class="fa fa-tags"></i>
                            <?php the_tags('', '<span class="delimiter">,</span>', ''); ?>
                        </div>
                    <?php endif; ?>
                    <?php $comment_count = get_comments_number(); ?>
                    <div class="info-part info-part-static">
                        <i class="fa fa-comment-alt"></i>
                        <?php echo esc_html($comment_count); ?>
                        <?php echo esc_html(_n("Comment", "Comments", $comment_count, 'aragon')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<?php
$post_sidebar_toggle = aragon_get_field('post_sidebar');
$post_sidebar_alignment = empty(!aragon_get_field('post_sidebar_alignment')) ? aragon_get_field
('post_sidebar_alignment') : 'right-sidebar';
if (!isset($post_sidebar_toggle)):
    $post_sidebar_toggle = true;
endif;
if (isset($_GET['sidebar_trigger'])):
    if ($_GET['sidebar_trigger'] == 'full'):
        $post_sidebar_toggle = false;
    elseif ($_GET['sidebar_trigger'] == 'sidebar'):
        $post_sidebar_toggle = true;
    endif;
endif;
if (isset($_GET['sidebar_alignment'])): $post_sidebar_alignment = $_GET['sidebar_alignment']; endif;
?>

<div class="container-medium single-post-wrapper">
    <?php $content = get_the_content(); ?>
    <?php if (!aragon_empty_content($content)): ?>
        <div class="post-content <?php if ($post_sidebar_toggle): ?>post-with-sidebar<?php endif; ?>">
            <?php if ($post_sidebar_toggle): ?>
                <div class="row">
                    <?php if ($post_sidebar_alignment == 'left-sidebar'): ?>
                        <div class="left-sidebar sidebar-wrapper col-xl-3">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="col-xl-9">
                        <div class="single-post-inner <?php if ( ! function_exists( 'get_field' ) && ! isset( $GLOBALS['kc'] ) ) :
                            echo 'default-content default-content-styles';
                        endif; ?>">
                            <?php get_template_part('layouts/single-post-content') ?>
                        </div>
                    </div>
                    <?php if ($post_sidebar_alignment == 'right-sidebar'): ?>
                        <div class="right-sidebar sidebar-wrapper col-xl-3">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="single-post-inner default-blog-wide default-content">
                    <?php get_template_part('layouts/single-post-content') ?>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>