<?php

namespace ACF_Booster\DB;

use ACF_Booster\Traits\Singleton;
use \ACF_Booster\Interfaces\Singleton as SingletonInterace;


/**
 * Class Data_Importer
 * @package ACF_Booster
 */
class Data_Importer extends DB implements SingletonInterace {

	use Singleton;

	/**
	 * Creates ACF fields table
	 */
	public function import_data() {
		$meta = [];
		foreach ( $this->fields as $field ) {
			$meta = array_merge( $meta, $this->get_meta( $field ) );
		}
		$structurized_meta = $this->structurize_meta( $meta );

		$sql = $this->make_sql( $structurized_meta );

		$this->db->query( $sql );
	}


	/**
	 * @param $structurized_meta
	 *
	 * @return string
	 */
	public function make_sql( $structurized_meta ) {
		$sql = sprintf(
			"INSERT INTO `%s` (%s) VALUES %s",
			$this->table_name,
			$this->get_sql_fields(),
			$this->get_sql_values( $structurized_meta )
		);

		return $sql;
	}

	/**
	 * @param $structurized_meta
	 *
	 * @return string
	 */
	private function get_sql_values( $structurized_meta ) {
		$values = [];

		foreach ( $structurized_meta as $post_id => $meta_data ) {
			array_unshift($meta_data, $post_id);
			$values[] = '("' . implode( '", "', $meta_data ) . '")';
		}
		$sql_values = implode( ', ', $values );

		return $sql_values;
	}


	/**
	 * @return string
	 */
	private function get_sql_fields() {
		return 'post_id, ' . implode( ', ', $this->fields );
	}


	/**
	 * @param $to_rebuild
	 *
	 * @return array
	 */
	private function structurize_meta( $to_rebuild ) {
		$rebuilded = [];
		foreach ( $to_rebuild as $row ) {
			$rebuilded[ $row->post_id ][ $row->meta_key ] = $row->meta_value;
		}

		return $rebuilded;
	}

	/**
	 * @param $field
	 *
	 * @return array
	 */
	private function get_meta( $field ) {
		$sql = sprintf(
			'SELECT `post_id`, `meta_key`, `meta_value` FROM %s WHERE meta_key = "%s"',
			$this->db->postmeta, $field
		);
		$res = $this->db->get_results( $sql );

		return $res;
	}


}
