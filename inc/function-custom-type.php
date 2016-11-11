<?php 
/*
@package zerotheme
	===================================================
					THEME CUSTOM POST TYPES
	===================================================
*/

$contact= get_option('activate_contact_form');
if ( @$contact == 1 ){
	//create new menu of post type
	add_action('init', 'zero_contact_form_custom_post_type');
	//edited default preview of post type columns, setted new preview
	add_filter( 'manage_zero-contact-form_posts_columns', 'vp_zero_set_contact_colums');
	//sets values in new columns of edited post type 
	//(10 - tells do this hook only after will compiles other hooks, and 2 - tells that this hook gets 2 -parameters ($column, post_id)  )
	add_filter( 'manage_zero-contact-form_posts_custom_column', 'vp_zero_custom_colum', 10, 2 );

	add_action('add_meta_boxes', 'zero_add_contact_meta_box'  );
	add_action( 'save_post' , 'zero_save_contact_eamil_data');
}

/*  CONTACT CPT*/
function zero_contact_form_custom_post_type(){
	$lables = array(
		'name'				=> 'Massages',
		'singular_name' 	=> 'Massage',
		'menu_name' 		=> 'Massages',
		'name_admin_bar' 	=> 'Massage'
		);

	$args = array(
		'lables' 			=> $lables,
		'show_ui' 			=> true,
		'show_in_menu' 		=> true,
		'capability_type' 	=> 'post',
		'hierarchical' 		=> false,
		'menu_position'		=> 26,
		'menu_icon'			=> 'dashicons-email-alt',
		'supports' 			=> array('title', 'editor', 'author' )
	);

register_post_type('zero-contact-form', $args);
} 
//edit defaulte post type
function vp_zero_set_contact_colums($colums){
	$newColumns= array();
	$newColumns['title'] = 'Full Name';
	$newColumns['massage'] = 'Message';
	$newColumns['email'] = 'Eamil';
	$newColumns['date'] = 'Date';

	//unset($colums['author']); //hidden column
	return $newColumns;

}

function vp_zero_custom_colum($column, $post_id){
	switch ($column) {
		case 'massage':
			echo get_the_excerpt();
			break;		
		case 'email':
			$email = get_post_meta( $post_id, '_contact_email_value_key', true );;
			echo '<a href="mailto:'.$email.'">'.$email.'</a>';
			break;
		default:
			# code...
			break;
	}
}

/* CONTACT META BOXES */
function zero_add_contact_meta_box(){
	add_meta_box( 'contact_email', 'User Email', 'vp_zero_contact_email_callback', 'zero-contact-form', 'side', 'high');
}

// generation html meta box code 
function vp_zero_contact_email_callback($post ){

	/*wp_nonce_fieldВыводит проверочное (защитное, одноразовое) скрытое поле для формы.
	Проверочное (nonce) поле нужно для проверки передаваемых данных формы, чтобы убедиться, что данные были отправлены с текущего сайта, а не от куда-то еще. Это поле не дает абсолютной защиты, но защищает в большинстве случаев. Использовать проверочное поле в формах необходимо.*/
	wp_nonce_field( 'zero_save_contact_eamil_data', 'zero_contact_email_meta_box_nonce');

	$value  = get_post_meta( $post->ID, '_contact_email_value_key', true );

	echo "<lable for='zero_contact_email_field'>User Eamil Address: </lable>";
	echo "<input type='email' id='zero_contact_email_field' name ='zero_contact_email_field' value='". esc_attr( $value ) ."' size='25' />";
}

function zero_save_contact_eamil_data($post_id){

	if( !isset($_POST['zero_contact_email_meta_box_nonce'])){
		return; 
	}

	if( !wp_verify_nonce( $_POST['zero_contact_email_meta_box_nonce'], 'zero_save_contact_eamil_data' ) ){
		return;
	}

	if(defined('DOING_AUTOSAVE' && DOING_AUTOSAVE)){
		return;
	}

	if( !current_user_can('edit_post', $post_id )){
		return;
	}

	if( ! isset($_POST['zero_contact_email_field'])){
		return;
	}

	$my_data = sanitize_text_field($_POST['zero_contact_email_field']);

	update_post_meta( $post_id, '_contact_email_value_key', $my_data);
}

 ?>