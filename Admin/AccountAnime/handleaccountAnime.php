<?php
ob_start();
session_start();
include '../../Database/Connect.php';


if (isset($_GET['xoa']) && $_GET['xoa'] == 1) {
    $sql_delete_package = mysqli_query($con, "DELETE FROM tbl_account_anime WHERE value = 1 and date < DATE_SUB(NOW(), INTERVAL 1 MONTH)");
}
if (isset($_GET['xoa']) && $_GET['xoa'] == 2) {
    $sql_delete_package = mysqli_query($con, "DELETE FROM tbl_account_anime WHERE value = 2 and date < DATE_SUB(NOW(), INTERVAL 6 MONTH)");
}
if (isset($_GET['xoa']) && $_GET['xoa'] == 3) {
    $sql_delete_package = mysqli_query($con, "DELETE FROM tbl_account_anime WHERE value = 3 and date < DATE_SUB(NOW(), INTERVAL 1 YEAR)");
}
header('location:../page/animeaccount.php');
die();
