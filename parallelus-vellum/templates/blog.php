<?php global $custom_query, $wp_query, $headerClass, $column_left, $paged;

// Check for a custom query, typically sent by a shortcode
$the_query = (!$custom_query) ? $wp_query : $custom_query;		

if ( $the_query->have_posts() ) : 

	// Show Blog Posts
	// ------------------------------------------------------------------

	// Loop through the results and print each. 
	while ( $the_query->have_posts() ) : $the_query->the_post();  
		$headerClass = false; // clean start for each loop 
 		$post_class = ($column_left) ? 'post-image-left' : '' ;
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
			<div class="post-row">
				<div class="row-fluid">
				<?php
					// Use specific post-format template: aside, image, gallery, etc...
					get_template_part( 'templates/post', get_post_format() ); 
				?>
				</div>
			</div><!-- .row-fluid -->
		</article><!-- #post -->

	<?php endwhile;

	// Pagination
	$paging = ( isset($custom_query->query['paging']) && $custom_query->query['paging'] == 'false' ) ? false : true;
	if (  $paging ) : get_pagination($the_query); endif;

	// clean up
	unset($the_query);
	if (isset($custom_query)) : unset($custom_query); endif;

else :

	// No Posts Found
	// ------------------------------------------------------------------ 

	?>
	<article id="post-0" class="post no-results not-found">
		<header class="entry-header">
			<h1 class="entry-title"><?php _e( 'Sorry, no blog posts were found.', 'framework' ); ?></h1>
		</header>
		<?php if ( current_user_can( 'edit_posts' ) ) :
			// No posts message for users with permissions ?>
			<div class="entry-content">
				<p><?php printf( __( 'If you have not already published some blog posts, you can get started now. &nbsp; <a href="%s"><i class="fa fa-pencil-square"></i> Create a blog post</a>.', 'framework' ), admin_url( 'post-new.php' ) ); ?></p>
			</div><!-- .entry-content -->
		<?php else :
			// No posts message to public. ?>
			<div class="entry-content">
				<p><?php _e( 'We did not find any posts. Try searching for the content or check in another area of the site. Thank you.', 'framework' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>
	</article><!-- #post-0 -->

<?php endif; // end have_posts() check ?>