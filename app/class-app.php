<?php

namespace ACF_Custom_Table;

use ACF_Custom_Table\Interfaces\Singleton;
use ACF_Custom_Table\Traits\Singleton as SingletonTrait;


/**
 * Class App
 */
class App implements Singleton {

	use SingletonTrait;

	const ASSETS_VERSION = '0.1';

	/**
	 * @var \wpdb
	 */
	private $db;

	/**
	 * Init function
	 */
	public function init() {
		global $wpdb;
		$this->db = $wpdb;
		register_activation_hook( ACFCT_PLUGIN_FILE, [ $this, 'plugin_activate' ] );
		$this->get_fields_handler()->init();
	}

	public function plugin_activate() {
		$this->create_acf_fields_table();
	}

	private function create_acf_fields_table() {
		$params = $this->get_params();
		$this->get_table_creator()
		     ->init( $this->db, $params['table_name'], $params['fields'] )
		     ->create_table();
	}

	/**
	 * @return ACF_Fields_Handler
	 * */
	private function get_fields_handler() {
		return ACF_Fields_Handler::instance();
	}

	/**
	 * @return Table_Creator
	 * */
	private function get_table_creator() {
		return Table_Creator::instance();
	}

	private function get_params() {
		$params = [
			'table_name' => $this->db->prefix . 'acf_fields',
			'fields' => [
				'proxima_fecha_de_revision',
				'estado_de_la_reclamacion',
			],
		];

		return $params;
	}
}
