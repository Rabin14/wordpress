<?php
add_action('wp_enqueue_scripts', 'aragon_add_inline_styles');
if (!function_exists('aragon_add_inline_styles')) :
    function aragon_add_inline_styles()
    {
        /* [Add inline styles] */
        $selection_color = empty(!aragon_get_option('selection_color')) ?
            aragon_get_option('selection_color') : '#1c1c1c';

        $selection_background = empty(!aragon_get_option('selection_background')) ? 
            aragon_get_option('selection_background') : '#dcdcdc';

        $primary_font_color = empty(!aragon_get_option('primary_font_color')) ? 
            aragon_get_option('primary_font_color') : '#999999';

        $heading_color = empty(!aragon_get_option('heading_color')) ? 
            aragon_get_option('heading_color') : '#333333';

        $font_line_height = empty(!aragon_get_option('font_line_height')) ? 
            aragon_get_option('font_line_height') : '1.9';

        $preloader_background = empty(!aragon_get_option('opt_loader_background')) ? 
            aragon_get_option('opt_loader_background') : '#f9f9f9';

        $preloader_items_background = empty(!aragon_get_option('opt_loader_items_background')) ? 
            aragon_get_option('opt_loader_items_background') : '#3d67f4';

        $preloader_balls_size = empty(!aragon_get_option('opt_loader_balls_size')) ? 
            aragon_get_option('opt_loader_balls_size') : '20';

        $preloader_margin = empty(!aragon_get_option('opt_loader_margin')) ? 
            aragon_get_option('opt_loader_margin') : '6';

        $preloader_line_width = empty(!aragon_get_option('opt_loader_line_width')) ? 
            aragon_get_option('opt_loader_line_width') : '4';

        $preloader_line_height = empty(!aragon_get_option('opt_loader_line_height')) ? 
            aragon_get_option('opt_loader_line_height') : '35';

        $css_variables = "
		:root{
			 --selection-color: {$selection_color};
             --selection-background: {$selection_background};
             --primary-font-color: {$primary_font_color};
             --heading-color: {$heading_color};
             --font-line-height: {$font_line_height};
             --ball-size-preloader: {$preloader_balls_size}px;
             --margin-preloader: {$preloader_margin}px;
             --line-height-preloader: {$preloader_line_height}px;
             --line-width-preloader: {$preloader_line_width}px;
             --loader-background: {$preloader_background};
             --preloader-items-color: {$preloader_items_background};
		}";

        wp_add_inline_style('aragon-main-css', $css_variables);
    }
endif;