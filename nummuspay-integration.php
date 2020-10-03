<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.facebook.com/sahilgulati007
 * @since             1.0.0
 * @package           Nummuspay_Integration
 *
 * @wordpress-plugin
 * Plugin Name:       Nummuspay Integration
 * Plugin URI:        https://www.facebook.com/sgsoftwaresolutions.in
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Sahil Gulati
 * Author URI:        https://www.facebook.com/sahilgulati007
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       nummuspay-integration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'NUMMUSPAY_INTEGRATION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-nummuspay-integration-activator.php
 */
function activate_nummuspay_integration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nummuspay-integration-activator.php';
	Nummuspay_Integration_Activator::activate();
	
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-nummuspay-integration-deactivator.php
 */
function deactivate_nummuspay_integration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-nummuspay-integration-deactivator.php';
	Nummuspay_Integration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_nummuspay_integration' );
register_deactivation_hook( __FILE__, 'deactivate_nummuspay_integration' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-nummuspay-integration.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_nummuspay_integration() {

	$plugin = new Nummuspay_Integration();
	$plugin->run();

}

run_nummuspay_integration();
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    //plugin is activated
} else {
	add_action( 'admin_notices', 'my_woo_notice' );
}

function my_woo_notice() {
  ?>
  <div class="update-nag notice">
      <p><?php _e( 'Please install WooCommerce, it is required for this plugin to work properly! Nummuspay Integration', 'nummuspay-integration' ); ?></p>
  </div>
  <?php
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'salcode_add_plugin_page_settings_link');
function salcode_add_plugin_page_settings_link( $links ) {
	$links[] = '<a href="' .
		admin_url( 'options-general.php?page=nummuspay-integration' ) .
		'">' . __('Settings') . '</a>';
	return $links;
}