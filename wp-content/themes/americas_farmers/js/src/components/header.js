//Stuff for the Header goes here
//Stuff for the FAQs goes here
(function($) {

//Expand Collapse Logic for sub-menu!!


function toggleAttr() {
    if ($('.menu-item-has-children a').hasClass('active')) {
        $('.sub-menu').attr('aria-hidden', false);
    } else {
        $('.sub-menu').attr('aria-hidden', true);
    }
}
function toggleExpandCollapse() {
  $(this).toggleClass('open');
  $(this).children().toggleClass('active');

  $(this).children('.sub-menu').slideToggle().stopPropagation();
  toggleAttr();
  return false;
}
$('.sub-menu').hide();
$('.menu-item-has-children').on('click', toggleExpandCollapse);

// Open Grow AG Leaders Flyer PDF in new window
$(document).ready(function() {
  $('.page-item-279 a').attr('target', '_blank');
  $('.menu-item-466 a').attr('target', '_blank');
});
  
//Expand Collapse Logic for Mobile Menu!!

  function toggleAttr() {
      if ($('#mobile-menu-toggle').hasClass('active')) {
          $('.mobile-nav').attr('aria-hidden', false);
      } else {
          $('.mobile-nav').attr('aria-hidden', true);
      }
  }
  function toggleMenuExpandCollapse() {
    $(this).toggleClass('active');
    $(".mobile-nav").slideToggle('slow');
    toggleAttr();
    return false;
  }
  $('.mobile-nav').hide();
  $('.mobile-nav .current-menu-parent').addClass('open');
  $('.mobile-nav .current-menu-parent .sub-menu').css({ display: "block" });
  $('#mobile-menu-toggle').on('click', toggleMenuExpandCollapse);


    

})(jQuery);
