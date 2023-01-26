<?php
#Michael Sanchez
#View All Customer Data
#---------------------------------------------------------------------------------------------------------------------------
#if the cookie is not set, then tell user that an employee must be logged in
if(!isset($_COOKIE['employee']))
	die("This page is for Employees only! Please login first.<br>
		<a href='p2_employee_login.php' target=_self>Go to Employee Login</a><br> <a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Homepage</a><br>");

#Else if the employee cookie is set, allow user to view the table.
echo "<br> The following customers are in the database.<br>";
#--------------------------------------------------------------------------------------------------------------------------
#dbconfig.php allows the neccessary information to login to the db without hardcoding it into each php file.
include "dbconfig.php";
$con=mysqli_connect($server, $login, $password, $dbname);

#SQL query that will retrieve the data we want to display on display customers page
$sql="SELECT customer_id,login_id,password,last_name,first_name,TEL,address,city,zipcode,state FROM 2022F_sanchem1.CUSTOMER";
$result = mysqli_query($con, $sql);

if($result) {
	echo "<TABLE border = 1> ";
	echo "<TR><TH>ID<TH>Login<TH>Password<TH>Last Name<TH>First Name<TH>TEL<TH>Address<TH>City<TH>Zipcode<TH>State";
	while($row = mysqli_fetch_array($result)){
		$id = $row['customer_id'];
		$login = $row['login_id'];
		$password = $row['password'];
		$lname = $row["last_name"];
		$fname = $row["first_name"];
		$tel = $row["TEL"];
		$address = $row["address"];
		$city = $row["city"];
		$zipcode= $row["zipcode"];
		$state = $row["state"];

		
		if ($login <>"") 
			echo "<br><TR><TH>$id<TD>$login<TD>$password<TD>$lname<TD>$fname<TD>$tel<TD>$address<TD>$city<TD>$zipcode<TD>$state \n";
}
	echo "</TABLE>";
}

#allows for Employee Logout or return to phase 2 homepage
echo "<a href='p2_employee_logout.php' target=_self>Employee Logout</a><br>";	
echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";

mysqli_free_result($result);
mysqli_close($con);
?>