<?php
ob_start();
session_start();
include '../../Database/Connect.php';

$username = $_SESSION['loginuser'];
$sql_money = mysqli_query($con, "Select * from tbl_accountuser where username = '$username' ");
$row_money = mysqli_fetch_array($sql_money);
if (isset($_GET['value']) && $_GET['value'] == 1) {
    $sql_insert_value1 = mysqli_query($con, "INSERT INTO tbl_account_anime( username, value, date) VALUES ('$username',1,NOW())");
    $money1month = $row_money['money'] - 20000;
    $sql_update_money = mysqli_query($con, "UPDATE tbl_accountuser SET money='$money1month' WHERE username = '$username' ");
}
if (isset($_GET['value']) && $_GET['value'] == 2) {
    $sql_insert_value2 = mysqli_query($con, "INSERT INTO tbl_account_anime( username, value, date) VALUES ('$username',2,NOW())");
    $money6month = $row_money['money'] - 100000;
    $sql_update_money = mysqli_query($con, "UPDATE tbl_accountuser SET money='$money6month' WHERE username = '$username' ");
}
if (isset($_GET['value']) && $_GET['value'] == 3) {
    $sql_insert_value3 = mysqli_query($con, "INSERT INTO tbl_account_anime( username, value, date) VALUES ('$username',3,NOW())");
    $money1year = $row_money['money'] - 200000;
    $sql_update_money = mysqli_query($con, "UPDATE tbl_accountuser SET money='$money1year' WHERE username = '$username' ");
}

header('location:../../Animes/HomeAnime.php');
die();
