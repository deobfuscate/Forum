<?php
	define("TITLE", "Categories");
	include("includes/header.php");

	$sql = "SELECT id, name, description FROM categories ORDER BY id ASC";
	$q = mysqli_query($dbc, $sql);
	if (mysqli_affected_rows($dbc) > 0)
		while ($r = mysqli_fetch_array($q, MYSQLI_ASSOC)) {
			print "		<p><a href=\"forum.php?id={$r["id"]}\">{$r["name"]}</a><br><i>{$r["description"]}</i></p>\n";
		}
	else {
		print "		<p>No categories to display.</p>\n";
	}

	include("includes/footer.php");
?>