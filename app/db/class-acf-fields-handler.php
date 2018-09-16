<?php

namespace ACF_Booster\DB;

use ACF_Booster\Traits\Singleton;
use \ACF_Booster\Interfaces\Singleton as SingletonInterace;


/**
 * Class ACF_Fields_Handler
 *
 * @package ACF_Booster
 */
class ACF_Fields_Handler extends DB implements SingletonInterace {

	use Singleton;


	/**
	 * Init function
	 *
	 * @param \wpdb $db
	 * @param $table_name string
	 * @param $fields array
	 */
	public function init( $db, $table_name, $fields ) {
		parent::init( $db, $table_name, $fields );

		foreach ( $this->fields as $field ) {
			add_filter(
				"acf/update_value/name={$field}",
				[ $this, 'update', ], 10, 3
			);
		}
	}


	/**
	 * @param $value
	 * @param $post_id
	 * @param $field
	 *
	 * @return string
	 */
	public function update( $value, $post_id, $field ) {
		$res = $this->db->update(
			$this->table_name,
			[ $field['name'] => $value ],
			[ 'post_id' => $post_id ]
		);

		if ( 0 === $res ) { //could not update - does not exist, insert
			$this->insert( $value, $post_id, $field );
		}

		return $value;
	}


	/**
	 * @param $value
	 * @param $post_id
	 * @param $field
	 *
	 * @return false|int
	 */
	private function insert( $value, $post_id, $field ) {
		$res = $this->db->insert(
			$this->table_name,
			[
				'post_id'      => $post_id,
				$field['name'] => $value,
			]
		);

		return $res;
	}

}
