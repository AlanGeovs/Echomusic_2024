function publishProject()
{

   $.ajax({

     type: "POST",
     url: 'resources/publishProject.php',
     data: {publishProject: 'submit'},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#publishProjectButton').html("<div class='spinner-border' role='status'></div>");
       $('#publishProjectButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#publishProjectButton').removeClass("isDisabled");
          $('#publishProjectButton').html("Publicar Proyecto");
          if(data=='success'){
            alert("Proyecto Publicado");
            $('#publishProjectModal .close').click();
            $('#if_publish_text').remove();
            $('#publishProject').replaceWith(function(){
              return '<button id="#publishedProject" class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Publicado</button>';
            });
            $('#projectEdit').replaceWith(function(){
              return '<button class="btn btn-outline-secondary m-1 col-sm-12 col-md-5 isDisabled">Editar Crowdfunding</button>';
            });
            $('#projectUpdate').replaceWith(function(){
              return '<a id="projectUpdate" href="avance_proyecto.php" class="btn btn-primary m-2">Publicar Avance</a>';
            });
            $('#statusContainer').html(function(){
              return '<a class="en-proceso">En proceso</a>';
            });

          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }else if(data=='dataNotReady'){
            alert('Debes primero ingresar tus datos en "Mi Cuenta" antes publicar un proyecto.');
          }else if(data=='dataProject-danger'){
            alert('Faltan datos para poder publicar, por favor revisa la información en "Editar Crowdfunding".');
          }else if(data=='incomplete-danger'){
            alert('Alguna de las recompensas está incompleta. Por favor revisa los datos y vuelve a intentarlo.');
          }else if(data=='missing-danger'){
            alert('No hay recompensas configuradas para este proyecto.');
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
