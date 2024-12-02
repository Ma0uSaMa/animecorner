document.addEventListener("DOMContentLoaded", function () {
  var registerButton = document.querySelector(".register");
  var overlay = document.querySelector(".overlay");
  var registerContainer = document.querySelector("#registerContainer");

  // Check if elements exist before adding event listeners
  if (registerButton && overlay && registerContainer) {
    registerButton.addEventListener("click", function () {
      overlay.style.display = "none";
      registerContainer.style.display = "block";
    });

    overlay.addEventListener("click", function (event) {
      if (event.target === overlay) {
        overlay.style.display = "none";
        registerContainer.style.display = "none";
      }
    });
  } else {
    console.warn(
      "One or more elements (registerButton, overlay, registerContainer) are missing."
    );
  }

  // Receive messages from child window
  window.addEventListener("message", function (event) {
    var message = event.data;
    if (message.type === "registrationSuccess") {
      showToast("Registration successful", "success");
    }
  });
});
