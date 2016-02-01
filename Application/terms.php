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

    <title>Completely Digital Clips - Terms and Conditions</title>

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
                  <li><a href="/logout.php">Logout</a></li>
                  <li><a href="/post.php">Post Video</a></li>
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
<!-- TOS start -->
        <h2>Web Site Terms and Conditions of Use</h2>
        <h3>1. Terms</h3>
        <p>By accessing this web site, you are agreeing to be bound by these 
        web site Terms and Conditions of Use, all applicable laws and regulations, 
        and agree that you are responsible for compliance with any applicable local 
        laws. If you do not agree with any of these terms, you are prohibited from 
        using or accessing this site. The materials contained in this web site are 
        protected by applicable copyright and trade mark law.</p>
        <h3>2. Use License</h3>
        <ol type="a">
        <li>Permission is granted to temporarily download one copy of the materials 
        (information or software) on Completely Digital Clips's web site for personal, 
        non-commercial transitory viewing only. This is the grant of a license, 
        not a transfer of title, and under this license you may not:
        <ol type="i">
          <li>modify or copy the materials;</li>
          <li>use the materials for any commercial purpose, or for any public display (commercial or non-commercial);</li>
          <li>attempt to decompile or reverse engineer any software contained on Completely Digital Clips's web site;</li>
          <li>remove any copyright or other proprietary notations from the materials; or</li>
          <li>transfer the materials to another person or "mirror" the materials on any other server.</li>
        </ol>
      </li>
    <li>
    This license shall automatically terminate if you violate any of these restrictions and may be terminated by Completely Digital Clips at any time. Upon terminating your viewing of these materials or upon the termination of this license, you must destroy any downloaded materials in your possession whether in electronic or printed format.
  </li>
</ol>
      <h3>3. Disclaimer</h3>
      <ol type="a">
        <li>The materials on Completely Digital Clips's web site are provided "as is". Completely Digital Clips makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, Completely Digital Clips does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet web site or otherwise relating to such materials or on any sites linked to this site.</li>
      </ol>
      <h3>4. Limitations</h3>
      <p>In no event shall Completely Digital Clips or its suppliers be liable for any damages (including, without limitation, damages for loss of data or profit, or due to business interruption,) arising out of the use or inability to use the materials on Completely Digital Clips's Internet site, even if Completely Digital Clips or a Completely Digital Clips authorized representative has been notified orally or in writing of the possibility of such damage. Because some jurisdictions do not allow limitations on implied warranties, or limitations of liability for consequential or incidental damages, these limitations may not apply to you.</p>
      <h3>5. Revisions and Errata</h3>
      <p>The materials appearing on Completely Digital Clips's web site could include technical, typographical, or photographic errors. Completely Digital Clips does not warrant that any of the materials on its web site are accurate, complete, or current. Completely Digital Clips may make changes to the materials contained on its web site at any time without notice. Completely Digital Clips does not, however, make any commitment to update the materials.</p>
      <h3>6. Links</h3>
      <p>Completely Digital Clips has not reviewed all of the sites linked to its Internet web site and is not responsible for the contents of any such linked site. The inclusion of any link does not imply endorsement by Completely Digital Clips of the site. Use of any such linked web site is at the user's own risk.</p>
      <h3>7. Site Terms of Use Modifications</h3>
      <p>Completely Digital Clips may revise these terms of use for its web site at any time without notice. By using this web site you are agreeing to be bound by the then current version of these Terms and Conditions of Use.</p>
      <h3>8. Governing Law</h3>
      <p>Any claim relating to Completely Digital Clips's web site shall be governed by the laws of the State of Iowa without regard to its conflict of law provisions.</p>
      <p>We are committed to conducting our business in accordance with these principles in order to ensure that the confidentiality of personal information is protected and maintained.</p>   
<!--TOS end-->
      
      <!-- FOOTER -->
      <hr class="featurette-divider">
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; <?php echo date("Y"); ?> Completely Digital Clips &middot; <a href="/privacy.php">Privacy</a> &middot; <a href="/terms.php">Terms</a></p>
      </footer>
    </div>
  </body>
</html>

      <!-- FOOTER -->
      <hr class="featurette-divider">
      <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; <?php echo date("Y"); ?> Completely Digital Clips &middot; <a href="/privacy.php">Privacy</a> &middot; <a href="/terms.php">Terms</a></p>
      </footer>
    </div>
  </body>
</html>

