// Document is ready
  $(document).ready(function () {

  // Validate artist first name
    // $('#checkRegisterName_artist').hide();
    // let firstnameArtistError = true;
    // $('#inputRegisterName_artist').keyup(function () {
    //   validatefirstnameArtist();
    // });

    // function validatefirstnameArtist() {
    //   let firstnameArtistValue = $('#inputRegisterName_artist').val();
    //   if (firstnameArtistValue.length == '') {
    //     $('#checkRegisterName_artist').show();
    //       firstnameArtistError = false;
    //       return false;
    //   }
    //   else if((firstnameArtistValue.length < 3)||(firstnameArtistValue.length > 15)) {
    //     $('#checkRegisterName_artist').show();
    //     $('#checkRegisterName_artist').html
    //     ("El nombre debe tener mínimo 3 caracteres y máximo 15");
    //     firstnameArtistError = false;
    //     return false;
    //   }
    //   else {
    //     $('#checkRegisterName_artist').hide();
    //     firstnameArtistError = true;
    //     return true;
    //   }
    // }

    // Terms and conditions
    function validateTermsConditions() {
      if ($('#defaultCheck1').prop('checked')) {
          termsConditionsError = true;
          return true;
      }
      else {
        termsConditionsError = false;
        $('#defaultCheck1Label').addClass('font-weight-bold');
        alert("Debes aceptar los términos y condiciones");
        return false;
      }
    }

  // Validate artist last name
    // $('#checkRegisterLastName_artist').hide();
    // let lastnameArtistError = true;
    // $('#inputRegisterLastName_artist').keyup(function () {
    //   validatelastnameArtist();
    // });

    // function validatelastnameArtist() {
    //   let lastnameArtistValue = $('#inputRegisterLastName_artist').val();
    //   if (lastnameArtistValue.length == '') {
    //     $('#checkRegisterLastName_artist').show();
    //       lastnameArtistError = false;
    //       return false;
    //   }
    //   else if((lastnameArtistValue.length < 3)||(lastnameArtistValue.length > 15)) {
    //     $('#checkRegisterLastName_artist').show();
    //     $('#checkRegisterLastName_artist').html
    //     ("El apellido debe tener mínimo 3 caracteres y máximo 15");
    //     lastnameArtistError = false;
    //     return false;
    //   }
    //   else {
    //     $('#checkRegisterLastName_artist').hide();
    //     lastnameArtistError = true;
    //     return true;
    //   }
    // }

  // Validate Password
  //   $('#checkRegisterPassword_artist').hide();
  //   let passwordArtistError = true;
  //   $('#inputRegisterPassword_artist').keyup(function () {
  //     validatePasswordArtist();
  //   });
  //   function validatePasswordArtist() {
  //     let passwordArtistValue = $('#inputRegisterPassword_artist').val();
  //     if (passwordArtistValue.length == '') {
  //       $('#checkRegisterPassword_artist').show();
  //       passwordArtistError = false;
  //       return false;
  //     }
  //     if ((passwordArtistValue.length < 6)||(passwordArtistValue.length > 20)) {
  //       $('#checkRegisterPassword_artist').show();
  //       $('#checkRegisterPassword_artist').html
  // ("La contraseña debe tener entre 6 y 20 caracteres");
  //       $('#checkRegisterPassword_artist').css("color", "red");
  //       passwordArtistError = false;
  //       return false;
  //     } else {
  //       $('#checkRegisterPassword_artist').hide();
  //       passwordArtistError = true;
  //       return true;
  //     }
  //   }

  // Validate Confirm Password
    // $('#checkRegisterVPassword_artist').hide();
    // let confirmPasswordArtistError = true;
    // $('#inputRegisterVPassword_artist').keyup(function () {
    //   validateConfirmPasswrd();
    // });
    // function validateConfirmPasswrd() {
    //   let confirmPasswordArtistValue = $('#inputRegisterVPassword_artist').val();
    //   let passwordArtistValue = $('#inputRegisterPassword_artist').val();
    //   if (passwordArtistValue != confirmPasswordArtistValue) {
    //     $('#checkRegisterVPassword_artist').show();
    //     $('#checkRegisterVPassword_artist').html(
    //       "Las contraseñas no coinciden");
    //     confirmPasswordArtistError = false;
    //     return false;
    //   } else {
    //     $('#checkRegisterVPassword_artist').hide();
    //     confirmPasswordArtistError = true;
    //     return true;
    //   }
    // }

  // Submitt button
    $('#submitEvent').click(function () {
      // validatefirstnameArtist();
      // validatelastnameArtist();
      // validatePasswordArtist();
      // validateConfirmPasswrd();
      validateTermsConditions();
      if ((termsConditionsError == true)) {
        return true;
      } else {
        return false;
      }
    });

  });
