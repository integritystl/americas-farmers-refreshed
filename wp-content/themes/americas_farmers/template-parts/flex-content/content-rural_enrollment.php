<?php
/**
*
* Gets the ACF from the program and adds it to the page where this field is selected!
*
**/

?>

 
<?php 
$program = get_sub_field('enroll_program');


if (! $program || $program->post_title == 'Grow Ag Leaders') {
  get_template_part( 'template-parts/content', 'enroll_ag_leaders' );
} elseif (! $program || $program->post_title == 'Grow Communities') {
  get_template_part( 'template-parts/content', 'grow_communities_enrollment' );
} else {
  get_template_part( 'template-parts/content', 'grow_rural_enrollment' );
}

?>