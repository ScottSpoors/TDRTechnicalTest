<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TDR Technical Test - Single Student Record</title>
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
		
		$selectedID = filter_has_var(INPUT_GET,'studentSelect') ? $_GET['studentSelect'] : null;
		$selectedID = trim($selectedID);
		
		if(!isset($selectedID))
		{
			echo"<a href='singleStudentForm.php'>Please select a record to view</a>\n";
		}
		else
		{
			echo"<table>
					<tr>
						<th>Student ID</th>
						<th>Forename</th>
						<th>Surname</th>
						<th>Date of Birth</th>
						<th>Module 1 Grade</th>
						<th>Module 2 Grade</th>
						<th>Module 3 Grade</th>
						<th>Average Grade</th>
						<th>Outcome</th>
					</tr>";
			$retrieveSQL = "SELECT Student_ID, First_Name, Last_Name, DOB, Module1_Grade, Module2_Grade, Module3_Grade
							FROM TDR_test
							WHERE Student_ID = :selectedID";
			$statement = $dbConn -> prepare($retrieveSQL);
			$statement -> execute(array(':selectedID'=>$selectedID));
			
			while($data = $statement->fetchObject())
			{
				echo "<tr>
					<td>{$data->Student_ID}</td>
					<td>{$data->First_Name}</td>
					<td>{$data->Last_Name}</td>
					<td>{$data->DOB}</td>
					<td>{$data->Module1_Grade}%</td>
					<td>{$data->Module2_Grade}%</td>
					<td>{$data->Module3_Grade}%</td>";
				$average = $data->Module1_Grade + $data->Module2_Grade + $data->Module3_Grade;
				$average = $average/3;
				$average = round($average,0);
				echo "<td>{$average}%</td>
					<td>";
				if($average<=39)
				{
					echo"Fail";
				}
				elseif($average>=40 && $average <=59)
				{
					echo"Pass";
				}
				elseif($average>=60 && $average<=69)
				{
					echo"Merit";
				}
				else
				{
					echo"Distinction";
				}
				echo"</td>
				</tr>
				</table>";
			}
		}
		
		
	?>
</body>
</html>