<?php
/**
*
* Handles reading the program and calling SalesForce for the relevant finalists
*
**/
//var_dump('sane'); die;
// Grab the relevant fields
//Which program is this?
$program = get_sub_field('program');
//What's the relevant key for that program?
$programKey = get_field('program_key', $program);
//What phase is that program in?
$currentPhase = getProgramPhase($program);
$finalistsyear = get_field('program_finalists_year', $program);
//$program_finalists_year = empty($finalistsyear) ? date('Y') : $finalistsyear;
//var_dump($programKey, $currentPhase); die;
if(in_array('finalists', $currentPhase)):

	//From theme_infrastructure/services/helpers.php
  $states = getStateArray();

?>

	<div id="announce_finalists" data-program="<?php echo $program;?>" class="<?php echo $programKey; ?>">
		<h4 class="announce_finalists_title">
			Grow <span class="announce_finalists_program_title"><?php echo $programKey; ?> Education</span>
		</h4>
		<h2 class="finalists_year"><?php echo get_sub_field('year_display_header'); ?> Finalists</h2>
		<div class="announce_finalists_blurb">
			<?php echo get_sub_field('content_blurb'); ?>
		</div>
    <p class="announce_finalists_label">Select a state using the dropdown field to see who the <?php echo get_sub_field('year_display_header'); ?> finalists are in your area.</p>

		<div class="finalists_state_select">
			<div class="finalists_state_select_top">
				<span id="finalists_state_nicename">Select a State</span>
				<i id="finalists_chevron" class="fa fa-chevron-down" aria-hidden="true"></i>
			</div>
			<div class="finalists_state_select_bottom">
				<ul role="listbox" aria-label="state select box" tabindex="0">
					<?php
						foreach($states as $key => $value){
							echo "<li role='option' class='finalists_state_option' data-value='" . $value . "' data-nicename='" . $key . "'>" . $key . "</li>";
						}
					?>
				</ul>
			</div>
		</div>
		<div class="loading_spinner">
			<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
		</div>
		<ul id="finalists_container" class="<?php echo $programKey;?>">
		</ul>
		<div id="finalist_error" class="finalist_error">
			<p class="finalist_congratulations">Whoops!</p>
			<h2>An error has occurred retrieving finalists.</h2>
			<h3>Please refresh the page and try again.</h3>
			<h4>If this problem persists, please email us <a href="mailto:americas.farmers@monsanto.com">here</a></h4>
		</div>
	</div>

<?php
endif;
?>
