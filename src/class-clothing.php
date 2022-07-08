<?php
/**
 * Clothing class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Clothing class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Clothing extends Canadianize {

	// The name of a Canadian clothing.
	public $name;

	// Array of Canadian clothing.
	public $clothing;

	// Filename to grab clothing names from.
	public $filename = __DIR__ . '/default_txt/clothing.txt';

	public function __construct() {
		$this->clothing = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name     = $this->create_clothing();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $clothing array and return it.
	 *
	 * @return string Returns a name.
	 * @since 0.1.0
	 *
	 */
	public function create_clothing(): string {
		return $this->clothing[ array_rand( $this->clothing ) ];
	}

}
