<?php
	define("TITLE", "Categories");
	include("includes/header.php");

	if (isset($_POST['forum_name']) && !empty($_POST['forum_name'])) {
		$forum_name = htmlspecialchars($_POST['forum_name']);
		$query = "UPDATE settings SET value = ? WHERE settings.setting = 'forum_name'";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $forum_name);
		if ($stmt->execute())
			print "		<p>Forum Name changed successfully.</p>\n";
		else
			print "		<p>Failed to change Forum Name.</p>\n";
	}
	if (isset($_POST['max_topics']) && !empty($_POST['max_topics'])) {
		$max_topics = htmlspecialchars($_POST['max_topics']);
		$query = "UPDATE settings SET value = ? WHERE settings.setting = 'max_topics'";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $max_topics);
		if ($stmt->execute())
			print "		<p>Max topics changed successfully.</p>\n";
		else
			print "		<p>Failed to change Max topics.</p>\n";
	}
	if (isset($_POST['max_posts']) && !empty($_POST['max_posts'])) {
		$max_posts = htmlspecialchars($_POST['max_posts']);
		$query = "UPDATE settings SET value = ? WHERE settings.setting = 'max_posts'";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $max_posts);
		if ($stmt->execute())
			print "		<p>Max posts changed successfully.</p>\n";
		else
			print "		<p>Failed to change Max posts.</p>\n";
	}
?>
		<p><a href="userlist.php">View user list</a></p>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="register">
<?php
		$query = "SELECT settings.value FROM settings WHERE settings.setting = 'forum_name' LIMIT 1";
		$stmt = $dbc->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			$r = $result->fetch_assoc();
			print "			<p>Forum Name:<br><input name=\"forum_name\" type=\"text\" size=\"32\" id=\"forum_name\" value=\"{$r["value"]}\" autofocus></p>\n";
		}
		else {
			print "			<p>Forum Name:<br><input name=\"forum_name\" type=\"text\" size=\"32\" id=\"forum_name\" autofocus></p>\n";
		}

		$query = "SELECT settings.value FROM settings WHERE settings.setting = 'max_topics' LIMIT 1";
		$stmt = $dbc->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			$r = $result->fetch_assoc();
			print "			<p>Max topics to display on topic list:<br><input name=\"max_topics\" type=\"number\" size=\"5\" id=\"max_name\" value=\"{$r["value"]}\"></p>\n";
		}
		else {
			print "			<p>Max topics to display on topic list:<br><input name=\"max_topics\" type=\"number\" size=\"5\" id=\"max_name\"></p>\n";
		}

		$query = "SELECT settings.value FROM settings WHERE settings.setting = 'max_posts' LIMIT 1";
		$stmt = $dbc->prepare($query);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($result->num_rows > 0) {
			$r = $result->fetch_assoc();
			print "			<p>Max posts to display on thread page:<br><input name=\"max_posts\" type=\"number\" size=\"5\" id=\"max_posts\" value=\"{$r["value"]}\"></p>\n";
		}
		else {
			print "			<p>Max posts to display on thread page:<br><input name=\"max_posts\" type=\"number\" size=\"5\" id=\"max_posts\"></p>\n";
		}

?>
			<p><button>Save</button></p>
		</form>
<?php
	include("includes/footer.php");
?>