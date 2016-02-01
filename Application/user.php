<?php
  include 'config.php';
  include 'headers.php';
  include 'sessions.php';

  // open connection to the database
  include 'readDB.php';
  include 'writeDB.php';

  $userID = NULL;
  $media = $mediaDir;
  $username = mysqli_escape_string($read, $_GET["username"]);

  // get clip properties
  $stmt = $read->prepare("SELECT id, email FROM users WHERE username = ?");
  $stmt->bind_param('s', $username);
  $stmt->bind_result($userID, $email);
  $stmt->execute();

  $stmt->store_result();

  if($stmt->num_rows())
  {
    $stmt->fetch();
      $userID-=502;
  } 
  else 
  {
    $userID = NULL;
  }

  $email = htmlspecialchars($email);
  $username = htmlspecialchars($username);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <title>Completely Digital Clips</title>

    <!-- Bootstrap core CSS -->
    <link href="/static/css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="/static/css/carousel.css" rel="stylesheet">

    <script src="/lib/jquery.js"></script>
    <script src="/lib/mediaelement-and-player.min.js"></script>
    <link rel="stylesheet" href="./lib/mediaelementplayer.css" />
    <script src="/static/js/bootstrap.min.js"></script>
  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">

        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">Completely Digital Clips</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="/index.php">Home</a></li>
                <?php if(isset($_SESSION['user'])): ?> 
                  <li><a href="/post.php">Post Video</a></li>
                  <li><a href="/logout.php">Logout</a></li>
                <?php else: ?>
                  <li><a href="/login.php">Login</a></li>
                  <li><a href="/registration.php">Register</a></li>
                <?php endif; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br />
    <div class="container marketing">
      <hr class="featurette-divider">
      <center>
      <?php if(isset($_SESSION['user'])): ?>
        <h1>Account Information</h1>
        <p><b>Username: </b> <?php echo $username; ?></p>
        <?php if($_SESSION['user'] == $email):?>
          <p><b>Email: </b> <?php echo $email; ?></p>
        <?php endif; ?>
      <?php endif; ?>
      <?php
        if($userID){
          echo "<h1>User Videos</h1>";
          // get user videos
          $postedClips = FALSE;
          $counter = 1;

          //Query Database
          $stmt = $read->prepare("SELECT host, title, shortname, posted, views FROM clips WHERE user = ? ORDER BY views DESC, posted DESC");
          $stmt->bind_param('s', $userID);
          $stmt->bind_result($host, $title, $shortname, $posted, $views);
          $stmt->execute();  

          while($stmt->fetch() and (( isset($_SESSION['id']) and isset($_SESSION['user'])) or $counter < 5 ))
          {
            $postedClips = TRUE;
            $counter++;
            $title = htmlspecialchars($title);
            $filename = md5($shortname . "salt");

            echo "<a href=\"/view.php?video=$shortname\"><h2>$title</h2></a>";
            echo "<a href=\"/view.php?video=$shortname\"><img src=\"media/$host/$filename.png\" /></a>";
            echo "<p>$views views since $posted</p><br />";
          }
          if($postedClips == FALSE){
            echo "<p>This user hasn't posted any videos :(</p>";
          }
        } else {
          echo "<h1>Sorry we couldn't find that user :(</h1>";
        }
      ?>
      </center>
      <!-- FOOTER -->
      <hr class="featurette-divider">
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; <?php echo date("Y"); ?> Completely Digital Clips &middot; <a href="/privacy.php">Privacy</a> &middot; <a href="/terms.php">Terms</a></p>
      </footer>
    </div>
  </body>
</html>

<?
// close connection to the database
include 'closedb.php';
?>