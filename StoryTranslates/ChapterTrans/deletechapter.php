<?php
ob_start();
include '../../Database/Connect.php';


$idchap = $_GET['idchap'];
$idtruyen = $_GET['idtruyen'];
$sql_delete_chapter_taikhoan = mysqli_query($con, "DELETE FROM tbl_chapter_taikhoan WHERE idchap='$idchap'");
$sql_delete_history_chapter = mysqli_query($con, "DELETE FROM tbl_history_chapter WHERE idchap='$idchap'");
$sql_delete = mysqli_query($con, "DELETE FROM tbl_chapter WHERE idchap='$idchap'");



header('location: ../page/chaptertrans.php?idtruyen=' . $idtruyen);
die();
