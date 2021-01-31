<?php
session_start();
if (!isset($_SESSION['id'])) {
  echo "<script>
    alert('UNAUTHORIZED ACCESS');
    window.location.replace('index.php');
</script>";
}else{
  $name = strtoupper($_SESSION['name']);
  $mobile_no = $_SESSION['id'];
}
?>
<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand pr-3" href="index.php"><?php echo $name?></a>
    <img src="images/pump.png" width="50" height="50">
    <ul class="navbar-nav mr-auto ml-5">
      <li <?php
          $res = $_SERVER['REQUEST_URI'] == '/jpetrolean/dashboard.php' ? 'nav-item active' : 'nav-item';
          echo "class= '$res'"
          // echo $_SERVER['REQUEST_URI'];
          ?>>
        <a class="nav-link" href="index.php">ADD BILL</a>
      </li>
      <li <?php
          $res = $_SERVER['PHP_SELF'] == '/jpetrolean/manage_customer_bill.php' ? 'class="nav-item active "' : 'class="nav-item"';
          echo " $res";
          ?>>
        <a class="nav-link" href="manage_customer_bill.php">MANAGE BILL</a>
      </li>
      <li <?php
          $res = $_SERVER['PHP_SELF'] == '/jpetrolean/add_customer.php' ? 'class="nav-item active "' : 'class="nav-item"';
          echo " $res";
          ?> style="border-right: 2px solid #fff">
        <a class="nav-link" href="add_customer.php">ADD CUSTOMER</a>
      </li>
      <li <?php
          $res = $_SERVER['PHP_SELF'] == '/jpetrolean/manage_workers_acc.php' ? 'class="nav-item active "' : 'class="nav-item"';
          echo " $res";
          ?>>
        <a class="nav-link" href="manage_workers_acc.php">MANAGE WORKERS ACCOUNT</a>
      </li>
      <li <?php
          $res = $_SERVER['PHP_SELF'] == '/jpetrolean/working_time.php' ? 'class="nav-item active "' : 'class="nav-item"';
          echo " $res";
          ?>>
        <a class="nav-link" href="working_time.php">MANAGE WORKING TIME</a>
      </li>
      <li <?php
          $res = $_SERVER['PHP_SELF'] == '/jpetrolean/add_workers.php' ? 'class="nav-item active "' : 'class="nav-item"';
          echo " $res";
          ?> style="border-right: 2px solid #fff">
        <a class="nav-link" href="add_workers.php">ADD WORKERS</a>
      </li>
      <li>
        <a class="nav-link" href="php/logout.php">LOGOUT</a>
      </li>
    </ul>
  </nav>
</body>

</html>