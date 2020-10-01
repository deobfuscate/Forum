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
		print "		<p>Welcome back, {$u}!</p>\n		<p><a href=\"logout.php\">Logout</a></p>\n";
	}
	else {
		print "		<p>Welcome, Guest!</p>\n		<p><a href=\"login.php\">Login</a> or <a href=\"register.php\">register</a>.</p>\n";
	}
?>
		<br>
		<h2>Categories</h2>
<?php
	$sql = "SELECT id, name, description FROM categories ORDER BY id ASC";
	$q = mysqli_query($dbc, $sql);
	while ($r = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
		print "		<a href=\"forum.php?id={$r["id"]}\">{$r["name"]}</a><br><i>{$r["description"]}</i><br><br>\n";
	}
?>
	</body>
</html>