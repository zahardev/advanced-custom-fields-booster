<?php

namespace ACF_Custom_Table\DB;
use ACF_Custom_Table\Traits\Singleton;
use \ACF_Custom_Table\Interfaces\Singleton as SingletonInterace;


/**
 * Class Table_Creator
 * @package ACF_Booster
 */
class Table_Creator extends DB implements SingletonInterace {

	use Singleton;

	/**
	 * Creates ACF fields table
	 */
	public function create_table() {
		$sql = sprintf( "CREATE TABLE IF NOT EXISTS `%s` (
				  `post_id` bigint(20) NOT NULL UNIQUE,
				  %s PRIMARY KEY  (`post_id`) ) %s;",
			$this->table_name,
			$this->generate_fields_sql(),
			$this->db->get_charset_collate()
		);

		$this->db->query( $sql );
	}

	public function drop_table() {
		$sql = sprintf( "DROP TABLE IF EXISTS `%s`",
			$this->table_name
		);

		$this->db->query( $sql );
	}


	/**
	 * @return string
	 */
	private function generate_fields_sql() {
		$fields = '';
		foreach ( $this->fields as $field ) {
			$fields .= sprintf( "`%s` varchar(255) DEFAULT '' NOT NULL,", $field );
		}

		return $fields;
	}
}
