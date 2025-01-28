<?php
/**
 * Make_Content class.
 *
 * @since 0.1.0
 *
 * @package lschuyler\Canadianize
 * @author  Lisa Schuyler
 *
 */

declare( strict_types=1 );

namespace Canadianize;

require __DIR__ . '/class-canadianize.php';

require __DIR__ . '/class-adjective.php';
require __DIR__ . '/class-amount.php';
require __DIR__ . '/class-animal.php';
require __DIR__ . '/class-clothing.php';
require __DIR__ . '/class-derogatory.php';
require __DIR__ . '/class-event.php';
require __DIR__ . '/class-food.php';
require __DIR__ . '/class-highway.php';
require __DIR__ . '/class-music.php';
require __DIR__ . '/class-noun.php';
require __DIR__ . '/class-park.php';
require __DIR__ . '/class-person.php';
require __DIR__ . '/class-place.php';
require __DIR__ . '/class-store.php';
require __DIR__ . '/class-team.php';
require __DIR__ . '/class-tv.php';
require __DIR__ . '/class-vehicle.php';
require __DIR__ . '/class-verb.php';
require __DIR__ . '/class-sentences.php';

/**
 * Make_Content class.
 *
 * @since 0.1.0
 *
 * @package lschuyler\Canadianize
 * @author  Lisa Schuyler
 *
 */
class Make_Content extends Canadianize {

	public $sentence;

	/**
	 * Constructor for the class.
	 *
	 * @param int $sentences_per_paragraph
	 * @param int $number_of_paragraphs
	 */
	public function __construct( int $sentences_per_paragraph = 3, int $number_of_paragraphs = 5 ) {
		$this->sentence = $this->make_the_content( $sentences_per_paragraph, $number_of_paragraphs );
	}

	/**
	 * Generate the text content, organized into sentences and paragraphs.
	 *
	 * @param $sentences_per_paragraph
	 * @param $number_of_paragraphs
	 *
	 * @return string
	 */
	public function make_the_content( $sentences_per_paragraph, $number_of_paragraphs ): string {
		$paragraph = "";

		for ( $y = 0; $y < $number_of_paragraphs; $y++ ) {
			$paragraph .= '<!-- wp:paragraph {"placeholder":"Post Paragraph"} --><p>';
			for ( $x = 0; $x < $sentences_per_paragraph; $x++ ) {
				$paragraph_obj = new Sentences;
				$paragraph .= wp_strip_all_tags( (string) $paragraph_obj ) . " ";
			}
			$paragraph .= "</p><!-- /wp:paragraph -->";
		}

		return $paragraph;
	}

	/**
	 * Used when a string value is requested from this class.
	 *
	 * @return string
	 */
	public function __toString(): string {
		return $this->sentence;
	}

}
