document.addEventListener("DOMContentLoaded", function() {
  var registerButton = document.querySelector(".register");
  var overlay = document.querySelector(".overlay");
  var registerContainer = document.querySelector("#registerContainer");

  registerButton.addEventListener("click", function() {
    overlay.style.display = "block";
    registerContainer.style.display = "block";
  });

  overlay.addEventListener("click", function(event) {
    if (event.target === overlay) {
      overlay.style.display = "none";
      registerContainer.style.display = "none";
    }
  });

  // Receive messages from child window
  window.addEventListener("message", function(event) {
    var message = event.data;
    if (message.type === "registrationSuccess") {
      showToast("Registration successful", "success");
    }
  });
});
