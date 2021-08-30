<?php
	define("TITLE", "Register");
	include("includes/header.php");

$html = '		<form action="'.$_SERVER['PHP_SELF'].'" method="post" enctype="multipart/form-data" name="register">
			<p><input name="username" type="text" size="32" maxlength="32" id="user" placeholder="Username" autofocus> <span id="exists">&nbsp;</span></p>
			<p><input name="password" type="password" size="32" maxlength="32" placeholder="Password"></p>
			<p><input name="confirm" type="password" size="32" maxlength="32" placeholder="Confirm Password"></p>
			<p><input name="email" type="email" size="64" maxlength="64" placeholder="Email"></p>
			<p><button>Register!</button></p>
		</form>
';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include("includes/mysqli.php");
	include("includes/functions.php");
	$u = mysqli_real_escape_string($dbc, strip_tags($_POST['username']));
	$p = mysqli_real_escape_string($dbc, $_POST['password']);
	$c = $_POST['confirm'];
	$e = mysqli_real_escape_string($dbc, strip_tags($_POST['email']));

	$message = "		";
	$problem = false;
	$aValid = array('-', '_');
	
	if (empty($u) || empty($p) || empty($c) || empty($e)) {
		$message .= "<p class=\"error\">Required field was left blank.</p>\n";
		$problem = true;
	}
	elseif (!ctype_alnum(str_replace($aValid, '', $u))) {
		$message .= "<p class=\"error\">Usernames must be alpha-numberic and can include - or _.</p>\n";
		$problem = true;
	} 
	elseif ($p!==$c) {
		$message .= "<p class=\"error\">Passwords do not match.</p>\n";
		$problem = true;
	} 
	else {
		if (userExists($u, $dbc)) {
			$message .= "<p class=\"error\">Username is already taken.</p>\n";
			$problem = true;
		}
		if (emailExists($e, $dbc)) {
			$message .= "<p class=\"error\">Email is already in use.</p>\n";
			$problem = true;
		}
	}
	if (!$problem) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$sql = "INSERT INTO `forum`.`users` (`username`, `password`, `email`, `verified`, `joined`, `ip`, `user_lvl`) VALUES ('$u', MD5('$p'), '$e', '0', NOW(), '$ip', '0');";
		
		$r = mysqli_query($dbc, $sql);
		if (mysqli_affected_rows($dbc) == 1) {
			print "		<p>You have successfully registered.</p>\n<p><a href=\"login.php\">Login</a>.</p>\n";
		} else {
			print "		<p class=\"error\">Could not register because:<br>".mysqli_error($dbc)."</p><p>The query being run was: ".$sql."</p>\n";
		}
	} 
	else {
		print $message.$html;
	}
	mysqli_close($dbc);
}
else {
	print $html;
}

	include("includes/footer.php");
?>