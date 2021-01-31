<?php 
	
	$con = mysqli_connect("localhost","root","","jagdish petroleum");

	$id = mysqli_real_escape_string($con,$_GET['id']);
	$typeOfDelete = mysqli_real_escape_string($con,$_GET['typeOfDelete']);

	if ($typeOfDelete == "worker_transaction") {
		$query = "delete from `worker_transaction` where `id` = $id";
		mysqli_query($con, $query) or die(mysqli_error($con));
		echo "<script>
				alert('TRANSACTION SUCCESSFULLY DELETED');
				window.location.replace('../manage_workers_acc.php');
			</script>";		
	}else if($typeOfDelete == "ship_transaction"){
		$query = "delete from `ship` where `id` = $id";
		mysqli_query($con, $query) or die(mysqli_error($con));
		echo "<script>
				alert('TRANSACTION SUCCESSFULLY DELETED');
				window.location.replace('../working_time.php');
			</script>";		
	}else{
		$query = "delete from `transaction` where `id` = $id";
		mysqli_query($con, $query) or die(mysqli_error($con));

		if ($typeOfDelete == "debit") {
			$queryTwo = "delete from `transaction_detail` where `transaction_id` = $id";
			mysqli_query($con, $queryTwo) or die(mysqli_error($con));	
		}
		echo "<script>
				alert('TRANSACTION SUCCESSFULLY DELETED');
				window.location.replace('../manage_customer_bill.php');
			</script>";		
	}
?>