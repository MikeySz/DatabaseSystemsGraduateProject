<?php
#Michael Sanchez
#p2_employee_search_product
#include ("dbconfig.php");
echo "<HTML>\n";
echo "<body>";
echo "<title> Employee Product Search</title>";

if(!isset($_COOKIE['employee']))
	die("Please login first.<br>
		<a href='p2_employee_login.php' target=_self>Return to Employee Login</a>");

echo "<a href='p2_employee_logout.php' target=_self>Employee Logout</a><br>";	


echo"<form name='input' action= 'employee_display_product.php' method='post' >";
echo"<br> Search Product: &nbsp<br> <input type='text' name='product_keyword' required='required' maxlength='30'>";
echo"<input type='submit' value='Submit'></form></HTML>";

echo "<br><a href='p2_employee_login.php' target=_self>Employee Homepage</a><br>";
echo "<a href='CPS5740_p2.html' target=_self>Project Phase 2 Homepage</a><br>";


echo"</body>";
echo "</HTML>";
?>