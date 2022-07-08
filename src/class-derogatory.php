<?php
/**
 * Derogatory class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Derogatory class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Derogatory extends Canadianize {

	// The name of a Canadian person.
	public $name;

	// Array of Canadian names.
	public $derogatory;

	// Filename to grab derogatory names from.
	public $filename = __DIR__ . '/default_txt/derogatory.txt';

	public function __construct() {
		$this->derogatory = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name       = $this->create_derogatory();
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
	public function create_derogatory(): string {
		return $this->derogatory[ array_rand( $this->derogatory ) ];
	}

}
