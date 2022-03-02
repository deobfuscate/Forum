<?php
	define("TITLE", "Search");
	include("includes/header.php");

	if (isset($_POST['search']) && !empty($_POST['search'])) {
		$search = htmlspecialchars($_POST['search']);
		$where = htmlspecialchars($_POST['where']);
		if ($where != "posts")
			$where = "topics"; // default to topics
		$search = "%$search%";
		$query = "SELECT * FROM $where INNER JOIN users ON $where.author = users.id WHERE body LIKE ?";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $search);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($stmt->affected_rows > 0) {
			print "		<p>Found {$stmt->affected_rows} results:</p>\n";
			while ($r = $result->fetch_assoc())
				print "		<p>{$r["body"]}<br><em>Posted by {$r["username"]} at {$r["time"]}</em></p>\n";
		}
		else
			print "		<p>Could not find any results.</p>\n";
	}
?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="register">
			<p>Search for:<br><input name="search" type="text" size="64" autofocus></p>
			<p>In: <input name="where" type="radio" value="topics" checked>Topics</input> <input name="where" type="radio" value="posts">Posts</input></p>
			<p><button>Search</button></p>
		</form>
<?php
	include("includes/footer.php");
?>