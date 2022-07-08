<?php
/**
 * Music class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Music class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Music extends Canadianize {

	// The name of a Canadian musician or band.
	public $name;

	// Array of music.
	public $music;

	// Filename to grab music names from.
	public $filename = __DIR__ . '/default_txt/music.txt';

	public function __construct() {
		$this->music = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name  = $this->create_music();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $music array and return it.
	 *
	 * @return string Returns a Canadian musician or band.
	 * @since 0.1.0
	 *
	 */
	public function create_music(): string {
		return $this->music[ array_rand( $this->music ) ];
	}

}
