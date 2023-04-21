
function getEventsCalendar(dateChangeVar)
{
   $.ajax({

     type: "POST",
     url: 'resources/eventsDateCalendar.php',
     data: "date=" + dateChangeVar,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#calendarGeneral').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#calendarGeneral').html(data);
     },
      error: function(req, err){ console.log(data); }

   });

}

function getEventsCalendarFollow(dateChangeVar)
{
   $.ajax({

     type: "POST",
     url: 'resources/eventsDateCalendarFollow.php',
     data: "date=" + dateChangeVar,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#calendarFollows').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#calendarFollows').html(data);
     },
      error: function(req, err){ console.log(data); }

   });

}
function getDateCalendar(dateChangeVar)
{
   $.ajax({

     type: "POST",
     url: 'resources/dateCalendarChange.php',
     data: "date=" + dateChangeVar,
     dataType: 'html',
     cache: false,
     success: function(data) {
           //
          $('#dateTitle').html(data);
     },
      error: function(req, err){ console.log(data); }

   });

}
