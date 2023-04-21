$(document).on("submit", "#videoComment_form", function(event)
{
  event.preventDefault();
  var id_video = $('input[name=id_video]').val();
  var submit_comment = $('#commentInput').val();

   $.ajax({

     type: "POST",
     url: 'resources/submitCommentVideo.php',
     data: {id_video: id_video, submit_comment: submit_comment},
     dataType: 'html',
     cache: false,
     beforeSend: function() {

    },
     success: function(data) {
           //
          $('#commentariesList').prepend(data);
          $('#commentInput').val('');
     },
      error: function(req, err){ console.log(err); }

   });

});
