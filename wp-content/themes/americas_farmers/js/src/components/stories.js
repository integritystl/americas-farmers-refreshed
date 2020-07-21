//Blog/Stories list view ajax loading
(function($) {
  let resultsContainer = $('#post-results');
  let pageNumber = 1;

  function load_blog_list(filter, page){
    if(page === null || page === undefined){page = 1;}
    pageNumber = page;
  
    var data = {
      filter: filter,
      page: pageNumber,
    }

    $.ajax({
      url: wpAjax.api_url + 'post_list/',
      type: "GET",
      dataType: "html",
      data: data,
      cache: false,
      beforeSend: function(xhr){
        xhr.setRequestHeader( 'X-WP-Nonce', wpAjax.api_nonce );
        $('.loading_spinner').addClass('active');
      },
      success : function( response ) {
        resultsContainer.append(response);
        if ( $(response).filter('.no-results').length) {
          $('#load-more-posts').addClass('hidden');
        } else {
          $('#load-more-posts').removeClass('hidden');
        }
        pageNumber++;
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

  $(document).ready(function(){
    var filter = window.location.search;
    if (filter) {
      if (filter === '?category=grow-communities') {
        $('.post-tags select option[value="grow-communities"]').prop("selected", true);
      } else if (filter === '?category=grow-rural-education') {
        $('.post-tags select option[value="grow-rural-education"]').prop("selected", true);
      } else if (filter === '?category=grow-ag-leaders') {
        $('.post-tags select option[value="grow-ag-leaders"]').prop("selected", true);
      }
      var selected_taxonomy = jQuery(this).find('option:selected').attr("value");
      resultsContainer.empty();
      load_blog_list(selected_taxonomy, 1);
      $('#load-more-posts').data('filter', selected_taxonomy);
    } else {
      //load all posts on initial load
      load_blog_list('all', pageNumber);
    }
  });

  $('.post-tags select').on('change', function(event) {
    // Get tag slug from title attirbute
    var selected_taxonomy = jQuery(this).find('option:selected').attr("value");
    resultsContainer.empty();
    load_blog_list(selected_taxonomy, 1);
    $('#load-more-posts').data('filter', selected_taxonomy);
  });

  $('#load-more-posts').on('click', function(){
    var postCurrentFilter = $(this).data('filter');
    load_blog_list(postCurrentFilter, pageNumber);
  });
})(jQuery);
