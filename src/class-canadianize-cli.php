<?php
/**
 * Generate_Posts class
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

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
class Generate_Posts ( $args ) extends Canadianize {

// Get Post Details.
	$generate_this_number_of_posts = (int) $args[0];
	$author_id                     = (int) $args[1]; // Id of author who to assign generated post to.

	$progress = \WP_CLI\Utils\make_progress_bar( 'Generating Posts', $generate_this_number_of_posts );

	for ( $i = 0; $i < $generate_this_number_of_posts; $i ++ ) {

		$new_post = array(
			'post_title'   => new Make_Content( 1, 1 ),
			'post_status'  => 'publish',
			'post_author'  => $author_id,
			'post_type'    => 'post',
			'post_content' => new Make_Content( 3, 10 ),
		'tags_input'  => [ 'generated' , 'Canada', new Verb, new Noun, new Place],
			//'meta_input'  => $assoc_args, // Simply passes all key value pairs to posts generated that can be used in testing.
		);

		// Insert the post into the database.
		wp_insert_post( $new_post );

		$progress->tick();
	}

	$progress->finish();
	\WP_CLI::success( $generate_this_number_of_posts . ' posts generated!' ); // Prepends Success to message
}


}
