<?php
#Michael S.
#Phase 2 View Vendors
#Displays the employee info found within the EMPLOYEE2 table in the CPS5740 DB.
include "dbconfig.php";
echo "<HTML>\n";

echo "<body>";
echo"<div style='margin:auto; width: 720px '>";
$con=mysqli_connect($server, $login, $password, $dbname);

#if the cookie is not set, then tell the user to login.
if(!isset($_COOKIE['employee']))
	die("Please login first.<br>
		<a href='p2_employee_login.php' target=_self>Return to Employee Login</a>");

#Logout Button
echo "<a href='p2_employee_logout.php' target=_self>Employee Logout</a><br>";
#When connection fails, close the program
if(!$con){
	die("Connection failed!");
}

else{
#Else continue with the employee display program
	echo "<h1 text-align='center'>The following Vendors are in the database.</h1>";
	$query = "SELECT vendor_id ID, name, address, city, state, zipcode, latitude, Longitude  FROM CPS5740.VENDOR ORDER BY Vendor_id";
	$result = mysqli_query($con, $query);
	
	$vidArray=array();
	$latArray = array();
	$longArray = array();
	$i = 0;
	$x = 0;
	#Create a table to hold all records of data returned from query above.
	if($result){
		if(mysqli_num_rows($result)>0){
			echo"<TABLE border =1>\n";
			echo"<TR><TH>ID<TH>Name<TH>Address<TH>City<TH>State<TH>Zipcode <TH> Location(latitude, longitude)\n";
			while($row = mysqli_fetch_array($result)){
				$ID=$row['ID'];
				$vidArray[$i]=$ID;
				$name=$row['name'];
				$address=$row['address'];
				$city=$row['city'];
				$state=$row['state'];
				$zipcode=$row['zipcode'];
				$latitude=$row['latitude'];
				$latArray[$i]=$latitude;
				$longitude=$row['Longitude'];
				$longArray[$i]=$longitude;
				echo "<TR><TD>$ID<TD>$name<TD>$address<TD>$city<TD>$state<TD>$zipcode<TD>( $latitude , $longitude )\n";
				$i=$i+1;
			}
			echo"</TABLE>\n"; #close table
			
			If(count($vidArray)>0){
				echo'
<div id="googleMap" style="width:100%;height:400px;"></div>

<script>';
		
echo'function myMap() { 
	var mapProp= {
  center:new google.maps.LatLng(39.521741, -96.848224),
  zoom:4,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);';
while($x<count($vidArray)){
	echo"new google.maps.Marker({
	  position: new google.maps.LatLng($latArray[$x], $longArray[$x]),
		  map,
		  label: {text:'$vidArray[$x]',
							fontSize: '20px',
							fontWeight: 'bold'   }
		});";
		$x=$x+1;
		}


echo'
}

</script>

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=myMap"></script>
';
}




		}
		#If no records, then we return message.
		else{
			echo"<br>No Record Found!";
		}
		mysqli_free_result($result);
	}
	


	mysqli_close($con);





	}
echo "<a href='p2_employee_login.php' target=_self>Employee Homepage</a><br>";
echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";
echo"</div>";
echo "</body>";
echo "</HTML>\n";
?>