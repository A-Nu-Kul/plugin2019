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
class wpedon_button_widget extends WP_Widget {

// constructor
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'wpedon_widget',
			'description' => 'Gandhipeace PayPal Donation Button',
		);
		parent::__construct( 'wpedon_widget', 'Gandhipeace PayPal Donation Button', $widget_ops );
	}

	// public output
	function widget( $args, $instance ) {
		extract($args);
		
		if (!empty($instance['idvalue'])) {
			$idvalue = $instance['idvalue'];
			
			$code = "[wpedon id='$idvalue' widget='true']";
			
			echo do_shortcode($code);
		}
		
		echo $after_widget;
	}

	// private save
	function update( $new_instance, $old_instance ) {
		$instance = 			$old_instance;
		$instance['title'] = 	strip_tags($new_instance['title']);
		$instance['idvalue'] = 	strip_tags($new_instance['idvalue']);
		return $instance;
	}

	// private output
	function form( $instance ) {
	
		if (empty($instance['title'])) {
			$instance['title'] = "";
		}
		if (empty($instance['idvalue'])) {
			$instance['idvalue'] = "";
		}
		
		$title = 		esc_attr($instance['title']);
		$idvalue = 		esc_attr($instance['idvalue']);
		
		?>
		<p><label>Widget Name:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		Choose an existing button:
		<br />
			<select id="wpedon_button_id" name="<?php echo $this->get_field_name('idvalue'); ?>">
				<?php
				$args = array('post_type' => 'gandhipeacedonation_don_button','posts_per_page' => -1);

				$posts = get_posts($args);

				$count = "0";
				
				if (isset($posts)) {
					
					foreach ($posts as $post) {

						$id = 			$posts[$count]->ID;
						$post_title = 	$posts[$count]->post_title;
						$price = 		esc_attr(get_post_meta($id,'wpedon_button_price',true));
						$sku = 			esc_attr(get_post_meta($id,'wpedon_button_id',true));

						echo "<option value='$id' "; if($idvalue == $id) { echo "SELECTED"; } echo ">";
						echo "Name: ";
						echo $post_title;
						echo " - Amount: ";
						echo $price;
						echo " - ID: ";
						echo $sku;
						echo "</option>";

						$count++;
					}
				}
				else {
					echo "<option>No buttons found.</option>";
				}
				
				?>
			</select>
			<br />
			Make a new button: <a target="_blank" href="admin.php?page=wpedon_buttons&action=new">here</a><br />
			Manage existing buttons: <a target="_blank" href="admin.php?page=wpedon_buttons">here</a>
		
		
		<br /><br />
<?php
	}
}



// Register and load the widget
function wpedon_button_widget_load() {
    register_widget( 'wpedon_button_widget' );
}
add_action( 'widgets_init', 'wpedon_button_widget_load' );