<?php
#Michael Sanchez
#Customer_check_p2.php
#Modified Code of the Customer Login previously featured in my Phase1 program; Re-Purposed for Phase2.
define("IN_CODE", 1);
include "dbconfig.php";
echo "<HTML>\n";
echo "<body>";
#============================
#Functions
function displayAD($keyword, $con){
	#Query:  SELECT id, category, description, url from CPS5740.Advertisement WHERE url IS NOT NULL OR category ='OTHER' ORDER BY id;
	$sqlAD = "SELECT id, category, image, description, url from CPS5740.Advertisement WHERE url IS NOT NULL OR category ='OTHER'";
	$keyword = strtoupper($keyword);
	$resultAD = mysqli_query($con, $sqlAD);
	$found = false;
	if($resultAD) {
	if(mysqli_num_rows($resultAD)>0){
		while($rowAD = mysqli_fetch_array($resultAD) AND $found != true){
			$category=$rowAD["category"];
			$image = $rowAD["image"];
			$description = $rowAD["description"];
			$url = $rowAD["url"];
			#echo(strpos($keyword, $category));
			if(strpos($keyword, $category)!== false){
				#echo"<img src='data:image/jpeg;base64,".base64_encode($img)."'/>";
				echo"<a href='$url' target='_blank'> <img src ='data:image/jpeg;base64,".base64_encode($image)."'/> </a>  <br> $description <br><br>";
				#set found to true
				$found = true;
				
			}
			#If we reach the other category, then we must assume that no categories were found in the search
			elseif($category == 'OTHER'){
				echo"<a href='$url' target='_blank'> <img src ='data:image/jpeg;base64,".base64_encode($image)."'/> </a>  <br> $description <br><br>";
				#set found to true
				$found = true;

			}

			}
			#echo"<br> Exit While Loop";
		}
	}


}




#===========================

#Attempt to establish Connection, else if it fails we close the program
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}
#==========================Customer Cookie is found!================================
if(isset($_COOKIE['customer']) and ! isset($_POST["login"])){

$id=$_COOKIE['customer'];
#run the query using cookie value
$sql= "SELECT customer_id, login_id, password,CONCAT(first_name,' ',last_name ) name, CONCAT(address,', ',city,', ',state,' ', zipcode) address FROM 2022F_sanchem1.CUSTOMER WHERE customer_id='$id'";
$result = mysqli_query($con, $sql);


#--------------------------------------------------------------------------------------------------------------------------------
if($result) {
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$cid=$row["customer_id"];
			$clogin = $row["login_id"];
			$cpassword = $row['password'];
			$cname =$row['name'];
			$caddress =$row['address'];
			#Checks if entered password exists matches with query. If so login the user and set a cookie
			if ($cid == $id){  
				
				#we do not want to reset the cookie if the user hasnt logged back in
				#setcookie("customer", $cid, time()+60*60);
#========================================================================================================================================
#Customer Page
				#Customer greeting, uses name retrived through the previous query
				echo "Welcome customer: <b>".$cname."</b> <br>";
				echo" ".$caddress."<br> ";
				#-------------IP-------------------
				#Var to hold IP Address string
				$ip = " ".$_SERVER['REMOTE_ADDR'];

				#Return IP Address
				echo "Your IP:".$ip.'<br>';
				#Check if User is(or is NOT) from Kean
				if(strpos( $ip," 10.") !== false || strpos( $ip," 131.125.") !== false )
					echo("You are from Kean University. <br>");
				else echo "You are NOT from Kean University. <br>";
				#-------------------------------------

				#allows for Logout 
				echo "<a href='customer_logout_p2.php' target=_self>Customer Logout</a><br>";
				#update customer data 
				echo "<a href='customer_update_p2.php' target=_self>Update my data</a><br><br>";

				#Phase 2 Functions
				#View order history
				echo "<a href='customer_order_history.php' target=_self>View my order history</a><br>";
				#Search and order function.
				echo"<form name ='input' action='search_product.php' method='get'>Search Product: &nbsp<br> (* for all, multiple keywords seperated by space)<br> <input type='text' name='keyword' required='required' maxlength='100'> <input type='submit' value='submit'></form>";
				#Display Ad:
				#cookie customer_search
				if(isset($_COOKIE['customer_search'])) {
					$adKeyword = $_COOKIE['customer_search'];
					displayAD($adKeyword, $con);
				}
				#no cookie found
				else{
					displayAD('other', $con);

				}



				
				#Return to Project Phase 2 Homepage, to allow use of employee cookie
				echo"<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Page</a>";
				

#-----------------------------------------------------------------------------------------------------------


#===========================================================================================================
			}
			else{
				echo"<a href='p2_customer_login.html' target=_self>Return to Customer Login</a>";#return to Customer Login
				echo "<br> Authenthication Failed, please try again"; #runs if the password is not found in the database, but username is valid
				}
			}
	}
	else{
		echo"<a href='p2_customer_login.html' target=_self>Return to Customer Login</a>";#return to Customer Login
		echo "<br> Authentication Error, please try again";   #if $result has no rows, then no such user exists in the DB
		}
}
	else {
		echo"<a href='CPS5740_p2.html' target=_self>Return to Project 2 Homepage</a>";#return to Phase 2 homepage
		echo "<br> something went wrong!";    #if all fails, then tell user something went wrong
}



}
#=================================================================================================
#=====================cookie not found and a POST Method is not used============================
elseif(!isset($_COOKIE['customer'])  AND !isset($_POST['login']) ){

mysqli_close($con);
header("Location:p2_customer_login.html");

}
#==========================Customer cookie is not found========================================
else{
#retrieve the login and password from the post method
$blogin=mysqli_real_escape_string($con,$_POST["login"]);
if(empty(trim($blogin))){
	die("Empty Login!");
}
$bpassword=mysqli_real_escape_string($con,$_POST["password"]);
if(empty(trim($bpassword))){
	die("Empty password!");
}

#SELECT customer_id, login_id, password,CONCAT(first_name,' ',last_name ) name, CONCAT(address,', ',city,', ',state,' ', zipcode) address FROM 2022F_sanchem1.CUSTOMER 
#Establish an intial query and run it.
$sql= "SELECT customer_id, login_id, password,CONCAT(first_name,' ',last_name ) name, CONCAT(address,', ',city,', ',state,' ', zipcode) address FROM 2022F_sanchem1.CUSTOMER WHERE login_id='$blogin'";
$result = mysqli_query($con, $sql);


#--------------------------------------------------------------------------------------------------------------------------------
if($result) {
	if(mysqli_num_rows($result)>0){
		while($row = mysqli_fetch_array($result)){
			$cid=$row["customer_id"];
			$clogin = $row["login_id"];
			$cpassword = $row['password'];
			$cname =$row['name'];
			$caddress =$row['address'];
			#Checks if entered password exists matches with query. If so login the user and set a cookie
			if ($cpassword == $bpassword){  
				
				setcookie("customer", $cid, time()+60*60);
#========================================================================================================================================
#Customer Page
				#Customer greeting, uses name retrived through the previous query
				echo "Welcome customer: <b>".$cname."</b> <br>";
				echo" ".$caddress."<br> ";
				#-------------IP-------------------
				#Var to hold IP Address string
				$ip = " ".$_SERVER['REMOTE_ADDR'];

				#Return IP Address
				echo "Your IP:".$ip.'<br>';
				#Check if User is(or is NOT) from Kean
				if(strpos( $ip," 10.") !== false || strpos( $ip," 131.125.") !== false )
					echo("You are from Kean University. <br>");
				else echo "You are NOT from Kean University. <br>";
				#-------------------------------------

				#allows for Logout 
				echo "<a href='customer_logout_p2.php' target=_self>Customer Logout</a><br>";
				#update customer data 
				echo "<a href='customer_update_p2.php' target=_self>Update my data</a><br>";

				#Phase 2 Functions
				#View order history
				echo "<a href='customer_order_history.php' target=_self>View my order history</a><br>";
				#Search and order function.
				echo"<form name ='input' action='search_product.php' method='get'>Search Product: &nbsp<br> (* for all, multiple keywords seperated by space)<br> <input type='text' name='keyword' required='required' maxlength='100'> <input type='submit' value='submit'></form>";
				#Display Ad:
				#cookie customer_search
				if(isset($_COOKIE['customer_search'])){
					$adKeyword = $_COOKIE['customer_search'];
					displayAD($adKeyword, $con);
				}
				#no cookie found
				else{
					displayAD('other', $con);

				}
				


				
				#Return to Project Phase 2 Homepage, to allow use of employee cookie
				echo"<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Page</a>";
				

#-----------------------------------------------------------------------------------------------------------


#===========================================================================================================
			}
			else{
				echo"<a href='p2_customer_login.html' target=_self>Return to Customer Login</a>";#return to Customer Login
				echo "<br> Authenthication Failed, please try again"; #runs if the password is not found in the database, but username is valid
				}
			}
	}
	else{
		echo"<a href='p2_customer_login.html' target=_self>Return to Customer Login</a>";#return to Customer Login
		echo "<br> Authentication Error, please try again";   #if $result has no rows, then no such user exists in the DB
		}
}
	else {
		echo"<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Page</a>"; # Return to phase 2 homepage
		echo "<br> something went wrong!";    #if all fails, then tell user something went wrong
}

}
echo"</body>";
echo "</HTML>";
mysqli_close($con);
?>