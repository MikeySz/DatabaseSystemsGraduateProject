<?php
#Logout php file
#Michael Sanchez
#if the cookie is set, then 'employee' cookie is set to expire in 1 sec.
if(isset($_COOKIE['employee'])){
	setcookie("employee", ' ', 1);
	echo "You have been successfully logged out. <br>";
}
else
#Else tell the user, they are not logged in
echo "You are not logged in.<br>";

#Return to Phase1 homepage  
echo "<a href='CPS5740_p1.html' target=_self>Return to Project Phase 1 Homepage</a>";

?>