
function changeInboxEvents()
{
  var valueMonth = $('#dropdownMonth').val();
  var valueYear = $('#dropdownYear').val();

  var fechaSeleccionada = valueYear + '-' + valueMonth + '-10';
  var opciones = { year: 'numeric', month: 'long'};
  var fecha = new Date(fechaSeleccionada)
  .toLocaleDateString('es',opciones)

   $.ajax({

     type: "POST",
     url: 'resources/changeInboxEvents.php',
     data: {month: valueMonth, year: valueYear},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#event_listTableBody').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#event_listTableBody').html(data);
          // $('#title_thisMonth').html(fecha);
     },
      error: function(req, err){ console.log(data); }

   });

}

function changePublicEvents()
{
  var valueMonth = $('#monthEventsSelect').val();
  var valueYear = $('#yearEventsSelect').val();

  var fechaSeleccionada = valueYear + '-' + valueMonth + '-10';
  var opciones = { year: 'numeric', month: 'long'};
  var fecha = new Date(fechaSeleccionada)
  .toLocaleDateString('es',opciones)

   $.ajax({

     type: "POST",
     url: 'resources/changePublicEvents.php',
     data: {month: valueMonth, year: valueYear},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#public_listTableBody').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#public_listTableBody').html(data);
          // $('#title_thisMonth').html(fecha);
     },
      error: function(req, err){ console.log(data); }

   });

}
