<?php

/*
Plugin Name: Gandhipeace Donation
Plugin URI: http://anukuls.sgedu.site/plugin
Description: Gandhipeace Donation is the donation plugin that gives user everything that need to start accepting donations today. Designed to integrate seamlessly with WordPress, Gandhipeacedonation allows the organization to create powerful fundraising platforms on their own website.Easy and simple setup and insertion of PayPal donate buttons with a shortcode or through a sidebar Widget. Donation purpose can be set for each button. A few other customization options are available as well.
Author: Anukul Sharma
Author URI: http://anukuls.sgedu.site/
Version: 1.0.0
License: GPLv2 or later
Text Domain: gandhipeace-donations
*/

/*  Copyright 2019 Anukul Sharma

*/

//// variables
// plugin function 	  = wpedon
// shortcode 		  = wpedon
$plugin_basename = plugin_basename(__FILE__);


//// plugin functions
wpedon_gandhipeacedonation::init_wpedongandhipeacedonation();

class wpedon_gandhipeacedonation {
	public static function init_wpedongandhipeacedonation() {
	register_deactivation_hook( __FILE__, array( __CLASS__, "wpedon_deactivate" ));
	register_uninstall_hook( __FILE__, array( __CLASS__, "wpedon_uninstall" ));

	$wpedon_settingsoptions = array(
		'currency'    		=> '25',
		'language'    		=> '3',
		'liveaccount'    	=> '',
		'sandboxaccount'    => '',
		'mode'    			=> '2',
		'size'    			=> '2',
		'opens'   			=> '2',
		'no_note'    		=> '1',
		'no_shipping'    	=> '1',
		'cancel'    		=> '',
		'return'    		=> '',
		'note'    			=> '1',
		'upload_image'    	=> '',
	);

	add_option("wpedon_settingsoptions", $wpedon_settingsoptions);
	}
	
	function wpedon_deactivate() {
		delete_option("wpedon_notice_shown");
	}

	function wpedon_uninstall() {
	}
}

//// plugin includes

// private settings page
include_once ('includes/private_functions.php');

// private button inserter
include_once ('includes/private_button_inserter.php');

// private orders page
include_once ('includes/private_orders.php');

// private buttons page
include_once ('includes/private_buttons.php');

// private settings page
include_once ('includes/private_settings.php');

// public shortcode
include_once ('includes/public_shortcode.php');

// private filters
include_once ('includes/private_filters.php');

// private widget
include_once ('includes/private_widget.php');

// public ipn
include_once ('includes/public_ipn.php');

?>