<?php
/**
 * Canadianize
 *
 *
 * @package      Canadianize
 * @author       Lisa Schuyler
 * @copyright    2022 lschuyler
 * @license      GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Canadianize
 * Plugin URI:        https://github.com/lschuyler/canadianize
 * Description:       The start of a Canadian random content generator.
 * Version:           0.1.0
 * Author:            Lisa Schuyler
 * Author URI:        https://lisa.blog
 * Text Domain:       canadianize
 * License:           GPL-2.0-or-later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/lschuyler/canadianize
 * Requires PHP:      7.4
 * Requires WP:       5.8
 */

namespace Canadianize;

require __DIR__ . '/src/class-make-content.php';
require __DIR__ . '/src/class-create-posts.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	include_once __DIR__ . '/src/class-canadianize-cli.php';
}

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( version_compare( PHP_VERSION, '7.4', '<' ) ) {
	add_action( 'plugins_loaded', 'canadianize_init_deactivation' );

	/**
	 * Initialise deactivation functions.
	 */
	function canadianize_init_deactivation() {
		if ( current_user_can( 'activate_plugins' ) ) {
			add_action( 'admin_init', 'canadianize_deactivate' );
			add_action( 'admin_notices', 'canadianize_deactivation_notice' );
		}
	}

	/**
	 * Deactivate the plugin.
	 */
	function canadianize_deactivate() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
	}

	/**
	 * Show deactivation admin notice.
	 */
	function canadianize_deactivation_notice() {
		$notice = sprintf(
		// Translators: 1: Required PHP version, 2: Current PHP version.
			'<strong>Plugin Canadianize</strong> requires PHP %1$s to run. This site uses %2$s, so the plugin has been <strong>deactivated</strong>.',
			'7.4',
			PHP_VERSION
		);
		?>
        <div class="updated"><p><?php echo wp_kses_post( $notice ); ?></p></div>
		<?php
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- not using value, only checking if it is set.
		if ( isset( $_GET['activate'] ) ) {
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- not using value, only checking if it is set.
			unset( $_GET['activate'] );
		}
	}

	return false;
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\canadianize_initialize_plugin' );

// Initialize the plugin.
function canadianize_initialize_plugin(): void {
	$GLOBALS['canadianize'] = new Canadianize();
	$GLOBALS['canadianize']->run();
}
