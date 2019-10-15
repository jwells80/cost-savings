<?php
	// Functions
	function tableWrite($query, $conn, $table) {
		//Output varible initiation
		$output = '';
		
		// Retrieve Data from database
		$results = mysql_query($query, $conn);
		$row = mysql_fetch_array($results, MYSQL_ASSOC);

		// Write table part from database.
		do {
			if ($table === 'CSHEAD') {
				if ($row['type']) {
					$output .= "<tr><td><button type='button' class='btn btn-default updateCostBtn'>Update</button></td>";
					$output .= "<td>" . $row['type'] . "</td>";
					$output .= "<td>" . $row['dept'] . "</td>";
					$output .= "<td>" . $row['description'] . "</td>";
					$output .= "<td>" . $row['dtEnter'] . "</td>";
					$output .= "<td>" . $row['dtUpdate'] . "</td>";
					$output .= '<td class="hideRepNo">' . $row['typeID'] . '</td>';
					$output .= '<td class="hideRepNo">' . $row['cshedID'] . '</td></tr>';
				} else {
					$output = "No Cost Saving Found";
				}
			} else {
				if ($row['cono']) {
					$output .= "<tr><td><button type='button' class='btn btn-default updateBtn'>Update</button></td>";
					$output .= "<td><button type='button' class='btn btn-default newBtn'>Cost Saving</button></td><td>". $row['cono'] . "</td>";
					$output .= "<td>" . $row['custno'] . "</td>";
					$output .= "<td>" . $row['custname'] . "</td>";
					$output .= "<td>" . $row['contact'] . "</td>";
					$output .= "<td>" . $row['address'] . "</td>";
					$output .= "<td>" . $row['city'] . "</td>";
					$output .= "<td>" . $row['state'] . "</td>";
					$output .= "<td>" . $row['zip'] . "</td>";
					$output .= "<td>" . $row['RepName'] . "</td>";
					$output .= '<td class="hideRepNo">' . $row['RepNo'] . '</td></tr>';
				} else {
					$output = "No Data Found";
				}
			}
		}
		while ($row = mysql_fetch_array($results, MYSQL_ASSOC));
		mysql_free_result($results);

		// Check for results
		if (! $results) {
			die('Could not enter data: '.mysql_error());
		}

		// Pass table part to JS
		echo $output;

		// Close data connection
		mysql_close($conn);
	}
	function selectPull($query, $conn, $table) {
		$output = '';
		$results = mysql_query($query, $conn);
		$row = mysql_fetch_array($results, MYSQL_ASSOC);
		$key = '';
		$value = '';
		if ($table === 'SavType') {
				$output .= '<option value="0">Please Select a Type..</option>';
			}
		do {
			if ($table === 'Rep') {
				$key = $row['RepNo'];
				$value = $row['RepName'];
			} elseif ($table === 'cono') {
				$key = $row['cono'];
				$value = $row['Description'];
			} elseif ($table === 'SavType') {
				$key = $row['SavTypeID'];
				$value = $row['type'];
			}
			$output .= '<option value="' . $key; 
			$output .= '">' . $value; 
			if ($table != 'SavType') {
				$output .= ' (' . $key . ')';
			}
			$output .= '</option>';
		}
		while ($row = mysql_fetch_array($results, MYSQL_ASSOC));
		echo $output;
		mysql_free_result($results);
		if (! $results) {
			die('Could not retreive data: '.mysql_error());
		}
		mysql_close($conn);
	}
	function dataUpdate($query, $conn) {
		$results = mysql_query($query, $conn);
		echo 'Data Updated Sucessfully';
		mysql_free_result($results);
		if (! $results) {
			die('Could not enter data: '.mysql_error());
		}
		mysql_close($conn); 
	}
