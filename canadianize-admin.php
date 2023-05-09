<?php
/**
 * Displays the dashboard admin subpage.
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

use Canadianize\Create_Posts;

require_once __DIR__ . '/src/class-create-posts.php';

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( __( 'You do not have sufficient permissions to access this page.', 'canadianize' ) );
}

if ( isset( $_POST['generate_this_number_of_posts'] ) ) {

	// Validate nonce.
	check_admin_referer( 'generate-posts' );

	$create_the_posts = new Create_Posts();
	$args             = array( (int) $_POST['generate_this_number_of_posts'], get_current_user_id() );
	$create_the_posts->insert_posts( $args );

    // Print success message.
	?>
    <div class="notice notice-success is-dismissible"><p><?php _e( 'Success! Posts added' ); ?>.</p></div>
	<?php

}

?>

<h1><?php _e( 'Canadianize 🇨🇦', 'canadianize' ); ?></h1>

<h2><?php _e( 'Generate Posts', 'canadianize' ); ?></h2>
<p>Add new posts with random Canadianized text.</p>
<form action="<?php echo admin_url( 'tools.php?page=canadianize' ); ?>" method="post">
	<input type="hidden" name="generate_this_number_of_posts" value="1">
	<?php wp_nonce_field( 'generate-posts' ); ?>
	<input type="submit" value="Generate 1 posts">
</form>
<br /><form action="<?php echo admin_url( 'tools.php?page=canadianize' ); ?>" method="post">
    <input type="hidden" name="generate_this_number_of_posts" value="10">
	<?php wp_nonce_field( 'generate-posts' ); ?>
    <input type="submit" value="Generate 10 posts">
</form>
<br />
<form action="<?php echo admin_url( 'tools.php?page=canadianize' ); ?>" method="post">
    <input type="hidden" name="generate_this_number_of_posts" value="100">
	<?php wp_nonce_field( 'generate-posts' ); ?>
    <input type="submit" value="Generate 100 posts">
</form>

