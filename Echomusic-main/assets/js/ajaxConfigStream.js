function configYoutubeURL()
{
  var id = $('#streamingEventId').val();
  var url = $('#youtubeURL').val();
   $.ajax({

     type: "POST",
     url: 'resources/configStreaming.php',
     data: {id: id, url: url},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#youtubeURLButton').html("<div class='spinner-border' role='status'></div>");
       $('#youtubeURLButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#youtubeURLButton').removeClass("isDisabled");
          $('#youtubeURLButton').html("Guardar URL");
          if(data=='success'){
            alert("URL agregada con éxito");
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}

function configVimeoURL()
{
  var id = $('#streamingEventId').val();
  var url = $('#vimeoURL').val();
  var chat = $('#vimeoChat').val();
   $.ajax({

     type: "POST",
     url: 'resources/configStreaming.php',
     data: {id: id, url: url, chat: chat},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#vimeoURLButton').html("<div class='spinner-border' role='status'></div>");
       $('#vimeoURLButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#vimeoURLButton').removeClass("isDisabled");
          $('#vimeoURLButton').html("Guardar URL");
          if(data=='success'){
            alert("URL agregada con éxito");
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}

function configZoomURL()
{
  var id = $('#streamingEventId').val();
  var url = $('#zoomURL').val();
   $.ajax({

     type: "POST",
     url: 'resources/configStreaming.php',
     data: {id: id, url: url},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#zoomURLButton').html("<div class='spinner-border' role='status'></div>");
       $('#zoomURLButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#zoomURLButton').removeClass("isDisabled");
          $('#zoomURLButton').html("Guardar URL");
          if(data=='success'){
            alert("URL agregada con éxito");
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
