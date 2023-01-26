<?php
#Michael Sanchez
#Update Product
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
pid | product_name |  description | cost | sell_price | quantity | vendor
*/
#get all arrays
$pid=$_POST["pid"];
$product_name=$_POST["product_name"]; #mysqli_real_escape_string($con, trim($_POST["product_name"]) );
$description= $_POST['description'];#mysqli_real_escape_string($con, trim($_POST["description"])  );
$cost=$_POST['cost'];#mysqli_real_escape_string($con,$_POST["cost"]);
$sell_price= $_POST['sell_price'];#mysqli_real_escape_string($con,$_POST["sell_price"]);
$quantity= $_POST['quantity'];#mysqli_real_escape_string($con,$_POST["quantity"]);
$vendor=$_POST['vendor'];#mysqli_real_escape_string($con,$_POST["vendor"]);

$i = 0; #array Counter
$ru = 0; #Recordes Updated Successful
$nc=0; #Recordes No Change
$rf= 0; #Recorders Updated Failed
$Length = count($pid);
$message ="";
#------------------------------------------------------------------------------------------
#Check the variables
/*
Original Requirements:
No duplicate product name  <-- check database   peform this check last   

Negative Numbers Invalid, kill the operation and return error message

Cost must be less than Sell Price, It is invalid otherwise and 
thus we would have to kill the operation and return error message
NOTE: In Our Update we will allow to bypass this. To account for clearance items.

No Empty Values
#---------------------------------------------------
*/
#  SELECT * FROM PRODUCT WHERE description ="Apple's Latest Phone released!" AND name ="IPhone 14" AND vendor_ID = '1002' AND cost='350.00' AND sell_price ='499.99' AND quantity="5";
while($i< $Length){
#Temp Files
	#NOTE We trim all the spaces off the left/right side of product_name and description. 
	$pidT= mysqli_real_escape_string($con, $pid[$i]);
	$pnameT= mysqli_real_escape_string($con, trim($product_name[$i]));
	$pdescT= mysqli_real_escape_string($con, trim($description[$i]));
	$pcostT= mysqli_real_escape_string($con, $cost[$i]);
	$psellT= mysqli_real_escape_string($con, $sell_price[$i]);
	$pqtyT= mysqli_real_escape_string($con, $quantity[$i]);
	$pvidT= mysqli_real_escape_string($con, $vendor[$i]);
#---------------------------------------------------
#Check our Variables for current row
	#Check if record is different
	$sqlChk = 'SELECT * FROM 2022F_sanchem1.PRODUCT WHERE description ="'.$pdescT.'" AND name ="'.$pnameT.'" AND vendor_ID = "'.$pvidT.'" AND cost="'.$pcostT.'" AND sell_price = "'.$psellT.'" AND quantity="'.$pqtyT.'" LIMIT 1';
	#Check for product name duplicates
	$sqlDup='SELECT * FROM 2022F_sanchem1.PRODUCT WHERE  name ="'.$pnameT.'" AND product_id != '.$pidT.'';
	#Show SQL debugging: Comparison query
	#echo"$sqlChk <br>";
	#Execute Queries
	$resultChk = mysqli_query($con,$sqlChk);
	$resultDup = mysqli_query($con,$sqlDup);
#-----------------------------------------------
	#If we do not find any records, then we can proceed with our update checks 
	if(mysqli_num_rows($resultChk) == 0){
		#If any numberical value is negative then we do not update any recordes; Record Update Failed!
		if($pcostT < 0 OR $psellT <0 OR $pqtyT <0){
			$rf= $rf+1;
		}
		#If an empty columns are found then we do not update record. Record Update Failed!
		elseif (empty($pnameT) OR empty($pdescT)) {
			$rf=$rf+1;
		}
		#If our product name of the record being changed matches a preexisting record do not update. Record Update Failed!
		elseif( mysqli_num_rows($resultDup) != 0){
			$rf=$rf+1;
		}
		#If we passed through all checks then we can insert product into table
		else{
		#-----------------------------------------------------------------
		#If we have reached this point then all checks should have passed.
		#UPDATE Operation
 		$sqlUpdate = "UPDATE 2022F_sanchem1.PRODUCT SET description = '$pdescT', name ='$pnameT', vendor_id='$pvidT',cost = $pcostT, sell_price =$psellT, quantity= $pqtyT, employee_id = $employee_id WHERE product_id = $pidT";

		 #Execute Query
			if(mysqli_query($con,$sqlUpdate)){
				$ru= $ru+1;
				$message.="Successfully Updated product ID: $pidT <br>";
			}
			else{
				#Update Failed due to query.
				$rf = $rf+1;
			}

		
		#------------------------------------------------------------------
		}





	}
	else{
		#Record is unchaged
		$nc = $nc+1;
	}


	$i =$i+1;
}

#------------------------------------------------------------------------------------------
#Display our results

$message .="Records Update Results:  Update Success:$ru | Update Failed: $rf | No Change: $nc";


displayResult($message);




#============================END of FILE====================================
echo "</HTML>\n";
echo "</body>";
mysqli_close($con);	
?>