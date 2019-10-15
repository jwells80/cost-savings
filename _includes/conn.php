<?php
	// Database details
	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = 'j0hnst0n!';
	//$dbpass = Tr2REgaq;
	$dbname = 'CostSavings';

	// Make Connection to Database
	$conn = mysql_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Check if connection was made
	if(! $conn) {
		die("Could not Connect:" . mysql_error());
	}
	mysql_select_db($dbname, $conn);
	require('functions.php');
