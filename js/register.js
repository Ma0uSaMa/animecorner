function openRegister(event) {
  event.preventDefault();
  var registerContainer = document.getElementById("registerContainer");
  var loginContainer = document.getElementById("loginContainer");
  loginContainer.style.display = "none";
  registerContainer.style.display = "block";

    var loginMessageDiv = document.getElementById("loginMessage");
  var loginErrorDiv = document.getElementById("loginError");
  if (loginMessageDiv) {
    loginMessageDiv.style.display = "none";
  }
  if (loginErrorDiv) {
    loginErrorDiv.style.display = "none";
  }
}


function closeRegister() {
  var registerContainer = document.getElementById("registerContainer");
  registerContainer.style.display = "none";
}

function showMessage(message) {
  var messageDiv = document.getElementById("registrationMessage");
  var errorDiv = document.getElementById("registrationError");
  var confirmPasswordErrorDiv = document.getElementById("confirmPasswordError");

  if (errorDiv) {
    errorDiv.style.display = "none"; // Hide error message
  }
  if (confirmPasswordErrorDiv) {
    confirmPasswordErrorDiv.style.display = "none";
  }

  if (!messageDiv) {
    messageDiv = document.createElement("div");
    messageDiv.id = "registrationMessage";
    messageDiv.className = "success";
    messageDiv.textContent = message;
    var registerForm = document.querySelector("#registerContainer form");
    registerForm.insertBefore(messageDiv, registerForm.firstChild);
  } else {
    messageDiv.style.display = "block";
    messageDiv.textContent = message;
  }
}

function showError(errorMessage) {
  var errorDiv = document.getElementById("registrationError");
  var messageDiv = document.getElementById("registrationMessage");
  var confirmPasswordErrorDiv = document.getElementById("confirmPasswordError");

  if (messageDiv) {
    messageDiv.style.display = "none"; // Hide success message
  }
  if (confirmPasswordErrorDiv) {
    confirmPasswordErrorDiv.style.display = "none";
  }

  if (!errorDiv) {
    errorDiv = document.createElement("div");
    errorDiv.id = "registrationError";
    errorDiv.className = "error";
    errorDiv.textContent = errorMessage;
    var registerForm = document.querySelector("#registerContainer form");
    registerForm.insertBefore(errorDiv, registerForm.firstChild);
  } else {
    errorDiv.style.display = "block";
    errorDiv.textContent = errorMessage;
  }
}

function showConfirmPasswordError() {
  var confirmPasswordErrorDiv = document.getElementById("confirmPasswordError");
  var messageDiv = document.getElementById("registrationMessage");
  var errorDiv = document.getElementById("registrationError");
  if (messageDiv) {
    messageDiv.style.display = "none";
  }
  if (errorDiv) {
    errorDiv.style.display = "none";
  }
  if (!confirmPasswordErrorDiv) {
    confirmPasswordErrorDiv = document.createElement("div");
    confirmPasswordErrorDiv.id = "confirmPasswordError";
    confirmPasswordErrorDiv.className = "error";
    confirmPasswordErrorDiv.textContent = "Passwords do not match";
    var confirmPasswordInput = document.querySelector("input[name='confirmpassword']");
    var confirmPasswordLabel = confirmPasswordInput.nextElementSibling;
    confirmPasswordInput.parentNode.insertBefore(confirmPasswordErrorDiv, confirmPasswordLabel.nextSibling);
  } else {
    confirmPasswordErrorDiv.style.display = "block";
  }
}

function submitForm(event) {
  event.preventDefault(); // Prevent form submission

  var form = event.target;
  var passwordInput = form.querySelector("input[name='password']");
  var confirmPasswordInput = form.querySelector("input[name='confirmpassword']");
  var password = passwordInput.value;
  var confirmPassword = confirmPasswordInput.value;

  if (password !== confirmPassword) {
    showConfirmPasswordError();
    return;
  }

  var formData = new FormData(form);

  fetch(form.action, {
    method: form.method,
    body: formData
  })
    .then(function(response) {
      if (response.status === 200) {
        return response.json();
      } else if (response.status === 409) {
        throw new Error("Email already exists.");
      } else {
        throw new Error("An error occurred during form submission.");
      }
    })
    .then(function(data) {
      console.log(data);
      if (data.status === "success") {
        if (window.opener) {
          window.opener.postMessage({ type: 'registrationSuccess' }, '*');
          window.close();
        } else {
          showMessage("Registration successful.");
        }
      } else {
        showError(data.message);
      }
    })
    .catch(function(error) {
      showError(error.message);
    });
}


document.addEventListener("DOMContentLoaded", function() {
  var registerButton = document.querySelector(".register");
  registerButton.addEventListener("click", openRegister);

  var registerForm = document.querySelector("#registerContainer form");
  registerForm.addEventListener("submit", submitForm);

  var errorDiv = document.getElementById("registrationError");
  if (errorDiv) {
    errorDiv.style.display = "none";
  }

  var messageDiv = document.getElementById("registrationMessage");
  if (messageDiv) {
    messageDiv.style.display = "none";
  }

  var confirmPasswordErrorDiv = document.getElementById("confirmPasswordError");
  if (confirmPasswordErrorDiv) {
    confirmPasswordErrorDiv.style.display = "none";
  }
});
