function publishEventId(id, type)
{
  $('#publishEventId').val(id);
  $('#publishEventType').val(type);
}

function publishEvent()
{
  var id = $('#publishEventId').val();
  var type = $('#publishEventType').val();
   $.ajax({

     type: "POST",
     url: 'resources/publishEvent.php',
     data: {id: id, type: type},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#publishEventButton').html("<div class='spinner-border' role='status'></div>");
       $('#publishEventButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#publishEventButton').removeClass("isDisabled");
          $('#publishEventButton').html("Publicar Evento");
          if(data=='success'){
            alert("Evento Publicado");
            $('#publishEventModal .close').click();
            // $('#publishEvent_'+id+'-'+type).addClass('isDisabled');
            // $('#publishEvent_'+id+'-'+type).html('publicado');
            $('#publishEvent_'+id+'-'+type).replaceWith(function(){
              return '<button id="#publishedEvent_'+id+'-'+type+'" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Publicado</button>';
            });

          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }else if(data=='dataNotReady'){
            alert('Debes primero ingresar tus datos en "Mi Cuenta" antes publicar un evento.');
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
