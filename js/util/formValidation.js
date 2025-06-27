// Saul Maylin
// 27/06/2025
// v1.5
// Form Validation

function validateForm(event, form) {
  // Universal Variables
  const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

  let passValid = true;
  let usernameValid = true;
  let emailValid = true;

  let password;
  let username;
  let email;

  let passwordError;
  let usernameError;
  let emailError;

  switch (form) {
    case "register":
      password = document.getElementsByClassName("password")[1].value;
      username = document.getElementsByClassName("username")[0].value;
      email = document.getElementsByClassName("email")[1].value;

      passwordError = document.getElementsByClassName("passwordError")[1];
      usernameError = document.getElementsByClassName("usernameError")[0];
      emailError = document.getElementsByClassName("emailError")[1];

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
        const handler = new userFormHandling(email, username, password);
        handler.registerUser(); 
      } else {
        event.preventDefault();
      }
      break;

    case "login":
      password = document.getElementsByClassName("password")[0].value;
      email = document.getElementsByClassName("email")[0].value;

      passwordError = document.getElementsByClassName("passwordError")[0];
      emailError = document.getElementsByClassName("emailError")[0];

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

      // if true, form passes. if not, form fails.
      if (passValid && emailValid) {
        const handler = new userFormHandling(email, "", password);
        handler.loginUser(); 
      } else {
        event.preventDefault();
      }
      break;

    case "default":
      event.preventDefault();
      break;
  }
}
