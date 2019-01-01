(function($) {
  "use strict";
  
  $(function(){
    /* initialize the external events
    -----------------------------------------------------------------*/
    
    $("#calendar-events .list-group-item").each(function(){
      // store data so the calendar knows to render an event upon drop
      $(this).data("event", {
        title: $.trim($(this).text()), // use the element's text as the event title
        stick: true // maintain when user navigates (see docs on the renderEvent method)
      });

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 999,
        revert: true,      // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });

    /* initialize the calendar
    -----------------------------------------------------------------*/
    var myDate = new Date();
    var currentYear = myDate.getFullYear();
    var currentMonth = myDate.getMonth() + 1;
    currentMonth = (currentMonth < 10) ? 0 + '' + currentMonth: currentMonth;


    $("#calendar").fullCalendar({
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
      droppable: true, // this allows things to be dropped onto the calendar
      drop: function() {
        // is the "remove after drop" checkbox checked?
        if ($("#drop-remove").is(":checked")) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }
      },
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: '4BB - 2 Planed, 3 Actual',
          url: 'http://localhost/production_planner_ui/ReportCalender/CalenderDetails',
          start: currentYear + '-' + currentMonth + '-01'
        },
        {
          title: 'BMK - 2 Planed, 3 Actual',
          url: 'http://localhost/production_planner_ui/ReportCalender/CalenderDetails',
          start: currentYear + '-' + currentMonth + '-07',
          end: currentYear + '-' + currentMonth + '-10'
        },
        
//        {
//          id: 999,
//          title: 'Repeating Event',
//          start: currentYear + '-' + currentMonth + '-09T16:00:00'
//        },
//        {
//          id: 999,
//          title: 'Repeating Event',
//          start: currentYear + '-' + currentMonth + '-16T16:00:00'
//        },
//        {
//          title: 'Conference',
//          start: currentYear + '-' + currentMonth + '-11',
//          end: currentYear + '-' + currentMonth + '-13'
//        },
        {
          title: 'DMAX - 1 Planed, 2 Actual',
          url: 'http://localhost/production_planner_ui/ReportCalender/CalenderDetails',
          start: currentYear + '-' + currentMonth + '-12',
          end: currentYear + '-' + currentMonth + '-12'
        },
        {
          title: 'DSP - 2 Planed, 1 Actual',
          url: 'http://localhost/production_planner_ui/ReportCalender/CalenderDetails',
          start: currentYear + '-' + currentMonth + '-12'
        },
        {
          title: 'UP - 1 Planed, 2 Actual',
          url: 'http://localhost/production_planner_ui/ReportCalender/CalenderDetails',
          start: currentYear + '-' + currentMonth + '-12'
        },
        
//        {
//          title: 'Click for Google',
//          url: 'http://google.com/',
//          start: currentYear + '-' + currentMonth + '-28'
//        }
      ]
    });
  })
})(jQuery);