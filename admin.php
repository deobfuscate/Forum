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
        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="register">
			<p>Site Name:<br><input name="site_name" type="text" size="32" id="site_name" autofocus></p>
			<p><button>Save</button></p>
		</form>
<?php
	include("includes/footer.php");
?>