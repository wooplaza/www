<?php
/* Set Variables */
$bg_color = get_theme_mod( 'site_background_color','');
$bg_image = get_theme_mod( 'site_background_image');
$bg_repeat = get_theme_mod( 'site_background_repeat');
$bg_position = get_theme_mod( 'site_background_position');
$bg_attachment = get_theme_mod( 'site_background_attachment');
$body_size = get_theme_mod( 'body_size');

$body_font = get_theme_mod( 'body_font_family',body_font_family);

$body_color = get_theme_mod( 'body_color');
$body_line = get_theme_mod( 'body_line_height');

$heading_font = get_theme_mod( 'heading_font_family',heading_font_family);

$heading_color = get_theme_mod( 'heading_color');
$page_backgroundcolor = get_theme_mod( 'page_backgroundcolor','');
$small_color = get_theme_mod( 'small_color');
$link_color = get_theme_mod( 'link_color',link_color );
$border_color = get_theme_mod( 'border_color');
$border_accent_color = get_theme_mod( 'accent_color');
$well_color = get_theme_mod( 'well_color');
$form_border_color = get_theme_mod( 'form_border_color');
$heading_color = get_theme_mod( 'heading_color');
$ftr_bg_color = get_theme_mod( 'footer_bg_color',footer_bg_color);
$ftr_bg_image = get_theme_mod( 'footer_background_image');
$ftr_text_color = get_theme_mod( 'footer_text_color',footer_text_color);
$ftr_bottom_border_color = get_theme_mod( 'footer_bottom_border_color');
$ftr_top_border_color = get_theme_mod( 'footer_top_border_color');
$ftr_widget_border_color = get_theme_mod( 'footer_widget_border_color');
$ftr_link_color = get_theme_mod( 'footer_link_color',footer_link_color);
$ftr_linkhover_color = get_theme_mod( 'footer_linkhover_color',footer_linkhover_color);
$navbar_font = get_theme_mod('navbar_font_family',navbar_font_family);
$logo_font = get_theme_mod('logo_font_family',logo_font_family);

$container = get_theme_mod( 'container_width', 1200);

/* Site Background */
echo 'body,html {';
if($bg_color) {echo 'background-color:' .$bg_color.';';}
if($bg_image) {echo 'background-image:url("' .$bg_image.'");';}
if($bg_repeat) {echo 'background-repeat:' .$bg_repeat.';';}
if($bg_position) {echo 'background-position:' .$bg_position.';';}
if($bg_attachment) {echo 'background-attachment:' .$bg_attachment.';';}
echo '}';

if($page_backgroundcolor) echo '#page { background-color:' .$page_backgroundcolor.'; }';
/* Main Text Typography */

if($body_font){
	$body_font = str_replace('+',' ',$body_font);
	echo '@font-family-base-font: e(\''.((preg_match('/ +/',$body_font))?'"'.$body_font.'"':$body_font).'\');';
	echo '@font-family-base: ~"@{font-family-base-font}, @{font-family-sans-serif}";';
}
//exit;	
echo 'body {';
if($body_color){echo 'color:' .$body_color.';';}
if($body_size){echo 'font-size:'.$body_size.'px;';}
if($body_line){echo 'line-height:' .$body_line.';';}
echo '}';
if($body_line){echo 'h4, h5, h6 {line-height:' .$body_line.';}';}

if($heading_font){
	$heading_font = str_replace('+',' ',$heading_font);
	echo '@headings-font-family-font: e(\''.((preg_match('/ +/',$heading_font))?'"'.$heading_font.'"':$heading_font).'\');';
	echo '@headings-font-family: ~"@{headings-font-family-font}, @{font-family-base}";';
}
echo 'h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
	
  > a {font-family: @headings-font-family;}
}';

if($heading_color){echo '@headings-color:' .$heading_color.';';}  


/* Headings Typography */
echo 'h1,h2,h3 {';
if($heading_color){echo 'color:' .$heading_color.';';}
echo'}';

/* Jigo Prices */
if($heading_color){echo 'div.product p.price,.products li strong,.products li .price,.stock {color:' .$heading_color.';}';}

/* Legend */
if($body_color){echo 'legend {color:' .$body_color.';}';}

/* Random Body colors */
if($body_color){echo '.search-label a {color:' .$body_color.';}';}

/* Small Color */
if($small_color){echo 'h1 small, h2 small, h3 small, h4 small, h5 small, h6 small, blockquote small, .entry-meta {color:' .$small_color.';}';}

/* Link Color */

if($link_color){echo '@link-color: '.$link_color.';';}

/* Border Color */
if($border_color){echo '.page-header,footer,.thumbnail,.default_product_display,ol.commentlist li article,.nav-tabs,.nav-tabs > .active > a, .nav-tabs > .active > a:hover,.nav-tabs li a:hover,.pager a,table.checkout_cart td, table.checkout_cart th,form.wpsc_checkout_forms table.table-4,.table th, .table td,#fancy_notification,table.shop_table,table.shop_table td,.cart-collaterals .cart_totals tr td, .cart-collaterals .cart_totals tr th,#payment div.form-row,.nav-tabs.nav-stacked > li > a,blockquote {border-color:' .$border_color.';}';}

echo '.nav-list .divider {';
if($border_accent_color){echo 'background-color:' .$border_accent_color.';';}
if($border_color){echo 'border-color:' .$border_color.';';}
echo '}';

if($border_accent_color){echo '#payment ul.payment_methods {border-color:' .$border_accent_color.';}';}

echo 'hr {';
if($border_color){echo 'border-top-color:' .$border_color.';';}
if($bg_color){echo 'border-bottom-color:' .$bg_color.';';}
echo '}';

if($form_border_color){echo 'textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input,select {border-color:' .$form_border_color.';}';}

/* Breadcrumb,Well,etc */
if($well_color){echo '.breadcrumb,section#respond,#fancy_notification,.nav-tabs li a:hover,.table-striped tbody tr:nth-child(odd) td, .table-striped tbody tr:nth-child(odd) th,.pager a,.shoppingcart table th,#payment,div.product #tabs ul.tabs {background:' .$well_color.';background-color:' .$well_color.';}';
echo 'div.product #tabs .panel {border-color:' .$well_color.';}';
echo '.progress {background-color:' .$well_color.';background-image:none;}';
}
if($border_color){echo '.pager a:hover {background-color:' .$border_color.';}';}

/* Footer Background */
echo 'footer#colophon '.((get_theme_mod( 'footer_width', footer_width ) == 'cont-width')?' .container':'').' {';
if($ftr_top_border_color){echo 'border-top:1px solid ' .$ftr_top_border_color.';';}
echo 'background-color:@footer-bg-color;';
if($ftr_bg_image){echo 'background-image:url("' .$ftr_bg_image.'");';}
echo'}';

if($ftr_bg_color){echo '@footer-bg-color:' .$ftr_bg_color.';';}
if($ftr_text_color){echo '@footer-text-color:' .$ftr_text_color.';';}

/* Footer Borders */
if($ftr_bottom_border_color){echo '.site-info {border-color:' .$ftr_bottom_border_color.';}';}

/* Footer Links */
if($ftr_link_color){echo '@footer-link-color:' .$ftr_link_color.';';}
if($ftr_linkhover_color){echo '@footer-link-hover-color:' .$ftr_linkhover_color.';';}


/* navbar */
if($navbar_font) {
	
	$navbar_font = str_replace('+',' ',$navbar_font);
	echo '@navbar-default-font-family-font: e(\''.((preg_match('/ +/',$navbar_font))?'"'.$navbar_font.'"':$navbar_font).'\');';
	echo '@navbar-default-font-family: ~"@{navbar-default-font-family-font}, @{font-family-base}";';
	echo '.navbar-default {font-family: @navbar-default-font-family;}';
}

if($logo_font) {
	
	$logo_font = str_replace('+',' ',$logo_font);
	echo '@logo-font-family-font: e(\''.((preg_match('/ +/',$logo_font))?'"'.$logo_font.'"':$logo_font).'\');';
	echo '@logo-font-family: ~"@{logo-font-family-font}, @{font-family-base}";';
	echo 'a.navbar-brand {font-family: @logo-font-family;}';
}

if($ftr_widget_border_color){echo 'footer .widget li, footer .shoppingcart table td, footer .shoppingcart table th,.site-footer .widget .nav-tabs.nav-stacked > li > a {border-color:' .$ftr_widget_border_color.';}.site-footer .widget .nav-tabs.nav-stacked > li > a:hover {background:' .$ftr_widget_border_color.';}';}

if(get_theme_mod( 'footer_width', footer_width ) == 'cont-width') {
	//echo 'footer.site-footer {padding:15px 0;}';
	//see: https://github.com/bassjobsen/jamedo-bootstrap-start-theme/issues/6
        if($border_color){echo 'html, footer.site-footer {background:none;border-top:1px solid ' .$border_color.';}';}
	if($border_color){echo '.site-info {border-color:' .$border_color.';}';}
	if($border_color){echo 'footer .widget li, footer .shoppingcart table td, footer .shoppingcart table th {border-color:' .$border_color.';}';}	
}

if(get_theme_mod( 'footer_widgets_number', 4) == 0) {
	echo 'footer.site-footer .site-info {border-top:0px;padding-top: 0px;margin-bottom:10px;}';
}

/* Post Thumbnails */
if(get_theme_mod( 'featured_image_float', 'none' ) == 'left') {echo '.single-post-thumbnail {float: left;margin-right: 15px;}';}
if(get_theme_mod( 'featured_image_float', 'none' ) == 'right') {echo '.single-post-thumbnail {float: right;margin-left: 15px;}';}

$navbar_color = get_theme_mod( 'navbar_color', 'navbar-default' );
if(($navbar_color == 'navbar-red') || ($navbar_color == 'navbar-orange') || ($navbar_color == 'navbar-teal') || ($navbar_color == 'navbar-blue') || ($navbar_color == 'navbar-green') || ($navbar_color == 'navbar-black')) {
	echo '.navbar .nav li.dropdown > .dropdown-toggle:hover .caret {border-top-color: #000;border-bottom-color: #000;}';
	echo'.navbar .nav li.dropdown.open > .dropdown-toggle .caret, .navbar .nav li.dropdown.active > .dropdown-toggle .caret, .navbar .nav li.dropdown.open.active > .dropdown-toggle .caret,.navbar .nav li.dropdown > .dropdown-toggle .caret,.navbar .nav li.dropdown.active.open > .dropdown-toggle:hover .caret {
	border-top-color: #fff;
	border-bottom-color: #fff;
	}';
}

/* Extra styles for container widths */
if($container == 980) {
	echo '
	@media (min-width: 1200px) {
		.navbar-static-cont-width {width:940px;}
	}';
}
