<?php
	require('conn.php');
	$table = "customer";
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
	$query = "UPDATE {$table} SET  custname='{$custname}', address='{$address}', address2='{$address2}', city='{$city}', state='{$state}', zip='{$zip}', contact='{$contact}', repNo='{$repNo}' WHERE cono='{$cono}' AND custno='{$custno}';";
	dataUpdate($query, $conn);
	