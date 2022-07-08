<?php
/**
 * Person class
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
class Person extends Canadianize {

	// The name of a Canadian person.
	public $name;

	// Array of Canadian names.
	public $people;

	// Filename to grab people names from.
	public $filename = __DIR__ . '/default_txt/person.txt';

	public function __construct() {
		$this->people = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name   = $this->create_person();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $people array and return it.
	 *
	 * @return string Returns a name.
	 * @since 0.1.0
	 *
	 */
	public function create_person(): string {
		return $this->people[ array_rand( $this->people ) ];
	}

}
