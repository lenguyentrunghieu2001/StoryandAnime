<?php
ob_start();
session_start();
include '../../Database/Connect.php';

if (empty($_GET['vnp_BankTranNo'])) {
    header('location: ../loadingmoney.php');
    die();
} else {
    $taikhoanuser = $_SESSION['loginuser'];

    $sql_taikhoan = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username='$taikhoanuser'");

    $row_taikhoan = mysqli_fetch_array($sql_taikhoan);
    $vnp_amount = $_GET['vnp_Amount'] / 100;
    if ($vnp_amount >= 9000 && $vnp_amount < 20000) {
        $updatemoney = $row_taikhoan['money'] + $vnp_amount + 1000;
        $summoney = $row_taikhoan['summoney'] + $vnp_amount;
    } else if ($vnp_amount >= 19000 && $vnp_amount < 50000) {
        $updatemoney = $row_taikhoan['money'] + $vnp_amount + 2500;
        $summoney = $row_taikhoan['summoney'] + $vnp_amount;
    } else if ($vnp_amount >= 49000 && $vnp_amount < 100000) {
        $updatemoney = $row_taikhoan['money'] + $vnp_amount + 7000;
        $summoney = $row_taikhoan['summoney'] + $vnp_amount;
    } else if ($vnp_amount >= 99000 && $vnp_amount < 200000) {
        $updatemoney = $row_taikhoan['money'] + $vnp_amount + 12000;
        $summoney = $row_taikhoan['summoney'] + $vnp_amount;
    } else {
        $updatemoney = $row_taikhoan['money'] + $vnp_amount + 26000;
        $summoney = $row_taikhoan['summoney'] + $vnp_amount;
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
    $vnp_BankCode = $_GET['vnp_BankCode'];
    $vnp_BankTranNo = $_GET['vnp_BankTranNo'];
    $vnp_CardType = $_GET['vnp_CardType'];
    $vnp_OrderInfo = $_GET['vnp_OrderInfo'];
    $vnp_PayDate = $_GET['vnp_PayDate'];
    $sql_insert_vnpay = mysqli_query($con, "INSERT INTO tbl_vnpay(vnp_Amount, vnp_BankCode, vnp_BankTranNo, vnp_CardType, vnp_OrderInfo, vnp_PayDate, username,date) VALUES ('$vnp_amount','$vnp_BankCode','$vnp_BankTranNo','$vnp_CardType','$vnp_OrderInfo','$vnp_PayDate','$taikhoanuser',NOW())");
    header('location: ../loadingmoney.php');
    die();
}
?>
<!-- 
    vnp_Amount=1000000
    vnp_BankCode=NCB
    vnp_BankTranNo=VNP13837041
    vnp_CardType=ATM
    vnp_OrderInfo=thanh+toán+đơn+hàng+vnpay
    vnp_PayDate=20220917194157
 -->