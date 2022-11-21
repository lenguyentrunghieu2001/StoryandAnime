<?php
ob_start();
include '../../Database/Connect.php';

$sql_update_hot = mysqli_query($con, "UPDATE tbl_anime SET hot=0");

$sql_update = mysqli_query($con, "UPDATE tbl_anime SET hot=1 ORDER BY view DESC LIMIT 20");
header('location:../page/anime.php');
die();
