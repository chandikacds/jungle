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
define('DB_NAME', 'jungle');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '=3<TsZo6Mj+/]{JmF7ap{=HgD0^&g>_il6CR2ha<v9<C?wz{ju#n7$%`-yL0^O}5');
define('SECURE_AUTH_KEY',  'Hkd2t29EIVbLAMe*AsjU?n []W(#zD?^TT;7}SycZowA9-P:HRh>kmZo+PgRPD,3');
define('LOGGED_IN_KEY',    '><#mzonl;IU!8!R@Pk0[)dnYyvXcI{K6H_WC EHkpVQ1GEu?hg])d`l |l}!;%K4');
define('NONCE_KEY',        'f,!n+fpYJKP<*dD}:Q=Ih8~n2a1d<1~X9W<oJ_km#_//g%##g`nSJ>u3cJr0{&XH');
define('AUTH_SALT',        'jft}*C&*g)HgO0S[OkEDB<=3;eth#j^eglD?Akka:CaiooP%Ea<u>C.]Frm47)86');
define('SECURE_AUTH_SALT', 'Rc6I@Yd9ND*dC/NSed&T [4kKE!)Jc99hGPf<[GD$q=uqK6-g(tB?_k4V7OpjI@+');
define('LOGGED_IN_SALT',   '&_vg8%pnlvTV|(1w# utMO7$oG}GsD ?3`;W%a8^)JGRZItcfbs&5BPU>v!)rm0_');
define('NONCE_SALT',       '#5[GbtkGtqt&vfr90H?rbI+BJXE)(_0}H+Bl9*30(x&W!qrx/S%P_u/4E4P>k;0u');

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
