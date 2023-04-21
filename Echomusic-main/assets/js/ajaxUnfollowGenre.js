function unfollowGenre(id)
{
  console.log(id);
   $.ajax({

     type: "POST",
     url: 'resources/unfollow_genre.php',
     data: "id=" + id,
     dataType: 'html',
     cache: false,
     beforeSend: function() {

    },
     success: function(data, status) {
          if(data == "success") {
            $("#genre-follow-"+id).remove();
          }
     },
     error: function(data){
       alert("Ha sucedido un error");
     },

   });

}
