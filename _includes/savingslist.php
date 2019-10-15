<?php
	require('conn.php');

	$cono = $_POST['cono'];
	$custno = $_POST['custno'];

	$table = 'CSHEAD';
	$query = "SELECT CSHEAD.cshedID as cshedID, CSHEAD.typeID as typeID, CSHEAD.dept as dept, CSHEAD.description as description, CSHEAD.dtEnter as dtEnter, CSHEAD.dtUpdate as dtUpdate, SavType.type as type FROM CSHEAD inner join SavType on CSHEAD.typeID = SavType.SavTypeID where CSHEAD.cono = {$cono} and CSHEAD.custno = {$custno};";
	tableWrite($query, $conn, $table);
