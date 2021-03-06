<?php
  include 'config.php';
  include 'headers.php';
  include 'sessions.php';

// open connection to the database
include 'readDB.php';
include 'writeDB.php';

function iterateViews($pid,$conn)
{
  $addView = $conn->prepare("UPDATE clips SET views=views+1 WHERE id=?");
  $addView->bind_param('s', $pid);
  $addView->execute();
  $addView->close();
}

$clip = NULL;
$media = $mediaDir;
$shortname = mysql_escape_string($_GET["video"]);


try {
    // get clip properties
    $stmt = $read->prepare("SELECT id, host, title, description, posted, user, views, extension FROM clips WHERE shortname = ?");
    $stmt->bind_param("s", $shortname);
    $stmt->bind_result($id, $host, $title, $description, $posted, $userID, $views, $extension);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows() == 0){
        $clip = NULL;
    } 
    else 
    {
        $stmt->fetch();
        $userID+=502;
        $userResult = $read->prepare("SELECT username FROM users WHERE id = ?");
        $userResult->bind_param('s', $userID);
        $userResult->bind_result($username);

        if(!($userResult->execute()))
        {
          header("Location: /index.php");
          die();
        }

        $userResult->fetch();
        $userResult->close();

        // set the clip the filename
        $clip = md5($shortname. "salt") . "." . $extension;
        $shareURL = "http://$WEBSITE_DOMAIN_NAME/view.php?video=$shortname";

    }
    
  } catch (Exception $e) {
    $clip = NULL;
  }
  // update view counter
  iterateViews($id, $write);

  //Filter data for XSS
  $title = htmlspecialchars($title); 
  $description = htmlspecialchars($description); 
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

    <title>Completely Digital Clips<?php if($clip != NULL){echo " - $title";} ?></title>

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
     <?php if($clip): ?>
     <h1><?php echo $title ?></h1>
     <video src="<?php echo "media/$host/$clip" ?>" width="640" height="390" class="mejs-player" data-mejsoptions='{"alwaysShowControls": true}'></video>
     <br />
     <div style="max-width: 640px; height: 150px;">
       <div style="float: left; max-width: 420px; width: 100%; height: 100%;">
         <pre style="text-align: left; height: 100%;"><?php echo $description ?></pre>
       </div>
       <div style="float: left; margin-left: 20px; max-width: 200px; width: 100%;">
         <pre><b>Views: <?php echo $views ?></b></pre>
         <pre><b>Posted by:<a href="/user.php?username=<?php echo $username; ?>"><?php echo $username; ?></a></b></pre>
         <b>Share&nbsp;</b><input type="text" name="share" value="<?php echo $shareURL ?>" disabled><br />
       </div>
     </div>
     <script>
	    $(document).ready(function() {
		var v = document.getElementsByTagName("video")[0];
		new MediaElement(v, {success: function(media) {
                    <?php 
                      if(isset($_GET["t"])){
                        $seconds = $_GET["t"];
                        echo "media.setCurrentTime($seconds);";
                      }
                    ?>
		    media.play();
		}});
	    });
      </script>
      <?php else: ?>
      <h1>Sorry, we couldn't find that clip :(</h1>
      <?php endif; ?>
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

