function getEvents(id, type)
{
   $.ajax({

     type: "POST",
     url: 'resources/eventsDataUser.php',
     data: {id: id, type: type},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#event_detail_container').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#event_detail_container').html(data);
     },
      error: function(req, err){ console.log(data); }

   });

}

function getPublicEvents(id, type)
{
   $.ajax({

     type: "POST",
     url: 'resources/eventsDataUser.php',
     data: {id: id, type: type},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#detalleEventoStream').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#detalleEventoStream').html(data);
          $('#streamingEventId').val(id);
          $('#invitation_id').val(id);
     },
      error: function(req, err){ console.log(data); }

   });

}
