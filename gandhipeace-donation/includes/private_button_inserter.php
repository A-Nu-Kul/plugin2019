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
add_action('init', 'gsml_button_media_buttons_init');

function gsml_button_media_buttons_init() {
	global $pagenow, $typenow;

	// add media button for editor page
	if ( in_array( $pagenow, array( 'post.php', 'page.php', 'post-new.php', 'post-edit.php' ) ) && $typenow != 'download' ) {
		
		add_action('admin_footer', 'gsml_button_add_inline_popup_content');
		add_action('media_buttons', 'gsml_button_add_my_media_button', 20);
		
		// button
		function gsml_button_add_my_media_button() {
			echo '<a href="#TB_inline?width=600&height=500&inlineId=gsml_popup_container" title="Insert a Gamdhipeace PayPal Donation Button" id="insert-my-media" class="button thickbox">Gandhipeace PayPal Donation Button</a>';
		}
		
		// popup
		function gsml_button_add_inline_popup_content() {
		?>
		
			
		<script type="text/javascript">
			function gsml_button_InsertShortcode() {
			
				var id = document.getElementById("gsml_button_id").value;
				var gsml_alignmentc = document.getElementById("gsml_align");
				var gsml_alignmentb = gsml_alignmentc.options[gsml_alignmentc.selectedIndex].value;
				
				if(id == "No buttons found.") { alert("Error: Please select an existing button from the dropdown or make a new one."); return false; }
				if(id == "") { alert("Error: Please select an existing button from the dropdown or make a new one."); return false; }
				
				if(gsml_alignmentb == "none") { var gsml_alignment = ""; } else { var gsml_alignment = ' align="' + gsml_alignmentb + '"'; };
				
				window.send_to_editor('[gsml id="' + id + '"' + gsml_alignment + ']');
				
				document.getElementById("gsml_button_id").value = "";
				gsml_alignmentc.selectedIndex = null;
			}
		</script>

		
		<div id="gsml_popup_container" style="display:none;">
		
		
			<h2>Insert a PayPal Donation Button</h2>

			<table><tr><td>
			
			Choose an existing button: </td></tr><tr><td>
			<select id="gsml_button_id" name="gsml_button_id">
				<?php
				$args = array('post_type' => 'wpplugin_don_button','posts_per_page' => -1);

				$posts = get_posts($args);

				$count = "0";
				
				if (isset($posts)) {
					
					foreach ($posts as $post) {

						$id = $posts[$count]->ID;
						$post_title = $posts[$count]->post_title;
						$price = get_post_meta($id,'gsml_button_price',true);
						$sku = get_post_meta($id,'gsml_button_id',true);

						echo "<option value='$id'>";
						echo "Name: ";
						echo $post_title;
						echo " - Amount: ";
						echo $price;

						$count++;
					}
				}
				else {
					echo "<option>No buttons found.</option>";
				}
				
				?>
			</select>
			</td></tr><tr><td>
			New button: <a target="_blank" href="admin.php?page=gsml_buttons&action=new">here</a><br />
			Manage existing buttons: <a target="_blank" href="admin.php?page=gsml_buttons">here</a>
			
			</td></tr><tr><td>
			<br />
			</td></tr><tr><td>
			
			Alignment: </td></tr><tr><td>
			<select id="gsml_align" name="gsml_align" style="width:100%;max-width:190px;">
			<option value="none"></option>
			<option value="left">Left</option>
			<option value="center">Center</option>
			<option value="right">Right</option>
			</select> </td></tr><tr><td>Optional
			
			</td></tr><tr><td>
			<br />
			</td></tr><tr><td>
			
			<input type="button" id="gsml-paypal-insert" class="button-primary" onclick="gsml_button_InsertShortcode();" value="Insert Button">		
			
			</td></tr></table>
		</div>
		<?php
		}
	}
}
