<?php
/**
*
* Component for adding a bio of a person, using image, text and wysiwyg fields
*
* @param 'content' people_component
*
**/


?>


<div class="people_component flex-content-section container">
	<?php if (have_rows('people_item')) : ?>

			<?php while (have_rows('people_item')) : the_row();
				$personImg = 	get_sub_field('person_image');
				$size = 'full';
			?>

				<div class="person">
					<div class="person-img">
						<?php echo wp_get_attachment_image( $personImg, $size );?>
					</div>
					<div class="person-content">
						<?php if(get_sub_field('person_headline_super')): ?>
							<span class="person_super_headline"><?php echo get_sub_field('person_headline_super'); ?></span>
						<?php endif?>
						<h3><?php	the_sub_field('person_headline'); ?></h3>
						<h4><?php	the_sub_field('person_subheadline'); ?></h4>
						<p class="people-text"><span class="people-text-content"><?php the_sub_field('person_content');?></span></p>
					</div>
				</div>
			<?php endwhile; ?>

	<?php endif; ?>
</div>
