<?php

namespace ACF_Custom_Table;

use ACF_Custom_Table\Interfaces\Singleton;
use ACF_Custom_Table\Traits\Singleton as SingletonTrait;


/**
 * Class Controller
 */
class Controller implements Singleton {

	use SingletonTrait;

	const ASSETS_VERSION = '0.1';

	/**
	 * Init function
	 */
	public function init() {
		if ( is_admin() ) {
			return;
		}

		$this->do_something_amazing();
	}

	public function do_something_amazing() {

	}
}
