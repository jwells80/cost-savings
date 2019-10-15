<?php
	require('conn.php');
	$query = "SELECT * FROM SavType;";
	
	selectPull($query, $conn, 'SavType');
