<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	include("mysqli.php");
	$user =  mysqli_real_escape_string($dbc, strip_tags($_POST['username']) );

	$r = mysqli_query($dbc, "SELECT id FROM users WHERE username = '$user'");
	if (mysqli_num_rows($r) == 0) { print "false"; }
	else { print "true"; }
}
?>