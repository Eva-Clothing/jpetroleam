<?php 
	if (isset($_POST['addTransactionToWorker'])) {
		$con = mysqli_connect("localhost","root","","jagdish petroleum");

		session_start();
		$mobile_no = $_SESSION['id'];

		$workerName = mysqli_real_escape_string($con,$_POST['workerName']);
		$transactionComment = mysqli_real_escape_string($con,$_POST['transactionComment']);
		$transactionMoney = mysqli_real_escape_string($con,$_POST['transactionMoney']);
		$transactionDate = mysqli_real_escape_string($con,$_POST['transactionDate']);

		$query = "insert into `worker_transaction` (`adminId`,`worker_name`,`date`,`comment`,`money`) values($mobile_no,'$workerName','$transactionDate','$transactionComment','$transactionMoney')";

		$res = mysqli_query($con,$query) or die(mysqli_error($con));
		
		echo "<script>
				alert('TRANSACTION SUCCESSFULLY COMPLETED');
				window.location.replace('../manage_workers_acc.php');
			</script>";		
	} else {
		header("location:../manage_workers_acc.php");
	}

?>