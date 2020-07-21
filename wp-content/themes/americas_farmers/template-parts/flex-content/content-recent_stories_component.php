<?php
/**
*
* Component to call for latest Posts/Stories to appear on the page.
*
* @param 'content' recent_stories_component
*
**/

$showRecentStories = get_sub_field('show_recent_stories');
?>

<?php if ($showRecentStories) { ?>
	<div class="recent_stories_component flex-content-section ">
			<h2>Our Stories</h2>
			<div class="container">
			<?php

			$catSelected = get_sub_field('select_stories_category');
			$postCat = get_the_category();
    		$postCatName = $postCat[0]->slug; ?>


				<?php
					$recentPostsArgs = array(
						'post_type' => 'post',
						'posts_per_page' => 5,
						'cat' => $catSelected,
					);

					$recentPostsQuery = new WP_Query($recentPostsArgs);

					if ($recentPostsQuery->have_posts()) :
						$postCount = 1;
						while( $recentPostsQuery->have_posts() ) : $recentPostsQuery->the_post();
							//Using a partial cuz these Posts appear the same on Stories Template & need locate_template to share the variable
							include(locate_template('template-parts/content-posts-group.php'));
						$postCount++;
						endwhile;
						wp_reset_postdata();
					endif;
				 ?>
			</div>

		 <?php if (is_front_page()) : ?>
			 <a class="button" href="/stories">View More</a>
		 <?php else : ?>
			 <a class="button" href="/stories?category=<?php echo $postCatName; ?>">View More</a>
		 <?php endif; ?>

	</div>


<?php } ?>
