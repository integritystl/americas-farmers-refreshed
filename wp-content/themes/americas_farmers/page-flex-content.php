<?php
/**
 * Template Name: Flexible Content
 *
 * This template renders flexible content fields.
 *
 * @package Americas Farmers
 */

get_header();
	if(have_posts()): while(have_posts()): the_post();
?>

<div class="page_container">
	<div id="primary" class="content-area">
		<?php
			if(have_rows('flexible_content', get_the_ID())):
				while(have_rows('flexible_content')): the_row();
					include(locate_template('template-parts/flex-content/content-' . get_row_layout() . '.php'));
				endwhile;
			endif;
		?>
	</div>
</div>


<?php
endwhile;
endif;

get_footer();
