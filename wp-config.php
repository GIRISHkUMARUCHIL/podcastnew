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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db030vcnzwfapt' );

/** Database username */
define( 'DB_USER', 'uhduzcllqyjny' );

/** Database password */
define( 'DB_PASSWORD', 'nhlgic0mcwg2' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('WP_MEMORY_LIMIT', '256M');
define('ALTERNATE_WP_CRON', true);

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
define( 'AUTH_KEY',          'CU4SI2@0QePHNWUZ*k)n<{cHzYK==*.}NK?5;R&ixyMaZuUM{6u]HE~8&um>EY_L' );
define( 'SECURE_AUTH_KEY',   '5oRxb4 wSj,i&^b)Dqk^LtyX*tp~_PLaWBuk{!}eo.U+4<lwkwCi>v2Bp^j7QnuL' );
define( 'LOGGED_IN_KEY',     ',sk/?]lGxiD#e1G7.rP#hPi*Z_71]$S!<YNHT3ypiVYU5evr/p@$Jz.Sc {$Zol]' );
define( 'NONCE_KEY',         'L;A2[vlS(__08zyu]cLMu]HOr[de)G.Rngf[/sf@K$yrcRU*{<hg_v?3V< ^GZhq' );
define( 'AUTH_SALT',         '(ot><2rIBBjOIBDwJT [4O?U;rHlI-kx4+sr,.Tb7[d:*poK_mB.rtddQBKRfa|1' );
define( 'SECURE_AUTH_SALT',  '1u6K:C8l}`g[?#wiN9!J[0YN#GPF`qDKFcz_@V=o,AwcA/D?f]_Z/|O0b; 7^YY_' );
define( 'LOGGED_IN_SALT',    '08fUntA^b]G6L|5GFarPKexF%Y7+@]^xq &_7Ftl@v)Zh#cZJ^@51L*q%ZUgU{C5' );
define( 'NONCE_SALT',        '(^vM@wYek=BK<J~SD3s-0K:6IvqFMYG=6]S}n/GfbC[g/9#85-B3J8`B]?SXc&Cd' );
define( 'WP_CACHE_KEY_SALT', 'rO&O+r;tY/g4opv3TsEkDfpT2iJ5OwuApk-mz/BRWe#i,]@t$S2y74n1fGzeo>~~' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'okq_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
