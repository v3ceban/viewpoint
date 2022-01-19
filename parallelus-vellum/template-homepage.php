<?php global $wp_query;
/**
 * @package WordPress
 * Template Name: Home Page
 */

get_header(); ?>

<div id="primary" class="site-content">
    <div id="content" role="main">

        <?php while (have_posts()) : the_post(); ?>

            <?php get_template_part('templates/page'); ?>
            <?php comments_template('', true); ?>

        <?php endwhile; // end of the loop. 
        ?>

        <?php /* Categorization. For proper work make sure to set max posts per page in reading section to 1 (or less than you're using) */ ?>
        <?php /* Set cat= to the category number to filter posts by category, set posts_per_page=-1 to display all or x to display x*/ ?>
        <?php query_posts('cat=28,-33&posts_per_page=2'); ?>

        <?php /* Loop for posts */ ?>
        <h2>CURRENT EXHIBITS</h2>
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
                            <?php if (get_field('2nd_reception_date')) : ?>
                                <p class="dates">2nd Saturday Reception: <?php the_field('2nd_reception_date'); ?><?php if (get_field('2nd_reception_time_from')) : echo (', ');
                                                                                                                        the_field('2nd_reception_time_from');
                                                                                                                    endif; ?>
                                    <?php if (get_field('2nd_reception_time_to') and get_field('2nd_reception_time_from')) : echo ('to ');
                                        the_field('2nd_reception_time_to');
                                    endif; ?></p>
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

    </div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>