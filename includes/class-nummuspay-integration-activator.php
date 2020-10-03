<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.facebook.com/sahilgulati007
 * @since      1.0.0
 *
 * @package    Nummuspay_Integration
 * @subpackage Nummuspay_Integration/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Nummuspay_Integration
 * @subpackage Nummuspay_Integration/includes
 * @author     Sahil Gulati <sgwebsol@gmail.com>
 */
class Nummuspay_Integration_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		add_option('_CHECKOUT_PAGE_ID_FROM_NUMMUSPAY', '');
	}

}
