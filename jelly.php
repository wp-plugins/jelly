<?php
	/**
	 * Plugin Name: Jelly
	 * Plugin URI: http://lumne.net/plugins/jelly
	 * Description: Slideshow designed and developed by Lumne.
	 * Version: 1.0
	 * Author: Chad Milburn
	 * Author URI: http://lumne.net
	 * License: GPL2

	 Copyright 2013  Lumne  (email : chad@lumne.net)

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as 
		published by the Free Software Foundation.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/
	
	function jelly_activation(){
	
	}
	
	function jelly_deactivation(){
	
	}
	
	register_activation_hook(__FILE__, 'jelly_activation');
	register_deactivation_hook(__FILE__, 'jelly_deactivation');
	
	add_action('admin_menu', 'jelly_settings');

	function jelly_settings(){
        global $jelly_menu;
		$jelly_menu = add_options_page('Jelly Settings', 'Jelly Settings', 'administrator', 'jelly_settings', 'jelly_display_settings');
        if($jelly_menu)
            add_action('load-'.$jelly_menu, 'jelly_admin_styles');
        add_action('admin_init','jelly_admin_init');
	}
    
    function jelly_admin_styles(){
		global $jelly_menu;
		$screen = get_current_screen();

		if($screen->id != $jelly_menu) return;
		wp_enqueue_script('jquery');
		wp_register_style('jelly', plugins_url('css/jelly_admin.css', __FILE__));
		wp_enqueue_style('jelly');
		wp_enqueue_media( );
		wp_register_script('jelly_admin', plugins_url('js/jelly_admin.js', __FILE__), array('jquery')); // Depends on jQuery
		wp_enqueue_script('jelly_admin');
	}
    
	function jelly_display_settings(){
		add_settings_section("jelly_gallery", 'Adjust settings below as needed.', 'jelly_section_text', 'plugin');
		add_settings_field("jelly_field_slidepause",  'Slide Pause',      'jelly_slidepause',   'plugin', "jelly_gallery");
		add_settings_field("jelly_field_transition",  'Transition Speed', 'jelly_transition',   'plugin', "jelly_gallery");
		add_settings_field("jelly_field_images",      'Image Settings',   'jelly_images',       'plugin', "jelly_gallery");
    
	?>
		<h1>Jelly Settings</h1>
		<form action="options.php" method="post">
			<?php settings_fields('jelly_options'); ?>
			<?php do_settings_sections('plugin'); ?>
			<input type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
		</form>
	<?php
		return true;
	}
	
	// Initiates admin page sections
	function jelly_admin_init(){
		register_setting('jelly_options', 'jelly_options', 'jelly_options_validate');
	}

    // Displays description text for admin page section
	function jelly_section_text(){
	    echo '<p>Adjust the settings below as needed.</p>';
	}

	// Displays Slide Pause Speed input
	function jelly_slidepause(){
		$options = get_option('jelly_options');
		echo "<input id='jelly_field_slidepause' name='jelly_options[slide]' size='40' type='text' value='".(!empty($options["slide"])?$options["slide"]:'6500')."' />";
	}

	// Displays Slide Transisiton Speed input
	function jelly_transition(){
		$options = get_option('jelly_options');
		echo "<input id='jelly_field_transition' name='jelly_options[trans]' size='40' type='text' value='".(!empty($options["trans"])?$options["trans"]:'300')."' />";
	}

	function jelly_images(array $args){
		$options = get_option('jelly_options');
		$path = plugin_dir_url(__FILE__);

		$images = preg_grep("/path_\d*/", array_keys($options));
        sort($images);

		//$c = 0;
		echo '<table class="jelly-image-table" data-delete-image="'.$path.'img/delete.png'.'">';
		foreach($images as $image){
			$c = substr(strrchr($image, '_'),1);
			echo '<tr class="jelly-image-row">';
				echo "<td>";
					echo "<img src='".$options["path_{$c}"]."' class='jelly-image-preview' />";
					echo "<input type='hidden' name='jelly_options[path_{$c}]' value='".$options["path_{$c}"]."' />";
				echo "</td>";
				echo "<td>";
					echo "<input id='jelly_field_image_{$c}' class='jelly-image-link' name='jelly_options[link_{$c}]' size='30'";
						echo " type='text' value='".$options["link_{$c}"]."' placeholder='Insert link here (e.g. http://lumne.net)' />";
				echo "</td>";
				echo "<td><img src='".$path."img/delete.png' id='delete_{$c}' class='delete-image' /></td>";
			echo '</tr>';

		}
		echo '<td><input type="button" id="new_image" class="image-button" value="New image" data-count="'.$c.'" /></td>';
		echo '</table>';
	}
	
	// Validates input
	function jelly_options_validate($input){
		// Renumber images starting with zero
		 $images = preg_grep("/path_\d*/", array_keys($input));
		 sort($images);
		 $temp_array = array();
		 $c = 0;
		 $id = array();
		 foreach($images as $image){
            // Add renumber for dots, thumbs, and thumbs locations
		 	preg_match("/path_(\d*)/", $image, $id);
		 	$temp_array['path_'.$c.''] = $input['path_'.$id[1].''];
		 	$temp_array['link_'.$c.''] = $input['link_'.$id[1].''];
		 	unset($input['path_'.$id[1].'']);
		 	unset($input['link_'.$id[1].'']);
		 	$c++;
		 }
		 ksort($temp_array);

		return array_merge($input, $temp_array);
	}

	/*****************************************/
	function jelly_output($atts,$content=NULL){
		/**/
		wp_register_style('jelly', plugins_url('css/jelly.css', __FILE__));
		wp_enqueue_style('jelly');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-effects-core');
		wp_enqueue_script('jquery-effects-slide');
		wp_register_script('jelly', plugins_url('js/jelly.js', __FILE__), array('jquery')); // Depends on jQuery
		wp_enqueue_script('jelly');

		$options = get_option('jelly_options');

		extract( shortcode_atts( array(
								'transition' => 'slide',
								'active' => 0
								), $atts, 'jelly' ) );

		$active = (in_array('active', $atts));

		$top = '';
		$output = '';

		$images = preg_grep("/path_\d*/", array_keys($options));

		foreach($images as $image){
			$c = substr(strrchr($image, '_'),1);
			$top .= (isset($options["link_{$c}"]) && filter_var($options["link_{$c}"], FILTER_VALIDATE_URL) ? '<a href="'.$options["link_{$c}"].'" class="jelly_image" id="image'.$c.'">' : '');
				$top .= "<img ".(isset($options["link_{$c}"]) && filter_var($options["link_{$c}"], FILTER_VALIDATE_URL) ? '' : 'class="jelly_image" id="image'.$c.'" ')."src='".$options["path_{$c}"]."' />";
			$top .= (isset($options["link_{$c}"]) && filter_var($options["link_{$c}"], FILTER_VALIDATE_URL) ? '</a>' : '');
		}

		$output = '<div class="jelly'.($active?' active':'').'" id="gallery'.$id
							.'"data-pause="'.(!empty($options["slide"])?$options["slide"]:'6500')
							.'" data-trans="'.(!empty($options["trans"])?$options["trans"]:'300')
							.'" data-effect="'.'slide'.'">
						<div class="top-show">'
							.$top
					  .'</div>'
				 .'</div>';

		return $output;
	}

	add_shortcode('jelly', 'jelly_output');
	// do_shortcode('[jelly]')

?>