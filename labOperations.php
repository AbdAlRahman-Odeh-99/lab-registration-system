<?php

function goBack()
{
header('Location: ' . $_SERVER['HTTP_REFERER']);	
}

	$l=$_POST['labidAdd'];
	$sno=$_POST['snum'];
	$d=$_POST['dayAdd'];
	$t=$_POST['timeAdd'];
	$h=$_POST['hallAdd'];

    switch($l){
	case"CIS221":
	$name = "Database";
	break;
	case"CIS341":
	$name = "Web Application Development";
	break;
	case"CIS381":
	$name = "Human/Computer Interaction";
	break;
	case"CIS421":
	$name = "Database Applications";
	break;
	case"CIS441":
	$name = "Buisness Data Communication";
	break;
	}

	$conn = mysqli_connect("localhost","root","root");
	if(!$conn)
 	die("Invalid connection:".mysql_connect_error());

	$db = mysqli_select_db($conn,'labregistration');
	if(!$db)
    die("Error with connecting to the database !");


	if($_POST['action'] == 'Add Lab'){
		$q1 = "select * from labs where LabID='$l' And Section ='$sno';";
		$q2 = "select * from labs where Time='$t' And Day='$d' And Halls='$h';";
		$result1  = mysqli_query($conn,$q1);
		$result2  =  mysqli_query($conn,$q2);

		echo "$l $name $sno $d $t $h <br>";
		$q3 = "insert into labs
     		   values('$l',
               '$name',
               '$sno',
               '$d',
               '$t',
               '$h'
                );";
           
	if($r=mysqli_fetch_row($result1))
		{
	  		mysqli_close($conn);
      		die("This lab and section already exist.Please check again. <a href='adminMainPage.php'>Return to home page</a>");
      		exit();
		}
	if($r=mysqli_fetch_row($result2))
		{
       		mysqli_close($conn);
       		die("You can't have more than one lab at the same time at the same hall.Please check again.<a href='adminMainPage.php'>Return to home page</a>");
       		exit();
		}
	$result3  =  mysqli_query($conn,$q3);
	if($result3) 
    {
    mysqli_close($conn);
	goBack();
    }
    else 
    echo "Didnt add the lab. <a href='adminMainPage.php'>Return to home page</a>";
	}

	else if($_POST['action'] == 'Update Lab')
	{
        
        $q1 = "select * from labs where LabID='$l' And Section ='$sno';";
        $q2 = "update labs set Time='$t',Day='$d',Halls='$h' where LabID='$l' And Section ='$sno';";

        $result1  = mysqli_query($conn,$q1);
        if(!$r=mysqli_fetch_row($result1))
        {
	       mysqli_close($conn);
           die("The lab you are trying to update isn't available. <a href='adminMainPage.php'>Return to home page</a>");
           exit();
        }
        else
        {
             $result2  = mysqli_query($conn,$q2);
             goBack();        
        }
	}


	else if($_POST['action'] == 'Remove Lab')
	{
		echo "in delete <br>";
		echo "$l $sno <br>";
		$q1 = "select * from labs where LabID='$l' And Section='$sno';";
		$q2 = "delete from labs where LabID='$l' And Section='$sno';";
		$result1 = mysqli_query($conn,$q1);

        if($r=mysqli_fetch_row($result1))
		{
			echo "Result1: $r[0] $r[1] $r[2] $r[3] $r[4] $r[5]<br>";
			echo "Right before excuting <br>";
		    $result2 = mysqli_query($conn,$q2);
    		mysqli_close($conn);
    		echo "After excuting <br>";

			goBack();
		}
	else
		{
			mysqli_close($conn);
    		die("Didn't find the lab you are trying to delete.Please check again.<a href='adminMainPage.php'>Return to home page</a>");
    		exit();
		}
    }


    else if($_POST['action']=='Search by LabID')
    {
    	$q1 = "select * from labs where LabID='$l';";
    	$result1 = mysqli_query($conn,$q1);

    	echo "The result of the search: <br>";
    	if($r=mysqli_fetch_row($result1))
    	{
    	echo "<p><table border='1'> <tr><th>LabID</th><th>Course</th><th>Section</th><th>Day</th><th>Time</th><th>Hall</th></tr>";
    	echo "<tr><td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td></tr>";
		while($r=mysqli_fetch_row($result1))
		echo "<tr><td>$r[0]</td><td>$r[1]</td><td>$r[2]</td><td>$r[3]</td><td>$r[4]</td><td>$r[5]</td></tr>";
		echo "</table></p>";
		echo "<p><a href='adminMainPage.php'>Return to home page</a></p>";
        }
	    else
		{
			mysqli_close($conn);
    		die("Didn't find any lab with that id.<a href='adminMainPage.php'>Return to home page</a>");
    		exit();
		}
		
    }


?>