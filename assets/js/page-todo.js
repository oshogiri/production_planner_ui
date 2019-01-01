(function($){
  'use strict';

  var pageScript = {
		init: function(){
			// Filters by category
			pageScript.todoFilter();

			// Initializing tooltip
	    $('[data-toggle="tooltip"]').tooltip();

	    $(".modal").on("shown.bs.modal", $.proxy(pageScript.select2DropdownInit, null, 'select'));

	    $(document).on("click", ".todo-due-date .btn", pageScript.stopProp);
		},
		select2DropdownInit: function(el){
			$(el).select2({
	      theme: "bootstrap"
	    });
		},
		todoFilter: function(){
	    $(".content").jplist({
	      itemsBox: ".col-todo-tasks",
	      itemPath: ".panel",
	      panelPath: ".projects-wrapper",
	      effect: "fade"
	    });
		},
		stopProp: function(e){
			e.stopPropagation();
		}
	};
  
  pageScript.init();
})(jQuery);