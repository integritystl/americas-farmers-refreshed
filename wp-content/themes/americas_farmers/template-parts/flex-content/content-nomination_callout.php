<?php
/**
*
* Component for the image callout. Includes background image, body copy, headline and accent arrow.
*
**/
$programLogo = get_sub_field('small_logo');
$nominationHeadline = get_sub_field('nomination_callout_headline');
$nominationContent = get_sub_field('nomination_callout_content');
$nominationBtnText = get_sub_field('nomination_button_text');
$nominationBtnLink = get_sub_field('nomination_button_url');
$program = get_sub_field('current_program');
$programKey = get_field('program_key', $program);
?>

<div class="nomination_callout flex-content-section <?php echo $programKey; ?>">
  <div class="container">
		<?php if ($programLogo) {  ?>
			<div class="nomination_callout-left">
				 <img src="<?php echo $programLogo; ?>" class="program-logo" />
			</div>
		<?php } ?>
    <div class="nomination_callout-right">
  		<div class="nomination_callout-content">
  			<?php if ($nominationHeadline) {  ?>
  				 <h5><?php echo $nominationHeadline; ?></h5>
  			<?php } ?>
  			<?php if ($nominationContent) {  ?>
  				 <p><?php echo $nominationContent; ?></p>
  			<?php } ?>
  		</div>

  		<?php if ($nominationBtnLink) {  ?>
  			<a href="<?php echo $nominationBtnLink; ?>" class="nomination_callout-button button"><?php echo $nominationBtnText; ?></a>
  		<?php } ?>
    </div>

	</div>
</div>
