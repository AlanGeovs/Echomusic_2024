function unfollowArtistDashboard(id)
{
  console.log(id);
   $.ajax({

     type: "POST",
     url: 'resources/unfollowUser.php',
     data: "id=" + id,
     dataType: 'html',
     cache: false,
     beforeSend: function() {

    },
     success: function(data, status) {
          if(data == "success") {
            $("#artist-follow-"+id).remove();
          }
     },
     error: function(data){
       alert("Ha sucedido un error");
     },

   });

}
