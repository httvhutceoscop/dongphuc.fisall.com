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
define('DB_NAME', 'fisallco_dp');

/** MySQL database username */
define('DB_USER', 'vietnt');

/** MySQL database password */
define('DB_PASSWORD', 'hanthu1110');

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
define('AUTH_KEY',         'GEei1/|>J$KBTk(~9|)s*XeUeDX7=`*{r-_#D5J(x~t&Bc4r}bUk6^`yKcP|>syj');
define('SECURE_AUTH_KEY',  '.hei#/yP0RM,^Ocx/l}#T (wK]hz9t;GhF~8@qUnJML-uR|0L/V(I* <yD;t9N#[');
define('LOGGED_IN_KEY',    'vojQo+M`]0J==o |v_, < Z+Q*hYJPU|0.l6=Dzgr+O,@(v`h<nssHGDlp{?=|5H');
define('NONCE_KEY',        'u6CFz!P%?&T xE@mYOVtX0hB+A{[>kYhEq-kYaAg-<Chu*vVttp>&6FuBm],1.c&');
define('AUTH_SALT',        '-5nO?>8dt:+`NF>cmeXcRf&zaN<pIf-|WqK|1S(T.KInw&V[3:;Ij2|J+4Te2PKZ');
define('SECURE_AUTH_SALT', 'xH;1tNT2KuoN+{8w2FP7I$<gzj,27u hgPk:>%gHoZ?[GP+FzviW]s/As-;Xm7aP');
define('LOGGED_IN_SALT',   'M2+.V!f,*p;c[|L}d@+^<J-Z(D]{@,9@ln_)v:aL$Q+Npy,=OX#i0=Szw|Tva do');
define('NONCE_SALT',       'ssbye)E!K)Osp2@a4;WtD,?gey*B{X3l}]F-9{q-hU%Rh8FH[yUGz^4lQ-c-EZwI');

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
