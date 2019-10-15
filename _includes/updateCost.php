<?php
	require('conn.php');
	$query ="";
	$todaysDate = date("Y-m-d");
	$typeID = mysql_real_escape_string(trim($_POST['typeID']));
	$dept = mysql_real_escape_string(trim($_POST['dept']));
	$description = mysql_real_escape_string(trim($_POST['description']));
	
	if (isset($_POST['cono']) && isset($_POST['custno'])) {
		$cono = mysql_real_escape_string(trim($_POST['cono']));
		$custno = mysql_real_escape_string(trim($_POST['custno']));
		$query = "INSERT INTO CSHEAD (cono, custno, typeID, dept, description, dtEnter) VALUES ('{$cono}', '{$custno}', '{$typeID}', '{$dept}', '{$description}', '{$todaysDate}');"; 
	} elseif (isset($_POST['cshedID'])) {
		$cshedID = mysql_real_escape_string(trim($_POST['cshedID']));
		$query = "UPDATE CSHEAD SET typeID='{$typeID}', dept='{$dept}', description='{$description}', dtUpdate='{$todaysDate}' WHERE cshedID='{$cshedID}';";
	}
	dataUpdate($query, $conn);
	echo date("Y/m/d");