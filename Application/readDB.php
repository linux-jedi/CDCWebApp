<?php
// opens the database connection
$read = new mysqli($DATABASE_IP, $DATABASE_RUSERNAME, $DATABASE_RPASSWORD, $DATABASE_NAME);

if ($read->connect_error) {
    die("Connection failed: " . $read->connect_error);
}
?>