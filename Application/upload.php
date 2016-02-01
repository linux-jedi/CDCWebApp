<?php

include 'config.php';
include 'sessions.php';

//Connect to database
include 'readDB.php';
include 'writeDB.php';

$blacklist =  array(".php", ".phtml", ".php3", ".php4", ".php5");

function generateShortName($length = 11) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}


  // check user authentication
if(isset($_SESSION['user']) && $_SESSION['id'] == authenticated_session($_SESSION['user']))
{
    if ($_FILES["video"]["error"] == UPLOAD_ERR_OK) {

   // check title
    if(!isset($_POST["title"]))
    {
      header("Location: /post.php?message=" . urlencode("Missing title."));
      exit();
    }

    // check description
    if(!isset($_POST["description"]))
    {
      header("Location: /post.php?message=" . urlencode("Missing description."));
      exit();
    }

    // check upload file size is not greater than 100 megabytes
    if($_FILES["video"]["size"] > 12500000) 
    {
      header("Location: /post.php?message=" . urlencode("Only files <= 100 ΜΒ."));
      exit();
    }

    // check file type
    if(in_array($_FILES["video"]["type"], $validMedia) != 1) 
    {
      header("Location: /post.php?message=" . urlencode("File format not supported!"));
      exit();
    }

    //Check file mime type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo,$_FILES['video']['tmp_name'] );
    if(in_array($mime, $validMedia) != 1)
    {
      header("Location: /post.php?message=" . urldecode("File format not supported."));
      exit();
    }

    //Check file extensions for php files
    foreach ($blacklist as $item) 
    {
      if(preg_match("/$item$/i", $_FILES["video"]['tmp_name']))
      {
        header("Location: /post.php?message=" . urldecode("File format not supported"));
        exit();
      }
    }

    // generate unique shortname for upload
    $shortname = generateShortName();
    $extension = pathinfo($_FILES["video"]["name"], PATHINFO_EXTENSION);
    $checkFile = md5($shortname . "salt");
    //Add video3 check later
    while(file_exists("http://video2/media/video2/$checkFile.$extension") or file_exists("http://video1/media/video1/$checkFile.$extension")){
      $shortname = generateShortName();
      $checkFile = md5($shortname . "salt");
    }

    $hashedShort = md5($shortname . "salt");
    $filename = md5($shortname . "salt") . "." . $extension;

  // move file to upload directory
    if(!(move_uploaded_file($_FILES["video"]["tmp_name"], "media/$APPLICATION_HOSTNAME/$filename")))
    {
      header("Location: /post.php?message=" . urldecode("Upload failed"));
      exit();
    }

    // check upload success
    if(!file_exists("media/$APPLICATION_HOSTNAME/$filename")){
      header("Location: /post.php?message=" . urlencode("Upload failed."));
      exit();
    }

    // generate video thumbnail
    // test with: sudo ffmpeg -i "/var/www/media/filename.mp4" -ss 00:00:04 -f image2 -s qvga "/var/www/media/filename.png"
    shell_exec("ffmpegthumbnailer -i \"media/$APPLICATION_HOSTNAME/$filename\" -t 00:00:04 -o \"media/$APPLICATION_HOSTNAME/$hashedShort.png\""); 

    // save input fields
    $title = mysqli_escape_string($read, $_POST["title"]);
    $description = mysqli_escape_string($read, $_POST["description"]);

    try {

      $stmt = $read->prepare("SELECT id from users where email = ?");
      $stmt->bind_param('s', $_SESSION['user']);
      $stmt->bind_result($userID);
      $stmt->execute();
      $stmt->fetch();
      $userID-=502;

      // insert video into clips table
      //$insertResult = mysql_query("INSERT INTO clips (host, shortname, title, description, user, extension) VALUES ('$APPLICATION_HOSTNAME', '$shortname', '$title', '$description', '$userID', '$extension')");
      $stmt = $write->prepare("INSERT INTO clips (host, shortname, title, description, user, extension) VALUES (?,?,?,?,?,?)");
      $stmt->bind_param('ssssis', $APPLICATION_HOSTNAME, $shortname, $title, $description, $userID, $extension);

      if ($stmt->execute()) 
      {
        // success! view the video
        header("Location: /view.php?video=" . urlencode($shortname));
        exit();
      } 
      else 
      {
        header('Location: /post.php?message=' . urlencode(mysql_error($write)));
        exit();
      }
    } 
    catch (Exception $e) 
    {
      header("Location: /post.php?message=" . urlencode("Error: " . $e));
      exit();
    }
  } 
  else 
  {
    // file upload failed
    header("Location: /post.php?message=" . urlencode("No video imported"));
    exit();
  }
} 
else 
{
  header("Location: /post.php?message=" . urlencode("Unauthenticated user."));
  exit();
}
include 'closedb.php';
?>

