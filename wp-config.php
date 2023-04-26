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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'Woo' );

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
define( 'AUTH_KEY',         '7Pvi2X,yxEcTp>w oBE-`ptzN`+dotIE`y$8.WJ7l&_mUNSLQI5~3vD)u]Svrs`0' );
define( 'SECURE_AUTH_KEY',  'Vhwc[OIymaI7T+Q;YTuWj8$DoRPf/i<uC+?&Y)N-e,lmD3c6zg]n^SED;(m=SS(h' );
define( 'LOGGED_IN_KEY',    'BP=9EaPo>Lq<9?Es 1j2?{ayF]YpD.&M6HIXy@$8qt%rp`bA_<X}Tf+H%tzs4qS@' );
define( 'NONCE_KEY',        '9zdfQF%MF;Df:W>d{i.PDQm:r.DwyXW]TR%0HZHJQbxJB8g_yRBY-UOnv{NI|FDt' );
define( 'AUTH_SALT',        'f*P(yh1fO?2}/3=>6s)z!3FuhkpQK N;+t]zpl[i&t(74kgs8M|jo@s+&ubxE4Ur' );
define( 'SECURE_AUTH_SALT', '9psf{16*$:ykHA_:>J=>7t(e3Tk-NAr o{{iHY|EEFItD&@_r6T#$|`tw-K-@V[b' );
define( 'LOGGED_IN_SALT',   '1.;>ZBCq8L}U0}VXYy/3rG$dt5SW2>!3u,(d&%+T4x.>W[Feu_g{UO/<[7rO#8up' );
define( 'NONCE_SALT',       '$cF>&^F^NVhQC-8{ru ;N>kXz]ze)m9cxvL^4oisFr;4,/lcruXp)/m6i4]pfZvz' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
