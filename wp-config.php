<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '=L7}79z^.6)F79kl#(S44>64U xZ=wS`X[|I(+AA4H0C3{dh_NCz44i>7<Z3g7q1' );
define( 'SECURE_AUTH_KEY',  '2(/N(Y1e:,[L{2)O{?<P4t8d+3)<|!l{VuF!qz>gTSt@DM]FoQ0f;nSRJ)wkT:RB' );
define( 'LOGGED_IN_KEY',    '8L;efgS#h{uF5j5%(/NnQLkhg|)>1kJp}|iY)IVrtU|y}?<+0xJ&1Hc@oB;L:{)X' );
define( 'NONCE_KEY',        '`2i1xn~o4&bSv^?oH4g,3`fY):9HM%/i{@6-hrOiRlKlFct{G_KG@Qb5=<nw$UX%' );
define( 'AUTH_SALT',        '{f-Y YPUV`?aOX<rF+:+L+Q+{Xn!}dCV]h]Q.Erb6.1,{eVJJvE?}HLI*=uh0k]A' );
define( 'SECURE_AUTH_SALT', 'yH/6CXc<k86}^4bD`:y{tI{%@2R|3IIw>w{y.o-W^&4[QO0??P+blT)4C)_LD|PD' );
define( 'LOGGED_IN_SALT',   '5BW7e2/]2$1t^AKCaYK<LM>D@i e?z}P:@bYb0sIHo*@3/2]6n}[n[aAt)s}|h1E' );
define( 'NONCE_SALT',       'zf3Sl,g$I7n*/)u9[}!B/j+M(]nV~|RO(hZK6WZ3.`NSo{_*w7m;UgbUQIg,ic$E' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
