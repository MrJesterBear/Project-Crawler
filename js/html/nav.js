// Saul Maylin 
// 30/04/2025
// v2.5
// Javascript HTML.

// Navbar Function.
import { checkCookie, setCookie } from "../util/cookies.js";

export function setNav() {
  // get nav element
  const nav = document.getElementsByClassName("nav")[0];

  // Sets the nav bar! Taken from Bootstrap and reformatted to fit the site.
  // https://getbootstrap.com/docs/5.3/components/navbar/

 
  // If the page is blogAdmin.php, then set the nav bar to have fixed links.
  if (document.URL.includes("blogAdmin.php")) {
    let navHTML =
    '<div class="container-fluid">' +
    '<a class="navbar-brand" href="../../index.html">The Local Theatre</a>' +
    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">' +
    '<span class="navbar-toggler-icon"></span>' +
    "</button>" +
    '<div class="collapse navbar-collapse" id="navbarNavDropdown">' +
    '<ul class="navbar-nav">' +
    '<li class="nav-item">' +
    '<a class="nav-link" aria-current="page" href="../../index.html">Home</a>' +
    "</li>" +
    '<li class="nav-item">' +
    '<a class="nav-link" href="../../blog.php">Blogs</a>' +
    "</li>" +
    '<li class="nav-item">' +
    '<a class="nav-link" href="../../about.html">About</a>' +
    "</li>" +
    '<li class="nav-item dropdown">' +
    '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>' +
    '<ul class="dropdown-menu">';

      // Checks if the user is logged in or not, then displays the correct links.
    if (checkNav()) {
      navHTML +=
        '<li><a class="dropdown-item" href="../../profile.php">Profile</a></li>' +
        '<li><a class="dropdown-item" href="../php/logout.php">Logout</a></li>';
    } else {
      navHTML +=
        '<li><a class="dropdown-item" href="../../login.php">Login</a></li>' +
        '<li><a class="dropdown-item" href="../../register.php">Register</a></li>';
    }

    navHTML += "</ul> </li> </ul> </div> </div>";
    nav.innerHTML = navHTML;

  } else { // otherwise, serve normal links.
    let navHTML =
    '<div class="container-fluid">' +
    '<a class="navbar-brand" href="index.html">The Local Theatre</a>' +
    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">' +
    '<span class="navbar-toggler-icon"></span>' +
    "</button>" +
    '<div class="collapse navbar-collapse" id="navbarNavDropdown">' +
    '<ul class="navbar-nav">' +
    '<li class="nav-item">' +
    '<a class="nav-link" aria-current="page" href="index.html">Home</a>' +
    "</li>" +
    '<li class="nav-item">' +
    '<a class="nav-link" href="blog.php">Blogs</a>' +
    "</li>" +
    '<li class="nav-item">' +
    '<a class="nav-link" href="about.html">About</a>' +
    "</li>" +
    '<li class="nav-item dropdown">' +
    '<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>' +
    '<ul class="dropdown-menu">';

      // Checks if the user is logged in or not, then displays the correct links.
    if (checkNav()) {
      navHTML +=
        '<li><a class="dropdown-item" href="profile.php">Profile</a></li>' +
        '<li><a class="dropdown-item" href="./php/logout.php">Logout</a></li>';
    } else {
      navHTML +=
        '<li><a class="dropdown-item" href="login.php">Login</a></li>' +
        '<li><a class="dropdown-item" href="register.php">Register</a></li>';
    }

    navHTML += "</ul> </li> </ul> </div> </div>";
    nav.innerHTML = navHTML;
  }
}

// Check if the cookie is set for logged in.
function checkNav() {
  if (!checkCookie("loggedIn")) {
    setCookie("loggedIn", 0, 30);
    return false;
  }

  if (checkCookie("loggedIn") == 1) {
    return true;
  }
}
