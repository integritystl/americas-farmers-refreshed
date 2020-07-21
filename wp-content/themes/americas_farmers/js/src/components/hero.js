//Any Hero Unit JS goes here

// Get some responsive background images from the srcset attribute of an <img>
// Requires the <img to be a child of a <div> with a 'data-responsive-background-image' attribute set.
// Ref: https://aclaes.com/responsive-background-images-with-srcset-and-sizes/
class ResponsiveBackgroundImage {

    constructor(element) {
        this.element = element;
        this.img = element.querySelector('img');
        this.src = '';

        this.img.addEventListener('load', () => {
            this.update();
        });

        if (this.img.complete) {
            this.update();
        }
    }

    update() {
        let src = typeof this.img.currentSrc !== 'undefined' ? this.img.currentSrc : this.img.src;
        if (this.src !== src) {
            this.src = src;
            this.element.style.backgroundImage = 'url("' + this.src + '")';
        }
    }
}

let elements = document.querySelectorAll('[data-responsive-background-image]');
for (let i=0; i<elements.length; i++) {
  new ResponsiveBackgroundImage(elements[i]);
}

//Hero with Program Callouts
jQuery(document).ready(function( $ ) {
  $('.line-break').parent().removeClass('row');
  $('.line-break').nextAll('span').wrapAll('<div class="row" />');
  $('.line-break').prevAll('span').andSelf().wrapAll('<div class="row" />');



  $('.card-content').click(function(){
    $(this).parent(".card").addClass('active');

    if ($(window).width() > 800){
  		$(this).parent(".card").siblings().addClass('inactive');
      $('.card-expanded').attr('aria-hidden', true);
      $('.overlay').css("opacity", ".5");
  	}
    return false;
  });

  $('.card-expanded > .close').click(function(){
    $(this).parents(".card").removeClass('active');

    if ($(window).width() > 800){
  		$(this).parents(".card").siblings().removeClass('inactive');
      $('.card-expanded').attr('aria-hidden', false);
      $('.overlay').css("opacity", "0");
  	}
    return false;
  });

});

//Hot smoothscroll in header
jQuery(document).ready(function( $ ) {
  $('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
      &&
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top - 100
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
});
