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
		print "		<p>Welcome back, {$u}!</p>\n		<p><a href=\"logout.php\">Logout</a></p>\n";
	}
	else {
		print "		<p>Welcome, Guest!</p>\n		<p><a href=\"login.php\">Login</a> or <a href=\"register.php\">register</a>.</p>\n";
	}
?>
		<br>
		<h2>Topics</h2>
		<p><a href="post.php?cat=<?=$forum?>">Post a new topic</a></p>
<?php
	$query = "SELECT topics.id, topics.title, topics.time, users.username FROM topics INNER JOIN users ON topics.author = users.id WHERE topics.category = ? ORDER BY time ASC";
	$stmt = $dbc->prepare($query);
	$stmt->bind_param("s", $forum);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0)
		while ($r = $result->fetch_assoc())
			print "		<p><a href=\"topic.php?id={$r["id"]}\">{$r["title"]}</a><br><i>Posted by {$r["username"]} at {$r["time"]}</i></p>\n";
	else
		print "		<p>No topics to display.</p>\n";
?>
	</body>
</html>