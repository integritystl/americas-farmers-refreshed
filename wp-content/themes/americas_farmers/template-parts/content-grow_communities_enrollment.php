<?php
/**
*
* Outputs the form for Grow Communities Enrollment
*
**/
// Grab the relevant fields
//Which program is this?
$program = get_sub_field('enroll_program');
//What's the relevant key for that program?
//What phase is that program in?
$currentPhase = getProgramPhase($program);

if(in_array('enroll', $currentPhase)):
//From theme_infrastructure/services/helpers.php
$states = getStateArray();
$thankYouLink = get_field('thank_you_page', $program);

$headline = get_field('enroll_headline', $program);
$content = get_field('enroll_content_blurb', $program);

?>
<div id="grow_communities_enrollment_page_container" class="enrollment_block grow_communities" data-thank-you-link="<?php echo $thankYouLink ?>">
	<div class="enrollment_block_content wysiwyg">
		<h2><?php echo $headline; ?></h2>
		<?php echo $content; ?>
	</div>
	<h4 class="enrollment_block_title">GROW <span class="enrollment_block_title">Communities</span></h4>
	<div class="enroll_block form">
		<p class="required_field_callout">* Required Field</p>
		<!-- Enrollment Lookup Form -->
		<form id="GC_Enrollment_lookup" data-parsley-validate="">
			<fieldset class="no-box">
				<div class="form-field">
					<label for="gc_code">Enter your personalized code</label>
					<div class="field_instruction">
						What's a personalized code?
						<div class="field_instruction_helper">
							<div class="arrow-up"></div>
							<div class="arrow-up white"></div>
							<p>
								If you've participated in one of our programs before, we've provided you with a Personal Code on a postcard you might have received in the mail.
							</p>
							<p>
								Enter it so you don't have to type your information all over again.
							</p>
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/gc_postcard_example.jpg" />
						</div>
					</div>
					<div class="field-wrapper">
						<input type="text" name="gc_code" id="gc_code" data-parsley-trigger="blur" data-parsley-required="your personalized code" data-parsley-has-special-characters/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
					<div class="button_wrapper GC_Button">
							<button class="GC_Code_submit">Submit</button>
					</div>
				</div>
			</fieldset>
		</form>
		<div class="code_submission_success">
			<h2>Great! We've got your code! But you're not done yet!</h2>
			<h5>
				Please check the information on the form below and confirm that it is correct, or make any necessary corrections, then click submit!
			</h5>
		</div>
		<div class="code_submission_fail">
			<h2>Whoops! Looks like that code didn't work.</h2>
			<h5>
				You can double check to make sure you entered the code correctly, or simply fill out the form below to enroll.
			</h5>
		</div>
		<div class="loading_spinner" id="Code_Spinner">
			<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
		</div>
		<div class="info-span-after-code">
				<p>OR enter your information below</p>
		</div>
		<!-- Full Enrollment Form -->
		<form id="GC_Full_Enrollment_Form" data-parsley-validate="" data-parsley-excluded="input[type=button], input[type=submit], input[type=reset], [disabled]">
			<fieldset class="enrollment_fieldset">
				<!-- First Name -->
				<div class="form-field">
					<label for="gc_code">Full Name *</label>
					<div class="field-wrapper">
						<input type="text" name="full_name" id="full_name" placeholder="Full Name *" data-parsley-trigger="blur" data-parsley-required="a full name" data-parsley-has-special-characters/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				</div>
				<!-- Email -->
				<div class="form-field">
					<label for="gc_code">Email Address *</label>
					<div class="field-wrapper">
						<input type="text" name="email" id="email" placeholder="Email Address *" data-parsley-trigger="blur" data-parsley-required="an email address" data-parsley-type="email" data-parsley-has-special-characters/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				</div>
			</fieldset>
			<fieldset class="enrollment_fieldset">
				<!--Address -->
				<div class="form-field">
					<label for="gc_code">Address *</label>
					<div class="field-wrapper">
						<input type="text" name="address" id="address" placeholder="Address *" data-parsley-trigger="blur" data-parsley-required="an address" data-parsley-has-special-characters/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				</div>
				<!--APT # -->
				<div class="form-field">
					<label for="gc_code">Apt, Suite, Unit, etc (optional)</label>
					<div class="field-wrapper">
						<input type="text" name="apartment" id="apartment" placeholder="Apt, Suite, Unit, etc (optional)" data-parsley-trigger="blur" data-parsley-has-special-characters/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				</div>
			</fieldset>
			<fieldset class="enrollment_fieldset">
				<!--City -->
				<div class="form-field">
					<label for="gc_code">City *</label>
					<div class="field-wrapper">
						<input type="text" name="city" id="city" placeholder="City *" data-parsley-trigger="blur" data-parsley-required="your city" data-parsley-has-special-characters/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				</div>
				<!--State -->
				<div class="form-field select">
					<label for="gc_code">State *</label>
					<div class="enroll_state_select">
						<div class="enroll_state_select_top">
							<span id="enroll_state_nicename">Select a State *</span>
							<i id="enroll_chevron" class="fa fa-chevron-down" aria-hidden="true"></i>
						</div>
						<div class="enroll_state_select_bottom">
							<ul id="state_select_list_wrapper" role="listbox" aria-label="state select box" tabindex="0">
								<?php
									foreach($states as $key => $value){
										echo "<li role='option' class='enroll_state_option' data-value='" . $value . "' data-nicename='" . $key . "'>" . $key . "</li>";
									}
								?>
							</ul>
						</div>
					</div>
					<input type="hidden" id="enroll_state" name="enroll_state" data-parsley-trigger="blur" data-parsley-required data-parsley-error-message="Please select your state" />
				</div>
			</fieldset>
			<fieldset class="enrollment_fieldset">
				<!-- County -->
				<div class="form-field select">
					<label id="county_label" for="gc_county">Farmer County *</label>
					<div class="enroll_county_select">
						<div class="enroll_county_select_top">
							<span id="enroll_county_nicename">Select a County *</span>
							<i id="enroll_county_chevron" class="fa fa-chevron-down" aria-hidden="true"></i>
						</div>
						<div class="enroll_county_select_bottom">
							<ul role="listbox" class="enroll_county_list" id="enroll_county_list" aria-label="county select box" tabindex="0">

							</ul>
						</div>
					</div>
					<input type="hidden" name="enroll_county" id="enroll_county" data-parsley-trigger="blur" data-parsley-required data-parsley-error-message="Please select your county" />
				</div>
				<!-- ZIP -->
				<div class="form-field">
					<label for="gc_code">Zip Code *</label>
					<div class="field-wrapper">
						<input type="text" name="zip" id="zip" placeholder="Zip Code *" data-parsley-trigger="blur" data-parsley-required="your zip" data-parsley-has-special-characters/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				</div>
			</fieldset>
			<fieldset class="enrollment_fieldset">
				<!-- Phone Number -->
				<div class="form-field">
					<label for="gc_code">Phone Number *</label>
					<div class="field-wrapper">
						<input type="text" name="phone" id="phone" placeholder="Phone Number *" data-parsley-trigger="blur" data-parsley-required  maxlength="14" data-parsley-error-message="Please enter a valid phone number"/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				</div>
				<!-- Mobile Number -->
				<div class="form-field">
					<label for="gc_code">Mobile Number</label>
					<div class="field-wrapper">
						<input type="text" name="mobile" id="mobile" placeholder="Mobile Number" data-parsley-trigger="blur" maxlength="14" data-parsley-error-message="Please enter a valid phone number"/>
						<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						<i class="fa fa-check" aria-hidden="true"></i>
					</div>
				</div>
			</fieldset>
			<div class="enroll_checkboxes">
				<!-- is 21 -->
				<div class="form-field checkbox-field">
					<input class="enroll_checkbox" name="21_older_farmer" type="checkbox" value="21_older_farmer" id="21_older_farmer" />
					<label id="21_label" for="21_older_farmer">I am 21 or older and actively farming a minimum of 250 acres or more.</label>
					<p class="checkbox_error">This is required</p>
				</div>
				<!-- eligible -->
				<div class="form-field checkbox-field">
					<input  class="enroll_checkbox" name="eligible_to_join" type="checkbox" value="eligible_to_join" id="eligible_to_join" />
					<label id="eligible_label" for="eligible_to_join">I am eligible to participate in America's Famers Grow Communities and agree to comply with the <a class="communities" href="program-rules">official rules.</a></label>
					<p class="checkbox_error">This is required</p>
				</div>
				<!-- Updates -->
				<!-- <div class="form-field checkbox-field">
					<input class="enroll_checkbox" name="updates" type="checkbox" value="updates" id="updates" />
					<label for="updates">I would like to keep in touch and receive program updates from America's Farmers.</label>
				</div> -->

			</div>
			<div class="submit_wrapper">
				<button class="enroll_submit" type="submit">Submit</button>
			</div>
		</form>
		<div class="loading_spinner" id="enrollment_submission_spinner">
			<div class="lds-ring"><div></div><div></div><div></div><div></div></div>
		</div>

	</div>
	<div class="submission_success_message">
		<h2>WE'VE GOT YOUR SUBMISSION</h2>
		<h3>Thank you for enrolling to make an impact in your community through America's Farmers Grow Communities.</h3>
		<p>Sign up to receive text updates on all 3 of the America's Farmers programs.</p>
		<p>Text <b>"AMERICAS FARMERS"</b> to <b>555888</b> to sign up for alerts from America's Farmers.</p>
		<p class="text_message_terms"><a href="/privacy-policy" class="communities">Terms & Conditions and Privacy Policy</a>. You may receive up to 3msgs/month. Message and data rates may apply. Reply STOP to end or HELP for help.</p>
		<h5>Follow us on social media for more updates</h5>
		<ul class="social-icons">
			<li>
				<a href="<?php the_field('facebook_link', 'option')?>" target="_blank" class="social_facebook"><i class="fa fa-facebook"></i></a>
			</li>
			<li>
				<a href="<?php the_field('twitter_link', 'option')?>" target="_blank" class="social_twitter"><i class="fa fa-twitter"></i></a>
			</li>
			<li>
				<a href="<?php the_field('instagram_link', 'option')?>" target="_blank" class="social_instagram"><i class="fa fa-instagram"></i></a>
			</li>
			<li>
				<a href="<?php the_field('youtube_link', 'option')?>" target="_blank" class="social_youtube"><i class="fa fa-youtube-play"></i></a>
			</li>
		</ul>
	</div>
	<div class="submission_fail_message">
		<h2>WHOOPS!</h2>
		<h3>Looks like we were unable to process the submission.</h3>
		<h5>Refresh the page and give it another try.</h5>
	</div>
</div>
<?php endif; ?>
