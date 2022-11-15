<?php
ob_start();
session_start();
include '../../Database/Connect.php';
$username = $_SESSION['loginuser'];
$valueLuck = $_GET['value'];
$sql_check = mysqli_query($con, "SELECT * FROM tbl_lucky WHERE username='$username'");

if (mysqli_num_rows($sql_check) > 0) {
    $sql_update = mysqli_query($con, "UPDATE tbl_lucky SET datetime=NOW() WHERE username='$username'");
} else {
    $sql_insert = mysqli_query($con, "INSERT INTO tbl_lucky(username, datetime) VALUES ('$username',NOW())");
}

$sql_taikhoan = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username='$username' LIMIT 1");
$row_taikhoan = mysqli_fetch_array($sql_taikhoan);
$updatemoney = $row_taikhoan['money'] + $valueLuck;
$sql_insert_money_taikhoan = mysqli_query($con, "UPDATE tbl_accountuser SET money='$updatemoney' WHERE username='$username'");
$_SESSION['hat'] =  $valueLuck;
// echo $valueLuck;
header('location: ../lucky.php');
die();
