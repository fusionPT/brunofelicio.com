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

function brunofelicio_customize_register( $wp_customize ) {
    // Add a section in the Customizer
    $wp_customize->add_section( 'hero_section' , array(
        'title'      => __('Hero Section', 'brunofelicio'),
        'priority'   => 30,
    ));

    // Add a setting for the h2 heading
    $wp_customize->add_setting( 'hero_heading' , array(
        'default'   => 'Let\'s Create Something Awesome Together!',
        'transport' => 'refresh',
    ));

    // Add a control to edit the h2 heading
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'hero_heading_control', array(
        'label'      => __( 'Hero Heading', 'brunofelicio' ),
        'section'    => 'hero_section',
        'settings'   => 'hero_heading',
    )));
}
add_action( 'customize_register', 'brunofelicio_customize_register' );


function enqueue_scripts() {
    wp_enqueue_script('jquery'); // Enqueue jQuery
    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts');

function custom_password_form() {
    global $post;

    // Get the post title
    $title = get_the_title($post->ID);

    $output  = '<div class="password-protected-content">';
    $output .= '<form action="" method="post" class="custom-password-form" data-post-id="' . $post->ID . '">';
    $output .= '<p>To view this content, please enter the password.</p>';
    $output .= '<div class="password-input-container">';
    $output .= '<input name="post_password" type="password" size="20" class="password-input" />';
    $output .= '<button type="submit" class="password-submit">Submit</button>';
    $output .= '</div>';
    $output .= '<p class="password-error"></p>'; // Placeholder for error message
    $output .= '</form>';
    $output .= '</div>';

    return $output;
}
add_filter('the_password_form', 'custom_password_form');

function validate_password_via_ajax() {
    if (!isset($_POST['post_id']) || !isset($_POST['password'])) {
        wp_send_json_error('Missing data.');
    }

    $post_id = intval($_POST['post_id']);
    $password = sanitize_text_field($_POST['password']);

    if (empty($post_id) || !get_post($post_id)) {
        wp_send_json_error('Invalid post.');
    }

    $post_password = get_post_field('post_password', $post_id);

    if ($post_password && $password === $post_password) {
        // Set the WordPress password cookie
        global $wp_hasher;
        if (empty($wp_hasher)) {
            require_once ABSPATH . WPINC . '/class-phpass.php';
            $wp_hasher = new PasswordHash(8, true);
        }

        // Generate the cookie
        $cookie_value = wp_unslash($password);
        setcookie('wp-postpass_' . COOKIEHASH, $wp_hasher->HashPassword($cookie_value), time() + 10 * DAY_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN);

        wp_send_json_success('Password is correct.');
    } else {
        wp_send_json_error('The password you entered is incorrect. Please try again.');
    }
}
add_action('wp_ajax_nopriv_validate_password', 'validate_password_via_ajax');
add_action('wp_ajax_validate_password', 'validate_password_via_ajax');

function enqueue_custom_password_script() {
    error_log('Function executed!'); // Test if the function runs
    wp_enqueue_script('custom-password-script', THEME_JS . '/main.js', array('jquery'), null, true);
    wp_localize_script('custom-password-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_password_script');

// Add Gutenberg styles to the theme
function load_gutenberg_styles() {
    add_theme_support('wp-block-styles'); // Core Gutenberg styles
    add_theme_support('editor-styles');  // Editor styles
    add_editor_style('style-editor.css'); // Custom editor styles (optional)
}
add_action('after_setup_theme', 'load_gutenberg_styles');
