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

		<?php if (have_posts()) : ?>

			<?php while (have_posts()) : the_post(); ?>

				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<small><?php the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>

					<div class="entry">
						<?php the_content('Read the rest of this entry &raquo;'); ?>
					</div>
				</div>

			<?php endwhile; ?>

			<?php if ( !function_exists('dynamic_sidebar')
				|| !dynamic_sidebar('bottom_of_content') ) : ?>
			<?php endif; ?>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>

		<?php else : ?>

			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php get_search_form(); ?>

		<?php endif; ?>

		</div>
		<div id="content_bottom">&nbsp;</div>
	</div>


<?php get_footer(); ?>

