<?php
#Michael Sanchez
#Product Report
#----------------------------------------------------------------
#dbconfig allows connection to database
include "dbconfig.php";
$con = mysqli_connect($server,$login, $password, $dbname);
#----------------------------------------------------------------------------
#SQL query, This is our Product Report.
$sql = "
SELECT
p.product_id,
p.name Product_name,
v.name Vendor_name,
p.cost Cost,
p.quantity Current_Quantity,
sum(po.quantity) Sold_Quantity,
IF( sum(po.quantity) >=1,
p.sell_price,
NULL )Sell_Price,
sum(p.sell_price * po.quantity) Total_Sales,
(sum(p.sell_price* po.quantity) - p.cost) Profit
FROM CPS5740.PRODUCT p JOIN CPS5740.VENDOR v
ON p.vendor_id = v.vendor_id
LEFT JOIN CPS5740.PRODUCT_ORDER po
ON p.product_id = po.product_id
GROUP BY p.product_id
ORDER BY Product_name;
 "; 
$result = mysqli_query($con, $sql);
#-------------------------------------------------------------------------------
#Code Keeps Running if there is a Result
if($result) {
	#Table Headings are Hard Coded, this mean additional columns must  be manually inserted 
#----------------------Headings---------------------------------------------------
	echo "<TABLE border = 1>";
	echo "<TR><TH>#
				<TH>Product Name
				<TH>Vendor Name
				<TH>Cost
				<TH>Current Quantity
				<TH>Sold Quantity
				<TH>Sell Price
				<TH>Total Sales
				<TH>Profit";
#---------------------------------------------------------------------------------
	#Counters & totals
	$num = 0; # Our Row Counter
	$tC= 0; #Total Cost
	$tCQ = 0; #Total Current Quantity
	$tSQ = 0;#Total Sold Quantity
	$tSP = 0; #Total Sell Price
	$cTS = 0; #Complete Total Sales
	$tP = 0; #Total Profit
#Fetch the data 				
	while($row = mysqli_fetch_array($result)){
		$num = $num + 1;
		$Product_name = $row['Product_name'];
		$Vendor_name = $row['Vendor_name'];
		$Cost = $row["Cost"];
			$tC = $tC + $Cost; #Add to total
		$Current_Quantity = $row['Current_Quantity'];
			$tCQ = $tCQ + $Current_Quantity; #Add to total
		$Sold_Quantity = $row["Sold_Quantity"];
			$tSQ = $tSQ + $Sold_Quantity; #Add to total
		$Sell_Price = $row["Sell_Price"];
			$tSP = $tSP + $Sell_Price; #Add to total
		$Total_Sales = $row["Total_Sales"];
			$cTS = $cTS + $Total_Sales; #Add to total
		$Profit = $row["Profit"];
			$tP = $tP + $Profit; #Add to total
#--------------------------------------------------------------------------------
#Take data and put it into a HTML table	
#as long as the Vendor Name is not empty/NULL then we display the row data	
		if ($Vendor_name <>""){  
			echo "<br><TR><TD>$num<TD>$Product_name<TD>$Vendor_name<TD>$Cost<TD>$Current_Quantity<TD>$Sold_Quantity<TD>$Sell_Price<TD>$Total_Sales<TD>$Profit \n";
		}
}
	echo "<br><TR><TD>Total<TD> <TD> <TD>$tC<TD>$tCQ<TD>$tSQ<TD>$tSP<TD>$cTS<TD>$tP \n";
	echo "</TABLE>"; #close table
}

#Close the connection to the DB
mysqli_free_result($result);
mysqli_close($con);
?>