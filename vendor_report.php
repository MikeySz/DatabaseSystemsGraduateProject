<?php
#Michael Sanchez
#Vendor Report
#----------------------------------------------------------------
#dbconfig allows connection to database
include "dbconfig.php";
$con = mysqli_connect($server,$login, $password, $dbname);
#----------------------------------------------------------------------------
#SQL query, This is our Vendor Report.
$sql = " SELECT 
v.name Vendor_name, 
sum(p.quantity) Quantity_in_Stock, 
IF( sum(po.quantity) >=1,
	sum(p.cost),
	NULL ) Total_Cost,
sum(po.quantity) Sold_Quantity,
sum(p.sell_price * po.quantity) Total_Sale,
(sum(p.sell_price * po.quantity) - sum(p.cost) ) Profit
FROM VENDOR v LEFT JOIN PRODUCT p
ON v.vendor_id = p.vendor_id
LEFT JOIN PRODUCT_ORDER po
ON p.product_id = po.product_id
GROUP BY v.vendor_id 
ORDER BY Vendor_name"; 
$result = mysqli_query($con, $sql);
#-------------------------------------------------------------------------------
#Code Keeps Running if there is a Result
if($result) {
	#Table Headings are Hard Coded, this mean additional columns must  be manually inserted 
#----------------------Headings---------------------------------------------------
	echo "<TABLE border = 1>";
	echo "<TR><TH>#
				<TH>Vendor name
				<TH>Quantity in Stock
				<TH>Total cost
				<TH>Sold Quantity
				<TH>Total Sale
				<TH>Profit";
#---------------------------------------------------------------------------------
	#Counters & totals
	$num = 0; # Our Row Counter
	$tQiS = 0; #Total Quantity in Stock 
	$cTC = 0; #Complete Total Cost
	$tSQ = 0;#Total Sold Quantity
	$cTS = 0; #Complete Total Sale
	$tP = 0; #Total Profit
#Fetch the data 				
	while($row = mysqli_fetch_array($result)){
		$num = $num + 1;
		$Vendor_name = $row['Vendor_name'];
		$Quantity_in_Stock = $row['Quantity_in_Stock'];
			$tQiS = $tQiS + $Quantity_in_Stock; #Add to total
		$Total_Cost = $row["Total_Cost"];
			$cTC = $cTC + $Total_Cost; #Add to total
		$Sold_Quantity = $row["Sold_Quantity"];
			$tSQ = $tSQ + $Sold_Quantity; #Add to total
		$Total_Sale = $row["Total_Sale"];
			$cTS = $cTS + $Total_Sale; #Add to total
		$Profit = $row["Profit"];
			$tP = $tP + $Profit; #Add to total
#--------------------------------------------------------------------------------
#Take data and put it into a HTML table	
#as long as the Vendor Name is not empty/NULL then we display the row data	
		if ($Vendor_name <>""){  
			echo "<br><TR><TD>$num<TD>$Vendor_name<TD>$Quantity_in_Stock<TD>$Total_Cost<TD>$Sold_Quantity<TD>$Total_Sale<TD>$Profit \n";
		}
}
	echo "<br><TR><TD>Total<TD>  <TD>$tQiS<TD>$cTC<TD>$tSQ<TD>$cTS<TD>$tP \n";
	echo "</TABLE>"; #close table
}

#Close the connection to the DB
mysqli_free_result($result);
mysqli_close($con);
?>