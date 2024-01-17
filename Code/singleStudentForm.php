<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TDR Technical Test - Select Student</title>
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
		
		require_once("database_conn.php");
		$dbConn=getConnection();
		$retrieveSQL = "SELECT Student_ID, First_Name, Last_Name
						FROM TDR_test
						ORDER BY Last_Name";
		$query = $dbConn->query($retrieveSQL);
		echo"<br>
			<form method ='get' action='singleStudentProcess.php'>
				<label>Select a Student <select name='studentSelect'>";
				while($student=$query->fetchObject())
				{
					echo"<option value=$student->Student_ID>$student->Student_ID - $student->Last_Name, $student->First_Name</option>";
				}
				echo"</select></label>\n
				<input type='Submit' value='Submit'>
			</form>";
	?>
</body>
</html>