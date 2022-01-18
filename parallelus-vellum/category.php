<?php global $wp_query;
/**
 * The template for displaying Category pages.
 */

get_header(); ?>

<section id="primary" class="site-content">
	<div id="content" class="cat-content-container" role="main">

		<header class="archive-header">
			<h1 class="archive-title"><?php echo single_cat_title('', false); ?></h1>
		</header><!-- .archive-header -->

		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
		<?php query_posts('posts_per_page=-1&paged=' . $paged); ?>

		<?php /* Main Content loop that gets content for the page */ ?>
		<main class="main-container">
			<section class="cat-container">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
							<?php /* Featured image displays here (full, large, medium_large, medium, or thumbnail) */ ?>
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('medium_large') ?></a>
							<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							<?php if (get_field('dates_from') and get_field('dates_to')) : ?>
								<p class="dates">Dates: <?php the_field('dates_from');
														echo (' – ');
														the_field('dates_to'); ?></p>
							<?php elseif (get_field('dates_from')) : ?>
								<p class="dates">Date: <?php the_field('dates_from'); ?></p>
							<?php endif; ?>
							<p><?php the_excerpt(); ?></p>
							<div class="cat-footer">
								<?php the_category(' ') ?>
								<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">Read More <i class="fas fa-chevron-right"></i></a>
							</div>
						</div><?php /* end post class div */ ?>
					<?php endwhile; ?>
				<?php else : ?>
					<section id="not-found">
						<h2>We're sorry!</h2>
						<p>It seems that we don't have any current or upcoming events in this category.</p>
						<p>Try searching for something else, or check out our Past Exhibits!</p>
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
		</main>
	</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>