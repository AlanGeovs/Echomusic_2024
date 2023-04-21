function removeBandMemberId(id)
{
  $('#removeBandMemberId').val(id);
}

function removeBandMember()
{
  var id = $('#removeBandMemberId').val();

   $.ajax({

     type: "POST",
     url: 'resources/removeBandMember.php',
     data: {id: id},
     dataType: 'html',
     cache: false,
     beforeSend: function() {
       $('#removeBandMemberButton').html("<div class='spinner-border' role='status'></div>");
       $('#removeBandMemberButton').addClass("isDisabled");
    },
     success: function(data) {
           //
          $('#removeBandMemberButton').removeClass("isDisabled");
          $('#removeBandMemberButton').html("Eliminar");
          if(data=='success'){
            alert("Miembro eliminado");
            $('#removeBandMemberModal .close').click();
            $("#bandMember_"+id).remove();
          }else if(data=='danger'){
            alert("Ha sucedido un error, por favor vuelve a intentarlo");
          }
     },
      error: function(req, err){ console.log(data); alert("Ha sucedido un error, vuelve a intentarlo");}

   });

}
