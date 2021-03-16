<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="main.css">
	<title>Admin Home page</title>
</head>

<body>
	<button id="myBtn" title="Go to top">Top</button>
	<div>
		<a href="startPage.html">
			<input class="btn-form__logout" type="button" value="Logout">
		</a>
	</div>

	<div>
		<div>
			<img src="images/JustUni.png" alt="" srcset="">
		</div>

		<form class="form-section form" method="post" action="courses.php">
			<h3 style="justify-content: center">Courses</h3>
			<p>
				<label class="label-form">Course ID: </label>
				<input class="txtInput" type="text" placeholder="Course ID" name="cid">
			</p>
			<p>
				<label class="label-form">Course Name:</label>
				<input class="txtInput" type="text" placeholder="Course Name" name="cname">
			</p>
			<p>
				<label class="label-form">Action:</label>
				<select class="select-css" name="action">
					<option>Add Course</option>
					<option>Remove Course</option>
				</select>
			</p>
			<p>
				<input class="btn-form" type="submit" value="Proceed">
			</p>
		</form>
	</div>
	<br><br>
	<br><br>
	<br><br>
	<br><br>
	<div>



		<form class="form-section form" method="post" action="labOperations.php">
			<h3 style="justify-content: center">Lab Operations</h3>
			<!--<p>
			LabID: <select name="labidAdd">
			<option>CIS221</option>
			<option>CIS341</option>
			<option>CIS381</option>
			<option>CIS421</option>
			<option>CIS441</option>
		</select> 
    	</p>-->
			<?php
			$conn = mysqli_connect("localhost", "root", "root", "labregistration");
			$q = "select distinct courseid from courses;";
			$result = mysqli_query($conn, $q);

			echo "<p>
			<label class='label-form'>LabID:</label>
			<select class='select-css' name='labidAdd'>";
			while ($r = mysqli_fetch_row($result))
				echo "<option>$r[0]</option>";
			echo "</select> </p>";
			?>

			<p>
				<label class="label-form"> Section: <input type="text" name="snum" placeholder="section#"></label>
			</p>

			<p class="select-div">
				<label class="label-form"> Day: </label>
				<select class="select-css" name="dayAdd">
					<option>SUN</option>
					<option>MON</option>
					<option>TUE</option>
					<option>WED</option>
					<option>THU</option>
				</select>
			</p>

			<p class="select-div">
				<label class="label-form"> Time: </label>
				<select class="select-css" name="timeAdd">
					<option>08:30-10:00</option>
					<option>10:00-11:30</option>
					<option>11:30-1:00</option>
					<option>01:00-02:30</option>
					<option>02:30-04:00</option>
				</select>
			</p>

			<p class="select-div">
				<label class="label-form">
					Hall:
				</label>
				<select class="select-css" name="hallAdd">
					<option>CIS01-PH3L-1</option>
					<option>CIS02-PH3L-1</option>
					<option>CIS03-PH1L-1</option>
					<option>CIS04-G2L2</option>
					<option>CIS05-G2L2</option>
					<option>CIS06-N2L1</option>
					<option>CIS07-A2L2</option>
				</select>
			</p>

			<p class="select-div">
				<label class="label-form">
					Action:
				</label>
				<select class="select-css" name="action">
					<option>Add Lab</option>
					<option>Remove Lab</option>
					<option>Update Lab</option>
					<option>Search by LabID</option>
				</select>
			</p>

			<p>
				<input class="btn-form" type="submit" value="Proceed">
			</p>

		</form>
	</div>

	<div class="form-section form">
		<h3 style="justify-content: center">Open/Close Registration</h3>
		<?php
		if ($_SESSION['status'])
			echo "<p>Registration Status: <span style='color:green; font-weight: bold'>The registration is opened.</span></p>";
		else
			echo "<p>Registration Status: <span style='color:red; font-weight: bold'>The registration is closed.</span></p>";
		?>
		<form method="post" action="openRegistration.php">
			<p>
				<input class="btn-form__open" type="submit" value="Open Registration">
			</p>
		</form>
		<form method="post" action="closeRegistration.php">
			<p>
				<input class="btn-form__close" type="submit" value="Close Registration">
			</p>
		</form>

	</div>
	<script>
		//Get the button
		var mybutton = document.getElementById("myBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {
			scrollFunction()
		};

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}

		mybutton.addEventListener('click', topFunction);
	</script>
</body>

</html>


<?php
$conn = mysqli_connect("localhost", "root", "root");
if (!$conn)
	die("Invalid connection:" . mysqli_connect_error());

$db = mysqli_select_db($conn, 'labregistration');
if (!$db)
	die("Error with connecting to the database !");

$q = "select * from labs;";
$result  = mysqli_query($conn, $q);

echo "<p><table border='1'> <tr><th>LabID</th><th>Course</th><th>Section</th><th>Day</th><th>Time</th><th>Hall</th></tr>";
while ($r = mysqli_fetch_row($result))
	echo "<tr><td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td></tr>";
echo "</table></p>";

?>