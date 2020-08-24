<?php
$heroBgImg = get_sub_field('background_image');
$heroBgImgSize = 'full';
$smallHeadline = get_sub_field('header_small_text');
$largeHeadline = get_sub_field('header_large_text');
?>

<div class="hero hero-download_callouts hero-striped">
  <div id="hero-img" class="hero-img-container" style="background: url('<?php the_sub_field('background_image') ?>')no-repeat center center;; background-size:cover;">
    <div class="hero-content-container">
      <?php if (have_rows('striped_header')) { ?>
        <h1 class="hero-heading">
          <div class="row">
          <?php while(have_rows('striped_header')) : the_row();
            $caps = get_sub_field('all_caps');
            $lineBreak = get_sub_field('insert_line_break');
            $bgColor = get_sub_field('background_color');
            $heroHeadingClass = 'hero-stripe-text';

            //Check if text needs to be caps style or not
            if ($caps) {
              $heroHeadingClass .= ' hero-uppercase';
            }
            //Get classes for our bg colors
            if ( $lineBreak ) {
              $heroHeadingClass .= ' ' . 'line-break';
            }

          ?>
            <span class="<?php echo $heroHeadingClass; ?>"><?php the_sub_field('stripe_text'); ?></span>
          <?php endwhile; ?>
            </div>
        </h1>

      <?php }  ?>

    </div>
  </div>
</div>

<?php if (have_rows('download_items')) { ?>
  <ul class="callout-list">
     <?php while(have_rows('download_items')) : the_row();
       $programLogo = get_sub_field('program_logo');
       $fileDownload = get_sub_field('file_download');
       $programKey = get_sub_field('program_key'); ?>

       <?php if ($fileDownload) {  ?>
         <li class="callout-single">
            <a href="<?php echo $fileDownload; ?>"  download class="">
              <?php if ($programLogo) {  ?>
                 <img src="<?php echo $programLogo; ?>" class="program-logo" />
              <?php } ?>

               <?php if ($programKey) { ?>
                 <span class="button">Download </span>
               <?php }?>
            </a>
          </li>
       <?php } ?>
     <?php endwhile; ?>
   </ul>
<?php } ?>
