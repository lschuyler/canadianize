<?php
/**
 * Generate_Posts class
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );
//use WP_CLI;
//use WP_CLI\Utils;
namespace Canadianize;

/**
 * Generate_Posts class.
 *
 * @since 0.1.0
 *
 * @package lschuyler\Canadianize
 * @author  Lisa Schuyler
 *
 */
class Canadianize_Cli extends Canadianize {

	public function __invoke( $args ) {
		// Get Post Details.
		$generate_this_number_of_posts = (int) $args[0];
		$author_id                     = (int) $args[1]; // Id of author who to assign generated post to.

		$progress = \WP_CLI\Utils\make_progress_bar( 'Generating Posts', $generate_this_number_of_posts );

		for ( $i = 0; $i < $generate_this_number_of_posts; $i ++ ) {

			$title        = new Make_Content( 1, 1 );
			$post_content = new Make_Content( 3, 10 );

			$new_post = array(
				'post_title'   => substr( (string) $title, 0, strpos( (string) $title, ' ', 100 ) ),
				'post_status'  => 'publish',
				'post_author'  => $author_id,
				'post_type'    => 'post',
				'post_content' => (string) $post_content,
				'tags_input'   => [ 'generated', 'Canada', new Verb, new Noun, new Place ],
				//'post_category' => new Noun,  //needs array of category IDs
			);

			// Insert the post into the database.
			wp_insert_post( $new_post );

			$progress->tick();
		}

		$progress->finish();

		\WP_CLI::success( $generate_this_number_of_posts . ' posts generated!' ); // Prepends Success to message

	}
}

\WP_CLI::add_command( 'canadianize', 'Canadianize\Canadianize_Cli' );

