<?php
function userExists($u, $dbc) {
	$r = mysqli_query($dbc, "SELECT id FROM users WHERE username = '$u'");
	if (mysqli_num_rows($r) == 0)
		return false;
	else
		return true;
}

function emailExists($e, $dbc) {
	$r = mysqli_query($dbc, "SELECT id FROM users WHERE email = '$e'");
	if (mysqli_num_rows($r) == 0) 
		return false;
	else
		return true;
}

function isLoggedIn($u, $dbc) {
	$r = mysqli_query($dbc, "SELECT password FROM users WHERE username = '$u'");
	if (mysqli_num_rows($r) == 0)
		return false;

	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
	if ($_COOKIE['token'] == md5(strtolower($u).":".$row['password']))
		return true;

	return false;
}

function getUserRole($u, $dbc) {
	$r = mysqli_query($dbc, "SELECT role FROM users WHERE username = '$u'");
	if (mysqli_num_rows($r) == 0)
		return -1;

	$row = mysqli_fetch_array($r, MYSQLI_ASSOC);
	return $row['role'];
}
	
function sendEmail($to, $subject, $message) {
	$headers = 'From: web@site.com' . "\r\n" .
		'Reply-To: web@site.com' . "\r\n";
	mail($to, $subject, $message, $headers);
}
?>