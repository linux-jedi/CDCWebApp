<?php
session_start();

// clear session
setcookie("PHPSESSID", "", time()-3600);
session_destroy();
header('Location: /index.php');

?>
