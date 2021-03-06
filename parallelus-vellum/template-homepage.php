<?php global $wp_query;
/**
 * @package WordPress
 * Template Name: Template: Home Page
 */

get_header(); ?>

<div id="primary" class="site-content">
    <div id="content" class="home-page-wrapper" role="main">
        <main class="home-main-container">
            <section class="home-page-content">
                <?php /* Loop for page content */ ?>
                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('templates/page'); ?>
                    <?php comments_template('', true); ?>

                <?php endwhile; ?>
                <?php /* End of the page content loop */ ?>
            </section>

            <?php /* Categorization. For proper work make sure to set max posts per page in reading section to 1 (or less than you're using) */ ?>
            <?php /* Set cat= to the category number to filter posts by category, set posts_per_page=-1 to display all or x to display x*/ ?>
            <?php query_posts('cat=28,-33&posts_per_page=4'); ?>
            <?php /* Loop for posts */ ?>
            <section class="home-page-posts">
                <h2>CURRENT EXHIBITS</h2>
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
                            <?php if (get_field('artist_reception_date')) : ?>
                                <p class="dates">Artist Reception: <?php the_field('artist_reception_date'); ?><?php if (get_field('artist_reception_time_from')) : echo (', ');
                                                                                                                    the_field('artist_reception_time_from');
                                                                                                                endif; ?>
                                    <?php if (get_field('artist_reception_time_to') and get_field('artist_reception_time_from')) : echo ('to ');
                                        the_field('artist_reception_time_to');
                                    endif; ?></p>
                            <?php endif; ?>
                            <div class="post-footer">
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
            <?php /* End of the posts loop */ ?>
        </main>
        <aside class="home-widget-area">
            <?php if (!dynamic_sidebar('home-aside-area')) : ?>
                <?php /* Widget content if widgets are not being used */ ?>
                <h3>Add an empty widget in this widget area to hide this</h3>
            <?php endif; ?>
        </aside>
        <section class="vc_section_wrapper homepage-last-CTA">
            <div class="wpb_row  row-fluid ">
                <div class="wpb_column vc_column_container vc_col-sm-12">
                    <div class="vc_column-inner">
                        <div class="wpb_wrapper">
                            <section class="vc_cta3-container">
                                <div class="vc_general vc_cta3 vc_cta3-style-flat vc_cta3-shape-square vc_cta3-align-center vc_cta3-color-black vc_cta3-icon-size-md">
                                    <div class="vc_cta3_content-container">
                                        <div class="vc_cta3-content">
                                            <header class="vc_cta3-content-header"></header>
                                            <h2 style="text-align: center;">Support Us: <span style="color: #f8c850; -webkit-text-stroke: 0.005em rgba(221, 221, 221, 0.5)"><a href="https://www.viewpointphotoartcenter.org/sponsorship/">DONATE TODAY!</a></span></h2>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php /* Categorization. For proper work make sure to set max posts per page in reading section to 1 (or less than you're using) */ ?>
        <?php /* Set cat= to the category number to filter posts by category, set posts_per_page=-1 to display all or x to display x*/ ?>
        <?php query_posts('cat=4,-170&posts_per_page=3'); ?>
        <?php /* Loop for posts */ ?>
        <section class="home-page-posts home-page-workshops">
            <h2>CURRENT WORKSHOPS</h2>
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
                        <?php if (get_field('artist_reception_date')) : ?>
                            <p class="dates">Artist Reception: <?php the_field('artist_reception_date'); ?><?php if (get_field('artist_reception_time_from')) : echo (', ');
                                                                                                                the_field('artist_reception_time_from');
                                                                                                            endif; ?>
                                <?php if (get_field('artist_reception_time_to') and get_field('artist_reception_time_from')) : echo ('to ');
                                    the_field('artist_reception_time_to');
                                endif; ?></p>
                        <?php endif; ?>
                        <div class="post-footer">
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
        <?php /* End of the posts loop */ ?>
    </div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>