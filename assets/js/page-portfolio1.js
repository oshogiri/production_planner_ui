(function($){
  'use strict';

  var pageScript = {
    init: function(){
      $("a[href='#get-in-touch']").on("click", pageScript.getInTouchClick);
      pageScript.portfolioItemFilter();
    },
    getInTouchClick: function(){
      // Smooth scrolling when click on <a href="#get-in-touch"></a> in header
      $("html").animate({
        scrollTop: $("#get-in-touch").offset().top
      }, 700); 
    },
    portfolioItemFilter: function(){
      // Filters by category
      $(".portfolio-body").jplist({
        itemsBox: ".portfolio-grid-wrapper",
        itemPath: ".portfolio-item",
        panelPath: ".portfolio-nav",
        effect: "fade",
        redrawCallback: function(){
          // After jplist redrawing initialize magnificpopup
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