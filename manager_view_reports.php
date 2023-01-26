<?php
#Michael S.
#Phase 2 Vendor Reports Manager Functions
#Displays the reports
#=======================================================================================================
#Functions:
#period: all --> all time --> WHERE does not require time functions
#		 pwk -->past week --> WHERE WHERE YEAR(date)=YEAR(now() - INTERVAL 1 WEEK) AND WEEK(date)=WEEK(noW() - INTERVAL 1 WEEK))
#		 cmt -->current month-->WHERE MONTH(date)= MONTH(now()) AND YEAR(date) = YEAR(now())
#		 pmt -->past month--> WHERE YEAR(date) = YEAR(now() - INTERVAL 1 MONTH) AND MONTH(date) = MONTH(now() - INTERVAL 1 MONTH))
#        yyr -->past year--> WHERE YEAR(date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))
#==================================================================================================================
// function timePeriod($period){
// switch($period){
// 	case"all":
// 		return " ";
// 		break;
// 	case"pwk":
// 		return " WHERE YEAR(date) = YEAR(now() - INTERVAL 1 WEEK) AND WEEK(date)=WEEK(noW() - INTERVAL 1 WEEK) OR date is NULL ";
// 		break;
// 	case"cmt":
// 		return " WHERE MONTH(date)= MONTH(now()) AND YEAR(date) = YEAR(now()) OR date is NULL ";
// 		break;
// 	case"pmt":
// 		return " WHERE YEAR(date) = YEAR(now() - INTERVAL 1 MONTH) AND MONTH(date) = MONTH(now() - INTERVAL 1 MONTH)  OR date is NULL";
// 		break;
// 	case"yyr":
// 		return " WHERE YEAR(date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR)) OR date is NULL ";
// 		break;
// 	defualt:
// 		return " ";
// }
// }
function timePeriod($period){
switch($period){
	case"all":
		return " ";
		break;
	case"pwk":
		return " WHERE YEAR(date) = YEAR(now() - INTERVAL 1 WEEK) AND WEEK(date)=WEEK(noW() - INTERVAL 1 WEEK) ";
		break;
	case"cmt":
		return " WHERE MONTH(date)= MONTH(now()) AND YEAR(date) = YEAR(now()) ";
		break;
	case"pmt":
		return " WHERE YEAR(date) = YEAR(now() - INTERVAL 1 MONTH) AND MONTH(date) = MONTH(now() - INTERVAL 1 MONTH) ";
		break;
	case"yyr":
		return " WHERE YEAR(date) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 YEAR))  ";
		break;
	defualt:
		return " ";
}

}

function timeString($period){
switch($period){
	case"all":
		return " ";
		break;
	case"pwk":
		return " for the Past Week ";
		break;
	case"cmt":
		return " for the Current Month ";
		break;
	case"pmt":
		return " for the Past Month ";
		break;
	case"yyr":
		return " for the Past Year ";
		break;
	defualt:
		return " ";
}

}
#==================================================================================================================
function noRecords($period){
switch($period){
	case"all":
		return "No Records have been found for All!";
		break;
	case"pwk":
		return "There are No Records found for the past week! ";
		break;
	case"cmt":
		return "There are No Records found for the current month!";
		break;
	case"pmt":
		return "There are No Records found for the past month! ";
		break;
	case"yyr":
		return "There are No Records found for the past Year! ";
		break;
	defualt:
		return "No Records found!";
}

}

#==================================================================================================================
#Create the all report
function allReport($con, $period){
	$query = "SELECT p.name product_name, v.name vendor_name,p.cost unit_cost  ,p.quantity current_quantity, po.quantity as sold_quantity,p.sell_price sold_unit_price , (po.quantity*p.sell_price)as sub_total,  ((p.sell_price - p.cost)* po.quantity)as profit     ,concat(c.first_name,' ',c.last_name) customer_name, o.date order_date  FROM 2022F_sanchem1.PRODUCT p JOIN 2022F_sanchem1.PRODUCT_ORDER po ON p.product_id = po.product_id  JOIN 2022F_sanchem1.ORDERS o ON o.order_id = po.order_id JOIN 2022F_sanchem1.CUSTOMER c ON o.customer_id = c.customer_id JOIN CPS5740.VENDOR v ON v.vendor_id = p.vendor_id ".timePeriod($period)." ORDER BY o.date desc ";
	$result = mysqli_query($con, $query);
	#caculate    totals:   qunatity sold:  sum_array(qsArray[]) ,  total gross profit ([]), total net profit ([])
	#Variables:
	#quantity_sold Array
	$qsArray = array();
	#gross profit array
	$gsArray = array();
	#net profit array
	$npArray = array();


	#Create table
	if($result){
		if(mysqli_num_rows($result)>0){

			$ct = 1;
			$j= 0;
			echo "<h1 text-align='center'><b>All Sales Report ".timeString($period)."</b></h1><br>";
			echo"<TABLE border =1>\n";
			echo"<TR><TH>#<TH>Product Name<TH>Vendor Name<TH>Unit Cost<TH>Current Quantity<TH>Sold Quantity<TH>Sold Unit Price<TH>Sub Total<TH>Profit<TH>Customer Name<TH>Order Date\n";
			while($row = mysqli_fetch_array($result)){
				$product_name=$row['product_name'];
				$vendor_name=$row['vendor_name'];
				$unit_cost=$row['unit_cost'];
				$current_quantity=$row['current_quantity'];

				$sold_quantity=$row['sold_quantity'];
				$qsArray[$j]= $sold_quantity;

				$sold_unit_price=$row['sold_unit_price'];

				$sub_total=$row['sub_total'];
				$gsArray[$j]=$sub_total;

				$profit=$row['profit'];
				$npArray[$j]=$profit;

				$customer_name=$row['customer_name'];
				$order_date=$row['order_date'];
				echo "<TR><TD>$ct<TD>$product_name<TD>$vendor_name<TD>$unit_cost<TD>$current_quantity<TD>$sold_quantity<TD>$sold_unit_price<TD>$sub_total<TD>$profit<TD>$customer_name<TD>$order_date\n";
				$ct=$ct+1;
				$j= $j+1;
			}
			#-------------------------------------------
			#create final row of Table
			echo "<TR><TD>Totals:<TD><TD><TD><TD>Quantity Sold:<TD>".array_sum($qsArray)."<TD> Gross Profit:<TD>".array_sum($gsArray)."<TD> NET PROFIT:<TD>".array_sum($npArray)."<TD>\n";
			echo"</TABLE>\n"; #close Table
		}
		#no records found
		else{
			echo"<br> ".noRecords($period)." <br> ";

		}

		}
		#Connection error
		else{
			echo"<br>A connection error has occured. please try again later.";
		}
		mysqli_free_result($result);
	}


#==================================================================================================================

#Create the product report
function productReport($con, $period){

	$query = "SELECT p2.product_id, p2.name product_name, p2.quantity current_quantity, p2.cost unit_cost, p2.sell_price sold_unit_price, v2.name vendor_name,  t1.* FROM 2022F_sanchem1.PRODUCT p2 JOIN CPS5740.VENDOR v2 ON p2.vendor_id = v2.vendor_id LEFT JOIN (SELECT p.product_id , sum(po.quantity) as sold_quantity,  ((p.sell_price - p.cost)* sum(po.quantity))as profit, (sum(po.quantity)*p.sell_price)as sub_total FROM 2022F_sanchem1.PRODUCT p LEFT JOIN 2022F_sanchem1.PRODUCT_ORDER po ON p.product_id = po.product_id  LEFT JOIN 2022F_sanchem1.ORDERS o ON o.order_id = po.order_id  ".timePeriod($period)." GROUP BY p.product_id ) t1 ON p2.product_id = t1.product_id  ORDER BY product_name";
	$result = mysqli_query($con, $query);
	#caculate    totals:   qunatity sold:  sum_array(qsArray[]) ,  total gross profit ([]), total net profit ([])
	#Variables:
	#gross profit array
	$gsArray = array();
	#net profit array
	$npArray = array();


	#Create table
	if($result){
		if(mysqli_num_rows($result)>0){

			$ct = 1;
			$j= 0;
			echo "<h1 text-align='center'><b>Product Report ".timeString($period)."</b></h1><br>";
			echo"<TABLE border =1>\n";
			echo"<TR><TH>#<TH>Product Name<TH>Vendor Name<TH>Unit Cost<TH>Quantity in Stock<TH>Quantity Sold<TH>Unit Selling Price<TH>Subtotal<TH>Profit\n";
			while($row = mysqli_fetch_array($result)){
				$product_name=$row['product_name'];
				$vendor_name=$row['vendor_name'];
				$unit_cost=$row['unit_cost'];
				$current_quantity=$row['current_quantity'];
				$sold_quantity=$row['sold_quantity'];
				$sold_unit_price=$row['sold_unit_price'];

				$profit=$row['profit'];
				$npArray[$j]=$profit;

				$sub_total=$row['sub_total'];
				$gsArray[$j]=$sub_total;

				echo "<TR><TD>$ct<TD>$product_name<TD>$vendor_name<TD>$unit_cost<TD>$current_quantity<TD>$sold_quantity<TD>$sold_unit_price<TD>$sub_total<TD>$profit\n";
				$ct=$ct+1;
				$j= $j+1;
			}
			#-------------------------------------------
			#create final row of Table
			echo "<TR><TD>Totals:<TD><TD><TD><TD><TD><TD><TD>".array_sum($gsArray)."<TD>".array_sum($npArray)."\n";
			echo"</TABLE>\n"; #close Table
		}
		#no records found
		else{
			echo"<br> ".noRecords($period)." <br> ";

		}

		}
		#Connection error
		else{
			echo"<br>A connection error has occured. please try again later.";
		}
		mysqli_free_result($result);



}


#=============================================================================================================
#Create the Vendor report 
function vendorReport($con, $period){
	$query = "SELECT v2.vendor_id, v2.name vendor_name,  sum(p2.quantity) current_quantity, t1.* FROM CPS5740.VENDOR v2 LEFT JOIN 2022F_sanchem1.PRODUCT p2 ON v2.vendor_id = p2.vendor_id LEFT JOIN(SELECT v.vendor_id,  (p.cost * sum(po.quantity)) amount_to_vendor , sum(po.quantity) as sold_quantity, (sum(po.quantity)*p.sell_price)as sub_total,((p.sell_price - p.cost)* sum(po.quantity))as profit FROM CPS5740.VENDOR v LEFT JOIN  2022F_sanchem1.PRODUCT p  ON v.vendor_id = p.vendor_id LEFT JOIN 2022F_sanchem1.PRODUCT_ORDER po ON p.product_id = po.product_id  LEFT JOIN 2022F_sanchem1.ORDERS o ON o.order_id = po.order_id ".timePeriod($period)." GROUP BY v.vendor_id) t1 ON v2.vendor_id = t1.vendor_id GROUP BY v2.vendor_id ORDER BY vendor_name";
	$result = mysqli_query($con, $query);
		$result = mysqli_query($con, $query);
	#caculate    totals:   qunatity sold:  sum_array(qsArray[]) ,  total gross profit ([]), total net profit ([])
	#Variables:
	#amount to vendor array
	$avArray = array();	
	#gross profit array
	$gsArray = array();
	#net profit array
	$npArray = array();


	#Create table
	if($result){
		if(mysqli_num_rows($result)>0){

			$ct = 1;
			$j= 0;
			echo "<h1 text-align='center'><b>Vendor Report ".timeString($period)." </b></h1><br>";
			echo"<TABLE border =1>\n";
			echo"<TR><TH>#<TH>Vendor Name<TH>Quantity in Stock<TH>Amount to Vendor<TH>Sold Quantity<TH>Sub Total Sale<TH>Profit\n";
			while($row = mysqli_fetch_array($result)){
				$vendor_name=$row['vendor_name'];
				$current_quantity=$row['current_quantity'];
				
				$amount_to_vendor=$row['amount_to_vendor'];
				$avArray[$j]=$amount_to_vendor;
				
				$sold_quantity=$row['sold_quantity'];

				$sub_total=$row['sub_total'];
				$gsArray[$j]=$sub_total;

				$profit=$row['profit'];
				$npArray[$j]=$profit;



				echo "<TR><TD>$ct<TD>$vendor_name<TD>$current_quantity<TD>$amount_to_vendor<TD>$sold_quantity<TD>$sub_total<TD>$profit\n";
				$ct=$ct+1;
				$j= $j+1;
			}
			#-------------------------------------------
			#create final row of Table
			echo "<TR><TD>Totals:<TD><TD><TD>".array_sum($avArray)."<TD><TD>".array_sum($gsArray)."<TD>".array_sum($npArray)."\n";
			echo"</TABLE>\n"; #close Table
		}
		#no records found
		else{
			echo"<br> ".noRecords($period)." <br> ";

		}

		}
		#Connection error
		else{
			echo"<br>A connection error has occured. please try again later.";
		}
		mysqli_free_result($result);


}



#=======================================================================================================


include "dbconfig.php";
echo "<HTML>\n";

echo "<body>";
$con=mysqli_connect($server, $login, $password, $dbname);

#if the cookie is not set, then tell the user to login.
if(!isset($_COOKIE['employee']) or $_COOKIE['role'] != 'M')
	die("Please login as manager first.<br>
		<a href='p2_employee_login.php' target=_self>Return to Employee Login</a>");

#Logout Button
echo "<a href='p2_employee_logout.php' target=_self>Employee Logout</a><br>";
#When connection fails, close the program
if(!$con){
	die("Connection failed! please try again later.");
}

else{
#Else continue with the view reports program
	$pPeriod = $_POST['period'];
	$pType= $_POST['type'];

# 'as' = All Sales | 'pr'=Products | 'vn' = Vendors
	if($pType == "as" ){
		allReport($con, $pPeriod);
	}
	elseif($pType == "pr"){
		productReport($con, $pPeriod);
	}
	elseif($pType =="vn"){
		vendorReport($con, $pPeriod);
	}



	}
	
mysqli_close($con);
echo "<a href='p2_employee_login.php' target=_self>Employee Homepage</a><br>";
echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";
echo "</body>";
echo "</HTML>\n";
?>