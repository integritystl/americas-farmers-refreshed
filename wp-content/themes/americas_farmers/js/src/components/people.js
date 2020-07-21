//toggle for people
(function($) {

    var showChar = 135;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Read more";
    var lesstext = "Read less";

  $('.people-text-content').each(function() {
        var content = $(this).html();

        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="showmore"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink button">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function(){

        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });


})(jQuery);
