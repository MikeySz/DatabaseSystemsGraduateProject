<?php
#Michael S.
#Phase 2 customer order history
#Displays the cucstomer order history info
include "dbconfig.php";
echo "<HTML>\n";

echo "<body>";
$con=mysqli_connect($server, $login, $password, $dbname);

#if the cookie is not set, then tell the user to login.
if(!isset($_COOKIE['customer']))
	die("Please login first.<br>
		<a href='customer_check_p2.php' target=_self>Return to Customer Login</a>");

#Logout Button
echo "<a href='customer_logout_p2.php' target=_self>Customer Logout</a><br>";
#When connection fails, close the program
if(!$con){
	die("Connection failed! please try again later.");
}

else{
#Else continue with the customer order history
	#SELECT po.order_id, p.name, po.quantity,p.sell_price unit_price,(po.quantity*p.sell_price)as subtotal, o.date FROM PRODUCT p JOIN PRODUCT_ORDER po ON p.product_id = po.product_id JOIN ORDERS o ON o.order_id = po.order_id  WHERE o.customer_id= '1' ORDER BY po.order_id;

	$cid = $_COOKIE['customer'];
	$query = "SELECT po.order_id order_id, p.name product_name, po.quantity as order_quantity,p.sell_price unit_price,(po.quantity*p.sell_price)as sub_total, o.date order_date FROM 2022F_sanchem1.PRODUCT p JOIN 2022F_sanchem1.PRODUCT_ORDER po ON p.product_id = po.product_id JOIN 2022F_sanchem1.ORDERS o ON o.order_id = po.order_id  WHERE o.customer_id= $cid ORDER BY po.order_id";
	$result = mysqli_query($con, $query);

	#Variables
	$orderPaid= 0;
	$totalPaid= 0;

	$current_orderID = 0;
	
	#Create tables
	if($result){
		if(mysqli_num_rows($result)>0){

			$totalrows = mysqli_num_rows($result);
			echo "<h1 text-align='center'><b>Your Order History</b></h1><br>";
			
			while($row = mysqli_fetch_array($result)){
				$order_id=$row['order_id'];
				if($current_orderID == 0){
					echo"<TABLE border =1>\n";
					echo"<TR><TH>Order ID<TH>Product Name<TH>Order Quantity<TH>Unit Price<TH>Sub Total<TH> order_date\n";
					$orderPaid= 0;
					$current_orderID = $order_id;
				}
				elseif($current_orderID != $order_id){
					#-------------------------------------------
					#create final row of previous table
					echo"<TR><TD><TD>Order Paid<TD><TD><TD>$orderPaid<td>";
					#-------------------------------------------
					echo"</TABLE>\n"; #close previous table
					echo"<br>";
					echo"<TABLE border =1>\n";
					echo"<TR><TH>Order ID<TH>Product Name<TH>Order Quantity<TH>Unit Price<TH>Sub Total<TH> order_date\n";
					$orderPaid= 0;
					$current_orderID = $order_id;
				}
				$product_name=$row['product_name'];
				$order_quantity=$row['order_quantity'];
				$unit_price=$row['unit_price'];
				$sub_total=$row['sub_total'];
				$orderPaid = $orderPaid+ $sub_total;
				$totalPaid = $totalPaid+ $sub_total;
				$orderdate=$row['order_date'];
				echo "<TR><TD>$order_id<TD>$product_name<TD>$order_quantity<TD>$unit_price<TD>$sub_total<TD>$orderdate\n";
			}
			#-------------------------------------------
			#create final row of final table
			echo"<TR><TD><TD>Order Paid<TD><TD><TD>$orderPaid<td>";
			echo"</TABLE>\n"; #close final table
			echo"<TABLE><TR><TH>Total Paid<TH>$totalPaid</TABLE>";
		}
		#no records found
		else{
			echo"<br>Your Order History is currently empty. Once you start placing orders, they will appear here.<br> ";

		}

		}
		#Connection error
		else{
			echo"<br>Oops! looks like an error has occured. please try again later.";
		}
		mysqli_free_result($result);
	}
	
mysqli_close($con);
echo "<a href='customer_check_p2.php' target=_self>Customer Homepage</a><br>";
echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";
echo "</body>";
echo "</HTML>\n";
?>