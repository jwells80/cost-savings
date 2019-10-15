<?php
	require('conn.php');
	$query = "SELECT * FROM Rep;";
	selectPull($query, $conn, 'Rep');
