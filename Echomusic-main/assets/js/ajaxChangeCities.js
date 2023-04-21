
function changeCities()
{
  var valueRegion = $('#inputRegion').val();

   $.ajax({

     type: "POST",
     url: 'resources/changeCities.php',
     data: "region="+valueRegion,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       
    },
     success: function(data) {
           //
          $('#inputCity').html(data);
     },
      error: function(req, err){ console.log(data); }

   });

}
