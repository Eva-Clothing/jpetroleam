<?php 
	if (isset($_POST['submit'])) {
		$con = mysqli_connect("localhost","root","","jagdish petroleum");
		session_start();
		$mobile_no = $_SESSION['id'];
		$w_name = strtoupper(mysqli_real_escape_string($con,$_POST['w_name']));
		$w_mno = mysqli_real_escape_string($con,$_POST['w_mno']);
		$w_salary = mysqli_real_escape_string($con,$_POST['w_salary']);
		$w_address = strtoupper(mysqli_real_escape_string($con,trim($_POST['w_address'])));

		$queryFoeCheck = "select * from `worker` where `name` = '$w_name' and `adminId` = $mobile_no";
		$resForCheck = mysqli_query($con,$queryFoeCheck) or die(mysqli_error($con));
		if (mysqli_num_rows($resForCheck) > 0) {
			echo "<script>
				alert('THIS NAME OF WORKER ALREADY EXISTS. PLEASE USE ANOTHER NAME.');
				window.location.replace('../add_workers.php?w_name=$w_name&w_mno=$w_mno&w_address=$w_address&w_salary=$w_salary');
			</script>";			
		}else{
			$query = "insert into `worker` (`adminId`,`name`,`mobile no`,`salary`,`address`) values($mobile_no,'$w_name','$w_mno','$w_salary','$w_address')";
			$res = mysqli_query($con,$query) or die(mysqli_error($con));

			echo "<script>
				alert('WORKER ADDED SUCCESSFULLY');
				window.location.replace('../add_workers.php');
			</script>";
		}
	} else {
		header("location:../add_workers.php");
	}

?>