<?php
/**
 * Canadianize_Cli class
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

use WP_CLI;

class Canadianize_Cli extends Create_Posts {

	/**
	 * Generate posts with Canadianize filler content.
	 *
	 * ## OPTIONS
	 *
	 * [<generate_this_number_of_posts>]
	 * : Number of paragraphs per post. Default is 1.
	 *
	 * [<author_id>]
	 * : Assign the posts to this author. Default is 1.
	 *
	 * ## EXAMPLES
	 *
	 *      # Create 5 new posts, assigned to author id 1.
	 *      $ wp canadianize 5 1
	 *      Success: 5 posts generated!
	 *
	 * @when after_wp_load
	 */

	public function __invoke( $args ) {

		$this->insert_posts( $args );
	}
}


WP_CLI::add_command( 'canadianize', Canadianize_Cli::class );
