<?php

namespace ACF_Custom_Table\DB;

use\ACF_Custom_Table\Interfaces\DB as DBInterface;

/**
 * Class DB
 * @package ACF_Booster
 */
abstract class DB implements DBInterface {

	/**
	 * @var \wpdb
	 */
	protected $db;

	/**
	 * @var string
	 */
	protected $table_name;

	/**
	 * @var array
	 */
	protected $fields;


	/**
	 * DAO constructor.
	 *
	 * @param \wpdb $db
	 * @param $table_name string
	 * @param $fields array
	 *
	 * @return
	 */
	public function init( $db, $table_name, $fields ) {
		if ( empty( $this->db ) ) {
			$this->db         = $db;
			$this->table_name = $table_name;
			$this->fields     = $fields;
		}

		return $this;
	}
}
