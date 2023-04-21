// Document is ready
  $(document).ready(function () {

  // Validate user first name
    $('#checkRegisterName_user').hide();
    let firstnameUserError = true;
    $('#inputRegisterName_user').keyup(function () {
      validatefirstnameUser();
    });

    function validatefirstnameUser() {
      let firstnameUserValue = $('#inputRegisterName_user').val();
      if (firstnameUserValue.length == '') {
        $('#checkRegisterName_user').show();
          firstnameUserError = false;
          return false;
      }
      else if((firstnameUserValue.length < 3)||(firstnameUserValue.length > 15)) {
        $('#checkRegisterName_user').show();
        $('#checkRegisterName_user').html
        ("El nombre debe tener mínimo 3 caracteres y máximo 15");
        firstnameUserError = false;
        return false;
      }
      else {
        $('#checkRegisterName_user').hide();
        firstnameUserError = true;
        return true;
      }
    }

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

  // Validate user last name
    $('#checkRegisterLastName_user').hide();
    let lastnameUserError = true;
    $('#inputRegisterLastName_user').keyup(function () {
      validatelastnameUser();
    });

    function validatelastnameUser() {
      let lastnameUserValue = $('#inputRegisterLastName_user').val();
      if (lastnameUserValue.length == '') {
        $('#checkRegisterLastName_user').show();
          lastnameUserError = false;
          return false;
      }
      else if((lastnameUserValue.length < 3)||(lastnameUserValue.length > 15)) {
        $('#checkRegisterLastName_user').show();
        $('#checkRegisterLastName_user').html
        ("El apellido debe tener mínimo 3 caracteres y máximo 15");
        lastnameUserError = false;
        return false;
      }
      else {
        $('#checkRegisterLastName_user').hide();
        lastnameUserError = true;
        return true;
      }
    }

  // Validate Password
    $('#checkRegisterPassword_user').hide();
    let passwordUserError = true;
    $('#inputRegisterPassword_user').keyup(function () {
      validatePasswordUser();
    });
    function validatePasswordUser() {
      let passwordUserValue = $('#inputRegisterPassword_user').val();
      if (passwordUserValue.length == '') {
        $('#checkRegisterPassword_user').show();
        passwordUserError = false;
        return false;
      }
      if ((passwordUserValue.length < 6)||(passwordUserValue.length > 20)) {
        $('#checkRegisterPassword_user').show();
        $('#checkRegisterPassword_user').html
  ("La contraseña debe tener entre 6 y 20 caracteres");
        $('#checkRegisterPassword_user').css("color", "red");
        passwordUserError = false;
        return false;
      } else {
        $('#checkRegisterPassword_user').hide();
        passwordUserError = true;
        return true;
      }
    }

  // Validate Confirm Password
    $('#checkRegisterVPassword_user').hide();
    let confirmPasswordUserError = true;
    $('#inputRegisterVPassword_user').keyup(function () {
      validateConfirmPasswrd();
    });
    function validateConfirmPasswrd() {
      let confirmPasswordUserValue = $('#inputRegisterVPassword_user').val();
      let passwordUserValue = $('#inputRegisterPassword_user').val();
      if (passwordUserValue != confirmPasswordUserValue) {
        $('#checkRegisterVPassword_user').show();
        $('#checkRegisterVPassword_user').html(
          "Las contraseñas no coinciden");
        confirmPasswordUserError = false;
        return false;
      } else {
        $('#checkRegisterVPassword_user').hide();
        confirmPasswordUserError = true;
        return true;
      }
    }

  // Submitt button
    $('#submit_button_user').click(function () {
      validatefirstnameUser();
      validatelastnameUser();
      validatePasswordUser();
      validateConfirmPasswrd();
      validateTermsConditions();
      if ((firstnameUserError == true) &&
        (lastnameUserError == true) &&
        (passwordUserError == true) &&
        (confirmPasswordUserError == true) &&
        (termsConditionsError == true)) {
        return true;
      } else {
        return false;
      }
    });

  });
