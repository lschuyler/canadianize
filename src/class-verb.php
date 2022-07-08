<?php
/**
 * Verb class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Verb class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Verb extends Canadianize {

	// The name of a Canadian verb.
	public $name;

	// Array of verbs.
	public $verb;

	// Filename to grab verb names from.
	public $filename = __DIR__ . '/default_txt/verb.txt';

	public function __construct() {
		$this->verb = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name   = $this->create_verb();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $verb array and return it.
	 *
	 * @return string Returns a Canadian verb.
	 * @since 0.1.0
	 *
	 */
	public function create_verb(): string {
		return $this->verb[ array_rand( $this->verb ) ];
	}

}
