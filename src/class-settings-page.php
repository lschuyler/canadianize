<?php
/**
 * Settings page class
 *
 * @package lschuyler\Canadianize
 * @since   0.1.0
 */

declare( strict_types=1 );

namespace lschuyler\Canadianize;

use Canadianize;

use WP_Screen;

/**
 * Settings class.
 *
 * @since 0.1.0
 *
 * @package lschuyler\Canadianize
 * @author  Lisa Schuyler
 *
 */
class Settings_Page {

	private $canadianize;

	public function __construct( Canadianize $canadianize ) {
		$this->canadianize = $canadianize;
	}

	public function run(): void {
		add_action( 'admin_menu', array( $this, 'add_to_menu' ) );
		add_action( 'admin_menu', array( $this, 'add_sub_menu' ) );
	}

	/**
	 * Adds the Canadianize settings page in WordPress settings menu.
	 */
	public function add_to_menu(): void {
		add_menu_page(
			__( 'Canadianize Settings', 'canadianize' ),
			__( 'Canadianize', 'canadianize' ),
			Canadianize::CAPABILITY,
			Canadianize::MENU_SLUG,
			canadianize_settings_page,
			'dashicons-smiley',
			99
		);
	}

	/**
	 * Adds the Canadianize settings page in WordPress settings menu.
	 */
	public function add_sub_menu(): void {
		add_submenu_page(
			__( 'Canadianize Settings', 'canadianize' ),
			__( 'Generate Canadian Random Content', 'canadianize' ),
			__( 'Generate', 'canadianize' ),
			Canadianize::CAPABILITY,
			Canadianize::MENU_SLUG,
			canadianize_generate_page,
			'dashicons-smiley'
		);
	}
}
