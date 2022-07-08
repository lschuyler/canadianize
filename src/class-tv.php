<?php
/**
 * Tv class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Tv class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Tv extends Canadianize {

	// The name of a Canadian tv.
	public $name;

	// Array of tvs.
	public $tv;

	// Filename to grab TV show names from.
	public $filename = __DIR__ . '/default_txt/tv.txt';

	public function __construct() {
		$this->tv   = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name = $this->create_tv();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $tv array and return it.
	 *
	 * @return string Returns a Canadian tv show.
	 * @since 0.1.0
	 *
	 */
	public function create_tv(): string {
		return $this->tv[ array_rand( $this->tv ) ];
	}

}
