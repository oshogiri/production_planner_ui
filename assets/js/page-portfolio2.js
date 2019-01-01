(function($){
  'use strict';

  var pageScript = {
    init: function(){
      pageScript.portfolioItemFilter();
    },
    portfolioItemFilter: function(){
      // Filters by category
      $("body").jplist({
        itemsBox: ".portfolio-grid-wrapper",
        itemPath: ".portfolio-item",
        panelPath: ".portfolio-nav",
        effect: "fade",
        redrawCallback: function(){
          // After jplist redrawing initialize magnificpopup(otherwise jplist will conflict with magnific popup)
          pageScript.imagePreview();
        }
      });
    },
    imagePreview: function(){
      // Image popup preview
      $(".hover-layer").magnificPopup({
        delegate: "a", // child items selector, by clicking on it popup will open
        type: "image",
        gallery:{
          enabled: true
        }
      });
    }
  };
  
  pageScript.init();
})(jQuery);