$('.showTrackRemove').click(function(){
  var parent = $(this).closest('.track_list_item'); // find closest sub_page
  $('.th-track-remove', parent).hide();
  $('.th-track-confirmation', parent).show();
});

$('.hideTrackRemove').click(function(){
  var parent = $(this).closest('.track_list_item'); // find closest sub_page
  $('.th-track-remove', parent).show();
  $('.th-track-confirmation', parent).hide();
});

function removeTrack(id)
{
  console.log(id);
   $.ajax({

     type: "POST",
     url: 'resources/remove_track.php',
     data: "id=" + id,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $("#track_button_item-"+id).html("<div class='spinner-border' role='status'></div>");
       $("#track_button_item-"+id).addClass("isDisabled");
    },
     success: function(data, status) {
       // console.log(data);
          if(data == "success") {
            $("#track_list_item-"+id).remove();
          }
     },
     error: function(data){
       alert("Ha sucedido un error");
     },

   });

}
