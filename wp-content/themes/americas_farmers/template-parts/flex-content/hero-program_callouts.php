<?php
$heroBgImg = get_sub_field('background_image');
$heroBgImgSize = 'full';
$firstHeadline = get_sub_field('header_text_line_one');
$secondHeadline = get_sub_field('header_text_line_two');
$thirdHeadline = get_sub_field('header_text_line_three');
?>

<div class="hero hero-program_callouts">
  <div class="overlay"></div>
  <div id="hero-img" class="hero-img-container" style="background-image: url('<?php echo $heroBgImg; ?>');">
  </div>
  <div class="hero-content-container">

    <?php if ($firstHeadline || $secondHeadline || $thirdHeadline) { ?>
      <h1 class="heading-container">
        <span class="small-headline"><?php echo $firstHeadline; ?></span>
        <span class="large-headline"><?php echo $secondHeadline; ?></span>
        <span class="small-headline"><?php echo $thirdHeadline; ?></span>
      </h1>
    <?php }

     if (have_rows('program_items')) { ?>
       <ul class="callout-list">
          <?php while(have_rows('program_items')) : the_row();
            $programLogo = get_sub_field('logo');
            $programKey = get_sub_field('program_key');
            $numberBtn = get_sub_field('button_number');
            $btnSubText = get_sub_field('button_text');
            $detailHeadline1 = get_sub_field('number_details');
            $detailHeadline2 = get_sub_field('number_details_headline');
            $detailBody = get_sub_field('details_content');

            if ($programKey == 'communities' ) {
              $classColor = 'communities';
            }
            if ($programKey == 'rural' ) {
              $classColor = 'rural';
            }
            if ($programKey == 'leaders' ) {
              $classColor = 'leaders';
            } ?>

              <li class="card <?php echo $classColor ?>">
                 <div class="card-content">
                   <?php if ($programLogo) {  ?>
                      <img src="<?php echo $programLogo; ?>" class="program-logo" />
                   <?php } ?>
                   <?php if ($numberBtn) {  ?>
                     <span class="btn-number"><?php echo $numberBtn ?></span>
                   <?php } ?>
                   <?php if ($btnSubText) {  ?>
                     <span class="btn-subtext"><?php echo $btnSubText ?></span>
                   <?php } ?>

                    <svg class="arrow-right" width="24px" height="23px" viewBox="0 0 24 23" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title>Right Arrow</title>
                        <g id="style-guide" stroke-width="1" stroke="#FFFFFF" fill="none" fill-rule="evenodd">
                            <g id="right_arrow_icon" transform="translate(11.000000, 10.000000) rotate(-90.000000) translate(-11.000000, -10.000000) translate(1.000000, -1.000000)" stroke-width="3.5">
                                <polyline id="Path-3-Copy" transform="translate(9.852051, 11.792965) rotate(-45.000000) translate(-9.852051, -11.792965) " points="2.82276368 4.97290862 2.82276368 18.613021 16.8813386 18.613021"></polyline>
                                <path d="M9.5,0.5 C9.5,7.51042845 9.5,12.0934363 9.5,14.2490234 C9.5,18.1222235 9.5,20.0588235 9.5,20.0588235" id="Path-2"></path>
                            </g>
                        </g>
                    </svg>
                 </div>
                 <div class="card-expanded">
                   <div class="card-expanded_left">
                     <?php if ($detailHeadline1) {  ?>
                       <span class="left-headline1"><?php echo $detailHeadline1 ?></span>
                     <?php } ?>
                     <?php if ($detailHeadline2) {  ?>
                       <span class="left-headline2"><?php echo $detailHeadline2 ?></span>
                     <?php } ?>
                   </div>
                   <div class="card-expanded_right">
                     <?php if ($detailBody) {  ?>
                       <p class="right-content"><?php echo $detailBody ?></span>
                     <?php } ?>
                   </div>
                   <span class="close"><img src="<?php echo get_stylesheet_directory_uri(); ?>/imgs/close-white.svg"></span>
                 </div>
             </li>

         <?php endwhile; ?>
        </ul>
    <?php } ?>
  </div>
</div>
