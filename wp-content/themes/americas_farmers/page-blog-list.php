<?php
/**
 * Template Name: Blog List
 *
 * This template renders the AJAX blog list.
 *
 * @package Americas Farmers
 */

get_header();
	if(have_posts()): while(have_posts()): the_post();
?>

<div class="entry-content">
	<?php
	the_content();
	?>
</div>

<div class="posts-group">

	<?php
	// WP Query
	$args = array(
		'post_type' => 'post',
		'post_status' => 'publish',
	);
	$query = new WP_Query( $args );
	$tax = 'category';
	$terms = get_terms( $tax, $args);
	$count = count( $terms );
		if ( $count > 0 ): ?>
		<div class="post-tags">
			<?php
			echo '<h2>Our Stories</h2>';
			echo '<label for="select-filter-stories" class="screen-reader-text">Filter Stories by Program</label>';
			echo '<select id="select-filter-stories">';
			echo '<option selected value="all">All Programs</option>';
			foreach ( $terms as $term ) {
				$term_link = get_term_link( $term, $tax );
				if ($term->slug === 'featured') {
					echo '';
				} else {
					echo '<option value="' . $term->slug. '" class="tax-filter" title="'.$term->slug.'">' . $term->name . '</option> ';
				}
			}
			echo '</select>'; ?>
	  </div>
	  <?php endif; ?>

	<div id="post-results" class="container"></div>
	<button id="load-more-posts" data-filter="all" class="hidden">Load More</button>
</div>
<?php
endwhile;
endif;

get_footer();
