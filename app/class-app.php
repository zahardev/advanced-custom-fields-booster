<?php

namespace ACF_Booster;

use ACF_Booster\DB\ACF_Fields_Handler;
use ACF_Booster\DB\Data_Importer;
use ACF_Booster\DB\Table_Creator;
use ACF_Booster\Interfaces\Singleton;
use ACF_Booster\Traits\Singleton as SingletonTrait;


/**
 * Class App
 *
 * @package ACF_Booste
 */
class App implements Singleton {

	use SingletonTrait;

	/**
	 * @var \wpdb
	 */
	private $db;

	/**
	 * @var Table_Creator
	 */
	private $table_creator;

	/**
	 * @var Data_Importer
	 */
	private $data_importer;

	/**
	 * @var ACF_Fields_Handler
	 */
	private $fields_handler;


	/**
	 * Init function
	 */
	public function init() {
		global $wpdb;
		$this->db = $wpdb;
		register_activation_hook( ACFBOOSTER_PLUGIN_FILE, [
			$this,
			'plugin_activate',
		] );
		register_deactivation_hook( ACFBOOSTER_PLUGIN_FILE, [
			$this,
			'plugin_deactivate',
		] );

		$this->get_fields_handler();
	}


	/**
	 * Plugin activate actions
	 */
	public function plugin_activate() {
		$this->get_table_creator()->create_table();
		$this->get_data_importer()->import_data();
	}

	/**
	 * Plugin deactivate actions
	 */
	public function plugin_deactivate() {
		$this->get_table_creator()->drop_table();
	}


	/**
	 * @return ACF_Fields_Handler
	 * */
	private function get_fields_handler() {
		if(empty($this->fields_handlerr)){
			$params = $this->get_params();
			$this->fields_handler = ACF_Fields_Handler::instance();
			$this->fields_handler->init( $this->db, $params['table_name'], $params['fields'] );
		}

		return $this->fields_handlerr;
	}

	/**
	 * @return Table_Creator
	 * */
	private function get_table_creator() {
		if(empty($this->table_creator)){
			$params = $this->get_params();
			$this->table_creator = Table_Creator::instance();
			$this->table_creator->init( $this->db, $params['table_name'], $params['fields'] );
		}

		return $this->table_creator;
	}

	/**
	 * @return Data_Importer
	 */
	private function get_data_importer() {
		if(empty($this->data_importer)){
			$params = $this->get_params();
			$this->data_importer = Data_Importer::instance();
			$this->data_importer->init( $this->db, $params['table_name'], $params['fields'] );
		}

		return $this->data_importer;
	}



	/**
	 * @return array
	 */
	private function get_params() {
		$params = [
			'table_name' => $this->db->prefix . 'acf_fields',
			'fields'     => [
				'proxima_fecha_de_revision',
				'estado_de_la_reclamacion',
			],
		];

		return $params;
	}
}
