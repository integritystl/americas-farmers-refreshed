<?php
/**
*
* Handles reading the program and calling SalesForce for the relevant winners
*
**/

// Grab the relevant fields
//Which program is this?
$program = get_sub_field('program');
//What's the relevant key for that program?
$programKey = get_field('program_key', $program);
//What phase is that program in?
$currentPhase = getProgramPhase($program);
//Which phases should this module be active during? (array)
$activePhases = get_sub_field('active_phases');
//Is the current phase in the list of active phases?
// $moduleEnabled = in_array($currentPhase, $activePhases);
//If the current phases is an active phase, render the module, otherwise don't render anything
//NOTE: The year we pass for program display year to the API won't always match the year displayed on the frontend in the h2.
//We have a content managed field instead of using the year passed to the API
$year = get_field('program_display_year', $program);
$program_display_year = empty($year) ? date('Y') : $year;
$winnersBlurb = get_field('winners_content_blurb', $program);
$noWinnersBlurb = get_field('no_winners_blurb', $program);

if(in_array('announce', $currentPhase)):

	//From theme_infrastructure/services/helpers.php
	$states = getStateArray();

?>

	<?php if ($winnersBlurb) : ?>
		<div class="announce_winners_blurb">
			<div class="blurb-wrapper">
				<?php echo $winnersBlurb; ?>
			</div>
		</div>
	<?php endif; ?>

	<div id="announce_winners" data-program="<?php echo $programKey;?>" class="<?php echo $programKey; ?>">

		<h4 class="announce_winners_title">Grow<span class="announce_winners_program_title"><?php echo $programKey; ?></span></h4>
		<h2 class="winners_year" data-program-year="<?php echo $program_display_year;?>"><?php echo $program_display_year;?> WINNERS</h2>

		<p class="announce_winners_label">Select a state using the dropdown field to see who the 2020 winners are in your area.</p>
		<div class="winners_state_select">
			<div class="winners_state_select_top">
				<span id="winners_state_nicename">Select a State</span>
				<i id="winners_chevron" class="far fa-chevron-down" aria-hidden="true"></i>
			</div>
			<div class="winners_state_select_bottom">
				<ul role="listbox" aria-label="state select box" tabindex="0">
					<?php
						foreach($states as $key => $value){
							echo "<li role='option' class='winners_state_option' data-value='" . $value . "' data-nicename='" . $key . "'>" . $key . "</li>";
						}
					?>
				</ul>
			</div>
		</div>
		<div class="loading_spinner">
			<div class="lds-ring dark-ring"><div></div><div></div><div></div><div></div></div>
		</div>
		<div class="winners_total"><span></span> (alphabetical order by county )</div>
		<ul id="winners_container" class="<?php echo $programKey;?>">

		</ul>
		<div id="winner_error" class="winner_error">
			<p class="winner_congratulations">Whoops!</p>
			<h2>An error has occurred retrieving winners.</h2>
			<h3>Please refresh the page and try again.</h3>
			<h4>If this problem persists, please email us <a href="mailto:americas.farmers@monsanto.com">here</a></h4>
		</div>
	</div>

<?php
endif;
?>
