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

$header = get_option('custom_header' );
if ( @$header == 1 ){
	add_theme_support('custom_header');
}


$beckground = get_option('custom_background');
if( @$beckground == 1){
	add_theme_support('custom_background');
}
 ?>