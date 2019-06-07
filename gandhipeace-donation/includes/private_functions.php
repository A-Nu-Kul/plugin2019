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
// display activation notice
add_action('admin_notices', 'gsml_admin_notices');
function gsml_admin_notices() {
	if (!get_option('gsml_notice_shown')) {
		echo "<div class='updated'><p><a href='admin.php?page=gsml_settings'>Please click here to view the plugin settings</a>.</p></div>";
		update_option("gsml_notice_shown", "true");
	}
}



// Adding paypal menu for GSML
add_action("admin_menu", "gsml_plugin_menu");
function gsml_plugin_menu() {
	global $plugin_dir_url;
	
	add_menu_page("Gandhipeace PayPal Donations", "Gandhipeace PayPal Donations", "manage_options", "gsml_menu", "gsml_plugin_orders",'dashicons-cart','28.5');
	
	add_submenu_page("gsml_menu", "Donations", "Donations", "manage_options", "gsml_menu", "gsml_plugin_orders");
	
	add_submenu_page("gsml_menu", "Buttons", "Buttons", "manage_options", "gsml_buttons", "gsml_plugin_buttons");
	
	add_submenu_page("gsml_menu", "Settings", "Settings", "manage_options", "gsml_settings", "gsml_plugin_options");
}

//To open PayPal in new or the same link

function gsml_action_links($links) {

global $support_link, $edit_link, $settings_link;
   $links[] = '<a href="#" target="_blank">Support</a>';
   $links[] = '<a href="admin.php?page=gsml_settings">Settings</a>';
   return $links;
}

add_filter( 'plugin_action_links_' . $plugin_basename, 'gsml_action_links' );

