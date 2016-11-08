<?php 

/*
@package zerotheme
	===================================================
					ADMIN PAGE
	===================================================

*/

add_action( 'admin_menu', 'zero_theme_add_admin_page' );

function zero_theme_add_admin_page(){
	//Generate Zero Admin Page
	add_menu_page( 'Zero Theme Options', 'Zero', 'manage_options', 'zero-theme', 'zero_theme_create_page', 'dashicons-format-gallery', 110 );
	//Generate Zero Admin Sub Page 
	add_submenu_page( 'zero-theme', 'Zero Theme Options', 'General', 'manage_options', 'zero-theme', 'zero_theme_create_page' );
	
	add_submenu_page( 'zero-theme', 'Zero Settings', 'Setting', 'manage_options', 'general', 'zero_theme_create_subpage_settings' );
}



function zero_theme_create_page(){
	//generation of uor admin pages
	require_once( get_template_directory() . '/inc/tamplates/zero-admin.php');

}

function zero_theme_create_subpage_settings(){
	//generation of uor admin sub pages
	echo "<h1>Zero Setting Options </h1>";

}


 ?>