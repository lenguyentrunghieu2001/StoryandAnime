<?php
ob_start();
session_start();
include '../../Database/Connect.php';

$taikhoanuser = $_SESSION['loginuser'];
if (empty($_GET['payType'])) {
    header('location: ../loadingmoney.php');
    die();
} else {
    $sql_taikhoan = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username='$taikhoanuser'");
    $row_taikhoan = mysqli_fetch_array($sql_taikhoan);
    $amount = $_GET['amount'];
    if ($amount >= 9000 && $amount < 20000) {
        $updatemoney = $row_taikhoan['money'] + $amount + 1000;
        $summoney = $row_taikhoan['summoney'] + $amount;
    } else if ($amount >= 19000 && $amount < 50000) {
        $updatemoney = $row_taikhoan['money'] + $amount + 2500;
        $summoney = $row_taikhoan['summoney'] + $amount;
    } else if ($amount >= 49000 && $amount < 100000) {
        $updatemoney = $row_taikhoan['money'] + $amount + 7000;
        $summoney = $row_taikhoan['summoney'] + $amount;
    } else if ($amount >= 99000 && $amount < 200000) {
        $updatemoney = $row_taikhoan['money'] + $amount + 12000;
        $summoney = $row_taikhoan['summoney'] + $amount;
    } else {
        $updatemoney = $row_taikhoan['money'] + $amount + 26000;
        $summoney = $row_taikhoan['summoney'] + $amount;
    }

    if ($summoney >= 0 && $summoney <= 10000) {
        $level = 1;
    } else if ($summoney <= 50000) {
        $level = 2;
    } else if ($summoney <= 100000) {
        $level = 3;
    } else if ($summoney <= 200000) {
        $level = 4;
    } else if ($summoney <= 500000) {
        $level = 5;
    } elseif ($summoney <= 1000000) {
        $level = 6;
    } else {
        $level = 7;
    }

    $sql_insert_money_taikhoan = mysqli_query($con, "UPDATE tbl_accountuser SET money='$updatemoney',summoney='$summoney',level='$level' WHERE username='$taikhoanuser'");
    $partnerCode = $_GET['partnerCode'];
    $orderId = $_GET['orderId'];
    $requestId = $_GET['requestId'];
    $orderInfo = $_GET['orderInfo'];
    $orderType = $_GET['orderType'];
    $payType = $_GET['payType'];
    $responseTime = $_GET['responseTime'];
    $sql_insert_momo = mysqli_query($con, "INSERT INTO tbl_momo(partnerCode, orderId, requestId, amount, orderInfo, orderType, payType, responseTime, username,date) VALUES ('$partnerCode','$orderId','$requestId','$amount','$orderInfo','$orderType','$payType','$responseTime','$taikhoanuser',NOW())");
    header('location: ../loadingmoney.php');
    die();
}
?>
<!-- 
   partnerCode=MOMOBKUN20180529&
   orderId=1663425479&
   requestId=1663425479&
   amount=10000&
   orderInfo=Thanh+toán+qua+MoMo&
   orderType=momo_wallet&transId=2727611233&
   payType=qr&
   responseTime=1663425498827&
  
 -->