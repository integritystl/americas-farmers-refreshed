<?php
/**
*
* Component for the Video 50/50.
*
**/

//Added this because we USUALLY need it. Want it as a quick get if we do
// $alignText = get_sub_field('align_text');
$video = get_sub_field('video_iframe');
$title = get_sub_field('video_title');
$content = get_sub_field('video_content_wysiwyg');

?>

<div class="flex-content flex_video-content">
	<div class="container">
		<div class="video-column">
			<div class="video-container">
				<?php echo $video ?>
			</div>
		</div>
		<div class="video-content">
			<h3><?php echo $title ?></h3>
			<?php echo $content ?>
		</div>
	</div>
</div>
