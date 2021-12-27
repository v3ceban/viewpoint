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

					<aside id="singleAside">
						<?php if (get_field('name')) : ?>
							<h3><?php the_field('name'); ?></h3>
							<hr>
						<?php endif; ?>
						<div class="biography">
							<h3>Bio</h3>
							<?php if (get_field('photo')) : ?>
								<img src="<?php the_field('photo'); ?>" alt="<?php the_field('name'); ?> bio" loading="lazy" class="alignleft bioImage">
							<?php endif; ?>
							<?php if (get_field('bio')) : ?>
								<p><?php the_field('bio'); ?></p>
								<hr>
							<?php endif; ?>
						</div>
						<h3>Details</h3>
						<ul>
							<?php if (get_field('dates_from')) : ?>
								<li>Date: <?php the_field('dates_from'); ?>
									<?php if (get_field('dates_to')) : echo ('to ');
										the_field('dates_to');
									endif; ?></li>
							<?php endif; ?>

							<?php if (get_field('gallery_space')) : ?>
								<li>Gallery Space: <?php the_field('gallery_space'); ?></li>
							<?php endif; ?>

							<?php if (get_field('2nd_reception_date')) : ?>
								<li>2nd Reception: <?php the_field('2nd_reception_date'); ?><?php if (get_field('2nd_reception_time_from')) : echo (', ');
																								the_field('2nd_reception_time_from');
																							endif; ?>
									<?php if (get_field('2nd_reception_time_to') and get_field('2nd_reception_time_from')) : echo ('to ');
										the_field('2nd_reception_time_to');
									endif; ?></li>
							<?php endif; ?>

							<?php if (get_field('artist_reception_date')) : ?>
								<li>Artist Reception: <?php the_field('artist_reception_date'); ?><?php if (get_field('artist_reception_time_from')) : echo (', ');
																										the_field('artist_reception_time_from');
																									endif; ?>
									<?php if (get_field('artist_reception_time_to') and get_field('artist_reception_time_from')) : echo ('to ');
										the_field('artist_reception_time_to');
									endif; ?></li>
							<?php endif; ?>

							<?php if (get_field('workshop_time_from')) : ?>
								<li>Time: <?php the_field('workshop_time_from'); ?><?php if (get_field('workshop_time_to') and get_field('workshop_time_to')) : echo (' to ');
																						the_field('workshop_time_to');
																					endif; ?></li>
							<?php endif; ?>

							<?php if (get_field('location')) : ?>
								<li>Location: <?php the_field('location'); ?></li>
							<?php endif; ?>

							<?php if (get_field('cost')) : ?>
								<li>Cost: $<?php the_field('cost'); ?></li>
							<?php endif; ?>
						</ul>
						<hr>
						<h2 class="regLink"><a href="#">Registration</a></h2>
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