<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TDR Technical Test - Select Students</title>
</head>
<body>
	<?php
		echo
		'<header>
			<a href="homePage.html">TDR Technical Test</a>
		</header>
		<nav>
			<li><a href="homePage.html">Home</a></li>
			<li><a href="singleStudentForm.php">View a Single Student Record</a></li>
			<li><a href="multiStudentForm.php">View Multiple Student Records</a></li>
			<li><a href="updateStudentSelect.php">Update a Student Record</a></li>
			<li><a href="appendRecordForm.php">Add a new Student Record</a></li>
		</nav>';
	
		echo"
		<form id='multiStudentForm' action='multiStudentProcess.php' method='get'>
			<h3>Select Student Record(s)</h3>";
			
		require_once('database_conn.php');
		$dbConn = getConnection();
		
		$retrieveSQL = "SELECT Student_ID, First_Name, Last_Name
							FROM TDR_test
							ORDER BY Last_Name";
		$receivedRecords = $dbConn->query($retrieveSQL);
		
		while ($student = $receivedRecords->fetchObject())
		{
			echo "\t<div class='studentRecord'>
					<br>
					{$student->Student_ID} - 
					{$student->Last_Name},
					{$student->First_Name}
					<input type='checkbox' name='record[]' value='{$student->Student_ID}'>
					</div>\n
					";
		}
		echo"<br>
			\n<span class='submit'><input type='submit' name='submit' value='Submit'></span>
		</form>
		";
	?>
</body>
</html>