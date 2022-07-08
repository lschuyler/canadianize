<?php
/**
 * Food class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Food class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Food extends Canadianize {

	// The name of a Canadian food.
	public $name;

	// Array of foods.
	public $food;

	// Filename to grab food names from.
	public $filename = __DIR__ . '/default_txt/food.txt';

	public function __construct() {
		$this->food = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name = $this->create_food();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $food array and return it.
	 *
	 * @return string Returns a Canadian food.
	 * @since 0.1.0
	 *
	 */
	public function create_food(): string {
		return $this->food[ array_rand( $this->food ) ];
	}

}
