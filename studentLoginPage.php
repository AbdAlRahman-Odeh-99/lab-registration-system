<?php
   
   session_start();
   $_SESSION['StudentID'] = $_POST["id"] ;


	function transportPage(){
		$url = "studentRegistrationPage.php";
		header("Location: ".$url);
	}
	
	$ID = $_POST["id"];
	$Password = $_POST["password"];
	
  

	$conn = MYSQLi_connect("localhost","root","root","labregistration");

	if(!$conn){
		die("connection failed".mysqli_connect_error());
	}

	$query = "SELECT * FROM student WHERE id='$ID'";
     //AND password='$Password';
	$result = MYSQLi_query($conn,$query);

	$r = mysqli_fetch_row ($result);

	if($r[1] != $ID)
	{
		die("Log-in failed. Student not found.
		     <br> 
		     <a href='studentLoginPage.html'>Go Back To Login Page</a>
		     <br>
		     <a href='signUpPage.html'>Go Back To Signup Page</a>
		     ");
		exit();
	}
	else
	{
		if($r[3] != $Password)
		{
			die("Log-in failed. Wrong Password.
			     <br> 
			     <a href='studentLoginPage.html'>Go Back To Login Page</a>
			     ");
			exit();
		}
		else
		{
	      transportPage();		
		}
	}

	
	
?>