<!DOCTYPE html>
<html>
<head>
	<title>MANAGE BILLS</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="container">
		<form class="form-inline mt-3" method="post">
			<div class="form-group">
			    <label><b>SELECT CUSTOMER NAME</b></label>
			    <select class="form-control ml-2" name="customerName">
			      <option>SELECT CUSTOMER NAME</option>
				  <?php 
					session_start();
					$mobile_no = $_SESSION['id'];
		  
			      	$con = mysqli_connect("localhost","root","","jagdish petroleum");
			      	$query = "select `name` from `customer` where `adminId` = $mobile_no";
					$res = mysqli_query($con,$query) or die(mysqli_error($con));
					while ($data = mysqli_fetch_array($res)) {
						if (isset($_POST['findBill']) && $_POST['customerName'] == $data[0]) 
							echo "<option selected>$data[0]</option>";
						else
							echo "<option>$data[0]</option>";
					}
			      ?>
			    </select>
			  </div>
			  <b class="ml-2">FROM</b><input type="date" name="from" value="<?php 
			  		if(isset($_POST['findBill']) && $_POST['from'] <> ''){
			  			$newDate = strtotime($_POST['from']);
			  			$newFormat = date('Y-m-d',$newDate);
			  			echo(trim($newFormat));
			  		}
			  	 ?>" class="form-control mx-2">
			  <b class="mr-2">TO</b><input type="date" name="to" value="<?php if(isset($_POST['findBill']) && $_POST['from'] <> ''){
			  			$newDate = strtotime($_POST['to']);
			  			$newFormat = date('Y-m-d',$newDate);
			  			echo(trim($newFormat));
			  		} ?>" class="form-control mr-2">
			  <input type="submit" name="findBill" value="FIND" class="btn btn-primary mx-2">
			  
			  <input type="reset" value="RESET" class="btn btn-danger mx-2" <?php if (isset($_POST['findBill'])) {
			  	echo "disabled";
			  } ?>>
		</form> 
		<div class="w-100 text-right my-3 ">
			<a href="<?php 
			$qu = '';
			if(isset($_POST['customerName'])){
				$qu .= 'preview.php/?';
				$qu .=  'adminId='.$mobile_no;
				$qu .=  '&'.'cust='.$_POST['customerName'];
				
					$qu .=  '&'.'from='.$_POST['from'];
					$qu .=  '&'.'to='.$_POST['to'];
				
				
			}else{
				$qu = '#';
			}
			echo $qu;
			?>" target="_BLANK">DOWNLOAD REPORT</a>
		</div>
		<div class="row mt-2">
			<div style="height: 250px;overflow-y: scroll;width: 100%">
				<table class="table table-hover table-dark"> 
				  <thead class="thead-light">
				  	<tr align="center">
				      <th colspan="9">DEBIT</th>
				    </tr>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">CUSTOMER NAME</th>
				      <th scope="col">DATE</th>
				      <th scope="col">PRODUCT</th>
				      <th scope="col">CURRENT RATE</th>
				      <th scope="col">QUNTITY</th>
				      <th scope="col">TOTAL</th>
				      <th scope="col">VEHICLE NO</th>
				      <th scope="col"></th>
				      
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
						if (isset($_POST['findBill'])) {
							$count = 0;
							$debit = 0;
							$credit = 0;
							$con = mysqli_connect("localhost","root","","jagdish petroleum");

							$c_name = strtoupper(mysqli_real_escape_string($con,$_POST['customerName']));
							$from = mysqli_real_escape_string($con,$_POST['from']);
							$to = mysqli_real_escape_string($con,$_POST['to']);

							if ($from <> '' && $to <> '') 
								$query = "select * from `transaction`,`transaction_detail` where `transaction`.`adminId` = $mobile_no and `transaction`.`id` = `transaction_detail`.`transaction_id` and `transaction`.`c_name` = '$c_name' and `transaction`.`date` between '$from' and '$to'";	
							else
								$query = "select * from `transaction`,`transaction_detail` where `transaction`.`adminId` = $mobile_no and `transaction`.`id` = `transaction_detail`.`transaction_id` and `c_name` = '$c_name'";
							
							$res = mysqli_query($con,$query) or die(mysqli_error($con));
							if (mysqli_num_rows($res) > 0) {
								while ($data = mysqli_fetch_array($res)) {
									$debit += $data[4];
									$count++;
									echo "
										<tr>
									      <th scope='row'>$count</th>
									      <td>$data[1]</td>
									      <td>$data[2]</td>
										  <td>$data[8]</td>
									      <td>$data[9]</td>
										  <td>$data[10]</td> 
										  <td>$data[4]</td>
									      <td>$data[11]</td>   
									      <td><a href='php/delete.php?id=$data[0]&typeOfDelete=debit' class='text-danger'>Delete</a></td>
									    </tr>
									";			
								}		
							}
						}
					?>
				  </tbody>
				</table>
			</div>
			<div class="w-100 mt-1">
				<b style="float: right;" class="text-primary">TOTAL DEBIT: RS. 
					<?php
						if (isset($_POST['findBill'])) 
							echo "$debit"; 
						else
							echo "0";
					 ?>
				 </b>	
			</div>
		</div>
		<div class="row">
			<div style="height: 250px;overflow-y: scroll;width: 100%" class="mt-2">
				<table class="table table-hover table-dark"> 
				  <thead class="thead-light">
				  	<tr align="center">
				      <th colspan="5">CREDIT</th>
				    </tr>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">CUSTOMER NAME</th>
				      <th scope="col">DATE</th>
				      <th scope="col">CREDIT AMOUNT</th>
				      <th scope="col"></th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  		if (isset($_POST['findBill'])) {
				  			$from = mysqli_real_escape_string($con,$_POST['from']);
							$to = mysqli_real_escape_string($con,$_POST['to']);

				  			if ($from <> '' && $to <> '') 
								$query = "select * from `transaction` where `adminId` = $mobile_no and `c_name` = '$c_name' and `date` between '$from' and '$to' and `payment_type` = 'CREDIT'";	
							else
								$query = "select * from `transaction` where `adminId` = $mobile_no and `c_name` = '$c_name' and `payment_type` = 'CREDIT'";
					  		$count = 0;
							$res = mysqli_query($con,$query) or die(mysqli_error($con));
							if (mysqli_num_rows($res) > 0) {
								while ($data = mysqli_fetch_array($res)) {
									$credit += $data[4];
									$count++;
									echo "
										<tr>
									      <th scope='row'>$count</th>
									      <td>$data[1]</td>
									      <td>$data[2]</td>
									      <td>$data[4]</td>
									      <td><a href='php/delete.php?id=$data[0]&typeOfDelete=credit' class='text-danger'>Delete</a></td>
									    </tr>
									";			
								}		
							}
				  		}
				  	?>
				  </tbody>
				</table>
			</div>
			<div class="w-100 mt-1">
				<b style="float: right;" class="text-primary">TOTAL CREDIT: RS. 
					<?php
						if (isset($_POST['findBill'])) 
							echo "$credit"; 
						else
							echo "0";
					 ?>
				</b>	
			</div>

		<div class="w-100">
			<p class="text-danger" style="font-size: 36px;font-weight: bold;text-align: center;">FINAL TOTAL(DEBIT) : 
				<?php
					if (isset($_POST['findBill'])) 
						echo $debit - $credit; 
					else
						echo "0";
				 ?>
			</p>
		</div> 
		</div>
	</div>
</body>
</html>