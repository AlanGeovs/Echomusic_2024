
function changeGenres(valueGenre)
{
  // var valueGenre = $('#dropdownGenres').val();
  // var valueGenre = $(this).attr('rel')
  console.log(valueGenre);
   $.ajax({

     type: "POST",
     url: 'resources/changeGenres.php',
     data: "genre="+valueGenre,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#selectSubgenero').html("<div class='spinner-border' role='status'></div>");
    },
     success: function(data) {
           //
          $('#selectSubgenero').html(data);
     },
      error: function(req, err){ console.log(data); }

   });

}
