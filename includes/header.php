<?php
	if (!defined('TITLE')) exit();
	include_once("includes/mysqli.php");
	include_once("includes/functions.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php
	$sql = "SELECT value FROM settings WHERE setting = 'forum_name'";
	$q = mysqli_query($dbc, $sql);
	$r = mysqli_fetch_array($q, MYSQLI_ASSOC);
	if (mysqli_affected_rows($dbc) > 0)
		print $r["value"]." - ".TITLE;
	else
		print TITLE;
?></title>
		<link href="assets/css/styles.css" rel="stylesheet" type="text/css">
		<script src="assets/js/jquery.js"></script>
		<script src="assets/js/register.js"></script>
	</head>
	<body>
