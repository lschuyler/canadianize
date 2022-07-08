<?php
/**
 * event class
 *
 * @package Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

/**
 * Event class.
 *
 * @since 0.1.0
 *
 * @package Canadianize
 * @author  Lisa Schuyler
 *
 */
class Event extends Canadianize {

	// The name of an event.
	public $name;

	// Array of events.
	public $event;

	// Filename to grab people names from.
	public $filename = __DIR__ . '/default_txt/event.txt';

	public function __construct() {
		$this->event = $this->fetch_option( get_class( $this ), $this->filename );
		$this->name  = $this->create_event();
	}

	public function __toString(): string {
		return $this->name;
	}

	/**
	 * Generate a random selection from the $event array and return it.
	 *
	 * @return string Returns an event.
	 * @since 0.1.0
	 *
	 */
	public function create_event(): string {
		return $this->event[ array_rand( $this->event ) ];
	}

}
