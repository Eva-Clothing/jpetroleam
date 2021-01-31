<?php 
	if (isset($_POST['addShipData'])) {
		$con = mysqli_connect("localhost","root","","jagdish petroleum");

		session_start();
		$mobile_no = $_SESSION['id'];

		$workerName = mysqli_real_escape_string($con,$_POST['workerName']);
		$ship = mysqli_real_escape_string($con,$_POST['ship']);
		$lessMoney = mysqli_real_escape_string($con,$_POST['lessMoney']);
		$shipDate = mysqli_real_escape_string($con,$_POST['shipDate']);

		$query = "insert into `ship` (`adminId`,`name`,`date`,`ship`,`less_money`) values($mobile_no,'$workerName','$shipDate','$ship','$lessMoney')";

		$res = mysqli_query($con,$query) or die(mysqli_error($con));
		
		echo "<script>
				alert('TRANSACTION SUCCESSFULLY COMPLETED');
				window.location.replace('../working_time.php');
			</script>";		
	} else {
		header("location:../working_time.php");
	}

?>