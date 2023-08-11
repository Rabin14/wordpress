<?php

if (!function_exists('aragon_get_field')) :

    function aragon_get_field($param, $id = null)
    {

        if ($id == null) :

            $id = get_the_ID();

        endif;

        if (function_exists('get_field')) :

            return get_field($param, $id);

        endif;

    }

endif;

if (!function_exists('aragon_the_field')) :

    function aragon_the_field($param, $id = null)
    {

        if ($id == null) :

            $id = get_the_ID();

        endif;

        if (function_exists('the_field')) :

            return the_field($param, $id);

        endif;

    }

endif;

if (!function_exists('aragon_get_sub_field')) :

    function aragon_get_sub_field($param)
    {

        if (function_exists('get_sub_field')) :

            return get_sub_field($param);

        endif;

    }

endif;

if (!function_exists('aragon_the_sub_field')) :

    function aragon_the_sub_field($param)
    {

        if (function_exists('the_sub_field')) :

            return the_sub_field($param);

        endif;

    }

endif;

if (!function_exists('aragon_get_option')) :

    function aragon_get_option($param)
    {

        if (function_exists('get_field')) :

            return get_field($param, 'option');

        endif;

    }

endif;

if (!function_exists('aragon_the_option')) :

    function aragon_the_option($param)
    {

        if (function_exists('the_field')) :

            return the_field($param, 'option');

        endif;

    }

endif;

if (!function_exists('aragon_is_blog')) :

    function aragon_is_blog()
    {
        return (is_author()
            || is_category()
            || is_archive()
            || is_single() && 'post' == get_post_type()
            || is_home()
            || is_tag()
            || is_search()
            || is_attachment()
        );
    }

endif;

if (!function_exists('aragon_custom_breadcrumbs')) :

    function aragon_custom_breadcrumbs()
    {

        $separator = '<i class="fa fa-chevron-right delimiter"></i>';
        $breadcrums_class = esc_attr('breadcrumbs-list');
        $home_title = esc_html__('Home', 'aragon');
        $prefix = '';

        // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
        $custom_taxonomy = 'product_cat';

        // Get the query & post information
        global $post, $wp_query;

        // Do not display on the homepage
        if (!is_front_page()) :

            // Build the breadcrums
            echo '<ul  class="' . $breadcrums_class . '">';
            // Home page
            echo '<li class="item-home"><a class="bread-link bread-home" href="' . esc_url(get_home_url()) . '" title="' . esc_attr($home_title) . '">' . esc_html($home_title) . '</a></li>';
            echo '<li class="separator separator-home"> ' . $separator . ' </li>';

            if (is_archive() && !is_tax() && !is_category() && !is_tag() && !is_author() && !is_year() && !is_day() && !is_month()) :

                echo '<li class="item-current item-archive"><span class="bread-current bread-archive year">' . esc_html(post_type_archive_title($prefix,
                        false)) . '</span></li>';

            elseif (is_year()) :

                // Display year archive
                echo '<li class="item-current item-current-' . esc_attr(get_the_time('Y')) . '"><span class="bread-current bread-current-' .
                    esc_attr(get_the_time('Y')) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_html(get_the_time('Y')) . ' ' .
                    esc_html__('Archives',
                        'aragon') . '</span></li>';

            elseif (is_archive() && is_tax() && !is_category() && !is_tag() && !is_year() && !is_day() && !is_month()) :

                $term = get_queried_object();
                $tax = $term->taxonomy;

                // If post is a custom post type
                $post_type = get_post_type();

                // If it is a custom post type display name and link
                if ($post_type != 'post') :

                    if (get_post_type_object(get_post_type())->has_archive) :

                        $post_type_object = get_post_type_object($post_type);
                        $post_type_archive = get_post_type_archive_link($post_type);

                        echo '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr($post_type)
                            . '" href="' . esc_url($post_type_archive) . '" title="' . esc_attr($post_type_object->labels->name) . '">' .
                            esc_attr($post_type_object->labels->name) . '</a></li>';
                        echo '<li class="separator">' . $separator . '</li>';

                    endif;

                endif;

                $custom_tax_name = get_queried_object()->name;

                echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . esc_html($custom_tax_name) . ' </span></li>';

            elseif (is_single()) :

                // If post is a custom post type
                $post_type = get_post_type();

                // If it is a custom post type display name and link
                if ($post_type != 'post') :

                    if (get_post_type_object(get_post_type())->has_archive) :

                        $post_type_object = get_post_type_object($post_type);
                        $post_type_archive = get_post_type_archive_link($post_type);

                        echo '<li class="item-cat item-custom-post-type-' . esc_attr($post_type) . '"><a class="bread-cat bread-custom-post-type-' . esc_attr($post_type) . '" href="'
                            . esc_attr($post_type_archive) . '" title="' . esc_attr($post_type_object->labels->name) . '">' .
                            esc_html($post_type_object->labels->name) . '</a></li>';
                        echo '<li class="separator">' . $separator . '</li>';

                    endif;

                else :

                    // Get post category info
                    $category = get_the_category();

                    if (!empty($category)) :

                        // Get last category post is in
                        $last_category = end($category);

                        // Get parent any categories and create array
                        $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','), ',');
                        $cat_parents = explode(',', $get_cat_parents);

                        // Loop through parent categories and store in variable $cat_display
                        $cat_display = '';

                        foreach ($cat_parents as $parents) :

                            $cat_display .= '<li class="item-cat">' . esc_html($parents) . '</li>';
                            $cat_display .= '<li class="separator"> ' . $separator . '</li>';

                        endforeach;

                    endif;

                    // If it's a custom post type within a custom taxonomy
                    $taxonomy_exists = taxonomy_exists($custom_taxonomy);

                    if (empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) :

                        $taxonomy_terms = get_the_terms($post->ID, $custom_taxonomy);
                        $cat_id = $taxonomy_terms[0]->term_id;
                        $cat_nicename = $taxonomy_terms[0]->slug;
                        $cat_link = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                        $cat_name = $taxonomy_terms[0]->name;

                    endif;

                endif;

                $aragon_post_type = get_post_type();

                if ($aragon_post_type == 'post') :

                    // Blog url
                    $posts_page_id = get_option('page_for_posts');
                    $blog_title = get_the_title($posts_page_id);
                    $blog_link = get_permalink(get_option('page_for_posts'));

                    if ($posts_page_id) :

                        echo '<li class="item-cat"><a href="' . esc_url($blog_link) . '">' . esc_html($blog_title) . '</a></li>';
                        echo '<li class="separator"> ' . $separator . ' </li>';

                    endif;

                endif;

                // Check if the post is in a category
                if (!empty($last_category)) :

                    echo aragon_wp_kses($cat_display);
                    echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '" title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title()) . '</span></li>';

                // Else if post is in a custom taxonomy
                elseif (!empty($cat_id)) :

                    echo '<li class="item-cat item-cat-' . esc_attr($cat_id) . ' item-cat-' . esc_attr($cat_nicename) . '"><a
                            class="bread-cat bread-cat-' . esc_attr($cat_id) . ' bread-cat-' . esc_attr($cat_nicename) . '"
                            href="' . esc_url($cat_link) . '" title="' . esc_attr($cat_name) . '">' . esc_html($cat_name) . '</a></li>';
                    echo '<li class="separator"> ' . $separator . '</li>';
                    echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '"
                                                                      title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title())
                        . '</span></li>';

                else :

                    echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '"
                                                                      title="' . esc_attr(get_the_title()) . '">' . esc_html(get_the_title())
                        . '</span></li>';

                endif;

            elseif (is_category()) :

                // Category page
                echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . esc_html(single_cat_title('', false)) . '</span></li>';

            elseif (is_page()) :

                // Standard page
                if ($post->post_parent) :

                    // If child page, get parents
                    $anc = get_post_ancestors($post->ID);

                    // Get parents in the right order
                    $anc = array_reverse($anc);

                    // Current page
                    echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span title="' . esc_attr(get_the_title()) . '"> ' .
                        esc_html(get_the_title()) . '</span></li>';

                else :

                    // Just display current page if not parents
                    echo '<li class="item-current item-' . esc_attr($post->ID) . '"><span class="bread-current bread-' . esc_attr($post->ID) . '"> ' . esc_html(get_the_title()) . '</span></li>';

                endif;

            elseif (is_tag()) :

                // Tag page
                // Get tag information
                $term_id = get_query_var('tag_id');
                $taxonomy = 'post_tag';
                $args = 'include=' . $term_id;
                $terms = get_terms($taxonomy, $args);
                $get_term_id = $terms[0]->term_id;
                $get_term_slug = $terms[0]->slug;
                $get_term_name = $terms[0]->name;

                // Display the tag name
                echo '<li class="item-current item-tag-' . esc_attr($get_term_id) . ' item-tag-' . esc_attr($get_term_slug) . '"><span
                            class="bread-current bread-tag-' . esc_attr($get_term_id) . ' bread-tag-' . esc_attr($get_term_slug) . '">' .
                    esc_html_e('Tag',
                        'aragon') . "&nbsp;" . esc_html($get_term_name) . '</span></li>';

            elseif (is_home()) : ?>

                <li class="item-current"><span class="bread-current"><?php esc_html_e('Blog', 'aragon'); ?></span></li>

            <?php elseif (is_day()) :

                // Day archive
                // Year link
                echo '<li class="item-year item-year-' . esc_attr(get_the_time('Y')) . '"><a class="bread-year bread-year-' . esc_attr(get_the_time('Y'))
                    . '" href="'
                    . esc_url(get_year_link(get_the_time('Y'))) . '" title="' . esc_attr(get_the_time('Y')) . '">' .
                    esc_html(get_the_time('Y')) . ' ' .
                    esc_html__('Archives',
                        'aragon') . '</a></li>';

                echo '<li class="separator separator-' . esc_attr(get_the_time('Y')) . '"> ' . $separator . '</li>';

                // Month link
                echo '<li class="item-month item-month-' . esc_attr(get_the_time('m')) . '"><a class="bread-month bread-month-' . esc_attr(get_the_time
                    ('m')) . '" href="'
                    . esc_url(get_month_link(get_the_time('Y'),
                        get_the_time('m'))) . '" title="' . esc_attr(get_the_time('M')) . '">' . esc_html(get_the_time('M')) . ' ' . esc_html__
                    ('Archives',
                        'aragon') . '</a></li>';

                echo '<li class="separator separator-' . esc_attr(get_the_time('m')) . '"> ' . $separator . ' </li>';

                // Day display
                echo '<li class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '">'
                    . get_the_time('jS') . ' ' . get_the_time('M') . ' ' . esc_html__('Archives',
                        'aragon') . '</span></li>';

            elseif (is_month()) :

                // Year link
                echo '<li class="item-year item-year-' . esc_attr(get_the_time('Y')) . '"><a class="bread-year bread-year-' . esc_attr(get_the_time('Y'))
                    . '" href="' . esc_url(get_year_link(get_the_time('Y'))) . '" title="' . esc_attr(get_the_time('Y')) . '">' . esc_html(get_the_time
                    ('Y')) . ' ' . esc_html__
                    ('Archives',
                        'aragon') . '</a></li>';

                echo '<li class="separator separator-' . esc_attr(get_the_time('Y')) . '">' . $separator . ' </li>';

                // Month display
                echo '<li class="item-month item-month-' . esc_attr(get_the_time('m')) . '"><span class="bread-month bread-month-' .
                    esc_attr(get_the_time('m'))
                    . '" title="' . esc_attr(get_the_time('M')) . '">' . esc_html(get_the_time('M')) . ' ' . esc_html__('Archives',
                        'aragon') . '</span></li>';

            elseif (is_author()) :

                // Auhor archive
                // Get the author information
                global $author;
                $userdata = get_userdata($author);

                // Display author name
                echo '<li class="item-current item-current-' . esc_attr($userdata->user_nicename) . '"><span class="bread-current bread-current-'
                    . esc_attr($userdata->user_nicename) . '" title="' . esc_attr($userdata->display_name) . '">' . esc_html($userdata->display_name)
                    . '</span></li>';

            elseif (get_query_var('paged')) :

                // Paginated archives
                echo '<li class="item-current item-current-' . esc_attr(get_query_var('paged')) . '"><span class="bread-current bread-current-'
                    . esc_attr(get_query_var('paged')) . '" title="Page ' . esc_attr(get_query_var('paged')) . '">' . esc_html_e("Page",
                        "aragon") . '' . esc_html(get_query_var('paged')) . '</span></li>';

            elseif (is_search()) :

                // Search results page
                echo '<li class="item-current item-current-' . esc_attr(get_search_query()) . '"><span class="bread-current bread-current-' .
                    esc_attr(get_search_query())
                    . '" >' . esc_html__('Search results for: ',
                        'aragon') . '' . esc_html(get_search_query()) . '</span></li>';

            endif;

            echo '</ul>';

        endif;

    }

endif;

if (!function_exists('aragon_empty_content')) :

    function aragon_empty_content($str)
    {

        return trim(str_replace('&nbsp;', '', strip_tags($str))) == '';

    }

endif;

if (!function_exists('aragon_navigation')) :

    function aragon_navigation($before = '', $after = '', $echo = true, $args = array(), $wp_query = null)
    {

        if (!$wp_query) :

            wp_reset_postdata();
            global $wp_query;

        endif;

        $default_args = array(
            'text_num_page' => '', // Text Before Navigation
            'num_pages' => 3, // Links to show
            'step_link' => 0, // Step
            'dotright_text' => '...',
            'dotright_text2' => '...',
            'back_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>',
            'first_page_text' => 0,
            'last_page_text' => 0, // text "to last page". Or 0, if you wanna show number.
        );

        $default_args = apply_filters('aragon_pagenavi_args', $default_args);
        $args = array_merge($default_args, $args);
        extract($args);
        $posts_per_page = (int)$wp_query->get('posts_per_page');
        $paged = (int)$wp_query->get('paged');
        $max_page = $wp_query->max_num_pages;

        if ($max_page <= 1) :

            return false;

        endif;

        if (empty($paged) || $paged == 0) :

            $paged = 1;

        endif;

        $pages_to_show = intval($num_pages);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1 / 2);
        $half_page_end = ceil($pages_to_show_minus_1 / 2);
        $start_page = $paged - $half_page_start;
        $end_page = $paged + $half_page_end;

        if ($start_page <= 0) :

            $start_page = 1;

        endif;

        if (($end_page - $start_page) != $pages_to_show_minus_1) :

            $end_page = $start_page + $pages_to_show_minus_1;

        endif;

        if ($end_page > $max_page) :

            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = (int)$max_page;

        endif;

        if ($start_page <= 0) :

            $start_page = 1;

        endif;

        $out = '';
        $link_base = str_replace(99999999, '___', get_pagenum_link(99999999));
        $first_url = get_pagenum_link(1);

        if (false === strpos($first_url, '?')) :

            $first_url = user_trailingslashit($first_url);

        endif;

        $out .= $before . "<ul class='blog-nav aragon-pagination'>\n";

        if ($text_num_page) :

            $text_num_page = preg_replace('!{current}|{last}!', '%s', $text_num_page);
            $out .= sprintf("<span class='pages'>$text_num_page</span> ", $paged, $max_page);

        endif;

        if ($back_text && $paged != 1) :

            $out .= '<li><a class="prev" href="' . (($paged - 1) == 1 ? $first_url : str_replace('___',
                    ($paged - 1),
                    $link_base)) . '">' . $back_text . '</a></li> ';

        endif;

        if ($start_page >= 2 && $pages_to_show < $max_page) :

            $out .= '<li><a class="first" href="' . $first_url . '">' . ($first_page_text ? $first_page_text : 1) . '</a></li>';

            if ($dotright_text && $start_page != 2) :

                $out .= '<li><span class="extend">' . $dotright_text . '</span></li>';

            endif;

        endif;

        for ($i = $start_page; $i <= $end_page; $i++) :

            if ($i == $paged) :

                $out .= '<li class="current"><span>' . $i . '</span></li> ';

            elseif ($i == 1) :

                $out .= '<li><a href="' . $first_url . '">1</a></li> ';

            else :

                $out .= '<li><a href="' . str_replace('___', $i, $link_base) . '">' . $i . '</a></li> ';

            endif;

        endfor;

        $dd = 0;

        if ($step_link && $end_page < $max_page) :

            for ($i = $end_page + 1; $i <= $max_page; $i++) :

                if ($i % $step_link == 0 && $i !== $num_pages) :

                    if (++$dd == 1) :

                        $out .= '<li><span class="extend">' . $dotright_text2 . '</span></li> ';

                    endif;

                    $out .= '<li><a href="' . str_replace('___', $i, $link_base) . '">' . $i . '</a></li>';

                endif;

            endfor;

        endif;

        if ($end_page < $max_page) :

            if ($dotright_text && $end_page != ($max_page - 1)) :

                $out .= '<li><span class="extend">' . $dotright_text2 . '</span></li> ';

            endif;

            $out .= '<li><a class="last" href="' . str_replace('___',
                    $max_page,
                    $link_base) . '">' . ($last_page_text ? $last_page_text : $max_page) . '</a></li> ';

        endif;

        if ($next_text && $paged != $end_page) :

            $out .= '<li><a class="next" href="' . str_replace('___', ($paged + 1), $link_base) . '">' . $next_text . '</a></li> ';

        endif;

        $out .= "</ul>" . $after . "\n";
        $out = apply_filters('aragon_pagenavi', $out);

        if ($echo) :

            return print aragon_wp_kses($out);

        endif;

        return aragon_wp_kses($out);

    }

endif;

if (!function_exists('aragon_wp_kses')) :

    function aragon_wp_kses($aragon_string)
    {

        $allowed_tags = array(
            'img' => array(
                'src' => array(),
                'alt' => array(),
                'width' => array(),
                'height' => array(),
                'class' => array(),
            ),
            'a' => array(
                'href' => array(),
                'title' => array(),
                'class' => array(),
            ),
            'span' => array(
                'class' => array(),
            ),
            'br' => array(),
            'div' => array(
                'class' => array(),
                'id' => array(),
            ),
            'h1' => array(
                'class' => array(),
                'id' => array(),
            ),
            'h2' => array(
                'class' => array(),
                'id' => array(),
            ),
            'h3' => array(
                'class' => array(),
                'id' => array(),
            ),
            'h4' => array(
                'class' => array(),
                'id' => array(),
            ),
            'h5' => array(
                'class' => array(),
                'id' => array(),
            ),
            'h6' => array(
                'class' => array(),
                'id' => array(),
            ),
            'p' => array(
                'class' => array(),
                'id' => array(),
            ),
            'strong' => array(
                'class' => array(),
                'id' => array(),
            ),
            'b' => array(
                'class' => array(),
                'id' => array(),
            ),
            'i' => array(
                'class' => array(),
                'id' => array(),
            ),
            'del' => array(
                'class' => array(),
                'id' => array(),
            ),
            'ul' => array(
                'class' => array(),
                'id' => array(),
            ),
            'li' => array(
                'class' => array(),
                'id' => array(),
            ),
            'ol' => array(
                'class' => array(),
                'id' => array(),
            ),
            'input' => array(
                'class' => array(),
                'id' => array(),
                'type' => array(),
                'style' => array(),
                'name' => array(),
                'value' => array(),
            ),
        );

        if (function_exists('wp_kses')) {

            return wp_kses($aragon_string, $allowed_tags);

        }

    }

endif;

if (!function_exists('aragon_page_title')) :

    function aragon_page_title()
    {

        if (is_singular('post')) :

            $posts_page_id = get_option('page_for_posts');
            $blog_title = get_the_title($posts_page_id);

            if ($posts_page_id) :

                return esc_html($blog_title);

            else :

                return esc_html__('Blog', 'aragon');

            endif;

        elseif (is_home()):

            $frontpage_id = get_option('page_for_posts');
            $frontpage_title = get_the_title($frontpage_id);

            if ($frontpage_id) :

                return esc_html($frontpage_title);

            else :

                return esc_html__('Blog', 'aragon');

            endif;

        elseif (is_singular()):

            return get_the_title();

        elseif (is_search()):

            return esc_html__('Search', 'aragon') . " - " . get_search_query();

        elseif (is_404()):

            return esc_html__('404 Page not found', 'aragon');

        elseif (is_tag()):

            return single_tag_title(null, false);

        elseif (is_category()):

            return single_cat_title(null, false);

        elseif (is_tax()):

            return single_term_title(null, false);

        elseif (is_author()):

            return esc_html__('Author - ', 'aragon') . get_the_author();

        elseif (is_archive()):

            return get_the_archive_title();

        elseif (is_page()):

            return get_the_title();

        else:

            return get_the_title();

        endif;

    }

endif;

if (!function_exists('aragon_fonts_url')) :

    function aragon_fonts_url()
    {
        $primary_font = !empty(aragon_get_option('opt_primary_font')) ? aragon_get_option('opt_primary_font') : 'Poppins';
        aragon_get_option('opt_font_subset') ? $fonts_subset = implode(',',
            aragon_get_option('opt_font_subset')) : $fonts_subset = 'latin,latin-ext';
        if (is_array($primary_font)):
            $primary_font = 'Poppins';
        endif;
        $fonts_url = '';
        $fonts = array();
        $fonts[] = '' . $primary_font . ':100,300,300i,400,400i,500,600,700,800';
        $fonts = array_unique($fonts);

        if ($fonts) {

            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
                'subset' => urlencode($fonts_subset),
            ),
                'https://fonts.googleapis.com/css');

        }

        return $fonts_url;
    }

endif;

if (!function_exists('aragon_load_fonts')) :

    function aragon_load_fonts()
    {

        $primary_font = !empty(aragon_get_option('opt_primary_font')) ? aragon_get_option('opt_primary_font') : 'Poppins';
        if (is_array($primary_font)):
            $primary_font = 'Poppins';
        endif;

        // Css variables
        $css_var = "
		:root {
			--primary-font: {$primary_font};
		}";

        // Add inline styles
        wp_add_inline_style('aragon-main-css', $css_var);
        // Include fonts
        wp_enqueue_style('fonts', aragon_fonts_url(), array());

    }

endif;

if (!function_exists('aragon_head')) :

    function aragon_head()
    { ?>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="apple-mobile-web-app-capable" content="yes"/>
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-transcluent">
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>">
        <meta name="application-name" content="<?php bloginfo('name'); ?>">
        <meta name="description" content="<?php bloginfo('description'); ?>">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php }

endif;