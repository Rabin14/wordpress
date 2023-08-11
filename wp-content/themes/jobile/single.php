<?php
/*
 * Single Post Template File.
 */
get_header(); ?>
<section>
    <!--website-breadcrumbs-->
    <div class="col-md-12 bread-row">
	<div class="container jobile-container">
	    <div class="col-md-6 no-padding-lr bread-left">
		<h2><?php the_title(); ?></h2>
	    </div>
	    <div class="col-md-6 no-padding-lr font-14 breadcrumb site-breadcumb">
<?php if (function_exists('jobile_custom_breadcrumbs')) {
    jobile_custom_breadcrumbs();
} ?>
	    </div>    
	</div>
    </div>
    <!--breadcrumbs end-->
    <div class="container jobile-container">    
	<div class="col-md-12 no-padding-lr margin-top-50">
	    <div class="row">
<?php get_sidebar(); ?>
<?php while (have_posts()) : the_post(); ?>
    		<div id="post-<?php the_ID(); ?>" <?php post_class("col-md-8"); ?>> 
    		    <article class="clearfix">
    			<div class="col-md-12 top-pagination no-padding-lr clearfix">
    			    <div class="col-md-6 col-xs-6 no-padding-lr">
					<a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Back to Listings', 'jobile'); ?></a>
    			    </div>
    			    <div class="col-md-6 col-xs-6 no-padding-lr prev-next-btn">
    <?php previous_post_link('%link', __('Previous', 'jobile'), TRUE); ?>
    <?php next_post_link('%link', __('Next', 'jobile'), TRUE); ?>
    			    </div>
    			</div>

    			<div class="col-md-12 no-padding-lr article-content">
    			    <div class="latest-job article-row1">
    				<div class="col-md-2 no-padding-lr resp-grid1 box-sadow">
				    <?php                      
                        if ( has_post_thumbnail() ) { ?>
                        <a href="<?php echo esc_url( get_permalink() ); ?>">
                          <?php the_post_thumbnail('jobile-blog-image'); ?>
                        </a>
                       
                    <?php } else { ?>
					<img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/no-image.jpg" width="100" height="86" /><?php 
					}?>	
                     </div>
				
    				<div class="col-md-10 no-padding-lr">
    				    <div class="col-md-8 col-sm-8 col-xs-8 no-padding-lr job-status resp-grid1 job-status-3">
                                            <span class="per-name grey-color"><?php the_title(); ?></span>
                        </div>
    				    <?php jobile_entry_meta() ?>
                        </div>
                        <div class="article-row2 profile-title">
					<?php the_content();
					wp_link_pages(array(
					    'before' => '<div class="col-md-6 col-xs-6 no-padding-lr prev-next-btn">' . __('Pages:', 'jobile') . '',
					    'after' => '</div>',
					    'link_before' => '<span>',
					    'link_after' => '</span>',
					)); ?>
                </div>
    			    </div></div>
    		    </article>
    <?php if (comments_open($post->ID)) { ?>
		<div class="col-md-12 no-padding-lr article-content">
	<?php comments_template(); ?>
		</div>
    <?php } ?>
    	</div> 
<?php endwhile; ?>
	</div>
    </div>
</section>
<?php get_footer();