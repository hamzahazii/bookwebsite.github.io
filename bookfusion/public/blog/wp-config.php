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
define( 'DB_NAME', 'bookfusionwpdb' );

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
define( 'AUTH_KEY',         'i9<(k|p? X?d`mj0iGz)k7w`e{cn2T.2WIB9qXYb*a.89XkwU08dk >6)Tik ZG,' );
define( 'SECURE_AUTH_KEY',  'G;)#Z]kSD,oAXQX!RhRf845q8zh{-oAD=!O;4oe=f2b]Bt*SF1)z6D{K&G8S-fMd' );
define( 'LOGGED_IN_KEY',    '.)ke<aw`kHO+&:,R@&T1xR6z84j39/ %eIRi_I16f4AQ9G4bPQx^$=`5=$X4ZxwQ' );
define( 'NONCE_KEY',        '^R* 48OAU=MQGfKlH}UtH0v6y{2V`.,Y1}=~I&DU&$z:!@RRV|2CWU2)nmWi;KMC' );
define( 'AUTH_SALT',        '[HMjG=|vbJ$.E7c3fcW_*/npD,OBUF[,9@nvK_3/7I Xn^a[y2Ip<?%ud{wxt+aB' );
define( 'SECURE_AUTH_SALT', 'YzJVZLBDV4p87MV9C1xeQgMcuxDZ;~s/+zx34[gbgjZ#J~o:xq|j=YJvIxo!Yodi' );
define( 'LOGGED_IN_SALT',   ' &U$bLX60f=CYw`b;7- $Z2/m4.&^[sj?/9ZBJ{s8Xy`{hT7oTcHq569&4:dj>$A' );
define( 'NONCE_SALT',       'XLQKJTMSk{Y?GH&JT7lif]~Sw2)fz*uWwi$=e(R/,z0eL,[d^tsW#UG_Z;:HlleU' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'blog_157';

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
