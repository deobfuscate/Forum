<?php
	define("TITLE", "User List");
	include("includes/header.php");

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