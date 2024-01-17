<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TDR Technical Test - Multiple Student Records</title>
</head>
<body>
	<?php
		$module1Average = 0;
		$module2Average = 0;
		$module3Average = 0;
		
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
		$dbConn = getConnection();
		
		$recordArray = $_GET['record'];
		$studentNumber = count($recordArray);
		
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
		foreach($recordArray as $records=>$value)
		{
			
			$retrieveSQL = "SELECT Student_ID, First_Name, Last_Name, DOB, Module1_Grade, Module2_Grade, Module3_Grade
							FROM TDR_test
							WHERE Student_ID = :record";
			$statement = $dbConn -> prepare($retrieveSQL);
			$statement -> execute(array(':record'=>$value));
			
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
				
				$module1Average += $data->Module1_Grade;
				$module2Average += $data->Module2_Grade;
				$module3Average += $data->Module3_Grade;
				
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
				</tr>";
			}
			echo"<br>";
		}
		echo"</table>
		<br>";
		
		$overallAverage = $module1Average+$module2Average+$module3Average;
		$overallAverage = $overallAverage/(3*$studentNumber);
		$overallAverage = round($overallAverage,0);
		
		$module1Average = $module1Average/$studentNumber;
		$module1Average = round($module1Average,0);
		
		$module2Average = $module2Average/$studentNumber;
		$module2Average = round($module2Average,0);
		
		$module3Average = $module3Average/$studentNumber;
		$module3Average = round($module3Average,0);
		
		echo"<table>
			<tr>
				<th>M1 Average Grade</th>
				<th>M1 Outcome</th>
				<th>M2 Average Grade</th>
				<th>M2 Outcome</th>
				<th>M3 Average Grade</th>
				<th>M3 Outcome</th>
				<th>Overall Grade</th>
				<th>Overall Outcome</th>
			</tr>
			<tr>
				<td>{$module1Average}%</td>
				<td>";
				if($module1Average<=39)
				{
					echo"Fail";
				}
				elseif($module1Average>=40 && $module1Average <=59)
				{
					echo"Pass";
				}
				elseif($module1Average>=60 && $module1Average<=69)
				{
					echo"Merit";
				}
				else
				{
					echo"Distinction";
				}
				echo"</td>
				<td>{$module2Average}%</td>
				<td>";
				if($module2Average<=39)
				{
					echo"Fail";
				}
				elseif($module2Average>=40 && $module2Average <=59)
				{
					echo"Pass";
				}
				elseif($module2Average>=60 && $module2Average<=69)
				{
					echo"Merit";
				}
				else
				{
					echo"Distinction";
				}
				echo"</td>
				<td>{$module3Average}%</td>
				<td>";
				if($module3Average<=39)
				{
					echo"Fail";
				}
				elseif($module3Average>=40 && $module3Average <=59)
				{
					echo"Pass";
				}
				elseif($module3Average>=60 && $module3Average<=69)
				{
					echo"Merit";
				}
				else
				{
					echo"Distinction";
				}
				echo"</td>
				<td>{$overallAverage}%</td>
				<td>";
				if($overallAverage<=39)
				{
					echo"Fail";
				}
				elseif($overallAverage>=40 && $overallAverage <=59)
				{
					echo"Pass";
				}
				elseif($overallAverage>=60 && $overallAverage<=69)
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
	?>
</body>
</html>