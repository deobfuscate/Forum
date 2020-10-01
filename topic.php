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
		print "		<p>Welcome back, {$u}!</p>\n		<p><a href=\"logout.php\">Logout</a></p>\n";
	}
	else {
		print "		<p>Welcome, Guest!</p>\n		<p><a href=\"login.php\">Login</a> or <a href=\"register.php\">register</a>.</p>\n";
	}
?>
		<br>
		<h2>Topic</h2>
<?php
	//topic post
	$query = "SELECT topics.title, topics.body, topics.time, users.username FROM topics INNER JOIN users ON topics.author = users.id WHERE topics.id = ? LIMIT 1";
	$stmt = $dbc->prepare($query);
	$stmt->bind_param("s", $parent);
	$stmt->execute();
	$result = $stmt->get_result();
	$r = $result->fetch_assoc();
	print "		<h3>{$r["title"]}</h3>\n		{$r["body"]}<br><i>Posted by {$r["username"]} at {$r["time"]}</i><br><br>\n";

	//replies
	$query = "SELECT posts.body, posts.time, users.username FROM posts INNER JOIN users ON posts.author = users.id WHERE posts.parent = ? ORDER BY time ASC";
	$stmt = $dbc->prepare($query);
	$stmt->bind_param("s", $parent);
	$stmt->execute();
	$result = $stmt->get_result();
	while ($r = $result->fetch_assoc()) {
		print "		{$r["body"]}<br><i>Posted by {$r["username"]} at {$r["time"]}</i><br><br>\n";
	}
?>
	</body>
</html>