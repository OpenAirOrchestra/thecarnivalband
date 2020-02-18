<?php
/**
 * @package WordPress
 * @subpackage Carnie_Theme
 */

get_header(); ?>

<?php get_sidebar(); ?>

	<div id="content_wrapper">
		<div id="content_background_image">&nbsp;</div>
		<div id="content_top">&nbsp;</div>
		<div id="content" role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>

					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				</div>
			</div>
			<?php endwhile; endif; ?>
			<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
			<?php if ( !function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('bottom_of_content') ) : ?>
			<?php endif; ?>

		</div>
		<div id="content_bottom">&nbsp;</div>
	</div>


<?php get_footer(); ?>
