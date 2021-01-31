<?php 
	if (isset($_POST['submit'])) {
		$con = mysqli_connect("localhost","root","","jagdish petroleum");

		session_start();
		$mobile_no = $_SESSION['id'];

		$c_name = strtoupper(mysqli_real_escape_string($con,$_POST['c_name']));
		$c_mno = mysqli_real_escape_string($con,$_POST['c_mobile_no']);
		$c_email = mysqli_real_escape_string($con,$_POST['c_email']);
		$c_address = strtoupper(mysqli_real_escape_string($con,$_POST['c_address']));

		$queryFoeCheck = "select * from `customer` where `name` = '$c_name' and `adminId` = $mobile_no";
		$resForCheck = mysqli_query($con,$queryFoeCheck) or die(mysqli_error($con));
		if (mysqli_num_rows($resForCheck) > 0) {
			echo "<script>
				alert('THIS NAME OF CUSTOMER ALREADY EXISTS. PLEASE USE ANOTHER NAME.');
				window.location.replace('../add_customer.php?c_name=$c_name&c_mno=$c_mno&c_email=$c_email&c_address=$c_address');
			</script>";			
		}else{
			$query = "insert into `customer` (`name`,`mobile no`,`email`,`address`,`adminId`) values('$c_name','$c_mno','$c_email','$c_address',$mobile_no)";
			$res = mysqli_query($con,$query) or die(mysqli_error($con));

			echo "<script>
				alert('CUSTOMER ADDED SUCCESSFULLY');
				window.location.replace('../add_customer.php');
			</script>";
		}
	} else {
		header("location:../add_customer.php");
	}

?>