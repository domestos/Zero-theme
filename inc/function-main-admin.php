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
	add_submenu_page( 'zero-main-page' , 'Main Sidebare of Zero Theme', 'Post Settings', 'manage_options', 'zero-setting-post', 'vp_zero_create_sidebare_page' );
}



/*	  VIEW PAGES of ZERO ADMIN MENU
=========================================================*/
function vp_zero_create_main_admin_page(){
	require_once( get_template_directory() . '/inc/tamplates/main-admin-page.php');
}

 function vp_zero_create_sidebare_page(){
 	require_once( get_template_directory() . '/inc/tamplates/setting-post.php');
 	
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


} // end function vp_zero_custom_main_page
/*==================================================== FUNCTIONS SETTING POST  =================================================================*/	
function vp_zero_setting_post_section(){
	echo "this function vp_zero_setting_post_section";
}

function vp_zero_get_format_post(){
	echo "THIS function vp_zero_get_format_post";
}

function vp_zero_get_custom_header(){
	echo "THIS vp_zero_get_custom_header";
}
function vp_zero_get_custom_background(){
	echo "THIS vp_zero_get_custom_background";
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