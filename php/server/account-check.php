<!-- ? Name:  Saul Maylin
? Date: 27/06/2025
? v1
? Project: Project Crawler
? Check or Register an Account
-->
    <?php 

    // include ('../imports/error.php');

    // Include the connection file & user class.
    include ('../imports/connection.php');
    include ('../imports/user.php');

    // determine whether registering or logging in.

    switch($_GET['type']) {
        case 'register': // Registering a new user
            $user = new User($_POST['email'], $_POST['password']);
            $user->setUsername($_POST['username']);

            // Check if the user can register an account with the provided details.
            if ($user->checkDuplicate($DB)) {
                // If the user can register, attempt to register the account.
                if ($user->registerAccount($DB)) {
                    // If successful, set the session variables.
                    session_start();
                    $_SESSION['UID'] = $user->getUID();
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['email'] = $user->getEmail();

                    echo "Registration successful for user: " . $_SESSION['username'];
                } else {
                    // If registration fails, throw an error.
                    throw new Exception($user->getError());
                }
            } else {
                // If the user cannot register, throw an error.
                throw new Exception($user->getError());
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

                echo "Login successful for user: " . $_SESSION['username'];
            } else {
                throw new Exception($user->getError());
            }
            break;
    }
    ?>
