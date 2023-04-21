
function likeMultimedia(id)
{
   $.ajax({

     type: "POST",
     url: 'resources/multi_like.php',
     data: "id=" + id,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#event_detail').html("<img src='images/loading.gif' />");
    },
     success: function(data) {
           //
          $('#like_button').css("display", "none");
          $('#liked_button').css("display", "block");
          $('#countLikes1').html(data);
          $('#countLikes2').html(data);
     },
     error: function(data){
       alert("Ha sucedido un error");
     },

   });

}

function unlikeMultimedia(id)
{
   $.ajax({

     type: "POST",
     url: 'resources/multi_unlike.php',
     data: "id=" + id,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#event_detail').html("<img src='images/loading.gif' />");
    },
     success: function(data) {
           //
          $('#like_button').css("display", "block");
          $('#liked_button').css("display", "none");
          $('#countLikes1').html(data);
          $('#countLikes2').html(data);
     },
     error: function(data){
       alert("Ha sucedido un error");
     },

   });

}
