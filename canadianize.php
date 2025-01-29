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
 * Version:           0.1.1
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

if ( ! defined( 'CANADIANIZE_VERSION' ) ) {
    define( 'CANADIANIZE_VERSION', '0.1.0' );
}

if ( ! defined( 'CANADIANIZE_PATH' ) ) {
    define( 'CANADIANIZE_PATH', plugin_dir_path( __FILE__ ) );
}

use Canadianize\Make_Content;
use Canadianize\Create_Posts;

require __DIR__ . '/src/class-make-content.php';
require __DIR__ . '/src/class-create-posts.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	include_once __DIR__ . '/src/class-canadianize-cli.php';
}

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function canadianize_check_php_version(): bool {
    if ( version_compare( PHP_VERSION, '7.4', '<' ) ) {
        add_action( 'plugins_loaded', 'Canadianize\\canadianize_init_deactivation' );
        return false;
    }
    return true;
}

if ( ! canadianize_check_php_version() ) {
    return false;
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\\canadianize_initialize_plugin' );

// Initialize the plugin.
function canadianize_initialize_plugin(): void {
	$GLOBALS['canadianize'] = new Canadianize();
	$GLOBALS['canadianize']->run();
}

register_activation_hook( __FILE__, __NAMESPACE__ . '\\canadianize_activate' );

function canadianize_activate(): void {
    // Activation logic here
    if ( ! get_option( 'canadianize_version' ) ) {
        add_option( 'canadianize_version', CANADIANIZE_VERSION );
    }
}

function canadianize_init_deactivation(): void {
    deactivate_plugins( plugin_basename( __FILE__ ) );
    wp_die(
        esc_html__( 'Canadianize requires PHP 7.4 or higher.', 'canadianize' ),
        'Plugin Activation Error',
        array(
            'back_link' => true,
        )
    );
}
