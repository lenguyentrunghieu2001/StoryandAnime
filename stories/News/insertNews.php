<?php
ob_start();
include '../../Database/Connect.php';
$title = $_POST['title'];
$image = $_POST['image'];
$datetime = $_POST['datetime'];
$content = $_POST['contentnewsstory'];
$author = $_POST['author'];
$sql_insert = mysqli_query($con, "INSERT INTO tbl_news (title,content,datetime,image,author) VALUES ('$title','$content','$datetime','$image','$author')");
header('location:../NewsStory.php');
die();
