<?php

namespace ACF_Custom_Table;

/**
 * Class DAO
 * @package ACF_Custom_Table
 */
/**
 * Class DAO
 * @package ACF_Custom_Table
 */
class DAO {

	/**
	 * @var \wpdb
	 */
	private $db;

	/**
	 * @var string
	 */
	private $table_name;

	/**
	 * @var array
	 */
	private $fields;


	/**
	 * DAO constructor.
	 *
	 * @param \wpdb $db
	 * @param $table_name string
	 * @param $fields array
	 */
	public function __construct( $db, $table_name, $fields ) {
		$this->db = $db;
		$this->table_name = $table_name;
		$this->fields = $fields;
		//$this->check_table();
	}

}
