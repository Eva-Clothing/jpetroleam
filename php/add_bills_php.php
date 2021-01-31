<?php 
	if (isset($_POST['submit_bill'])) {
		$con = mysqli_connect("localhost","root","","jagdish petroleum");

		session_start();
		$mobile_no = $_SESSION['id'];

		$paymentType = mysqli_real_escape_string($con,$_POST['paymentType']);
		$dateOfTransation = mysqli_real_escape_string($con,$_POST['dateOfTransation']);
		$customerName = mysqli_real_escape_string($con,$_POST['customerName']);
		$dateOfTransation = str_replace('T', ' ', $dateOfTransation);

		if ($paymentType == "DEBIT") {
			
			$productName = mysqli_real_escape_string($con,$_POST['productName']);
			$currentRate = mysqli_real_escape_string($con,$_POST['currentRate']);
			$quntity = mysqli_real_escape_string($con,$_POST['quntity']);
			$total = ceil($currentRate * $quntity);
			$vahicleNo = strtoupper(mysqli_real_escape_string($con,$_POST['vahicleNo']));

			$query = "insert into `transaction` (`adminId`,`c_name`,`date`,`payment_type`,`amount`) values($mobile_no,'$customerName','$dateOfTransation','$paymentType','$total')";

			$res = mysqli_query($con,$query) or die(mysqli_error($con));

			$getIdQuery = "select id from `transaction` where `date` = '$dateOfTransation' and `adminId` = $mobile_no";
			$resId = mysqli_query($con, $getIdQuery) or die(mysqli_error($con));
			$dataId = mysqli_fetch_array($resId);
			
			$query = "insert into `transaction_detail` (`transaction_id`,`adminId`,`product`,`current rate`,`quntity`,`vahicle no`) values('$dataId[0]',$mobile_no,'$productName','$currentRate','$quntity','$vahicleNo')";
			$res = mysqli_query($con,$query) or die(mysqli_error($con));

		} else {
			$creditAmount = mysqli_real_escape_string($con,$_POST['creditAmount']);
			$query = "insert into `transaction` (`c_name`,`adminId`,`date`,`payment_type`,`amount`) values('$customerName',$mobile_no,'$dateOfTransation','$paymentType','$creditAmount')";

			$res = mysqli_query($con,$query) or die(mysqli_error($con));
		}
			
		echo "<script>
				alert('TRANSACTION SUCCESSFULLY COMPLETED');
				window.location.replace('../');
			</script>";		
	} else {
		header("location:../");
	}
?>