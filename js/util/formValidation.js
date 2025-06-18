// Saul Maylin
// 14/01/2025
// v1
// Form Validation

function validateForm(event, form) {
  // Universal Variables

  passValid = true;
  usernameValid = true;

  const password = document.getElementById("password").value;
  const username = document.getElementById("username").value;

  const passwordError = document.getElementById("passwordError");
  const usernameError = document.getElementById("usernameError");

  switch (form) {
    case "register":
      const email = document.getElementById("email").value;
      const emailError = document.getElementById("emailError");
      emailValid = true;

      //? Email Validation
      // ! Empty Field
      if (email === "") {
        emailValid = false;

        // Display error message
        emailError.textContent =
          "An email must be provided to register an account! please try again.";
        emailError.style.color = "red";
      }
      // ! Email Format
      const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      if (!emailPattern.test(email) && email !== "") {
        emailValid = false;

        // Display error message
        emailError.textContent =
          "The email address provided is not valid! Please ensure that it ends in a domain. E.G '@gmail.com'";
        emailError.style.color = "red";
      }

      // if valid, clear error
      if (emailValid) {
        emailError.textContent = "";
      }

      //? Password Validation
      // ! Empty Field
      if (password === "") {
        passValid = false;

        // Error Message
        passwordError.textContent = "Password must be filled out to proceed";
        passwordError.style.color = "red";
      }

      // if valid, clear error
      if (passValid) {
        passwordError.textContent = "";
      }

      //? Username Validation
      if (username === "") {
        usernameValid = false;

        // Error Message
        usernameError.textContent = "Username must be filled out to proceed";
        usernameError.style.color = "red";
      }

      if (usernameValid) {
        usernameError.textContent = "";
      }

      // if true, form passes. if not, form fails.
      if (passValid && emailValid && usernameValid) {
        return true;
      } else {
        event.preventDefault();
      }
      break;

    case "login":

      //? Password Validation
      // ! Empty Field
      if (password === "") {
        passValid = false;

        // Error Message
        passwordError.textContent = "Password must be filled out to proceed";
        passwordError.style.color = "red";
      }

      // if valid, clear error
      if (passValid) {
        passwordError.textContent = "";
      }

      //? Username Validation
      if (username === "") {
        usernameValid = false;

        // Error Message
        usernameError.textContent = "Username must be filled out to proceed";
        usernameError.style.color = "red";
      }

      if (usernameValid) {
        usernameError.textContent = "";
      }

      // if true, form passes. if not, form fails.
      if (passValid && usernameValid) {
        return true;
      } else {
        event.preventDefault();
      }
      break;

    case "default":
      event.preventDefault();
      break;
  }
}
