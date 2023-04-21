$(document).on("submit", "#projectQuestion_form", function(event)
{
  event.preventDefault();
  var id_project = $('input[name=id_project]').val();
  var submit_question = $('#question_text').val();

   $.ajax({

     type: "POST",
     url: 'resources/submitQuestionProject.php',
     data: {id_project: id_project, submit_question: submit_question},
     dataType: 'html',
     cache: false,
     beforeSend: function() {

    },
     success: function(data) {
           //
          $('#questionsList').prepend(data);
          $('#question_text').val('');
     },
      error: function(req, err){ console.log(err); }

   });

});
