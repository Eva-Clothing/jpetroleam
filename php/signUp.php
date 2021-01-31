<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $con = mysqli_connect("localhost", "root", "", "jagdish petroleum");

        $pumpName = mysqli_real_escape_string($con, $_POST['petrolPumpName']);
        $mobileNo = mysqli_real_escape_string($con, $_POST['mobileNo']);
        $pass = md5(mysqli_real_escape_string($con, $_POST['pass']));

        $query = "select * from `petrol_pump` where `mobileNo` = $mobileNo";
        $res = mysqli_query($con, $query) or die(mysqli_error($con));

        if(mysqli_num_rows($res) > 0){
            echo "<script>
                    alert('THIS MOBILE NO IS ALREADY IN USE');
                    window.location.replace('../signUp.php');
                </script>";
        }else{
            $query = "insert into `petrol_pump` (`mobileNo`,`password`,`name`) values($mobileNo,'$pass','$pumpName')";
            $res = mysqli_query($con, $query) or die(mysqli_error($con));
            echo "<script>
                    alert('YOU SUCCESSFULLY ADDED');
                    window.location.replace('../index.php');
                </script>";
        }
    }
?>