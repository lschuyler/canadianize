<?php
/**
 * Vehicle class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Vehicle class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Vehicle extends Canadianize {

	// The name of a Canadian vehicle.
	public $name;

	// Array of vehicles.
	public $vehicle;

	// Filename to grab vehicle names from.
	public $filename = __DIR__ . '/default_txt/vehicle.txt';

	public function __construct() {
		$this->vehicle = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name    = $this->create_vehicle();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $vehicle array and return it.
	 *
	 * @return string Returns a Canadian vehicle.
	 * @since 0.1.0
	 *
	 */
	public function create_vehicle(): string {
		return $this->vehicle[ array_rand( $this->vehicle ) ];
	}

}
