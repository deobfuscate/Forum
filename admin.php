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
		<h2>Admin</h2>
<?php
	if(isset($_POST['forum_name'])) {
		$forum_name = htmlspecialchars($_POST['forum_name']);
		$query = "UPDATE settings SET value = ? WHERE settings.setting = 'forum_name'";
		$stmt = $dbc->prepare($query);
		$stmt->bind_param("s", $forum_name);
		if ($stmt->execute())
			print "		<p>Forum Name changed successfully.</p>\n";
		else
			print "		<p>Failed to change Forum Name.</p>\n";
	}
?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="register">
			<p>Forum Name:<br><input name="forum_name" type="text" size="32" id="forum_name" autofocus></p>
			<p><button>Save</button></p>
		</form>
<?php
	include("includes/footer.php");
?>