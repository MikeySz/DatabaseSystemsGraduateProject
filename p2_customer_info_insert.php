<?php
#Michael Sanchez
#Update Customer Information Phase 2 p
include ("dbconfig.php");
echo "<HTML>\n";
echo "<body>";

#--------------------------------------------------------------------------------------------------------
#if the cookie is not set, then tell the user to login.
if(!isset($_COOKIE['customer']))
	die("Please login first.<br>
		<a href='p2_customer_login.html' target=_self>Return to Customer Login</a>");

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}
$id=$_COOKIE['customer'];
#run the query using cookie value
$sql= " SELECT customer_id, password, first_name, last_name, TEL, address, city,zipcode,state FROM 2022F_sanchem1.CUSTOMER WHERE customer_id = '$id'";
$result = mysqli_query($con, $sql);

#Counter
$acol= 0;

#Boolean vars, will help in deciding if we need to run a query.
$chkpass = False;
$chkfname = False;
$chklname = False;
$chktel = False;
$chkaddress = False;
$chkcity = False;
$chkzipcode = False;
$chkstate = False;


#--------------------------------------------------------------------------------------------------------------------------------
#Retrieve data from db for comparison
if($result) {
	if(mysqli_num_rows($result) == 1){
				$row = mysqli_fetch_array($result);
				$cid = $row['customer_id'];
				$password = $row['password'];
				$fname = $row["first_name"];
				$lname = $row["last_name"];
				$tel = $row["TEL"];
				$address = $row["address"];
				$city = $row["city"];
				$zipcode= $row["zipcode"];
				$state = $row["state"];

				#Variables used to update the table, set it equal to variables from the table 
				$upassword = $password;
				$ufname = $fname;
				$ulname = $lname;
				$utel = $tel;
				$uaddress = $address;
				$ucity =$city;
				$uzipcode=$zipcode;
				$ustate=$state;

}}
#allows for Logout 
echo "<a href='customer_logout_p2.php' target=_self>Customer Logout</a><br>";
#Return to Customer Homepage  
echo "<br><a href='customer_check_p2.php' target=_self>Return to Customer Homepage</a><br>";
#Else if the cookie is set, allow user to update/delete Transaction

#get all variables
$cpassword=mysqli_real_escape_string($con,$_POST["password"]);
$cfname=mysqli_real_escape_string($con,$_POST["fname"]);
$clname=mysqli_real_escape_string($con,$_POST["lname"]);
$ctel=mysqli_real_escape_string($con,$_POST["tel"]);
$caddress=mysqli_real_escape_string($con,$_POST["address"]);
$ccity=mysqli_real_escape_string($con,$_POST["city"]);
$czipcode=mysqli_real_escape_string($con,$_POST["zipcode"]);
$cstate=mysqli_real_escape_string($con,$_POST["state"]);

#---------------------Check the Data---------------------------------------------------------	
#Password Check
if($password != trim($cpassword) && !empty(trim($cpassword))){
	$upassword = trim($cpassword, " ");
	$chkpass = True;
	$acol= $acol + 1;
}
#fname Check
if($fname != trim($cfname) && !empty(trim($cfname))){
	$ufname = trim($cfname, " ");
	$chkfname = True;
	$acol= $acol + 1;
}
#lname Check
if($lname != trim($clname) && !empty(trim($clname))){
	$ulname = trim($clname," ");
	$chklname = True;
	$acol= $acol + 1;
}
#tel Check
if($tel != trim($ctel) && !empty(trim($ctel))){
	$utel = trim($ctel, " ");
	$chktel = True;
	$acol= $acol + 1;
}
#address Check
if($address != trim($caddress) && !empty(trim($caddress))){
	$uaddress = trim($caddress, " ");
	$chkaddress = True;
	$acol= $acol + 1;
}
#city Check
if($city != trim($ccity) && !empty(trim($ccity))){
	$ucity = trim($ccity, " ");
	$chkcity = True;
	$acol= $acol + 1;
}

#zipcode Check
if($zipcode != trim($czipcode) && !empty(trim($czipcode))){
	$uzipcode = trim($czipcode, " ");
	$chkzipcode = True;
	$acol= $acol + 1;
}

#state Check
if($state != trim($cstate) && !empty(trim($cstate))){
	$ustate = trim($cstate, " ");
	$chkstate = True;
	$acol= $acol + 1;
}

if($chkpass or $chkfname or $chklname or $chktel or $chkaddress or $chkcity or $chkzipcode or $chkstate ){
	$sql2= " UPDATE 2022F_sanchem1.CUSTOMER SET password = '$upassword', first_name = '$ufname', last_name= '$ulname', TEL= '$utel', address= '$uaddress', city= '$ucity',zipcode= '$uzipcode',state= '$ustate' WHERE customer_id = '$id'";

	#-------------------------------------
	#Execute Query
	if(mysqli_query($con,$sql2)){
		#indicate that table has updated
		echo("Customer info updated succesfully<br>");
		echo("$acol columns have changed<br>");
	}
	else{
		#If error occurs, display error message
		echo "ERROR: Could not update information";
	}
}
else{
	echo"Data not changed.<br>";
}

#--------------------------------------------------------------


echo "</HTML>\n";
echo "</body>";
mysqli_close($con);	
?>