<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TDR Technical Test - Update Record</title>
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
		
		$selectedID = filter_has_var(INPUT_GET,'studentSelect') ? $_GET['studentSelect'] : null;
		$selectedID = trim($selectedID);
		
		if(!isset($selectedID))
		{
			echo"<a href='singleStudentForm.php'>Please select a record to view</a>\n";
		}
		else
		{
			require_once("database_conn.php");
			$dbConn=getConnection();
			$retrieveSQL = "SELECT Student_ID, First_Name, Last_Name, DOB, Module1_Grade, Module2_Grade, Module3_Grade
							FROM TDR_test
							WHERE Student_ID = :selectedID";
			$statement = $dbConn -> prepare($retrieveSQL);
			$statement -> execute(array(':selectedID'=>$selectedID));
			echo"<br>
			<form method='get' action='updateStudentProcess.php'>";
			while($data=$statement->fetchObject())
			{
				echo"<label>Student ID<input type='text' name='StudentID' value='$data->Student_ID' readonly></label><br>
				<br>
				<label>Forename<input type ='text' name='Forename' value='$data->First_Name'></label><br>
				<br>
				<label>Surname<input type='text' name='Surname' value ='$data->Last_Name'></label><br>
				<br>
				<label>Date of Birth<input type='date' name='DOB' value='$data->DOB'></label><br>
				<br>
				<label>Module 1 Grade<input type='number' name='Mod1Grade' value='$data->Module1_Grade' min='0' max='100' step='1'></label><br>
				<br>
				<label>Module 2 Grade<input type='number' name='Mod2Grade' value='$data->Module2_Grade' min='0' max='100' step='1'></label><br>
				<br>
				<label>Module 3 Grade<input type='number' name='Mod3Grade' value='$data->Module3_Grade' min='0' max='100' step='1'></label><br>
				<br>
				<input type='submit' value='Submit'>";
			}
			echo"</form>";
		}
	?>
</body>
</html>