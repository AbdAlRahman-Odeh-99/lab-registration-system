<?php
session_start();
?>

<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="main.css">
	<title>Student registration Home page</title>
</head>

<body>
	<div>
		<img src="images/JustUni.png" alt="" srcset="">
	</div>
	<div style="justify-content: center">
		<form class="form-section form" method="post" action="studentOperations.php">
			<?php
			echo ("Welcome Student : " . $_SESSION['StudentID'] . "<br>");
			$sid = $_SESSION['StudentID'];
			echo "sid:$sid";
			if ($_SESSION['status'])
				echo "<p class='RegistrationStatus'>Registration Status: <span style=color:green; font-weight: bold'>Opened.</span></p>";
			else
				echo "<p class='RegistrationStatus'>Registration Status: <span style='color:red'; font-weight: bold>Closed.</span></p>";
			?>

			<h3 style="justify-content: center">Lab Registration</h3>
			<?php
			$conn = mysqli_connect("localhost", "root", "root", "labregistration");
			$q1 = "select distinct labID from labs";
			$q2 = "select distinct Section from labs";
			$result1  = mysqli_query($conn, $q1);
			$result2 = mysqli_query($conn, $q2);
			echo "<p class='select-div'> <label class='label-form'>
				  LabID: </label> <select class='select-css' name='id'>";
			while ($r = mysqli_fetch_row($result1))
				echo "<option>$r[0]</option>";
			echo "</select> </p>";
			echo "<p class='select-div'>
			<label class='label-form'>Section:
		    </label> <select class='select-css' name='sno'>";
			while ($r = mysqli_fetch_row($result2))
				echo "<option>$r[0]</option>";
			echo "</select> </p>";

			mysqli_close($conn);
			?>

			<p class="select-div">
				<label class="label-form">
					Action:
				</label>
				<select class="select-css" name="action">
					<option>Register Lab</option>
					<option>Remove Lab</option>
					<option>Search For Lab</option>
				</select>
			</p>

			<p><input class="btn-form" type="submit" value="Proceed"></p>
		</form>
	</div>
</body>

</html>

<?php
echo "<h3 style='justify-content: center'>Registered Labs</h3>";
$conn = mysqli_connect("localhost", "root", "root");
if (!$conn)
	die("Invalid connection:" . mysqli_connect_error());

$db = mysqli_select_db($conn, 'labregistration');
if (!$db)
	die("Error with connecting to the database !");

$q = "select LabID,Name,Section,Day,Time,Halls from enroll,labs where SID='$sid' And LID=LabID And Snum=Section;";
$result  = mysqli_query($conn, $q);

echo "<p><table border='1'> <tr><th>LabID</th><th>Course</th><th>Section</th><th>Day</th><th>Time</th><th>Hall</th></tr>";
while ($r = mysqli_fetch_row($result))
	echo "<tr><td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td></tr>";
echo "</table></p>";

?>