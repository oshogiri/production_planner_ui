(function($){
  'use strict';

  var demo = {
    init: function(){
      // Icheck
      demo.icheckInit('input.icheck');

      // Function Argument: selector
      demo.datatablesInit('.table-ecommerce');

      // Function Argument: selector
      demo.select2DropdownInit('select');
    },
    select2DropdownInit: function(el){
      $(el).select2({
        theme: 'bootstrap',
        minimumResultsForSearch: Infinity,
        placeholder: ''
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
    pageReload: function(){
      location.reload();
    },
    datatablesInit: function(el){
      // Datatables
      //Setting default values
      $.extend( $.fn.dataTable.defaults,{ 
        dom: '<"row" <"col-sm-6" <"inline-block m-right-15" l><"inline-block" B> > <"col-sm-6" f> >'+
                 '<"row" <"col-sm-12" t> >'+
                 '<"row m-top-15" <"col-sm-6" i> <"col-sm-6" p> >',
        columnDefs:[{
          targets: [0, 6],
          orderable: false
        }],
        buttons: [{
          extend: 'collection',
          text: 'Export',
          className: 'btn-default-outline',
          buttons: ['copy', 'excel', 'csv', 'pdf', 'print']
        }],
        order: [ [1, 'desc'] ],
        pagingType: 'simple_numbers',
        language: {
          lengthMenu: '_MENU_',
          info: 'Showing page _PAGE_ of _PAGES_',
          infoEmpty: 'No records available',
          infoFiltered: '(From _MAX_ total records)',
          search: '_INPUT_',
          searchPlaceholder: 'Search...',
          paginate: {
            next:       '<i class="fa fa-angle-right"></i>',
            previous:   '<i class="fa fa-angle-left"></i>'
          },
        } 
      });

      $(el).DataTable({
        initComplete: function(settings, json){
          // After getting data inits iCheck
          demo.icheckInit('input.icheck');

          // If checkbox in <th> is checked, marking checked all checkboxes too
          $('.icheck').on('ifChecked', demo.datatablesIcheckChecked);

          // If checkbox in <th> is unchecked, marking unchecked all checkboxes too
          $('.icheck').on('ifUnchecked', demo.datatablesIcheckUnchecked);

          // Search
          $(el).DataTable().columns().every(function(){
            var that = this;

            // Search
            $('.form-control', this.footer()).on('keyup change', function(){
              if(that.search() !== this.value){
                that.search(this.value).draw();
              }
            });
          });

          var tfootLastTd =  $(el).find('tfoot td').eq($(el).find('tfoot td').length - 1);
          // Reloads the page
          tfootLastTd.on('click', demo.pageReload);
        }
      });
    }
  };
  
  demo.init();
})(jQuery);