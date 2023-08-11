<?php

/* [DECLARATION GENERAL CONSTANTS] */

/* @FRAMEWORK_PATH */
define( 'ARAGON_PATH', get_template_directory() . '/jdthemes' );

/* @THEME_PATH */
define( 'ARAGON_THEME_PATH', get_template_directory() );

/* @PREFIX */
define( 'ARAGON_PREFIX', 'aragon_' );

/* @THEME_PREFIX */
define( 'ARAGON_THEME_PREFIX', ARAGON_PREFIX . get_template() . '_' );

/* @THEME_SHORTNAME */
define( 'ARAGON_SHORTNAME', 'Aragon' );

/* @THEME_OPTIONS_NAME */
define( "ARAGON_THEME_OPTIONS_NAME", "Aragon" );

/* @THEME_VERSION */
define( "ARAGON_THEME_VERSION", "1.0" );

/* @THEME_URL */
define( "ARAGON_THEME_URL", get_template_directory_uri() );

/* [INCLUDE GENERAL FILES] */

/* @theme-support (theme-support functions) */
get_template_part( 'jdthemes/functions/theme-support' );

/* @general (general functions) */
get_template_part( 'jdthemes/functions/general' );

/* @front (connecting styles and scripts) */
get_template_part( 'jdthemes/functions/front' );

/* @inline-css (setting values for styles and css-variables) */
get_template_part( 'jdthemes/functions/inline-css' );

/* @localize-js (setting values for js-scripts) */
get_template_part( 'jdthemes/functions/localize-js' );

/* @ajax-comments (ajax-comments handler) */
get_template_part( 'jdthemes/functions/ajax-comments' );

/* @sidebars (sidebars settings) */
get_template_part( 'jdthemes/functions/sidebars' );

/* @navigation (theme navigation) */
get_template_part( 'jdthemes/functions/navigation' );

/* @tgm (tgm plugins) */
get_template_part( 'jdthemes/functions/class-tgm-plugin-activation' );

/* @demo-import (demo import) */
get_template_part( 'jdthemes/functions/demo-import' );

/* @load-plugins (tgm load-plugins config) */
get_template_part( '/plugins/load-plugins' );

/* @acf-config (ACF config) */
get_template_part( 'jdthemes/acf/acf-config' );