function removeVideoId(id)
{
  $('#removeVideoId').val(id);
}

function removeVideo()
{
  var id = $('#removeVideoId').val();

   $.ajax({

     type: "POST",
     url: 'resources/removeVideo.php',
     data: {id: id},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#removeVideoButton').html("<div class='spinner-border' role='status'></div>");
       $('#removeVideoButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#removeVideoButton').removeClass("isDisabled");
          $('#removeVideoButton').html("Eliminar");
          if(data=='success'){
            alert("Video eliminado");
            $('#removeVideoModal .close').click();
            $("#video_"+id).remove();
            location.reload(true);
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
