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

if(isset($_COOKIE['employee'])){
#================Cookie is found=================================================================-
$bid = $_COOKIE['employee'];	
#Establish an intial query and run it.
$sql= "SELECT employee_id, login, password, role, name  FROM CPS5740.EMPLOYEE2 WHERE employee_id='$bid'";
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
			#Checks if entered password exists matches with query. If so login the user and Reset a cookie
			if ($eid == $_COOKIE['employee']){  
				
				setcookie("employee", $eid, time()+60*60);
				setcookie("role", $erole, time()+60*60);
#========================================================================================================================================
#Employee Page
				$role = " ";
				#Get the role
				if($erole == 'M') 
					$role = 'Manager';
				else if ($erole == 'E')
					$role = 'Employee';

				// #Var to hold IP Address string
				// $ip = " ".$_SERVER['REMOTE_ADDR'];

				// #Return IP Address
				// echo "Your IP:".$ip.'<br>';
				// #Check if User is(or is NOT) from Kean
				// if(strpos( $ip," 10.") !== false || strpos( $ip," 131.125.") !== false )
				// 	echo("You are from Kean University. <br>");
				// else echo "You are NOT from Kean University. <br>";

				#Employee greeting, uses name retrived through the previous query
				echo "Welcome ".$role .": <b>".$ename."</b> <br>";


				#allows for Logout 
				echo "<a href='p2_employee_logout.php' target=_self>".$role." Logout</a><br>";
				#Return to Project Phase 2 Homepage, to allow use of employee cookie
				echo"<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Page</a>";
				echo"<br><br>";

				#Phase 2 Buttons
				#Add Products
				echo"<a href='p2_employee_add_product.php' target=_self>Add Product</a><br>";
				#Search & Update Product
				echo"<a href='employee_display_product.php' target=_self>Search & Update Product</a><br>";
				#View All Vendors
				echo"<a href='employee_view_vendors.php' target=_self>View Vendors</a><br><br>";

				#Manager only options
				#Period Values include all = all, pwk= past week, cmt= current month, and pmt= past month
				#type values include as= All Sales, pr= products, vn= Vendors.
				If($erole == 'M'){
				echo"<form name ='input' action='manager_view_reports.php' method='post'>View Reports - Period :"; 
				echo"<select name='period' required='required'>
				<option value='all' selected= 'selected'>All</option>
				<option value='pwk'>Past Week</option>
				<option value='cmt'>Current Month</option>
				<option value='pmt'>Past Month</option>
				<option value='yyr'>Past Year </option>
				</select>";
				echo", by: "; 
				echo"<select name='type' required='required'>
				<option value='as' selected= 'selected'>All Sales</option>
				<option value='pr'>Products</option>
				<option value='vn'>Vendors</option>
				</select>"; 
				echo"<input type='submit' value='submit'></form>";
				}


#-----------------------------------------------------------------------------------------------------------


#===========================================================================================================
								}
					else{
						echo"<a href='p2_employee_login.html' target=_self>Return to Employee Login</a>";#return to Employee Login
						echo "<br> Something went wrong!"; 
						}
					}
			}
			else{
				echo"<a href='p2_employee_login.html' target=_self>Return to Employee Login</a>";#return to Employee Login
				echo "<br> <br> Something went wrong!";   
		}
		}
			else {
				echo"<a href='index.html' target=_self>Return to Homepage</a>";#return to Employee Login
				echo "<br> Something went wrong!";   
		}
		}


#===================================================================================================
#=====================cookie not found and a POST Method is not used============================
elseif(!isset($_COOKIE['employee'])  AND !isset($_POST['login']) ){

mysqli_close($con);
header("Location:p2_employee_login.html");

}
#===================Cookie Not Found =============================================================
else{
#retrieve the login and password from the post method
$blogin=mysqli_real_escape_string($con,$_POST["login"]);
if(empty(trim($blogin))){
	die("Empty Login!");
}
$bpassword=mysqli_real_escape_string($con,$_POST["password"]);


if(empty(trim($bpassword))){
	die("Empty password!");
}
$hpassword = hash("sha256", $bpassword);


#Establish an intial query and run it.
$sql= "SELECT employee_id, login, password, role, name  FROM CPS5740.EMPLOYEE2 WHERE login='$blogin'";
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
			if ($hpassword == $epassword){  
				
				setcookie("employee", $eid, time()+60*60);
				setcookie("role", $erole, time()+60*60);
#========================================================================================================================================
#Employee Page
				$role = " ";
				#Get the role
				if($erole == 'M') 
					$role = 'Manager';
				else if ($erole == 'E')
					$role = 'Employee';

				// #Var to hold IP Address string
				// $ip = " ".$_SERVER['REMOTE_ADDR'];

				// #Return IP Address
				// echo "Your IP:".$ip.'<br>';
				// #Check if User is(or is NOT) from Kean
				// if(strpos( $ip," 10.") !== false || strpos( $ip," 131.125.") !== false )
				// 	echo("You are from Kean University. <br>");
				// else echo "You are NOT from Kean University. <br>";

				#Employee greeting, uses name retrived through the previous query
				echo "Welcome ".$role .": <b>".$ename."</b> <br>";


				#allows for Logout 
				echo "<a href='p2_employee_logout.php' target=_self>".$role." Logout</a><br>";
				#Return to Project Phase 2 Homepage, to allow use of employee cookie
				echo"<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Page</a>";
				echo"<br><br>";
				
				#Phase 2 Buttons
				#Add Products
				echo"<a href='p2_employee_add_product.php' target=_self>Add Product</a><br>";
				#Search & Update Product
				echo"<a href='employee_display_product.php' target=_self>Search & Update Product</a><br>";
				#View All Vendors
				echo"<a href='employee_view_vendors.php' target=_self>View Vendors</a><br><br>";

				#Manager only options
				#Period Values include all = all, pwk= past week, cmt= current month, and pmt= past month
				#type values include as= All Sales, pr= products, vn= Vendors.
				If($erole == 'M'){
				echo"<form name ='input' action='manager_view_reports.php' method='post'>View Reports - Period :"; 
				echo"<select name='period' required='required'>
				<option value='all' selected= 'selected'>All</option>
				<option value='pwk'>Past Week</option>
				<option value='cmt'>Current Month</option>
				<option value='pmt'>Past Month</option>
				<option value='yyr'>Past Year </option>
				</select>";
				echo", by: "; 
				echo"<select name='type' required='required'>
				<option value='as' selected= 'selected'>All Sales</option>
				<option value='pr'>Products</option>
				<option value='vn'>Vendors</option>
				</select>"; 
				echo"<input type='submit' value='submit'></form>";
				}




#-----------------------------------------------------------------------------------------------------------


#===========================================================================================================
			}
			else{
				echo"<a href='p2_employee_login.html' target=_self>Return to Employee Login</a>";#return to Employee Login
				echo "<br> Employee <b>$blogin</b> exists but password not matches"; #runs if the password is not found in the database, but username is valid
				}
			}
	}
	else{
		echo"<a href='p2_employee_login.html' target=_self>Return to Employee Login</a>";#return to Employee Login
		echo "<br> Login ID <b>$blogin</b> doesn't exists in the database";   #if $result has no rows, then no such user exists in the DB
		}
}
	else {
		echo"<a href='index.html' target=_self>Return to Homepage</a>";#return to Employee Login
		echo "<br> something went wrong!";    #if all fails, then tell user something went wrong
}



}



echo"</body>";
echo "</HTML>";
mysqli_close($con);
?>