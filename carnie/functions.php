<?php
/**
 * @package WordPress
 * @subpackage Carnie_Theme
 */

if ( function_exists('register_sidebar') ) {
	register_sidebar(array('name'=>'bottom_of_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
	register_sidebar(array('name'=>'bottom_of_content',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

function carnie_external_links() {

	if ( function_exists('carnie_external_links_override') ) {
		carnie_external_links_override();
	}
	else
	{
	?>
	<div id="external_links">
		<ul>
			<li class="big_link">
				<a href="http://www.openairorchestra.com"><img src="<?php bloginfo('template_directory'); ?>/images/open_air_society_logo.png" /></a>
			</li>
			<li class="big_link">
                               <a href="http://greenhorn.openairorchestra.com/greenhorn/about/about-the-greenhorn-community-music-project/"><img src="<?php bloginfo('template_directory'); ?>/images/greenhorn_project_logo.png" /></a>
			</li>
			<li><a href="http://www.flickr.com/groups/614167@N22/">
				<img src="<?php bloginfo('template_directory'); ?>/images/flickr.png" />
				</a></li>
			<li><a href="http://www.facebook.com/group.php?gid=34634573918">
				<img src="<?php bloginfo('template_directory'); ?>/images/face_book.png" />
				</a></li>
			<li><a href="http://openairorchestra.blogspot.com/search/label/video">
				<img src="<?php bloginfo('template_directory'); ?>/images/you_tube_2.png" />
				</a></li>
                       <li><a href="http://openairorchestra.blogspot.com">
				<img src="<?php bloginfo('template_directory'); ?>/images/blogger_2.png" />
				</a></li>
			<li><a href="https://twitter.com/TheCarnivalBand">
				<img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" />
			</a></li>
		</ul>
	</div>

	<?php
	}
}
function carnie_home_logo() {

	if ( function_exists('carnie_home_logo_override') ) {
		carnie_home_logo_override();
	}
	else
	{
	?>

	<div class="logo_wrapper">
		<a href= "<?php bloginfo('home'); ?>">
			<img src="<?php bloginfo('template_directory'); ?>/images/carnival_band_logo.png" />
		</a>
	</div>

	<?php
	}
}
?>
