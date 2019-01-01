(function($) {
  "use strict";
  
  $(function(){
		// Making buttons rounded inside Datatables plugin
		if( $('.dt-bootstrap .btn').parent().hasClass('btn-group') ){
			$('.dt-bootstrap .btn-group').addClass('rounded');
		}else{
			$('.dt-bootstrap .btn').addClass('rounded');
		}

		// making .label and .form-control rounded inside Datatables plugin
		$('.dt-bootstrap .label, .dt-bootstrap .form-control').addClass('rounded');
	});
})(jQuery);