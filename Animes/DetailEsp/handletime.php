<?php
ob_start();
include '../../Database/Connect.php';

$usernamepos = $_POST['usernamepos'];
$id_esp = $_POST['id_esp'];
$time = $_POST['time'];
$sql_position = mysqli_query($con, "SELECT * FROM tbl_position_esp WHERE username = '$usernamepos' and id_esp = '$id_esp'");
if (mysqli_num_rows($sql_position) > 0) {
    $sql_update = mysqli_query($con, "UPDATE tbl_position_esp SET time='$time' WHERE username = '$usernamepos' and id_esp = '$id_esp'");
} else {
    $sql_insert = mysqli_query($con, "INSERT INTO tbl_position_esp(username, time, id_esp) VALUES ('$usernamepos','$time','$id_esp')");
}
