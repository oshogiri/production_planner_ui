(function($){
  'use strict';

  var pageScript = {
		init: function(){
			// Pagination
			pageScript.paginationInit();
		},
		paginationInit: function(){
			$(".search-wrapper").jplist({       
	      itemsBox: ".jplist-wrapper",
	      itemPath: ".media",
	      panelPath: ".jplist-panel"
	    });
		}
	};
  
  pageScript.init();
})(jQuery);