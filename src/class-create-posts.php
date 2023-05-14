<?php
/**
 * Create_Posts class
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

use function WP_CLI\Utils\make_progress_bar;

class Create_Posts {

	/**
	 * Create a string to represent the title.
	 *
	 * Grabs a generated sentence and shortens it to a reasonable length.
	 *
	 * @return string $title
	 */
	public function generate_title(): string {
		$sentences_obj = new Make_Content( 1, 1 );
		$title         = wp_strip_all_tags( $sentences_obj->sentence ); // Remove block paragraph formatting tags.
		if ( strlen( $title ) > 150 ) {
			// If we can cut off a long sentence on a space, let's do it.
			$space_checker = strpos( $title, ' ', 150 );
			if ( $space_checker ) { // If a space was found, then splice the title/sentence there.
				$title = substr( $title, 0, strpos( $title, ' ', 150 ) );
			}
		}

		return $title;
	}

	/**
	 * Generate an array of tags to be assigned to a new post.
	 *
	 * @return string[] $tags
	 */
	public function generate_tags(): array {
		$tags = array( "generated", "Canadianized" );
		array_push( $tags, (string) new Verb, (string) new Park, (string) new Food, (string) new Vehicle );

		return $tags;
	}

	/**
	 * Create a new instance of the Make_Content class, representing the content of the new post.
	 *
	 * @return string
	 */
	public function generate_post_content(): string {
		return (string) new Make_Content( 3, 10 );

	}

	/**
	 * Create a category array to assign to the new post.
	 *
	 * @return array
	 */
	public function generate_category(): array {
		// Make a Canadianize category - check if it exists first.
		$category       = (string) new Noun;
		$category_array = term_exists( $category, 'category' );
		if ( is_null( $category_array ) || ( $category_array === 0 ) ) {
			// Then it doesn't exist, so let's add it.
			$category_array = wp_insert_term( $category, 'category' );
		}

		return $category_array;

	}

	/**
	 * Insert a new post into the database with Canadianize content.
	 * If no $args array was passed, set some defaults - generate 1 post, assigned to author 1.
	 *
	 * @param array $args
	 *
	 * @return void
	 */
	public function insert_posts( array $args = [1, 1] ): void {

		$generate_this_number_of_posts = (int) $args[0]; // number of posts to generate.
		$author_id                     = (int) $args[1]; // id of author who to assign generated post to.

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			$progress = make_progress_bar( 'Generating Posts', $generate_this_number_of_posts );
		}

		global $wpdb;
		// Let's update the database every 10 posts, instead of once per post, by turning off the autocommit temporarily.
		$wpdb->query( 'SET autocommit = 0;' );
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

			// Show a progress bar if we're running this from the command line.
			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				$progress->tick();
			}

			// Commit every 10 posts.
			if ( $i % 10 === 0 ) {
				register_shutdown_function( static function () {
					global $wpdb;
					$wpdb->query( 'COMMIT;' );
				} );
			}

		}
		// Commit all the new posts to the database.
		$wpdb->query( 'COMMIT;' );

		// Set the progress bar to finish if we're running this from the command line.
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			$progress->finish();
		}

		// Turn autocommit back on.
		$wpdb->query( 'SET autocommit = 1;' );

	}

}
