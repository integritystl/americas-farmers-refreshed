<div class="program_announcement_block">
	<?php $topContent = get_field('top_content', 'options');

	if ($topContent) { ?>
		<div class="program_announce_block_top">
			<h2><?php echo $topContent; ?></h2>
		</div>
	<?php } ?>

	<ul id="program_announcement_list">
		<?php
			if(have_rows('programs', 'options')): while(have_rows('programs', 'options')): the_row();
				//set up our vars for this row
				$background = get_sub_field('background_image'); // Background Image array
				$program = get_sub_field('program'); // Program Post Object
				$phase = getProgramPhase($program->ID); // Returns string of phase (enroll, announce, story)
				$programKey = get_field('program_key', $program->ID); // get the key so we can make classes
				$phaseStrings = preg_filter('/$/', '_phase', $phase); //Just formatting so it's the same as the field group name
				$phaseData = array();
				if (in_array('enroll_phase', $phaseStrings)) {
					$phaseData = get_sub_field('enroll_phase');
				}else if (in_array('announce_phase', $phaseStrings)) {
					$phaseData = get_sub_field('announce_phase');
				}else if (in_array('story_phase', $phaseStrings)) {
					$phaseData = get_sub_field('story_phase');
				}
                ?>
		<li class="<?php echo $programKey;?>">
			<div class='image-holder'>
				<img src="<?php echo $background['sizes']['large']; ?>" class="program-image" />
			</div>
			
			<p class="subheading"><?php echo get_sub_field('sub_heading');?></p>
			<div class="inner">
				<h5><?php echo $phaseData['heading'];?></h5>
				<p><?php echo $phaseData['content']; ?></p>
				<a class="button no-arrow" href="<?php echo $phaseData['button_link'];?>">
					<span><?php echo $phaseData['button_text'];?></span>
				</a>
			</div>
		</li>
		<?php
			endwhile;
			endif;
		?>
	</ul>
</div>
