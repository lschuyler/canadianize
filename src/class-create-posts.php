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
	 * Cache for attachment IDs to avoid duplicate uploads
	 *
	 * @var array
	 */
	private $attachment_cache = [];

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
			$post_id = wp_insert_post( $new_post );

			// Set featured image if post was created successfully
			if ( $post_id && ! is_wp_error( $post_id ) ) {
				$this->set_featured_image( $post_id );
			}

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

	/**
	 * Set a random Canadian-themed featured image from our plugin's image collection
	 *
	 * @param int $post_id The ID of the post to set the image for
	 * @return void
	 */
	private function set_featured_image( int $post_id ): void {
		// Get a random image from our plugin's images directory
		$images_dir = plugin_dir_path( dirname( __FILE__ ) ) . 'assets/images/';
		
		if ( ! is_dir( $images_dir ) ) {
			return;
		}

		$images = array_merge(
			glob( $images_dir . '*.jpg' ) ?: [],
			glob( $images_dir . '*.jpeg' ) ?: [],
			glob( $images_dir . '*.png' ) ?: [],
			glob( $images_dir . '*.gif' ) ?: []
		);
		
		if ( empty( $images ) ) {
			return;
		}

		$random_image = $images[array_rand( $images )];
		$image_basename = basename( $random_image );
		
		// Check if we already uploaded this image
		if ( ! isset( $this->attachment_cache[$image_basename] ) ) {
			$existing_attachment = $this->get_existing_attachment( $image_basename );
			
			if ( $existing_attachment ) {
				$this->attachment_cache[$image_basename] = $existing_attachment;
			} else {
				// Upload new image if it doesn't exist
				$file_array = array(
					'name'     => $image_basename,
					'tmp_name' => $random_image
				);

				$tmp = wp_tempnam( $random_image );
				if ( ! copy( $random_image, $tmp ) ) {
					return;
				}
				$file_array['tmp_name'] = $tmp;

				$attachment_id = media_handle_sideload( $file_array, $post_id );

				if ( ! is_wp_error( $attachment_id ) ) {
					$this->attachment_cache[$image_basename] = $attachment_id;
				}
			}
		}

		// Set the featured image using cached attachment ID
		if ( isset( $this->attachment_cache[$image_basename] ) ) {
			set_post_thumbnail( $post_id, $this->attachment_cache[$image_basename] );
		}
	}

	/**
	 * Check if image already exists in media library
	 *
	 * @param string $filename The filename to check
	 * @return int|null Attachment ID if exists, null otherwise
	 */
	private function get_existing_attachment( string $filename ): ?int {
		$args = array(
			'post_type' => 'attachment',
			'post_status' => 'inherit',
			'posts_per_page' => 1,
			'title' => pathinfo( $filename, PATHINFO_FILENAME )
		);

		$query = new \WP_Query( $args );

		if ( $query->have_posts() ) {
			return $query->posts[0]->ID;
		}

		return null;
	}

}
