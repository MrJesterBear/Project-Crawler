// Saul Maylin
// 28/06/2025
// v1.1
// Form handling for user registration and login.

class userFormHandling {
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
      success: function (response) {
        // what happens on success
        console.log("User registered successfully:", response);
        window.location.href = "./account.php";
      },
      error: function (xhr, status, error, response) {
        // what happens on error.
        console.error("Error registering user:", error, status);
        window.location.href = "./new-user.php?error=" + response;
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
      success: function(data) {
        console.log("Login response:", data);
        switch (data.error) {
          case 'NOT_FOUND': // User not found.
            window.location.href = "./new-user.php?error=NF";
            break;
          case 'DUP': // email or username already exists.
            window.location.href = "./new-user.php?error=DUP";
            break;
          case 'PASS': // Password incorrect.
            window.location.href = "./new-user.php?error=PASS";
            break;
          case 'REG': // Registration failed, server down?
            window.location.href = "./new-user.php?error=REG";
            break;
          case 'UID': // Failed UID check, server down?
            window.location.href = "./new-user.php?error=UID";
            break;
          case 'NULL': // No error, user logged in successfully
            window.location.href = "./account.php";
            break;
          default: // Unknown error
            window.location.href = "./new-user.php?error=UNKNOWN";
            break;
        }
      },
      error: function(xhr, status, error) {
        console.error("Error logging in user:", error, status);
        window.location.href = "./new-user.php?error=UNKNOWN";
      }
    });
  }
}
