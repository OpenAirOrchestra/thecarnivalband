<?php
/**
 * @package WordPress
 * @subpackage Carnie_Theme
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

	<style type="text/css" media="screen">
		@import url( <?php bloginfo('stylesheet_url'); ?> );
	</style>
	
	<script type="text/javascript" src="/javascript/util.js"></script>

<!-- google verify tag -->
		<meta name="verify-v1" content="9KnbSY8V1imiA2OMqY423UFsgQ2Rg15M59Zj0Y4mSmg=" />

		<meta name="keywords" content="carnival band, vancouver, community band, samba, bossa nova, the carnival band, commercial drive, east van, britannia, brittania, brittannia, salsa, funk, reggae, afro-beat, world groove, calypso, samba, open air orchestra, community, music, workshop, workshops, brass, percussion, woodwind, drums">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_get_archives('type=monthly&format=link'); ?>
	<?php //comments_popup_script(); // off by default ?>
	<?php wp_head(); ?>
</head>

<?php
add_filter('body_class','browser_body_class');
function browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}
?>

<body <?php body_class(); ?>>
<div id="page">

<div id="header" role="banner">
	<div id="top_pages_nav">
		<ul>
			<?php wp_list_pages('sort_column=menu_order&depth=1&title_li='); ?>
		</ul>
	</div>
	<?php carnie_external_links(); ?>
</div>

<!-- end header -->
