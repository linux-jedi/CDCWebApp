<?php
session_start();
	
  function authenticated_session($username) {
  	$salt = 'auth%';
    return openssl_digest($username . $salt, 'sha512');
  }
?>
