(function($){
  'use strict';

  var demo = {
		init: function(){
			// Initializing Icheck
			demo.icheckInit('input.icheck');

			demo.select2DropdownInit('select');

			demo.maxLengthInit('#inputMetaTitle, #inputMetaKeywords, #inputMetaDesc');

		},
		select2DropdownInit: function(el){
			$(el).select2({
	      theme: "bootstrap"
	    });
		},
		icheckInit: function(el){
	    $(el).iCheck({
	      checkboxClass: 'icheckbox_minimal-grey',
	      radioClass: 'iradio_minimal-grey'
	    });
		},
		maxLengthInit: function(el){
			$(el).maxlength({
		    threshold: 30,
		    separator: ' of ',
		    preText: 'You have ',
		    postText: ' chars remaining.',
		    validate: true
		  });
		}
	};
  
  demo.init();
})(jQuery);