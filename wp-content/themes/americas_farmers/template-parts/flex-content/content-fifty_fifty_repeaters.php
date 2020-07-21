<?php
/**
*
* Flex field for image with content repeaters
*
**/
$sectionHeadline = get_sub_field('section_headline');
$introContent = get_sub_field('intro_content');
$contentImage = get_sub_field('media_image');
$backgroundColor = get_sub_field('background_color');
?>

<div class="flex-content flex_fifty-fifty-repeater container">
	<div class="intro-content">
		<?php if ($sectionHeadline) : ?>
			<h2><?php echo $sectionHeadline; ?></h2>
		<?php endif; ?>
		<?php if ($introContent) : ?>
			<p><?php echo $introContent; ?></p>
		<?php endif; ?>
	</div>
	<div class="fifty-fifty-container">
		<div class="image">
			<img src="<?php echo $contentImage ?>"/>
		</div>
		<div class="content-wrapper <?php echo $backgroundColor; ?>">
			<?php if( have_rows('text_repeater') ): ?>
				<?php while ( have_rows('text_repeater') ) : the_row();
					$content = get_sub_field('repeater_content');
				?>
				<div class="content-text">
					<?php echo $content ?>

					<?php if( have_rows('button_repeater') ): ?>

						<?php while ( have_rows('button_repeater') ) : the_row();
							$link = get_sub_field('buttons');
							$link_url = $link['url'];
						    $link_title = $link['title'];
						    $link_target = $link['target'] ? $link['target'] : '_blank';
						?>
						<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo $link_target ?>"><?php echo $link_title ?></a>
					   	<?php endwhile;?>
					 <?php endif; ?>
				</div>
			   <?php endwhile;?>
			 <?php endif; ?>
		</div>
	</div>
</div>
