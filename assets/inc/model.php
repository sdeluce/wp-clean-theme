<?php
/*
 *  Author: Boluge
 *  Custom functions, support, custom post types and more.
 */










// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
	// Define Sidebar Widget Area 1
	register_sidebar(array(
		'name' => __('Left Sidebar', 'foundation'),
		'description' => __('Description for this widget-area...', 'foundation'),
		'id' => 'left-area',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));

	// Define Sidebar Widget Area 2
	register_sidebar(array(
		'name' => __('Right Sidebar', 'foundation'),
		'description' => __('Description for this widget-area...', 'foundation'),
		'id' => 'right-area',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	// Define Sidebar Widget Area 2
	register_sidebar(array(
		'name' => __('Footer1', 'foundation'),
		'description' => __('Description for this widget-area...', 'foundation'),
		'id' => 'footer-one',
		'before_widget' => '<div id="%1$s" class="%2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
} 




/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function foundation_shortcode_demo($atts, $content = null)
{
	return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function foundation_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
	return '<h2>' . $content . '</h2>';
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/
// Add Actions












// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters


add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)



add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'foundation_view_article'); // Add 'View Article' button instead of [...] for Excerpts






// Theme support


// Shortcodes
add_shortcode('foundation_shortcode_demo', 'foundation_shortcode_demo'); // You can place [foundation_shortcode_demo] in Pages, Posts now.
add_shortcode('foundation_shortcode_demo_2', 'foundation_shortcode_demo_2'); // Place [foundation_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [foundation_shortcode_demo] [foundation_shortcode_demo_2] Here's the page title! [/foundation_shortcode_demo_2] [/foundation_shortcode_demo]

