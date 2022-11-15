<?php
include '../../Database/Connect.php';
ob_start();

$id = $_GET['id'];
$sql_delete_child = mysqli_query($con, "DELETE FROM tbl_story_category WHERE idcategory='$id'");
$sql_delete = mysqli_query($con, "DELETE FROM tbl_category WHERE idcategory='$id'");
header('location:../page/categorystory.php');
die();
