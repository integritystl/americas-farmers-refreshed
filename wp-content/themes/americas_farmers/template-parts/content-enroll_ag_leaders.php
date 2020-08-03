<?php
$program = get_sub_field('enroll_program');
//What's the relevant key for that program?
//What phase is that program in?
$currentPhase = getProgramPhase($program);

if(in_array('enroll', $currentPhase)):

$thankYouLink = get_field('thank_you_page', $program);
$agLink = get_field('grow_ag_enrollment_link', $program);
$agUrl = $agLink['url'];
$agImg = get_field('gro_ag_img', $program)


?>

<div class="enroll_ag_leaders container">
	<div class="grow-ag-wrapper">
		<div class="image">
			<img src="<?php echo $agImg; ?>" />	
		</div>
		<div class="content-wrapper">
			<img class ="grow_ag_logo" src="<?php echo get_stylesheet_directory_uri() . "/imgs/AF_GAL.svg";?>" />
			<div class="grow_ag_content_interior">
				<h5>Nominate a School District</h5>
				<p>Nominate your school district for an opportunity to receive a grant to fuel STEM education.</p>
				<a class="ag_enroll_button button" href="<?php echo $agUrl;?>" target="_blank">Nominate Now</a>
			</div>
		</div>
	</div>
</div>
<?php endif;?>


