
function genreFollow()
{
  var valueGenre = $('#inputFollowGenre').val();

   $.ajax({

     type: "POST",
     url: 'resources/follow_genre.php',
     data: "follow_genre="+valueGenre,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#div-cities').html("<img src='images/loading.gif' />");
    },
     success: function(data) {
           //
          $('#followedGenres_list').append(data);
     },
      error: function(req, err){ console.log(data); }

   });

}
