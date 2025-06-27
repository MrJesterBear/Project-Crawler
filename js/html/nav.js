// Saul Maylin
// 18/06/2025
// v1
// Javascript HTML.

// Navbar Function.
import { checkCookie, setCookie } from "../util/cookies.js";

export function setNav() {
  // get nav element
  const nav = document.getElementsByClassName("nav")[0];

  // Sets the nav bar! Taken from Bootstrap and reformatted to fit the site.
  // https://getbootstrap.com/docs/5.3/components/navbar/

  let navHTML =
    // Nav Container and Hamburger Menu
    '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">' +
    '<span class="navbar-toggler-icon"></span>' +
    "</button>" +
    '<div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">' +
    '<ul class="navbar-nav">' +

    // Account Link
    '<li class="nav-item px-5">' +
    '<a class="nav-link border" href="account.php">Account</a>' +
    "</li>" +

    // Character Link
    '<li class="nav-item px-5">' +
    '<a class="nav-link border" href="linkhere">Characters</a>' +
    "</li>" +

    // Campaign Link
    '<li class="nav-item px-5">' +
    '<a class="nav-link border" href="linkhere">Campaigns</a>' +
    "</li>" +

    // Donate Link
    '<li class="nav-item px-5">' +
    '<a class="nav-link border" href="https://ko-fi.com/thejesterbearrr">Donate</a>' +
    "</li>";

  // close up the nav and make inner html.
  navHTML += "</ul> </div>";
  nav.innerHTML = navHTML;
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


    // In here should be the logo with href to index page.
  //   '<div class="container-fluid">' +
  //   '<a class="navbar-brand" href="index.html">' +
  //     '<img src="https://getbootstrap.com/docs/5.3/assets/brand/bootstrap-logo.svg" alt="Bootstrap" width="30" height="24">' +
  //  ' </a>' +
  // '</div>' +