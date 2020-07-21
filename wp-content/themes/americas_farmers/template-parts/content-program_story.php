<?php
// Grab the relevant fields
//Which program is this?
$program = get_sub_field('active_program');
//What phase is that program in?
$currentPhase = getProgramPhase($program);
//Which phases should this module be active during? (array)
$activePhases = get_field('active_phases');

$headline = get_field('story_headline', $program);
$subHead = get_field('story_subheadline', $program);
$content = get_field('story_content', $program);

if(in_array('story', $currentPhase)):

?>

<div class="flex-content-section program_story">
	<div class="wysiwyg-wrapper">	
		<?php if ($headline) : ?>
			<h2><?php echo $headline; ?></h2>
		<?php endif; ?>
		<?php if ($subHead) : ?>
			<h3><?php echo $subHead; ?></h3>
		<?php endif; ?>
		<?php if ($content) : ?>
			<?php echo $content; ?>
		<?php endif; ?>
	</div>
</div>

<?php endif;?>
