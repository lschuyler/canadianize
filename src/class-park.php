<?php
/**
 * Park class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Park class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Park extends Canadianize {

	// The name of a Canadian park.
	public $name;

	// Array of parks.
	public $park;

	// Filename to grab park names from.
	public $filename = __DIR__ . '/default_txt/park.txt';

	public function __construct() {
		$this->park = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name = $this->create_park();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $park array and return it.
	 *
	 * @return string Returns a Canadian park.
	 * @since 0.1.0
	 *
	 */
	public function create_park(): string {
		return $this->park[ array_rand( $this->park ) ];
	}

}
