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
      if (isset($_GET['id'])) $forum = $_GET['id'];
      if (!isset($forum)) die("No forum selected.");
      if (isset($u) && isLoggedin($u,$dbc)) {
        print "<p>Welcome back, {$u}!</p>\n<p><a href=\"logout.php\">Logout</a></p>\n";
      }
      else {
        print "<p>Welcome, Guest!</p>\n<p><a href=\"login.php\">Login</a> or <a href=\"register.php\">register</a>.</p>\n";
      }
    ?>
    <br>
    <h2>Topics</h2>
    <?php
      $sql = "SELECT * FROM `topics` WHERE `topics`.`category` = {$forum} ORDER BY `time` ASC";
      $q = mysqli_query($dbc, $sql);
      while ($r = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
        print "{$r["title"]}<br><i>{$r["time"]}</i><br><br>";
      }
    ?>
  </body>
</html>