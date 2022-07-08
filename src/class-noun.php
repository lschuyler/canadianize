<?php
/**
 * Noun class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Noun class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Noun extends Canadianize {

	// The name of a Canadian noun.
	public $name;

	// Array of nouns.
	public $noun;

	// Filename to grab noun names from.
	public $filename = __DIR__ . '/default_txt/noun.txt';

	public function __construct() {
		$this->noun = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name = $this->create_noun();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $noun array and return it.
	 *
	 * @return string Returns a Canadian noun.
	 * @since 0.1.0
	 *
	 */
	public function create_noun(): string {
		return $this->noun[ array_rand( $this->noun ) ];
	}

}
