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
	add_menu_page( 'Zero Options', 'Zero Menu', 'manage_options', 'zero-main-page', 'vp_zero_create_main_admin_page', 'dashicons-format-gallery', 110 );
	//add_submenu_page( $parent_slug,            $page_title,            $menu_title,     $capability,      $menu_slug,       $function );
	add_submenu_page( 'zero-main-page' , 'Main Setting of Zero Theme', ' Zero Person', 'manage_options', 'zero-main-page', 'vp_zero_create_main_admin_page' );
	
	/*			MAIN SUB ADMIN PAGES
	 =========================================================*/
	add_submenu_page( 'zero-main-page' , 'Main Sidebare of Zero Theme', ' Zero Sidebare', 'manage_options', 'zero-sidebare-page', 'vp_zero_create_sidebare_page' );
}



/*	  VIEW PAGES of ZERO ADMIN MENU
=========================================================*/
function vp_zero_create_main_admin_page(){
	require_once( get_template_directory() . '/inc/tamplates/main-admin-page.php');
}

 function vp_zero_create_sidebare_page(){
 	echo "sidebare page (subpage)";
}


/* CREATE AND REGISTRATION NEW OPTIONS IN TABLE of DB
 realization this - add_action('admin_init', 'vp_zero_custom_main_page' )
=========================================================*/
function vp_zero_custom_main_page(){
	//Функция также может использоваться для регистрации новой опции, которая будет добавлена на базовую страницу настроек WordPress 
	//register_setting( $option_group,          $option_name,     $sanitize_callback );
	register_setting( 'zero-main-page-group', 'profile_picture');
	register_setting( 'zero-main-page-group', 'first_name');
	register_setting( 'zero-main-page-group', 'last_name');
    //Создает новый блок (секцию), в котором выводятся поля настроек. Т.е. в этот блок затем добавляются опции, с помощью add_settings_field()
 	//add_settings_section( $id, 						$title, 							$callback, 						$page );
	add_settings_section( 'zero-main-page-section', 'title setting section of main page' , 'vp_zero_main_setting_section', 'zero-main-page' );
	
	// каждая опция должна быть зарегистрирована функцией register_setting(), а эта функция отвечает только за добавление поля опции (HTML кода) на страницу в нужную секцию.
	//add_settings_field( $id,						 $title, 		$callback, 				$page,				 $section,				 $args );
	add_settings_field( 'full-name-setting-field', 'Full Name', 'vp_zero_get_ferst_name', 'zero-main-page', 'zero-main-page-section');
}


function vp_zero_main_setting_section(){



}

function vp_zero_get_ferst_name(){
	$firstName= esc_attr(get_option('first_name'));
	$lastName= esc_attr(get_option('last_name'));
	echo '<p><input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name"/>';
	echo '<input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"/></p>';
}

?>