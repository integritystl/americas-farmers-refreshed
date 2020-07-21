<?php
/**
*
* Component for adding a full-width color box of Content. Colors are based on what Program the Post is associated with
*
**/
$fullWidthProgramLogo = get_sub_field('program_logo');
$programLogoSize = 'full';
$fullWidthProgramLink = get_sub_field('program_link');
$fullWidthBackgroundColor = get_sub_field('background_color');

$fullWidthContent = get_sub_field('post_full_width_color_content');
$fullWidthBtnLabel = get_sub_field('button_label');
$fullWidthBtnLink = get_sub_field('button_link');
?>
<?php if ($fullWidthProgramLogo) : ?>
  <div class="post-color-block with-logo <?php echo $fullWidthBackgroundColor; ?>">
<?php else : ?>
  <div class="post-color-block <?php echo $fullWidthBackgroundColor; ?>">
<?php endif; ?>
    <div class="container">
      <?php if ($fullWidthProgramLogo) : ?>
        <a href="<?php echo $fullWidthProgramLink;?>" aria-label="<?php the_title(); ?>" class="post-color-block_image"><?php echo wp_get_attachment_image( $fullWidthProgramLogo, $programLogoSize );?></a>
      <?php endif; ?>

      <div class="post-color-block_content">
        <?php if ($fullWidthContent) : ?>
          <p><?php echo $fullWidthContent; ?></p>
        <?php endif; ?>

        <?php if ($fullWidthBtnLabel || $fullWidthBtnLink) : ?>
          <a href="<?php echo $fullWidthBtnLink; ?>" class="button"><?php echo $fullWidthBtnLabel; ?></a>
        <?php endif; ?>
      </div>
    </div>
  </div>
