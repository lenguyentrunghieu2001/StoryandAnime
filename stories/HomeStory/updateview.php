<?php
ob_start();
include '../../Database/Connect.php';
$id = $_GET['id'];

$sql = "SELECT * FROM tbl_story WHERE id=$id";

$result = mysqli_query($con, $sql);

$row = mysqli_fetch_assoc($result);

$view = $row['view'] + 1;


$update_sql = "UPDATE tbl_story SET view='$view' where id =$id";
if (mysqli_query($con, $update_sql)) {
    header('location: ./../DetailStory.php?id=' . $row['id']);
    die();
}
