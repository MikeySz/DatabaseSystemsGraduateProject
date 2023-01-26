<?php
#Michael Sanchez
#Customer Login
define("IN_CODE", 1);
include "dbconfig.php";
echo "<HTML>\n";
echo "<body>";

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}
#==========================Customer Cookie is found!================================
if(isset($_COOKIE['customer']) and ! isset($_POST["login"])){

$id=$_COOKIE['customer'];
#run the query using cookie value
$sql= "SELECT customer_id, login_id, password,CONCAT(first_name,' ',last_name ) name, CONCAT(address,', ',city,', ',state,' ', zipcode) address FROM 2022F_sanchem1.CUSTOMER WHERE customer_id='$id'";
$result = mysqli_query($con, $sql);


#--------------------------------------------------------------------------------------------------------------------------------
if($result) {
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$cid=$row["customer_id"];
			$clogin = $row["login_id"];
			$cpassword = $row['password'];
			$cname =$row['name'];
			$caddress =$row['address'];
			#Checks if entered password exists matches with query. If so login the user and set a cookie
			if ($cid == $id){  
				
				#we do not want to reset the cookie if the user hasnt logged back in
				#setcookie("customer", $cid, time()+60*60);
#========================================================================================================================================
#Customer Page
				#Customer greeting, uses name retrived through the previous query
				echo "Welcome customer: <b>".$cname."</b> <br>";
				echo" ".$caddress."<br> ";
				#-------------IP-------------------
				#Var to hold IP Address string
				$ip = " ".$_SERVER['REMOTE_ADDR'];

				#Return IP Address
				echo "Your IP:".$ip.'<br>';
				#Check if User is(or is NOT) from Kean
				if(strpos( $ip," 10.") !== false || strpos( $ip," 131.125.") !== false )
					echo("You are from Kean University. <br>");
				else echo "You are NOT from Kean University. <br>";
				#-------------------------------------

				#allows for Logout 
				echo "<a href='customer_logout.php' target=_self>Customer Logout</a><br>";
				#update customer data 
				echo "<a href='customer_update.php' target=_self>Update my data</a><br><br>";

				#Return to Project Phase 1 Homepage, to allow use of employee cookie
				echo"<a href='index.html' target=_self>Return to Project home page</a><br>";
				#Return to Project Phase 1 Homepage, to allow use of employee cookie
				echo"<a href='CPS5740_p1.html' target=_self>Return to Project Phase 1 Page</a>";
				

#-----------------------------------------------------------------------------------------------------------


#===========================================================================================================
			}
			else{
				echo"<a href='customer_login.html' target=_self>Return to Customer Login</a>";#return to Customer Login
				echo "<br> Authenthication Failed, please try again"; #runs if the password is not found in the database, but username is valid
				}
			}
	}
	else{
		echo"<a href='customer_login.html' target=_self>Return to Customer Login</a>";#return to Customer Login
		echo "<br> Authentication Error, please try again";   #if $result has no rows, then no such user exists in the DB
		}
}
	else {
		echo"<a href='index.html' target=_self>Return to Homepage</a>";#return to Employee Login
		echo "<br> something went wrong!";    #if all fails, then tell user something went wrong
}



}
#==========================Customer cookie is not found========================================
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

#SELECT customer_id, login_id, password,CONCAT(first_name,' ',last_name ) name, CONCAT(address,', ',city,', ',state,' ', zipcode) address FROM 2022F_sanchem1.CUSTOMER 
#Establish an intial query and run it.
$sql= "SELECT customer_id, login_id, password,CONCAT(first_name,' ',last_name ) name, CONCAT(address,', ',city,', ',state,' ', zipcode) address FROM 2022F_sanchem1.CUSTOMER WHERE login_id='$blogin'";
$result = mysqli_query($con, $sql);


#--------------------------------------------------------------------------------------------------------------------------------
if($result) {
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$cid=$row["customer_id"];
			$clogin = $row["login_id"];
			$cpassword = $row['password'];
			$cname =$row['name'];
			$caddress =$row['address'];
			#Checks if entered password exists matches with query. If so login the user and set a cookie
			if ($cpassword == $bpassword){  
				
				setcookie("customer", $cid, time()+60*60);
#========================================================================================================================================
#Customer Page
				#Customer greeting, uses name retrived through the previous query
				echo "Welcome customer: <b>".$cname."</b> <br>";
				echo" ".$caddress."<br> ";
				#-------------IP-------------------
				#Var to hold IP Address string
				$ip = " ".$_SERVER['REMOTE_ADDR'];

				#Return IP Address
				echo "Your IP:".$ip.'<br>';
				#Check if User is(or is NOT) from Kean
				if(strpos( $ip," 10.") !== false || strpos( $ip," 131.125.") !== false )
					echo("You are from Kean University. <br>");
				else echo "You are NOT from Kean University. <br>";
				#-------------------------------------

				#allows for Logout 
				echo "<a href='customer_logout.php' target=_self>Customer Logout</a><br>";
				#update customer data 
				echo "<a href='customer_update.php' target=_self>Update my data</a><br><br>";

				#Return to Project Phase 1 Homepage, to allow use of employee cookie
				echo"<a href='index.html' target=_self>Return to Project home page</a><br>";
				#Return to Project Phase 1 Homepage, to allow use of employee cookie
				echo"<a href='CPS5740_p1.html' target=_self>Return to Project Phase 1 Page</a>";
				

#-----------------------------------------------------------------------------------------------------------


#===========================================================================================================
			}
			else{
				echo"<a href='customer_login.html' target=_self>Return to Customer Login</a>";#return to Customer Login
				echo "<br> Authenthication Failed, please try again"; #runs if the password is not found in the database, but username is valid
				}
			}
	}
	else{
		echo"<a href='customer_login.html' target=_self>Return to Customer Login</a>";#return to Customer Login
		echo "<br> Authentication Error, please try again";   #if $result has no rows, then no such user exists in the DB
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