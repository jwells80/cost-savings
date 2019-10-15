<?php
// Check if Post Variables are set before quering the database
if (isset($_POST['request']) === true && empty($_POST['request']) === false) {
	
	// Require common php file
	require('conn.php');

	// Variables for Post Values
	$request = mysql_real_escape_string(trim($_POST['request']));
	$requestVal = mysql_real_escape_string(trim($_POST['requestVal']));
	$query = "SELECT customer.cono, customer.custno, customer.custname, customer.contact, customer.address, customer.city, customer.state, customer.zip, customer.repNo as RepNo, Rep.RepName as RepName FROM customer inner join Rep on customer.repNo = Rep.RepNo where customer." 
		. $request . " = '" . $requestVal . "';";
	// Query for database lookup
	/*$query = ("select * from customer where customer." 
		. $request . " = '" . $requestVal . "';");*/
	
	// Retrieve data from database and write table part
	tableWrite($query, $conn);
}