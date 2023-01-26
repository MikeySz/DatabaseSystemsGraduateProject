<?php
#Michael Sanchez
#p2_vistor_search_product.php
#modified for visitors 
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
			#echo "<form action='customer_order.php' method='post'>";
			echo"<TABLE border =1>\n";
			echo"<TR><TH>Product Name<TH>Description       <TH>Sell Price<TH>Available Quantity<TH>Vendor Name \n";
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
				#Product Name
				echo"<TD>$pname";
				#Product Description    
				echo"<TD>$pdesc";
				#Sell Price 
				echo"<TD>$psell";
				#Product Available Quantity 
				echo"<TD>$pqty";
				#echo"<br>Vendor name";
				echo"<TD>$vname";

				$x=$x+1;
			}
			echo"</TABLE>\n"; #close table
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

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}

echo "<a href='customer_check_p2.php' target=_self>Customer Login</a><br>";	

echo"<form name='input' action= 'p2_visitor_search_product.php' method='get' >"; 
echo"<br> Search Product: &nbsp<br> (* for all, multiple keywords seperated by space)<br> <input type='text' name='vkeyword' required='required' maxlength='100'>";
echo"<input type='submit' value='Submit'></form></HTML><br>";

if(!isset($_GET['vkeyword'])){
$keywordP ="all";
}
else
$keywordP = $_GET['vkeyword'];

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


echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";


echo"</body>";
echo "</HTML>";
?>