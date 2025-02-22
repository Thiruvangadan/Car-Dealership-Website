function toggleform() {
    var container = document.querySelector('.container');
    var section = document.querySelector('section');
    container.classList.toggle('active');
    section.classList.toggle('active');
}

var chec = document.getElementById("check");
var btnn = document.getElementById("btnactive");

document.getElementById('myform').addEventListener('submit', function (event) {
    var agreeCheckbox = document.getElementById('check');
    

    if (!agreeCheckbox.checked) {
        alert("Please agree to the terms and conditions");
        event.preventDefault(); 
    }
});

function checke() {
    if (chec.checked) {
        btnn.style.opacity = 1;
        btnn.style.cursor = "pointer";
        btnn.classList.add("btn1");
        btnn.classList.remove("btn2");
    }
    else {
        btnn.style.opacity = 0.5;
        btnn.style.cursor = "not-allowed";
        btnn.classList.remove("btn1");
        btnn.classList.add("btn2");
    }
}


function validateInput() {
      var input = document.getElementById('contact');
      var pattern = /[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$|^\d{10,}$/;
      const username = document.querySelector('#contact');

     
    if (!pattern.test(input.value)) {
        error(username,'Enter A Valid Email Or Phone Number');
        return false;
    }
    else{
        success(username);
    }
    return true;
}

function error(element,msg){
    element.style.border = '2px red solid';
    const parent = element.parentElement;
    const p = parent.querySelector('p');
    p.textContent = msg;
    p.style.visibility = 'visible';
}

function success(element){
    element.style.border = '2px solid rgba(255, 255, 255,0.2)';
    const parent = element.parentElement;
    const p = parent.querySelector('p');
    p.style.visibility = 'hidden';
}

document.addEventListener('DOMContentLoaded', function() {
    var blinkingText = document.querySelector('.blinking-text');

    // Add an event listener for the animation end
    blinkingText.addEventListener('animationend', function() {
      // Remove the animation after it completes
      blinkingText.style.animation = 'none';
    });
  });