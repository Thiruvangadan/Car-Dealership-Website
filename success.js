
function countdown() {
    var seconds = 2; 
    var countdownDisplay = document.getElementById('countdown');
    var countdownInterval = setInterval(function() {
      countdownDisplay.innerHTML = seconds;
      seconds--;
      if (seconds < 0) {
        clearInterval(countdownInterval); 
        window.location.href = '../Register-login/Register-login.php'; 
      }
    }, 1000); 
  }
