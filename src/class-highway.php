<?php
/**
 * Highway class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Highway class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Highway extends Canadianize {

	// The name of a Canadian highway.
	public $name;

	// Array of highways.
	public $highway;

	// Filename to grab highway names from.
	public $filename = __DIR__ . '/default_txt/highway.txt';

	public function __construct() {
		$this->highway = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name    = $this->create_highway();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $highway array and return it.
	 *
	 * @return string Returns a Canadian highway.
	 * @since 0.1.0
	 *
	 */
	public function create_highway(): string {
		return $this->highway[ array_rand( $this->highway ) ];
	}

}
