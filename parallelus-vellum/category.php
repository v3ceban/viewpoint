<?php global $wp_query;
/**
 * The template for displaying Category pages.
 */

get_header(); ?>

<section id="primary" class="site-content">
	<div id="content" role="main">

		<header class="archive-header">
			<h1 class="archive-title"><?php echo single_cat_title('', false); ?></h1>
		</header><!-- .archive-header -->

		<?php /* Main Content loop that gets content for the page */ ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
					<?php /* Featured image displays here (full, large, medium_large, medium, or thumbnail) */ ?>
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					<?php the_post_thumbnail('medium') ?>
				</div><?php /* end post class div */ ?>
			<?php endwhile; ?>
			<?php /* Navigation (shows if 10+ posts by default) */ ?>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Posts') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Posts &raquo;') ?></div>
			</div>
		<?php else : ?>
			<h2>Not Found</h2>
			<p>Sorry, but you are looking for something that isn't here.</p>
			<?php get_search_form(); ?>
		<?php endif;
		wp_reset_query(); ?>
		<?php /* The loop ends here */ ?>
	</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>