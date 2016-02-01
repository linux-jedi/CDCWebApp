<?php
// session utils
include 'sessions.php';

// open connection to the database
include 'config.php';
include 'readDB.php';
include 'writeDB.php';

$salt = 'salt$';

// get POST information from login form
$email=mysqli_escape_string($read, $_POST["email"]);
$password=mysqli_escape_string($read, $_POST["password"]);

//Hash the password
$password = openssl_digest($password . $salt, 'sha512');

//Prepare the sequel query and bind parameters
$stmt = $read->prepare('SELECT email, password FROM users WHERE email = ? AND password = ?');
$stmt->bind_param('ss', $email, $password);

//Retrieves data from user table
if(!($stmt->execute()))
{
	header('Location: /login.php?message=Login%20Failed');
	die();
};

 $stmt->store_result();
 
//Check if the password was correct
if($stmt->num_rows())
{
	//Set session data
    $_SESSION['user'] = $email;
    $_SESSION['id'] = authenticated_session($email);

	header('Location: /index.php');
} 
else 
{
	// logout
	header('Location: /login.php?message=Incorrect%20Password');
	session_destroy();
}

// close connection to the database
$stmt->close();
include 'closedb.php';

?>
