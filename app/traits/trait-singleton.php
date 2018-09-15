<?php

namespace ACF_Booster\Traits;


/**
 * Trait Singleton
 */
trait Singleton {

	private static $instance;

	protected function __construct() {
	}

	public static function instance() {
		if ( empty( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}
}
