<?php
	define("TITLE", "Categories");
	include("includes/header.php");
?>
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
		<h2>Search</h2>
<?php
	if (isset($_POST['search']) && !empty($_POST['search'])) {
		$search = htmlspecialchars($_POST['search']);
		$where = htmlspecialchars($_POST['where']);
		if ($where != "posts") $where = "topics"; // default to topics
		$search = "%$search%";
		$query = "SELECT * FROM $where INNER JOIN users ON $where.author = users.id WHERE body LIKE ?";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $search);
		$stmt->execute();
		$result = $stmt->get_result();
		if ($stmt->affected_rows > 0)
			while ($r = $result->fetch_assoc()) {
				print "		<p>{$r["body"]}<br><i>Posted by {$r["username"]} at {$r["time"]}</i></p>\n";
			}
		else {
			print "		<p>Could not find any results.</p>\n";
		}
	}
?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="register">
			<p>Search for:<br><input name="search" type="text" size="32" autofocus></p>
			<p>In: <input name="where" type="radio" value="topics" checked>Topics</input> <input name="where" type="radio" value="posts">Posts</input></p>
			<p><button>Search</button></p>
		</form>
<?php
	include("includes/footer.php");
?>