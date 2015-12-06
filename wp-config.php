<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'chennairains');

/** MySQL database username */
define('DB_USER', 'chennairains');

/** MySQL database password */
define('DB_PASSWORD', 'Galeon!(*$');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'LtWro]$>}ci.$KHa|X:o?!+~Q9mRD|{-+Fs$/)uaYJW#O72<LS0<6O`LNoe(oHui');
define('SECURE_AUTH_KEY',  '@-[TuVK]0{|*9%o;aY$IO^gH?4Oz+_j+x#=Z(:/{=LDAio8&Ch9>wHSeXr{w;N;?');
define('LOGGED_IN_KEY',    '%IxCbRIRA[2&D1sJmk~-y%6|_&u]{Q0M68~NpP{`QUmQ}PrE<e$r7721aQeXuFD4');
define('NONCE_KEY',        '-6RA8wiyh?U&w;2$ycij 5]L}$DXwtTkK&#`&;J)~Fg T7-pj8F!T|*6:9Tt<l(+');
define('AUTH_SALT',        'Mu[,~fggf/-v)K?>D)be!2E7@&$99Ez+r*{]b3|g?fWc`ofUhI|%d/kD8vO&|SCV');
define('SECURE_AUTH_SALT', 'x,FmCX~FG@*HZ_u@@uD(f?Z`@B!dzZ|k:!4suQN_,J6yK@tu5gFikTKR,++E^@s ');
define('LOGGED_IN_SALT',   '~B;s3)4i|Gp5c^+iU>/6wj$|(+%*z-?9U.#ja.F3;dvY9>J5&<CpE[q*Xvw[%o0Z');
define('NONCE_SALT',       'fYf1.2/2C|Zx Xsad[cn(XZ,]nTB>c66Ro.IRNL7Fh{)v|_Qn96KHFWQlmw$4+-*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

