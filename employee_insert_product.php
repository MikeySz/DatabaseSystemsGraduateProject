<?php
#Michael Sanchez
#PHASE 2
#--------------------------------------------------------------------------------------------------------
#Functions:
#displayResult is responsible for returning the result message: 
#NOTE! : Insert Operation is not peformed nor the responsiblity of the displayResult() function.
#NOTE!2 : displayResult ends the program.
function displayResult($resultmessage){
	#allows for Logout 
	echo "<a href='p2_employee_logout.php' target=_self>Employee Logout</a><br>";	
	echo"<b> $resultmessage </b> <br> <br>";
	echo "<a href='p2_employee_login.php' target=_self>Employee Homepage</a><br>";
	echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";
	die();
}





#--------------------------------------------------------------------------------------------------------
#employee_insert_product
include ("dbconfig.php");
echo "<HTML>\n";
echo "<body>";

#--------------------------------------------------------------------------------------------------------
#if the cookie is not set, then tell the user to login.
if(!isset($_COOKIE['employee']))
	die("Please login first.<br>
		<a href='p2_employee_login.php' target=_self>Return to Employee Login</a>");

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}

#Retrieve the employee ID from Cookie
$employee_id = $_COOKIE['employee'];

#------------------------------------------------------------------------------------------
#retrieve the product table
#$sql= "SELECT * FROM 2022F_sanchem1.PRODUCT";
#$result = mysqli_query($con, $sql);
/*
product_id  -- This is auto-increment, we do not include in insert statement
description
name
vendor_id   -- Our post method should contain the vendor id values as $vendor
cost
sell_price
quantity
employee_id
*/

#------------------------------------------------------------------------------------------

/*
post variables:
product_name |  description | cost | sell_price | quantity | vendor
*/
#get all variables
#NOTE We trim all the spaces off the left/right side of product_name and description
$product_name=mysqli_real_escape_string($con, trim($_POST["product_name"]) );
$description=mysqli_real_escape_string($con, trim($_POST["description"])  );
$cost=mysqli_real_escape_string($con,$_POST["cost"]);
$sell_price=mysqli_real_escape_string($con,$_POST["sell_price"]);
$quantity=mysqli_real_escape_string($con,$_POST["quantity"]);
$vendor=mysqli_real_escape_string($con,$_POST["vendor"]);

#------------------------------------------------------------------------------------------
#Check the variables
/*
Requirements:
No duplicate product name  <-- check database   peform this check last   

Negative Numbers Invalid, kill the operation and return error message

Cost must be less than Sell Price, It is invalid otherwise and 
thus we would have to kill the operation and return error message

*/

#Negative Numbers
#Our HTML should prevent this but in case an negative number passes through we will check with php
#If number is negative or null than end the operation and report to user
if($cost < 0 or is_null($cost)){
	displayResult("Cost : $cost  is not a valid. Insert Failed!");
}

if($sell_price < 0 or is_null($sell_price)){

	displayResult("Sell Price : $sell_price  is not a valid. Insert Failed!");
}

if($quantity < 0 or is_null($quantity)){
	displayResult("Quantity is not a valid. Insert Failed!");
}

#If the first two checks have passed then $cost and $sell_price is a valid number 
#Peform Next Check
#Cost must be less than Sell Price
if($cost > $sell_price){ #If cost is greater than sell price
	displayResult("Cost MUST  not be less than Sell Price . Insert Failed!");
}
#check if product name or description is emptyy
if($product_name =="" OR $product_name == NULL ){
	displayResult("Product name can  not be empty . Insert Failed!");
}
if($description =="" OR $description == NULL ){
	displayResult("Product description can  not be empty . Insert Failed!");
}



#Check if productname exists in the database
#Use a query to check
$sql_pName = " SELECT * FROM 2022F_sanchem1.PRODUCT WHERE name = '$product_name' LIMIT 1";
$pResult= mysqli_query($con, $sql_pName);

#Check if the query worked, else report a data retrieval error message
if($pResult){  #the query has no error
if(mysqli_num_rows($pResult) == 1){ #one row was returned
	displayResult("Product Name: $product_name already exists in the database! Insert Failed!");
} #close inner if
} #close outer if
else{ #The Query failed
	displayResult("Something went wrong with Data Retrieval. Insert Failed!");
}

#------------------------------------------------------------------------------------------
#If we have reached this point then all checks should have passed.
#Insert Operation
 $sql = "INSERT INTO 2022F_sanchem1.PRODUCT (description, name, vendor_id, cost, sell_price, quantity, employee_id ) VALUES( '$description','$product_name','$vendor',$cost, $sell_price, $quantity, $employee_id )";

 #Execute Query
	if(mysqli_query($con,$sql)){

		displayResult("Successfully Inserted the product: $product_name ");
	}
	else{
		#If error occurs, display error message
		#echo("Error message". mysqli_error($con));
		displayResult("ERROR: Could not execute Insert operation. Insert Failed!");
	}









#============================END of FILE====================================
echo "</HTML>\n";
echo "</body>";
mysqli_close($con);	
?>