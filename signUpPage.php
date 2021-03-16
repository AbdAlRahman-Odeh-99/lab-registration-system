<?php
	
	$ID = $_POST["id"];
	$Name = $_POST["name"];
	$Age = $_POST["age"];
	$Password = $_POST["password"];
	$PasswordTest = $_POST["passwordTest"];
	
	if($Password != $PasswordTest){
		echo "<p style='color:red' >Passwords don't match</p>";
		die();
	}
	
	$conn = MYSQLi_connect("localhost","root","root","labregistration");
	if(!$conn){
		die("connection failed".mysqli_connect_error());
	}+
	
	$insertQuery = "INSERT INTO `student`(`name`, `id`, `age`, `password`) VALUES('".$Name."',".$ID.",".$Age.",'".$Password."')";
	$result = MYSQLi_query($conn,$insertQuery);
	if(!$result){
		echo "<p style='color:red' >There already exist an account with the same ID</p>";
		die();
	}
	
	echo "<h3 style='color:green' >Sign up completed</h3><h4>Please login with your new account</h4>";
	
	include "loginPage.html";
	
?>