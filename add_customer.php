<!DOCTYPE html>
<html>
<head>
	<title>ADD CUSTOMER</title>
</head>
<body>
	<?php include("header.php"); ?>
	<div class="container">
		<form class="mt-2" method="post" action="php/add_customer_php.php">
		  <div class="form-group">
		    <label><b>CUSTOMER NAME</b></label>
		    <input type="text" class="form-control" name="c_name" 
		    value="<?php $name = isset($_GET['c_name'])? $_GET['c_name']: ''; 
		    	echo($name);
		    ?>" 
		    placeholder="CUSTOMER NAME" required>
		  </div>
		  <div class="form-group">
		    <label><b>MOBILE NO</b></label>
		    <input type="mno" class="form-control" name="c_mobile_no"
		    value="<?php $mno = isset($_GET['c_mno'])? $_GET['c_mno']: ''; 
		    	echo($mno);
		    ?>" 
		     placeholder="MOBILE NO" minlength="10" required>
		  </div>
		  <div class="form-group">
		    <label><b>CUSTOMER EMAIL</b></label>
		    <input type="email" class="form-control"
			value="<?php $email = isset($_GET['c_email'])? $_GET['c_email']: ''; 
			   	echo($email);
			?>"
		     name="c_email" placeholder="CUSTOMER EMAIL (OPTIONAL)">
		  </div>
		  <div class="form-group">
		    <label><b>ADDRESS</b></label>
		    <input type="text" class="form-control"
			value="<?php $address = isset($_GET['c_address'])? $_GET['c_address']: ''; 
			   	echo($address);
			?>"
		     name="c_address" placeholder="CUSTOMER ADDRESS (OPTIONAL)">
		  </div>
		  	<div>
		  		<input type="submit" name="submit" class="btn btn-primary" value="ADD CUSTOMER">
		  		<input type="reset" class="btn btn-danger" value="RESET CUSTOMER">
		  	</div>
		</form>
	</div>
</body>
</html>