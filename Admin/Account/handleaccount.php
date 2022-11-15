<?php
include '../../Database/Connect.php';
ob_start();
if (isset($_GET['all']) && $_GET['all'] == 1) {
    $sql_edit = mysqli_query($con, "UPDATE translate SET lockaccount=1 WHERE lockaccount=0");
    header('location:../page/account.php');
    die();
}
if (isset($_GET['lock']) && $_GET['lock'] == 0) {
    $usernametrans = $_GET['usernametrans'];
    $sql_edit_lock = mysqli_query($con, "UPDATE translate SET lockaccount=1 WHERE usernametrans='$usernametrans'");
    header('location:../page/account.php');
    die();
}
if (isset($_GET['lock']) && $_GET['lock'] == 1) {
    $usernametrans = $_GET['usernametrans'];
    $sql_edit_lock = mysqli_query($con, "UPDATE translate SET lockaccount=2 WHERE usernametrans='$usernametrans'");
    header('location:../page/account.php');
    die();
}

if (isset($_GET['lock']) && $_GET['lock'] == 2) {
    $usernametrans = $_GET['usernametrans'];
    $sql_edit_lock = mysqli_query($con, "UPDATE translate SET lockaccount=1 WHERE usernametrans='$usernametrans'");
    header('location:../page/account.php');
    die();
}
