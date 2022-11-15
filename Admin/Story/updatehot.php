<?php
ob_start();
include '../../Database/Connect.php';

$sql_update_all = mysqli_query($con, "UPDATE tbl_story SET hot=0");

$sql_update = mysqli_query($con, "UPDATE tbl_story SET hot=1 ORDER BY view DESC LIMIT 14");
header('location:../page/story.php');
die();
