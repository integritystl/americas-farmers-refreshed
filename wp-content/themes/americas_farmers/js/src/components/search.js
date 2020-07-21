//Search modal + ajax searching
(function($) {
  let resultsContainer = $('.search-results');

  function toggleSearchModal() {
    $('#search-modal').toggleClass('search-open');
    $('body').toggleClass('scroll-locked');
  }
  function emptySearch() {
    $('.search-modal-input').removeAttr('value');
    resultsContainer.empty();
  }

  $('#search-trigger').on('click', function(){
    toggleSearchModal();
  });
  $('.close-search').on('click', function(){
    toggleSearchModal();
    $('body').removeClass('scroll-locked');
  });

  $(document).click(function(event) {
    //if you click on anything except the modal itself or the "open modal" link, close the modal
    if (!$(event.target).closest("#search-container,#search-trigger").length) {
      $("body").find("#search-modal").removeClass("search-open");
      $("body").removeClass("scroll-locked");
    }
  });

  $('#search-clear').on('click', function(){
    emptySearch();
  });


  $(document).ready(function(){

    function load_search_results(search){
      var data = {
        search: search,
      }

      $.ajax({
        url: wpAjax.api_url + 'search_modal/',
        type: "GET",
        dataType: "html",
        data: data,
        cache: false,
        beforeSend: function(xhr){
          xhr.setRequestHeader( 'X-WP-Nonce', wpAjax.api_nonce );
          //current site doesn't have a loading animation, we should probably add one?
          $('.loading_spinner').addClass('active');
        },
        success : function( response ) {
          resultsContainer.empty();
          resultsContainer.append(response);
        },
        fail : function( response ) {
          console.log('fail!');
          console.log(response);
        },
        complete : function(){
          $('.loading_spinner').removeClass('active');
        }
      });
    }

    //Make sure we're only ajax searching when user is done typing
    var timeout = 0;
    $('.search-modal-input').on('keyup', function(e){

      clearTimeout(timeout);

      timeout = setTimeout(function(){
       load_search_results($('.search-modal-input').val());
      }, 500);
    });



  });

})(jQuery);
