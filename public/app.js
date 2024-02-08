/* Theme Name: 115
  Author: Themesdesign
  Version: 1.0.0
  File Description: Main JS file of the template
*/

// Show password input value

//timer function
const startingMinutes = 1;
let time = startingMinutes * 60;

const resendButton = document.getElementById('resendButton');
const countdownEl = document.getElementById('countdown');

// Store the interval ID
const intervalId = setInterval(updateCountdown, 1000);

function updateCountdown(){
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  seconds = seconds <5 ? '0' + seconds : seconds;

  countdownEl.innerHTML = `${minutes}:${seconds}`;
  time--;

  if(time === 0) {
            clearInterval(intervalId); 
            resendButton.disabled = false;
            countdownEl.innerHTML = "";
        }
}


document.getElementById('password-addon').addEventListener('click', function () {
	var passwordInput = document.getElementById("password-input");
	if (passwordInput.type === "password") {
		passwordInput.type = "text";
	} 
  else {
		passwordInput.type = "password";
	}
});

//two-step move next
function moveToNext(elem, count) {
    if (elem.value.length > 0) {
        document.getElementById("digit" + (count + 1) + "-input").focus();
    }
    else if (event.keyCode === 8 && elem.value.length === 0) { // Check if backspace key is pressed, input is empty, and it's not the first input
        document.getElementById("digit" + (count - 1) + "-input").focus(); // Move focus to the previous input field
    } 
  }


     //prevent form resubmission

    if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

