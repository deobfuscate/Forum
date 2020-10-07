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
		<h2>Post a new topic</h2>
<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject']) && isset($_POST['body']) && isset($_POST['topic'])) {
		//get user id
		$query = "SELECT id FROM users WHERE username = ?";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $u);
		$stmt->execute();
		$result = $stmt->get_result();
		$author = $result->fetch_assoc();

		//post
		$query = "INSERT INTO postss (body, author, topic) VALUES (?, ?, ?, ?)";
		$stmt = $dbc->prepare($query);

		$stmt->bind_param("ssss", $_POST['subject'], $_POST['body'], $author['id'], $_POST['topic']);
		$stmt->execute();
		$result = $stmt->get_result();
		print "		<p>Topic posted. Click <a href=\"topic.php?id={$stmt->insert_id}\">here</a> to view it.</p>\n";
	}

	else {
		if (!isset($_GET['topic'])) 
			print "		<p>Invalid topic specified.</p>\n";
		elseif (!isset($u) || !isLoggedin($u,$dbc))
			print "		<p>You must me logged in to create a topic.</p>\n";
		else {
?>
		<form action="post.php" method="post" enctype="multipart/form-data" name="thread">
			<p><textarea name="body" cols="30" rows="5" placeholder="Body"></textarea></p>
			<p><input name="" type="submit"></p>
			<input name="topic" type="hidden" value="<?=$_GET['topic']?>">
		</form>
<?php
		}
	}
?>
	</body>
</html>