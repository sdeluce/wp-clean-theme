<?php
/*
 *  Author: Boluge
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	Admin
\*------------------------------------*/
// Posts Formats
$post_formats = array( 'aside', 'chat', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' );
add_theme_support('post-formats', $post_formats); // Ajout de Post Format


if (!isset($content_width))
{
	$content_width = 900;
}

if (function_exists('add_theme_support'))
{
	// Add Menu Support
	add_theme_support('menus');

	// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');
	add_image_size('large', 700, '', true); // Large Thumbnail
	add_image_size('medium', 250, '', true); // Medium Thumbnail
	add_image_size('small', 120, '', true); // Small Thumbnail
	add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	// Add Support for Custom Backgrounds - Uncomment below if you're going to use
	add_theme_support('custom-background', array(
		'default-color' => 'F5F5F5'
		//'default-image' => get_template_directory_uri() . '/img/bg.jpg'
	));

	// Add Support for Custom Header - Uncomment below if you're going to use
	add_theme_support('custom-header', array(
		'default-image'				=> get_template_directory_uri() . '/img/header.jpg',
		'header-text'				=> false,
		'default-text-color'		=> '000',
		'width'						=> 1500,
		'height'					=> 310,
		'random-default'			=> false,
		'wp-head-callback'			=> '',
		'admin-head-callback'		=> '',
		'admin-preview-callback'	=> ''
	));

	// Enables post and comment RSS feed links to head
	add_theme_support('automatic-feed-links');

	// Localisation Support
	load_theme_textdomain('foundation', get_template_directory() . '/languages');
}

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function create_post_type_html5()
{
	register_taxonomy_for_object_type('category', 'foundation'); // Register Taxonomies for Category
	register_taxonomy_for_object_type('post_tag', 'foundation');
	register_post_type('foundation', // Register Custom Post Type
		array(
		'labels' => array(
			'name' => __('Custom Post', 'foundation'), // Rename these to suit
			'singular_name' => __('Custom Post', 'foundation'),
			'add_new' => __('Add New', 'foundation'),
			'add_new_item' => __('Add New Custom Post', 'foundation'),
			'edit' => __('Edit', 'foundation'),
			'edit_item' => __('Edit Custom Post', 'foundation'),
			'new_item' => __('New Custom Post', 'foundation'),
			'view' => __('View Custom Post', 'foundation'),
			'view_item' => __('View Custom Post', 'foundation'),
			'search_items' => __('Search Custom Post', 'foundation'),
			'not_found' => __('No Custom Posts found', 'foundation'),
			'not_found_in_trash' => __('No Custom Posts found in Trash', 'foundation')
		),
		'public' => true,
		'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
		'has_archive' => true,
		'menu_icon' => '',
		'menu_position' => 5,
		'supports' => array(
			'title',
			'editor',
			'excerpt',
			'thumbnail'
		), // Go to Dashboard Custom Foundation post for supports
		'can_export' => true, // Allows export in Tools > Export
		'taxonomies' => array(
			'post_tag',
			'category'
		) // Add Category and Post Tags support
	));
} add_action('init', 'create_post_type_html5'); // Add our Foundation Custom Post Type
function add_menu_icons_styles(){
?>
 
<style>
#adminmenu .menu-icon-foundation div.wp-menu-image:before {
  content: '\f155';
}
</style>
 
<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/
// add_filter('jpeg_quality', function($arg){return 80;}); // Compression des images à 80% au lieu de 90%
add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) ); // Idem php < 5.3
