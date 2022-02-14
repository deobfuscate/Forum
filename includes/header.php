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
		$title = $forum_name . " - " . TITLE;
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
		<h1><?=$forum_name?></h1>
		<p><a href="index.php">Forums</a> | <a href="search.php">Search</a> | <a href="userlist.php">User List</a> | <?php
	if (isset($_COOKIE['username']))
		$u = $_COOKIE['username'];
	if (isset($u) && isLoggedin($u,$dbc))
		print "Welcome back, {$u}! <a href=\"logout.php\">Logout</a>";
	else
		print "Welcome, Guest! <a href=\"login.php\">Login</a> or <a href=\"register.php\">register</a>";
?></p>
		<h2><?=TITLE?></h2>
