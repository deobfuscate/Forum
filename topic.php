<?php
	define("TITLE", "View Topic");
	include("includes/header.php");
	if (isset($_GET['id']))
		$parent = htmlspecialchars($_GET['id']);
	if (!isset($parent))
		die("No forum selected.");
?>
		<p><a href="reply.php?topic=<?=$parent?>">Post a reply</a></p>
<?php
	//topic post
	$query = "SELECT topics.title, topics.body, topics.time, users.username FROM topics INNER JOIN users ON topics.author = users.id WHERE topics.id = ? LIMIT 1";
	$stmt = $dbc->prepare($query);
	$stmt->bind_param("s", $parent);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$r = $result->fetch_assoc();
		print "		<h3>{$r["title"]}</h3>\n		<p>{$r["body"]}<br><i>Posted by {$r["username"]} at {$r["time"]}</i></p>\n";
		//replies
		$query = "SELECT posts.body, posts.time, users.username FROM posts INNER JOIN users ON posts.author = users.id WHERE posts.parent = ? ORDER BY time ASC";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $parent);
		$stmt->execute();
		$result = $stmt->get_result();
		while ($r = $result->fetch_assoc())
			print "		<p>{$r["body"]}<br><i>Posted by {$r["username"]} at {$r["time"]}</i></p>\n";
	}
	else
		print "		<p>Specified topic does not exist.</p>\n";

	include("includes/footer.php");
?>