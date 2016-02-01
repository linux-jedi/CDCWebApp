<?php
// opens the database connection
$conn = new mysqli($DATABASE_IP, $DATABASE_USERNAME, $DATABASE_PASSWORD, $DATABASE_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
