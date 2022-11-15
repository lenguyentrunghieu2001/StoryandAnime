<?php
ob_start();
include '../../Database/Connect.php';

$idchap = $_GET['idchap'];
$taikhoanuser = $_GET['taikhoanuser'];
$id = $_GET['id'];

$sql_chapter = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE idchap='$idchap' LIMIT 1");
$row_chap = mysqli_fetch_array($sql_chapter);

$sql_insert = mysqli_query($con, "INSERT INTO tbl_chapter_taikhoan(idchap,taikhoanuser) VALUES('$idchap','$taikhoanuser')");

$sql_translate = mysqli_query($con, "SELECT * FROM tbl_story WHERE id='$id' LIMIT 1");
$row_translate = mysqli_fetch_array($sql_translate);
$usernametrans = $row_translate['usernametrans'];
$money_trans = $row_chap['money'];
$insert_translatemoney = mysqli_query($con, "INSERT INTO tbl_moneytranslate(uernametrans,money,datetime) VALUES('$usernametrans','$money_trans',now())");



$sql_select_acount = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username='$taikhoanuser' LIMIT 1");
$row = mysqli_fetch_array($sql_select_acount);

$money = $row['money'] - $row_chap['money'];

$sql_update_money = mysqli_query($con, "UPDATE tbl_accountuser SET money='$money' where username ='$taikhoanuser'");

header("Location: ../Chapter/handleHistoryChap.php?idchap=$idchap&taikhoanuser=$taikhoanuser&idtruyen=$id");
die();
