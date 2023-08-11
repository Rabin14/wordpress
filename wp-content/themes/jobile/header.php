<?php
/*
 * Header For Jobile Theme.
 */
$jobile_options = get_option('jobile_theme_options'); ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
	<header class="header-page2">
	    <div class="container jobile-container">
		<div class="col-md-4 no-padding-lr">
		 <?php
          if(has_custom_logo()): ?>
           <div class="header-logo header-logo2">
            <?php the_custom_logo(); ?>
           </div>
          <?php endif; 
          if(display_header_text()){ ?>
          <div class="header-sitename">
            <h1 class="jobile-site-name"><a href="<?php echo esc_url(get_site_url()); ?>"><?php echo esc_html(get_bloginfo('name')); ?></a></h1>
            <p class="jobile-tagline"><?php echo esc_html(get_bloginfo('description')); ?></p>
            </div>
          <?php } ?> 
          </div>
		<div class="col-md-8 col-xs-12 no-padding-lr">
		    <nav class="jobile-nav jobile-nav2">
                <div class="navbar-header">
				<button type="button" class="navbar-toggle navbar-toggle-top sort-menu-icon jobile-btn collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only"><?php esc_html_e('Menu', 'jobile'); ?></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span>
				</button>
				</div>
			<?php
			$jobile_defaults = array(
				    'theme_location' => 'primary',
				    'container' => 'div',
				    'container_class' => 'navbar-collapse collapse no-padding-lr',
				    'echo' => true,
				    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>');
			wp_nav_menu($jobile_defaults); ?>
		    </nav>
		</div>        
		</div>               
	    </div>
	</header>
