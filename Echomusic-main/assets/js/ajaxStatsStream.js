function showStreamStats()
{
  var id = $('#statsStreamingId').val();
   $.ajax({

     type: "POST",
     url: 'resources/statsStreaming.php',
     data: {id: id},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#statsStreamingContainer').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#statsStreamingContainer').html(data);
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}

function showPublicStats()
{
  var id = $('#statsPublicId').val();
   $.ajax({

     type: "POST",
     url: 'resources/statsPublic.php',
     data: {id: id},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#statsStreamingContainer').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#statsStreamingContainer').html(data);
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
