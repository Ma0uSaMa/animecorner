// login.js
function openLogin(event) {
  event.preventDefault();
  var loginContainer = document.getElementById("loginContainer");
  var registerContainer = document.getElementById("registerContainer");
  loginContainer.style.display = "block";
  registerContainer.style.display = "none";

    var registerMessageDiv = document.getElementById("registrationMessage");
  var registerErrorDiv = document.getElementById("registrationError");
  if (registerMessageDiv) {
    registerMessageDiv.style.display = "none";
  }
  if (registerErrorDiv) {
    registerErrorDiv.style.display = "none";
  }
}

function closeLogin() {
  var loginContainer = document.getElementById("loginContainer");
  loginContainer.style.display = "none";
}

// login.js
function showError(errorMessage) {
  var errorDiv = document.getElementById("loginError");
  if (!errorDiv) {
    errorDiv = document.createElement("div");
    errorDiv.id = "loginError";
    errorDiv.className = "error";
    var loginForm = document.querySelector("#loginContainer form");
    loginForm.insertBefore(errorDiv, loginForm.firstChild);
  }
  errorDiv.textContent = errorMessage;
  errorDiv.style.display = "block";
}

function showMessage(message) {
  var messageDiv = document.getElementById("loginSuccess");
  if (!messageDiv) {
    messageDiv = document.createElement("div");
    messageDiv.id = "loginSuccess";
    messageDiv.className = "success";
    var loginForm = document.querySelector("#loginContainer form");
    loginForm.insertBefore(messageDiv, loginForm.firstChild);
  }
  messageDiv.textContent = message;
  messageDiv.style.display = "block";
}

function submitForm(event) {
  event.preventDefault(); // Prevent form submission

  var form = event.target;

  var formData = new FormData(form);

  fetch(form.action, {
    method: form.method,
    body: formData
  })
  .then(function(response) {
    if (response.status === 200) {
      return response.json();
    } else {
      throw new Error("An error occurred during form submission.");
    }
  })
  .then(function(data) {
    if (data.status === "success") {
      showMessage(data.message);
    } else {
      showError(data.message);
    }
  })
  .catch(function(error) {
    showError(error.message);
  });

  return false;
}

document.addEventListener("DOMContentLoaded", function () {
  var loginButton = document.querySelector(".login");
  if (loginButton) {
    loginButton.addEventListener("click", openLogin);
  }

  var loginForm = document.querySelector("#loginContainer form");
  if (loginForm) {
    loginForm.addEventListener("submit", submitForm);
  }

  var errorDiv = document.getElementById("loginError");
  if (errorDiv) {
    errorDiv.style.display = "none";
  }

  var messageDiv = document.getElementById("loginMessage");
  if (messageDiv) {
    messageDiv.style.display = "none";
  }
});
