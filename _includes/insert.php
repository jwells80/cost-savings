<?php
if (isset($_POST['cono']) === true && empty($_POST['cono']) === false) {
	require('conn.php');

	$cono = mysql_real_escape_string(trim($_POST['cono']));
	$custno = mysql_real_escape_string(trim($_POST['custno']));
	$custname = mysql_real_escape_string(trim($_POST['custname']));
	$address = mysql_real_escape_string(trim($_POST['address']));
	$address2 = mysql_real_escape_string(trim($_POST['address2']));
	$city = mysql_real_escape_string(trim($_POST['city']));
	$state = mysql_real_escape_string(trim($_POST['state']));
	$zip = mysql_real_escape_string(trim($_POST['zip']));
	$contact = mysql_real_escape_string(trim($_POST['contact']));
	$repNo = mysql_real_escape_string(trim($_POST['repNo']));
	
	$query = "INSERT INTO customer (cono, custno, custname, address, address2, city, state, zip, contact, repNo) VALUES ('{$cono}', '{$custno}', '{$custname}', '{$address}', '{$address2}', '{$city}', '{$state}', '{$zip}', '{$contact}', '{$repNo}');";

	$result = mysql_query($query, $conn);
	if (! $result) {
		die('Could not enter data: '. mysql_error());
	}
	echo "Entered data succesfully";
	mysql_close($conn);
}