<?php
/*
 Plugin Name: Custom Tables for ACF
 Author: Sergey Zaharchenko
 Author URI:  https://github.com/zahardoc
 Description: This plugin modifies default ACF behavior: it allows to save fields not in the wp_postmeta table, but in the custom table. It drastically increases performance on sites with a big amount of rows in the wp_postmeta table.
 License:     GPL2

ACF_Custom_Table is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Stripe Payments Custom Fields is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Stripe Payments Custom Fields. If not, see {License URI}.

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
