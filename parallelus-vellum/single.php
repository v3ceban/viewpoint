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
						<?php if (get_field('name')) : ?>
							<h2><?php the_field('name'); ?></h2>
						<?php endif; ?>
						<hr>
						<?php if (get_field('photo')) : ?>
							<img src="<?php the_field('photo'); ?>" alt="<?php the_field('name'); ?> bio">
						<?php endif; ?>
						<?php if (get_field('bio')) : ?>
							<p><?php the_field('bio'); ?></p>
						<?php endif; ?>
						<hr>
						<h2>Details</h2>
						<?php if (get_field('dates_from')) : ?>
							<p>Date: <?php the_field('dates_from'); ?>
								<?php if (get_field('dates_to')) : echo ('to ');
									the_field('dates_to');
								endif; ?></p>
						<?php endif; ?>

						<?php if (get_field('gallery_space')) : ?>
							<p>Gallery Space: <?php the_field('gallery_space'); ?></p>
						<?php endif; ?>

						<?php if (get_field('2nd_reception_date')) : ?>
							<p>2nd Reception: <?php the_field('2nd_reception_date'); ?><?php if (get_field('2nd_reception_time_from')) : echo (', ');
																							the_field('2nd_reception_time_from');
																						endif; ?>
								<?php if (get_field('2nd_reception_time_to') and get_field('2nd_reception_time_from')) : echo ('to ');
									the_field('2nd_reception_time_to');
								endif; ?></p>
						<?php endif; ?>

						<?php if (get_field('artist_reception_date')) : ?>
							<p>Artist Reception: <?php the_field('artist_reception_date'); ?><?php if (get_field('artist_reception_time_from')) : echo (', ');
																									the_field('artist_reception_time_from');
																								endif; ?>
								<?php if (get_field('artist_reception_time_to') and get_field('artist_reception_time_from')) : echo ('to ');
									the_field('artist_reception_time_to');
								endif; ?></p>
						<?php endif; ?>

						<?php if (get_field('workshop_time_from')) : ?>
							<p>Time: <?php the_field('workshop_time_from'); ?><?php if (get_field('workshop_time_to') and get_field('workshop_time_to')) : echo (' to ');
																					the_field('workshop_time_to');
																				endif; ?></p>
						<?php endif; ?>

						<?php if (get_field('location')) : ?>
							<p>Location: <?php the_field('location'); ?></p>
						<?php endif; ?>

						<?php if (get_field('cost')) : ?>
							<p>Cost: $<?php the_field('cost'); ?></p>
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