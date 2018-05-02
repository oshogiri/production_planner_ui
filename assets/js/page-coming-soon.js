(function($){
  'use strict';

  var pageScript = {
		init: function(){
			// Countdown
	    $(".panel").countdown("2020/01/01", pageScript.cntDown);
		},
		cntDown: function(e){
			$(this).find("#days-countdown").text(e.strftime("%d"));
	    $(this).find("#hours-countdown").text(e.strftime("%H"));
	    $(this).find("#minutes-countdown").text(e.strftime("%M"));
	    $(this).find("#seconds-countdown").text(e.strftime("%S"));
		}
	};
  
  pageScript.init();
})(jQuery);