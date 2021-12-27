<?php

/**
 * The Template for displaying an individual post.
 */

get_header(); ?>

<div id="primary" class="site-content">
	<div id="content" role="main">

		<?php while (have_posts()) : the_post(); ?>
			<?php
			global $has_vc_posts_list, $post_id_has_vc_posts_list;
			$post_id_has_vc_posts_list = get_the_ID();
			$has_vc_posts_list = has_shortcode(get_the_content(), 'blog');
			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				// Post Navigation (next/previous links)
				//................................................................
				$showPostNav = (get_options_data('blog-options', 'show-post-navigation') == 'true') ? true : false;
				if (isset($showPostNav) && $showPostNav == 'true') {
					// Show navigation
					next_and_previous_post_navigation();
				}
				?>
				<main id="theMainPostContent">
					<div class="row-fluid">
						<?php get_template_part('templates/post', get_post_format()); ?>
					</div>
					<!--Post Content-->

					<aside>
						<?php if (get_field('artists_name')) : ?>
							<h2><?php the_field('artists_name'); ?></h2>
						<?php endif; ?>
						<hr>
						<?php if (get_field('artists_photo')) : ?>
							<img src="<?php the_field('artists_photo'); ?>" alt="<?php the_field('artists_name'); ?> bio">
						<?php endif; ?>
						<?php if (get_field('artists_bio')) : ?>
							<p><?php the_field('artists_bio'); ?></p>
						<?php endif; ?>
						<hr>
					</aside>
				</main>
				<?php

				// Show comments
				//................................................................
				comments_template('', true); ?>

			</article><!-- #post -->

		<?php endwhile; // end of the loop. 
		?>

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>