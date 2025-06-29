<!-- ? Name:  Saul Maylin
? Date: 27/06/2025
? v1
? Project: Project Crawler
? -->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Account | Project Crawler</title>

    <!-- * Meta data for indexing-->
    <meta name="description" content="The home page for a Dungeon Master vault and D&D Beyond clone." />
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

    <!-- * Main Content -->

    <div class="container-fluid text-center">
        <h1 class="display-1">Welcome to Project Crawler!</h1>
        <p class="lead">This is a home page for a Dungeon Master vault and D&D Beyond clone.</p>
        <p class="lead">This is a work in progress </p>
    </div>

    <div class="d-flex justify-content-center py-3">
        <img src="https://live.staticflickr.com/5342/9655276540_c29e82047e_b.jpg" alt="fun image" width="1000">
    </div>

    <?php
    echo $_SESSION['UID'];
    echo $_SESSION['username'];
    echo $_SESSION['email'];
    ?>

    <!-- Footer -->
    <div class="container-fluid text-center bg-secondary border border-border">
        <p class="text-white">This is a footer! yarharr.</p>
    </div>

    <!-- ! Import bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
        crossorigin="anonymous"></script>
</body>

</html>