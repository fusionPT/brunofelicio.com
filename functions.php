<?php

/************************************************/
/* Define variables */
/************************************************/

define ('THEMEROOT', get_stylesheet_directory_uri());

/**
 * Theme asset URL stamped with the file's modification time.
 *
 * The theme hardcodes its <link>/<script> tags rather than enqueueing them, so
 * nothing ever varied the URL between deploys. A browser holding an old
 * style.css against new markup renders a broken page, so every deploy that
 * changes both CSS and templates needs this stamp to invalidate the cache.
 */
function bf_asset($path) {
    $path = ltrim($path, '/');
    $file = get_stylesheet_directory() . '/' . $path;
    $url  = THEMEROOT . '/' . $path;

    return file_exists($file) ? $url . '?v=' . filemtime($file) : $url;
}
define ('THEME_IMAGES', THEMEROOT.'/img');
define ('THEME_JS', THEMEROOT.'/js');

/**
 * WordPress's own 404 handler (WP::handle_404()) doesn't recognize sitemap
 * requests - it only exempts is_home/is_search/is_feed/etc, so a request for
 * /wp-sitemap.xml gets marked 404 and the header is sent before the sitemap
 * renderer (WP_Sitemaps::render_sitemaps(), hooked later on template_redirect)
 * ever runs. The renderer still prints a correct XML body, but the earlier
 * 404 status sticks - so crawlers see a 404'd sitemap with valid content and
 * discard it. `pre_handle_404` is core's documented extension point for
 * bypassing the default 404 handling; late priority so no other plugin's
 * pre_handle_404 hook can override our bypass for these query vars.
 */
add_filter('pre_handle_404', function ($preempt, $query) {
    if ($query->get('sitemap') || $query->get('sitemap-stylesheet')) {
        return true;
    }
    return $preempt;
}, PHP_INT_MAX, 2);

define('BF_SITE_TAGLINE', 'Product Designer');

/**
 * Permalink of the contact page in the current language.
 *
 * The header resolves this inline in two places; the subscription page needs it
 * too, so it lives here once. Returns '' if the page is missing, letting callers
 * skip rendering rather than emitting a dead link.
 */
function bf_contact_url() {
    $contact_page = get_page_by_path('contact', OBJECT, 'page');
    if (!$contact_page) {
        return '';
    }

    $translated_id = function_exists('pll_get_post')
        ? pll_get_post($contact_page->ID, pll_current_language())
        : $contact_page->ID;

    return $translated_id ? get_permalink($translated_id) : '';
}

/**
 * The site tagline (Settings > General) is a single WP option, not translated
 * per language, so the front page's <title> tag - which WP core builds from
 * site name + tagline via title-tag support - rendered identically on /,
 * /es/ and /pt/. This swaps in the translated tagline on the front page only;
 * every other page already gets a unique title from its own post title.
 */
add_filter('document_title_parts', function ($parts) {
    if (is_front_page() && function_exists('pll__')) {
        $parts['tagline'] = pll__(BF_SITE_TAGLINE);
    }
    return $parts;
});

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

/* Pass password in the url */

function modify_main_query($query) {
    // Ensure we're modifying the main query and the homepage
    if ($query->is_main_query() && !is_admin() && $query->is_home()) {
        error_log('Modifying main query for the homepage.');

        // Set post type to 'work'
        $query->set('post_type', 'work');

        // Preserve custom order set by the plugin
        if (!$query->get('orderby')) {
            $query->set('orderby', 'menu_order');
        }

        if (!$query->get('order')) {
            $query->set('order', 'ASC'); // Default to ascending if not already set
        }

        // Limit posts per page
        $query->set('posts_per_page', 16);
    }
}
add_action('pre_get_posts', 'modify_main_query');

add_action('wp', function () {
    global $wp_query;

    error_log('Template redirect triggered.');

    // Check if a password is provided using ?p=
    if (!isset($_GET['p'])) {
        error_log('No password provided in the query string.');
        return;
    }

    $provided_password = sanitize_text_field($_GET['p']);
    error_log('Provided password: ' . $provided_password);

    // Ensure the main query contains posts
    if (empty($wp_query->posts)) {
        error_log('No posts found in the main query.');
        return;
    }

    // Log the number of posts in the query
    error_log('Number of posts in the query: ' . count($wp_query->posts));

    $cookie_set = false;

    // Process each post in the main query
    foreach ($wp_query->posts as $post) {
        setup_postdata($post);

        // Skip non-password-protected posts
        if (!post_password_required($post)) {
            error_log('Post ID ' . $post->ID . ' is not password protected.');
            continue;
        }

        $stored_password = get_post_field('post_password', $post->ID);
        error_log('Post ID: ' . $post->ID . ' | Stored Password: ' . $stored_password);

        // Check if the provided password matches the stored password
        if ($provided_password === $stored_password) {
            global $wp_hasher;

            if (empty($wp_hasher)) {
                require_once ABSPATH . WPINC . '/class-phpass.php';
                $wp_hasher = new PasswordHash(8, true);
            }

            setcookie(
                'wp-postpass_' . COOKIEHASH,
                $wp_hasher->HashPassword($provided_password),
                time() + 10 * DAY_IN_SECONDS,
                COOKIEPATH,
                COOKIE_DOMAIN
            );

            $cookie_set = true;
            error_log('Password matched for post ID ' . $post->ID . '. Cookie set.');
        } else {
            error_log('Password did not match for post ID: ' . $post->ID);
        }
    }

    wp_reset_postdata();

    // Redirect if a cookie was set
    if ($cookie_set) {
        error_log('Cookie set. Redirecting to refresh the page.');
        wp_redirect(remove_query_arg('p')); // Remove ?p= from the query string
        exit;
    } else {
        error_log('No password cookie was set. Password likely did not match.');
    }
});

// Default meta descriptions. The literals are the Polylang source strings, so they
// serve as the English copy AND as the lookup key for the /es/ and /pt/ versions.
// Translate them under Languages -> Translations, group "brunofelicio".
define('BF_SITE_META_DESCRIPTION', 'I turn ideas into beautiful, user-friendly designs. Check out my portfolio to see how I can help bring your vision to life!');
define('BF_HIRE_ME_META_DESCRIPTION', 'A design subscription: unlimited design and development requests for one flat monthly fee. One active request at a time, next-day turnaround, pause or cancel anytime.');
define('BF_CONTACT_META_DESCRIPTION', 'Get in touch about your next project. Fill out the form and I\'ll get back to you within 1-2 business days.');

add_action('after_setup_theme', 'register_polylang_strings');
function register_polylang_strings() {
    if (function_exists('pll_register_string')) {
        pll_register_string('Heading', 'hero_heading', 'brunofelicio');
        pll_register_string('Works', 'works_menu', 'brunofelicio');
        pll_register_string('About', 'about_menu', 'brunofelicio');
        pll_register_string('Let\'s Talk', 'lets_talk_menu', 'brunofelicio');
        pll_register_string('Hire Me', 'hire_me', 'brunofelicio');
        pll_register_string('Site tagline', BF_SITE_TAGLINE, 'brunofelicio');
        pll_register_string('Contact CTA', 'Have a question? Get in touch', 'brunofelicio');

        // SEO meta descriptions
        pll_register_string('Site meta description', BF_SITE_META_DESCRIPTION, 'brunofelicio', true);
        pll_register_string('Hire me meta description', BF_HIRE_ME_META_DESCRIPTION, 'brunofelicio', true);
        pll_register_string('Contact meta description', BF_CONTACT_META_DESCRIPTION, 'brunofelicio', true);

        pll_register_string('Design Subscription', 'Design Subscription', 'brunofelicio');
        pll_register_string('Subscribe to your team', 'Subscribe to your team', 'brunofelicio');
        pll_register_string('Meet your handpicked team of experts led by your dedicated project manager.', 'Meet your handpicked team of experts led by your dedicated project manager.', 'brunofelicio');
        pll_register_string('Create requests', 'Create requests', 'brunofelicio');
        pll_register_string('Submit design or dev requests to your board — I’ll jump right in.', 'Submit design or dev requests to your board — I’ll jump right in.', 'brunofelicio');
        pll_register_string('Review & Complete', 'Review & Complete', 'brunofelicio');
        pll_register_string('Receive your work, give feedback, and I’ll revise until you\'re happy.', 'Receive your work, give feedback, and I’ll revise until you\'re happy.', 'brunofelicio');
        pll_register_string('One Simple Price', 'One Simple Price', 'brunofelicio');
        pll_register_string('Monthly Subscription', 'Monthly Subscription', 'brunofelicio');
        pll_register_string('month', 'month', 'brunofelicio');
        pll_register_string('Unlimited design requests', 'Unlimited design requests', 'brunofelicio');
        pll_register_string('1 active request at a time', '1 active request at a time', 'brunofelicio');
        pll_register_string('Next-day turnaround', 'Next-day turnaround', 'brunofelicio');
        pll_register_string('Pause or cancel anytime', 'Pause or cancel anytime', 'brunofelicio');
        pll_register_string('Start with Starter', 'Start with Starter', 'brunofelicio');

        // FAQ Strings
        pll_register_string('Frequently Asked Questions', 'Frequently Asked Questions', 'brunofelicio');
        pll_register_string('When can I expect to receive my designs?', 'When can I expect to receive my designs?', 'brunofelicio');
        pll_register_string('Most tasks are delivered within 48 hours. More complex work might need a bit more time.', 'Most tasks are delivered within 48 hours. More complex work might need a bit more time.', 'brunofelicio');
        pll_register_string('What happens after I subscribe?', 'What happens after I subscribe?', 'brunofelicio');
        pll_register_string('You’ll get access to a shared Notion board where you can start posting requests right away.', 'You’ll get access to a shared Notion board where you can start posting requests right away.', 'brunofelicio');
        pll_register_string('Who’s behind the work?', 'Who’s behind the work?', 'brunofelicio');
        pll_register_string('It’s just me — I handle all the design and dev work personally.', 'It’s just me — I handle all the design and dev work personally.', 'brunofelicio');
        pll_register_string('Is there a limit to how many requests I can make?', 'Is there a limit to how many requests I can make?', 'brunofelicio');
        pll_register_string('No limit! You can add as many requests as you’d like to your queue — I’ll work on one at a time.', 'No limit! You can add as many requests as you’d like to your queue — I’ll work on one at a time.', 'brunofelicio');
        pll_register_string('How does the pause feature work?', 'How does the pause feature work?', 'brunofelicio');
        pll_register_string('You can pause your subscription anytime. This stops billing and lets you resume later without losing progress.', 'You can pause your subscription anytime. This stops billing and lets you resume later without losing progress.', 'brunofelicio');
        pll_register_string('How do you handle large or complex projects?', 'How do you handle large or complex projects?', 'brunofelicio');
        pll_register_string('For larger scopes, I break them down into manageable chunks and work through them request by request.', 'For larger scopes, I break them down into manageable chunks and work through them request by request.', 'brunofelicio');
        pll_register_string('What tools do you use for design and development?', 'What tools do you use for design and development?', 'brunofelicio');
        pll_register_string('I mainly use Figma for design and Webflow or custom code (HTML/CSS/JS) for development tasks.', 'I mainly use Figma for design and Webflow or custom code (HTML/CSS/JS) for development tasks.', 'brunofelicio');
        pll_register_string('How does Webflow development work with your service?', 'How does Webflow development work with your service?', 'brunofelicio');
        pll_register_string('If you have a Webflow project, I can jump in and design, build, or update pages directly in your workspace.', 'If you have a Webflow project, I can jump in and design, build, or update pages directly in your workspace.', 'brunofelicio');
        pll_register_string('How do I send you requests?', 'How do I send you requests?', 'brunofelicio');
        pll_register_string('Use the Notion board to add detailed descriptions, links, or references for each request.', 'Use the Notion board to add detailed descriptions, links, or references for each request.', 'brunofelicio');
        pll_register_string('What if I’m not happy with the result?', 'What if I’m not happy with the result?', 'brunofelicio');
        pll_register_string('No worries — I’ll keep improving it until you’re satisfied. Unlimited revisions are included.', 'No worries — I’ll keep improving it until you’re satisfied. Unlimited revisions are included.', 'brunofelicio');
        pll_register_string('Are there any services you don’t offer?', 'Are there any services you don’t offer?', 'brunofelicio');
        pll_register_string('Yes. I don’t offer video editing, 3D work, or long-term maintenance contracts.', 'Yes. I don’t offer video editing, 3D work, or long-term maintenance contracts.', 'brunofelicio');
        pll_register_string('Can I sign up for just one task?', 'Can I sign up for just one task?', 'brunofelicio');
        pll_register_string('Sure! Subscribe for a month, send your request, and pause or cancel anytime after.', 'Sure! Subscribe for a month, send your request, and pause or cancel anytime after.', 'brunofelicio');
        pll_register_string('Do you offer refunds?', 'Do you offer refunds?', 'brunofelicio');
        pll_register_string('Because this is a service-based model, I don’t offer refunds once work begins.', 'Because this is a service-based model, I don’t offer refunds once work begins.', 'brunofelicio');
        pll_register_string('Can I try it just for a month?', 'Can I try it just for a month?', 'brunofelicio');
        pll_register_string('Definitely. Many clients start with a single month — you’re free to pause or cancel whenever you like.', 'Definitely. Many clients start with a single month — you’re free to pause or cancel whenever you like.', 'brunofelicio');
    }
}

function register_polylang_custom_post_types() {
    if (function_exists('pll_register_post_type')) {
        pll_register_post_type('work', array(
            'show_ui' => true,
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        ));
    }
}
add_action('init', 'register_polylang_custom_post_types');

function decode_unicode_escape($string) {
    return preg_replace_callback('/u\{([0-9A-Fa-f]+)\}/', function ($matches) {
        return mb_convert_encoding(pack('H*', str_pad($matches[1], 8, '0', STR_PAD_LEFT)), 'UTF-8', 'UCS-4BE');
    }, $string);
}

/**
 * Per-page metadata for the <head>.
 *
 * The theme has no SEO plugin, so title/description/Open Graph were hardcoded to
 * the English homepage on every URL. This resolves them per request instead, and
 * runs the copy through Polylang so /es/ and /pt/ get their own text.
 *
 * Description precedence: page excerpt -> page content -> per-template default.
 */
function brunofelicio_seo_meta() {
    $image = get_template_directory_uri() . '/img/og-brunofelicio.png';
    $name  = get_bloginfo('name');

    $title = $name;
    $desc  = pll__(BF_SITE_META_DESCRIPTION);
    $url   = function_exists('pll_home_url') ? pll_home_url() : home_url('/');

    if (is_front_page()) {
        // The front page isn't is_singular(), so it fell through to the generic
        // default above on every language - same title (see the document_title_parts
        // filter for the <title> tag itself) and same description on /, /es/, /pt/.
        $title = $name . ' | ' . pll__(BF_SITE_TAGLINE);
        $desc  = decode_unicode_escape(pll__('hero_heading'));
    } elseif (is_singular()) {
        $post  = get_queried_object();
        $title = get_the_title($post) . ' | ' . $name;
        $url   = get_permalink($post);

        if (has_post_thumbnail($post)) {
            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post), 'large');
            if ($thumb) {
                $image = $thumb[0];
            }
        }

        // These pages build their copy in the template or in ACF fields, so
        // post_content is empty - handle each explicitly before the generic
        // content-based fallback below.
        if (is_page_template('page-hire-me.php')) {
            $desc = pll__(BF_HIRE_ME_META_DESCRIPTION);
        } elseif (is_page_template('contact.php')) {
            $desc = pll__(BF_CONTACT_META_DESCRIPTION);
        } elseif ('work' === get_post_type($post) && function_exists('get_field')) {
            $summary = get_field('description_big', $post->ID);
            if (!empty($summary)) {
                $desc = wp_strip_all_tags($summary, true);
            }
        }

        if (has_excerpt($post)) {
            $desc = get_the_excerpt($post);
        } elseif (!empty($post->post_content)) {
            // A page whose content is only a shortcode (the contact form) strips
            // down to nothing, so keep the default rather than emitting an empty tag.
            $stripped = trim(wp_strip_all_tags(strip_shortcodes($post->post_content), true));

            if ('' !== $stripped) {
                $desc = $stripped;
            }
        }
    }

    $desc = trim(preg_replace('/\s+/', ' ', $desc));

    if (mb_strlen($desc) > 160) {
        $desc = rtrim(mb_substr($desc, 0, 157), " ,.;:-") . '...';
    }

    return array(
        'title'       => $title,
        'description' => $desc,
        'url'         => $url,
        'image'       => $image,
    );
}

?>
