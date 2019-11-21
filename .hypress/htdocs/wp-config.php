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
	define('DB_NAME', 'hypress');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', 'hypress');

	/** MySQL hostname */
	define('DB_HOST', 'google-font-cache_mysql');

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
  define('AUTH_KEY',         'Vuaf3pcyFCx5BQSsBpd5mxopWmzHsCod');
  define('SECURE_AUTH_KEY',  '70vCuhNbExVLB6x1sNbiclrju01ul0X0');
  define('LOGGED_IN_KEY',    '5CoQqC65S46htZUg8UeJkedGg9QaGHGj');
  define('NONCE_KEY',        'W46wJcqXn3fE63oSs6xkbfpzxaIZFoZE');
  define('AUTH_SALT',        'o5Jo1w4TrQRkm2FVBk2MeidMUBOuCcrm');
  define('SECURE_AUTH_SALT', 'rFmMSABaDTLtdFTK4Aq2UOvkgAoXSNKX');
  define('LOGGED_IN_SALT',   'PQZ5AkpY4X2EHu7IPT564mbHAGYcnh15');
  define('NONCE_SALT',       'efKYAtJ0lnKObj4tlSA1HK0pz7OUfCOP');

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
	define('WP_DEBUG', true);

	/* That's all, stop editing! Happy blogging. */

	/** Absolute path to the WordPress directory. */
	if ( !defined('ABSPATH') )
		define('ABSPATH', dirname(__FILE__) . '/');

	/** Sets up WordPress vars and included files. */
	require_once(ABSPATH . 'wp-settings.php');
