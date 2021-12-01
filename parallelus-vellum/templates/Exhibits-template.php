<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <?php /* Featured image displays here (full, large, medium_large, medium, or thumbnail) */ ?>
            <?php the_post_thumbnail('medium') ?>
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <p><?php the_time('F jS, Y') ?>
                <?php /* by <?php the_author() ?> */ ?>
            </p>
            <div class="entry">
                <?php the_content('Read More...'); ?>
            </div>
            <p class="postmetadata">
                <?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
            </p>
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