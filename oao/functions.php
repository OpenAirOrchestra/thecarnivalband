<?php
/**
 * @package WordPress
 * @subpackage Carnie_Theme
 */


function carnie_external_links_override() {

	?>
	<div id="external_links">
		<ul>
			<li class="big_link">
				<a href="http://www.thecarnivalband.com"><img src="<?php bloginfo('template_directory'); ?>/images/carnival_band_logo.png" /></a>
			</li>
			<li class="big_link">
				<a href="http://greenhorn.openairorchestra.com/greenhorn/about/about-the-greenhorn-community-music-project/"><img src="<?php bloginfo('template_directory'); ?>/images/greenhorn_project_logo.png" /></a>
			<li><a href="http://www.flickr.com/groups/614167@N22/">
				<img src="<?php bloginfo('template_directory'); ?>/images/flickr.png" />
				</a></li>
			<li><a href="http://www.facebook.com/group.php?gid=5847232659">
				<img src="<?php bloginfo('template_directory'); ?>/images/face_book.png" />
				</a></li>
			<li><a href="http://openairorchestra.blogspot.com/search/label/video">
				<img src="<?php bloginfo('template_directory'); ?>/images/you_tube_2.png" />
				</a></li>
			<li><a href="http://openairorchestra.blogspot.com/">
				<img src="<?php bloginfo('template_directory'); ?>/images/blogger_2.png" />
</a></li>
			<li><a href="https://twitter.com/TheCarnivalBand">
				<img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" />
</a></li>
		</ul>
	</div>

	<?php
}
function carnie_home_logo_override() {

	?>

	<div class="logo_wrapper">
		<a href= "<?php bloginfo('home'); ?>">
			<img src="<?php bloginfo('template_directory'); ?>/images/open_air_society_logo.png" />
		</a>
	</div>

	<?php
}
?>
