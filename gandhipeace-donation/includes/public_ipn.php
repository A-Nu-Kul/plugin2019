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
// paypal post
// paypal post
add_action('admin_post_add_gsml_button_ipn', 'wpplugin_gsml_button_ipn');
add_action('admin_post_nopriv_add_gsml_button_ipn', 'wpplugin_gsml_button_ipn');

function wpplugin_gsml_button_ipn() {

	$options = get_option('gsml_settingsoptions');
	foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }

		$paypal_url = "https://www.paypal.com/cgi-bin/webscr";

	$ch = curl_init($paypal_url);
	if ($ch == FALSE) {
		return FALSE;
	}

	curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

	if(DEBUG == true) {
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
	}

	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

	$res = curl_exec($ch);
	if (curl_errno($ch) != 0)
		{
		if(DEBUG == true) {	
			error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
		}
		curl_close($ch);
		exit;

	} else {
			if(DEBUG == true) {
				error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
				error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
			}
			curl_close($ch);
	}

	$tokens = 						explode("\r\n\r\n", trim($res));
	$res = 							trim(end($tokens));

	if (strcmp ($res, "VERIFIED") == 0) {

		// assign posted variables to local variables
		$txn_id = 					sanitize_text_field($_POST['txn_id']);
		$custom = 					sanitize_text_field($_POST['custom']);
		
		// lookup post author to save ipn as based on author of button
		$post_id_data = 		get_post($custom); 
		$post_id_author = 		$post_id_data->post_author;
		
		// save responce to db
		
		// make sure txt id isset, if payment is recurring paypal will post successful ipn separately and that should not be logged
		if (!empty($txn_id)) {
			
			// assign posted variables to local variables
			$item_name = 			sanitize_text_field($_POST['item_name']);
			$item_number = 			intval($_POST['item_number']);
				if (!$item_number) { $item_number = "";	}
			$payment_status = 		sanitize_text_field($_POST['payment_status']);
			$payment_amount = 		sanitize_text_field($_POST['mc_gross']);
			$payment_currency = 	sanitize_text_field($_POST['mc_currency']);
			$payer_email = 			sanitize_email($_POST['payer_email']);
			$purchased_quantity = 	sanitize_text_field($_POST['quantity']);
			$fee = 					sanitize_text_field($_POST['mc_fee']);
			$payment_cycle = 		sanitize_text_field($_POST['payment_cycle']);
			
			$ipn_post = array(
				'post_title'    => $item_name,
				'post_status'   => 'publish',
				'post_author'   => $post_id_author,
				'post_type'     => 'wpplugin_don_order'
			);
			
			// left here as a debugging tool
			//$payment_cycle = file_get_contents("php://input");
			
			$post_id = wp_insert_post($ipn_post);
			update_post_meta($post_id, 'gsml_button_item_number', $item_number);
			update_post_meta($post_id, 'gsml_button_payment_status', $payment_status);
			update_post_meta($post_id, 'gsml_button_payment_amount', $payment_amount);
			update_post_meta($post_id, 'gsml_button_payment_currency', $payment_currency);
			update_post_meta($post_id, 'gsml_button_txn_id', $txn_id);
			update_post_meta($post_id, 'gsml_button_payer_email', $payer_email);
			update_post_meta($post_id, 'gsml_button_payment_cycle', $payment_cycle);
			
		}
		
		if(DEBUG == true) {
			error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
		}
	} else if (strcmp ($res, "INVALID") == 0) {
		// log for manual investigation
		if(DEBUG == true) {
			error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
		}
		
	}

}
