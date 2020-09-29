<?php
	include("includes/mysqli.php");
	include("includes/functions.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Home</title>
  </head>
  <body>
  	<h1>Home</h1>
      <?php
      if (isset($_COOKIE['username'])) $u = $_COOKIE['username'];
      if (isset($u) && isLoggedin($u,$dbc)) {
        print "<p>Welcome back, {$u}!</p>\n<p><a href=\"logout.php\">Logout</a></p>\n";
      }
      else {
        print "<p>Welcome, Guest!</p>\n<p><a href=\"login.php\">Login</a> or <a href=\"register.php\">register</a>.</p>\n";
      }
    ?>
    <h2>Post</h2>
    <form action="post.php" method="post" enctype="multipart/form-data" name="thread">
    <p><input name="subject" type="text" placeholder="Subject"></p>
    <p><textarea name="body" cols="30" rows="5" placeholder="Body"></textarea></p>
    <p><input name="" type="submit"></p>
    </form>
  </body>
</html>