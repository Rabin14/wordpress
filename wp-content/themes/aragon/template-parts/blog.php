<?php
$id = get_option('page_for_posts');
$post_sidebar_toggle = aragon_get_field('blog_sidebar', $id);
$post_sidebar_alignment = empty(!aragon_get_field('post_sidebar_alignment')) ? aragon_get_field
('post_sidebar_alignment') : 'right-sidebar';
$blog_type = empty(!aragon_get_field('blog_type', $id)) ? aragon_get_field('blog_type', $id) : 'grid';
$sticky_sidebar = aragon_get_field('blog_sticky_sidebar', $id);
if (isset($_GET['blog_type'])): $blog_type = $_GET['blog_type']; endif;
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

<?php if ($blog_type == 'list' || $blog_type == 'grid'): ?>
    <section class="blog-section blog-section-default">
        <div class="container-medium">
            <div class="blog-inner  <?php if ($post_sidebar_toggle): ?>post-with-sidebar<?php endif; ?>">
                <?php if ($post_sidebar_toggle): ?>
                    <div class="row">
                        <?php if ($post_sidebar_alignment == 'left-sidebar'): ?>
                            <div class="col-xl-3 sidebar-wrapper left-sidebar <?php if ($sticky_sidebar): ?>sticky-sidebar<?php endif; ?>">
                                <?php get_sidebar(); ?>
                            </div>
                        <?php endif; ?>
                        <div class="col-xl-9 <?php if ($sticky_sidebar): ?>sticky-content<?php endif; ?> <?php if
                        ($blog_type == 'grid'): ?>blog-grid-column<?php endif; ?>">
                            <?php if ($blog_type == 'list'): ?>
                                <?php get_template_part('layouts/blog-types/list/list-blog'); ?>
                            <?php elseif ($blog_type == 'grid'): ?>
                                <?php get_template_part('layouts/blog-types/grid/grid-blog'); ?>
                            <?php endif; ?>
                            <?php get_template_part('layouts/posts-pagination'); ?>
                        </div>
                        <?php if ($post_sidebar_alignment == 'right-sidebar'): ?>
                            <div class="col-xl-3 sidebar-wrapper right-sidebar <?php if ($sticky_sidebar): ?>sticky-sidebar<?php endif; ?>">
                                <?php get_sidebar(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php else: ?>
                    <div class="<?php if ($blog_type == 'list'): ?>default-blog-wide<?php endif; ?>">
                        <?php if ($blog_type == 'list'): ?>
                            <?php get_template_part('layouts/blog-types/list/list-blog'); ?>
                        <?php elseif ($blog_type == 'grid'): ?>
                            <?php get_template_part('layouts/blog-types/grid/grid-blog'); ?>
                        <?php endif; ?>
                        <div class="blog-nav">

                        </div>
                        <?php get_template_part('layouts/posts-pagination'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php elseif ($blog_type == 'block'): ?>
    <?php get_template_part('layouts/blog-types/blocks/blocks-blog'); ?>
    <div class="block-type-nav">
        <?php get_template_part('layouts/posts-pagination'); ?>
    </div>
<?php endif; ?>
