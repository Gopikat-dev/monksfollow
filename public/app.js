/* Theme Name: 115
  Author: Themesdesign
  Version: 1.0.0
  File Description: Main JS file of the template
*/



//timer function
function startTimer(duration, display) {
        var timer = duration, minutes, seconds;
        var timerInterval = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            display.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                clearInterval(timerInterval); // Clear the interval when timer reaches 0
                document.getElementById('timerContainer').style.display = 'none'; // Hide the timer container
                document.getElementById('resendButton').removeAttribute('hidden'); // Show the resend button
            }
        }, 1000);
    }

    window.onload = function () {
        var fiveMinutes = 60 * 1,
            display = document.querySelector('#time');
        startTimer(fiveMinutes, display);
    };



// Show password input value

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
    // Check if the current input field is not empty and if there's a next input field
    if (elem.value.length > 0 && document.getElementById("digit" + (count + 1) + "-input")) {
        var nextInput = document.getElementById("digit" + (count + 1) + "-input");
        nextInput.focus();
        nextInput.setSelectionRange(0, nextInput.value.length); // Select the entire value in the next input field
    }
    else if (event.keyCode === 8 && elem.value.length === 0 && count > 1) { // Check if backspace key is pressed, input is empty, and it's not the first input
        var prevInput = document.getElementById("digit" + (count - 1) + "-input");
        if (prevInput) {
            prevInput.focus(); // Move focus to the previous input field
        }
    } 
}

