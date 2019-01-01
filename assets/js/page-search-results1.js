(function($){
  'use strict';

  var pageScript = {
    init: function(){
      pageScript.select2DropdownInit('select');

      // Pagination
      pageScript.paginationInit();
    },
    select2DropdownInit: function(el){
      $(el).select2({
        theme: "bootstrap"
      });
      
      $(el+".input-sm").next(".select2-container--bootstrap").addClass("input-sm");
    },
    paginationInit: function(){
      $(".search-wrapper").jplist({       
        itemsBox: ".jplist-wrapper",
        itemPath: ".panel",
        panelPath: ".jplist-panel"
      });
    }
  };
  
  pageScript.init();
})(jQuery);