<?php
#Customer Update My Data Phase 2 Edition
#Michael Sanchez
include ("dbconfig.php");
echo "<HTML>\n";
#--------------------------------------------------------------------------------------------------------
#if the cookie is not set, then tell the user to login.
if(!isset($_COOKIE['customer']))
	die("Please login first.<br>
		<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Homepage</a>");

#allows for Customer to Logout 
echo "<a href='customer_logout_p2.php' target=_self>Customer Logout</a><br>";
#Else if the cookie is set, allow customer to view an updatable table of their info
#get cid from cookie and create connection
$cid=$_COOKIE['customer'];
$con=mysqli_connect($server, $login, $password, $dbname);
if(!$con){
	die("Connection fail!");
}
#---------------------------------------------------------------------------------------------------------------------
#display Customer's Information
				#SQL query to retrieve customer's info
						$sql= " SELECT customer_id, login_id, password, first_name, last_name, TEL, address, city,zipcode,state FROM 2022F_sanchem1.CUSTOMER WHERE customer_id = '$cid'";

					$result= mysqli_query($con, $sql);
					#There should always be one row, but if not then just return an error
					if (mysqli_num_rows($result) == 0){
						die("Sorry, something went wrong ");
					}


					echo "<form action='p2_customer_info_insert.php' method='post'>";
						#Creates Customer Table
						if($result) {
							echo "<TABLE border = 1> ";
							echo "<TR><TH>Customer ID<TH>login ID<TH>password<TH>Last Name<TH>First Name<TH>TEL<TH>Address<TH>City<TH>Zipcode<TH>State";
							while($row = mysqli_fetch_array($result)){
								$id = $row['customer_id'];
								$login = $row['login_id'];
								$password = $row['password'];
								$lname = $row["last_name"];
								$fname = $row["first_name"];
								$tel = $row["TEL"];
								$address = $row["address"];
								$city = $row["city"];
								$zipcode= $row["zipcode"];
								$state = $row["state"];

								#Checks id is not empty/NULL
								if ($login <>"") {
									echo "<br><TR><TD STYLE ='background-color:yellow'> $id <TD STYLE ='background-color:yellow'>$login";
							
									echo"<TD><input type='text' value='$password' name= 'password' required='required' maxlength = '10'></TD> ";
									echo"<TD><input type='text' value='$lname' name= 'lname' required='required' maxlength = '30'></TD> ";
									echo"<TD><input type='text' value='$fname' name= 'fname' required='required' maxlength = '30'></TD> ";
									echo"<TD><input type='text' value='$tel' name= 'tel' required='required' maxlength = '10'></TD> ";
									echo"<TD><input type='text' value='$address' name= 'address' required='required' maxlength = '50'></TD> ";
									echo"<TD><input type='text' value='$city' name= 'city' required='required' maxlength = '20'></TD> ";
									echo"<TD><input type='text' value='$zipcode' name= 'zipcode' required='required' maxlength = '5' pattern='[0-9]*'></TD> ";

									echo" <TD><select name='state' required='required'>
										<option  disabled selected value >-- Select a State --</option>
										<option value='AL'".(($state == 'AL' )?"selected='selected'":"").">Alabama</option>
										<option value='AK'".(($state == 'AK' )?"selected='selected'":"").">Alaska</option>
										<option value='AZ'".(($state == 'AZ' )?"selected='selected'":"").">Arizona</option>
										<option value='AR'".(($state == 'AR' )?"selected='selected'":"").">Arkansas</option>
										<option value='CA'".(($state == 'CA' )?"selected='selected'":"").">California</option>
										<option value='CO'".(($state == 'CO' )?"selected='selected'":"").">Colorado</option>
										<option value='CT'".(($state == 'CT' )?"selected='selected'":"").">Connecticut</option>
										<option value='DE'".(($state == 'DE' )?"selected='selected'":"").">Delaware</option>
										<option value='DC'".(($state == 'DC' )?"selected='selected'":"").">District Of Columbia</option>
										<option value='FL'".(($state == 'FL' )?"selected='selected'":"").">Florida</option>
										<option value='GA'".(($state == 'GA' )?"selected='selected'":"").">Georgia</option>
										<option value='HI'".(($state == 'HI' )?"selected='selected'":"").">Hawaii</option>
										<option value='ID'".(($state == 'ID' )?"selected='selected'":"").">Idaho</option>
										<option value='IL'".(($state == 'IL' )?"selected='selected'":"").">Illinois</option>
										<option value='IN'".(($state == 'IN' )?"selected='selected'":"").">Indiana</option>
										<option value='IA'".(($state == 'IA' )?"selected='selected'":"").">Iowa</option>
										<option value='KS'".(($state == 'KS' )?"selected='selected'":"").">Kansas</option>
										<option value='KY'".(($state == 'KY' )?"selected='selected'":"").">Kentucky</option>
										<option value='LA'".(($state == 'LA' )?"selected='selected'":"").">Louisiana</option>
										<option value='ME'".(($state == 'ME' )?"selected='selected'":"").">Maine</option>
										<option value='MD'".(($state == 'MD' )?"selected='selected'":"").">Maryland</option>
										<option value='MA'".(($state == 'MA' )?"selected='selected'":"").">Massachusetts</option>
										<option value='MI'".(($state == 'MI' )?"selected='selected'":"").">Michigan</option>
										<option value='MN'".(($state == 'MN' )?"selected='selected'":"").">Minnesota</option>
										<option value='MS'".(($state == 'MS' )?"selected='selected'":"").">Mississippi</option>
										<option value='MO'".(($state == 'MO' )?"selected='selected'":"").">Missouri</option>
										<option value='MT'".(($state == 'MT' )?"selected='selected'":"").">Montana</option>
										<option value='NE'".(($state == 'NE' )?"selected='selected'":"").">Nebraska</option>
										<option value='NV'".(($state == 'NV' )?"selected='selected'":"").">Nevada</option>
										<option value='NH'".(($state == 'NH' )?"selected='selected'":"").">New Hampshire</option>
										<option value='NJ'".(($state == 'NJ' )?"selected='selected'":"").">New Jersey</option>
										<option value='NM'".(($state == 'NM' )?"selected='selected'":"").">New Mexico</option>
										<option value='NY'".(($state == 'NY' )?"selected='selected'":"").">New York</option>
										<option value='NC'".(($state == 'NC' )?"selected='selected'":"").">North Carolina</option>
										<option value='ND'".(($state == 'ND' )?"selected='selected'":"").">North Dakota</option>
										<option value='OH'".(($state == 'OH' )?"selected='selected'":"").">Ohio</option>
										<option value='OK'".(($state == 'OK' )?"selected='selected'":"").">Oklahoma</option>
										<option value='OR'".(($state == 'OR' )?"selected='selected'":"").">Oregon</option>
										<option value='PA'".(($state == 'PA' )?"selected='selected'":"").">Pennsylvania</option>
										<option value='RI'".(($state == 'RI' )?"selected='selected'":"").">Rhode Island</option>
										<option value='SC'".(($state == 'SC' )?"selected='selected'":"").">South Carolina</option>
										<option value='SD'".(($state == 'SD' )?"selected='selected'":"").">South Dakota</option>
										<option value='TN'".(($state == 'TN' )?"selected='selected'":"").">Tennessee</option>
										<option value='TX'".(($state == 'TX' )?"selected='selected'":"").">Texas</option>
										<option value='UT'".(($state == 'UT' )?"selected='selected'":"").">Utah</option>
										<option value='VT'".(($state == 'VT' )?"selected='selected'":"").">Vermont</option>
										<option value='VA'".(($state == 'VA' )?"selected='selected'":"").">Virginia</option>
										<option value='WA'".(($state == 'WA' )?"selected='selected'":"").">Washington</option>
										<option value='WV'".(($state == 'WV' )?"selected='selected'":"").">West Virginia</option>
										<option value='WI'".(($state == 'WI' )?"selected='selected'":"").">Wisconsin</option>
										<option value='WY'".(($state == 'WY' )?"selected='selected'":"").">Wyoming</option>
											</select></td> ";


									
									echo"\n";
									}	}
								echo "</TABLE>";  #End of Transaction Table
							
								echo"<br><input type='submit' value='Update Information'> </form>";

								mysqli_free_result($result);
									}
							
							#Return to Customer Homepage  
					echo "<br><a href='customer_check_p2.php' target=_self>Return to Customer Homepage</a>";
							#Return to Phase 2 homepage  
					echo "<br><a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Homepage</a>";
echo "</body>";
echo "</HTML>";
mysqli_close($con);

?>