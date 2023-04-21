
function ticketsDownloadId(id)
{

   $.ajax({
     type: "POST",
     url: 'resources/downloadTickets.php',
     data: {id: id},
     dataType: 'html',
     cache: false,
     beforeSend: function() {

    },
     success: function(data) {

            $('#ticketsDownloadId').html(data);

     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
