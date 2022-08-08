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
 * To do:
 * 1. Add in a stop_the_insanity type call, or some max, or pausing mechanism - any memory implications?
 * 2. Handle errors in given parameters
 * 3. Add featured image - no, not here, not now, let's put this as an option on the dashboard so the site admin can add image(s) to the Media Library, not this plugin by default.
 */
class Canadianize_Cli {

	private function generate_title(): string {
		$title = (string) new Make_Content( 1, 1 );
		if ( strlen( $title ) > 150 ) {
			$title = substr( $title, 0, strpos( $title, ' ', 150 ) );
		}

		return wp_strip_all_tags( $title );
	}

	private function generate_tags(): array {
		$tags = array( "generated", "Canada" );
		array_push( $tags, (string) new Verb, (string) new Park, (string) new Food, (string) new Vehicle );

		return $tags;
	}

	private function generate_post_content(): string {
		return (string) new Make_Content( 3, 10 );

	}

	private function generate_category(): array {
		// Make a Canadianize category - check if it exists first.
		$category       = (string) new Noun;
		$category_array = term_exists( $category, 'category' );
		if ( is_null( $category_array ) || ( $category_array === 0 ) ) {
			// Then it doesn't exist, so let's add it.
			$category_array = wp_insert_term( $category, 'category' );
			if ( is_wp_error( $category_array ) ) {
				error_log( print_r( "*** Oh no! Category wasn't added!?", true ) );
			}
		}

		return $category_array;

	}

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
		// If no $args array was passed, set some defaults.
		if ( ! $args ) {
			$args = array( 1, 1 );
		}

		$generate_this_number_of_posts = (int) $args[0];
		$author_id                     = (int) $args[1]; // Id of author who to assign generated post to.

		$progress = \WP_CLI\Utils\make_progress_bar( 'Generating Posts', $generate_this_number_of_posts );

		for ( $i = 0; $i < $generate_this_number_of_posts; $i ++ ) {

			// Make a new post.
			$new_post = array(
				'post_title'    => $this->generate_title(),
				'post_status'   => 'publish',
				'post_author'   => $author_id,
				'post_type'     => 'post',
				'post_content'  => $this->generate_post_content(),
				'tags_input'    => $this->generate_tags(),
				'post_category' => $this->generate_category(),
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

