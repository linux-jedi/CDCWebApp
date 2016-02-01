<?php
  include 'config.php';
  include 'headers.php';
  include 'sessions.php';
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

    <title>Completely Digital Clips - Privacy</title>

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
      <h2>Privacy Policy</h2>
      <p>Your privacy is very important to us. Accordingly, we have developed this Policy in order for you to understand how we collect, use, communicate and disclose and make use of personal information. The following outlines our privacy policy.</p>
        <ul>
          <li>Before or at the time of collecting personal information, we will identify the purposes for which information is being collected.</li>
          <li>We will collect and use of personal information solely with the objective of fulfilling those purposes specified by us and for other compatible purposes, unless we obtain the consent of the individual concerned or as required by law.   </li>
          <li>We will only retain personal information as long as necessary for the fulfillment of those purposes. </li>
          <li>We will collect personal information by lawful and fair means and, where appropriate, with the knowledge or consent of the individual concerned. </li>
          <li>Personal data should be relevant to the purposes for which it is to be used, and, to the extent necessary for those purposes, should be accurate, complete, and up-to-date.</li>
          <li>We will protect personal information by reasonable security safeguards against loss or theft, as well as unauthorized access, disclosure, copying, use or modification.</li>
          <li>We will make readily available to customers information about our policies and practices relating to the management of personal information.</li>
        </ul>
      <!-- FOOTER -->
      <hr class="featurette-divider">
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; <?php echo date("Y"); ?> Completely Digital Clips &middot; <a href="/privacy.php">Privacy</a> &middot; <a href="/terms.php">Terms</a></p>
      </footer>
    </div>
  </body>
</html>

