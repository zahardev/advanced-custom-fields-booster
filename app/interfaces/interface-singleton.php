<?php

namespace ACF_Custom_Table\Interfaces;

interface Singleton {
	public function init();

	public static function instance();
}
