<?php
	/* TODO:
		Parse POST data
		Run db structure sql
		Create default user
		Run checks to ensure install was successful
	*/
	if (file_exists("include/config.php"))
		die("Forum already installed.");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Install Forum</title>
		<link href="assets/css/styles.css" rel="stylesheet" type="text/css">
		<script src="assets/js/jquery.js"></script>
	</head>
	<body>
		<h1>Forum</h1>
		<h2>Install</h2>
		<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" name="install">
			<p>Database Host:<br><input name="dbhost" type="text" size="32" maxlength="32" autofocus></p>
			<p>Database Username:<br><input name="dbuser" type="text" size="32" maxlength="32"></p>
			<p>Database Password:<br><input name="dbpass" type="password" size="32" maxlength="32"></p>
			<p>Database Name:<br><input name="dbname" type="text" size="32" maxlength="32"></p>
			<p><button>Install</button></p>
		</form>
    </body>
</html>