<?php
// define application server hostname
$WEBSITE_DOMAIN_NAME = "titan.com";
$APPLICATION_HOSTNAME = "www";

// define host, database name, username, and password of SQL database
$DATABASE_IP = "127.0.0.1";
$DATABASE_NAME = "application";
$DATABASE_RUSERNAME = "ruser";
$DATABASE_RPASSWORD = "";
$DATABASE_WUSERNAME = "wuser";
$DATABASE_WPASSWORD = "";

// error logging
ini_set('display_errors',1);
ini_set('display_startup_errors',1);

// media 
$validMedia = array("video/mp4", "video/ogg", "video/webm");
$validMediaExtensions = array("mp4", "ogg", "webm");
$baseDir = "/var/www";
$mediaDir = "/media";
$uploadDir = "/var/www/media";
?> 
