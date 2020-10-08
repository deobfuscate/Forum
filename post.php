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
		<h2>Post a new topic</h2>
<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject']) && isset($_POST['body']) && isset($_POST['cat'])) {
		//get user id
		$query = "SELECT id FROM users WHERE username = ?";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $u);
		$stmt->execute();
		$result = $stmt->get_result();
		$author = $result->fetch_assoc();

		//post
		$query = "INSERT INTO topics (title, body, author, category) VALUES (?, ?, ?, ?)";
		$stmt = $dbc->prepare($query);

		$stmt->bind_param("ssss", $_POST['subject'], $_POST['body'], $author['id'], $_POST['cat']);
		$stmt->execute();
		$result = $stmt->get_result();
		print "		<p>Topic posted. Click <a href=\"topic.php?id={$stmt->insert_id}\">here</a> to view it.</p>\n";
	}

	else {
		if (!isset($_GET['cat'])) 
			print "		<p>Invalid category specified.</p>\n";
		elseif (!isset($u) || !isLoggedin($u,$dbc))
			print "		<p>You must me logged in to create a topic.</p>\n";
		else {
?>
		<form action="post.php" method="post" enctype="multipart/form-data" name="thread">
			<p><input name="subject" type="text" placeholder="Subject"></p>
			<p><textarea name="body" cols="30" rows="5" placeholder="Body"></textarea></p>
			<p><input name="" type="submit"></p>
			<input name="cat" type="hidden" value="<?=$_GET['cat']?>">
		</form>
<?php
		}
	}
?>
	</body>
</html>