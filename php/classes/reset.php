<?php

// Saul Maylin
// Reset Functionality
//  v1.0
//  08/07/2025

class Reset
{
    private $email;
    private $error;
    private $uid;

    public function __construct($email)
    {
        $this->email = $email;
    }

    public function checkEmail($DB)
    {
        // Check if the email is in database.
        $stmt = $DB->prepare("SELECT UID, email FROM crawlerAccounts WHERE email = ?");
        $stmt->bind_param("s", $this->email);

        if ($stmt->execute()) {
            $checkedEmail = null;
            $UID = null;

            // If the query is successful, store the result.
            $stmt->store_result();
            $stmt->bind_result($UID, $checkedEmail);
            $stmt->fetch(); // Fetch the result

            // Check if the email matches.
            if ($this->email == $checkedEmail) {
                $this->UID = $UID; // Set the UID for later use.
                $stmt->close();
                return true; // Email exists in the database.
            } else {
                $stmt->close();
                $this->error = 'NONE';
                return false; // Email does not exist in the database, but continue for security.
            }

        } else {
            // If the query fails, set the error and return false.
            $this->error = 'QUERY_FAILED';
            $stmt->close();
            return false;
        }

    }

    public function createResetRequest($DB)
    {
        // Get a random code for the reset request.
        $code = $this->generateRandomString(8);

        $stmt = $DB->prepare("INSERT INTO crawlerResets (UID, code) VALUES (?, '?');");
        $stmt->bind_param("is", $this->uid, $code);
        
        if ($stmt->execute()) {
            // If the query is successful, return the code.
            $stmt->close();
            $_SESSION['resetCode'] = $code;
            $this->error = 'NONE'; // No error
            return true;;
        } else {
            // If the query fails, set the error and return false.
            $this->error = 'QUERY_FAILED';
            $stmt->close();
            return false;
        }

    }


    // https://stackoverflow.com/questions/4356289/php-random-string-generator
    function generateRandomString($length)
    {
        // acceptable characters for the random string.
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // Length of the characters string to etermine the randomness.
        $charactersLength = strlen($characters);

        $randomString = '';

        // loop through the length of the list to generate a random string based on specified length.
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function getError()
    {
        return $this->error;
    }
}

?>