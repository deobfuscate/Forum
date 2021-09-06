<?php
	if (!defined('TITLE')) // prevent header being accessed directly
		exit();
	include_once("includes/mysqli.php");
	include_once("includes/functions.php");
	$sql = "SELECT value FROM settings WHERE setting = 'forum_name'";
	$q = mysqli_query($dbc, $sql);
	$r = mysqli_fetch_array($q, MYSQLI_ASSOC);
	$forum_name = $r["value"];
	if (mysqli_affected_rows($dbc) > 0)
		$title = $r["value"]." - ".TITLE;
	else
		$title = TITLE;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?=$title?></title>
		<link href="assets/css/styles.css" rel="stylesheet" type="text/css">
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/register.js"></script>
	</head>
	<body>
		<h1><?=$r["value"]?></h1>
		<p><a href="index.php">Forums</a> | <a href="search.php">Search</a> | <a href="userlist.php">User List</a></p>
<?php
	if (isset($_COOKIE['username']))
		$u = $_COOKIE['username'];
	if (isset($u) && isLoggedin($u,$dbc)) {
		print "		<p>Welcome back, {$u}!</p>\n		<p><a href=\"logout.php\">Logout</a></p>\n";
	}
	else {
		print "		<p>Welcome, Guest!</p>\n		<p><a href=\"login.php\">Login</a> or <a href=\"register.php\">register</a>.</p>\n";
	}
?>
		<h2><? echo TITLE; ?></h2>