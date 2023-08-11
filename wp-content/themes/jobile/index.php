<?php
/*
 * Main Template File.
 */
get_header();
$jobile_options = get_option('jobile_theme_options'); ?>
<section>

    <div class="col-md-12 bread-row">
	<div class="container jobile-container">
	    <div class="col-md-6 no-padding-lr bread-left">		
		<h2><?php 
		/* translators: 1: job number */
		printf(esc_html__('Available Jobs (%1$d)', 'jobile'), esc_html(wp_count_posts()->publish)); ?></h2>
	    </div>
	    <div class="col-md-6 no-padding-lr">
		<ol class="breadcrumb site-breadcumb">
		    <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Home', 'jobile'); ?></a>
		    <li>
			<?php
			global $paged;
			if ($paged > 1) {
			    echo '/';
			    esc_html_e('Page', 'jobile') . $paged;
			} ?>
		    </li>	
		</ol>
	    </div>    
	</div>
    </div>

    <div class="container jobile-container">    
	<div class="col-md-12 no-padding-lr margin-top-50">
	    <div class="row">
		<?php get_sidebar(); ?>
		<div class="col-md-8">
		    <article class="clearfix">
			<div class="col-md-12 no-padding-lr ">
			    <?php if (is_plugin_active('wp-google-maps/wpGoogleMaps.php')) {
				echo do_shortcode('[wpgmza id="1"]');
			    } ?>
			</div>

			<div class="col-md-12 no-padding-lr avilab-row2">
		    <div class="col-md-12 no-padding-lr right-pagination">
			 <?php
             the_posts_pagination( array(
            'type'  => 'div',
            'screen_reader_text' => ' ',
            'prev_text'          => esc_html__( '<< Previous', 'jobile' ),
            'next_text'          => esc_html__('Next >>','jobile'),
            ) ); ?>
		    </div>
			</div>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?> 
				<div class="col-md-12 no-padding-lr sear-result-column">
				    <div class="latest-job article-row1">
					<div class="col-md-2 no-padding-lr resp-grid1 box-sadow text-center">
					     <?php					    
			                if ( has_post_thumbnail() ) { ?>
                            <a href="<?php echo esc_url( get_permalink() ); ?>">
                              <?php the_post_thumbnail('jobile-blog-image'); ?>
                            </a>
                        <?php } else { ?>
	    				    <img src="<?php echo esc_url(get_template_directory_uri()) ?>/images/no-image.jpg" width="100" height="86" />
					    <?php } ?>	
					    </div>
					<div class="col-md-10 no-padding-lr small_pad">
					    <div class="col-md-8 col-sm-8 col-xs-8 no-padding-lr job-status resp-grid1 job-status-3">
						<span class="per-name grey-color"><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></span>
					    </div>
					   <?php jobile_entry_meta() ?>
					    <div class="col-md-12 no-padding-lr layout-set">
						<p class="result-btm-text"><?php the_excerpt(); ?> <a href="<?php echo esc_url(get_permalink()); ?>" class="color-068587"><?php esc_html_e('Read More', 'jobile') ?></a></p>
					    </div>
					</div>
				    </div>
				    </div>
			    <?php endwhile; endif; ?>
			<div class="col-md-12 no-padding-lr avilab-row2 padding-0">
		    <div class="col-md-12 no-padding-lr right-pagination">
			 <?php
             the_posts_pagination( array(
            'type'  => 'div',
            'screen_reader_text' => ' ',
            'prev_text'          => esc_html__( '<< Previous', 'jobile' ),
            'next_text'          => esc_html__('Next >>','jobile'),
            ) ); ?>
		    </div>
			</div>
		    </article>
		</div>
	    </div>
	</div>
    </div>
</section>
<?php get_footer();