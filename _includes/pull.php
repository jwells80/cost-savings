<?php
	require('conn.php');
	$query = "SELECT * FROM customer WHERE cono = '3';";
	dataPull($query, $conn);