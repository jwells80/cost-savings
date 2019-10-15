<?php
	require('conn.php');
	$query = "SELECT * FROM cono;";
	selectPull($query, $conn, 'cono');
