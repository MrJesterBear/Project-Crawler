// Saul Maylin
// 07/01/2025
// Version 1.0
// Cookies

// Set a cookie with a name, value and when should expire
export function setCookie(cname, cvalue, exdays) {
  
// creates a new date.
  let d = new Date();
  d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);

  //creates the time/date string for the cookie
  let expires = "expires=" + d.toUTCString();

  // construct cookie string
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

// Get a cookie using the cookie name.
export function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");

  // loop to decode the cookie.
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }

    // if the cookie is found return the value
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }

  // if cookie is not found return an empty string
  return "";
}

export function checkCookie(cname, type) {
  let value = getCookie(cname);
  
  // If the type of cookie is nav, reverse the function so it works correctly lol.
  if (type = "nav") {
    if (value == 1) {
        return true;
    } else
    return false;
  }
  
  if (value != "") {
    return true;
  } else {
    return false;
  }
}

