jQuery(document).ready(function( $ ) {
	$('.winners_total').hide();


	//Handle opening and closing the select options
	$('.winners_state_select_top').click(function(){
		$('.winners_state_select_bottom').toggleClass('active');

		if($('#winners_chevron').hasClass('fa-chevron-up')){
			$('#winners_chevron').removeClass('fa-chevron-up').addClass('fa-chevron-down');
		} else {
			$('#winners_chevron').removeClass('fa-chevron-down').addClass('fa-chevron-up');
		}
	})
	$(window).click(function (e) {
		if (!e.target.classList.contains('winners_state_select_top') && e.target.id !== 'winners_state_nicename' && e.target.id !== 'winners_chevron' && $('.winners_state_select_bottom').hasClass('active')) {
			$('.winners_state_select_bottom').removeClass('active');
			if($('#winners_chevron').hasClass('fa-chevron-up')){
				$('#winners_chevron').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			}
		}
	})


	//Handle making a selection
	$('.winners_state_option').click(function(){
		//Turn the loading spinner on
		$('.loading_spinner').addClass('active');
		if($('#winners_chevron').hasClass('fa-chevron-up')){
			$('#winners_chevron').removeClass('fa-chevron-up').addClass('fa-chevron-down');
		} else {
			$('#winners_chevron').removeClass('fa-chevron-down').addClass('fa-chevron-up');
		}
		//Wipe out any results we are already showing
		$('#winners_container').html('');
		//Grab the data we need
		var stateValue = $(this).attr('data-value');
		var niceName = $(this).attr('data-nicename');

		//Pop that data into the dropdown so you see your selection
		$('#winners_state_nicename').html(niceName);
		$('.winners_state_select_bottom').removeClass('active');
		$('.winners_total').hide();

		var programkey = $('#announce_winners').attr('data-program');
		var programString = '';
		switch(programkey){
			case 'communities':
				programString = 'GrowCommunities';
				break;
			case 'rural':
				programString = 'GrowRuralEducation';
				break;
			case 'leaders':
				programString = 'GrowAgLeaders';
				break;
			default:
				programString = '';
		}

		var programYear = $('#announce_winners .winners_year').data('program-year');

		var targetUrl = wpAjax.ajaxurl + '?action=get_winners&state='+stateValue+'&program='+programString+'&year='+programYear;
		if (programkey === 'leaders') {
			targetUrl = wpAjax.ajaxurl + '?action=get_gal_winners&state='+stateValue;
		}
		//fire off that ajax request
		$.ajax(targetUrl, {
			'method': 'GET'
		})
		.done(function(data){
			//Kill the loading spinner
			$('.winner_error').removeClass('active');
			$('.loading_spinner').removeClass('active');

			$('.winners_total').show();


			if(programkey == 'leaders'){
				$('#winners_container').append(data);
				sizeWinnerCards();
				bindWinnerToggle();
				$('.winner_item').addClass('pop-in');
			} else {
				var returnData = JSON.parse(data.data);

				//Sort data by county
				if(returnData === null || returnData[0].error && programkey == 'communities'){
					var display = "<p class='no_winners_blurb'>Unfortunately there are no winners for your state. The program opens again August 1, 2020. Tell a farmer to enroll at <a href='http://www.AmericasFarmers.com'>www.AmericasFarmers.com</a>.</p>";
					$('#winners_container').append(display);
					$('.winners_total').hide();
					return;
				} else if(returnData === null || returnData[0].error && programkey == 'rural'){
					var display = "<p class='no_winners_blurb'>Unfortunately there are no winners for your state. The grant program opens again January 1, 2021. Tell a farmer to nominate a school in your area at <a href='http://www.AmericasFarmers.com'>www.AmericasFarmers.com</a>.</p>";
					$('#winners_container').append(display);
					$('.winners_total').hide();
					return;
				}

				if(programkey == 'communities'){
					var sortedData = returnData.sort(function(a, b){
						var x = a.CampaignMember.County__c;
						var y = b.CampaignMember.County__c;
						if(x < y) return -1;
						else return 1;
					})
					var count = 0;
					var totalCount = sortedData.length;

					growCommunitiesDisplay(sortedData, count, totalCount);
				}
				if(programkey == 'rural'){
					var sortedData = returnData.sort(function(a, b){
						var x = a.School_Application__c.School__r.Name;
						var y = b.School_Application__c.School__r.Name;
						if(x < y) return -1;
						else return 1;
					})
					var count = 0;
					var totalCount = sortedData.length;
					growRuralEducationDisplay(sortedData, count, totalCount);
				}


			}
		})
		.fail(function(data) {
			console.log(data);
			$('.winner_error').addClass('active');
			$('.loading_spinner').removeClass('active');
		})
	})

	function growRuralEducationDisplay(sortedData, i, total){
		//Add this class, it's here so that it gets delayed and thus causes a cascading animation
		$('.winner_item').addClass('pop-in');
			sizeWinnerCards();
		$('.winners_total span').text(total + ' results');
		//If we have incremented above our total, just bail
		if(i >= total){
			bindWinnerToggle()
			return;
		}
		//Build the node we add
		var node = "<div class='winner_item'><div class='winner_item_top'><h5>" +
					sortedData[i].School_Application__c.School__r.Name +"</h5>" +
					"<span>"+sortedData[i].School_Application__c.School__r.Location_City__c+", "+sortedData[i].School_Application__c.School__r.Location_State__c+"</span>";
		if(sortedData[i].School_Application__c.Project_Title__c){
			var date = new Date(sortedData[i].School_Application__c.Presentation.DateTime);

			node += "<i class='winners_internal_chevron fal fa-arrow-down' aria-hidden='true'></i></div>" +
			"<div class='winner_item_bottom'>" +
			"<p>" + sortedData[i].School_Application__c.Project_Title__c + "</p>" +
			"<p>$" + (sortedData[i].School_Application__c.Grant_Amount__c ? Number(Number(sortedData[i].School_Application__c.Grant_Amount__c).toFixed(2)).toLocaleString() : '') + "</p>";


			node += "</div>";
		}
		else {

			node += "</div></div>";
		}
		//add the node
		$('#winners_container').append(node);
		//increment so we can go to the next item and set a timeout so we
		//can delay adding them to make them cascade in
		i++;

		setTimeout(function(){
			growRuralEducationDisplay(sortedData, i, total);
		}, 120);


					if ($('.winner_item').children('.winner_item_bottom').length > 0) {
						$('.winner_item').addClass('has-arrow');
					} else {
						$('.winner_item').addClass('no-arrow');
					}


	}

	function growAgLeadersDisplay(sortedData, i, total){
		//Add this class, it's here so that it gets delayed and thus causes a cascading animation
		$('.winner_item').addClass('pop-in');
		sizeWinnerCards();
		$('.winners_total span').text(total + ' results');
		//If we have incremented above our total, just bail
		if(i >= total){
			bindWinnerToggle()
			return;
		}
		//Build the node we add
		var node = "<div class='winner_item'><div class='winner_item_top'><h5>" + sortedData[i].Student__c.Student_First_Name__c + " " +
					sortedData[i].Student__c.Student_Last_Name__c +"</h5>" +
					"<span>" + sortedData[i].Student__c.Student_County__c  + ", " +
					sortedData[i].Student__c.Student_State__c + "</span><i class='winners_internal_chevron fal fa-arrow-down' aria-hidden='true'></i></div>";
		//If we have data for the bottom part, include it
		node += "<div class='winner_item_bottom'>"+
		"<h5>" + sortedData[i].Student__c.Major_Description__c + "</h5>"+
		"<p>" + sortedData[i].Student__c.College_Name__c + "</p>" +
		"</div>" + "</div>";
		//add the node
		$('#winners_container').append(node);
		//increment so we can go to the next item and set a timeout so we
		//can delay adding them to make them cascade in
		i++;

		setTimeout(function(){
			growAgLeadersDisplay(sortedData, i, total);
		}, 120);


					if ($('.winner_item').children('.winner_item_bottom').length > 0) {
						$('.winner_item').addClass('has-arrow');
					} else {
						$('.winner_item').addClass('no-arrow');
					}

	}

	//Handles displaying data for Grow Communities
	function growCommunitiesDisplay(sortedData, i, total){
		if (sortedData[0].error && sortedData[0].message == 'No records found with the search criteria') {
			var node = "<h2 class='no-winner'>Unfortunately there are no winners in your state.<br/>Please come back in August to enroll to make a difference in your community.</h2>"
			$('#winners_container').append(node);
		} else {
			//Add this class, it's here so that it gets delayed and thus causes a cascading animation
			$('.winner_item').addClass('pop-in');
			sizeWinnerCards();



			$('.winners_total span').text(total + ' results');
			//If we have incremented above our total, just bail
			if(i >= total){
				bindWinnerToggle()
				return;
			}
			//Build the node we add
			var node = "<div class='winner_item'><div class='winner_item_top'><h5>" +
				sortedData[i].CampaignMember.FirstName + " " +
				sortedData[i].CampaignMember.LastName + "</h5>" +
				"<span>" + sortedData[i].CampaignMember.County__c + ", " +
				sortedData[i].CampaignMember.State + "</span><i class='winners_internal_chevron fal fa-arrow-down' aria-hidden='true'></i></div></div>";

			//add the node
			$('#winners_container').append(node);


			if ($('.winner_item').children('.winner_item_bottom').length > 0) {
				$('.winner_item').addClass('has-arrow');
			} else {
				$('.winner_item').addClass('no-arrow');
			}


			//increment so we can go to the next item and set a timeout so we
			//can delay adding them to make them cascade in
			i++;

			setTimeout(function(){
				growCommunitiesDisplay(sortedData, i, total);
			}, 120);
		}

	}


	function bindWinnerToggle() {
		//Handle opening accordion on winners with additional info
		$('.winner_item.has-arrow').click(function() {
			$(this).toggleClass('active');
			if($(this).hasClass('active')){
				$(this).find('.winners_internal_chevron').removeClass('fa-arrow-down').addClass('fa-arrow-up');
			}
			else {
				$(this).find('.winners_internal_chevron').removeClass('fa-arrow-up').addClass('fa-arrow-down');
			}
		})
	}




	//Make the cards equal height
	function sizeWinnerCards(){
		var height = 0;
		$('.winner_item_top').each(function(){
			if($(this).height() > height){
				height = $(this).height();
			}
		})
		$('.winner_item_top').height(height);
	}



});
