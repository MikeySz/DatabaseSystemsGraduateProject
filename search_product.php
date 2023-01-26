<?php
#Michael Sanchez
#search_product.php
#modified for customers
#--------------------------------------------------------------------------------------------------------
#Functions:

#display product table 
function displaytable($keyword, $con){

	#Create HTML Table Based on Keyword
	$keyword = mysqli_real_escape_string($con, $keyword);
	if($keyword != "*"){
	
	#Multi Character Search
	$keysearch= str_replace(" ", "|", trim($keyword));

	$query = "SELECT p.product_id , p.name pname, p.description, p.cost, p.sell_price, p.quantity, p.vendor_id, v.name vname  FROM 2022F_sanchem1.PRODUCT p JOIN CPS5740.VENDOR v on v.vendor_id = p.vendor_id WHERE p.name REGEXP '$keysearch' OR  p.description REGEXP '$keysearch'  ORDER BY p.product_id";
	}
	else{

	$query = "SELECT p.product_id , p.name pname, p.description, p.cost, p.sell_price, p.quantity, p.vendor_id, v.name vname  FROM 2022F_sanchem1.PRODUCT p JOIN CPS5740.VENDOR v 	on v.vendor_id = p.vendor_id  ORDER BY p.product_id";	
	}

	$result = mysqli_query($con, $query);
	#Create a table to hold all records of data returned from query above.
	if($result){
		if(mysqli_num_rows($result)>0){
			if($keyword != "*"){
			#Display The Keywords being searched
			$keydisplay= str_replace(" ", " , ", trim($keyword));
			echo"Available product list for search: ".$keydisplay."";
			}
			else{
				echo"Available product list for All";
			}
			echo "<form action='customer_order.php' method='post'>";
			echo"<TABLE border =1>\n";
			echo"<TR><TH>Product Name<TH>Description       <TH>Sell Price<TH>Available Quantity<TH> Order quantity<TH>Vendor Name \n";
			$x=0;
			while($row = mysqli_fetch_array($result)){
				#Retrieve Values from Query
				$pid=$row['product_id'];
				$pname=$row['pname'];
				$pdesc=$row['description'];
				$pcost=$row['cost'];
				$psell=$row['sell_price'];
				$pqty=$row['quantity'];
				$pvid=$row['vendor_id'];
				$vname=$row['vname'];

				echo "<TR>";
				#Product ID 
			    #echo"<TD>$pid<input type='hidden' name='pid[$x]' value='$pid'>";
				#Product Name
				echo"<TD>$pname  <input type='hidden' name='pid[$x]' value='$pid'> <input type='hidden' name='product_name[$x]' value='$pname'>";
				#Product Description    
				echo"<TD>$pdesc";
				#Sell Price 
				echo"<TD>$psell <input type='hidden' name='sell_price[$x]' value='$psell'>";
				#Product Available Quantity 
				echo"<TD>$pqty";
				# Customer Order Qunatity
				echo"<TD> <input type='number' value='0' min='0' step='1' name='quantity[$x]' required='required' maxlength='10' pattern='[0-9]'> ";
				#echo"<br>Vendor name";
				echo"<TD>$vname";

				$x=$x+1;
			}
			echo"</TABLE>\n"; #close table
			echo"<br><input type='submit' value='Place Order'> </form>"; #Close the Form
		}
		#If no records, then we return message.
		else{
			echo"No Search Results for Keyword: $keyword <br> Please try again.";
		}
		mysqli_free_result($result);
	}
	else{
		
	}	


}


#--------------------------------------------------------------------------------------------------------
include ("dbconfig.php");
echo "<HTML>\n";
echo "<body>";

if(!isset($_COOKIE['customer']))
	die("Please login first.<br>
		<a href='customer_check_p2.php' target=_self>Return to Customer Login</a>");

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}

echo "<a href='customer_logout_p2.php' target=_self>Customer Logout</a><br>";	

echo"<form name='input' action= 'search_product.php' method='get' >"; 
echo"<br> Search Product: &nbsp<br> (* for all, multiple keywords seperated by space)<br> <input type='text' name='keyword' required='required' maxlength='100'>";
echo"<input type='submit' value='Submit'></form></HTML><br>";

#echo($_GET['keyword']);
$keywordP = $_GET['keyword'];

if( trim($keywordP) != '' AND $keywordP != Null ){
setcookie("customer_search", $keywordP, time()+60*60);
if(strtolower($keywordP) == 'all'){
	$keywordP = "*";
}
displaytable($keywordP,$con);
}
elseif(trim($keywordP)==''){
	echo"Invalid Keyword! Empty keyword is not valid!<br> Please Try Again.";
}
else{ echo"Invalid Keyword!: $keywordP <br> Please try again."; }



echo "<br><a href='customer_check_p2.php' target=_self>Customer Homepage</a><br>";
echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";


echo"</body>";
echo "</HTML>";
?>