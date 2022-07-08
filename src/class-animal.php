<?php
/**
 * Animal class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Person class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Animal extends Canadianize {

	// The name of a Canadian animal.
	public $name;

	// Array of Canadian animals.
	public $animal;

	// Filename to grab animal names from.
	public $filename = __DIR__ . '/default_txt/animal.txt';

	public function __construct() {
		$this->animal = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name   = $this->create_person();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $animal array and return it.
	 *
	 * @return string Returns an animal name.
	 * @since 0.1.0
	 *
	 */
	public function create_person(): string {
		return $this->animal[ array_rand( $this->animal ) ];
	}

}
