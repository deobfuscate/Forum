<?php
	unset($_COOKIE['username']);
	unset($_COOKIE['token']);
	setcookie("username", "", time() - 3600, "/");
	setcookie("token", "", time() - 3600, "/");

	define("TOPIC", "Logout");
	include("includes/header.php");
?>
		<h1>Logout</h1>
		<p>Logged out.</p>
		<p><a href="index.php">Go home.</a></p>
<?php
	include("includes/footer.php");
?>