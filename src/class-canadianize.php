<?php
/**
 * Canadianize class
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace Canadianize;
class Canadianize {

	/**
	 * Declare our constants
	 */
	public const MENU_SLUG = 'canadianize';
	public const OPTIONS_KEY = 'canadianize';
	public const CAPABILITY = 'manage_options';

	public function run(): void {
		add_action( 'admin_menu', array( $this, 'add_to_menu' ) );
	}

	/**
	 * Get the array of items to choose from, from the options table.
	 *
	 * @return array Returns an array of names.
	 * @since 0.1.0
	 *
	 */
	public function fetch_option( $class, $filename ): array {
		// Check if we've got the array already in the options table.
		$list_array = get_option( $class );
		// If the option exists, return it
		if ( $list_array !== false ) { // if we find an option, then we need to build it.
			return $list_array;
		}

		// If the option doesn't exist, add it, return it.
		return $this->create_option( $class, $filename );

	}

	public function create_option( $class, $filename ): array {
		// Otherwise, build array and save it to options
		$list_array = file( $filename, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES );
		if ( $list_array ) {
			add_option( $class, $list_array );
		}

		return $list_array;
	}

	/**
	 * Adds the Canadianize page under the Tools heading on the Dashboard.
	 */
	public function add_to_menu(): void {
		add_management_page(
			__( 'Canadianize', 'canadianize' ),
			__( 'Canadianize 🇨🇦', 'canadianize' ),
			Canadianize::CAPABILITY,
			Canadianize::MENU_SLUG,
			array( $this, 'show_canadianize_admin' ),
			99
		);
	}

	public function show_canadianize_admin(): void {
		$path = plugin_dir_path( __DIR__ ) . 'canadianize-admin.php';
		if ( ! is_readable( $path ) ) {
			return;
		}
		include $path;

	}


}
