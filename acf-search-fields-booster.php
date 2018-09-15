<?php
/*
 Plugin Name: ACF Search Fields Booster
 Author: Sergey Zaharchenko
 Author URI:  https://github.com/zahardoc
 Description: This plugin modifies default ACF behavior: it allows to save fields in the custom table. It drastically increases searching by ACF fields performance on sites with a big amount of rows in the wp_postmeta table.
 License:     GPL2
*/

if ( ! function_exists( 'add_action' ) ) {
    exit;
}

define( 'ACFCT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ACFCT_PLUGIN_FILE', __FILE__ );
define( 'ACFCT_PLUGIN_BASENAME', plugin_basename(__FILE__));
define( 'ACFCT_PLUGIN_URL', plugins_url('', __FILE__));

require_once __DIR__ . '/app/interfaces/interface-singleton.php';
require_once __DIR__ . '/app/traits/trait-singleton.php';
require_once __DIR__ . '/app/class-app.php';
require_once __DIR__ . '/app/class-table-creator.php';
require_once __DIR__ . '/app/class-acf-fields-handler.php';
require_once __DIR__ . '/app/class-dao.php';

\ACF_Custom_Table\App::instance()->init();
