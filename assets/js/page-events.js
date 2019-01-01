(function($){
  'use strict';

  var pageScript = {
		init: function(){
			$(".modal").on("shown.bs.modal", $.proxy(pageScript.select2DropdownInit, null, 'select') );
		},
		select2DropdownInit: function(el){
			$(el).select2({
	      theme: "bootstrap"
	    });
		}
	};
  
  pageScript.init();
})(jQuery);