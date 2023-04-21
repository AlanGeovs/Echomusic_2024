function cancelProject()
{

   $.ajax({

     type: "POST",
     url: 'resources/cancelProject.php',
     data: {cancelProject: 'submit'},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#cancelProjectButton').html("<div class='spinner-border' role='status'></div>");
       $('#cancelProjectButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#cancelProjectButton').removeClass("isDisabled");
          $('#cancelProjectButton').html("Cancelar Proyecto");
          if(data=='success'){
            alert("Proyecto cancelado");
            $('#cancelProjectModal .close').click();
            $('#cancelProject').replaceWith(function(){
              return '<button class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Cancelado</button>';
            });
            $('#publishProject').remove();
            $('#publishedProject').remove();
            $('#if_publish_text').remove();
            $('#projectUpdate').replaceWith(function(){
              return '<button class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Publicar Avance</button>';
            });
            $('#projectEdit').replaceWith(function(){
              return '<button class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Editar Crowdfunding</button>';
            });
            $('#statusContainer').html(function(){
              return '<a class="cerrado-nok">Cancelado</a>';
            });
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
