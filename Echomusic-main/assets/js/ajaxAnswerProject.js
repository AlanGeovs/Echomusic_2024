function answerQuestion(id)
{

  var text = $('#answerInput_'+id).val();
  console.log(id);
  console.log(text);
   $.ajax({

     type: "POST",
     url: 'resources/answerQuestionProject.php',
     data: {id: id, text: text},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#answerButton_'+id).html("<div class='spinner-border' role='status'></div>");
       $('#answerButton_'+id).addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#answerButton_'+id).removeClass("isDisabled");
          $('#answerButton_'+id).html("Responder");
          if(data=='success'){
            alert("Pregunta respondida");
            $('#cancelEvent_'+id).replaceWith(function(){
              return '<button class="btn btn-primary m-1 col-sm-12 col-md-5 isDisabled">Respondido</button>';
            });
            $('#questionContainer_'+id).remove();
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }else if(data=='error'){
            alert("La respuesta es muy larga o posee caracteres no permitidos");
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
