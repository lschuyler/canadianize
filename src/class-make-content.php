<?php
/**
 * Make_Content class
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

//use Canadianize\Person;

// do I need this line?
//use Couchbase\View;

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

	public function make_the_content( $sentences_per_paragraph, $number_of_paragraphs ): string {

		// shuffle up the sentence array before grabbing some
		//shuffle( $canadian_sentences );

		$paragraph = "";

		for ( $y = 0; $y < $number_of_paragraphs; $y ++ ) {
			$paragraph .= '<!-- wp:paragraph {"placeholder":"Post Paragraph"} --><p>';
			for ( $x = 0; $x < $sentences_per_paragraph; $x ++ ) {
				$paragraph .= wp_strip_all_tags( new Sentences ) . " ";
			}
			$paragraph .= "</p><!-- /wp:paragraph -->";
		}

		return $paragraph;
	}

	public function __construct( int $sentences_per_paragraph = 3, int $number_of_paragraphs = 5 ) {
		$this->sentence = $this->make_the_content( $sentences_per_paragraph, $number_of_paragraphs );
	}

	public function __toString(): string {
		return $this->sentence;
	}

}
