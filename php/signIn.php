<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $con = mysqli_connect("localhost", "root", "", "jagdish petroleum");

        $mobileNo = mysqli_real_escape_string($con, $_POST['mobileNo']);
        $pass = md5(mysqli_real_escape_string($con, $_POST['pass']));

        $query = "select * from `petrol_pump` where `mobileNo` = $mobileNo && `password` = '$pass'";
        $res = mysqli_query($con, $query) or die(mysqli_error($con));

        if(mysqli_num_rows($res) == 1){
            $data = mysqli_fetch_array($res);
            session_start();
            $_SESSION['id'] = $data[0];
            $_SESSION['name'] = $data[1];
            echo "<script>
                    alert('WELCOME TO THE DASHBOARD');
                    window.location.replace('../dashboard.php');
                </script>";
        }else{
            echo "<script>
                    alert('YOUR MOBILE NO. OR PASSWORD INVALID');
                    window.location.replace('../index.php');
                </script>";
        }
    }
?>