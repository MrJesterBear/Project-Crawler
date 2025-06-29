<?php

// ? Name:  Saul Maylin
// ? Date: 27/06/2025
// ? v1.1
// ? Project: Project Crawler
// ? Check or Register an Account

header('content-type: text/json');

include('../imports/error.php');

// Include the connection file & user class.
include('../imports/connection.php');
include('../classes/user.php');

// determine whether registering or logging in.

switch ($_GET['type']) {
    case 'register': // Registering a new user
        $user = new User($_POST['email'], $_POST['password']);
        $user->setUsername($_POST['username']);

        // Check if the user can register an account with the provided details.
        if (!$user->checkDuplicate($DB)) {
            // If the user can register, attempt to register the account.
            
            // Hash Password
            $user->createHashPassword($user->getPassword()); 
            
            if ($user->registerAccount($DB)) {
                // If successful, set the session variables.
                session_start();
                $_SESSION['UID'] = $user->getUID();
                $_SESSION['username'] = $user->getUsername();
                $_SESSION['email'] = $user->getEmail();

                // echo "Registration successful for user: " . $_SESSION['username'];
                echo json_encode((array('error' => "null")));

            } else {
                // If registration fails, throw an error.
                $error = $user->getError();
                echo json_encode((array('error' => $error)));
            }
        } else {
            // If the user cannot register, throw an error.
            $error = $user->getError();
            echo json_encode((array('error' => $error)));
        }

        break;
    case 'login': // Logging in an existing user
        // Create a new user object.
        $user = new User($_POST['email'], $_POST['password']);

        // Attempt to log in the user.
        if ($user->loginAccount($DB)) {
            // If successful, set the session variables.
            session_start();
            $_SESSION['UID'] = $user->getUID();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['email'] = $user->getEmail();

            echo json_encode((array('error' => "null")));

            // echo "Login successful for user: " . $_SESSION['username'];
        } else {
            $error = $user->getError();
            echo json_encode((array('error' => $error)));
        }
        break;
}

$DB->close(); // Close the database connection.

?>