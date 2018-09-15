<?php

namespace ACF_Custom_Table\Interfaces;

interface DB {

	public function init( $db, $table_name, $fields );
}
