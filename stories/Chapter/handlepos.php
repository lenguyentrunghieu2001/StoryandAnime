<?php
ob_start();
include '../../Database/Connect.php';

$usernamepos = $_POST['usernamepos'];
$idchappos = $_POST['idchappos'];
$position = $_POST['position'];

$sql_position = mysqli_query($con, "SELECT * FROM tbl_position WHERE username = '$usernamepos' and idchap = '$idchappos'");
if (mysqli_num_rows($sql_position) > 0) {
    $sql_update = mysqli_query($con, "UPDATE tbl_position SET position='$position' WHERE username = '$usernamepos' and idchap = '$idchappos'");
} else {
    $sql_insert = mysqli_query($con, "INSERT INTO tbl_position(username, idchap, position) VALUES ('$usernamepos','$idchappos','$position')");
}
