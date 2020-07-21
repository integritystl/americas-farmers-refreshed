<?php
/**
*
* Simple component which spans the entire width of the page and allows for a WYSIWYG field.
*
*
**/

$field = get_sub_field('content_layout');
?>

<div class="wysiwyg-wrapper">

	<div class="wysiwyg flex-content-section  <?php echo $field; ?>">
		<?php
			the_sub_field('content');
		?>
	</div>

</div>
