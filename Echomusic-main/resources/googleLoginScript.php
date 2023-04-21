<? if(!isset($_SESSION['user'])): ?>
    <script>
      function onSuccess(googleUser) {
        // Useful data for your client-side scripts:
        var id_token = googleUser.getAuthResponse().id_token;
        var profile = googleUser.getBasicProfile();

        console.log(id_token);

        document.getElementById("googleID_token").value = googleUser.getAuthResponse().id_token;
        document.getElementById("first_name").value = profile.getGivenName();
        document.getElementById("last_name").value = profile.getFamilyName();
        document.getElementById("email").value = profile.getEmail();

        document.getElementById("googleID_token").form.submit();
      };

    </script>
<? endif; ?>

<script>
  function renderButton() {
    gapi.signin2.render('my-signin2', {
      'width': 240,
      'height': 50,
      'longtitle': true,
      'theme': 'dark',
      'onsuccess': onSuccess
      });
  }
</script>

<script>
  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
</script>

<!-- <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script> -->
<!-- <script src="https://apis.google.com/js/platform.js?hl=de" async defer></script> -->
<script src="https://apis.google.com/js/platform.js?onload=renderButton&hl=de" async defer></script>
