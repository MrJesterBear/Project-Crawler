<?php

// ? Name:  Saul Maylin
// ? Date: 08/07/2025
// ? v1
// ? Project: Project Crawler
// ? Create Reset Password Request

header('content-type: text/json');
session_start();

include('../imports/error.php');

// Include the connection file & reset class.
include('../imports/connection.php');
include('../classes/reset.php');

// Check if the email is set.
if (isset($_POST['email'])) {
    $reset = new Reset($_POST['email']);

    // Check to see if email exists in database.
    if ($reset->checkEmail($DB)) {
        // if exists, create the request.
        if ($reset->createResetRequest($DB)) {
            // https://www.mailersend.com/blog/php-send-email#recommended-send-email-in-php-using-mailersend
            // Send the reset email using MailerSend (has to be installed on backend).

            

            // return success.
            echo json_encode(array('error' => $reset->getError()));
        } else {
            // If the request fails, return an error.
            echo json_encode(array('error' => $reset->getError()));
        }

    } else {
        // If the email does not exist, return an error.
        echo json_encode(array('error' => $reset->getError()));
    }
} else {
    // If the email is not set, return an error.
    echo json_encode(array('error' => 'NO_EMAIL'));
}

// Close all open connections.
$DB->close();
?>