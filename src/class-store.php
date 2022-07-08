<?php
/**
 * Store class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Store class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Store extends Canadianize {

	// The name of a Canadian store.
	public $name;

	// Array of stores.
	public $store;

	// Filename to grab store names from.
	public $filename = __DIR__ . '/default_txt/store.txt';

	public function __construct() {
		$this->store = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name  = $this->create_store();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $store array and return it.
	 *
	 * @return string Returns a Canadian store.
	 * @since 0.1.0
	 *
	 */
	public function create_store(): string {
		return $this->store[ array_rand( $this->store ) ];
	}

}
