<?php global $wp_query;
/**
 * @package WordPress
 * Template Name: Home Page
 */

get_header(); ?>

<?php woocommerce_product_filter_products(); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>