<?php
ob_start();
include '../../Database/Connect.php';



if (isset($_GET['xuly'])) {
    if ($_GET['xuly'] == 0) {
        $id = $_GET['id'];
        $acount = $_GET['acount'];
        $delete_follow_story = mysqli_query($con, "DELETE FROM tbl_follow WHERE taikhoanuser ='$acount' AND idtruyen='$id'");
        header("location: ../DetailStory.php?id=$id");
        die();
    }
} else {
    $id = $_GET['id'];
    $acount = $_GET['acount'];
    $insert_follow_story = mysqli_query($con, "INSERT INTO tbl_follow(taikhoanuser, idtruyen) VALUES ('$acount', '$id')");
    header("location: ../DetailStory.php?id=$id");
    die();
}
