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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('WORDPRESS_DB_NAME') );

/** MySQL database username */
define( 'DB_USER', getenv('WORDPRESS_DB_USER') );

/** MySQL database password */
define( 'DB_PASSWORD', getenv('WORDPRESS_DB_PASSWORD') );

/** MySQL hostname */
define( 'DB_HOST', getenv('WORDPRESS_DB_HOST') );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*w%-vV+e~~nI]5HD{Su*dPDo%jiX<Cgl#//>QtT?AFgNHeOjTT`BF(+kI-I5|$S-');
define('SECURE_AUTH_KEY',  '2Z,&&cH8<KRFw#+_AaIx{B+OW:AH,0 <h-XOTxGk5Ky4M1g1/K299&;UDu<CXsXD');
define('LOGGED_IN_KEY',    '$5Lza-cbTb{D)*wU^by>b XiqjGUvQDuC~@;Rrp$?(0O8%uphLp0#yE&KMy!ab`+');
define('NONCE_KEY',        'Ae*4Qe|kb4+C8g6&g$oRE|:<e`nme}M-|kjCQPn@-.xAv:,Yh4IfBtQOp6kp$xsl');
define('AUTH_SALT',        '(d+fJLk6w4iOR}-77pQw(FjA]1Bi>}S9R`<UBSGT3pMdu]}aIhV/ZE o+seGEZEC');
define('SECURE_AUTH_SALT', 'z4j<s5h8n~N)P?+ig=5/ Frg$v&!`;D32aDLG^Gzum~P#3u[L`8@+0Za1%W|(MMq');
define('LOGGED_IN_SALT',   'v8B8=l3C:+9POwql(zIG5Mm~3_CZ4t|Dw+xMm^#Tb=`t+}UY::Ob$|UghLn<kVU5');
define('NONCE_SALT',       '{po7B:ckxy%*`pw4Q!B0=!}^44j~w=q?3r#8!b1-j V-8S8K4s~0tZBa@Pa0~WP.');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during dev.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their dev environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */

define('WP_DEBUG', false);

define('FS_METHOD', 'direct');

define('ALLOW_UNFILTERED_UPLOADS', true);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';