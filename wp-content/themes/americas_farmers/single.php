<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package americas_farmers
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<div class="page-wrapper single-post">
			<div class="share-post-widget">
				<div class="share-post-wrap">
					<h6 class="share-title">Share</h6>
					<ul class="social-share-buttons">
						<li>
							<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_permalink(); ?>" target="_blank" data-social="facebook" data-shared-url="<?php echo the_permalink(); ?>">
								<i class="fab fa-facebook-f" aria-hidden="true"></i>
							</a>
						</li>
						<li>
							<a href="https://twitter.com/share?url=<?php echo the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" data-social="twitter" data-shared-url="<?php echo the_permalink(); ?>">
								<i class="fab fa-twitter" aria-hidden="true"></i>
						</a>
						</li>
					</ul>
				</div>
			</div>
			<?php if(have_posts()): while(have_posts()): the_post();?>
			<div class="post-content-wrapper">
			<?php
				if(have_rows('post_flexible_content', get_the_ID())):
					while(have_rows('post_flexible_content')): the_row();
						include(locate_template('template-parts/post-content/' . get_row_layout() . '.php'));
					endwhile;
				endif; ?>
			</div>
		</div>

		<aside class="related-stories container">
			<div class="related-content">
				<h4>Related Stories</h4>
				<?php
					//query for other Posts with this Category
					$currentPost = get_the_ID();
					$currentPostCat = get_the_category();

					$relatedArgs = array(
						'post_status'    => 'publish',
						'posts_per_page' => 3,
						'orderby'        => 'rand',
					 	'post__not_in'   => array($currentPost),
						'cat'						=> $currentPostCat[0]->term_id,
					);

					$relatedPostsQuery = new WP_Query($relatedArgs);

					//Check and see which Program category we're on & output the proper "grow" header for it
					//grow-rural-education  grow-communities  	grow-ag-leaders
					$relatedProgramText = '';
					$programClass = '';
					if ($currentPostCat[0]->slug === 'grow-communities') {
						$relatedProgramText = 'GROW <span>Communities</span>';
						$programClass = 'communities';
					} else if ($currentPostCat[0]->slug === 'grow-rural-education') {
						$relatedProgramText = 'GROW <span>Rural Education</span>';
						$programClass = 'rural';
					} else if ($currentPostCat[0]->slug === 'grow-ag-leaders') {
						$relatedProgramText = 'GROW <span>Ag Leaders</span>';
						$programClass = 'leaders';
					}

				?>
				<?php if ( $relatedPostsQuery->have_posts() ) { ?>
					<ul>
						<?php while($relatedPostsQuery->have_posts()) : $relatedPostsQuery->the_post(); ?>
							<li>
								<div class="post-image">
									<a class="image" href="<?php the_permalink(); ?>">
										<?php
												//They need to upload it as featured image so that the FB sharing can get images because it gets it from there automagically
												if ( get_the_post_thumbnail() ) {
													$relatedBgImg = get_post_thumbnail_id();
													$relatedBgImgSize = 'related_stories';
													echo wp_get_attachment_image( $relatedBgImg, $relatedBgImgSize );
												}
										 ?>
									 </a>
								</div>
								<div class="post-program <?php echo $programClass; ?>"><a href="/<?php echo $currentPostCat[0]->slug; ?>/"><?php echo $relatedProgramText; ?></a></div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<a href="<?php the_permalink(); ?>" class="special-link <?php echo $programClass; ?>" aria-label="Read more: <?php the_title(); ?>">Read More</a>
							</li>
						<?php endwhile; ?>
					</ul>
			<?php	}
				wp_reset_postdata();
			?>
			<a href="/stories?category=<?php echo $currentPostCat[0]->slug; ?>" class="button more-stories">Read More Stories</a>
			</div>
		</aside>


<?php
	endwhile;
	endif;
	?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
