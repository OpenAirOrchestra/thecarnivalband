<?php
/**
 * @package WordPress
 * @subpackage Classic_Theme
 */
?>
	<div id="sidebar" role="complementary">
	<?php carnie_home_logo(); ?>

<?php
	// Display breadcrumbs

	// Breadcrumbs
	$post_ancestors = get_post_ancestors($post);

	// Check if a page has any parent pages
	if (count($post_ancestors) > 1) 
	{
		array_pop($post_ancestors);
		$comma_separated = implode(",", $post_ancestors);
		$ancestor_list = wp_list_pages("title_li=&include=".$comma_separated."&echo=0");
		echo "<ul class=\"ancestors\">\n";
		echo $ancestor_list;
		echo "</ul>\n";
	}

	// Children of the parent
	if ($post->post_parent)
	{
		$siblings = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&depth=1");
		echo "<ul class=\"siblings\">\n";
		echo $siblings; 
		echo "</ul>\n";
	}
	// Children of this page.
	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&depth=1");
	if ($children) 
	{ 
		echo "<ul class=\"children\">\n";
		echo $children; 
		echo "</ul>\n";
	} 

	if (function_exists('dynamic_sidebar'))
	{
		$dynamic = dynamic_sidebar('bottom_of_sidebar');
		if ($dynamic)
		{
			echo "<ul class=\"dynamic_sidebar\">\n";
		 	echo $dynamic; 
			echo "</ul>\n";
		}
	}
?>

	</div>

