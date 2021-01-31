<!DOCTYPE html>
<html>
<head>
	<title>ADD WORKERS</title>
</head>
<body>
	<?php include("header.php"); ?>
	<div class="container">
		<form class="mt-2" method="post" action="php/add_worker_php.php">
		  <div class="form-group">
		    <label><b>WORKER NAME</b></label>
		    <input type="text" class="form-control" name="w_name" 
		    value="<?php $name = isset($_GET['w_name'])? $_GET['w_name']: ''; 
		    	echo($name);
		    ?>" 
		    placeholder="WORKER NAME" required>
		  </div>
		  <div class="form-group">
		    <label><b>MOBILE NO</b></label>
		    <input type="mno" class="form-control" name="w_mno"
		    value="<?php $mno = isset($_GET['w_mno'])? $_GET['w_mno']: ''; 
		    	echo($mno);
		    ?>" 
		     placeholder="MOBILE NO" minlength="10" required>
		  </div>
		  <div class="form-group">
		    <label><b>SALARY</b></label>
		    <input type="text" class="form-control" name="w_salary"
		    value="<?php $salary = isset($_GET['w_salary'])? $_GET['w_salary']: ''; 
		    	echo($salary);
		    ?>" 
		     placeholder="SALARY" required>
		  </div>
		  <div class="form-group">
		    <label><b>ADDRESS</b></label>
		    <textarea class="form-control"
			value="<?php $address = isset($_GET['w_address'])? $_GET['w_address']: ''; 
			   	echo($address);
			?>"
		     name="w_address" placeholder="WORKER ADDRESS" rows="4" required>
		 </textarea>
		  </div>

		  	<div>
		  		<input type="submit" name="submit" class="btn btn-primary" value="ADD WORKER">
		  		<input type="reset" class="btn btn-danger" value="RESET WORKER">
		  	</div>
		</form>
	</div>
</body>
</html>