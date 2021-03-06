<?php global $custom_query, $column_left, $column_right, $headerClass;
/**
 * 
 * The default template for displaying content. Used for post formats: standard and image, Views: blog, index, archive, search and single posts.
 *
 */

// Title (for everything except image left layout)
if (!$column_right && (!get_post_format() || get_post_format() == 'image')) {
	theme_post_title();
}

// Image size
$shortcode = (isset($custom_query->query)) ? $custom_query->query : false;
$size  = get_post_image_size('post-thumbnail', $shortcode);
$media = false;
if (is_single() && get_options_data('blog-options', 'single-post-image', 'false') !== 'true') {
	$media =  false;
} else {
	if (is_array($size)) {
		$thumb = get_post_thumbnail_id($post->ID);
		$crop = ($size[0] == 0 || $size[1] == 0) ? false : true;

		if (function_exists('vt_resize') && $thumb) {
			$image = vt_resize($thumb, '', $size[0], $size[1], $crop);
			$media = '<img src="' . $image['url'] . '" width="' . $image['width'] . '" height="' . $image['height'] . '">';
		}
	} else {
		$media = get_the_post_thumbnail($post->ID, $size);
	}
}

// Content
if ($column_right) :
	// If using columns and there is a header
	if ($headerClass) { ?>
		<div class="span<?php echo  $column_right ?>">
		<?php
	}

	// Post title
	theme_post_title();
endif;

// Post Content
theme_post_content();


if ($column_right && $headerClass) : ?>
		</div><!-- .span# -->
	<?php
endif; ?>