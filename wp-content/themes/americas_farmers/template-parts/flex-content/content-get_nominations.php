<?php
/**
*
* Handles Getting Nomination Count for Schools
*
**/

$states = getStateArray();
?>

<div class="check_for_nominations rural">
	<div class="container">
		<h4 class="check_for_nominations_title">
			Grow <span class="check_for_nominations_program_title">RURAL EDUCATION</span>
		</h4>
		<h2 class="nominations_text">Check for Nominations!</h2>
		<p class="nominations_blurb">Check below to see if your school district has been nominated for<br> the opportunity to win a grant to further STEM education</p>
		<div class="nominations_form_box">
			<div class="nomination_form_section active">
				<!-- <p class="nomination_label">1. SELECT A STATE</p> -->
				<div class="nomination_state_select nomination_select">
					<div class="nomination_state_select_top nomination_select_top">
						<span id="nomination_state_nicename" class="nomination_nicename">Select a State</span>
						<i id="nomination_chevron_state" class="far fa-chevron-down nomination_chevron" aria-hidden="true"></i>
					</div>
					<div class="nomination_state_select_bottom nomination_select_bottom">
						<ul role="listbox" aria-label="state select box" tabindex="0">
							<?php
								foreach($states as $key => $value){
									echo "<li role='option' class='nomination_state_option nomination_option' data-value='" . $value . "' data-nicename='" . $key . "'>" . $key . "</li>";
								}
							?>
						</ul>
					</div>
				</div>
			</div>
			<div class="nomination_form_section" id="nomination_two">
				<!-- <p class="nomination_label">2. SELECT A COUNTY</p> -->
				<div class="nomination_county_select nomination_select">
					<div class="nomination_county_select_top nomination_select_top">
						<span id="nomination_county_nicename" class="nomination_nicename">Select a County</span>
						<i id="nomination_chevron_county" class="far fa-chevron-down nomination_chevron" aria-hidden="true"></i>
					</div>
					<div class="nomination_county_select_bottom nomination_select_bottom">
						<ul role="listbox" id="nomination_county_list" aria-label="county select box" tabindex="1">

						</ul>
					</div>
				</div>

			</div>

			<div class="nomination_form_section" id="nomination_three">
				<!-- <p class="nomination_label">3. SELECT A SCHOOL DISTRICT</p> -->
				<div class="nomination_school_select nomination_select">
					<div class="nomination_school_select_top nomination_select_top">
						<span id="nomination_school_nicename" class="nomination_nicename">Select a School District</span>
						<i id="nomination_chevron_school" class="far fa-chevron-down nomination_chevron" aria-hidden="true"></i>
					</div>
					<div class="nomination_school_select_bottom nomination_select_bottom">
						<ul role="listbox" id="nomination_school_list" aria-label="school select box" tabindex="2" >

						</ul>
					</div>
				</div>

			</div>

			<div class="loading_spinner">
				<div class="lds-ring dark-ring"><div></div><div></div><div></div><div></div></div>
			</div>
		</div>
		<div id="nomination_failure" class="nomination_failure">
			<i class="fal fa-file-search"></i>
			<h2>Sorry, your school district currently has no nominations.</h2>
			<a class="nominations-button" href="<?php echo get_field('nomination_info_link', 'options');?>">Click here to learn how to get nominated</a>
			<h4>If you have any questions regarding your farmer nominations please email us <a class="rural underline" href="mailto:americas.farmers@monsanto.com">here</a></h4>
		</div>
		<div id="nomination_success" class="nomination_success">
			<i class="fal fa-award"></i>
			<h2>You have been nominated <span id="nomination_count">3 </span> for a Grow Rural Education grant.</h2>
			<h3>Your invitation code is <span>20GROW</span></h3>
			<a  class="nominations-button" href="<?php echo get_field('nomination_fulfillment_link', 'options');?>">Click here to start your application</a>
			<h4>If you have any questions regarding your farmer nominations please <a class="rural underline" href="mailto:americas.farmers@monsanto.com">email us here.</a></h4>
		</div>
		<div id="nomination_error" class="nomination_error">
			<p class="nomination_congratulations">Whoops!</p>
			<h2>An error has occurred retrieving nominations.</h2>
			<h3>Please refresh the page and try again.</h3>
			<h4>If this problem persists, please <a class="rural" href="mailto:americas.farmers@monsanto.com">email us here.</a></h4>
		</div>
	</div>
</div>
