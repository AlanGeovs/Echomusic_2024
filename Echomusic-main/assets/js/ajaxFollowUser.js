
function followUser(id)
{
   $.ajax({

     type: "POST",
     url: 'resources/followUser.php',
     data: "id=" + id,
     dataType: 'html',
     cache: false,
     beforeSend: function() {

    },
     success: function(data, status) {
          if(data == "success") {
            $('#follow_button').css("display", "none");
            $('#following_button').css("display", "inline");
          }
     },
     error: function(data){
       alert("Ha sucedido un error");
     },

   });

}

function unfollowUser(id)
{
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
            $('#follow_button').css("display", "inline");
            $('#following_button').css("display", "none");
          }
     },
     error: function(data){
       alert("Ha sucedido un error");
     },

   });

}
