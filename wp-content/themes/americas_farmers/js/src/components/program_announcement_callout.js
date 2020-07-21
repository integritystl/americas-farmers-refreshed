(function($) {
	/**
	*
	* Simple bindings to toggle the active class on callouts so they can expand.
	* also binds touch events for cuz mobile.
	*
	**/
	$(document).ready(function(){

		function expandProgramCallout(){
			$('#program_announcement_list li').removeClass('active');
			$(this).addClass('active');
			$(document).bind('touchstart', closeProgramCallout);
		}

		function closeProgramCallout() {
			$('#program_announcement_list li').removeClass('active');
			$(document).unbind('touchstart', closeProgramCallout);
		}

		$('#program_announcement_list li').mouseenter(expandProgramCallout);
		$('#program_announcement_list li').mouseleave(closeProgramCallout);
		$('#program_announcement_list li').on('touchstart', expandProgramCallout);

		$('#program_announcement_list li a').on('touchstart', function(e){
			e.stopPropagation();
		})

	})

})(jQuery);