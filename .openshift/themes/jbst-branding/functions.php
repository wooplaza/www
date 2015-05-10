<?php
/*
==========================================================
YOU CAN BUILD IN YOUR OWN CUSTOM FUNCTIONALITY HERE
==========================================================
*/
add_action('jbst_child_settings','jbst_branding_child_settings');
function jbst_branding_child_settings()
{
	/* set default logo */
	if(!defined('logo_image_position'))define('logo_image_position','outside-nav');
	//if(!defined('logo_image'))define('logo_image',get_stylesheet_directory_uri().'/assets/images/transportation-30967_150.png');
	
	define('jbst_customizer',0);
}	

require get_stylesheet_directory() . '/wp-less-to-css/branding.php';

