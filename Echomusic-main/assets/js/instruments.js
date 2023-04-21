// Show instruments
function showInstruments(musician) {
      options = musician.children;
      if (options['3'].selected) {
          document.getElementById("instrument").style.display = "block";
      } else {
          document.getElementById("instrument").style.display = "none";
      }

}
