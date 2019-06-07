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

function gsml_plugin_options() {
	if ( !current_user_can( "manage_options" ) )  {
		wp_die( __( "You do not have sufficient permissions to access this page." ) );
	}




// We can upload media r
function load_admin_things() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}
load_admin_things();

?>

<script>
jQuery(document).ready(function() {
	var formfield;
	jQuery('.upload_image_button').click(function() {
		jQuery('html').addClass('Image');
		formfield = jQuery(this).prev().attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
		return false;
	});
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
	if (formfield) {
		fileurl = jQuery('img',html).attr('src');
		jQuery('#'+formfield).val(fileurl);
		tb_remove();
		jQuery('html').removeClass('Image');
	} else {
		window.original_send_to_editor(html);
	}
	};
});
</script>

<?php


//This is the settings page

	echo "<table width='100%'><tr><td width='70%'><br />";
	echo "<label style='color: #333333;font-size:18pt;padding:8px;color:#FFA500;font-weight:bold;'><center>Gandhipeace PayPal Donation Settings</center></label>";
	echo "<form method='post' action='".$_SERVER["REQUEST_URI"]."'>";


// This is the save and update option
if (isset($_POST['update'])) {

	if (!isset($_POST['action_save']) || ! wp_verify_nonce($_POST['action_save'],'nonce_save') ) {
	   print 'Sorry, your nonce did not verify.';
	   exit;
	}
	
	$options['mode'] = 				intval($_POST['mode']);
	if (!$options['mode']) { 		$options['mode'] = "1";	}
		
	$options['size'] = 				intval($_POST['size']);
	if (!$options['size']) { 		$options['size'] = "1";	}
		
	$options['opens'] = 			intval($_POST['opens']);
	if (!$options['opens']) { 		$options['opens'] = "1"; }
		
	$options['no_note'] = 			intval($_POST['no_note']);
	if (!$options['no_note']) { 	$options['no_note'] = "0"; }
		
	$options['liveaccount'] = 		sanitize_text_field($_POST['liveaccount']);
	//$options['sandboxaccount'] = 	sanitize_text_field($_POST['sandboxaccount']);
	$options['image_1'] = 			sanitize_text_field($_POST['image_1']);
	//$options['cancel'] = 			sanitize_text_field($_POST['cancel']);
	$options['return'] = 			sanitize_text_field($_POST['return']);
	
	
	update_option("gsml_settingsoptions", $options);
	
	echo "<br /><div class='updated'><p><strong>"; _e("Settings Updated."); echo "</strong></p></div>";
}


// this is to get options
$options = get_option('gsml_settingsoptions');
foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }

echo "</td><td></td></tr><tr><td>";

// Settings options started
echo "<br />";
?>

<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
&nbsp; Usage - How to use this plugin
</div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />

<b>1. Enter PayPal Email</b><br />
Enter your PayPal email on this page in the field titled "Live Account". <br /><br />

<b>2. Then make a button</b><br />
On the <a href='admin.php?page=gsml_buttons' target='_blank'>buttons page</a>, make a new button. <br /><br />

<b>3. Place button on page</b><br />
You can place the button on your site in 3 ways. In you Page / Post editor you can use the button titled "Gandhipeace PayPal Donation Button". You can use the " Gandhipeace PayPal Donation Button" Widget. Or you can manually place the shortcode on a Page / Post.<br /><br />

<b>4. View donations</b><br />
On the <a href='admin.php?page=gsml_menu' target='_blank'>donations page</a> you can view the donations that have been made on your site.<br /><br />

</div><br /><br />

<?php

//This is the settings options for providing Paypal Email or Merchant account 
?>
<br /><br /><div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
&nbsp; PayPal Email Address or Merchant ID needed </div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />

<?php

echo "<b>Live Account: </b><input type='text' name='liveaccount' value='".$value['liveaccount']."'> Required";
echo "<br />Please!!! Enter a valid Merchant account ID (strongly recommend) or PayPal account email address. All payments will go to this account.";
echo "<br /><br />We can sign up for PayPal account for free at <a target='_blank' href='https://paypal.com'>PayPal</a>. <br /><br />";

echo "<b>Live Mode:</b>";
echo "&nbsp; &nbsp; <input "; if ($value['mode'] == "1") { echo "checked='checked'"; } echo " type='radio' name='mode' value='1'>On (Live mode)";

echo "<br /><br /></div>";



?>

<br /><br />
<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
&nbsp; Other Settings
</div><div style="background-color:#fff;border: 1px solid #E5E5E5;padding:5px;"><br />

<?php
echo "<table><tr><td valign='top'>";

echo "<b>Default&nbsp;Button&nbsp;Style:</b></td><td valign='top' style='text-align: left;'>";

echo "<input "; if ($value['size'] == "1") { echo "checked='checked'"; } echo " type='radio' name='size' value='1'>Gandhipeace Button <br /><img src='https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif'></td><td valign='top' style='text-align: left;'>";
echo "</td></tr><tr><td></td><td valign='top' colspan='3'>";

echo "<input "; if ($value['size'] == "2") { echo "checked='checked'"; } echo " type='radio' name='size' value='2'>Custom <br /> Use your own image <br />
<input type='text' id='image_1' name='image_1' size='15' value='"; echo $value["image_1"]; echo"'><input id='_btn' class='upload_image_button' type='button' value='Select Image'>";

echo "</td></tr><tr><td><b><br />Buttons open PayPal in:</b></td>";
echo "<td><input "; if ($value['opens'] == "1") { echo "checked='checked'"; } echo " type='radio' name='opens' value='1'>Same page</td>";
echo "<td><input "; if ($value['opens'] == "2") { echo "checked='checked'"; } echo " type='radio' name='opens' value='2'>New page</td></tr>";

echo "</table><br /><br />";



$siteurl = get_site_url();

echo "<b>Return URL: </b>";
echo "<input type='text' name='return' value='".$value['return']."'> Optional <br />";
echo "If the customer goes to PayPal and successfully pays, then they are redirected to a Page. For Instance: $siteurl/thank-you.<br /><br />";


?>
<br /><br /></div>

<input type='hidden' name='update'><br />
<?php echo wp_nonce_field('nonce_save','action_save'); ?>
<input type='submit' name='btn2' class='button-primary' style='font-size: 17px;line-height: 28px;height: 32px;background-color:orange' value='Save Settings'>





<br /><br /><br />


</form>




</td><td width='5%'>
</td><td width='24%' valign='top'>

<br />

<br /><br />

<div style="background-color:#333333;padding:8px;color:#eee;font-size:12pt;font-weight:bold;">
&nbsp; Important Links
</div>

<div style="background-color:#fff;border: 1px solid #E5E5E5;padding:8px;"><br />

<div class="dashicons dashicons-arrow-right" style="margin-bottom: 6px;"></div> <a target="_blank" href="http://anukuls.sgedu.site">GSML Page</a> <br />

<div class="dashicons dashicons-arrow-right" style="margin-bottom: 6px;"></div> <a target="_blank" href="http://anukuls.sgedu.site/contact">Contact</a> <br />

</div>



</td><td width='1%'>

</td></tr></table>


<?php
// end settings page and required permissions
}
