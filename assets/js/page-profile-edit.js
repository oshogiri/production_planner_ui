(function($){
  'use strict';

  var pageScript = {
    init: function(){
      pageScript.tabdropInit('.panel-heading .nav-tabs');
      pageScript.bootstrapSwitchInit('.settings-switch');
    },
    tabdropInit: function(el){
      $.fn.tabdrop.defaults.text = '<i class="fa fa-angle-down"></i>';
      $(el).tabdrop();

      // Removing caret
      $('.tabdrop .caret').remove();
    },
    bootstrapSwitchInit: function(el){
      $(el).bootstrapSwitch();
    }
  };
  
  pageScript.init();
})(jQuery);