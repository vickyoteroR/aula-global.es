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
define('DB_NAME', 'aulaglobzs330');

/** MySQL database username */
define('DB_USER', 'aulaglobzs330');

/** MySQL database password */
define('DB_PASSWORD', '3PDgey4M2ymR');

/** MySQL hostname */
define('DB_HOST', 'aulaglobzs330.mysql.db:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'bVQWjLHuW5t3XR37fmrshYJqmJxCWKc7N5YwTyn7owZangcnMwKtNiqggs/F');
define('SECURE_AUTH_KEY',  '1THtHciWRlQZuUfCLSTn3xZ5/sb9QVEO1pH4QoiR8KWiS2vUbA4RMH+N+HqB');
define('LOGGED_IN_KEY',    '5CkhNY73BFl++6hjunj3wUTZV6izvTvO9EExqDkfqIFrif2/qki22zDdf2Vb');
define('NONCE_KEY',        'Ycx7HlnHC5wmIBpYafHF6kA5KIDfNi8Y33h/heDLER1zTO53jLdyk+pwsdNY');
define('AUTH_SALT',        'gz1dPXkiNkxrG0hmPpEdKF9PCDED2Xq92ctjbYczJNjDCvmu6nZfM21TxyUa');
define('SECURE_AUTH_SALT', 'K9j1m3Ckssz2ZzuqLdeytKeEmAqmCr2QCRRCn3c17yD2JH4deA5W8eQnsFWH');
define('LOGGED_IN_SALT',   '37Y4yBks1Ztobw6inmobAOzeroDP158mWt6d9ri4Tq2yQXpsh4iwgl8eoBfA');
define('NONCE_SALT',       'iRyTvvgWghVqwbLv0daS4TZCC0RZN1YngCrfoHn4IYvDe8f+1W4j4it7yviO');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mod47_';

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

/* Fixes "Add media button not working", see http://www.carnfieldwebdesign.co.uk/blog/wordpress-fix-add-media-button-not-working/ */
define('CONCATENATE_SCRIPTS', false );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
