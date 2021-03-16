<?php

function goBack()
	{
		header('Location: ' . $_SERVER['HTTP_REFERER']);	
	}

$cid=$_POST['cid'];
$cname=$_POST['cname'];

$regex1 = '/[A-Z]{2,3}\d{3}/';
$regex2 = '/\w+/';

$conn = mysqli_connect("localhost","root","root");
if(!$conn)
 die("Invalid connection:".mysql_connect_error());

$db = mysqli_select_db($conn,'labregistration');
if(!$db)
 die("Error with connecting to the database !");




if($_POST['action'] == 'Add Course'){
if(preg_match($regex1, $cid) and preg_match($regex2,$cname))
{
	$q1 = "insert into courses values('$cid','$cname');";
	$q2 = "select * from courses where courseid='$cid';";
	$result2  = mysqli_query($conn,$q2);
   if($r=mysqli_fetch_row($result2))
   {
   		mysqli_close($conn);
    	die("Course already exists.<br><a href='adminMainPage.php'>Return to admin page</a>");
    	exit();
   }

   $result1  = mysqli_query($conn,$q1);
   goBack();
}
else
{
	mysqli_close($conn);
    die("Invalid id or name.Try again.<br><a href='adminMainPage.php'>Return to admin page</a>");
    exit();
}
}

else if($_POST['action'] == 'Remove Course'){
	$q1 = "delete from courses where courseid='$cid';";
	$q2 = "select * from courses where courseid='$cid';";
	$result2  = mysqli_query($conn,$q2);

   	if(!$r=mysqli_fetch_row($result2))
   		{
   			mysqli_close($conn);
    		die("Course doesn't exist.<br><a href='adminMainPage.php'>Return to admin page</a>");
    		exit();
  		 }

	$result1  = mysqli_query($conn,$q1);
    goBack();
}


?>
