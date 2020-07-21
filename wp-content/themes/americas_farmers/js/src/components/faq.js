//Stuff for the FAQs goes here
(function($) {
  function toggleAttr() {
    if ($('.faq-single').hasClass('active')) {
      $('.faq-answer').attr('aria-hidden', false);
    } else {
      $('.faq-answer').attr('aria-hidden', true);
    }
  }
  function toggleFAQ() {
		$(this).parent().toggleClass('active');
		$(this).parent().find(".faq-answer").slideToggle();
		$(this).parent().siblings().find(".faq-answer").slideUp();
		$(this).parent().siblings().removeClass('active');
    toggleAttr();
		return false;
  }
  $('.faq-answer').hide();
  $('.faq-question').on('click', toggleFAQ);
})(jQuery);
