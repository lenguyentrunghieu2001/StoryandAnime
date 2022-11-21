<?php
ob_start();
include '../../Database/Connect.php';

$id_anime = $_GET['id_anime'];

$sql_anime = mysqli_query($con, "SELECT * FROM tbl_anime where id_anime = '$id_anime'");
$row_anime = mysqli_fetch_array($sql_anime);
$view = $row_anime['view'] + 1;


$sql_update_view = mysqli_query($con, "UPDATE tbl_anime SET view='$view' WHERE id_anime = '$id_anime'");

header('location:../DetailAnime.php?id_anime=' . $id_anime);
die();
