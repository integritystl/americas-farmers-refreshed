<?php
/**
*
* Component for the image callout. Includes background image, body copy, headline and accent arrow.
*
**/
$imgCalloutImage = get_sub_field('image_callout_background_image'); // Image Callout Background Image array
$imgCalloutContent = get_sub_field('image_callout_content'); // Image Callout Content Block
$imgCalloutHeadline = get_sub_field('image_callout_headline'); // Image Callout Headline Block
$imgCalloutArrow = get_sub_field('image_callout_arrow');
?>

<div class="image_callout flex-content-section" style="background-image:url('<?php echo $imgCalloutImage; ?>');">
	<img class="mobile-img" src="<?php echo $imgCalloutImage; ?>">
	<div class="container">
		<div class="image_callout_content">
			<?php echo $imgCalloutContent; ?>
		</div>
	</div>
</div>
