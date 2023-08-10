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
define( 'AUTH_KEY',         ',?z2<C6+4bHV9BJ88x?7wxj3IGv/m<4@s}XX0>k,.P=(t=t<-!Us^C1w`W&s _oJ' );
define( 'SECURE_AUTH_KEY',  'q+2S~MaSl Nh<y=*|B1P^+| =r}},YP+94$OZGs~Mnk1f5#G.V)<d1VcbG@~ ERc' );
define( 'LOGGED_IN_KEY',    'k:!Eq n%bEDX4WT|qtwwF}XT)598R{];m-guNlbxnkBji1(.-CER.3}!6Z~xZV~H' );
define( 'NONCE_KEY',        'NQWu5(qSw/dR@1o8er36;Fyy5aw|dc2)}?4KYW}<^k>whe{opm?Q{?<q#:$=d6C(' );
define( 'AUTH_SALT',        '1-_.G.m/1~=K|5# zL])FQumz8iWnGp+igF#ZKuAQ>lOMD:i@IG=#FWs/q^[B3+8' );
define( 'SECURE_AUTH_SALT', 'a@z]jjz&]g@1jQ6WH`H8A(|^m@p(KfZ9_B>Mt^n5*r]E{sA~r+7 eE_KA+m{c5&Z' );
define( 'LOGGED_IN_SALT',   '9Uc)5A&&2z/gc(T?VJYko[7@R#/?UbMMKdkx4b<r/NQQ=n7j+$e.asoE+;;5.Zht' );
define( 'NONCE_SALT',       'qdh0(E8AQ1}{>mZ,g[ -GaG< IS>iVls<q+8x|FY8![WMai52VpT]27 rIU~Rnw)' );

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
