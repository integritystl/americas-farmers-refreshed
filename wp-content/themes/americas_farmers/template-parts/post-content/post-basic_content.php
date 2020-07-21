<?php
/**
*
* Component for adding a basic WizzyWig to Posts/Stories
*
**/
$fieldWidth = get_sub_field('post_content_layout');
?>
<div class="wysiwyg-wrapper">
  <div class="container wysiwyg <?php echo $fieldWidth; ?>">
    <?php the_sub_field('post_basic_content'); ?>
  </div>
</div>
