<?php
/*
 *  Author: Boluge
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	Optimisation function
\*------------------------------------*/
// http://www.screenfeed.fr/blog/accelerer-wordpress-en-divisant-le-fichier-functions-php-0548/

$divide = 'false';

$templatepath = get_template_directory();
$stylesheetpath = get_stylesheet_directory();

if( $divide == 'true' ){

	if ( defined('DOING_AJAX') && DOING_AJAX && is_admin() ) {
	 
		include( $templatepath.'/assets/inc/ajax.php' );
	 
	} elseif ( is_admin() ) {
	 
		include( $templatepath.'/assets/inc/admin.php' );
	 
	} elseif ( !defined( 'XMLRPC_REQUEST' ) && !defined( 'DOING_CRON' ) ) {
	 
		include( $templatepath.'/assets/inc/frontend.php' );
	 
	}
} else {
	include( $templatepath.'/assets/inc/functions.php' );
}
