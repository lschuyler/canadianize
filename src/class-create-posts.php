<?php
/**
 * Create_Posts class
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;

class Create_Posts {

	public function generate_title(): string {
		$title = (string) new Make_Content( 1, 1 );
		if ( strlen( $title ) > 150 ) {
			$title = substr( $title, 0, strpos( $title, ' ', 150 ) );
		}

		return wp_strip_all_tags( $title );
	}

	public function generate_tags(): array {
		$tags = array( "generated", "Canadianized" );
		array_push( $tags, (string) new Verb, (string) new Park, (string) new Food, (string) new Vehicle );

		return $tags;
	}

	public function generate_post_content(): string {
		return (string) new Make_Content( 3, 10 );

	}

	public function generate_category(): array {
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

	public function insert_posts( $args ): void {
		// If no $args array was passed, set some defaults.
		if ( ! $args ) {
			$args = array( 1, 1 );
		}

		$generate_this_number_of_posts = (int) $args[0];
		$author_id                     = (int) $args[1]; // Id of author who to assign generated post to.

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			$progress = \WP_CLI\Utils\make_progress_bar( 'Generating Posts', $generate_this_number_of_posts );
		}
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

			if ( defined( 'WP_CLI' ) && WP_CLI ) {
				$progress->tick();
			}
		}

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			$progress->finish();
		}


	}

}




