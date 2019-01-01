(function($){
  'use strict';

  var demo = {
    init: function(){
      // Select2 dropdown
      demo.select2DropdownInit('.breadcrumb-wrapper select');

      // Daterangepicker
      // Function Arguments: selector
      demo.dateRangePickerInit('.page-title-wrapper .btn');

      // Tabdrop plugin for tabs inside .panel-heading
      demo.tabdropInit('.panel-heading .nav-tabs');

      // Line chart
      // Function Arguments: selector, data, label, color, fill color, point highlight color
      // Orders data
      var ordersData = [
        [new Date(2016, 0, 1).getTime(),3000],
        [new Date(2016, 1, 1).getTime(),2000],
        [new Date(2016, 2, 1).getTime(),2500],
        [new Date(2016, 3, 1).getTime(),4000],
        [new Date(2016, 4, 1).getTime(),4500],
        [new Date(2016, 5, 1).getTime(),3500],
        [new Date(2016, 6, 1).getTime(),3000],
        [new Date(2016, 7, 1).getTime(),2200],
        [new Date(2016, 8, 1).getTime(),4000],
        [new Date(2016, 9, 1).getTime(),4500],
        [new Date(2016, 10, 1).getTime(),4800],
        [new Date(2016, 11, 1).getTime(),5800],
        [new Date(2016, 12, 1).getTime(),5000]
      ];
      // Orders chart
      demo.lineChartInit('#chart-orders', ordersData, 'Sales', 'rgb(146, 219, 255)', 'rgba(146, 219, 255, .5)', '#62C6F8');

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
      demo.lineChartInit('#chart-expenses', expensesData, 'Expenses', 'rgb(255, 206, 153)', 'rgba(255, 206, 153, .5)', '#FDB05B');

      // Datatables
      //Setting default values
      $.extend( $.fn.dataTable.defaults,{
        dom: '<"table-responsive" <t>>', // Table
        autoWidth: false
      });

      // Datatables
      // Function Arguments: selector, options
      // Top Selling
      var optionsTopSelling = {
        columnDefs:[{
            targets: 3,
            orderable: false
        }]
      };
      demo.datatablesInit('.panel-top-selling .table', optionsTopSelling);

      // Most viewed
      var optionsMostViewed = {
        columnDefs:[{
            targets: 2,
            orderable: false
        }]
      };
      demo.datatablesInit('.panel-most-viewed .table', optionsMostViewed);

      // Products availability
      var optionsProductsAvailability = {
        order: [[2, 'desc']]
      };
      demo.datatablesInit('.panel-products-availability .table', optionsProductsAvailability);

      // Top Referrer
      var optionsTopReferrer = {
        order: [[2, 'desc']]
      };
      demo.datatablesInit('.panel-top-referrer .table', optionsTopReferrer);

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
      demo.lineChartCombinedInit('#chart-users', usersData1, 'Non-Registered', '#5EBDEC', usersData2, 'Registered', '#4EC27F');

      // Easy pie chart
      // Function Arguments: selector
      demo.easyPieChartInit('.easy-pie-chart');
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
    tabdropInit: function(el){
      $.fn.tabdrop.defaults.text = '<i class="fa fa-angle-down"></i>';
      $(el).tabdrop();

      // Removing caret
      $('.tabdrop .caret').remove();
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
    }
  };
  
  demo.init();
})(jQuery);