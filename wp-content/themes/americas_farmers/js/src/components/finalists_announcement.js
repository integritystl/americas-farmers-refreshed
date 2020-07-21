jQuery(document).ready(function ($) {

  //Handle opening and closing the select options
  $('.finalists_state_select_top').click(function () {
    $('.finalists_state_select_bottom').toggleClass('active');

    toggleFinalistsChevron();
  })
  $(window).click(function (e) {
    if (!e.target.classList.contains('finalists_state_select_top') && e.target.id !== 'finalists_state_nicename' && e.target.id !== 'finalists_chevron' && $('.finalists_state_select_bottom').hasClass('active')) {
      $('.finalists_state_select_bottom').removeClass('active');
      if ($('#finalists_chevron').hasClass('fa-chevron-up')) {
        $('#finalists_chevron').removeClass('fa-chevron-up').addClass('fa-chevron-down');
      }
    }
  })


  //Handle making a selection
  $('.finalists_state_option').click(function () {
    //Turn the loading spinner on
    $('.loading_spinner').addClass('active');
    toggleFinalistsChevron();
    //Wipe out any results we are already showing
    $('#finalists_container').html('');
    //Grab the data we need
    var stateValue = $(this).attr('data-value');
    var niceName = $(this).attr('data-nicename');

    //Pop that data into the dropdown so you see your selection
    $('#finalists_state_nicename').html(niceName);
    $('.finalists_state_select_bottom').removeClass('active');

    var programkey = $('#announce_finalists').attr('data-program');

    var targetUrl = wpAjax.ajaxurl + '?action=get_finalists&state=' + stateValue + '&program=' + programkey;
    //fire off that ajax request
    $.ajax(targetUrl, {
      'method': 'GET'
    })
      .done(function (data) {
        //Kill the loading spinner
        $('.loading_spinner').removeClass('active');
        var returnData = JSON.parse(data.data);

        //Sort data by county
        if (returnData === undefined || returnData.length == 0) {
          var display = "<p class='announce_finalists_blurb'>Unfortunately there are no finalists for your state. The grant program opens again January 1, 2021. Tell a farmer to nominate a school in your area at <a href='http://www.AmericasFarmers.com'>www.AmericasFarmers.com</a>.</p>";
          $('#finalists_container').append(display);
        } else {
          var sortedData = returnData.sort(function (a, b) {
            if (a.county < b.county) return -1;
            else return 1;
          })
          
          for(let i=0; i<sortedData.length; i++){
            let node = '<div class="finalist_item">';
            node +=       '<div class="finalist_item_top">';
            node +=         '<h5>' + sortedData[i].district + '</h5>';
            node +=         '<span>' + sortedData[i].county + '</span>';
            node +=       '</div>';
            node +=   '</div>';

            $('#finalists_container').append(node);
          }

          //use timeout to wait for append to complete because i'm too lazy to keep looking for a way around this
          setTimeout(function(){
            let timing = 0;
            let topHeight = 0;
            //for each item add the pop-in class after a delay, increment that delay for each item to get cascade effect
            //120 is arbitrary but looks nice
            $('.finalist_item').each(function () {
              setTimeout(addPopIn, timing, this)
              let itemTop = $(this).find('.finalist_item_top')
              if (itemTop.height() > topHeight){
                topHeight = itemTop.height();
              }
              timing += 120
            })
            $('.finalist_item_top').height(topHeight);
          }, 120)
        }
      })
      .fail(function (data) {
        console.log(data);
        $('.finalist_error').addClass('active');
        $('.loading_spinner').removeClass('active');
      })
  })

  function addPopIn(item) {
    $(item).addClass('pop-in');
    sizeWinnerCards();
  }

  function toggleFinalistsChevron(){
    if ($('#finalists_chevron').hasClass('fa-chevron-up')) {
      $('#finalists_chevron').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    } else {
      $('#finalists_chevron').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    }
  }

  //Make the cards equal height
  function sizeWinnerCards() {
    var height = 0;
    $('.winner_item_top').each(function () {
      if ($(this).height() > height) {
        height = $(this).height();
      }
    })
    $('.winner_item_top').height(height);
  }

});
