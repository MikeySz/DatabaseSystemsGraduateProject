<?php
#Michael Sanchez
#employee_display_product
#--------------------------------------------------------------------------------------------------------
#Functions:

#Create the Vendor Drop Down 
function vendorDropDown($vid, $vArray,$vnArray, $con){
	#Creating the vendor dropdown
	$i = 0;
	While($i < count($vArray)){
			if($vid == $vArray[$i]){
				#echo"Key=". $vendorID.", Value=".$vname.";";
				echo "<option value= '$vArray[$i]' selected='selected'>$vnArray[$i]</option>";
			}
			else{
				#echo"Key=". $vendorID.", Value=".$vname.";";
				echo "<option value='$vArray[$i]'>$vnArray[$i]</option>";
			}
			$i = $i+1;
	}


}

#display product table 
function displaytable($keyword, $con){
	#Create Vendor Array
	#Retrieve the vendors from the vendors table in the database
	$query2 = "Select vendor_id, name FROM CPS5740.VENDOR";
	$result2 = mysqli_query($con, $query2);
	$vendorArray = array();
	$vnameArray = array();
	#Obtain vendor values from db and fill in the the Vendor Array
	if($result2){
		if(mysqli_num_rows($result2)>0){
			$c=0;
			while($rowV = mysqli_fetch_array($result2)){
				
				$vendorID=$rowV['vendor_id'];
				$vname=$rowV['name'];
				$vendorArray[$c]= $vendorID;
				$vnameArray[$c]= $vname;
				$c=$c+1;
				#echo(count($vendorArray));
				}
			
			}
		mysqli_free_result($result2);
		}
	#==========================

	#Create HTML Table Based on Keyword
	$keyword = mysqli_real_escape_string($con,$keyword);
	if($keyword != "*"){

	#Multi Character Search
	$keysearch= str_replace(" ", "|", trim($keyword));

	$query = "SELECT p.product_id , p.name pname, p.description, p.cost, p.sell_price, p.quantity, p.vendor_id, e.name ename  FROM 2022F_sanchem1.PRODUCT p JOIN CPS5740.EMPLOYEE2 e on p.employee_id = e.employee_id WHERE p.name REGEXP '$keysearch' OR  p.description REGEXP '$keysearch'  ORDER BY p.product_id";
	}
	else{

	$query = "SELECT p.product_id , p.name pname, p.description, p.cost, p.sell_price, p.quantity, p.vendor_id, e.name ename  FROM 2022F_sanchem1.PRODUCT p JOIN CPS5740.EMPLOYEE2 e 	on p.employee_id = e.employee_id  ORDER BY p.product_id";	
	}

	$result = mysqli_query($con, $query);
	#Create a table to hold all records of data returned from query above.
	if($result){
		if(mysqli_num_rows($result)>0){
			echo "<form action='update_product.php' method='post'>";
			echo"<TABLE border =1>\n";
			echo"<TR><TH>Product ID<TH>Product Name<TH>Description<TH>Cost<TH>Sell_Price<TH>Available quantity<TH>Vendor Name<TH> Last update by \n";
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
				$ename=$row['ename'];

				echo "<TR>";
				#Product ID 
				echo"<TD>$pid<input type='hidden' name='pid[$x]' value='$pid'>";
				#Product Name     #echo"<TD>$pname";
				echo'<TD><input type="text" value="'.$pname.'" name="product_name['.$x.']" required="required" maxlength="30">';
				#Product Description    #echo"<TD>$pdesc";
				echo'<TD><input type="text" value="'.$pdesc.'" name="description['.$x.']" required="required" maxlength="30">';
				#Product Cost   #echo"<TD>$pcost";
				echo"<TD><input type='number' value='$pcost' min='0' step='0.01' name='cost[$x]' required='required'  maxlength='10' pattern='[0-9]+(\\.[0-9][0-9]?)?'  >";
				#Sell Price  #echo"<TD>$psell";
				echo"<TD><input type='number' value='$psell' min='0' step='0.01' name='sell_price[$x]' required='required' maxlength='10' pattern='[0-9]+(\\.[0-9][0-9]?)?'> ";
				#Product Quantity #echo"<TD>$pqty";
				echo"<TD> <input type='number' value='$pqty' min='0' step='1' name='quantity[$x]' required='required' maxlength='10' pattern='[0-9]'> ";
				#echo"<br> Select Vendor: &nbsp";
				echo"<TD> <select name='vendor[$x]' required='required'>";
				#echo"<option disabled selected value>-- Select a Vendor --</option>";
				vendorDropDown($pvid,$vendorArray, $vnameArray, $con);
				echo"</select><br>"; #close the selection

				echo"<TD>$ename\n";
				$x=$x+1;
			}
			echo"</TABLE>\n"; #close table
			echo"<br><input type='submit' value='Update Products'> </form>"; #Close the Form
		}
		#If no records, then we return message.
		else{
			echo"Keyword Not Found! Returning All Records";
			displaytable("*", $con);
		}
		mysqli_free_result($result);
	}
	else{
		#Error Message can go here
		echo"Error Connecting to Database!";
	}	


}


#--------------------------------------------------------------------------------------------------------
include ("dbconfig.php");
echo "<HTML>\n";
echo "<body>";

if(!isset($_COOKIE['employee']))
	die("Please login first.<br>
		<a href='p2_employee_login.php' target=_self>Return to Employee Login</a>");

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}

echo "<a href='p2_employee_logout.php' target=_self>Employee Logout</a><br>";	


echo"<form name='input' action= 'employee_display_product.php' method='post' >"; 
echo"<br> Search Product: &nbsp<br> (* for all, multiple keywords seperated by space)<br> <input type='text' name='product_keyword' required='required' maxlength='100'>";
echo"<input type='submit' value='Submit'></form></HTML><br>";

if( isset($_POST['product_keyword']) AND trim($_POST['product_keyword']) !='' ){
$keywordP = $_POST['product_keyword'];
if(strtolower($keywordP) == 'all'){
	$keywordP = "*";
}
displaytable($keywordP,$con);
}
elseif(isset($_POST['product_keyword']) AND trim($_POST['product_keyword']) ==''){
	echo"<b>Please Use Valid Keyword Only! Empty Keyword is not valid!</b><br>Returning All records";
	displaytable('*',$con); 

}
else{ displaytable('*',$con); }



echo "<br><a href='p2_employee_login.php' target=_self>Employee Homepage</a><br>";
echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";


echo"</body>";
echo "</HTML>";
?>