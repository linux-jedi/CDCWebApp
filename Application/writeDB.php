<?php
// opens the database connection
$write = new mysqli($DATABASE_IP, $DATABASE_WUSERNAME, $DATABASE_WPASSWORD, $DATABASE_NAME);

if ($write->connect_error) {
    die("Connection failed: " . $write->connect_error);
}
?>