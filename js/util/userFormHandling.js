// Saul Maylin
// 28/06/2025
// v1.1
// Form handling for user registration and login.

class userFormHandling {
  // Blueprint Variables.
  username;
  email;
  password;


  constructor(email, username, password) {
    this.email = email;
    this.username = username;
    this.password = password;
  }

  registerUser() {
    $.ajax({
      type: "POST", // Type of request
      url: "./php/server/account-check.php?type=register", // Where request is sent
      data: {
        // Post Variables
        email: this.email,
        username: this.username,
        password: this.password,
      },
      success: function (data) {
        // When the php file has been executed succesfully.
        console.log("register response:", data);
        switch (data.error) {
          case "NOT_FOUND": // User not found.
            window.location.href = "./new-user.php?error=NF";
            break;
          case "DUP": // email or username already exists.
            window.location.href = "./new-user.php?error=DUP";
            break;
          case "PASS": // Password incorrect.
            window.location.href = "./new-user.php?error=PASS";
            break;
          case "REG": // Registration failed, server down?
            window.location.href = "./new-user.php?error=REG";
            break;
          case "UID": // Failed UID check, server down?
            window.location.href = "./new-user.php?error=UID";
            break;
          case "NONE": // No error, user logged in successfully
            window.location.href = "./account.php";
            break;
          default: // Unknown error
            // window.location.href = "./new-user.php?error=UNKNOWN";
            break;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error registering in user:", error, status);
        window.location.href = "./new-user.php?error=UNKNOWN";
      },
    });
  }

  loginUser() {
    $.ajax({
      url: "./php/server/account-check.php?type=login",
      type: "POST",
      data: {
        email: this.email,
        password: this.password,
      },
      success: function (data) {
        console.log("Login response:", data);
        switch (data.error) {
          case "NOT_FOUND": // User not found.
            window.location.href = "./new-user.php?error=NF";
            break;
          case "DUP": // email or username already exists.
            window.location.href = "./new-user.php?error=DUP";
            break;
          case "PASS": // Password incorrect.
            window.location.href = "./new-user.php?error=PASS";
            break;
          case "REG": // Registration failed, server down?
            window.location.href = "./new-user.php?error=REG";
            break;
          case "UID": // Failed UID check, server down?
            window.location.href = "./new-user.php?error=UID";
            break;
          case "NONE": // No error, user logged in successfully
            window.location.href = "./account.php";
            break;
          default: // Unknown error
            window.location.href = "./new-user.php?error=UNKNOWN";
            break;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error logging in user:", error, status);
        window.location.href = "./new-user.php?error=UNKNOWN";
      },
    });
  }

  resetUser() {
  // Form for when a code is sent.
    inputCode = [
      '<div class = "border col-md mx-5">',
        '<form id="resetCodeForm" class="form-horizontal" onsubmit="return validateCode()">',
          '<div class = "mb-3">',
            '<label for="resetCode" class="form-label">Reset Code</label>',
            '<input type="text" class="form-control" id="resetCode" name="resetCode" placeholder="Enter the reset code" required>',
          '</div>',
        '</form>',
      '</div>'
    ]

    // Ajax Request to send the reset code.
    $.ajax({
      url: "./php/server/reset-user.php",
      type: "POST",
      data: {
        email: this.email,
      },
      success: function (data) {
        console.log("Login response:", data);
        switch (data.error) {
          case "NO_EMAIL": // Form was not filled out correctly.
            window.location.href = "./forgot-password.php?error=NO_EMAIL";
            break;
          case "QUERY_FAILED": // Query did not complete. Server down?
            window.location.href = "./forgot-password.php?error=QUERY_FAILED";
            break;
          case "MAIL_FAILED": // Mail could not be sent.
            window.location.href = "./forgot-password.php?error=MAIL_FAILED";
            break;
          case "NONE": // No error, continue.
            // Change the page layout to show the page asking for the reset code.
            console.log("Reset code sent successfully.");
            document.getElementById("resetFormContainer").innerHTML = '';

            // Add the reset code form to the page.
            inputCode.forEach((line) => {
              document.getElementById("resetFormContainer").innerHTML += line;
            });
            
            break;
          default: // Unknown error
            window.location.href = "./forgot-password.php?error=UNKNOWN";
            break;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error logging in user:", error, status);
        window.location.href = "./new-user.php?error=UNKNOWN";
      },
    });
  }

  validateCode() {
    // Validate the reset code.
    const resetCode = document.getElementById("resetCode").value;

    // Ajax Request to validate the reset code.
    $.ajax({
      url: "./php/server/check-code.php",
      type: "POST",
      data: {
        resetCode: resetCode,
      },
      success: function (data) {
        console.log("Reset code response:", data);
        switch (data.error) {
          case "NO_CODE": // Form was not filled out correctly.
            window.location.href = "./forgot-password.php?error=NO_CODE";
            break;
          case "CODE_FAILED": // Code is incorrect.
            // Show an error message to the user.
            break;
          case "NONE": // Code is correct, redirect to reset password page.
            window.location.href = "./reset-password.php";
            break;
          default: // Unknown error, show error.
            break;
        }
      },
      error: function (xhr, status, error) {
        console.error("Error validating reset code:", error, status);
        window.location.href = "./forgot-password.php?error=UNKNOWN";
      },
    });

    return false; // Prevent form submission
  }
}
