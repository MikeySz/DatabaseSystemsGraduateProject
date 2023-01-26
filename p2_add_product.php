<?php
// p2_add_product.php
<HTML>
<a href='p2_employee_logout.php' target=_self>Employee Logout</a><br>
<head><title> Add Products</title>

</head><body><b> Add products </b>
<br>

<form name="input" action= "employee_insert_product.php" method="post" >
<br> Login ID: &nbsp<input type="text" name="login" required="required" maxlength="20">
<br> Password: &nbsp<input type="password" name="password" required="required" maxlength="10">
<br> Retype Password: &nbsp<input type="password" name="password2" required="required" maxlength="10">
<br> First Name: &nbsp<input type="text" name="fname" required="required" maxlength="30">
<br> Last Name: &nbsp<input type="text" name="lname" required="required" maxlength="30">
<br> TEL: &nbsp<input type="tel" name="tel" required="required" placeholder="8885551234" maxlength="10">
<br> Address: &nbsp<input type="text" name="address" required="required" maxlength="50">
<br> City: &nbsp<input type="text" name="city" required="required" maxlength="20">
<br> Zipcode: &nbsp<input type="text" name="zipcode" required="required" placeholder="01289" maxlength="5" pattern="[0-9]*">
<br><select name="state" required="required">
	<option disabled selected value>-- Select a State --</option>
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
</select>


<input type="submit" value="Submit">
</form>
</HTML>
?>