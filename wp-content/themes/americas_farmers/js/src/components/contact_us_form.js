jQuery(document).ready(function( $ ) {
	//Handles adding a touched class anytime a field is focused so we can fancy animate labels
	$('.name_first input').focus(function() {
		$(this).closest('.name_first').addClass('touched');
	})
	$('.name_last input').focus(function() {
		$(this).closest('.name_last').addClass('touched');
	})
	$('.address_city input').focus(function() {
		$(this).closest('.address_city').addClass('touched');
	})
	$('.animate-text input, textarea').focus(function() {
		$(this).closest('.gfield').addClass('touched');
	})

	// Add GF error validation if user ignores filling in input that's required


	// $('.gfield_contains_required .ginput_complex span').each( function(){
	// 	$(this).append("<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>");
	// });

	$('input, textarea, select').on('change', function(){
	    var $input     = $(this);
	    var isRequired = $input.parents('.gfield').is('.gfield_contains_required');
	    var isValid    = $input.is(':valid');
	    var isEmailField = $input.parents('.ginput_container').hasClass('ginput_container_email')
	    var isValidEmail = true;
	    if(isEmailField){
	    	var value = $input.val();
	    	if(value.indexOf('@') >=0 && value.indexOf('.')>=0){
	    		
	    		isValidEmail = true;
	    	}
	    	else {
	    		isValidEmail = false;
	    	}
	    }

	    if ( isRequired && isValid && isValidEmail ) {
	        $input.parents('.gfield').removeClass('gfield_error');
	        $input.parent().next('.validation_message').slideUp();
	    }


	}).blur(function(){
	    var $input     = $(this);
	    var isRequired = $input.parents('.gfield').is('.gfield_contains_required');
	    var isInValid  = $input.is(':invalid');
	    var isEmpty    = $input.val() === '';
	    var isEmailField = $input.parents('.ginput_container').hasClass('ginput_container_email')
	    var isValidEmail = true;
	    if(isEmailField){
	    	var value = $input.val();
	    	if(value.indexOf('@')>=0 && value.indexOf('.')>=0){
	    		isValidEmail = true;
	    	}
	    	else {
	    		isValidEmail = false;
	    	}
	    }

	    if ( isRequired && ( isInValid || isEmpty || !isValidEmail ) ) {
	        $input.parents('.gfield').addClass('gfield_error');
	        $input.parent().next('.validation_message').slideDown();
	    }
	});

});
