<?php
#Michael Sanchez
#Customer Signup PHP Phase 2 Edition
define("IN_CODE", 1);
include "dbconfig.php";
echo "<HTML>\n";
echo "<body>";

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}

#=======================Empty Check==========================
#retrieve the all values from the customer signup HTML post method
#if data is empty we do not want to proceed
$clogin=mysqli_real_escape_string($con,$_POST["login"]);
if(empty(trim($clogin))) {
	die("Login is not valid! Empty! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}
$clogin = trim($clogin, " ");

$cfname=mysqli_real_escape_string($con,$_POST["fname"]);
if(empty(trim($cfname))) {
	die("First Name is not valid! Empty! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}
$cfname = trim($cfname, " ");

$clname=mysqli_real_escape_string($con,$_POST["lname"]);
if(empty(trim($clname))) {
	die("Last Name is not valid! Empty! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}
$clname = trim($clname, " ");

$ctel=mysqli_real_escape_string($con,$_POST["tel"]);
if(empty(trim($ctel))) {
	die("Telephone is not valid! Empty! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}
$ctel = trim($ctel, " ");

$caddress=mysqli_real_escape_string($con,$_POST["address"]);
if(empty(trim($caddress))) {
	die("Address is not valid! Empty! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}
$caddress = trim($caddress, " ");

$ccity=mysqli_real_escape_string($con,$_POST["city"]);
if(empty(trim($ccity))) {
	die("City is not valid! Empty! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}
$ccitye = trim($ccity, " ");

$czipcode=mysqli_real_escape_string($con,$_POST["zipcode"]);
if(empty(trim($czipcode))) {
	die("zipcode is not valid! Empty! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}
$czipcode = trim($czipcode, " ");

$cstate=mysqli_real_escape_string($con,$_POST["state"]);
if(empty(trim($cstate))) {
	die("State is not valid! Empty! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}
$cstate = trim($cstate, " ");

$cpassword=mysqli_real_escape_string($con,$_POST["password"]);
$cpassword2=mysqli_real_escape_string($con,$_POST["password2"]);
if(empty(trim($cpassword)) or empty(trim($cpassword2))) {
	die("Password is not valid! EMPTY Pasword detected! <br> <a href='p2_customer_signup.html' target=_self>Return to Customer Signup</a>");
}

$cpassword = trim($cpassword, " ");
$cpassword2 = trim($cpassword2, " ");


#===============================POST Variables DB Check===============================================
#We want to perform  db checks on most of the data, if we find a fail then we stop the code and exit.
#Establish login chcek query and run.
$sql= "SELECT login_id FROM 2022F_sanchem1.CUSTOMER WHERE login_id='$clogin'";
$result = mysqli_query($con, $sql);
if($result) {
	if(mysqli_num_rows($result) ==1){
		mysqli_free_result($result);
		mysqli_close($con);
		die("Login ".$clogin." exists");
   }
}

#Check passwords are the same
if($cpassword != $cpassword2){
	mysqli_close($con);
	die("Passwords do not match!");
}



//Echo"$clogin <br> $cpassword <br> $cfname <br> $clname <br> $ctel <br>$caddress <br> $ccity <br>$czipcode <br> $cstate<br>";

#=========================================================================================================
#If we reach this point then we can assume there is some "valid input". Insert into DB

$sql2="INSERT INTO 2022F_sanchem1.CUSTOMER(login_id,password,first_name,last_name,TEL,Address,city,zipcode,state)values('$clogin','$cpassword','$cfname','$clname','$ctel','$caddress','$ccity','$czipcode','$cstate') ";
$result2 = mysqli_query($con, $sql2);
if($result2){
	echo"New Customer: ".$clogin." Added <br>";
	echo"<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Page</a>";#return to Project 2 Phase1
}
echo"</body>";
echo "</HTML>";
mysqli_close($con);

?>