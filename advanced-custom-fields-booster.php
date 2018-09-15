<?php
/*
 Plugin Name: Advanced Custom Fields Booster
 Author: Sergey Zaharchenko
 Author URI:  https://github.com/zahardoc
 Description: This plugin boosts speed of searching by ACF fields.
 License:     GPL2
*/

if ( ! function_exists( 'add_action' ) ) {
    exit;
}

define( 'ACFBOOSTER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACFBOOSTER_PLUGIN_FILE', __FILE__ );
define( 'ACFBOOSTER_PLUGIN_BASENAME', plugin_basename(__FILE__));
define( 'ACFBOOSTER_PLUGIN_URL', plugins_url('', __FILE__));

require_once __DIR__ . '/app/interfaces/interface-singleton.php';
require_once __DIR__ . '/app/interfaces/interface-db.php';
require_once __DIR__ . '/app/traits/trait-singleton.php';
require_once __DIR__ . '/app/class-app.php';
require_once __DIR__ . '/app/class-acf-fields-handler.php';
require_once __DIR__ . '/app/db/class-db.php';
require_once __DIR__ . '/app/db/class-table-creator.php';
require_once __DIR__ . '/app/db/class-dao.php';
require_once __DIR__ . '/app/db/class-data-importer.php';

\ACF_Booster\App::instance()->init();
