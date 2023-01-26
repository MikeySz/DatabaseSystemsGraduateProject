<?php
#Michael Sanchez
# p2_add_product.php
define("IN_CODE", 1);
include "dbconfig.php";
echo "<HTML>\n";
echo "<body>";

#IF the employee cookie is not set or expired as user to login again.
if(!isset($_COOKIE['employee']))
	die("Please login first.<br>
		<a href='p2_employee_login.php' target=_self>Return to Employee Login</a>");

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}
echo" <a href='p2_employee_logout.php' target=_self>Employee Logout</a><br>";
echo"<head><title> Add Products</title>";
echo"</head><body><h1><b> Add products </b></h1>";

echo"<form name='input' action= 'employee_insert_product.php' method='post' >";
echo"<br> Product Name: &nbsp<input type='text' name='product_name' required='required' maxlength='30'>";
echo"<br> Description: &nbsp<input type='text' name='description' required='required' maxlength='30'>";
echo"<br> Cost: &nbsp<input type='number' min='0' step='0.01' name='cost' required='required' placeholder='100.00' maxlength='10' pattern='[0-9]+(\\.[0-9][0-9]?)?'  >";
echo"<br> Sell Price: &nbsp<input type='number' min='0' step='0.01' name='sell_price' required='required' placeholder='100.00' maxlength='10' pattern='[0-9]+(\\.[0-9][0-9]?)?'> ";
echo"<br> Quantity: &nbsp<input type='number' min='0' step='1' name='quantity' required='required' placeholder='4' maxlength='10' pattern='[0-9]'  <br>";

    #Retrieve the vendors from the vendors table in the database
	$query = "Select vendor_id, name FROM CPS5740.VENDOR";
	$result = mysqli_query($con, $query);
	#Create a selection for the vendors
	if($result){
		if(mysqli_num_rows($result)>0){
			echo"<br> Select Vendor: &nbsp";
			echo"<select name='vendor' required='required'>";
			echo"<option disabled selected value>-- Select a Vendor --</option>";
			while($row = mysqli_fetch_array($result)){
				$vendorID=$row['vendor_id'];
				$name=$row['name'];
				echo "<option value='$vendorID'>$name</option>";
			}
			echo"</select><br>"; #close the selection
		}
		#If no records, then we return message.
		else{
			echo"<br>No Record Found!";
		}
		mysqli_free_result($result);
	}
	mysqli_close($con);
/*
post variables:

product_name
description
cost
sell_price
quantity
vendor
*/

echo"<input type='submit' value='Submit'></form></HTML>";
?>