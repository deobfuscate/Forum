<?php
	include(dirname(__DIR__) . "..\..\incl.php");
	
	if (!($dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)))
		die('<p style="color: red;">Could not connect to MySQL:<br>'.mysqli_connect_error().'</p>');
?>