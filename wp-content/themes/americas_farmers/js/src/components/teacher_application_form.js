jQuery(document).ready(function( $ ) {
	//Handles adding a touched class anytime a field is focused so we can fancy animate labels
	$('.address_city input').focus(function() {
		$(this).closest('.address_city').addClass('touched');
    })
    $('.address_line_1 input').focus(function() {
		$(this).closest('.address_line_1').addClass('touched');
    })
    $('.address_line_2 input').focus(function() {
		$(this).closest('.address_line_2').addClass('touched');
    })
    $('.address_zip input').focus(function() {
        $(this).closest('.address_zip').addClass('touched');
    })
    $('.ginput_container_phone input').focus(function() {
		$(this).parent().parent().addClass('touched');
    })
    $('.ginput_container_number input').focus(function() {
		$(this).parent().parent().addClass('touched');
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
