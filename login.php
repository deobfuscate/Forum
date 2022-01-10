<?php
	define("TITLE", "Login");
	include("includes/header.php");

	if (!empty($_POST)) {
		
		$u = mysqli_real_escape_string($dbc, strip_tags($_POST['username']));
		$p = mysqli_real_escape_string($dbc, $_POST['password']);
	
		$sql = "SELECT * FROM `users` WHERE `username` LIKE '$u' LIMIT 1";
		$r = mysqli_query($dbc, $sql);
		if (!$r)
			$msg = "Error: " . mysqli_error($dbc);
		elseif (mysqli_affected_rows($dbc) == 0)
			$msg = "Username does not exist.";
		else while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			if (strtolower($u) == strtolower($row['username']) && md5($p) == $row['password']) {
				$token = md5(strtolower($row['username']).":".$row['password']);
				setcookie("username", $u, time() + (86400 * 30), "/");
				setcookie("token", $token, time() + (86400 * 30), "/");
				header("Location: index.php");
			}
			else
				$msg = "Username and password do not match.";
		}
	}

	if(isset($msg)) { 
		print "		<p class=\"error\">".$msg."</p>\n";
	}
?>
		<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="login">
			<p><input name="username" type="text" size="32" maxlength="32" id="user" placeholder="Username" autofocus></p>
			<p><input name="password" type="password" size="32" maxlength="32" placeholder="Password"></p>
			<p><button>Login</button></p>
		</form>
<?php
	include("includes/footer.php");
?>