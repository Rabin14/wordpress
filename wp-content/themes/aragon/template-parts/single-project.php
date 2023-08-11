<section class="single-project-wrapper">
    <header class="page-header default-page-header breadcrumbs post-page-header">
        <div class="page-header-inner page-header-overlay"
             style="background-image: url(<?php the_post_thumbnail_url(); ?>);">
            <div class="container-medium breadcrumbs-inner">
                <div class="info-wrapper d-flex flex-column align-items-center">
                    <?php if (!has_post_format('link')): ?>
                        <h1 class="current-post-title z-index-100">
                            <?php the_title(); ?>
                        </h1>
                    <?php else: ?>
                        <?php
                        $link = aragon_get_field('post_link');
                        $icon = aragon_get_field('post_link_icon');
                        ?>
                        <h1 class="link-post-title z-index-100">
                            <a href="<?php echo esc_url($link); ?>">
                                <i class="link-icon <?php echo esc_attr($icon); ?>"></i>
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
                        <div class="info-part info-part-static">
                            <i class="fa fa-folder-open"></i>
                            <?php the_terms( get_the_ID(), 'portfolio_category', '', '<span class="delimiter">,</span>', '' ); ?>
                        </div>
                        <div class="info-part info-part-static">
                            <i class="fa fa-tags"></i>
                            <?php the_terms( get_the_ID(), 'portfolio_tag', '', '<span class="delimiter">,</span>', '' ); ?>
                        </div>
                        <div class="info-part info-part-static">
                            <i class="fa fa-comment-alt"></i>
                            <?php $comment_count = get_comments_number(); ?>
                            <?php echo esc_html($comment_count); ?>
                            <?php echo esc_html(_n("Comment", "Comments", $comment_count, 'aragon')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
   <div class="container-medium">
       <div class="single-content">
           <?php get_template_part('layouts/single-project-content'); ?>
           <?php if (comments_open() || get_comments_number()) : ?>
               <?php comments_template(); ?>
           <?php endif; ?>
       </div>
       <div class="theme-check-tags-fix">
           <?php the_tags(); ?>
       </div>
       <div class="project-footer-wrapper">
           <div class="project-footer">
               <div class="post-info-additional">
                   <div class="like-wrapper">
                       <div class="item likes-item">
                           <?php aragon_the_likes_button(get_the_ID()); ?>
                       </div>
                   </div>
                   <div class="views-wrapper">
                       <p class="views-item">
                           <i class="fas fa-eye"></i>
                           <span><?php lester_the_postviews(); ?></span>
                       </p>
                   </div>
               </div>
           </div>
       </div>
   </div>
    <div class="navigation-project">
        <?php
        $next_post = get_next_post();
        $prev_post = get_previous_post();
        ?>
        <div class="container-fluid">
            <div class="row d-flex justify-content-between align-items-center">
                <div class="nav-link">
                    <a href="<?php if (!empty($prev_post)): echo get_permalink($prev_post);endif; ?>"
                       class="additional-link">
                        <i class="fa fa-angle-left"></i>
                        <span><?php esc_html_e('Previous project', 'aragon'); ?></span>
                    </a>
                </div>
                <div class="nav-link">
                    <a href="<?php if (!empty($next_post)): echo get_permalink($next_post);endif; ?>"
                       class="additional-link">
                        <span><?php esc_html_e('Next project', 'aragon'); ?></span>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>