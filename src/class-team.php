<?php
/**
 * Team class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Team class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Team extends Canadianize {

	// The name of a Canadian team.
	public $name;

	// Array of teams.
	public $team;

	// Filename to grab team names from.
	public $filename = __DIR__ . '/default_txt/team.txt';

	public function __construct() {
		$this->team = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name = $this->create_team();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $team array and return it.
	 *
	 * @return string Returns a Canadian team.
	 * @since 0.1.0
	 *
	 */
	public function create_team(): string {
		return $this->team[ array_rand( $this->team ) ];
	}

}
