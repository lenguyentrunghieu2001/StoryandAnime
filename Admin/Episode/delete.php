<?php
ob_start();
include '../../Database/Connect.php';

$id = $_GET['id'];
$sql = mysqli_query($con, "SELECT * FROM tbl_espisode WHERE id='$id' LIMIT 1");
while ($row = mysqli_fetch_array($sql)) {
    unlink('uploads/' . $row['video']);
}
$sql_delete_ = mysqli_query($con, "DELETE FROM tbl_espisode WHERE id = $id");
header('location:../page/episode.php?id_anime=' . $_GET['id_anime']);
die();
