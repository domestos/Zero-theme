<?php 

/*
@package zerotheme
	===================================================
					ADMIN PAGE
	===================================================
*/

function zero_theme_add_admin_page(){
	
	//Generate Zero Admin Page
	add_menu_page( 'Zero Theme Options', 'Zero', 'manage_options', 'zero_theme', 'zero_theme_create_page', 'dashicons-format-gallery', 110 );
	
	//Generate Zero Admin Sub Page 
	add_submenu_page( 'zero_theme', 'Zero Sidebar Options', 'Sidebar', 'manage_options', 'zero_theme', 'zero_theme_create_page' );
	add_submenu_page( 'zero_theme', 'Zero Theme Options', 'Theme Option', 'manage_options', 'zero_theme_option', 'zero_theme_support_subpage' );
	//add_submenu_page( 'zero-theme', 'Zero Settings', 'Setting', 'manage_options', 'general', 'zero_theme_create_subpage_settings' );

}

add_action( 'admin_menu', 'zero_theme_add_admin_page' );

//Template submenu function of Sidebare Options
function zero_theme_create_page(){
	require_once( get_template_directory() . '/inc/tamplates/zero-admin.php');
}

//Template submenu function of Supprot Theme Options
function zero_theme_support_subpage(){
	require_once( get_template_directory() . '/inc/tamplates/zero-theme-support.php');
}

//generation of uor admin sub pages
function zero_theme_create_subpage_settings(){
	echo "<h1>Zero Setting Options </h1>";
}

// Activation custom setting (Fill page Setting)
add_action('admin_init', 'zero_theme_custom_settings' );


function zero_theme_custom_settings(){
	//Sidebar Option	
		//Функция также может использоваться для регистрации новой опции, которая будет добавлена на базовую страницу настроек WordPress 
 		register_setting( 'zero-setting-group', 'profile_picture');
 		register_setting( 'zero-setting-group', 'first_name');
 		register_setting( 'zero-setting-group', 'last_name');
 		register_setting( 'zero-setting-group', 'zero_description');
 		register_setting( 'zero-setting-group', 'facebook');
 		register_setting( 'zero-setting-group', 'twitter', 'zero_sanitize_twitter');
 		register_setting( 'zero-setting-group', 'vk');
 		//Создает новый блок (секцию), в котором выводятся поля настроек. Т.е. в этот блок затем добавляются опции, с помощью add_settings_field()
 		//add_settings_section( $id,                    $title,               $callback,             $page );
 		add_settings_section( 'zero-sidebar-options', 'Sidebare Options', 'zero_sidebare_options', 'zero-theme' );
 		// каждая опция должна быть зарегистрирована функцией register_setting(), а эта функция отвечает только за добавление поля опции (HTML кода) на страницу в нужную секцию.
 		add_settings_field( 'sidebare-profile-pictures', 'Upload image', 'zero_sidebare_profile_pictures', 'zero-theme', 'zero-sidebar-options' );
 		add_settings_field( 'sidebare-name', 'Full Name', 'zero_sidebare_full_name', 'zero-theme', 'zero-sidebar-options' );
 		add_settings_field( 'sidebare-descriptoin', 'Description ', 'zero_sidebare_description', 'zero-theme', 'zero-sidebar-options' );
 		add_settings_field( 'sidebare-facebook', 'Facebook', 'zero_sidebare_facebook', 'zero-theme', 'zero-sidebar-options' );
 		add_settings_field( 'sidebare-twitter', 'Twitter', 'zero_sidebare_twitter', 'zero-theme', 'zero-sidebar-options' );
 		add_settings_field( 'sidebare-vk', 'Vk', 'zero_sidebare_vk', 'zero-theme', 'zero-sidebar-options' );

 	//Support Theme Options
 		//register_setting( 'zero-theme-support-group', 'post_formats', 'zero_post_formats_callback' );
 		register_setting( 'zero-theme-support-group', 'post_formats');
 		register_setting( 'zero-theme-support-group', 'custom_header');
 		register_setting( 'zero-theme-support-group', 'custom_background');

	 	//add_settings_section( $id,                  $title,              $callback,               $page );
 		add_settings_section( 'zero-option-theme', 'Theme Options', 'zero_theme_options_fun', 'zero-theme-option' );
 		//
 		add_settings_field( 'post-formats', 'Post Formats', 'zero_post_formats' , 'zero-theme-option' , 'zero-option-theme');
 		add_settings_field( 'custom-header', 'Custom Header', 'zero_custom_header' , 'zero-theme-option' , 'zero-option-theme');
 		add_settings_field( 'custom-background', 'Custom Background', 'zero_custom_background' , 'zero-theme-option' , 'zero-option-theme');

}
	

/*

					Supprot Theme Opstions	
	===================================================
*/
	//Post Formats Callback Function
	/*function zero_post_formats_callback( $input ){
		return $input;
	}*/

	function zero_theme_options_fun(){
		echo "Activate and Deactivate specific Theme Suppor Option";
	}

	function zero_post_formats(){
		$options= get_option('post_formats');
		var_dump($options ); echo "<br>";
		$formats = array('aside','gallery', 'image', 'video', 'quote', 'audio', 'chat' , 'link' );
		$output = '';
		foreach ($formats as $format ) {
			$checked = ( @$options[$format] == 1 ? 'checked' : ''); 
			$output .= '<label><input type = "checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1"'.$checked.'/>'.$format.'</label><br>';
		}
		echo $output;
	}

	function zero_custom_header(){
		echo "zero_custom_header";
	}

	function zero_custom_background(){
		echo "zero_custom_background function";
	}

/*
					Sidebar Option	
	===================================================
*/
function zero_sidebare_options(){

		echo " HTML text about this page. short description abou this page";

		function zero_sidebare_profile_pictures(){
			$picture= esc_attr(get_option('profile_picture'));
			if(empty($picture)){
				echo '<p><input class = "button button-secondary" type ="button" value="Upload picture" id="upload-button"/></p>';
				echo '<input id="profile-picture" type="hidden" name="profile_picture" value="'.$picture.'" />';
			}else{
				echo '<p><input class = "button button-secondary" type ="button" value="Replace picture" id="upload-button"/>';
				echo '<input id="remove_profile_picture" class = "button button-secondary" type="button" name="remove_profile_picture" value="Remove" /></p>';
				echo '<input id="profile-picture" type="hidden" name="profile_picture" value="'.$picture.'" />';
			}
					
		}

		function zero_sidebare_full_name(){
			$firstName= esc_attr(get_option('first_name'));
			$lastName= esc_attr(get_option('last_name'));
			echo '<p><input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/>';
			echo '<input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/></p>';
		}

		function zero_sidebare_description(){
			$zeroDescription= esc_attr(get_option('zero_description'));
			echo '<p><input type="text" name="zero_description" value="'.$zeroDescription.'" placeholder="description"/></p>';
			
		}

		function zero_sidebare_facebook(){
			$facebook= esc_attr(get_option('facebook'));
			echo '<p><input type="text" name="facebook" value="'.$facebook.'" placeholder="facebook link"/></p>';
			
		}

		function zero_sidebare_vk(){
			$vk= esc_attr(get_option('vk'));
			echo '<p><input type="text" name="vk" value="'.$vk.'" placeholder="vk link"/></p>';
		}

		function zero_sidebare_twitter(){
			$twitter= esc_attr(get_option('twitter'));
			echo '<p><input type="text" name="twitter" value="'.$twitter.'" placeholder="twitter link"/></p>
			    <p class = "description">Input your Twitter username without the @ character </p>';
		}

		//Sanitization settings
		function zero_sanitize_twitter( $input ){
			$output = sanitize_text_field( $input );
			$output = str_replace('@', '' , $output);
			return $output;
		}
}


 ?>