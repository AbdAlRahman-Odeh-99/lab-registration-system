<?php

	function transportPage(){
		$url = "adminMainPage.php";
		header("Location: ".$url);
	}
	
	
	$UserName = $_POST["username"];
	$Password = $_POST["password"];
	
	$conn = MYSQLi_connect("localhost","root","root","labregistration");
	if(!$conn){
		die("connection failed".mysqli_connect_error());
	}
	
	//$query = "SELECT * FROM admin WHERE username = '$UserName' AND password = '$Password';";
    $query = "SELECT * FROM admin WHERE username ='$UserName';";

	$result = MYSQLi_query($conn,$query);

	$r = mysqli_fetch_row ($result);

	if($r[0] != $UserName)
	{
		die("Log-in failed. Admin not found.
		     <br> 
		     <a href='adminLoginPage.html'>Go Back To Login Page</a>
		     ");
		exit();
	}
	else
	{
		if($r[1] != $Password)
		{
			die("Log-in failed. Wrong Password.
			     <br> 
			     <a href='adminLoginPage.html'>Go Back To Login Page</a>
			     ");
			exit();
		}
		else
		{
	      transportPage();		
		}
	}

   /*
 	if(MYSQLi_num_rows($result) == 0){
		die("login failed. <br> <a href='adminLoginPage.html'> Return to Admin Login Page</a>");
		exit();
	}
			
	transportPage();
	*/
	
?>
