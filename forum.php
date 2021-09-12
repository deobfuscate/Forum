<?php
	define("TITLE", "View Forum");
	include("includes/header.php");

	if (isset($_GET['id']))
		$forum = htmlspecialchars($_GET['id']);
	if (!isset($forum))
		die("No forum selected.");
?>
		<p><a href="post.php?cat=<?=$forum?>">Post a new topic</a></p>
<?php
	$sql = "SELECT value FROM settings WHERE setting = 'max_topics'";
	$q = mysqli_query($dbc, $sql);
	$r = mysqli_fetch_array($q, MYSQLI_ASSOC);
	if (mysqli_affected_rows($dbc) > 0)
		$max_topics = $r["value"];


	$query = "SELECT topics.id, topics.title, topics.time, users.username FROM topics INNER JOIN users ON topics.author = users.id WHERE topics.category = ? ORDER BY time ASC LIMIT {$max_topics}";
	$stmt = $dbc->prepare($query);
	$stmt->bind_param("s", $forum);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0)
		while ($r = $result->fetch_assoc())
			print "		<p><a href=\"topic.php?id={$r["id"]}\">{$r["title"]}</a><br><i>Posted by {$r["username"]} at {$r["time"]}</i></p>\n";
	else
		print "		<p>No topics to display.</p>\n";

	include("includes/footer.php");
?>