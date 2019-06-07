<?php

/*
Plugin Name: Gandhipeace Donation
Plugin URI: http://anukuls.sgedu.site/plugin
Description: Gandhipeace Donation is the donation plugin that gives user everything that need to start accepting donations for GSML.
Author: Anukul Sharma
Author URI: http://anukuls.sgedu.site/
Version: 1.0.0
License: GPLv2 or later
Text Domain: gandhipeace-donations
*/

/*  Copyright 2019 Anukul Sharma

*/

//// variables
// plugin function 	  = gsml
// shortcode 		  = gsml
$plugin_basename = plugin_basename(__FILE__);


//// plugin functions
gsml_gandhipeacedonation::init_gsmlgandhipeacedonation();

class gsml_gandhipeacedonation {
	public static function init_gsmlgandhipeacedonation() {
	register_deactivation_hook( __FILE__, array( __CLASS__, "gsml_deactivate" ));
	register_uninstall_hook( __FILE__, array( __CLASS__, "gsml_uninstall" ));

	$gsml_settingsoptions = array(
		'liveaccount'    	=> '',
		'mode'    			=> '1',
		'size'    			=> '2',
		'opens'   			=> '2',
		'return'    		=> '',
		'note'    			=> '1',
		'upload_image'    	=> '',
	);

	add_option("gsml_settingsoptions", $gsml_settingsoptions);
	}
	
	function gsml_deactivate() {
		delete_option("gsml_notice_shown");
	}

	function gsml_uninstall() {
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

// public ipn
include_once ('includes/public_ipn.php');

?>
