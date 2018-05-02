(function($){
  'use strict';

  var wisemode = {
    // Inits the plugin that stores data
    basil: new window.Basil(),
    // Object that includes [data-row-id] and [data-col-id] attributes values
    rowColObj: {},

    init: function(){
      // Device check
      var device = 'ontouchstart' in document.documentElement;

      if(!device){
        wisemode.sortableInit();

        // When JQUERY UI Sortable is initialized, buttons and inputs inside it do not focus out, so we do it manually
        $('.ui-sortable-handle').on('click', wisemode.clickOnPanel);
      }else{
        $('.breadcrumb-wrapper .dropdown-wrapper select, .page-title-wrapper .dropdown-wrapper select').remove();
      }
    },
    sortableInit: function(){
      var $rowSortable = $(".content > .row");

      // Numbering .row and .col-* elements with [data-row-id] and [data-col-id] attributes
      var colIterator = 0;

      for( var rowI = 0; rowI < $rowSortable.length; rowI++ ){
        $rowSortable.eq(rowI).attr('data-row-id', rowI);

        // Selecting [data-row-id] attribute values
        var $dataRowId = $rowSortable.eq(rowI).attr('data-row-id');
        // Selecting .col-* elements
        var $colElements = $rowSortable.eq(rowI).find('>');
        var colId = '';

        for( var colI = 0; colI < $colElements.length; colI++ ){
          $colElements.eq(colI).attr('data-col-id', colIterator);
          
          // Selecting [data-col-id] attribute values
          var $dataColId = $colElements.eq(colI).attr('data-col-id');
          colId += $dataColId+'|';

          colIterator++;
        }

        wisemode.rowColObj[ $dataRowId ] = colId;
      }

      // Sorting .col-* elements with jQuery sortable plugin
      $($rowSortable).sortable({
        helper: "clone",
        connectWith: $rowSortable,
        handle: ".panel:not('.panel-fixed')",
        placeholder: "panel-placeholder",

        start: function(event, ui){
          // Placeholder
          ui.placeholder.addClass(ui.item.attr('class')).css({
            height: ui.item.height(),
            top: -parseInt(ui.item.find('>').css('margin-bottom')) / 2+'px'
          });
        },
        update: function(event, ui) {
          var rowColObj = {};
          var colId = '';

          for( var rowI = 0; rowI < $rowSortable.length; rowI++ ){
            // Selecting [data-row-id] attribute values
            var $dataRowId = $rowSortable.eq(rowI).attr('data-row-id');
            // Selecting .col-* elements
            var $colElements = $rowSortable.eq(rowI).find('>');

            for( var colI = 0; colI < $colElements.length; colI++ ){
              // Selecting [data-col-id] attribute values
              var $dataColId = $colElements.eq(colI).attr('data-col-id');
              // Collecting all the data-col-id attribute values using '|' as a divider
              colId += $dataColId+'|';
            }

            rowColObj[ $dataRowId ] = colId;
            colId = '';
          }

          if( wisemode.select2Val('.breadcrumb-wrapper .dropdown-wrapper select, .page-title-wrapper .dropdown-wrapper select') == 'on' ){
            // After dragging elements, storing in basil
            wisemode.basil.set('wiseboard', rowColObj, { 'namespace': location.pathname });
          }
        }
      });

      if( $('.breadcrumb-wrapper .dropdown-wrapper select, .page-title-wrapper .dropdown-wrapper select').length > 0 ){
        if( wisemode.select2Val('.breadcrumb-wrapper .dropdown-wrapper select, .page-title-wrapper .dropdown-wrapper select') == 'on' ){
          wisemode.dataStore('on');
        }

        $('.breadcrumb-wrapper .dropdown-wrapper select, .page-title-wrapper .dropdown-wrapper select').on('change', wisemode.select2ValOnChange);
      }
    },
    dataStore: function(status){
      if( status == 'on' ){
        // Recovering .col-* elements's previously changed positions using cookies or localstorage  
        var storedData = wisemode.basil.get('wiseboard', { 'namespace': location.pathname });

        if(storedData){
          for(var i in storedData){
            var colArr = storedData[i].split('|');

            for( var j in colArr ){
              $('div[data-row-id="'+i+'"]').append( $('div[data-col-id="'+colArr[j]+'"]'));
            }
          }
        }
      }else if( status == 'reset' ){
        for(var i in wisemode.rowColObj){
          var colArr = wisemode.rowColObj[i].split('|');

          for( var j in colArr ){
            $('div[data-row-id="'+i+'"]').append( $('div[data-col-id="'+colArr[j]+'"]'));
          }
        }
        wisemode.basil.remove('wiseboard', { 'namespace': location.pathname })
      }
    },
    select2Val: function(el){
      return $(el).val();
    },
    select2ValOnChange: function(){
      var res = wisemode.select2Val( $(this) );
      wisemode.dataStore(res);
      wisemode.blockUIInit( $(this).find('[value="'+res+'"]').text() );
    },
    blockUIInit: function(textMessage){
      // Blockui default settings
      $.blockUI.defaults.timeout = 2000;
      $.blockUI.defaults.overlayCSS.zIndex = 1060;
      $.blockUI.defaults.overlayCSS.backgroundColor = 'transparent';
      $.blockUI.defaults.css.width = 'auto';
      $.blockUI.defaults.css.left = 0;
      $.blockUI.defaults.css.right = 0;
      $.blockUI.defaults.css.margin = 'auto';
      $.blockUI.defaults.css.border = 'none';

      $.blockUI({
        message: '<h3 class="m-0"><i class="fa fa-check m-right-10 circle p-5" style="vertical-align: middle; font-size: 14px; border: 1px solid #fff"></i><span style="vertical-align: middle">'+textMessage+'</span></h3>',
        css: {
          'width': '250px',
          'border': 'none',
          'padding': '20px', 
          'background-color': '#000', 
          'opacity': .75, 
          'color': '#fff',
          'border-radius': '4px'
        },
        // Change default timeout
        timeout: 1000,
        fadeOut:  600,
      });
    },
    clickOnPanel: function(e){
      if( !$(e.target).is('.form-control') && !$(e.target).is('.btn') ){
        $(this).find('.form-control, .btn').blur();
      }
    }
  };
  
  wisemode.init();
})(jQuery);