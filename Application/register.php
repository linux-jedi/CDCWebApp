<?php
include 'headers.php';
include 'sessions.php';
include 'config.php';

$salt = 'walshSucks$';
// open connection to the database
include 'readDB.php';
include 'writeDB.php';

//Get Post information from form
$email=mysqli_escape_string($read, $_POST["email"]);
$username=mysqli_escape_string($read, $_POST["username"]);
$password=mysqli_escape_string($read, $_POST["password"]);

//Check if username is taken
$userCheck = $read->prepare('SELECT username FROM users WHERE username = ?');
$userCheck->bind_param('s',$username);

if($userCheck->execute())
{
	if($row = $userCheck->fetch())
	{
		header('Location: /registration.php?message=Sorry the username you have chosen is already registered');
		die();
	}

}
$userCheck->close();

//Check if email is taken
$eCheck = $read->prepare('SELECT email FROM users WHERE email = ?');
$eCheck->bind_param('s',$email);

if($eCheck->execute())
{
	if($row = $eCheck->fetch())
	{
		header('Location: /registration.php?message=Sorry the email you have chosen is already registered');
		die();
	}

}
$eCheck->close();

//Hash and salt the password
$password = openssl_digest($password . $salt, 'sha512');

//Prepare the SQL statement
$stmt = $write->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $username, $password);

// register user
if ($stmt->execute()) {
    //Set session data
    $_SESSION['user'] = $email;
    $_SESSION['id'] = authenticated_session($email);

    header('Location: /index.php');

} 
else {
    header('Location: /registration.php?message=' . urlencode(mysql_error($write)));
}

//Close statement
$stmt->close();

// close connection to the database
include 'closedb.php';

?>
