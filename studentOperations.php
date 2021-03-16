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
<?php
	

	session_start();
	echo("<div class='form-section form'>");
	echo ("Welcome Student : ".$_SESSION['StudentID']."<br>");
    echo ("Registration Status: ".$_SESSION['status']."<br>");



	if(!$_SESSION['status']){
		die ("<h3 style='color:red'>Registration closed</h3><div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>");
	}
	
	function goBack()
	{
		header('Location: ' . $_SERVER['HTTP_REFERER']);	
	}
	
	$conn = mysqli_connect("localhost","root","root","labregistration");
	
	if(!$conn){
		die("Invalid connection:".mysqli_connect_error());
	}
	
	$sid = $_SESSION['StudentID'];
	$l = $_POST['id'];
	$sno = $_POST['sno'];

	
	$testQuery ="select * from enroll where sid='$sid' And lid='$l';";
	$result = MYSQLi_query($conn,$testQuery);
	$testQuery2 ="select * from enroll where sid='$sid' And lid='$l' And snum='$sno';";
	$result2 = MYSQLi_query($conn,$testQuery2);
	$testQuery3 ="select * from labs where labid='$l' And section='$sno';";
	$result3 = MYSQLi_query($conn,$testQuery3);

	if($_POST['action'] == 'Register Lab'){

			if($r=mysqli_fetch_row($result)){
				mysqli_close($conn);
    			die("Already enrolled in this LAB/Section.<br> <div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>");
    			exit();
			}
		
			if(!$r=mysqli_fetch_row($result3)) {
				mysqli_close($conn);
    			die("This lab doesn't exist.<br> <div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>");
    			exit();
			}

			$sameTimeQ1="select Day,Time from labs,enroll where Labid=lid and section=snum and sid='$sid';";
			$sameTimeQ2="select Day,Time from labs where Labid='$l' and section='$sno';";

			$sameTimeResult1=MYSQLi_query($conn,$sameTimeQ1);
			$sameTimeResult2=MYSQLi_query($conn,$sameTimeQ2);
			$r2=mysqli_fetch_row($sameTimeResult2);
			while ($r1=mysqli_fetch_row($sameTimeResult1)) {
				//echo "r1:$r1[0]  $r2[0]"

				if($r1[0] == $r2[0])
				  if($r1[1] == $r2[1])
				   {	
					  {
					  mysqli_close($conn);
    				  die("You can't have two labs at the same time.<br> <div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>");
    				  exit();
    				  break;
					  }
				    }
			}

			//$query = "INSERT INTO `enroll` VALUES ($id , $_POST['snum'] , '$_POST['hall']')";
			$query = "insert into enroll values ('$sid','$l','$sno');";
			$result = MYSQLi_query($conn,$query);
			echo "LAB enroll <br> <div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>";
			//goBack();
		}

		else if($_POST['action'] == 'Remove Lab'){

			if(!$r=mysqli_fetch_row($result)){
				mysqli_close($conn);
    			die("You are not enrolled in this LAB.<br> <div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>");
    			exit();
			}
			
			if(!$r=mysqli_fetch_row($result2)) {
				mysqli_close($conn);
    			die("You are not enrolled in this Section.<br> <div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>");
    			exit();
			}
			
		//$query = "DELETE FROM `enroll` WHERE `Sid`= $id , `Lname` =  '$_POST['hall']' , `Lnumber` = $_POST['snum']";
		$query="delete from enroll where sid='$sid' and lid='$l' and snum='$sno' ;";
		$result = MYSQLi_query($conn,$query);
		echo "LAB droped <br><div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>";
		goBack();
	}

	
	if($_POST['action'] == 'Search For Lab'){
		$query3 = "SELECT * FROM `labs` WHERE `LabID` =  '$l'";
		$result3 = MYSQLi_query($conn,$query3);
		
		echo "<table border='3'><tr><th>LabID</th><th>Name</th><th>Section</th><th>Day</th><th>Time</th><th>Halls</th></tr>";
		while($r=mysqli_fetch_row($result3)){
			echo "<tr><td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td></tr>";
		}	
		echo "</table>";
		echo "<br/><br/><div class='hyperlink'><a href='StudentRegistrationPage.php'>Return to registration page</a></div>";
	}
	
	
	echo("</div>");
	
	
	
?>
</body>
</html>
