<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'herbalife_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'hrh6Hh5E2HCZfJUn');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'Cx}{;myq67r6THev^2 p2Y}m^L3CZQiEf&:6wC!oJ]RevbS;>)sjg`W)`c+Fp;~l');
define('SECURE_AUTH_KEY',  '|i9[!V.3C70]+HFIK;vF0y~JXfCK-r4ih 2PQMt2 -K<rhxF)]~SXqH V ]x8]A]');
define('LOGGED_IN_KEY',    'p3G7?sOr-yeOVKxvE,v2*T-e*&N:4s6|][%{HFXOD%hoc4m%-8e|%/hmkcb(L!<Z');
define('NONCE_KEY',        'hdD_t@y`=LBA]y-rM~t(?0lOca>YyW 4c`+=/R&R} -O|~j!9r0%[F*]By&8E-ci');
define('AUTH_SALT',        'Q6_^Dx-qkNrEMk:@sZ`nhhL_fL=ohPo(wY&J-&*mXYE+W-W,fq%1n1Sgf#5]x?(2');
define('SECURE_AUTH_SALT', '++h| 3h~?=k1].?.BDeo`X:-Ovf-qbSCXP6p>PVEe+cc61jEie{NG%U<Gaeq3 _[');
define('LOGGED_IN_SALT',   'Ge]Ey[,$|F l%6Cg!x*l)xe:c%$EEWD%s&hMG0W|B,l~*|Wi7w*gR+O-5?)H198G');
define('NONCE_SALT',       '>+d3&uWddjhP}mSsc#,vH|-~`qu89-*lA:JC#>y^pya~<1Un&O)YwY-c -+q ,95');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'herb_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
