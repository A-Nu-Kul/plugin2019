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
global $current_user;

	if (isset($_POST['update'])) {
		$my_post = array(
		  'post_title'    => sanitize_text_field($_POST['gsml_button_name']),
		  'post_status'   => 'publish',
		  'post_author'   => $current_user->ID,
		  'post_type'     => 'wpplugin_don_button'
		);
		
		if (!isset($error)) {
			
			// Insert the post and meta data into the database
			$post_id = wp_insert_post( $my_post );
			
			$gsml_button_price = sanitize_meta( 'currency', $_POST['gsml_button_price'], 'post' );
			update_post_meta($post_id, 'gsml_button_price', $gsml_button_price);
			
			update_post_meta($post_id, 'gsml_button_id', sanitize_text_field($_POST['gsml_button_id']));
			
			if (!empty($_POST['gsml_button_enable_name'])) {
				$gsml_button_enable_name =			intval($_POST['gsml_button_enable_name']);
				if (!$gsml_button_enable_name) { 		$gsml_button_enable_name = ""; }
				update_post_meta($post_id, 'gsml_button_enable_name', sanitize_text_field($_POST['gsml_button_enable_name']));
			} else {
				update_post_meta($post_id, 'gsml_button_enable_name', 0);
			}
			
			if (!empty($_POST['gsml_button_enable_price'])) {
				$gsml_button_enable_price =				intval($_POST['gsml_button_enable_price']);
				if (!$gsml_button_enable_price) { 		$gsml_button_enable_price = ""; }
				update_post_meta($post_id, 'gsml_button_enable_price', sanitize_text_field($_POST['gsml_button_enable_price']));
			} else {
				update_post_meta($post_id, 'gsml_button_enable_price', 0);
			}
			
			
			
			$gsml_button_buttonsize =			intval($_POST['gsml_button_buttonsize']);
			if (!$gsml_button_buttonsize && $gsml_button_buttonsize != "0") { 	$gsml_button_buttonsize = ""; }
			update_post_meta($post_id, 'gsml_button_buttonsize', $gsml_button_buttonsize);
			
			update_post_meta($post_id, 'gsml_button_account', sanitize_text_field($_POST['gsml_button_account']));
			update_post_meta($post_id, 'gsml_button_return', sanitize_text_field($_POST['gsml_button_return']));
			
			update_post_meta($post_id, 'gsml_button_scpriceprice', sanitize_text_field($_POST['gsml_button_scpriceprice']));
			update_post_meta($post_id, 'gsml_button_scpriceaname', sanitize_text_field($_POST['gsml_button_scpriceaname']));
			update_post_meta($post_id, 'gsml_button_scpricebname', sanitize_text_field($_POST['gsml_button_scpricebname']));
			update_post_meta($post_id, 'gsml_button_scpricecname', sanitize_text_field($_POST['gsml_button_scpricecname']));
			update_post_meta($post_id, 'gsml_button_scpricedname', sanitize_text_field($_POST['gsml_button_scpricedname']));
			update_post_meta($post_id, 'gsml_button_scpriceename', sanitize_text_field($_POST['gsml_button_scpriceename']));
			
			
			$gsml_button_scpricea = sanitize_meta( 'currency_gsml', $_POST['gsml_button_scpricea'], 'post' );
			update_post_meta($post_id, 'gsml_button_scpricea', $gsml_button_scpricea);
			$gsml_button_scpriceb = sanitize_meta( 'currency_gsml', $_POST['gsml_button_scpriceb'], 'post' );
			update_post_meta($post_id, 'gsml_button_scpriceb', $gsml_button_scpriceb);
			$gsml_button_scpricec = sanitize_meta( 'currency_gsml', $_POST['gsml_button_scpricec'], 'post' );
			update_post_meta($post_id, 'gsml_button_scpricec', $gsml_button_scpricec);
			$gsml_button_scpriced = sanitize_meta( 'currency_gsml', $_POST['gsml_button_scpriced'], 'post' );
			update_post_meta($post_id, 'gsml_button_scpriced', $gsml_button_scpriced);
			$gsml_button_scpricee = sanitize_meta( 'currency_gsml', $_POST['gsml_button_scpricee'], 'post' );
			update_post_meta($post_id, 'gsml_button_scpricee', $gsml_button_scpricee);
			
			echo'<script>window.location="?page=gsml_buttons&message=created";</script>';
			exit;
		
		}
	}
	
	?>
	<label style='color: #333333;font-size:12pt;padding:8px;'>
	<div style="width:98%;">
	
		<form method='post' action='<?php $_SERVER["REQUEST_URI"]; ?>'>
			
				<table width="100%"><tr><td valign="bottom" width="85%">
				<br />
				<span style="font-size:20pt;color:orange";>New Gandhipeace PayPal Donation Button</span>
				</td><td valign="bottom">
				<input type="submit" class="button-primary" style="font-size: 14px;height: 30px;float: right;background-color: orange;" value="Save Gandhipeace PayPal Donation Button">
				</td><td valign="bottom">
				<a href="admin.php?page=gsml_buttons" class="button-secondary" style="font-size: 14px;height: 30px;float: right;background-color:orange; color: white;">Cancel</a>
				</td></tr></table>
			
			
			<?php
			// error
			if (isset($error) && isset($error) && isset($message)) {
					echo "<div class='error'><p>"; echo $message; echo"</p></div>";
			}
			?>
			
				
			<br />

			<div style="background-color:#fff;padding:8px;border: 1px solid #CCCCCC;"><br />
				
					<table><tr><td>
					
						<b>Main</b> </td><td></td></td></td></tr><tr><td>
						Purpose / Name: </td><td><input type="text" name="gsml_button_name" value="<?php if(isset($_POST['gsml_button_name'])) { echo esc_attr($_POST['gsml_button_name']); } ?>"></td><td> Purpose of the fundraising campaign or event.</td></tr><tr><td>
						Donation Amount:(in AUD) </td><td><input type="text" name="gsml_button_price" value="<?php if(isset($_POST['gsml_button_price'])) { echo esc_attr($_POST['gsml_button_created']); } ?>"></td><td> If using dropdown prices, leave blank.</td></tr><tr><td>
					
						</td><td><br /></td></td></td></tr><tr><td>
						</td><td><br /></td></td></td></tr><tr><td>
						<b>Other</b> </td><td></td></td></td></tr><tr><td>
						PayPal Email: </td><td><input type="text" name="gsml_button_account" value="<?php if(isset($_POST['gsml_button_account'])) { echo esc_attr($_POST['gsml_button_account']); } ?>"></td><td> </td></tr><tr><td>
						Return URL: </td><td><input type="text" name="gsml_button_return" value="<?php if(isset($_POST['gsml_button_return'])) { echo esc_attr($_POST['gsml_button_return']); } ?>"></td><td> Thank you page URL.</td></tr><tr><td>
						
						Button Size: </td><td>
						<select name="gsml_button_buttonsize" style="width:190px;">
							<option value="1" <?php if(esc_attr(get_post_meta($post_id,'gsml_button_buttonsize',true)) == "1") { echo "SELECTED"; } ?>>Gandhipeace Button</option>
							<option value="2" <?php if(esc_attr(get_post_meta($post_id,'gsml_button_buttonsize',true)) == "2") { echo "SELECTED"; } ?>>Custom</option>
						</select></td><td> Select the button.</td></tr><tr><td>
						
						Show Purpose / Name: </td><td><input type="checkbox" name="gsml_button_enable_name" value="1" <?php if (isset($_POST['gsml_button_enable_name'])) { echo "CHECKED"; } ?>></td><td>Check it for displaying Purpose or Name.</td></tr><tr><td>
						Show Donation Amount: : </td><td><input type="checkbox" name="gsml_button_enable_price" value="1" <?php if (isset($_POST['gsml_button_enable_price'])) { echo "CHECKED"; } ?>></td><td>Check it for displaying donation amount .</td></tr><tr><td>
						
						</td><td><br /></td></td></td></tr><tr><td>
						<b>Dropdown Menus</b> <br /><br /></td><td></td></td></td></tr><tr><td>
						
						Enter upto 5 Amounts for Dropdown Menu: </td><td></td></td></td></tr><tr><td colspan="3">
							<table><tr><td>
								Enter the Amount Menu Name: &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp;</td><td><input type="text" name="gsml_button_scpriceprice" id="gsml_button_scpriceprice" value="<?php if(isset($_POST['gsml_button_scpriceprice'])) { echo esc_attr($_POST['gsml_button_scpriceprice']); } ?>"></td><td> For what campaign or event it is used for. </td></tr><tr><td>
								Option / Amount 1: </td><td><input type="text" name="gsml_button_scpriceaname" id="gsml_button_scpriceaname" value="<?php if(isset($_POST['gsml_button_scpriceaname'])) { echo esc_attr($_POST['gsml_button_scpriceaname']); } ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpricea" id="gsml_button_scpricea" value="<?php if(isset($_POST['gsml_button_scpricea'])) { echo esc_attr($_POST['gsml_button_scpricea']); } ?>"></td><td> Optional </td></tr><tr><td>
								Option / Amount 2: </td><td><input type="text" name="gsml_button_scpricebname" id="gsml_button_scpricebname" value="<?php if(isset($_POST['gsml_button_scpricebname'])) { echo esc_attr($_POST['gsml_button_scpricebname']); } ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpriceb" id="gsml_button_scpriceb" value="<?php if(isset($_POST['gsml_button_scpriceb'])) { echo esc_attr($_POST['gsml_button_scpriceb']); } ?>"></td><td> Optional </td></tr><tr><td>
								Option / Amount 3: </td><td><input type="text" name="gsml_button_scpricecname" id="gsml_button_scpricecname" value="<?php if(isset($_POST['gsml_button_scpricecname'])) { echo esc_attr($_POST['gsml_button_scpricecname']); } ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpricec" id="gsml_button_scpricec" value="<?php if(isset($_POST['gsml_button_scpricec'])) { echo esc_attr($_POST['gsml_button_scpricec']); } ?>"></td><td> Optional </td></tr><tr><td>
								Option / Amount 4: </td><td><input type="text" name="gsml_button_scpricedname" id="gsml_button_scpricedname" value="<?php if(isset($_POST['gsml_button_scpricedname'])) { echo esc_attr($_POST['gsml_button_scpricedname']); } ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpriced" id="gsml_button_scpriced" value="<?php if(isset($_POST['gsml_button_scpriced'])) { echo esc_attr($_POST['gsml_button_scpriced']); } ?>"></td><td> Optional </td></tr><tr><td>
								Option / Amount 5: </td><td><input type="text" name="gsml_button_scpriceename" id="gsml_button_scpriceename" value="<?php if(isset($_POST['gsml_button_scpriceename'])) { echo esc_attr($_POST['gsml_button_scpriceename']); } ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpricee" id="gsml_button_scpricee" value="<?php if(isset($_POST['gsml_button_scpricee'])) { echo esc_attr($_POST['gsml_button_scpricee']); } ?>"></td><td> Optional </td></tr><tr><td>
							</td></tr></table>
							
						<input type="hidden" name="update">
							
						</td></tr></table>
				</div>
			
		</form>
