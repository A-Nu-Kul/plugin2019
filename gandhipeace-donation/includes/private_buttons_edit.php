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
		if (isset($_POST['update'])) {
			
			$post_id = intval($_GET['product']);
			
			if (!$post_id) {
				echo'<script>window.location="admin.php?page=gsml_buttons"; </script>';
				exit;
			}
			
			// Update data
			
			if (!isset($error)) {
			
				$my_post = array(
				'ID'           => $post_id,
				'post_title'   => sanitize_text_field($_POST['gsml_button_name'])
				);
				wp_update_post($my_post);
				
				
				$gsml_button_price = sanitize_meta( 'currency_gsml', $_POST['gsml_button_price'], 'post' );
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
				update_post_meta($post_id, 'gsml_button_scpricedname', sanitize_text_field($_POST['gsml_button_scpriceename']));
				
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
			
				
				$message = "Saved";
				
			}
		}
		
		?>
		
		<div style="width:98%;">
		
			<form method='post' action='<?php $_SERVER["REQUEST_URI"]; ?>'>
			
				<?php
				$post_id = sanitize_text_field($_GET['product']);
				
				$post_data = get_post($post_id);
				$title = $post_data->post_title;
				
				$siteurl = get_site_url();
				?>

				<table width="100%"><tr><td valign="bottom" width="85%">
					<br />
					<span style="font-size:20pt; color:orange;">Edit Button</span>
					</td><td valign="bottom">
					<input type="submit" class="button-primary" style="font-size: 14px;height: 30px;float: right;background-color: orange;" value="Save Button">
					</td><td valign="bottom">
					<a href="admin.php?page=gsml_buttons" class="button-secondary" style="font-size: 14px;height: 30px;float: right;background-color: orange;">View All Buttons</a>
				</td></tr></table>

				<?php
				// error
				if (isset($error) && isset($error) && isset($message)) {
					echo "<div class='error'><p>"; echo $message; echo"</p></div>";
				}
				// saved
				if (!isset($error)&& !isset($error) && isset($message)) {
					echo "<div class='updated'><p>"; echo $message; echo"</p></div>";
				}
				?>
				
				<br />
				
				<div style="background-color:#fff;padding:8px;border: 1px solid #CCCCCC;"><br />
				
					<table><tr><td>
					
						<b>Shortcode</b> </td><td></td></td></td></tr><tr><td>
						Shortcode: </td><td><input type="text" readonly="true" value="<?php echo "[gsml id=$post_id]"; ?>"></td><td> We put this code in a page or post or <a target="_blank" href="#">in the theme</a>, to show the button on our site. <br />We can also use the button inserter found above the page or post editor.</td></tr><tr><td>
						</td><td><br /></td></td></td></tr><tr><td>
						
						<b>Main</b> </td><td></td></td></td></tr><tr><td>
						Purpose/Name: </td><td><input type="text" name="gsml_button_name" value="<?php echo esc_attr($title); ?>"></td><td> Optional - The purpose of the donation. If blank, customer enters purpose.</td></tr><tr><td>
						Donation Amount(in AUD): </td><td><input type="text" name="gsml_button_price" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_price',true)); ?>"></td><td> If using dropdown prices, leave blank.</td></tr><tr><td>
						
						</td><td><br /></td></td></td></tr><tr><td>
						
						</td><td><br /></td></td></td></tr><tr><td>
						<b>Other</b> </td><td></td></td></td></tr><tr><td>
						Return URL: </td><td><input type="text" name="gsml_button_return" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_return',true)); ?>"></td><td> Optional - Will override setttings page value. <br />Example: <?php echo $siteurl; ?>/thank-you</td></tr><tr><td>
						
						Button Size: </td><td>
						<select name="gsml_button_buttonsize" style="width:190px;">
							<option value="1" <?php if(esc_attr(get_post_meta($post_id,'gsml_button_buttonsize',true)) == "1") { echo "SELECTED"; } ?>>Gandhipeace Button</option>
							<option value="2" <?php if(esc_attr(get_post_meta($post_id,'gsml_button_buttonsize',true)) == "2") { echo "SELECTED"; } ?>>Custom</option>
						</select></td><td> Override the setttings page value.</td></tr><tr><td>
						
						Show Purpose / Name: </td><td><input type="checkbox" name="gsml_button_enable_name" value="1" <?php if (esc_attr(get_post_meta($post_id,'gsml_button_enable_name',true)) == "1") { echo "CHECKED"; } ?>></td><td>Show the name.</td></tr><tr><td>
						Show Donation Amount: </td><td><input type="checkbox" name="gsml_button_enable_price" value="1" <?php if (esc_attr(get_post_meta($post_id,'gsml_button_enable_price',true)) == "1") { echo "CHECKED"; } ?>></td><td> Show the donation amount.</td></tr><tr><td>
						
						</td><td><br /></td></td></td></tr><tr><td>
						<b>Dropdown Menu</b> <br /><br /></td><td></td></td></td></tr><tr><td>						
						
						Amount Dropdown Menu: </td><td></td></td></td></tr><tr><td colspan="3">
							<table><tr><td>
								Amount Menu Name: &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp;</td><td><input type="text" name="gsml_button_scpriceprice" id="gsml_button_scpriceprice" value="<?php echo get_post_meta($post_id,'gsml_button_scpriceprice',true); ?>"></td><td> Optional, but required to show menu - show an amount dropdown menu. </td></tr><tr><td>
								Option / Amount 1: </td><td><input type="text" name="gsml_button_scpriceaname" id="gsml_button_scpriceaname" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpriceaname',true)); ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpricea" id="gsml_button_scpricea" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpricea',true)); ?>"></td><td> Optional for eg. Amount: 5.00 </td></tr><tr><td>
								Option / Amount 2: </td><td><input type="text" name="gsml_button_scpricebname" id="gsml_button_scpricebname" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpricebname',true)); ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpriceb" id="gsml_button_scpriceb" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpriceb',true)); ?>"></td><td> Optional </td></tr><tr><td>
								Option / Amount 3: </td><td><input type="text" name="gsml_button_scpricecname" id="gsml_button_scpricecname" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpricecname',true)); ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpricec" id="gsml_button_scpricec" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpricec',true)); ?>"></td><td> Optional </td></tr><tr><td>
								Option / Amount 4: </td><td><input type="text" name="gsml_button_scpricedname" id="gsml_button_scpricedname" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpricedname',true)); ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpriced" id="gsml_button_scpriced" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpriced',true)); ?>"></td><td> Optional </td></tr><tr><td>
								Option / Amount 5: </td><td><input type="text" name="gsml_button_scpriceename" id="gsml_button_scpriceename" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpriceename',true)); ?>" style="width:94px;"><input style="width:93px;" type="text" name="gsml_button_scpricee" id="gsml_button_scpricee" value="<?php echo esc_attr(get_post_meta($post_id,'gsml_button_scpricee',true)); ?>"></td><td> Optional </td></tr><tr><td>
						<input type="hidden" name="update">
							
						</td></tr></table>						
				</div>
				
			</form>
