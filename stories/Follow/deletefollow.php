<?php
ob_start();
include '../../Database/Connect.php';


$id = $_GET['id'];
$acount = $_GET['acount'];
$delete_follow_story = mysqli_query($con, "DELETE FROM tbl_follow WHERE taikhoanuser ='$acount' AND idtruyen='$id'");
header("location: ../Follow.php");
die();
