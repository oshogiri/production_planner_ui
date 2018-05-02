(function($){
  'use strict';

  var pageScript = {
		init: function(){
			// Initializing Icheck
			pageScript.icheckInit('input.icheck-minimal-grey');
		},
		icheckInit: function(el){
	    $(el).iCheck({
	      checkboxClass: 'icheckbox_minimal-grey',
	      radioClass: 'iradio_minimal-grey'
	    });
		}
	};
  
  pageScript.init();
})(jQuery);