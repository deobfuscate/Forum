<?php
  unset($_COOKIE['username']);
  unset($_COOKIE['token']);
	setcookie("username", "", time() - 3600, "/");
	setcookie("token", "", time() - 3600, "/");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Logout</title>
  </head>
  <body>
  	<h1>Logout</h1>
    <p>Logged out.</p>
    <p><a href="index.php">Go home.</a></p>
  </body>
</html>
