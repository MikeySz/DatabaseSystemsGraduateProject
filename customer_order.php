<?php
#Michael Sanchez
#Customer Order php
#--------------------------------------------------------------------------------------------------------
#Functions:
#displayResult is responsible for returning the result message: 
#NOTE! : Insert Operation is not peformed nor the responsiblity of the displayResult() function.
#NOTE!2 : displayResult ends the program.
function displayResult($resultmessage){
	#allows for Logout 
	echo "<a href='customer_logout_p2.php' target=_self>Customer Logout</a><br>";	
	echo"<b> $resultmessage </b> <br> <br>";
	echo "<a href='customer_check_p2.php' target=_self>Customer Homepage</a><br>";
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
if(!isset($_COOKIE['customer']))
	die("Please login first. Order has been Cancelled<br>
		<a href='customer_check_p2.php' target=_self>Return to Customer Login</a>");

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}

#Retrieve the employee ID from Cookie
$customer_id = $_COOKIE['customer'];

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
$sell_price= $_POST['sell_price'];#mysqli_real_escape_string($con,$_POST["sell_price"]);
$quantity= $_POST['quantity'];#mysqli_real_escape_string($con,$_POST["quantity"]);


$i = 0; #array Counter
$Length = count($pid);
$message ="";
$sqlArray = array();

#order list table vars
$olC = 0;
$olPname = array();
$olUnitPrice = array();
$olQuantity= array();
$olSubtotal= array();
#order list total
$olTotal = 0;
$olLength = 0;
#----------------check if anything was changed-------------------------
#End the program befor it beings any transactions.
if(!(array_sum($quantity)> 0) ){
$message="No Products were selected! No Transaction Occurred.";
displayResult($message);
}



#------------------------------------------------------------------------------------------
# begin the transaction
mysqli_begin_transaction($con);
try{

#---------------------------------------------------
#CheckList
#Create order record: 2022F_sanchem1.ORDERS(order_id, customer_id, date)
#Insert into PRODUCT_ORDER: 2022F_sanchem1.PRODUCT_ORDER(order_id, product_id, quantity)
#UPDATE the Quantity in PRODUCT table.

#Commit if the quantity in PRODUCT table is not less than 0.
#------------------------------------------------------
#Create order record  and obtain the order_id

mysqli_query($con, "INSERT INTO 2022F_sanchem1.ORDERS(customer_id, date )VALUES($customer_id, now() )" );
$order_id = mysqli_insert_id($con);

#------------------------------------------------------
#We want to create SQL INSERT STATEMENTS for all products ordered
while($i< $Length){
#Temp Files
	#NOTE We trim all the spaces off the left/right side of product_name and description. 
	#$customer_id = $_COOKIE['customer']; 
	$pidT= mysqli_real_escape_string($con, $pid[$i]);
	$pnameT= mysqli_real_escape_string($con, trim($product_name[$i]));
	$psellT= mysqli_real_escape_string($con, $sell_price[$i]);
	$pqtyT= mysqli_real_escape_string($con, $quantity[$i]);
#---------------------------------------------------
	#Insert into PRODUCT_ORDER: if and only if the quantity is not zero
if($pqtyT > 0){	
#Fill in the order list arrays
$olPname[$olC]= $pnameT;
$olUnitPrice[$olC] = $psellT;
$olQuantity[$olC]= $pqtyT;
$olSubtotal[$olC]= $psellT * $pqtyT;
$olC = $olC+1;
#................
mysqli_query($con, "INSERT INTO 2022F_sanchem1.PRODUCT_ORDER(order_id, product_id, quantity) VALUES ($order_id, $pidT, $pqtyT )" );
mysqli_query($con,"UPDATE 2022F_sanchem1.PRODUCT SET quantity = quantity -$pqtyT WHERE product_id = $pidT");
}
		
#---------------------------------------------------
$i =$i+1;
}
#-----------Check If Any Quantity is less than 0--------------------
$sqlChk= "SELECT product_id, name, quantity, sell_price FROM 2022F_sanchem1.PRODUCT WHERE quantity < 0";
$resultN= mysqli_query($con, $sqlChk);

#Check if the result was possible

if($resultN){
	if(mysqli_num_rows($resultN) == 0){
#----Successful Transaction---------------

	mysqli_commit($con);
	$olLength = count($olPname);
	$c=0;
	$message ="<b>Your Order list</b><br> <TABLE border =1> 
	<TR><TH>Product name<TH>Unit Price<TH>Quantity<TH>Sub Total";
	while($c < $olLength){
		$message.=" <TR><TD>$olPname[$c]<TD>$olUnitPrice[$c]<TD>$olQuantity[$c]<TD>$olSubtotal[$c]";
		$c = $c+1;
	}
	$olTotal = array_sum($olSubtotal);
	$message.=" <TR><TD>Total<TD><TD><TD>$olTotal";
	$message.= "</TABLE>";
	displayResult($message);



	}
	elseif(mysqli_num_rows($resultN) > 0){
		$message = "NOT Enough Quantity for ";
		$y=0;
		while($rowN = mysqli_fetch_array($resultN)){
				#Retrieve Values from Query
				$pnameF=$rowN['name'];
				if($y == mysqli_num_rows($resultN) - 1 ){
				if($y == 0){
					$message.= "$pnameF";
				}
				else $message.= "and $pnameF";

				}
				else
				$message.="$pnameF, ";
				$y=$y+1;
				}
		mysqli_rollback($con);

		}	
}
#Result was not possible
else{
	mysqli_rollback($con);
	$message = "Sorry We had an error processing your Order! <br> This order did not go through.";
}

#----------------------------
#------End-of-Try-----------
}

catch(mysqli_sql_exception $exception){
	mysqli_rollback($con);

	throw $exception;
}


#------------------------------------------------------------------------------------------
#Display our results

#$message .="Records Update Results:  Update Success:$ru | Update Failed: $rf | No Change: $nc";


displayResult($message);




#============================END of FILE====================================
echo "</HTML>\n";
echo "</body>";
?>