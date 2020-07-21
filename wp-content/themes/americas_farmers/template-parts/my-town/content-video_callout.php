<?php
/**
*
* Component for making callouts that open a YouTube video in a modal.
*
*
**/


?>

<div class="my-town-video-callouts">
  <div class="video-wrapper" aria-hidden="true">
    <div class="overlay"></div>
    <div class="inner">

      <div class="iframe-close-button hidden" aria-label="Close Video">
          <span class="icon close white"></span>
      </div>

      <div class="iframe-wrapper">
        <div id="iframe_video_player_callouts" role="iframe"></div>
      </div>

    </div>
  </div>
  <div class="video-grid-wrapper container">
    <?php if (have_rows('video_callouts')) : ?>
      <ul class="videos">
        <?php while( have_rows('video_callouts') ) : the_row();
          $videoCalloutURL = get_sub_field('video_callout_url');
          $videoCalloutYID = substr($videoCalloutURL, 17 );  //URL format should be: https://youtu.be/youtube-id
          $videoCalloutImgID =  get_sub_field('video_callout_img');
          $videoCalloutImg = wp_get_attachment_image_src( $videoCalloutImgID, 'full' );
        ?>
          <li class="video" data-video-id="<?php echo $videoCalloutYID; ?>">
            <div class="video-preview video-callout-play-video" style="background-image: url(<?php echo $videoCalloutImg[0]; ?>);" data-video-id="<?php echo $videoCalloutYID; ?>"></div>
            <p class="title video-callout-play-video" data-video-id="<?php echo $videoCalloutYID; ?>"><?php the_sub_field('video_callout_title'); ?></p>
            <p class="caption"><?php the_sub_field('video_callout_caption'); ?></p>
            <a class="video-callout-play-video special-link no-arrow" data-video-id="<?php echo $videoCalloutYID; ?>">Play</a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>
