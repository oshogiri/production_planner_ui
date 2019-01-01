(function($){
  'use strict';

  var demo = {
    init: function(){
      // Select2 dropdown
      demo.select2DropdownInit('.breadcrumb-wrapper select');

      // Daterangepicker
      // Function Arguments: selector
      demo.dateRangePickerInit('.page-title-wrapper .btn');

      // Tabdrop plugin
      // Function Arguments: selector
      demo.tabdropInit('.panel-heading .nav-tabs');

      // Line chart
      // Function Arguments: selector, data, label, color, fill color, point highlight color
      // Orders data
      var ordersData = [
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
      //demo.lineChartInit('#chart-orders', ordersData, 'Sales', 'rgb(146, 219, 255)', 'rgba(146, 219, 255, .5)', '#62C6F8');

      // Expenses data
      var expensesData = [
        [new Date(2016, 0, 1).getTime(),4000],
        [new Date(2016, 1, 1).getTime(),3000],
        [new Date(2016, 2, 1).getTime(),4500],
        [new Date(2016, 3, 1).getTime(),4500],
        [new Date(2016, 4, 1).getTime(),6000],
        [new Date(2016, 5, 1).getTime(),6700],
        [new Date(2016, 6, 1).getTime(),4400],
        [new Date(2016, 7, 1).getTime(),3600],
        [new Date(2016, 8, 1).getTime(),600],
        [new Date(2016, 9, 1).getTime(),3000],
        [new Date(2016, 10, 1).getTime(),4700],
        [new Date(2016, 11, 1).getTime(),6200],
        [new Date(2016, 12, 1).getTime(),6900]
      ];
      // Expenses chart
      //demo.lineChartInit('#chart-expenses', expensesData, 'Expenses', 'rgb(255, 206, 153)', 'rgba(255, 206, 153, .5)', '#FDB05B');

      // Datatables
      //Setting default values
      $.extend( $.fn.dataTable.defaults,{
        dom: '<"table-responsive" <t>>', // Table
        autoWidth: false
      });

      // Task list
      // Function Arguments: selector
      demo.datatablesTasklistInit('.panel-tasks .table');

      // Sales stats table
      // Function Arguments: selector, options
      var salesOptions = { order: [[1, 'desc']] };
      demo.datatablesInit('.panel-country-sales .table', salesOptions);

      // Sales stats pie chart ( When tab is shown )
      // Function Arguments: selector, data
      // Country sales data
      var countrySalesData = [
        { label : "USA", data: 40, color: "#5ebdec" },
        { label : "UK", data: 25, color: "#4ec27f" },
        { label : "Canada", data: 15, color: "#51c2cf" },
        { label : "France", data: 11, color: "#F9B56A" },
        { label : "Spain", data: 9, color: "#EE6567" },
      ];
      $('[href="#sales-chart-view"]').on('shown.bs.tab', $.proxy(demo.pieChartInit, null, '#chart-country-sales', countrySalesData));

      // Visitors activity
      // Function Arguments: selector
      demo.datatablesVisitorsActivityInit('.panel-visitors-activity .table');

      // Combined line chart
      // Function Arguments: selector, data1, label1, color1, data2, label2, color2
      // Users comparison data
      var usersData1 = [
        [new Date(2016, 0, 1).getTime(),4000],
        [new Date(2016, 1, 1).getTime(),4200],
        [new Date(2016, 2, 1).getTime(),5300],
        [new Date(2016, 3, 1).getTime(),5500],
        [new Date(2016, 4, 1).getTime(),5700],
        [new Date(2016, 5, 1).getTime(),5400],
        [new Date(2016, 6, 1).getTime(),6200],
        [new Date(2016, 7, 1).getTime(),4800],
        [new Date(2016, 8, 1).getTime(),5800],
        [new Date(2016, 9, 1).getTime(),6800],
        [new Date(2016, 10, 1).getTime(),6300],
        [new Date(2016, 11, 1).getTime(),5500],
        [new Date(2016, 12, 1).getTime(),5500],
      ];
      var usersData2 = [
        [new Date(2016, 0, 1).getTime(),3600],
        [new Date(2016, 1, 1).getTime(),3550],
        [new Date(2016, 2, 1).getTime(),4100],
        [new Date(2016, 3, 1).getTime(),4200],
        [new Date(2016, 4, 1).getTime(),4300],
        [new Date(2016, 5, 1).getTime(),4400],
        [new Date(2016, 6, 1).getTime(),5000],
        [new Date(2016, 7, 1).getTime(),4300],
        [new Date(2016, 8, 1).getTime(),4800],
        [new Date(2016, 9, 1).getTime(),5200],
        [new Date(2016, 10, 1).getTime(),5000],
        [new Date(2016, 11, 1).getTime(),4800],
        [new Date(2016, 12, 1).getTime(),4800],
      ];
      // Users comparison chart
      //demo.lineChartCombinedInit('#chart-users', usersData1, 'Non-Registered', '#5EBDEC', usersData2, 'Registered', '#4EC27F');

      // Easy pie chart
      // Function Arguments: selector
      demo.easyPieChartInit('.easy-pie-chart');

      // Calendar
      // Function Arguments: selector, events data
      // Events data
      var myDate = new Date();
      var currentYear = myDate.getFullYear();
      var currentMonth = myDate.getMonth() + 1;
      currentMonth = (currentMonth < 10) ? 0 + '' + currentMonth : currentMonth;
      var events = [
        {
          title: 'All Day Event',
          start: currentYear + '-' + currentMonth + '-01'
        },
        {
          title: 'Long Event',
          start: currentYear + '-' + currentMonth + '-07',
          end: currentYear + '-' + currentMonth + '-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: currentYear + '-' + currentMonth + '-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: currentYear + '-' + currentMonth + '-16T16:00:00'
        },
        {
          title: 'Conference',
          start: currentYear + '-' + currentMonth + '-11',
          end: currentYear + '-' + currentMonth + '-13'
        },
        {
          title: 'Meeting',
          start: currentYear + '-' + currentMonth + '-12T10:30:00',
          end: currentYear + '-' + currentMonth + '-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: currentYear + '-' + currentMonth + '-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: currentYear + '-' + currentMonth + '-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: currentYear + '-' + currentMonth + '-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: currentYear + '-' + currentMonth + '-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: currentYear + '-' + currentMonth + '-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: currentYear + '-' + currentMonth + '-28'
        }
      ]
      // Calendar
      demo.calendarInit('#calendar', events);

      // Event list
      // Function Arguments: selector
      demo.datatablesEventListInit('.panel-events .table');

      // Live search
      // Function Arguments: Selector, search input, parent selector, child selector
      demo.contentLiveSearchInit('.panel-tasks-comments', '#search-tasks-comments', '.media', 'div');
      demo.contentLiveSearchInit('.panel-activity-monitor', '#search-activity-monitor', '.media', 'div');
      demo.contentLiveSearchInit('.panel-lead-staff-activity', '#search-lead-staff-activity', '.media', 'div');
      demo.contentLiveSearchInit('.panel-requests', '#search-requests', '.media', 'div');

      // Custom scrollbar
      // Function Arguments: selector
      demo.slimscrollInit('.panel-tasks-comments .media-wrapper');
      demo.slimscrollInit('.panel-activity-monitor .media-wrapper');
      demo.slimscrollInit('.panel-lead-staff-activity .media-wrapper');
      demo.slimscrollInit('.panel-requests .media-wrapper');

      // Hide scrollbar when page is loaded
      $('.slimScrollBar').hide();
    },
    select2DropdownInit: function(el){
      //$(el).select2({
        //theme: 'bootstrap',
        //minimumResultsForSearch: Infinity
      //}).next('.select2-container--bootstrap').addClass('input-sm');
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
    tabdropInit: function(el){
      $.fn.tabdrop.defaults.text = '<i class="fa fa-angle-down"></i>';
      $(el).tabdrop();

      // Removing caret
      $('.tabdrop .caret').remove();
    },
//    lineChartInit: function(el, data, label, color, fillColor, highlightColor){
//      $.plot(el,
//        [{
//          data: data,
//          label: label,
//          color: color,
//          shadowSize: 0
//        }],
//        {
//          series: {
//            lines: {
//              show: true,
//              fill: true,
//              fillColor: fillColor
//            },
//            points: {
//              symbol: function cross(ctx, x, y, radius, shadow){
//                          ctx.arc(x, y, 4, 0, Math.PI*2, true);
//                          ctx.fillStyle = ctx.strokeStyle;
//                          ctx.lineWidth = 1;
//                          ctx.fill();
//                      }
//            }
//          },
//          xaxis: {
//            tickColor: "transparent",
//            mode: "time",
//            timeformat: "%b %Y"
//          },
//          yaxis: {
//            tickColor: "#f2f2f2",
//            max: 10000
//          },
//          legend: {
//            margin: [5, 10],
//            labelBoxBorderColor: color,
//            labelFormatter: function(label, series) {
//              // series is the series object for the label
//              return "<span class='m-left-5'>"+label+"</span>";
//            }
//          },
//          grid: {
//            hoverable: true,
//            borderWidth: 1,
//            borderColor: "#f2f2f2"
//          },
//          highlightColor: highlightColor,
//          tooltip: {
//            show: true,
//            content: "<span class='label' style='color: #fff; background-color: rgba(0,0,0,.6)'>%x = %y</span>",
//            shifts: {
//              x: -45
//            },
//            cssClass: "chart-tooltip",
//            defaultTheme: false
//          }
//        }
//      );
//    },
    pieChartInit: function(el, data){
      $.plot(el, data, {
        series: {
          pie: { 
            show: true,
            radius: 1,
            startAngle: 1,
            highlight: {
              opacity: .3
            },
            label: {
              show: true,
              radius: 55,
              formatter: function (label, series){
                return "<div class='chart-label'>"+Math.round(series.percent)+"%</div>";
              },
            }
          }
        },
        legend: {
          show: true
        },
        grid: {
          hoverable: true
        }
      });
    },
    lineChartCombinedInit: function(el, data1, label1, color1, data2, label2, color2){
      $.plot(el,
        [{
          data: data1,
          label: label1,
          color: color1,
          shadowSize: 0,
          highlightColor: color1
        },
        {
          data: data2,
          label: label2,
          color: color2,
          shadowSize: 0,
          highlightColor: color2
        }],
        {
          series: {
            lines: {
              show: true
            },
            
            points: {
              symbol: function circle(ctx, x, y, radius, shadow){
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
            labelBoxBorderColor: "#f6f6f6",
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
    easyPieChartInit: function(el){
      $(el).easyPieChart({
        onStep: function(from, to, percent){
          $(this.el).find('.percent').text(Math.round(percent))
        }
      });
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
    datatablesVisitorsActivityInit: function(el){
      $(el).dataTable({
        dom:  '<f>'+ // Top section structure(search etc.)
              '<"table-responsive" <t>>', // Table
        language: {
          search: '_INPUT_',
          searchPlaceholder: 'Search...'
        },
        order: [[1, 'desc']],
        initComplete: function(settings, json){
          var panel = $(this).closest('.panel');
          var searchInput = panel.find('.dataTables_filter .form-control');
          panel.find('.tools-content').append(searchInput);
          panel.find('.dataTables_filter').remove();
        }
      });
    },
    contentLiveSearchInit: function(container, searchField, selector, childSelector){
      $(container).searchable({
        searchField: searchField,
        selector: selector,
        childSelector: childSelector
      })
    },
    calendarInit: function(el, events){
      $(el).fullCalendar({
        header: {
          left: "prev,next,title",
          right: "today,month,agendaWeek,agendaDay"
        },
        buttonText: {
          today: 'Today',
          month: 'Month',
          week:  'Week',
          day:   'Day'
        },
        editable: true,
        eventLimit: true, // allow "more" link when too many events
        events: events
      });
    },
    datatablesEventListChildRow: function(el){
      // Dropdown table with extra info
      function eventsFormat(d){
        // `d` is the original data object for the row
        return  '<table class="table table-bordered">'+
                  '<tr>'+
                      '<td>Description:</td>'+
                      '<td>'+d.description+'</td>'+
                  '</tr>'+
                  '<tr>'+
                      '<td>Invited:</td>'+
                      '<td>'+d.invited+'</td>'+
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
        row.child( eventsFormat(row.data())).show();
        tr.addClass('shown');
      }
    },
    datatablesEventListInit: function(el){
      $(el).DataTable({
        ordering: false,
        ajax: 'event-list-data.txt',
        columns: [
          {
            className: 'details-control',
            render: function(data, type, full, meta){
              // Showing 2 values in one column
              return '<span class="block">'+full.title+'</span>'+'<span>'+full.date+'</span>';
            }
          },
          { defaultContent: '<button class="btn btn-default-outline">Cancel</button>' }
        ],
        initComplete: function(settings, json){
          // Add event listener for opening and closing details
          $(el).find('tbody').on('click', 'td.details-control', $.proxy(demo.datatablesEventListChildRow, null, $(el)));
        }
      });
    }
  };
  
  demo.init();
})(jQuery);