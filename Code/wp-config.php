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
define('AUTH_KEY',         'f~G6T%M-?_Sb9gwKujmXbqE`,J{wN9mFeI;whCM#/[s?+q{-RRmB<W{JJ7W{P*BW');
define('SECURE_AUTH_KEY',  'Po7Q2?m=ROL3}*U9cD|jof6TYG5$o-L}jkqnanU 7KeC|Yt/L/HHEk<=zAnYO<#E');
define('LOGGED_IN_KEY',    '_iWB%=R-3s(]H)ix5h=l=g`FV[@<li.`qed02[}zDKQqQ1n th]qhrzn-Pn-n#l>');
define('NONCE_KEY',        '|oL>TJ6X|;k((<r_-Y|UtS:aU6lUc6(yZduwT|m Vki=RW6d:IH2fqW`+-UIMn;R');
define('AUTH_SALT',        'F|`w&SRrh&+W2.vK1i^-<Tg1JyIiP3P6a$D$pOM@tu(PhJ8&;l&4(G)P[jm~ottp');
define('SECURE_AUTH_SALT', 'U.Q%Tt |k]l:^9SmA1L*C_}Cc:wA-29T}~+KLzmym2Y,.R~dZ(5Ay37IB,04wc|#');
define('LOGGED_IN_SALT',   '|L<X?=,r#9)Zu^w&T9LV|12zf3>w/sZ>L+x8F4$bvVCtJj3JfCE-]ayI+p;&3X3,');
define('NONCE_SALT',       '&kI8.*/94arI3IGZ[-|gy/INot)Y&Q@cVgz%z%GV7X.)3mTHp)<n}?{UK9M!-C)Y');

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
