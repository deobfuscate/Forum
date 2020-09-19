<?php
	DEFINE ('DB_HOST', 'localhost');
	DEFINE ('DB_USER', '');
	DEFINE ('DB_PASSWORD', '');
	DEFINE ('DB_NAME', 'usersys');
	
	if ($dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)) {
		//print '<p>Successfully connected!</p>';
	}
	else {
		die('<p style="color: red;">Could not connect to MySQL:<br>'.mysqli_connect_error().'</p>');
	}
?>