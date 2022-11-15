<?php
ob_start();
include '../../Database/Connect.php';

if (isset($_GET['edit']) && $_GET['edit'] == 1) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $image = $_POST['image'];
    $datetime = $_POST['datetime'];
    $content = $_POST['contentnews'];
    $author = $_POST['author'];
    $sql_edit = mysqli_query($con, "UPDATE tbl_news SET id='$id',title='$title',content='$content',datetime='$datetime',image='$image',author='$author' WHERE id='$id'");
    header('location:../page/news.php');
    die();
}
if (isset($_GET['insert']) && $_GET['insert'] == 1) {
    $title = $_POST['title'];
    $image = $_POST['image'];
    $datetime = $_POST['datetime'];
    $content = $_POST['contentnews'];
    $sql_insert = mysqli_query($con, "INSERT INTO tbl_news (title,content,datetime,image,author) VALUES ('$title','$content','$datetime','$image','admin')");
    header('location:../page/news.php');
    die();
}
if (isset($_GET['xoa']) && $_GET['xoa'] == 1) {
    $id = $_GET['id'];
    $sql_delete = mysqli_query($con, "DELETE FROM tbl_news WHERE id='$id'");
    header('location:../page/news.php');
    die();
}
