<!DOCTYPE html>
<html>
<head>
	<title>MANAGE WORKERS SHIPS</title>
</head>
<body>
	<?php include 'header.php'; ?>
	<div class="container">
		
		<form class="form-inline mt-3" method="post" action="php/add_ship_php.php">
			<div class="form-group">
			    <label><b>ADD SHIP</b></label>
			    <select class="form-control ml-2" name="workerName" required>
			      <option value="">SELECT WORKERS NAME</option>
			      <?php 
			      	$con = mysqli_connect("localhost","root","","jagdish petroleum");
			      	$query = "select `name` from `worker` where `adminId` = $mobile_no";
					$res = mysqli_query($con,$query) or die(mysqli_error($con));
					while ($data = mysqli_fetch_array($res)) {
						echo "<option value='$data[0]'> $data[0]</option>";
					}
			      ?>
			    </select>
			    <select class="form-control ml-2" name="ship" required>
			    	<option value="">SELECT SHIP</option>
			    	<option value="7 TO 2">7 TO 2</option>
			    	<option value="2 TO 9">2 TO 9</option>
			    	<option value="9 TO 7">9 TO 7</option>
			    </select>
			    <input type="text" name="lessMoney" class="form-control mx-2" placeholder="LESS MONEY" required>
			    <input type="date" name="shipDate" class="form-control" required>
			  </div>
			  <input type="submit" name="addShipData" value="ADD" class="btn btn-primary mx-2" required>
		</form> 
		<form class="form-inline mt-3" method="post">
			<div class="form-group">
			    <label><b>SELECT WORKERS NAME</b></label>
			    <select class="form-control ml-2" name="workerName">
			      <option>SELECT WORKERS NAME</option>
			      <?php 
			      	$con = mysqli_connect("localhost","root","","jagdish petroleum");
			      	$query = "select `name` from `worker` where `adminId` = $mobile_no";
					$res = mysqli_query($con,$query) or die(mysqli_error($con));
					while ($data = mysqli_fetch_array($res)) {
						if (isset($_POST['findWorkerAcc']) && $_POST['workerName'] == $data[0]) 
							echo "<option selected>$data[0]</option>";
						else
							echo "<option>$data[0]</option>";
					}
			      ?>
			    </select>
			  </div>
			  <input type="submit" name="findWorkerAcc" value="FIND" class="btn btn-primary mx-2">
			  <input type="reset" value="RESET" class="btn btn-danger mx-2" <?php if (isset($_POST['findWorkerAcc'])) {
			  	echo "disabled";
			  } ?>>
		</form> 

		<div class="row mt-2">
			<div style="height: 500px;overflow-y: scroll;width: 100%">
				<table class="table table-hover table-dark"> 
				  <thead class="thead-light">
				  	<tr align="center">
				      <th colspan="9">DEBIT</th>
				    </tr>
				    <tr>
				      <th scope="col">#</th>
				      <th scope="col">SHIP DATE</th>
				      <th scope="col">DATE</th>
				      <th scope="col">LESS MONEY</th>
				      <th scope="col"></th>				      
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
						if (isset($_POST['findWorkerAcc'])) {
							$count = 0;
							$debit = 0;
							
							$con = mysqli_connect("localhost","root","","jagdish petroleum");

							$w_name = strtoupper(mysqli_real_escape_string($con,$_POST['workerName']));

							$query = "select * from `ship` where `name` = '$w_name'  and `adminId` = $mobile_no";
							
							$res = mysqli_query($con,$query) or die(mysqli_error($con));
							if (mysqli_num_rows($res) > 0) {
								while ($data = mysqli_fetch_array($res)) {
									$debit += $data[4];
									$count++;
									echo "
										<tr>
									      <th scope='row'>$count</th>
									      <td>$data[3]</td>
									      <td>$data[2]</td>
									      <td>$data[4]</td>	
									      <td><a href='php/delete.php?id=$data[0]&typeOfDelete=ship_transaction' class='text-danger'>Delete</a></td>
									    </tr>
									";			
								}		
							}
						}
					?>
				  </tbody>
				</table>
			</div>
			<div class="w-100 mt-1" style="text-align: center;font-size: 30px">
				<b class="text-primary">TOTAL DEBIT: RS. 
					<?php
						if (isset($_POST['findWorkerAcc'])) 
							echo "$debit"; 
						else
							echo "0";
					 ?>
				 </b>	
			</div>
		</div>
	</div>
</body>
</html>