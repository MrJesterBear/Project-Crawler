<!-- ? Name:  Saul Maylin
? Date: 27/06/2025
? v1
? Project: Project Crawler
? -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>User | Project Crawler</title>

    <!-- * Meta data for indexing-->
    <meta name="description" content="The user page for Project Crawler." />
    <meta name="keywords" content="D&D, Character Creator, tabletop, rpg" />
    <meta name="author" content="Saul Maylin" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="index, follow" />

    <!-- * Links for both the stylesheet for pazas and a favicon for the site.-->
    <!-- ! Import Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon"
        href="/assets/universal/4048494a-3811-4b3f-a59a-cb6ef91501dd_1.56f67623514375c32ce7bbf383a5974a.jpeg" />
</head>

<?php
// Double check user is not logged in.
session_start();

if (isset($_SESSION['UID'])) {
    // If user is logged in, redirect to the home page.
    header("Location: account.php");
}
?>
<body class="bodyDefault">

    <!-- * Image & Nav -->
    <div class="d-flex justify-content-center">
        <a class="navbar-brand" href="index.html">
            <img src="https://images.emojiterra.com/twitter/v13.1/512px/1f3b2.png" alt="Dice" width="90">
        </a>
    </div>

    <nav class="nav navbar navbar-expand-lg bg-body-tertiary d-flex justify-content-center">
        <script type="module">
            // imports setnav function and runs it.
            import { setNav } from "./js/html/nav.js";
            setNav();
        </script>
    </nav>
<?php 
    // If there is an error, display it.

    if (isset($_GET['error'])) {
        $errortext;

        switch($_GET['error']) {
            case '0':
                $errortext = "test";
                break;
            case '1':
                $errortext = "";
                break;
            case '2';
                $errortext = "";
                break;
            default:
                break;
        }

        echo '<div class="alert alert-warning alert-dismissible fade show container text-center" role="alert">'.
        $errortext.
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
?>
 

    <!-- * login and register panes -->

    <div class="d-flex justify-content-center text-center my-3">
        <div class="row">
            <!-- Login -->
            <div class="border col-md mx-5">
                <h1> Login </h1>
                <form id="Login" method="POST" action="./php/CheckUser.php"
                    onsubmit="return validateForm(event, 'login')">


                    <!-- Email Row -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control email" id="email"
                            placeholder="Enter Your Email...">
                    </div>

                    <!-- Email Error Row -->
                    <div class="row mb-5">
                        <div class="col-sm-10">
                            <span id="emailError" class="text-danger emailError"></span>
                        </div>
                    </div>

                    <!-- Password Row -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control password" id="password"
                            placeholder="Enter Your Password...">
                    </div>

                    <!-- Password Error Row -->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <span id="passwordError" class="text-danger passwordError"></span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                </form>
            </div>
            <!-- Register -->
            <div class="border col-md px-5">
                <h1> Register </h1>
                <form id="Register" method="POST" action="./php/WriteUser.php"
                    onsubmit="return validateForm(event, 'register')">


                    <!-- Email Row -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control email" id="email"
                            placeholder="Enter Your Email...">
                    </div>

                    <!-- Email Error Row -->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <span id="emailError" class="text-danger emailError"></span>
                        </div>
                    </div>

                    <!-- Username Row -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input name="username" type="username" class="form-control username" id="username"
                            placeholder="Enter Your Unique Username...">
                    </div>

                    <!-- Username Error Row -->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <span id="usernameError" class="text-danger usernameError"></span>
                        </div>
                    </div>

                    <!-- Password Row -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control password" id="password"
                            placeholder="Enter Your Password...">
                    </div>

                    <!-- Password Error Row -->
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <span id="passwordError" class="text-danger passwordError"></span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-primary">Register an Account</button>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <!-- Footer -->
    <div class="container-fluid text-center bg-secondary border border-border">
        <p class="text-white">This is a footer! yarharr.</p>
    </div>

    <!-- Import validation script for the form to use -->
    <script src="/js/util/formValidation.js"></script>

    <!-- ! Import bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>