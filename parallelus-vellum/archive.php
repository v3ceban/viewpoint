<?php global $wp_query;
/**
 * The template for displaying Archive pages.
 */

get_header(); ?>

<section id="primary" class="site-content">
	<div id="content" role="main">
		<header class="archive-header">
			<h1 class="archive-title"><?php
										if (is_day()) :
											printf(__('Archives: %s', 'framework'), get_the_date());
										elseif (is_month()) :
											printf(__('Archives: %s', 'framework'), get_the_date(_x('F Y', 'monthly archives date format', 'framework')));
										elseif (is_year()) :
											printf(__('Archives: %s', 'framework'), get_the_date(_x('Y', 'yearly archives date format', 'framework')));
										else :
											_e('Archives', 'framework');
										endif;
										?></h1>
		</header><!-- .archive-header -->

		<?php /* Main Content loop that gets content for the page */ ?>
		<main class="main-container">
			<section class="cat-container">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
							<?php /* Featured image displays here (full, large, medium_large, medium, or thumbnail) */ ?>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('medium_large') ?></a>
							<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
							<div class="cat-footer">
								<?php the_category(' ') ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Read More <i class="fas fa-chevron-right"></i></a>
							</div>
						</div><?php /* end post class div */ ?>
					<?php endwhile; ?>
				<?php else : ?>
					<section id="not-found">
						<h2>Not Found</h2>
						<p>Sorry, but you are looking for something that isn't here.</p>
						<?php get_search_form(); ?>
					</section>
				<?php endif;
				wp_reset_query(); ?>
			</section>
			<?php /* The loop ends here */ ?>
			<aside class="cat-widget-area">
				<?php if (!dynamic_sidebar('cat-aside-area')) : ?>
					<?php /* Footer content if widgets are not being used */ ?>
					<h3>Add an empty widget in this widget area to hide this</h3>
				<?php endif; ?>
			</aside>
	</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>