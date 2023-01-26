<?php
#Customer Logout php file Phase 2 Edition
#Michael Sanchez
#if the cookie is set, then 'customer' cookie is set to expire in 1 sec.
if(isset($_COOKIE['customer'])){
	setcookie("customer", ' ', 1);
	echo "You have been successfully logged out. <br>";
	#Return to Phase2 homepage  
	echo "<a href='CPS5740_p2.html' target=_self >Return to Project Phase 2 Homepage</a>";
}
else{
#Else tell the user, they are not logged in
echo "You are not logged in.<br>";

#Return to Phase2 homepage  
echo "<a href='CPS5740_p2.html' target=_self>Return to Project Phase 2 Homepage</a>";
}
?>