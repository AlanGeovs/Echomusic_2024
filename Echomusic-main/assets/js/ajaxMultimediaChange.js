function changeVideo(id)
{
   $.ajax({

     type: "POST",
     url: 'resources/multimediaChange_script.php',
     data: "id="+id,
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#videoContainerSection').html("<img src='images/loading.gif' />");
    },
     success: function(data) {
           //
          $('#videoContainerSection').html(data);
     },
      error: function(req, err){ console.log(err); }

   });

}
