<?php 
/*
@package zerotheme
	===================================================
					THEME SUPPORT OPTIONS
	===================================================
*/


$options= get_option('post_formats');
$formats = array('aside','gallery', 'image', 'video', 'quote', 'audio', 'chat' , 'link' );
$output = array();

foreach ($formats as $format ) {$output[] = ( @$options[$format] == 1 ? $format : ''); }

if( !empty( $options ) ){
	add_theme_support( 'post-formats', $output );
}
 ?>