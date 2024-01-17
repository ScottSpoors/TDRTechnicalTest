<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TDR Technical Test - Append Record</title>
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
		
		echo"<br>
		<h3>Please Enter New Record Data</h3>
		<br>
		<form method='get' action='appendRecordProcess.php'>
			<label>Student ID<input type='text' name='StudentID' minlength='7' maxlength='7'></label><br>
			<br>
			<label>Forename<input type ='text' name='Forename'></label><br>
			<br>
			<label>Surname<input type='text' name='Surname'></label><br>
			<br>
			<label>Date of Birth<input type='date' name='DOB'></label><br>
			<br>
			<label>Module 1 Grade<input type='number' name='Mod1Grade' min='0' max='100' step='1'></label><br>
			<br>
			<label>Module 2 Grade<input type='number' name='Mod2Grade' min='0' max='100' step='1'></label><br>
			<br>
			<label>Module 3 Grade<input type='number' name='Mod3Grade' min='0' max='100' step='1'></label><br>
			<br>
			<input type='submit' value='Submit'>
		</form>";
	?>
</body>
</html>