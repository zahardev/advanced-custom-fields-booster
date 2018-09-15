<?php

namespace ACF_Custom_Table;

use ACF_Custom_Table\DB\DAO;
use ACF_Custom_Table\Interfaces\Singleton;
use ACF_Custom_Table\Traits\Singleton as SingletonTrait;


/**
 * Class ACF_Fields_Handler
 *
 * @package ACF_Booster
 */
class ACF_Fields_Handler implements Singleton {

	use SingletonTrait;

	/**
	 * @var
	 */
	private $dao;

	/**
	 * Init function
	 */
	public function init() {
		if ( ! is_admin() ) {
			return;
		}

		$this->init_dao();

		foreach ( $this->get_supported_fields() as $field ) {
			add_filter( "acf/update_value/name={$field}", [ $this, 'update', ], 10, 3 );
		}
	}

	private function init_dao() {
		global $wpdb;

		//$this->dao = new DAO($wpdb, $wpdb->prefix . 'acf_fields', $this->get_supported_fields());
	}


	/**
	 * @param $value
	 * @param $post_id
	 * @param $field
	 *
	 * @return string
	 */
	public function update( $value, $post_id, $field ) {
		return $value;
	}

	/**
	 *
	 */
	public function delete() {

	}

	/**
	 * @return array
	 */
	public function get_supported_fields() {
		return [
			'proxima_fecha_de_revision',
			'estado_de_la_reclamacion',
		];
	}
}
