$(document).on("click", "#projectEditMain_submit", function(event)
{
  event.preventDefault();
  var prTitle = $('#prTitle_Input').val();
  var prCategory = $('#prCategory_Input').val();
  var prRegion = $('#prRegion_Input').val();
  var prDescription = $('#prDescription_Input').val();

   $.ajax({

     type: "POST",
     url: 'resources/crowdfunding/functionEditProject.php',
     data: {prTitle: prTitle, prCategory: prCategory, prRegion: prRegion, prDescription: prDescription},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
        $('#projectEditMain_submit').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class=''>Subiendo...</span>");
        $('#projectEditMain_submit').addClass("isDisabled");
        $('#projectEditMain_submit').attr('disabled','disabled');
    },
     success: function(data) {

          $('#projectEditMain_submit').removeClass("isDisabled");
          $('#projectEditMain_submit').html("Guardar");
          $('#projectEditMain_submit').removeAttr('disabled');

          if(data=='success'){
            alert("Información agregada con éxito");
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor revisa la información y vuelve a intentarlo");
          }else if(data=='nonEdit-danger'){
            alert("Ha sucedido un error, este proyecto no puede ser editado.");
          }else if(data=='nonDesc-danger'){
            alert("Ha sucedido un error, la descripción no cumple con los caracteres requeridos.");
          }
     },
      error: function(req, err){ console.log(data);
      alert("Ha sucedido un error, vuelve a intentarlo");
      $('#projectEditMain_submit').removeClass("isDisabled");
      $('#projectEditMain_submit').html("Guardar");
      $('#projectEditMain_submit').removeAttr('disabled');

    }
   });

});

$(document).on("click", "#projectEditAmount_submit", function(event)
{
  event.preventDefault();
  var prAmount = $('#prAmount_Input').val();
  var prRecTime = $('#prRecTime_Input').val();
  var prExecTime = $('#prExecTime_Input').val();

   $.ajax({

     type: "POST",
     url: 'resources/crowdfunding/functionEditProject.php',
     data: {prAmount: prAmount, prRecTime: prRecTime, prExecTime: prExecTime},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
        $('#projectEditAmount_submit').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class=''>Subiendo...</span>");
        $('#projectEditAmount_submit').addClass("isDisabled");
        $('#projectEditAmount_submit').attr('disabled','disabled');
    },
     success: function(data) {

          $('#projectEditAmount_submit').removeClass("isDisabled");
          $('#projectEditAmount_submit').html("Guardar");
          $('#projectEditAmount_submit').removeAttr('disabled');

          if(data=='success'){
            alert("Información agregada con éxito");
            $('#li-monto-tab').removeClass("d-none");
            $('#li-multimedia-tab').removeClass("d-none");
            $('#li-recompensas-tab').removeClass("d-none");
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor revisa la información y vuelve a intentarlo");
          }else if(data=='nonEdit-danger'){
            alert("Ha sucedido un error, este proyecto no puede ser editado.");
          }
     },
      error: function(req, err){ console.log(data);
      alert("Ha sucedido un error, vuelve a intentarlo");
      $('#projectEditAmount_submit').removeClass("isDisabled");
      $('#projectEditAmount_submit').html("Guardar");
      $('#projectEditAmount_submit').removeAttr('disabled');

    }
   });

});

$(document).on("click", "#saveProjectVideo", function(event)
{
  event.preventDefault();
  var prVideoURL = $('#prVideoURL_Input').val();
   $.ajax({

     type: "POST",
     url: 'resources/crowdfunding/functionEditProject.php',
     data: {prVideoURL: prVideoURL},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
        $('#saveProjectVideo').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class=''>Subiendo...</span>");
        $('#saveProjectVideo').addClass("isDisabled");
        $('#saveProjectVideo').attr('disabled','disabled');
    },
     success: function(data) {
          var data = data.split(",");

          $('#saveProjectVideo').removeClass("isDisabled");
          $('#saveProjectVideo').html("Guardar video");
          $('#saveProjectVideo').removeAttr('disabled');

          if(data[0]=='success'){
            alert("Video agregado con éxito");
            $('#li-monto-tab').removeClass("d-none");
            $('#li-multimedia-tab').removeClass("d-none");
            $('#li-recompensas-tab').removeClass("d-none");
            if(data[2]=='youtube'){
              $('#editProjectVideoContainer').html('<iframe style="width: 100%;height: 50vh;" src="https://www.youtube.com/embed/'+data[1]+'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
            }else if(data[2]=='vimeo'){
              $('#editProjectVideoContainer').html('<iframe style="width: 100%;height: 50vh;" src="https://player.vimeo.com/video/'+data[1]+'" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>');
            }
          }else if(data[0]=='danger'){
            alert("Ha sucedido un error, por favor revisa la información y vuelve a intentarlo");
          }else if(data[0]=='nonEdit-danger'){
            alert("Ha sucedido un error, este proyecto no puede ser editado.");
          }
     },
      error: function(req, err){ console.log(data);
      alert("Ha sucedido un error, vuelve a intentarlo");
      $('#saveProjectVideo').removeClass("isDisabled");
      $('#saveProjectVideo').html("Guardar video");
      $('#saveProjectVideo').removeAttr('disabled');

    }
   });

});

$(document).on("click", "#prTiers_submit", function(event)
{
  event.preventDefault();

  let k = [];
  var prNameTier_1 = $('#prNameTier_1').val();
  var prAmountTier_1 = $('#prAmountTier_1').val();
  var prDescTier_1 = $('#prDescTier_1').val();
  var input_1 = document.getElementsByName('input_array_nameRem1[]');

  for (var i = 0; i < input_1.length; i++) {
    var a = input_1[i];
    k[i] = a.value;
  }

  var tReward_1_01 = k[0];
  var tReward_1_02 = k[1];
  var tReward_1_03 = k[2];
  var tReward_1_04 = k[3];

  let k_2 = [];
  var prNameTier_2 = $('#prNameTier_2').val();
  var prAmountTier_2 = $('#prAmountTier_2').val();
  var prDescTier_2 = $('#prDescTier_2').val();
  var input_2 = document.getElementsByName('input_array_nameRem2[]');

  for (var i = 0; i < input_2.length; i++) {
    var a = input_2[i];
    k_2[i] = a.value;
  }

  var tReward_2_01 = k_2[0];
  var tReward_2_02 = k_2[1];
  var tReward_2_03 = k_2[2];
  var tReward_2_04 = k_2[3];

  let k_3 = [];
  var prNameTier_3 = $('#prNameTier_3').val();
  var prAmountTier_3 = $('#prAmountTier_3').val();
  var prDescTier_3 = $('#prDescTier_3').val();
  var input_3 = document.getElementsByName('input_array_nameRem3[]');

  for (var i = 0; i < input_3.length; i++) {
    var a = input_3[i];
    k_3[i] = a.value;
  }

  var tReward_3_01 = k_3[0];
  var tReward_3_02 = k_3[1];
  var tReward_3_03 = k_3[2];
  var tReward_3_04 = k_3[3];

  let k_4 = [];
  var prNameTier_4 = $('#prNameTier_4').val();
  var prAmountTier_4 = $('#prAmountTier_4').val();
  var prDescTier_4 = $('#prDescTier_4').val();
  var input_4 = document.getElementsByName('input_array_nameRem4[]');

  for (var i = 0; i < input_4.length; i++) {
    var a = input_4[i];
    k_4[i] = a.value;
  }

  var tReward_4_01 = k_4[0];
  var tReward_4_02 = k_4[1];
  var tReward_4_03 = k_4[2];
  var tReward_4_04 = k_4[3];

  let k_5 = [];
  var prNameTier_5 = $('#prNameTier_5').val();
  var prAmountTier_5 = $('#prAmountTier_5').val();
  var prDescTier_5 = $('#prDescTier_5').val();
  var input_5 = document.getElementsByName('input_array_nameRem5[]');

  for (var i = 0; i < input_5.length; i++) {
    var a = input_5[i];
    k_5[i] = a.value;
  }

  var tReward_5_01 = k_5[0];
  var tReward_5_02 = k_5[1];
  var tReward_5_03 = k_5[2];
  var tReward_5_04 = k_5[3];


   $.ajax({

     type: "POST",
     url: 'resources/crowdfunding/functionEditProject.php',
     data: {prNameTier_1: prNameTier_1, prAmountTier_1: prAmountTier_1, prDescTier_1: prDescTier_1, tReward_1_01: tReward_1_01, tReward_1_02: tReward_1_02, tReward_1_03: tReward_1_03, tReward_1_04: tReward_1_04,
            prNameTier_2: prNameTier_2, prAmountTier_2: prAmountTier_2, prDescTier_2: prDescTier_2, tReward_2_01: tReward_2_01, tReward_2_02: tReward_2_02, tReward_2_03: tReward_2_03, tReward_2_04: tReward_2_04,
            prNameTier_3: prNameTier_3, prAmountTier_3: prAmountTier_3, prDescTier_3: prDescTier_3, tReward_3_01: tReward_3_01, tReward_3_02: tReward_3_02, tReward_3_03: tReward_3_03, tReward_3_04: tReward_3_04,
            prNameTier_4: prNameTier_4, prAmountTier_4: prAmountTier_4, prDescTier_4: prDescTier_4, tReward_4_01: tReward_4_01, tReward_4_02: tReward_4_02, tReward_4_03: tReward_4_03, tReward_4_04: tReward_4_04,
            prNameTier_5: prNameTier_5, prAmountTier_5: prAmountTier_5, prDescTier_5: prDescTier_5, tReward_5_01: tReward_5_01, tReward_5_02: tReward_5_02, tReward_5_03: tReward_5_03, tReward_5_04: tReward_5_04,
            prTiersSubmit: 'submit'},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
        $('#prTiers_submit').html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class=''>Subiendo...</span>");
        $('#prTiers_submit').addClass("isDisabled");
        $('#prTiers_submit').attr('disabled','disabled');
    },
     success: function(data) {

          $('#prTiers_submit').removeClass("isDisabled");
          $('#prTiers_submit').html("Guardar");
          $('#prTiers_submit').removeAttr('disabled');

          if(data=='success'){
            alert("Recompensas guardadas con éxito");
            $('#li-monto-tab').removeClass("d-none");
            $('#li-multimedia-tab').removeClass("d-none");
            $('#li-recompensas-tab').removeClass("d-none");
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor revisa la información y vuelve a intentarlo");
          }else if(data=='nonEdit-danger'){
            alert("Ha sucedido un error, este proyecto no puede ser editado.");
          }
     },
      error: function(req, err){ console.log(data);
      alert("Ha sucedido un error, vuelve a intentarlo");
      $('#prTiers_submit').removeClass("isDisabled");
      $('#prTiers_submit').html("Guardar");
      $('#prTiers_submit').removeAttr('disabled');

    }
   });

});
