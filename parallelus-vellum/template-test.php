<?php global $wp_query;
/**
 * @package WordPress
 * Template Name: Home Page
 */

get_header(); ?>

<div id="primary" class="site-content">
    <div id="content" class="home-page-wrapper" role="main">
        <main>
            <?php woocommerce_product_filter_products(); ?>
        </main>
    </div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>