<?php 

/*
@package zerotheme
	===================================================
					ADMIN ENQUEUE FUNCTIONS
	===================================================

*/

function zero_load_admin_scripts($hook){
	var_dump($hook);
	wp_register_style( 'zero-admin-css', get_template_directory_uri() . '/css/zero.admin.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('zero-admin-css');

	wp_enqueue_media();

	wp_register_script('zero-admin-js', get_template_directory_uri() . '/js/zero.admin.js', array('jquery'), '1.0.0', true);
	wp_enqueue_script( 'zero-admin-js');

}

add_action('admin_enqueue_scripts', 'zero_load_admin_scripts' );

 ?>