<?php 

/*
@package zerotheme
	===================================================
					ADMIN PAGE
	===================================================
*/

/*
admin_menu – мы можем добавлять страницы меню с помощью функции add_menu_page. 
Для создания страниц в меню администратора рекомендуют использовать хук admin_menu. 
Однако многие разработчики используют хук admin_init, поскольку он выполняется после хука admin_menu.
*/
add_action('admin_menu', 'vp_zero_add_admin_pages' );

/*
Хук admin_init выполняется после того, как секция администратора завершила свой процесс загрузки. 
Таким образом, этот хук выполняется для всех запросов к любой странице администратора. 
Пользователи должны быть зарегистрированы, для того чтобы использовать в своих интересах данный хук.

- Управление доступом – важно проверить права доступа вошедших в систему пользователей перед тем, как разрешить
  пользовательский доступ к определенному набору особенностей и функциональности. admin_init – первое действие, 
  которое будет выполняться в области администратора, поэтому мы можем использовать его для управления доступом.

- Добавление новых параметров – мы можем использовать этот хук для добавления новых 
  страниц настроек или параметров в существующую область параметров WordPress.
*/
add_action('admin_init', 'vp_zero_custom_main_page' );


function vp_zero_add_admin_pages(){

	/*			MAIN ADMIN PAGE
	 =========================================================*/
	//add_menu_page( $page_title,  $menu_title,   $capability,       $menu_slug,        $function,                      $icon_url,               $position );
	add_menu_page( 'Zero Main page', 'Zero Menu', 'manage_options', 'zero-main-page', 'vp_zero_create_main_admin_page', 'dashicons-format-gallery', 110 );
	//add_submenu_page( $parent_slug,            $page_title,            $menu_title,     $capability,      $menu_slug,       $function );
	add_submenu_page( 'zero-main-page' , 'Main Setting of Zero Theme', 'My Profile', 'manage_options', 'zero-main-page', 'vp_zero_create_main_admin_page' );
	
	/*			MAIN SUB ADMIN PAGES
	 =========================================================*/
	add_submenu_page( 'zero-main-page' , 'Main Sidebare of Zero Theme', 'Post Settings', 'manage_options', 'zero-setting-post', 'vp_zero_create_setting_post' );
	add_submenu_page( 'zero-main-page' , 'My Contact Form', 'Contact Form', 'manage_options', 'zero-contact-form', 'vp_zero_create_contact_form' );
	add_submenu_page( 'zero-main-page' , 'Zero Theme Custom CSS', 'Contact CSS', 'manage_options', 'zero-custom-css', 'vp_zero_create_custom_css' );
}



/*	  VIEW PAGES of ZERO ADMIN MENU
=========================================================*/
function vp_zero_create_main_admin_page(){
	require_once( get_template_directory() . '/inc/tamplates/zero-main-admin-page.php');
}

 function vp_zero_create_setting_post(){
 	require_once( get_template_directory() . '/inc/tamplates/zero-setting-post.php');
}

function vp_zero_create_contact_form(){
	require_once( get_template_directory() . '/inc/tamplates/zero-contact-form.php');
}

function vp_zero_create_custom_css(){
	require_once( get_template_directory() . '/inc/tamplates/zero-custom-css.php');
}


/* CREATE AND REGISTRATION NEW OPTIONS IN TABLE of DB
 realization this - add_action('admin_init', 'vp_zero_custom_main_page' )
=========================================================*/
function vp_zero_custom_main_page(){

/*==================================================== MY PROFILE =================================================================*/	
	//Функция также может использоваться для регистрации новой опции, которая будет добавлена на базовую страницу настроек WordPress 
	//register_setting( $option_group,          $option_name,     $sanitize_callback );
	register_setting( 'zero-main-page-group', 'profile_picture');
	register_setting( 'zero-main-page-group', 'first_name');
	register_setting( 'zero-main-page-group', 'last_name');
	register_setting( 'zero-main-page-group', 'description_profile');
	register_setting( 'zero-main-page-group', 'facebook');
 	register_setting( 'zero-main-page-group', 'vk');
 	register_setting( 'zero-main-page-group', 'twitter', 'zero_sanitize_twitter');

    //Создает новый блок (секцию), в котором выводятся поля настроек. Т.е. в этот блок затем добавляются опции, с помощью add_settings_field()
 	//add_settings_section( $id, 						$title, 							$callback, 						$page );
	add_settings_section( 'zero-main-page-section', 'title setting section of main page' , 'vp_zero_main_setting_section', 'zero-main-page' );
	
	// каждая опция должна быть зарегистрирована функцией register_setting(), а эта функция отвечает только за добавление поля опции (HTML кода) на страницу в нужную секцию.
	//add_settings_field( $id,						 $title, 		$callback, 				$page,				 $section,				 $args );
	add_settings_field( 'profile-picture-setting-field', 'Profile picture', 'vp_zero_get_profile_picture', 'zero-main-page', 'zero-main-page-section');
	add_settings_field( 'full-name-setting-field', 'Full Name', 'vp_zero_get_ferst_name', 'zero-main-page', 'zero-main-page-section');
	add_settings_field( 'description-setting-field', 'Description', 'vp_zero_get_description', 'zero-main-page', 'zero-main-page-section');
	add_settings_field( 'facebook-setting-field', 'Facebook link', 'vp_zero_get_facebook', 'zero-main-page', 'zero-main-page-section');
	add_settings_field( 'vk-setting-field', 'Vk link', 'vp_zero_get_vk', 'zero-main-page', 'zero-main-page-section');
	add_settings_field( 'twitter-setting-field', 'twitter link', 'vp_zero_get_twitter', 'zero-main-page', 'zero-main-page-section');

/*==================================================== SETTING POST =================================================================*/	
	register_setting( 'zero-setting-post-group', 'post_formats');
 	register_setting( 'zero-setting-post-group', 'custom_header');
 	register_setting( 'zero-setting-post-group', 'custom_background');

 	add_settings_section( 'zero-setting-post-section', 'Setting post', 'vp_zero_setting_post_section', 'zero-setting-post' );

 	add_settings_field( 'post-formats-settings-field', 'Post Formats', 'vp_zero_get_format_post' , 'zero-setting-post' , 'zero-setting-post-section');
 	add_settings_field( 'custom-header-settings-field', 'Custom Header', 'vp_zero_get_custom_header' , 'zero-setting-post' , 'zero-setting-post-section');
 	add_settings_field( 'custom-background-settings-field', 'Custom Background', 'vp_zero_get_custom_background' , 'zero-setting-post' , 'zero-setting-post-section');

/*==================================================== CONTACT FORM =================================================================*/	
	register_setting('zero-contact-options-group' , 'activate_contact_form');

	add_settings_section( 'zero-contact-form-section', 'Contact Form', 'vp_zero_contact_form_section', 'zero-contact-form');

	add_settings_field( 'activate-contact-form-field', 'Activete contact form', 'vp_zero_get_contact_form', 'zero-contact-form', 'zero-contact-form-section' );

/*==================================================== CUSTOM CSS OPTIONS =================================================================*/	
	register_setting('zero-custom-css-group' , 'custom_css');

	add_settings_section( 'zero-custom-css-section', 'Custom CSS', 'vp_zero_custom_css_section_callback', 'zero-custom-css');

	add_settings_field( 'azero-custom-css-field', 'Insert your Custom CSS', 'vp_zero_get_custom_css_field_callback', 'zero-custom-css', 'zero-custom-css-section' );

} // end function vp_zero_custom_main_page




/*==================================================== FUNCTIONS CUSTOM CSS =================================================================*/	
function vp_zero_custom_css_section_callback(){
	echo "Customize Zero Theme with your own CSS";
}

function vp_zero_get_custom_css_field_callback(){
	$css= get_option('custom_css');
	$css = (empty($css) ? ' /* Zero Theme Custom CSS*/ ' : $css); 
	
	echo '<textarea>'.$css.'</textarea>';
}


/*==================================================== FUNCTIONS CONTACT FORM =================================================================*/	
function vp_zero_contact_form_section(){
	echo "Activate and Deactivate the Built-in Contact-Form";
}

function vp_zero_get_contact_form(){
	$options= get_option('activate_contact_form');
	$checked = ( @$options == 1 ? 'checked' : ''); 
	echo '<label><input type = "checkbox" id="activate_contact_form" name="activate_contact_form" value="1"'.$checked.'/></label><br>';
}

/*==================================================== FUNCTIONS SETTING POST  =================================================================*/	
function vp_zero_setting_post_section(){
	echo "Activate and Deactivate specific Theme Suppor Option";
}

function vp_zero_get_format_post(){
	$options= get_option('post_formats');
	//var_dump($options ); echo "<br>";
	$formats = array('aside','gallery', 'image', 'video', 'quote', 'audio', 'chat' , 'link' );
	$output = '';
	foreach ($formats as $format ) {
		$checked = ( @$options[$format] == 1 ? 'checked' : ''); 
		$output .= '<label><input type = "checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1"'.$checked.'/>'.$format.'</label><br>';
	}
	echo $output;
}

function vp_zero_get_custom_header(){
	$options= get_option('custom_header');
	$checked = ( @$options == 1 ? 'checked' : ''); 
	echo '<label><input type = "checkbox" id="custom_header" name="custom_header" value="1"'.$checked.'/>Activet custom header</label><br>';
}

function vp_zero_get_custom_background(){
	$options= get_option('custom_background');
	$checked = ( @$options == 1 ? 'checked' : ''); 
	echo '<label><input type = "checkbox" id="custom_background" name="custom_background" value="1"'.$checked.'/>Activet custom background</label><br>';
}
/*==================================================== FUNCTIONS MY PROFILE =================================================================*/	
function vp_zero_main_setting_section(){
	echo "if need it vp_zero_main_setting_section i dont known";
}

function vp_zero_get_profile_picture(){
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

function vp_zero_get_ferst_name(){
	$firstName= esc_attr(get_option('first_name'));
	$lastName= esc_attr(get_option('last_name'));
	echo '<p><input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/>';
	echo '<input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/></p>';
}

function vp_zero_get_description(){
	$profileDescription= esc_attr(get_option('description_profile'));
	echo '<p><input type="text" name="description_profile" value="'.$profileDescription.'" placeholder="description"/></p>';
}

function vp_zero_get_facebook(){
	$facebook= esc_attr(get_option('facebook'));
	echo '<p><input type="text" name="facebook" value="'.$facebook.'" placeholder="facebook link"/></p>';
}

function vp_zero_get_vk(){
	$vk= esc_attr(get_option('vk'));
	echo '<p><input type="text" name="vk" value="'.$vk.'" placeholder="vk link"/></p>';			
}

function vp_zero_get_twitter(){
	$twitter= esc_attr(get_option('twitter'));
	echo '<p><input type="text" name="twitter" value="'.$twitter.'" placeholder="twitter link"/></p>
		  <p class = "description">Input your Twitter username without the @ character </p>';
}

function zero_sanitize_twitter($input){
	/*
	Что делает функция - sanitize_text_field:
	    -Проверяет ошибки в кодировке UTF-8;
	    -Конвертирует одиночный знак < в HTML сущность;
	    -Удалят все теги;
	    -Удаляет переносы строк (\r\n), табуляцию (\t) и невидимые символы пробела;
	    -Удаляет пробелы на концах строки.
	    -Заменяет несколько пробелов на одни.
	    -Удаляет октеты: %[a-f0-9]{2}.
	*/
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '' , $output);
	return $output;
}


?>