<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mydatabase' );

/** Database username */
define( 'DB_USER', 'myuser' );

/** Database password */
define( 'DB_PASSWORD', 'mypassword' );

/** Database hostname */
define( 'DB_HOST', 'mysql' );

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
define( 'AUTH_KEY',         'USnPezF7(pFK|Vkw-ky|?<baqA5R}R/:eB)V4qkJ<&iO%1p}6|U=fRStDsSex9h;' );
define( 'SECURE_AUTH_KEY',  '|5-!8DT63+k9jrH>f}#]Gq@v2RG@J^3.dk*EF!1/l=]l5p1~LyH$wim5B`Pj)<n4' );
define( 'LOGGED_IN_KEY',    '6lw2&=-m~B_g}5(lI8Dz%UB:!QP|?Zz-0oNmZZpxUmi-GZ^O$m`z%Q]r#![X:_!W' );
define( 'NONCE_KEY',        '?OCzE}NaS)1Z0]*B:Sm/5<tGpf 3puA/3lc<Y?pmvw4BzjJSY9XAsdn; 9y[;0$ ' );
define( 'AUTH_SALT',        'L9gQ`$_c{w,d/&WJ<m96<Ep0h2a-JyHc$G~@.5sEa-F#+N[0;unkAh8Yto`LUt_:' );
define( 'SECURE_AUTH_SALT', '^pKMu<{/4 VC&qo-K&I1;90^Qno`%PMq&mo2a+ueWZgW@eB+1lm`P;V7_>vZ/6q!' );
define( 'LOGGED_IN_SALT',   '(mJIAC/2v$5P;Yw&,#uX;ml+{)7v_E[aw~:y_Z&$H|HL+]+nz+:P%w7Kg,sp[s!X' );
define( 'NONCE_SALT',       'tPX[tlX}`E%`=BF$jwlFPM{iSmI!r`Ts4)o^_$(}QoMA9AQ=G0.>F1N;EeccQ:Wt' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );
define('FS_METHOD', 'direct'); // Permet d'éviter les problèmes de permissions lors de l'installation de plugins ou de thèmes

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
