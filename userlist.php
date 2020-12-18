<?php
	define("TITLE", "User List");
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
		<h2>User List</h2>
<?php
	$sql = "SELECT id, username, joined FROM users ORDER BY id ASC";
	$q = mysqli_query($dbc, $sql);
	if (mysqli_affected_rows($dbc) > 0)
		while ($r = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
			print "		<p><a href=\"user.php?id={$r["id"]}\">{$r["username"]}</a><br><i>Joined {$r["joined"]}</i></p>\n";
		}
	else {
		print "		<p>No users to display.</p>\n";
	}

	include("includes/footer.php");
?>