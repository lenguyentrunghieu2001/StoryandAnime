<?php
ob_start();
include '../../Database/Connect.php';

$idtruyen = $_GET['id'];
$username = $_GET['username'];
$star = $_GET['star'];

$sql_exam_star_history = mysqli_query($con, "SELECT * FROM tbl_star_story WHERE username='$username' AND idtruyen='$idtruyen'");
if ($count = mysqli_num_rows($sql_exam_star_history) > 0) {
    $sql_update = mysqli_query($con, "UPDATE tbl_star_story SET star='$star' WHERE idtruyen='$idtruyen' AND username='$username'");
    header("location: ../DetailStory.php?id=$idtruyen");
    die();
} else {
    $sql_insert = mysqli_query($con, "INSERT INTO tbl_star_story(username, idtruyen, star) VALUES ('$username','$idtruyen','$star')");
    header("location: ../DetailStory.php?id=$idtruyen");
    die();
}
