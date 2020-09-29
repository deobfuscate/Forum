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
      if (isset($_GET['id'])) $parent = $_GET['id'];
      if (!isset($parent)) die("No forum selected.");
      if (isset($u) && isLoggedin($u,$dbc)) {
        print "<p>Welcome back, {$u}!</p>\n<p><a href=\"logout.php\">Logout</a></p>\n";
      }
      else {
        print "<p>Welcome, Guest!</p>\n<p><a href=\"login.php\">Login</a> or <a href=\"register.php\">register</a>.</p>\n";
      }
    ?>
    <br>
    <h2>Topic</h2>
    <?php
      //topic post
      $sql = "SELECT topics.title, topics.body, topics.time, users.username FROM topics INNER JOIN users ON topics.author = users.id WHERE topics.id = {$parent}";
      $q = mysqli_query($dbc, $sql);
      $r = mysqli_fetch_array($q, MYSQLI_ASSOC);
      print "<h3>{$r["title"]}</h3>{$r["body"]}<br><i>Posted by {$r["username"]} at {$r["time"]}</i><br><br>\n";

      //replies
      $sql = "SELECT posts.body, posts.time, users.username FROM posts INNER JOIN users ON posts.author = users.id WHERE posts.parent = {$parent} ORDER BY time ASC";
      $q = mysqli_query($dbc, $sql);
      while ($r = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
        print "{$r["body"]}<br><i>Posted by {$r["username"]} at {$r["time"]}</i><br><br>\n";
      }
    ?>
  </body>
</html>