<?php
#Michael Sanchez
#Employee Login
define("IN_CODE", 1);
include "dbconfig.php";
echo "<HTML>\n";
echo "<body>";

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}

#retrieve the login and password from the post method
$blogin=mysqli_real_escape_string($con,$_POST["login"]);
if(empty(trim($blogin))){
	die("Empty Login!");
}
$bpassword=mysqli_real_escape_string($con,$_POST["password"]);
if(empty(trim($bpassword))){
	die("Empty password!");
}


#Establish an intial query and run it.
$sql= "SELECT employee_id, login, password, role, name  FROM CPS5740.EMPLOYEE WHERE login='$blogin'";
$result = mysqli_query($con, $sql);


#--------------------------------------------------------------------------------------------------------------------------------
if($result) {
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$elogin = $row["login"];
			$epassword = $row['password'];
			$eid =$row['employee_id'];
			$erole =$row['role'];
			$ename =$row['name'];
			#Checks if entered password exists matches with query. If so login the user and set a cookie
			if ($epassword == $bpassword){  
				
				setcookie("employee", $eid, time()+60*60);
#========================================================================================================================================
#Employee Page
				$role = " ";
				#Get the role
				if($erole == 'M') 
					$role = 'Manager';
				else if ($erole == 'E')
					$role = 'Employee';

				#Var to hold IP Address string
				$ip = " ".$_SERVER['REMOTE_ADDR'];

				#Return IP Address
				echo "Your IP:".$ip.'<br>';
				#Check if User is(or is NOT) from Kean
				if(strpos( $ip," 10.") !== false || strpos( $ip," 131.125.") !== false )
					echo("You are from Kean University. <br>");
				else echo "You are NOT from Kean University. <br>";

				#Employee greeting, uses name retrived through the previous query
				echo "Welcome ".$role .": <b>".$ename."</b> <br>";


				#allows for Logout 
				echo "<a href='employee_logout.php' target=_self>".$role." Logout</a><br>";
				#Return to Project Phase 1 Homepage, to allow use of employee cookie
				echo"<a href='CPS5740_p1.html' target=_self>Return to Project Phase 1 Page</a>";
				

#-----------------------------------------------------------------------------------------------------------


#===========================================================================================================
			}
			else{
				echo"<a href='employee_login.html' target=_self>Return to Employee Login</a>";#return to Employee Login
				echo "<br> Employee <b>$blogin</b> exists but password not matches"; #runs if the password is not found in the database, but username is valid
				}
			}
	}
	else{
		echo"<a href='employee_login.html' target=_self>Return to Employee Login</a>";#return to Employee Login
		echo "<br> Login ID <b>$blogin</b> doesn't exists in the database";   #if $result has no rows, then no such user exists in the DB
		}
}
	else {
		echo"<a href='index.html' target=_self>Return to Homepage</a>";#return to Employee Login
		echo "<br> something went wrong!";    #if all fails, then tell user something went wrong
}
echo"</body>";
echo "</HTML>";
mysqli_close($con);
?>