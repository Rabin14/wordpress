<div class="blog-grid-wrapper">
    <div class="blog-grid masonry-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php if (!has_post_format()):
                    get_template_part('layouts/blog-types/grid/post-formats/format-standard');
                elseif (has_post_format('video')) :
                    get_template_part('layouts/blog-types/grid/post-formats/format-video');
                elseif (has_post_format('gallery')) :
                    get_template_part('layouts/blog-types/grid/post-formats/format-gallery');
                elseif (has_post_format('quote')) :
                    get_template_part('layouts/blog-types/grid/post-formats/format-quote');
                elseif (has_post_format('aside')) :
                    get_template_part('layouts/blog-types/grid/post-formats/format-aside');
                elseif (has_post_format('image')) :
                    get_template_part('layouts/blog-types/grid/post-formats/format-image');
                elseif (has_post_format('link')) :
                    get_template_part('layouts/blog-types/grid/post-formats/format-link');
                elseif (has_post_format('audio')) :
                    get_template_part('layouts/blog-types/grid/post-formats/format-audio');
                endif; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <?php get_template_part('layouts/notfound') ?>
        <?php endif; ?>
    </div>
</div>