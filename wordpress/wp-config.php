<?php
define( 'WP_CACHE', true );

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
define( 'DB_NAME', 'parfumku_db' );

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
define( 'AUTH_KEY',         '2_F]^Zt##FAhYQIb&f67DXkvgk2Td1a~8+I~9z69UriaEFR<y$f]o^6Y|G~VSzT*' );
define( 'SECURE_AUTH_KEY',  'H$0[<q8>Rz,ST9(4ci6Y!u_b?rKVU`}+,M@apT)vu(>~+{u4L_>;.JV?6lRx0v`h' );
define( 'LOGGED_IN_KEY',    '.Z#).XKV^0uq,1q?_+nyUR&2Iy/-zph$+.xu4;<^(;?|pB)VDYJABqjk.1>PYTXM' );
define( 'NONCE_KEY',        'A5m<vrhsb4WB:)%EM{J@>==D}Xcu*sjt2*Y|h6rkZmv>B}@B1{&0ASLnT0s[ Ae)' );
define( 'AUTH_SALT',        'uo:3QD}KLM8>$~MK5oJS0!,dJpY~FM}*fbq9bmZGQi]1d*~Xoa43gs@PaaHMy>MM' );
define( 'SECURE_AUTH_SALT', '}m 0g)bu[d+)-+@gkl)R#BIHhn!uXYYBbt)<0olvmm|/x|dG4(e6P+%MM!AHM%YQ' );
define( 'LOGGED_IN_SALT',   'yF!w>_B;jJx_%Avow)o<^c+2cOh)v:J3`;zh3QVznHPQF@bS@n8sP;&X*%RbT?wv' );
define( 'NONCE_SALT',       'uv9PQHXF~=r8[8Rt!#]{DNG)UHr*=4WSK@GyoM#V&hVm1s.VIkI]T:o{|GF1*2PA' );

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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
