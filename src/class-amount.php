<?php
/**
 * Amount class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Amount class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Amount extends Canadianize {

	// The name of an amount.
	public $name;

	// Array of amounts.
	public $amount;

	// Filename to grab people names from.
	public $filename = __DIR__ . '/default_txt/amount.txt';

	public function __construct() {
		$this->amount = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name   = $this->create_amount();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $amount array and return it.
	 *
	 * @return string Returns an amount.
	 * @since 0.1.0
	 *
	 */
	public function create_amount(): string {
		return $this->amount[ array_rand( $this->amount ) ];
	}

}
