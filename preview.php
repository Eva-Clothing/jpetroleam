<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    session_start();
    if (!isset($_SESSION['id'])) {
    echo "<script>
        alert('UNAUTHORIZED ACCESS');
        window.location.replace('index.php');
    </script>";
    }
    $qu = 'select * from `transaction`,`transaction_detail`';
    if ($_GET['cust'] <> '') {
        $adminId =  $_GET['adminId'];
        $cust = $_GET['cust'];
        $qu .= "where `transaction`.`adminId` = $adminId and `transaction`.`id` = `transaction_detail`.`transaction_id` and `transaction`.`c_name` = '$cust'";
        if ($_GET['from'] <> '' && $_GET['to'] <> '') {
            $from =  $_GET['from'];
            $to =  $_GET['to'];
            $qu .= "and `transaction`.`date` between '$from' and '$to'";
        }
    }

    $count = 0;
    $debit = 0;
    $credit = 0;
    $con = mysqli_connect("localhost", "root", "", "jagdish petroleum");
    $res = mysqli_query($con, $qu) or die(mysqli_error($con));
    echo '<center><form> 
            <input type="button" onclick="window.print()" value="PRINT STATEMENT"/> 
        </form>';
    echo "<h2>DEBIT</h2>";
    echo "
            <table border='1' cellspacing='0' cellpadding = '5'>
                <tr align='center'>
                    <td>#</td>
                    <td>CUSTOMER NAME</td>
                    <td>DATE</td>
                    <td>PRODUCT</td>
                    <td>CURRENT RATE</td>
                    <td>QUNTITY</td>
                    <td>TOTAL</td>
                    <td>VEHICLE NO</td>
                </tr>
        ";
    while ($data = mysqli_fetch_array($res)) {
        $debit += $data[4];
        $count++;
        echo "
            <tr align='center'>
                <td>$count</th>
                <td>$data[1]</td>
                <td>$data[2]</td>
                <td>$data[8]</td>
                <td>$data[9]</td>
                <td>$data[10]</td> 
                <td>$data[4]</td>
                <td>$data[11]</td> 
            </tr>
            ";
    }

    echo "</table>";

    if ($_GET['from'] <> '' && $_GET['to'] <> '')
        $qu = "select * from `transaction` where `adminId` = $adminId and `c_name` = '$cust' and `date` between '$from' and '$to' and `payment_type` = 'CREDIT'";
    else
        $qu = "select * from `transaction` where `adminId` = $adminId and `c_name` = '$cust' and `payment_type` = 'CREDIT'";
    $res = mysqli_query($con, $qu) or die(mysqli_error($con));
    $count = 0;

    echo "<h2>CREDIT</h2>";
    echo "
            <table border='1' cellspacing='0' cellpadding = '5'>
                <tr align='center'>
                    <td>#</td>
                    <td>CUSTOMER NAME</td>
                    <td>DATE</td>
                    <td>CREDIT AMOUNT</td>
                </tr>
        ";
    while ($data = mysqli_fetch_array($res)) {
        $credit += $data[4];
        $count++;
        echo "
                <tr align='center'>
                    <td>$count</th>
                    <td>$data[1]</td>
                    <td>$data[2]</td>
                    <td>$data[4]</td>
                </tr>
                ";
    }

    echo "</table>";

    echo '<h2>FINAL TOTAL(DEBIT) : '.($debit - $credit).'</h2>'; 
}
