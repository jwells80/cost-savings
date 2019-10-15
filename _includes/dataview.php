<?php	
	// Require common php file
	require('conn.php');

	// Query for database lookup
	$query = "SELECT customer.cono, customer.custno, customer.custname, customer.contact, customer.address, customer.city, customer.state, customer.zip, customer.repNo as RepNo, Rep.RepName as RepName FROM customer inner join Rep on customer.repNo = Rep.RepNo;";
	$table = 'customer';
	// Retrieve data from database and write table part
	tableWrite($query, $conn, $table);