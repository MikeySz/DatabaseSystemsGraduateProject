<?php
#Michael S.
#Phase 2 Display Employee
#Displays the employee info found within the EMPLOYEE2 table in the CPS5740 DB.
include "dbconfig.php";
$con=mysqli_connect($server, $login, $password, $dbname);

#When connection fails, close the program
if(!$con){
	die("Connection fail!");
}

else{
#Else continue with the employee display program
	echo "The following employees are in the database.";
	$query = "SELECT employee_id id, login,password, name, role  FROM EMPLOYEE2";
	$result = mysqli_query($con, $query);
	#Create a table to hold all records of data returned from query above.
	if($result){
		if(mysqli_num_rows($result)>0){
			echo"<TABLE border =1>\n";
			echo"<TR><TH>ID<TH>Login<TH>Password<TH>Name<TH>Role\n";
			while($row = mysqli_fetch_array($result)){
				$id=$row['id'];
				$login=$row['login'];
				$pwd=$row['password'];
				$name=$row['name'];
				$role=$row['role'];
				echo "<TR><TD>$id<TD>$login<TD>$pwd<TD>$name<TD>$role\n";
			}
			echo"</TABLE>\n"; #close table
		}
		#If no records, then we return message.
		else{
			echo"<br>No Record Found!";
		}
		mysqli_free_result($result);
	}
	else{
		
	}	
	mysqli_close($con);


}

?>