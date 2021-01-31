<!DOCTYPE html>
<html>
<head>
	<title>HOMEPAGE</title>
</head>
<body>
	<?php include("header.php"); ?>
	<div class="container">
		<form class="mt-2" method="post" action="php/add_bills_php.php">
		  <div class="form-group">
		    <label><b>DATE</b></label>
		    <input type="datetime-local" class="form-control" name="dateOfTransation" step="1" required>
		  </div>
		  <div class="form-group">
		    <label><b>SELECT PAYMENT TYPE</b></label>
		    <select class="form-control" name="paymentType" onchange="checkTransactionType()" id="transationType" required>
		      <option value="">SELECT PAYMENT TYPE</option>
		      <option value="DEBIT">DEBIT</option>
		      <option value="CREDIT">CREDIT</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label><b>SELECT CUSTOMER NAME</b></label>
		    <select class="form-control" name="customerName" required>
		      <option value="">SELECT CUSTOMER NAME</option>
		      <?php 
		      	$con = mysqli_connect("localhost","root","","jagdish petroleum");
		      	$query = "select `name` from `customer` where `adminId` = $mobile_no";
				$res = mysqli_query($con,$query) or die(mysqli_error($con));
				while ($data = mysqli_fetch_array($res)) {
					echo "<option value='$data[0]'>$data[0]</option>";
				}
		      ?>
		    </select>
		  </div>
		  <div class="form-group d-none" id="credit">
		    <label><b>AMOUNT TO BE CREDIT</b></label>
		    <input type="text" class="form-control" name="creditAmount" placeholder="AMOUNT TO BE CREDIT">
		  </div>
		  <div class="d-none" id="debit">
			  <div class="form-group">
			    <label><b>SELECT PRODUCT</b></label>
			    <select class="form-control" name="productName"> 
			      <option>SELECT PRODUCT</option>
			      <option>OIL</option>
			      <option>MS</option>
			      <option>HSD</option>
			    </select>
			  </div>
			  <div class="form-group">
			    <label><b>CURRENT RATE</b></label>
			    <input type="text" class="form-control" name="currentRate" placeholder="CURRENT RATE">
			  </div>
			  <div class="form-group">
			    <label><b>QUNTITY(LTR)</b></label>
			    <input type="text" class="form-control" name="quntity" placeholder="QUNTITY(LTR)">
			  </div>
			  <div class="form-group">
			    <label><b>VEHICLE NUMBER</b></label>
			    <input type="text" class="form-control" name="vahicleNo" placeholder="VEHICLE NUMBER">
			  </div>
		  </div>
		  	<div class="mb-3">
		  		<input type="submit" name="submit_bill" class="btn btn-primary" value="SUBMIT BILL">
		  		<input type="reset" class="btn btn-danger" value="RESET BILL">
		  	</div>
		</form>
	</div>
</body>
<script type="text/javascript">
	function checkTransactionType(){
		var type = document.getElementById("transationType").value;
		if (type == "DEBIT") {
			document.getElementById("credit").classList.add("d-none");
			document.getElementById("debit").classList.remove("d-none");
			document.getElementById("debit").classList.add("d-display");
		}else if(type == "CREDIT"){
			document.getElementById("credit").classList.remove("d-none");
			document.getElementById("credit").classList.add("d-display");
			document.getElementById("debit").classList.add("d-none");
		}else if(type == "SELECT PAYMENT TYPE"){
			document.getElementById("credit").classList.add("d-none");
			document.getElementById("debit").classList.add("d-none");
		}
	}
</script>
</html>