<?php
ob_start();
include '../../Database/Connect.php';

$idchap = $_GET['idchap'];
$taikhoanuser = $_GET['taikhoanuser'];
$idtruyen = $_GET['idtruyen'];


$sql_exam_history = mysqli_query($con, "SELECT * FROM tbl_history_chapter WHERE idtruyen='$idtruyen' AND taikhoanuser='$taikhoanuser' LIMIT 1");

if ($count = mysqli_num_rows($sql_exam_history) > 0) {
    $sql_delete_history = mysqli_query($con, "DELETE FROM tbl_history_chapter WHERE idtruyen='$idtruyen' AND taikhoanuser='$taikhoanuser'");
    $sql_insert_history = mysqli_query($con, "INSERT INTO tbl_history_chapter(idchap,idtruyen, taikhoanuser) VALUES ('$idchap', '$idtruyen', '$taikhoanuser')");
    header("Location:../ChapterStory.php?idchap=$idchap&idtruyen=$idtruyen");
    die();
} else {
    $sql_insert_history = mysqli_query($con, "INSERT INTO tbl_history_chapter(idchap,idtruyen, taikhoanuser) VALUES ('$idchap', '$idtruyen', '$taikhoanuser')");
    header("Location:../ChapterStory.php?idchap=$idchap&idtruyen=$idtruyen");
    die();
}
