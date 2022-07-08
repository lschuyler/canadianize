<?php
/**
 * Place class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Place class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Place extends Canadianize {

	// The name of a Canadian place.
	public $name;

	// Array of Canadian places.
	public $place;

	// Filename to grab people names from.
	public $filename = __DIR__ . '/default_txt/place.txt';

	public function __construct() {
		$this->place = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name  = $this->create_place();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $place array and return it.
	 *
	 * @return string Returns a place name.
	 * @since 0.1.0
	 *
	 */
	public function create_place(): string {
		return $this->place[ array_rand( $this->place ) ];
	}

}
