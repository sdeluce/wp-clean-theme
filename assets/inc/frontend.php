<?php
/*
 *  Author: Boluge
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	Admin
\*------------------------------------*/
// Login override CSS  --Front--
function foundation_login_css()  {
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/login.css?'. filemtime( get_stylesheet_directory() . '/css/login.css').'"/>';
} add_action('login_head', 'foundation_login_css');

// Grilles --Front--
function grid($col) {
//	Largeur des sidebars
	$col_left = 3;
	$col_right = 3;

//	Teste si sidebar ou non
	if (is_active_sidebar('left-area') && is_active_sidebar('right-area')) {
		$col_main = 12 - ($col_left + $col_right);
		$col_left = $col_left;
		$col_right = $col_right;
	} else if (is_active_sidebar('left-area')){
		$col_main = 12 - $col_left;
		$col_left = $col_left;
		$col_right = 0;
	} else if (is_active_sidebar('right-area')){
		$col_main = 12 - $col_right;
		$col_left = 0;
		$col_right = $col_right;
	} else {
		$col_main = 12;
		$col_left = 0;
		$col_right = 0;
	}

	switch ($col) {
		case 'left':
			echo $col_left;
			break;
		case 'main':
			echo $col_main;
			break;
		case 'right':
			echo $col_right;
			break;
	}
}

//Deletes empty classes and removes the sub menu class --front--
function change_submenu_class($menu) {
    $menu = preg_replace('/ class="sub-menu"/','/ class="dropdown" /',$menu);
    return $menu;
} add_filter ('wp_nav_menu','change_submenu_class'); // Add class menu

// Préchargement des pages --front--
function gkp_prefetch() {	
    if ( is_single() ) {  ?>		
		<!-- Préchargement de la page d\'accueil -->
		<link rel="prefetch" href="<?php echo home_url(); ?>" />
		<link rel="prerender" href="<?php echo home_url(); ?>" />
			
		<!-- Préchargement de l\'article suivant -->
		<link rel="prefetch" href="<?php echo get_permalink( get_adjacent_post(false,'',true) ); ?>" />
		<link rel="prerender" href="<?php echo get_permalink( get_adjacent_post(false,'',true) ); ?>" />
   <?php
   }
} add_action('wp_head', 'gkp_prefetch'); // Optimisation

// Encapsulage des videos
function standard_wrap_embeds( $html, $url, $args ) {
	if( 'video' == get_post_format( get_the_ID() ) ) {
		$html = '<div class="video-wrapper">' . $html . '</div>';
	} // end if 
	return $html; 
} add_filter( 'embed_oembed_html', 'standard_wrap_embeds', 10, 3 ) ; // Video responsive

// Add Dashicons in the theme
function wpc_dashicons() {
	wp_enqueue_style('dashicons');
} add_action('wp_enqueue_scripts', 'wpc_dashicons'); // Utilisation de Dashicon WP 3.8

function favicons() {
?>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico">
	<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/apple-touch-icon-152x152.png">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-196x196.png" sizes="196x196">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/img/favicon-16x16.png" sizes="16x16">
	<meta name="msapplication-TileColor" content="#464646">
	<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/img/mstile-144x144.png">
	<meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/img/mstile-70x70.png">
	<meta name="msapplication-square144x144logo" content="<?php echo get_template_directory_uri(); ?>/img/mstile-144x144.png">
	<meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/img/mstile-150x150.png">
	<meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/img/mstile-310x310.png">
	<meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/img/mstile-310x150.png">
<?php
} add_action('wp_head', 'favicons');

// Minifier le html
function gkp_html_minify_start()  {
    ob_start( 'gkp_html_minyfy_finish' );
} add_action('get_header', 'gkp_html_minify_start'); // Minifier le html
 
function gkp_html_minyfy_finish( $html )  {
 
   // Suppression des commentaires HTML, 
   // sauf les commentaires conditionnels pour IE
   $html = preg_replace('/<!--(?!s*(?:[if [^]]+]|!|>))(?:(?!-->).)*-->/s', '', $html);
 
   // Suppression des espaces vides
   $html = str_replace(array("\r\n", "\r", "\n", "\t"), '', $html);
   while ( stristr($html, '  ')) 
       $html = str_replace('  ', ' ', $html);
 
   return $html;
}

// Load Foundation scripts (header.php)
function foundation_header_scripts()
{
	if (!is_admin()) {

		wp_deregister_script('jquery'); // Deregister WordPress jQuery
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), '1.10.2'); // Google CDN jQuery
		wp_enqueue_script('jquery'); // Enqueue it!


		wp_register_script('conditionizr', 'http:////cdnjs.cloudflare.com/ajax/libs/conditionizr.js/4.1.0/conditionizr.min.js', array(), '4.1.0'); // Conditionizr
		wp_enqueue_script('conditionizr'); // Enqueue it!

		wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
		wp_enqueue_script('modernizr'); // Enqueue it!

		wp_register_script('foundationscripts', get_template_directory_uri() . '/js/script.js', array(), '1.0.0'); // Custom scripts
		wp_enqueue_script('foundationscripts'); // Enqueue it!
	}
} add_action('init', 'foundation_header_scripts'); // Add Custom Scripts to wp_head

// Load Foundation conditional scripts
function foundation_conditional_scripts()
{
	if (is_page('pagenamehere')) {
		wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
		wp_enqueue_script('scriptname'); // Enqueue it!
	}
} add_action('wp_print_scripts', 'foundation_conditional_scripts'); // Add Conditional Page Scripts

// Load Foundation styles
function foundation_styles()
{
	wp_register_style('foundation', get_template_directory_uri().'/css/style.css', array(), filemtime( get_stylesheet_directory() . '/css/style.css'), 'all');
	wp_enqueue_style('foundation'); // Enqueue it!
} add_action('wp_enqueue_scripts', 'foundation_styles'); // Add Theme Stylesheet

// Register Foundation Navigation
function register_foundation_menu()
{
	register_nav_menus(array( // Using array to specify more menus if needed
		'header-menu' 	=> __('Header Menu', 'foundation'), // Main Navigation
		'footer-menu' 	=> __('Footer Menu', 'foundation'), // Sidebar Navigation
		'extra-menu' 	=> __('Extra Menu', 'foundation') // Extra Navigation if needed (duplicate as many as you need!)
	));
} add_action('init', 'register_foundation_menu'); // Add Foundation Menu

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
	$args['container'] = false;
	return $args;
} add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
	return is_array($var) ? array() : '';
} // add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
} add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes) {
	global $post;
	if (is_home()) {
		$key = array_search('blog', $classes);
		if ($key > -1) {
			unset($classes[$key]);
		}
	} elseif (is_page()) {
		$classes[] = sanitize_html_class($post->post_name);
	} elseif (is_singular()) {
		$classes[] = sanitize_html_class($post->post_name);
	}

	return $classes;
} add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action('wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	));
} add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function foundation_pagination() {
	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="navigation"><ul class="pagination">' . "\n";

	/**	Previous Post Link */
	 if ( get_previous_posts_link() )
	 	printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="current"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="current"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="current"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	 if ( get_next_posts_link() )
	 	printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";
} add_action('init', 'foundation_pagination'); // Add our HTML5 Pagination

// Remove Admin bar
function remove_admin_bar()
{
	return false;
} add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar

// Remove 'text/css' from our enqueued stylesheet
function foundation_style_remove($tag)
{
	return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
} add_filter('style_loader_tag', 'foundation_style_remove'); // Remove 'text/css' from enqueued stylesheet

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
} add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Custom Gravatar in Settings > Discussion
function foundationgravatar ($avatar_defaults)
{
	$myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
	$avatar_defaults[$myavatar] = "Custom Gravatar";
	return $avatar_defaults;
} add_filter('avatar_defaults', 'foundationgravatar'); // Custom Gravatar in Settings > Discussion

// Threaded Comments
function enable_threaded_comments() {
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
	}
} add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments

// Custom Comments Callback
function foundationcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/
function add_menu_icons_styles(){
?>
 
<style>
#adminmenu .menu-icon-foundation div.wp-menu-image:before {
  content: '\f155';
}
</style>
 
<?php
} add_action( 'admin_head', 'add_menu_icons_styles' );

// Foundation navigation
function foundation_nav()
{
	wp_nav_menu(
		array(
			'theme_location'  => 'header-menu',
			'menu'            => '',
			'container'       => false,
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => '',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul>%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)
	);
}
// Footer nav
function footer_nav()
{
	wp_nav_menu(
		array(
			'theme_location'  => 'footer-menu',
			'menu'            => '',
			'container'       => false,
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => '',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul>%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		)
	);
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/
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

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
remove_action('wp_head', 'wp_generator'); // Remove Wordpress version