<!-- ? Name:  Saul Maylin
? Date: 28/06/2025
? v1.1
? Project: Project Crawler
? Connection to the database
-->

<?php
function loadDatabaseConfig($vars = [])
{
    // get config from php.ini CFG
    foreach ($vars as $v) {
        define($v, get_cfg_var("myapp.cfg.$v"));
    }
}

function connectToDatabase()
{
    // Prepare database connection with neded parameters
    $host = ['DB_HOST', 'DB_USER', 'DB_PASS', 'DB_NAME'];

    // Send params to be parsed
    loadDatabaseConfig($host);

    try {
        // Define the global $DB variable to be used in other files
        global $DB;

        // open connection to the database

        $DB = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        return true;
    } catch (Exception $e) {
        // Handle connection error
        echo "Connection failed: " . $e->getMessage();
        return false;

    }
}

// Run previous function to connect to the database
if (connectToDatabase()) {
    echo "<script> console.log('Database connection successful!'); </script>";
} else {
    echo "<script> console.error('Failed to connect to the database.'); </script>";
}
?>