<?php global $wp_query;
/**
 * @package WordPress
 * Template Name: Test Page
 */

get_header(); ?>

<?php woocommerce_product_filter_products(); ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>