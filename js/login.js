document.addEventListener("DOMContentLoaded", function() {
  var loginButton = document.querySelector(".login");
  loginButton.addEventListener("click", function(event) {
    event.preventDefault();
    openLogin();
  });

  function openLogin() {
    var loginContainer = document.getElementById("loginContainer");
    var registerContainer = document.getElementById("registerContainer");
    loginContainer.style.display = "block";
    registerContainer.style.display = "none";

    // Hide the login error div
    var errorDiv = document.getElementById("loginError");
    if (errorDiv) {
      errorDiv.style.display = "none";
    }
  }

  function closeLogin() {
    var loginContainer = document.getElementById("loginContainer");
    loginContainer.style.display = "none";
  }

  function showSuccess(message) {
    var successDiv = document.getElementById("loginSuccess");
    if (!successDiv) {
      successDiv = document.createElement("div");
      successDiv.id = "loginSuccess";
      successDiv.className = "success";
      var loginForm = document.getElementById("loginForm");
      loginForm.parentNode.insertBefore(successDiv, loginForm.nextSibling);
    }
    successDiv.textContent = message;
    successDiv.style.display = "block";
  }

  function showError(errorMessage) {
    var errorDiv = document.getElementById("loginError");
    var successDiv = document.getElementById("loginSuccess");

    if (!errorDiv) {
      errorDiv = document.createElement("div");
      errorDiv.id = "loginError";
      errorDiv.className = "error";
      var loginForm = document.getElementById("loginForm");
      loginForm.parentNode.insertBefore(errorDiv, loginForm.nextSibling);
    }
    errorDiv.textContent = errorMessage;
    errorDiv.style.display = "block";

    // Clear any existing success message
    if (successDiv) {
      successDiv.style.display = "none";
    }
  }

  var loginForm = document.getElementById("loginForm");
  loginForm.addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission

    var emailInput = document.getElementById("email");
    var passwordInput = document.getElementById("password");

    // Simulating server-side validation and response
    var email = emailInput.value;
    var password = passwordInput.value;

    if (email === "" || password === "") {
      showError("Invalid email or password");
    } else {
      // Clear any existing error message
      var errorDiv = document.getElementById("loginError");
      if (errorDiv) {
        errorDiv.style.display = "none";
      }
      // For demonstration purposes, we'll log the form data
      console.log("Email: " + email);
      console.log("Password: " + password);

      // Simulating server response
      var response = { status: 'error', message: 'Invalid email or password' }; // Change this based on actual server response

      if (response.status === 'success') {
        showSuccess("Login successful"); // Show success message
        loginForm.reset(); // Reset the form
      } else {
        showError(response.message); // Show error message
      }
    }
  });
});
