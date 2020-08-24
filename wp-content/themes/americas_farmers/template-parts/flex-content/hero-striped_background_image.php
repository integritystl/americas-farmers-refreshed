<?php
$heroBgImg = get_sub_field('background_image');
$heroBgImgSize = 'full';

$heroVideo = get_sub_field('video');
$caption = get_sub_field('caption');

?>
<div class="hero hero-striped <?php if ($heroVideo) { echo 'hero-video'; } ?>">
  <?php if ($caption){
  ?>
    <div class="hero-striped-caption">
      <p><?php echo $caption; ?></p>
    </div>
  <?php
  }
  ?>

  <div id="hero-img" class="hero-img-container" style="background: url('<?php the_sub_field('background_image') ?>')no-repeat center center; background-size:cover;">

  <div class="hero-content-container">
    <?php if (get_sub_field('small_logo') ) {  ?>
        <div class="program-logo">
          <img src="<?php the_sub_field('small_logo'); ?>" />
        </div>
    <?php } ?>

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

    <?php } ?>


      <?php if ($heroVideo) {
        //Get the ID of videos from the URL so we can jam it into the iFrame in the markup.
        //Also used to jam into a data-video-id to swap videos out of iFrame if there's Related Videos
        //URL format should be: https://youtu.be/youtube-id
        $heroVideoYID = substr($heroVideo, 17 );

        ?>

        <div class="play-vid" data-video-id="<?php echo $heroVideoYID; ?>">
          <button class="play-btn no-arrow" aria-label="Play Video">

            <svg id="playIcon" data-name="playIcon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46.2 53.33">
              <defs>
                  <style>
                      .play {
                          fill: #F8F7F6;
                      }
                  </style>
              </defs>
              <title>Play Icon</title>
              <polygon class="play" points="0 53.33 46.2 26.67 0 0 0 53.33" />
            </svg>
          </button>
          <span class="play-text" aria-hidden="true">Play Video</span>
        </div>

        <div id="media-iframe" class="iframe-video" style="opacity: 0; display: none;">
          <i class="far fa-times"></i>
          <div class="iframe-wrapper">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $heroVideoYID; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          </div>

        </div>
        <div class="video-overlay" style="display: none;"></div>

      <?php } ?>

  </div>
</div>
</div>
<?php if ( get_sub_field('program_button_id') && get_sub_field('program_button_text') ) { ?>
  <div class="hero-button-container">
    <a id="hero_smooth_scroll_button" href="#<?php the_sub_field('program_button_id');?>" class="button cta-scroll"> <?php echo get_sub_field('program_button_text');?></a>
  </div>
<?php } ?>
