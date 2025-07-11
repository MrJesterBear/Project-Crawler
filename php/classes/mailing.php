<?php

// ? Name:  Saul Maylin
// ? Date: 11/07/2025
// ? v1
// ? Project: Project Crawler
// ? Send Password Reset Email

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailing
{

    private $recipient;
    private $subject;
    private $body;
    private $mailer;
    private $error;
    private $altBody;

    public function __construct($recipient, $subject, $body, $altBody)
    {
        require '../../vendor/autoload.php';
        require '../imports/env.php';

        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->body = $body;

        // Create a new PHPMailer instance
        $this->mailer = new PHPMailer(true);
    }

    public function send()
    {
        try {
            //Server settings
            $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->mailer->isSMTP();                                            //Send using SMTP
            $this->mailer->Host = $_ENV['SMTP_HOST'];                     //Set the SMTP server to send through
            $this->mailer->SMTPAuth = true;                                   //Enable SMTP authentication
            $this->mailer->Username = $_ENV['SMTP_USER'];                     //SMTP username
            $this->mailer->Password = $_ENV['SMTP_PASS'];                               //SMTP password
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $this->mailer->Port = $_ENV['SMTP_PORT'];                                    // SMTP Port

            //Recipients
            $this->mailer->setFrom('no-reply@crawler.saulmaylin.com', 'Project Crawler');
            $this->mailer->addAddress($this->recipient);               //Name is optional

            //Content
            $this->mailer->isHTML(true);                                  //Set email format to HTML
            $this->mailer->Subject = $this->subject; // Subject of the email
            $this->mailer->Body = $this->body; // HTML body"; 

            $this->mailer->AltBody = $this->altBody; // Body for non-html clients

            $this->mailer->send();
            echo 'Message has been sent';
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
            return false;
        }
    }
}