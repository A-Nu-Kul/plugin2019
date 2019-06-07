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

// shortcode
add_shortcode('gsml', 'gsml_options');

function gsml_options($atts) {

	// To get a shortcode id
		$atts = shortcode_atts(array(
			'id'		=> '',
			'align' 	=> '',
			'widget' 	=> '',
			'name' 		=> ''
		), $atts);
			
		$post_id = $atts['id'];

	// To get settings page values
	$options = get_option('gsml_settingsoptions');
	foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }
	
	
	// To get values for button
	$amount = 	esc_attr(get_post_meta($post_id,'gsml_button_price',true));
	$sku = 		esc_attr(get_post_meta($post_id,'gsml_button_id',true));
	
	// Here is the price for dropdown menus
	$gsml_button_scpriceprice = esc_attr(get_post_meta($post_id,'gsml_button_scpriceprice',true));
	$gsml_button_scpriceaname = esc_attr(get_post_meta($post_id,'gsml_button_scpriceaname',true));
	$gsml_button_scpricebname = esc_attr(get_post_meta($post_id,'gsml_button_scpricebname',true));
	$gsml_button_scpricecname = esc_attr(get_post_meta($post_id,'gsml_button_scpricecname',true));
	$gsml_button_scpricedname = esc_attr(get_post_meta($post_id,'gsml_button_scpricedname',true));
	$gsml_button_scpriceename = esc_attr(get_post_meta($post_id,'gsml_button_scpriceename',true));
	
	
	$gsml_button_scpricea = esc_attr(get_post_meta($post_id,'gsml_button_scpricea',true));
	$gsml_button_scpriceb = esc_attr(get_post_meta($post_id,'gsml_button_scpriceb',true));
	$gsml_button_scpricec = esc_attr(get_post_meta($post_id,'gsml_button_scpricec',true));
	$gsml_button_scpriced = esc_attr(get_post_meta($post_id,'gsml_button_scpriced',true));
	$gsml_button_scpricee = esc_attr(get_post_meta($post_id,'gsml_button_scpricee',true));
	
	$post_data = 	get_post($post_id);
	$name = 		$post_data->post_title;
	
	$rand_string = md5(uniqid(rand(), true));
	
	// show name
	$gsml_button_enable_name = 		esc_attr(get_post_meta($post_id,'gsml_button_enable_name',true));
	
	// show price
	$gsml_button_enable_price = 		esc_attr(get_post_meta($post_id,'gsml_button_enable_price',true));
	
	// show currency
	$gsml_button_enable_currency = 	esc_attr(get_post_meta($post_id,'gsml_button_enable_currency',true));


	// live of test mode
	
	if ($value['mode'] == "1")  {
		$account = $value['liveaccount'];
		$path = "paypal";
	}
	
	$account_a = esc_attr(get_post_meta($post_id,'gsml_button_account',true));
	if (!empty($account_a)) { $account = $account_a; }

		$imagea = "https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif";

	// custom button size
	$gsml_button_buttonsize = esc_attr(get_post_meta($post_id,'gsml_button_buttonsize',true));
	
	if ($gsml_button_buttonsize != "0") {
		$value['size'] = $gsml_button_buttonsize;
	}

	// button size
	if ($value['size'] == "1") { $img = $imagea; }
	
	if ($value['size'] == "2") { $img = $value['image_1']; }
	
	// widget
	if ($atts['widget'] == "true") {
		$width = "180px";
	} else {
		$width = "220px";
	}
	
	// return url
	$return = "";
	$return = $value['return'];
	$return_a = esc_attr(get_post_meta($post_id,'gsml_button_return',true));
	if (!empty($return_a)) { $return = $return_a; }

	// window action
	if ($value['opens'] == "1") { $target = ""; }
	if ($value['opens'] == "2") { $target = "_blank"; }

	// alignment
	if ($atts['align'] == "left") { $alignment = "style='float: left;'"; }
	if ($atts['align'] == "right") { $alignment = "style='float: right;'"; }
	if ($atts['align'] == "center") { $alignment = "style='margin-left: auto;margin-right: auto;width:$width'"; }
	if (empty($atts['align'])) { $alignment = ""; }
	
	// notify url
	$notify_url = get_admin_url() . "admin-post.php?action=add_gsml_button_ipn";

	$output = "";
	$output .= "<div $alignment>";
	
	// text description title
	if ($gsml_button_enable_name == "1" || $gsml_button_enable_price == "1") {
		$output .= "<label>";
	}
	
	if ($gsml_button_enable_name == "1") {
		$output .= $name;
	}
	
	if ($gsml_button_enable_name == "1" && $gsml_button_enable_price == "1") {
		$output .= "<br /><span class='price'>";
	}
	
	if ($gsml_button_enable_price == "1") {
		$output .= $amount ."</span>";
	}
	
	if ($gsml_button_enable_price == "1") {
		if ($gsml_button_enable_currency == "1") {
			$output .= $currency;
		}
	}
	
	if ($gsml_button_enable_name == "1" || $gsml_button_enable_price == "1") {
		$output .= "</label><br />";
	}
	
	// price dropdown menu
	if (!empty($gsml_button_scpriceprice)) {
	
		// dd is active so set first value just in case no option is selected by user
		$amount =$gsml_button_scpricea;
		
		$output .= "
		<script>
		jQuery(document).ready(function(){
			jQuery('#dd_$rand_string').on('change', function() {
			  jQuery('#amount_$rand_string').val(this.value);
			});
		});
		</script>
		";
		
		
		if (!empty($gsml_button_scpriceprice)) { $output .= "<label style='font-size:11pt !important;'>$gsml_button_scpriceprice</label><br /><select name='dd_$rand_string' id='dd_$rand_string' style='width:100% !important;min-width:$width !important;max-width:$width !important;border: 1px solid #ddd !important;'>"; }
		if (!empty($gsml_button_scpriceaname)) { $output .= "<option value='$gsml_button_scpricea'>". $gsml_button_scpriceaname ."</option>"; }
		if (!empty($gsml_button_scpricebname)) { $output .= "<option value='$gsml_button_scpriceb'>". $gsml_button_scpricebname ."</option>"; }
		if (!empty($gsml_button_scpricecname)) { $output .= "<option value='$gsml_button_scpricec'>". $gsml_button_scpricecname ."</option>"; }
		if (!empty($gsml_button_scpricedname)) { $output .= "<option value='$gsml_button_scpriced'>". $gsml_button_scpricedname ."</option>"; }
		if (!empty($gsml_button_scpriceename)) { $output .= "<option value='$gsml_button_scpricee'>". $gsml_button_scpriceename ."</option>"; }
		if (!empty($gsml_button_scpriceprice)) { $output .= "</select><br /><br />"; }
	}
	
	
	// override name field if passed as shortcode attribute
	if (!empty($atts['name'])) {
		$name = $atts['name'];
	}

	$output .= "<form target='$target' action='https://www.$path.com/cgi-bin/webscr' method='post'>";
	$output .= "<input type='hidden' name='cmd' value='_donations' />";
	$output .= "<input type='hidden' name='business' value='$account' />";
	$output .= "<input type='hidden' name='item_name' value='$name' />";
	$output .= "<input type='hidden' name='item_number' value='$sku' />";
	$output .= "<input type='hidden' name='currency_code' value='$currency' />";
	// optional - required for fixed amounts
	$output .= "<input type='hidden' name='amount' id='amount_$rand_string' value='$amount' />";
	$output .= "<input type='hidden' name='no_note' value='". $value['no_note'] ."'>";
	$output .= "<input type='hidden' name='no_shipping' value='". $value['no_shipping'] ."'>";
	$output .= "<input type='hidden' name='notify_url' value='$notify_url'>";
	$output .= "<input type='hidden' name='lc' value='$language'>";
	$output .= "<input type='hidden' name='bn' value='WPPlugin_SP'>";
	$output .= "<input type='hidden' name='return' value='$return' />";
	$output .= "<input type='hidden' name='cancel_return' value='". $value['cancel'] ."' />";
	$output .= "<input class='gsml_paypalbuttonimage' type='image' src='$img' border='0' name='submit' alt='Gandhipeacedonation Button' style='border: none;'>";
	$output .= "<img alt='' border='0' style='border:none;display:none;' src='https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif' width='1' height='1'>";
	$output .= "</form></div>";
	return $output;
}
