<?php

// Saul Maylin
// User Functionality
//  v1.0
//  27/06/2025

class User
{
    private $email;
    private $username;
    private $password;
    private $passwordHash;

    private $UID;
    private $status;
    private $error = "NONE";

    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function registerAccount($DB)
    {
        // Prepare
        $stmt = $DB->prepare("INSERT INTO crawlerAccounts (email, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $this->email, $this->username, $this->passwordHash);

        // Execute
        if ($stmt->execute()) { // success

            // Prepare statement to get the UID of the newly created account.
            $stmt2 = $DB->prepare("SELECT UID FROM crawlerAccounts WHERE email = ? AND username = ?");
            $stmt2->bind_param("ss", $this->email, $this->username);

            // if the result is successful, get the ID.
            if ($stmt2->execute()) {
                $stmt2->store_result();
                $UID = null;

                $stmt2->fetch(); // Fetch the result

                $stmt2->bind_result($UID);
                $this->UID = $UID;
            } else { // Failed to retrieve UID, query failed.
                $this->error = 'UID';
                $stmt->close();
                $stmt2->close();
                return false;
            }

            // Continues on.
            $stmt->close();
            $stmt2->close();
            return true; // Registration successful
        } else {
            // Failed to register user, query failed.
            $this->error = 'REG';
            $stmt->close();
            return false; // Registration failed

        }
    }

    public function loginAccount($DB)
    {
        // Prepare statement to check if the user exists.
        $stmt = $DB->prepare("SELECT UID, username, email, password FROM crawlerAccounts WHERE email = ?;");
        $stmt->bind_param("s", $this->email);

        // Execute

        if ($stmt->execute()) {
            $stmt->store_result();

            $UID = null;
            $username = null;
            $email = null;
            $passwordHash = null;

            $stmt->bind_result($UID, $username, $email, $passwordHash);
            if ($stmt->fetch()) { // User found
                $this->UID = $UID;
                $this->username = $username;
                $this->email = $email;
                $this->passwordHash = $passwordHash;

                // Verify password
                if ($this->verifyPassword($this->password, $passwordHash)) {
                    $stmt->close();
                    return true; // Login successful
                } else {
                    $this->error = 'PASS'; // Incorrect password
                    $stmt->close();
                    return false; // Login failed
                }
            } else {
                $this->error = 'NOT_FOUND'; // User not found
                $stmt->close();
                return false; // Login failed
            }

        }
    }

    public function checkDuplicate($DB)
    {
        // Check if the email or username already exists in the database.
        $stmt = $DB->prepare("SELECT * FROM crawlerAccounts WHERE email = ? OR username = ?");
        $stmt->bind_param("ss", $this->email, $this->username);

        // execute statement
        $stmt->execute();
        $stmt->store_result();
        $stmt->fetch();

        if ($stmt->num_rows > 0) {
            $stmt->close();
            $this->error = 'DUP';
            return true; // Duplicate found
        } else {
            $stmt->close();
            return false; // No duplicate
        }
    }

    // Set password hash
    public function createHashPassword($password)
    {
        $this->passwordHash = $this->hash($password);
    }

    // hash given password using PHP's password hashing function.
    public function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Verify the given password against the hashed version of the password.
    public function verifyPassword($password, $hash)
    {

        return password_verify($password, $hash);
    }

    // Getters / Setters
    public function getUID()
    {
        return $this->UID;
    }

    public function setUID($UID)
    {
        $this->UID = $UID;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getError()
    {
        return $this->error;
    }


    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    
}

?>