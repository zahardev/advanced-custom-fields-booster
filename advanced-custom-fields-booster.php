<?php
/*
 Plugin Name: Adanced Custom Fields Booster
 Author: Sergey Zaharchenko
 Author URI:  https://github.com/zahardoc
 Description: This plugin modifies default ACF behavior: it allows to save fields and get them using the custom table. It drastically increases the speed of searching by ACF field values on sites with a big amount of rows in the wp_postmeta table.
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
