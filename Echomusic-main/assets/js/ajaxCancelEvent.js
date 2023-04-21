function cancelEventId(id, type)
{
  $('#cancelEventId').val(id);
  $('#cancelEventType').val(type);
}

function cancelEvent()
{
  var id = $('#cancelEventId').val();
  var type = $('#cancelEventType').val();
   $.ajax({

     type: "POST",
     url: 'resources/cancelEvent.php',
     data: {id: id, type: type},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#cancelEventButton').html("<div class='spinner-border' role='status'></div>");
       $('#cancelEventButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#cancelEventButton').removeClass("isDisabled");
          $('#cancelEventButton').html("Cancelar Evento");
          if(data=='success'){
            alert("Evento cancelado");
            $('#cancelEventModal .close').click();
            // $('#cancelEvent_'+id+'-'+type).addClass('isDisabled');
            // $('#cancelEvent_'+id+'-'+type).html('Cancelado');
            $('#cancelEvent_'+id+'-'+type).replaceWith(function(){
              return '<button class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelado</button>';
            });
            $('#publishedEvent_'+id+'-'+type).remove();
            $('#publishEvent_'+id+'-'+type).remove();
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
