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
// media button inserter - change button text

function wpedon_change_button_text( $translation, $text, $domain )
{
    if ( 'default' == $domain and 'Insert into Post' == $text )
    {
        remove_filter( 'gettext', 'wpedon_change_button_text' );
        return 'Use this image';
    }
    return $translation;
}
add_filter( 'gettext', 'wpedon_change_button_text', 10, 3 );


// currency validation

function wpedon_sanitize_currency_meta( $value ) {

	if (!empty($value)) {
		$value = (float) preg_replace('/[^0-9.]*/','',$value);
		return number_format((float)$value, 2, '.', '');
	}
}
add_filter( 'sanitize_post_meta_currency_wpedon', 'wpedon_sanitize_currency_meta' );