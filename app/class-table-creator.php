<?php

namespace ACF_Custom_Table;

use ACF_Custom_Table\Interfaces\Singleton;
use ACF_Custom_Table\Traits\Singleton as SingletonTrait;

/**
 * Class DAO
 * @package ACF_Custom_Table
 */
class Table_Creator implements Singleton {

	use SingletonTrait;

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
	 *
	 * @return Table_Creator
	 */
	public function init ( $db, $table_name, $fields ) {
		$this->db = $db;
		$this->table_name = $table_name;
		$this->fields = $fields;
		return $this;
	}


	/**
	 * Creates ACF fields table
	 */
	public function create_table() {
		$sql = sprintf("CREATE TABLE `%s` (
				  `post_id` bigint(20) NOT NULL AUTO_INCREMENT,
				  %s PRIMARY KEY  (`post_id`) ) %s;",
			$this->table_name,
			$this->generate_fields_sql(),
			$this->db->get_charset_collate()
		);


		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}


	/**
	 * @return string
	 */
	private function generate_fields_sql() {
		$fields = '';
		foreach ( $this->fields as $field ) {
			$fields .= sprintf("`%s` varchar(255) DEFAULT '' NOT NULL,", $field);
		}

		return $fields;
	}


}
