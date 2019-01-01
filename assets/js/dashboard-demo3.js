(function($){
  'use strict';

  var demo = {
    init: function(){
      // Select2 dropdown
      demo.select2DropdownInit('.breadcrumb-wrapper select');

      // Daterangepicker
      // Function Arguments: selector
      demo.dateRangePickerInit('.page-title-wrapper .btn');

      // Line chart
      // Function Arguments: selector, data, label, color, fill color, point highlight color
      // Visits data
      var visitsData = [
        [new Date(2016, 0, 1).getTime(),0],
        [new Date(2016, 0, 10).getTime(),600],

        [new Date(2016, 1, 1).getTime(),550],
        [new Date(2016, 1, 15).getTime(),800],

        [new Date(2016, 2, 1).getTime(),1100],
        [new Date(2016, 3, 1).getTime(),1700],

        [new Date(2016, 4, 1).getTime(),2400],
        [new Date(2016, 4, 20).getTime(),2300],

        [new Date(2016, 5, 5).getTime(),2650],
        [new Date(2016, 5, 20).getTime(),2500],

        [new Date(2016, 6, 1).getTime(),2700],
        [new Date(2016, 6, 10).getTime(),2700],
        [new Date(2016, 6, 25).getTime(),2200],

        [new Date(2016, 7, 1).getTime(),2200],
        [new Date(2016, 7, 25).getTime(),2900],

        [new Date(2016, 8, 1).getTime(),2400],
        [new Date(2016, 8, 15).getTime(),2700],
        [new Date(2016, 8, 25).getTime(),2800],

        [new Date(2016, 9, 5).getTime(),2400],
        [new Date(2016, 9, 15).getTime(),3100],
        [new Date(2016, 9, 25).getTime(),2800],

        [new Date(2016, 10, 5).getTime(),3600],
        [new Date(2016, 10, 15).getTime(),3700],
        [new Date(2016, 10, 25).getTime(),3500],

        [new Date(2016, 11, 10).getTime(),4000],
        [new Date(2016, 11, 20).getTime(),3300],

        [new Date(2016, 12, 1).getTime(),4300],
        [new Date(2016, 12, 15).getTime(),4800]
      ];
      // Orders chart
      demo.lineChartInit('#chart-visits', visitsData, 'Sales', 'rgb(146, 219, 255)', 'rgba(146, 219, 255, .5)', '#62C6F8');

      // Datatables
      //Setting default values
      $.extend( $.fn.dataTable.defaults,{
        dom: '<"table-responsive" <t>>', // Table
        autoWidth: false
      });

      // Task list
      // Function Arguments: selector
      demo.datatablesTasklistInit('.panel-tasks .table');

      // Vector map
      // Function Arguments: selector
      demo.mapInit('#map');

      // Country sales table
      // Function Arguments: selector, options
      var salesOptions = { order: [[1, 'desc']] };
      demo.datatablesInit('.panel-map .table', salesOptions);

      // Live search
      // Function Arguments: Selector, search input, parent selector, child selector
      demo.contentLiveSearchInit('.panel-lead-staff-activity', '#search-lead-staff-activity', '.media', 'div');
      demo.contentLiveSearchInit('.panel-requests', '#search-requests', '.media', 'div');
      demo.contentLiveSearchInit('.panel-tasks-comments', '#search-tasks-comments', '.media', 'div');
      demo.contentLiveSearchInit('.panel-activity-monitor', '#search-activity-monitor', '.media', 'div');
      demo.contentLiveSearchInit('.panel-chat', '#search-chat', '.media', 'div');

      // Custom scrollbar
      // Function Arguments: selector
      demo.slimscrollInit('.panel-lead-staff-activity .media-wrapper');
      demo.slimscrollInit('.panel-requests .media-wrapper');
      demo.slimscrollInit('.panel-tasks-comments .media-wrapper');
      demo.slimscrollInit('.panel-activity-monitor .media-wrapper');
      demo.slimscrollInit('.panel-chat .media-wrapper');

      // Hide scrollbar when page is loaded
      $('.slimScrollBar').hide();
    },
    select2DropdownInit: function(el){
      $(el).select2({
        theme: 'bootstrap',
        minimumResultsForSearch: Infinity
      }).next('.select2-container--bootstrap').addClass('input-sm');
    },
    dateRangePickerInit: function(el){
      // Predefined ranges
      function drp(start, end) {
        $(el).find('span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      }
      drp(moment().subtract(29, 'days'), moment());

      $(el).daterangepicker({
        applyClass: 'btn-primary',
        opens: 'left',
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
      }, drp);
    },
    slimscrollInit: function(el){
      // Gets max-height
      var height = parseInt($(el).css('max-height'));

      $(el).slimScroll({
        height: height,
        allowPageScroll: true,
        color: '#000'
      });
    },
    lineChartInit: function(el, data, label, color, fillColor, highlightColor){
      $.plot(el,
        [{
          data: data,
          label: label,
          color: color,
          shadowSize: 0
        }],
        {
          series: {
            lines: {
              show: true,
              fill: true,
              fillColor: fillColor
            },
            points: {
              symbol: function cross(ctx, x, y, radius, shadow){
                          ctx.arc(x, y, 4, 0, Math.PI*2, true);
                          ctx.fillStyle = ctx.strokeStyle;
                          ctx.lineWidth = 1;
                          ctx.fill();
                      }
            }
          },
          xaxis: {
            tickColor: "transparent",
            mode: "time",
            timeformat: "%b %Y"
          },
          yaxis: {
            tickColor: "#f2f2f2",
            max: 10000
          },
          legend: {
            margin: [5, 10],
            labelBoxBorderColor: color,
            labelFormatter: function(label, series) {
              // series is the series object for the label
              return "<span class='m-left-5'>"+label+"</span>";
            }
          },
          grid: {
            hoverable: true,
            borderWidth: 1,
            borderColor: "#f2f2f2"
          },
          highlightColor: highlightColor,
          tooltip: {
            show: true,
            content: "<span class='label' style='color: #fff; background-color: rgba(0,0,0,.6)'>%x = %y</span>",
            shifts: {
              x: -45
            },
            cssClass: "chart-tooltip",
            defaultTheme: false
          }
        }
      );
    },
    icheckInit: function(el){
      $(el).iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass: 'iradio_minimal-grey'
      });
    },
    datatablesIcheckChecked: function(){
      var thCheckbox = $(this).closest('th');
      var tdCheckbox = $(this).closest('.table').find('tbody input.icheck');

      if(thCheckbox.length)
        tdCheckbox.iCheck('check');
    },
    datatablesIcheckUnchecked: function(){
      var thCheckbox = $(this).closest('th');
      var tdCheckbox = $(this).closest('.table').find('tbody input.icheck');

      if(thCheckbox.length)
        tdCheckbox.iCheck('uncheck');
    },
    datatablesTasklistChildRow: function(el){
      // Dropdown table with extra info
      function tasksFormat(d){
        // `d` is the original data object for the row
        return  '<table class="table table-bordered">'+
                  '<tr>'+
                      '<td style="width: 35%;">Parent Project:</td>'+
                      '<td>'+d.parentProject+'</td>'+
                  '</tr>'+
                  '<tr>'+
                      '<td>Description:</td>'+
                      '<td>'+d.description+'</td>'+
                  '</tr>'+
                  '<tr>'+
                      '<td>Due Date:</td>'+
                      '<td>'+d.dueDate+'</td>'+
                  '</tr>'+
                  '<tr>'+
                      '<td>Assigned to:</td>'+
                      '<td>'+d.assign+'</td>'+
                  '</tr>'+
                '</table>';
      }

      var tr = $(this).closest('tr');
      var row = el.DataTable().row(tr);

      if (row.child.isShown()){
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
      }else{
        // Open this row
        row.child( tasksFormat(row.data())).show();
        tr.addClass('shown');
      }
    },
    datatablesTasklistEdit: function(el){
      $(this).removeClass('btn-edit').addClass('btn-save').find('.fa-pencil').removeClass("fa-pencil").addClass('fa-save');
            
      var tr = $(this).closest('tr');
      var td = tr.find('td');

      for(var i = 1; i <= td.length - 2; i++){
        var cellCur = $(el).DataTable().cell(td.eq(i));
        cellCur.data('<input type="text" class="form-control input-sm" value="'+cellCur.data()+'">');
      }
    },
    datatablesTasklistSave: function(el){
      $(this).removeClass('btn-save').addClass('btn-edit').find('.fa-save').removeClass("fa-save").addClass('fa-pencil');
            
      var tr = $(this).closest('tr');
      var td = tr.find('td');

      for(var i = 1; i <= td.length - 2; i++){
        var cellCur = $(el).DataTable().cell(td.eq(i));
        var inputVal = td.eq(i).find('.form-control').val();
        cellCur.data(inputVal).draw();
      }
    },
    datatablesTasklistRemove: function(el){
      $(el).DataTable().row().remove().draw(false);
    },
    datatablesTasklistInit: function(el){
      $(el).DataTable({
        dom:  '<f>'+ // Top section structure(search etc.)
              '<"table-responsive" <t>>', // Table
        language: {
          search: '_INPUT_',
          searchPlaceholder: 'Search...'
        },
        order: [ [1, 'asc'] ],
        columnDefs:[{
          targets: [0,3],
          orderable: false
        }],
        ajax: 'task-list-data.txt',
        columns: [
          {
            className: 'details-control',
            defaultContent: "<input type='checkbox' class='icheck' autocomplete='off'>"
          },
          { data:  'title'},
          { data: 'tag' },
          { defaultContent: '<td>'+
                  '<div class="btn-group btn-group-xs pull-right">'+
                      '<button type="button" class="btn btn-default btn-edit">'+
                          '<i class="fa fa-pencil"></i>'+
                      '</button>'+
                      '<button type="button" class="btn btn-default btn-remove">'+
                        '<i class="fa fa-trash"></i>'+
                      '</button>'+
                  '</div></td>' }
        ],
        initComplete: function(settings, json){
          // After getting data inits iCheck
          demo.icheckInit('input.icheck');

          // If checkbox in <th> is checked, marking checked all checkboxes too
          $('.icheck').on('ifChecked', demo.datatablesIcheckChecked);

          // If checkbox in <th> is unchecked, marking unchecked all checkboxes too
          $('.icheck').on('ifUnchecked', demo.datatablesIcheckUnchecked);

          // Add event listener for opening and closing details
          $(el).find('tbody').on('click', 'td.details-control', $.proxy(demo.datatablesTasklistChildRow, null, $(el)));

          // Editing, saving and removing
          $(el).DataTable().on('click','.btn-edit', $.proxy(demo.datatablesTasklistEdit, null, el));
          
          $(el).DataTable().on('click','.btn-save', $.proxy(demo.datatablesTasklistSave, null, el));
          
          $(el).DataTable().on('click','.btn-remove', $.proxy(demo.datatablesTasklistRemove, null, el));
        }
      });
    },
    datatablesInit: function(el, options){
      $(el).dataTable(options);
    },
    contentLiveSearchInit: function(container, searchField, selector, childSelector){
      $(container).searchable({
        searchField: searchField,
        selector: selector,
        childSelector: childSelector
      })
    },
    mapInit: function(el){
      // Initializing Jqvmap plugin
      $(el).vectorMap({
        map: 'world_en',
        backgroundColor: null,
        color: '#e7e7e7',
        borderColor: '#777',
        selectedColor: '#ddd',
        hoverColor: '#68d8cf',
        hoverOpacity: .7,
        colors: {
          'us': '#68d8cf',
          'au': '#68d8cf',
          'br': '#68d8cf',
          'fr': '#68d8cf',
          'it': '#68d8cf',
          'cn': '#68d8cf',
          'af': '#68d8cf',
          'eg': '#68d8cf',
          'dz': '#68d8cf',
          'cd': '#68d8cf',
          'no': '#68d8cf'
        },
      });
    }
  };
  
  demo.init();
})(jQuery);