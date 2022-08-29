<?php
/**
 * This config file is yours to hack on. It will work out of the box on Pantheon
 * but you may find there are a lot of neat tricks to be used here.
 *
 * See our documentation for more details:
 *
 * https://pantheon.io/docs
 */
require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Dotenv\Dotenv;

try {
    $dotenv = new Dotenv();

    if (file_exists(__DIR__ . '/.env')) {
        $dotenv->load(__DIR__ . '/.env');
    } else {
        $dotenv->load(__DIR__ . '/.env.lando');
    }

} catch (Symfony\Component\Dotenv\Exception\PathException $e) {
    die('The dotEnv file is missing.');
}

// ** MySQL settings - You can get this info from your web host ** //
/**
 * The name of the database for WordPress
 */
define('DB_NAME', $_ENV['DB_NAME'] ?? 'wordpress');

/**
 * MySQL database username
 */
define('DB_USER', $_ENV['DB_USER'] ?? 'wordpress');

/**
 * MySQL database password
 */
define('DB_PASSWORD', $_ENV['DB_PASSWORD'] ?? 'wordpress');

/**
 * MySQL hostname
 */
define('DB_HOST', $_ENV['DB_HOST'] ?? 'database');

/**
 * Database Charset to use in creating database tables.
 */
define('DB_CHARSET', 'utf8');

/**
 * The Database Collate type. Don't change this if in doubt.
 */
define('DB_COLLATE', '');

/**
 * Configure HTTPS redirects
 */
$_SERVER['HTTPS'] = $_ENV['HTTPS'] ?? 'on';

if (!empty($_ENV['ROLLBAR_ACCESS_TOKEN'])) {
    define('ROLLBAR_ACCESS_TOKEN',$_ENV['ROLLBAR_ACCESS_TOKEN']);
}


define('AUTH_KEY',         '6;p&@u36V<GA8;ZpnYq5oSUExEg!mwaXxjN!Hisw~`Z%?sgt<w/l<;3|),zwC4X-');
define('SECURE_AUTH_KEY',  '=X TsmSbkf9DxXo.iO8mYD+U%]VyI%tcrH}&cV$o2ip Ybce/kAp}V0_FB:,~<rG');
define('LOGGED_IN_KEY',    'SlMKF)2*Vs>C$A_3;w6o`tc,}&=,p>!Npa4QB~l[3?u0^+UIF|8TqJVs9A5FqI:(');
define('NONCE_KEY',        '?Md(x`a@qZFfbBS!6>bp~(c-2r`27h_/nFWeW6.+OYNP}.]V=$I^WfubqfrUTpLl');
define('AUTH_SALT',        '46c5nYeq_:/e!%e0CN++h#_%9R8AvK|C.hC|0$!9d<(JGtp;n-*J`OWZogUh,v[@');
define('SECURE_AUTH_SALT', '#7s^-?+pY8!E}Yb)N#RI_i+3]C`LwG~2l#;ISE3xm{{g{A+]L~GYb_BJZ52>*+N6');
define('LOGGED_IN_SALT',   'vBf)xcQ6^%:/fcuX+U;Hm9^)^0*;#m1l[O[a%nF)=aA!ZJ+]b6CmRVL,XbBZul$B');
define('NONCE_SALT',       'bMu`5y5|^U-U13{3|7kRYi0,Q56|3-lK]`}nuPQ6|@/-.~uvPe8(8-Vzf}67.F)^');

/** Standard wp-config.php stuff from here on down. **/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * This enables debugging in all environments except test and live.
 * Debug logging and display (to end user) can be controlled using the
 * WP_DEBUG_LOG and WP_DEBUG_DISPLAY environment variables, respectively.
 * Both are enabled by defualt.
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define('WP_DEBUG', false);
}

/* That's all, stop editing! Happy Pressing. */




/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
