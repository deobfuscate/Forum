<?php
	define("TITLE", "Reply to a Topic");
	include("includes/header.php");

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['body']) && isset($_POST['topic']) && !empty($_POST['body'])) {
		//get user id
		$query = "SELECT id FROM users WHERE username = ?";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $u);
		$stmt->execute();
		$result = $stmt->get_result();
		$author = $result->fetch_assoc();

		//post
		$query = "INSERT INTO posts (body, parent, author) VALUES (?, ?, ?)";
		$stmt = $dbc->prepare($query);
		$sanitized_body = htmlspecialchars($_POST['body']);
		$stmt->bind_param("sss", $sanitized_body, $_POST['topic'], $author['id']);
		$stmt->execute();
		$result = $stmt->get_result();
		print "		<p>Reply posted. Click <a href=\"topic.php?id={$_POST['topic']}\">here</a> to view it.</p>\n";
	}

	else {
		if (!isset($_GET['topic'])) 
			print "		<p>Invalid topic specified.</p>\n";
		elseif (!isset($u) || !isLoggedin($u,$dbc))
			print "		<p>You must be logged in to reply to a topic.</p>\n";
		else {
?>
		<form action="reply.php" method="post" enctype="multipart/form-data">
			<p><textarea name="body" cols="30" rows="5"></textarea></p>
			<p><input name="" type="submit"></p>
			<input name="topic" type="hidden" value="<?=$_GET['topic']?>">
		</form>
<?php
		}
	}

	include("includes/footer.php");
?>