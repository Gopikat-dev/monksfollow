/* Theme Name: 115
  Author: Themesdesign
  Version: 1.0.0
  File Description: Main JS file of the template
*/


//Ajax 
 $('#otp-spinner-container').hide(); 
 $(document).ready(function() {
    // Event listener for input fields
    $('.otp-input').on('input', function() {         
        checkFormFilled();
    });

    // Function to check if all fields are filled
    function checkFormFilled() {
        var allFilled = true;
        $('.otp-input').each(function() {
            if ($(this).val() === '') {
                allFilled = false;
                return false; // Exit the loop early if any field is empty
            }
        });
        
        if (allFilled) {
            submitForm();
        }
    }

    // Function to submit the form via AJAX
    function submitForm() {
        // Show the spinner
        $('#otp-spinner-container').show();
        // Serialize the form data
        var formData = $('#otpForm').serialize();

        // Send the serialized form data to the server for verification
      $.ajax({
    type: 'POST',
    url: '/verifyotp',
    data: formData, // Send the serialized form data
    dataType: 'json',
    success: function(response) {
        // Handle the response message
        $('#otp-response-message').text(response.message);
        $('#otp-response-message').removeClass('alert-danger').addClass('alert-success');
        window.location.href = '/dashboard'; 
    },
    error: function(xhr, status, error) {    
        // Reset all input fields
        $('.otp-input').val('');
        // Focus on the first input field
        $('#digit1-input').focus();
        // Update the error message in the view
        $('#otp-response-message').text(xhr.responseJSON.error);
        $('#otp-response-message').removeClass('alert-success').addClass('alert-danger');
    },
    complete: function() {
        $('#otp-spinner-container').hide(); // Hide the spinner after AJAX request is complete
    }
});


    }
});



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



