<?php
/**
 * Plugin Name: Fc Feedback
 * Plugin URI: #
 * Description: WordPress plugin that allows website visitors to vote on various articles
 * Version: 1.0.0
 * Author: Adnan Hyder Pervez
 * Author URI: 12345adnan@gmail.com
 * Developer: Adnan
 * Developer URI: 12345adnan@gmail.com
 * Text Domain: fc
 * Domain Path: /languages
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 * @package FC-Feedback
 */

use FCFeedback\Core;

defined( 'ABSPATH' ) || exit;



if ( ! defined( 'FC_PLUGIN_FILE' ) ) {
    define( 'FC_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'FC_PLUGIN_VERSION' ) ) {
    define( 'FC_PLUGIN_VERSION', '1.0.0' );
}

if ( ! defined( 'FC_PLUGIN_DIR' ) ) {
    define( 'FC_PLUGIN_DIR', __DIR__ );
}

if ( ! defined( 'FC_INCLUDES_DIR' ) ) {
    define( 'FC_INCLUDES_DIR', FC_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'includes' );
}

if ( ! defined( 'FC_VENDOR_DIR' ) ) {
    define( 'FC_VENDOR_DIR', FC_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'vendor' );
}

if ( ! defined( 'FC_PLUGIN_SRC_URL' ) ) {
    define( 'FC_PLUGIN_SRC_URL', plugin_dir_url( FC_PLUGIN_FILE ) . 'src' );
}

$loader = include_once FC_VENDOR_DIR . DIRECTORY_SEPARATOR . 'autoload.php';

if ( ! $loader ) {
    throw new Exception( 'vendor/autoload.php missing please run `composer install`' );
}

/**
 * Activation and Deactivation hooks for WordPress
 */

if ( ! function_exists( 'fc_extension_activate' ) ) {
    /**
     * Activation Hook for WordPress.
     *
     * @since 1.0.0
     * @return void
     */
    function fc_extension_activate() {
       //Add any Activation tasks here (e.g., Removal of free version, Create Databases).
    }

    register_activation_hook( __FILE__, 'fc_extension_activate' );
}

if ( ! function_exists( 'fc_extension_deactivate' ) ) {
    /**
     * Deactivation hook for WordPress.
     *
     * @since 1.0.0
     * @return void
     */
    function fc_extension_deactivate() {
        // Add any deactivation tasks here (e.g., cleanup, data removal).
        // This code will be executed once when the plugin is deactivated.
    }

    register_deactivation_hook( __FILE__, 'fc_extension_deactivate' );
}

if ( ! function_exists( 'fc_initialize' ) ) {
    /**
     * Initialize the plugin.
     *
     * @since 1.0.0
     * @return Core Instance of the Core class.
     */
    function fc_initialize(): ?Core {

        static $fc;

        if ( ! isset( $fc ) ) {
            $fc = Core::instance();
        }

        $GLOBALS['fc_feedback'] = $fc;

        return $fc;
    }

    add_action( 'plugins_loaded', 'fc_initialize', 10 );
}