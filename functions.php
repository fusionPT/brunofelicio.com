<?php

/************************************************/
/* Define variables */
/************************************************/

define ('THEMEROOT', get_stylesheet_directory_uri());
define ('THEME_IMAGES', THEMEROOT.'/img');
define ('THEME_JS', THEMEROOT.'/js');

/************************************************/
/* Automatic Image sizes */
/************************************************/

if ( function_exists( 'add_image_size' ) ) {

	add_image_size( 'frontpage-image-normal', 1880, 'auto', true ); //(scaled)
	add_image_size( 'frontpage-image-half', 470, 'auto', true );
  add_image_size( 'frontpage-image-big', 2150, 'auto', true ); //(scaled)
	add_image_size( 'inner-image', 1560, 'auto', true ); //(scaled)

}

function my_function_admin_bar() {
    return true;
}

add_filter('show_admin_bar', '__return_false');
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
set_post_thumbnail_size( 300, 300, true );
