<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TDR Technical Test - Record Updated</title>
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
		
		try
		{
			$stuID = filter_has_var(INPUT_GET,'StudentID') ? $_GET['StudentID'] : null;
			$stuID = trim($stuID);
			$fName = filter_has_var(INPUT_GET,'Forename') ? $_GET['Forename'] : null;
			$fName = trim($fName);
			$sName = filter_has_var(INPUT_GET,'Surname') ? $_GET['Surname'] : null;
			$sName = trim($sName);
			$dob = filter_has_var(INPUT_GET,'DOB') ? $_GET['DOB'] : null;
			$dob = trim($dob);
			$mod1 = filter_has_var(INPUT_GET,'Mod1Grade') ? $_GET['Mod1Grade'] : null;
			$mod1 = trim($mod1);
			$mod2 = filter_has_var(INPUT_GET,'Mod2Grade') ? $_GET['Mod2Grade'] : null;
			$mod2 = trim($mod2);
			$mod3 = filter_has_var(INPUT_GET,'Mod3Grade') ? $_GET['Mod3Grade'] : null;
			$mod3 = trim($mod3);
			
			$insertSQL = "UPDATE TDR_test
						SET First_Name = :fName,
						Last_Name = :sName,
						DOB = :dob,
						Module1_Grade = :mod1,
						Module2_Grade = :mod2,
						Module3_Grade = :mod3
						WHERE Student_ID = :stuID";
			$statement = $dbConn->prepare($insertSQL);
			$statement->execute(array(':stuID'=>$stuID, ':fName'=>$fName, ':sName'=>$sName, ':dob'=>$dob, ':mod1'=>$mod1, ':mod2'=>$mod2, ':mod3'=>$mod3));
			echo"<p>Record Successfully Updated</p>";
		}
		catch(Exception $e)
		{
			echo"<p>A problem occured, please try again.</p>\n";
		}
	?>
</body>
</html>