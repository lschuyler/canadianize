<?php
/**
 * Adjectives class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Adjective class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Adjective extends Canadianize {

	// The name of a Canadian adjective.
	public $name;

	// Array of Canadian adjectives.
	public $adjective;

	// Filename to grab people names from.
	public $filename = __DIR__ . '/default_txt/adjective.txt';

	public function __construct() {
		$this->adjective = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name      = $this->create_adjective();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $adjective array and return it.
	 *
	 * @return string Returns a adjective name.
	 * @since 0.1.0
	 *
	 */
	public function create_adjective(): string {
		return $this->adjective[ array_rand( $this->adjective ) ];
	}

}
