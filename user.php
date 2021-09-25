<?php
	define("TITLE", "User");
	include("includes/header.php");

	$sql = "SELECT id, username, joined FROM users ORDER BY id ASC";
	$q = mysqli_query($dbc, $sql);
	if (mysqli_affected_rows($dbc) > 0) {
		$r = $result->fetch_assoc();
		print "		<p>{$r["username"]}</p>";
	}
    
	else {
		print "		<p>Could not find user.</p>\n";
	}

	include("includes/footer.php");
?>