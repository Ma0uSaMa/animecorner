function openLogin(event) {
  event.preventDefault();
  var loginContainer = document.getElementById("loginContainer");
  var registerContainer = document.getElementById("registerContainer");
  loginContainer.style.display = "block";
  registerContainer.style.display = "none";
}

function closeLogin() {
  var loginContainer = document.getElementById("loginContainer");
  loginContainer.style.display = "none";
}

function showError(errorMessage) {
  var errorDiv = document.getElementById("loginError");
  if (!errorDiv) {
    errorDiv = document.createElement("div");
    errorDiv.id = "loginError";
    errorDiv.className = "error";
    var loginForm = document.getElementById("loginForm");
    loginForm.parentNode.insertBefore(errorDiv, loginForm.nextSibling);
  }
  errorDiv.textContent = errorMessage;
  errorDiv.style.display = "block";
}

function showSuccess(successMessage) {
  var successDiv = document.getElementById("loginSuccess");
  if (!successDiv) {
    successDiv = document.createElement("div");
    successDiv.id = "loginSuccess";
    successDiv.className = "success";
    var loginForm = document.getElementById("loginForm");
    loginForm.parentNode.insertBefore(successDiv, loginForm.nextSibling);
  }
  successDiv.textContent = successMessage;
  successDiv.style.display = "block";

  // Clear any existing error message
  var errorDiv = document.getElementById("loginError");
  if (errorDiv) {
    errorDiv.style.display = "none";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var loginButton = document.querySelector(".login");
  loginButton.addEventListener("click", openLogin);

  var loginForm = document.getElementById("loginForm");
  loginForm.addEventListener("submit", function (event) {
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
      fetch("/animecorner/user/auth/users_dbfetch.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ email: email, password: password }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status === "success") {
            showSuccess("Login successful"); // Show success message
            loginForm.reset(); // Reset the form
          } else {
            showError(data.message); // Show error message
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showError("An unexpected error occurred");
        });
    }
  });
});
