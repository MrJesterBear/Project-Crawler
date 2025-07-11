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
include('../classes/mailing.php');

// Check if the email is set.
if (isset($_POST['email'])) {
    $reset = new Reset($_POST['email']);

    // Check to see if email exists in database.
    if ($reset->checkEmail($DB)) {
        // if exists, create the request.
        if ($reset->createResetRequest($DB)) {
            // https://www.mailersend.com/blog/php-send-email#recommended-send-email-in-php-using-mailersend
            // Send the reset email using MailerSend (has to be installed on backend).

            // email subject
            $subject = 'Password Reset Request';
            
            // email body (html) and alt body (plain text).
            $body = '<h1>Password Reset Request for '.$reset->getEmail() . '</h1> <br>
            <p1> Your reset code is: ' . $_SESSION['resetCode'] . '</p1> <br> <br>
            <p1> This code is valid for 15 minutes.</p1> <br> <br>
            <p1> If you did not request this, please ignore this email.</p1>';
            
            $altBody = 'Password Reset Request for '.$reset->getEmail() . "\n" .
            'Your reset code is: ' . $_SESSION['resetCode'] . "\n" .
            'This code is valid for 15 minutes.' . "\n" .
            'If you did not request this, please ignore this email.';
            
            // Create a new mailing instance..
            $mailer = new Mailing($reset->getEmail(), $subject, $body, $altBody);

            if ($mailer->send()) {
                // If the email is sent successfully, return success.
                echo json_encode(array('error' => 'NONE'));
            } else {
                // If the email fails to send, return an error.
                echo json_encode(array('error' => 'MAIL_FAILED'));
            }

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