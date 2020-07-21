
 // Loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      var playerIsReady = false;
      function onYouTubeIframeAPIReady() {
        playerIsReady = true;
      }

(function($) {
  $(document).ready(function() {
      var player;
          var windowAspectWidth = 0;
          var videoAspectRatio = 16 / 9;
          var windowHeight = 0;
          var windowWidth = 0;
          var initialHeroHeight = 0;
          var $base = $('.hero-video');
      $('.play-video, .video-callout-play-video').click(function() {
          //Read the video id off element
          var videoID = $(this).attr('data-video-id');
          var videoElement = $(this);

          if ( $(this).hasClass('load-video') ) {
            //Skip creating the video and load it instead
          } else {
            //pass another param in here after ID for the target's class
            createVideoPlayer(videoID, videoElement);
          }
      })
      function createVideoPlayer(videoID, el){
        //Call different events functions and different iframe ID depending on if we clicked a Hero video or Video Callout
        var playEvents;
        var videoIframe;
        if (el.hasClass('play-video')) {
          var playEvents = {'onReady': HeroOnPlayerReady,'onStateChange': HeroOnPlayerStateChange};
          var videoIframe = 'iframe_video_player';
          $('.hero-content-container .play-video').addClass('hidden');
        } else if ( el.hasClass('video-callout-play-video') ) {
          var playEvents = { 'onReady': calloutOnPlayerReady,'onStateChange': calloutOnPlayerStateChange};
          var videoIframe = 'iframe_video_player_callouts';
        }
        //Jam in the YouTube player with event functions and video ID
        player = new YT.Player(videoIframe, {
            height: '390',
            width: '640',
            videoId: videoID,
            playerVars: { 'autoplay': 1, 'controls': 1, 'rel': 0},
            events: playEvents
        });
      }
      //If the video is open, we have a small close icon so people can close it
      $('.hero-content-container .iframe-close-button').click(function(){
        closeHeroVideo();
        player.pauseVideo();
        player.seekTo(0);
      });
      $('.my-town-video-callouts .iframe-close-button').click(function(){
        $('.my-town-video-callouts .video-wrapper').removeClass('active');
        player.pauseVideo();
        player.seekTo(0);
      });

      // The API will call these functions when the video player is ready.
      function HeroOnPlayerReady(event) {
        openHeroVideo();
        $('.hero-content-container .iframe-close-button').removeClass('hidden');
        findAspectRatio($('.hero-video'));
      }
      function calloutOnPlayerReady(event) {
        openCalloutVideo();
        $('.my-town-video-callouts .iframe-close-button').removeClass('hidden');
        findAspectRatio($('.my-town-video-callouts'));
      }

      //These functions are for when video state changes occur
      function calloutOnPlayerStateChange(event) {
        //Add Load Video class so we know when to load a video vs create a player
        $('.video-callout-play-video').addClass('load-video');
        $('.video-callout-play-video.load-video').click(function(){
          var nextVideoID = $(this).attr('data-video-id');
          openCalloutVideo();
          $('.my-town-video-callouts .iframe-close-button').removeClass('hidden');
          player.loadVideoById(nextVideoID);
        })
      }
      function HeroOnPlayerStateChange(event) {
        //Add Load Video class so we know when to load a video vs create a player
        $('.play-video').addClass('load-video');

        // When the Video's player's already been loaded, allow other videos to load in it via ID
        //Make sure that the Related Video thumbnail and text link are clickable
        $('.play-video.load-video, .related-link, .related-thumbnail').click(function(){
          var nextVideoID = $(this).attr('data-video-id');
          openHeroVideo();
          findAspectRatio($('.hero-video'));
          $('.iframe-close-button').removeClass('hidden');
          player.loadVideoById(nextVideoID);
        })

        //When the video ends in the Hero, we want to display the "Watch Again" btn and related videos, if any
        // and jam back in the Hero content as bg elements
        if (event.data === 0) {
          //Need to change play-video to be display: none to help with styling, but want to keep sweet transition,
          // so adding it inline here after video ends. Applies only to the Hero video, not the My Town callouts
          $('.hero-content-container .play-video').css('display', 'none');
          $('.hero-content-container .video-wrapper').removeClass('active');
          $('.watch-again-overlay').addClass('active');
          $('.hero-video').find('.hero-heading, .program-logo, .hero-img-container').removeClass('hidden');
          //The video's over so the Play Again should have a click function
          $('.play-video-again').click(function() {
            openHeroVideo();
            player.playVideo();
          })

        }
        //end Video Is Over Show Related/Watch Again
      }

      //Check if there's YouTube functionality accesible before doing resize function on window resize
      $(window).resize(function(){
        if ( typeof player === 'undefined' ) {
          //bail
          return;
        } else {
          // find video-wrapper and look for its parent, pass as our element for finding the ratio
          var videoParent = $('body').find('.video-wrapper').parent();
          findAspectRatio(videoParent);
        }
      });
    })

    function openHeroVideo() {
      $('.hero-video').find('.hero-heading, .program-logo, .hero-img-container').addClass('hidden');
      $('.hero-video').find('.video-wrapper').attr('aria-hidden', 'false');
      //probably should make the video visible
      $('.hero-content-container .video-wrapper').addClass('active');
    }

    function openCalloutVideo() {
      $('.my-town-video-callouts .video-wrapper').addClass('active');
    }

    function closeHeroVideo() {
      $('.hero-content-container .video-wrapper').removeClass('active');

        setTimeout(function(){
            $('.hero-video').find('.hero-heading, .program-logo, .hero-img-container, .play-video').removeClass('hidden');
            $('.hero-content-container .play-video').removeAttr('style');
            $('.hero-content-container .iframe-close-button').addClass('hidden');
            $('.hero, .hero-content-container').removeAttr('style');
            //If Watch Again section is visible, make it go away because we hit close
            if ( $('.watch-again-overlay').hasClass('active') ) {
              $('.watch-again-overlay').removeClass('active');
            }
        }, 500);
    }
    //Add a parameter to pass in for the base, either hero-video or my-town-callouts
    function findAspectRatio(el) {

        var adminBarHeight = $('#wpadminbar').height() || 0;
        var headerHeight = $('header').height();

        var $window = $(window);

        var windowHeight = $window.height() - (adminBarHeight + headerHeight);
        var windowWidth = $window.width();
        var windowAspectWidth = windowWidth / windowHeight;
        var videoAspectRatio = 16 / 9;

        if( windowAspectWidth < videoAspectRatio ) {
        // Portrait
        el.find('.video-wrapper').removeClass('landscape');
        el.find('.video-wrapper').addClass('portrait');

        if( $('.hero-content-container .video-wrapper').hasClass('active') ) {
            $('.hero, .hero-content-container').css({
                'min-height': 'calc(' + (windowWidth * 9) / 16 + 'px)',
                'max-height': 'calc(' + (windowWidth * 9) / 16 + 'px)',
                 'overflow': 'hidden'
            });
        }
        } else {
            // Landscape
            el.find('.video-wrapper').removeClass('portrait');
            el.find('.video-wrapper').addClass('landscape');

            if( $('.hero-content-container .video-wrapper').hasClass('active') ) {
                $('.hero, .hero-content-container').css({
                    'min-height': 'calc(' + windowHeight + 'px)',
                    'max-height': 'calc(' + windowHeight + 'px)'
                });
            }
        }
    }

    // Video modal
    $('.play-btn').click(function(){
      $(this).parent().next('.iframe-video').show();
      $(this).parent().next('.iframe-video').css('opacity', '1');
      $(this).parent().next('.iframe-video').next('.video-overlay').show();
    });
    
    $('.video-overlay').click(function(){
      $('.iframe-video').hide();
      $('.iframe-video').css('opacity', '0');
      $('.iframe-video iframe').attr('src', $('iframe').attr('src'));
      $(this).hide();
    });
    
    $('.iframe-video').find('i').click(function(){
      $(this).parent().hide();
      $(this).parent().css('opacity', '0');
      $(this).parent().next('.video-overlay').hide();
      $(this).parent().find('iframe').attr('src', $('iframe').attr('src'));
    });

})(jQuery);
