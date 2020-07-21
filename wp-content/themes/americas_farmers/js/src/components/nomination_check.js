jQuery(document).ready(function( $ ) {
	var nominationCountyList = [];
	var nominationSchoolList = [];
	var currentStateData = [];

	//Handle opening and closing the select options
	$('.nomination_state_select_top').click(function(){
		$('.nomination_state_select_bottom').toggleClass('active');

		if($('#nomination_chevron_state').hasClass('fa-chevron-up')){
			$('#nomination_chevron_state').removeClass('fa-chevron-up').addClass('fa-chevron-down');
		} else {
			$('#nomination_chevron_state').removeClass('fa-chevron-down').addClass('fa-chevron-up');
		}
	})
	$(window).click(function (e) {
		if (!e.target.classList.contains('nomination_state_select_top') && e.target.id !== 'nomination_state_nicename' && !e.target.classList.contains('nomination_chevron') && $('.nomination_state_select_bottom').hasClass('active')) {
			$('.nomination_state_select_bottom').removeClass('active');
			if($('#nomination_chevron_state').hasClass('fa-chevron-up')){
				$('#nomination_chevron_state').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			}
		}
	})

	//Handle opening and closing the county select options
	$('.nomination_county_select_top').click(function(){
		$('.nomination_county_select_bottom').toggleClass('active');

		if($('#nomination_chevron_county').hasClass('fa-chevron-up')){
			$('#nomination_chevron_county').removeClass('fa-chevron-up').addClass('fa-chevron-down');
		} else {
			$('#nomination_chevron_county').removeClass('fa-chevron-down').addClass('fa-chevron-up');
		}
	})
	$(window).click(function (e) {
		if (!e.target.classList.contains('nomination_county_select_top') && e.target.id !== 'nomination_county_nicename' && !e.target.classList.contains('nomination_chevron') && $('.nomination_county_select_bottom').hasClass('active')) {
			$('.nomination_county_select_bottom').removeClass('active');
			if($('#nomination_chevron_county').hasClass('fa-chevron-up')){
				$('#nomination_chevron_county').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			}
		}
	})

	//Handle opening and closing the school select options
	$('.nomination_school_select_top').click(function(){
		$('.nomination_school_select_bottom').toggleClass('active');

		if($('#nomination_chevron_school').hasClass('fa-chevron-up')){
			$('#nomination_chevron_school').removeClass('fa-chevron-up').addClass('fa-chevron-down');
		} else {
			$('#nomination_chevron_school').removeClass('fa-chevron-down').addClass('fa-chevron-up');
		}
	})
	$(window).click(function (e) {
		if (!e.target.classList.contains('nomination_school_select_top') && e.target.id !== 'nomination_school_nicename' && !e.target.classList.contains('nomination_chevron') && $('.nomination_school_select_bottom').hasClass('active')) {
			$('.nomination_school_select_bottom').removeClass('active');
			if($('#nomination_chevron_school').hasClass('fa-chevron-up')){
				$('#nomination_chevron_school').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			}
		}
	})

	$('.nomination_state_option').click(function() {
		//Kill our old data if they changed
		nominationCountyList = [];
		nominationSchoolList = [];
		currentStateData = [];
		$('#nomination_two').removeClass('active');
		$('#nomination_three').removeClass('active');
		$('#nomination_county_list').html(' ');
		$('#nomination_county_nicename').html('Select a County');
		$('#nomination_school_nicename').html('Select a School District');
		$('#nomination_school_list').html('');
		$('.nomination_success').removeClass('active');
		$('.nomination_failure').removeClass('active');
		$('.nomination_error').removeClass('active');
		//Turn the loading spinner on
		$('.loading_spinner').addClass('active');
		//Grab the data we need
		var stateValue = $(this).attr('data-value');
		var niceName = $(this).attr('data-nicename');

		//Pop that data into the dropdown so you see your selection
		$('#nomination_state_nicename').html(niceName);
		$('.nomination_state_select_bottom').removeClass('active');
		$('#nomination_chevron_state').removeClass('fa-chevron-up').addClass('fa-chevron-down');

		var targetUrl = wpAjax.ajaxurl + '?action=get_nomination_by_state&state='+stateValue;

		//fire off that ajax request
		$.ajax(targetUrl, {
			'method': 'GET'
		})
		.done(function(data){
			$('.loading_spinner').removeClass('active');
			var returnData = JSON.parse(data.data);
			currentStateData = returnData;
			console.log(returnData);
			//Set up dat county data

			for(i = 0; i < returnData.school.length; i++){
				if(nominationCountyList.indexOf(returnData.school[i].schoolCounty) == -1){
					nominationCountyList.push(returnData.school[i].schoolCounty);
				}
			}

			//Now that we got our county data, sort it alpha
			nominationCountyList = nominationCountyList.sort(function(a, b){
				if (a < b) return -1;
				else return 1;
			})

			//This is State Select Change and the data it nabs to shove in School Counties
			for( var v = 0; v < nominationCountyList.length; v++){
				$('#nomination_county_list').append('<li role="option" class="nomination_county_option" data-value="' + nominationCountyList[v] + '">' + nominationCountyList[v] + '</li>');
			}

			$('#nomination_two').addClass('active');
			bindNominationCountyOptions();
		})
		.fail(function(){
			$('.loading_spinner').removeClass('active');
			$('.nomination_error').addClass('active');
		})
	})
	function bindNominationCountyOptions(){
		$('.nomination_county_option').click(function() {
			//Kill our old data if they changed
			nominationSchoolList = [];
			$('#nomination_three').removeClass('active');
			//Turn the loading spinner on
			$('.loading_spinner').addClass('active');
			//Grab the data we need
			var countyValue = $(this).attr('data-value');
			$('#nomination_county_nicename').html(countyValue);
			//close the dang select
			$('.nomination_county_select_bottom').removeClass('active');
			$('#nomination_chevron_county').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			$('.nomination_failure').removeClass('active');
			$('.nomination_success').removeClass('active');
			$('#nomination_school_list').html('');
			$('#nomination_school_nicename').html('Please Select a School District');
			$('.nomination_error').removeClass('active');

			//Build the list of schools in that county
			var tempSchoolList = [];
			for(i = 0; i < currentStateData.school.length; i++){
				if(currentStateData.school[i].schoolCounty == countyValue){
					tempSchoolList.push(currentStateData.school[i]);
				}
			}

			//Sort Dat List
			nominationSchoolList = tempSchoolList.sort(function(a, b){
				var x = a.schoolName;
				var y = b.schoolName;
				if(x < y) return -1;
				else return 1;
			})
			for( var v = 0; v < nominationSchoolList.length; v++){
				$('#nomination_school_list').append('<li role="option" class="nomination_school_option" data-value="' + nominationSchoolList[v].schoolID + '" data-name="' + nominationSchoolList[v].schoolName + '">' + nominationSchoolList[v].schoolName + '</li>');
			}
			$('.loading_spinner').removeClass('active');
			$('#nomination_three').addClass('active');

			bindNominationSchoolOptions();
		})
	}

	function bindNominationSchoolOptions(){
		$('.nomination_school_option').click(function() {
			var schoolID = $(this).attr('data-value');
			var nicename = $(this).attr('data-name');
			$('#nomination_school_nicename').html(nicename);
			$('.nomination_failure').removeClass('active');
			$('.nomination_success').removeClass('active');
			$('.nomination_error').removeClass('active');

			//close the dang select
			$('.nomination_school_select_bottom').removeClass('active');
			$('#nomination_chevron_school').removeClass('fa-chevron-up').addClass('fa-chevron-down');
			//Turn the loading spinner on
			$('.loading_spinner').addClass('active');

			var targetUrl = wpAjax.ajaxurl + '?action=get_nomination_by_school&schoolId=' + schoolID;

			//fire off that ajax request
			$.ajax(targetUrl, {
				'method': 'GET'
			})
			.done(function(data) {
				$('.loading_spinner').removeClass('active');
				var returnData = JSON.parse(data.data);
				if(returnData.hasOwnProperty('school')){
					var nominationCount = returnData.school.nominationCount;
					$('#nomination_count').html(nominationCount);
					$('.nomination_success').addClass('active');
				}
				else if(returnData[0].hasOwnProperty('error')){
					$('.nomination_failure').addClass('active');
				}
			})
			.fail(function(){
				$('.loading_spinner').removeClass('active');
				$('.nomination_error').addClass('active');
			})
		})
	}

});