<?php
session_start();
include '../../Database/Connect.php';
include '../HomeStory/converTime.php';


if (isset($_POST["action"])) {
    $query = "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money',tbl_chapter.datechap AS 'datechap',tbl_chapter.idchap AS 'idchap' FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id ";
    $query0 = $query1 = $query2 = $query3 = $query4 = $query5 = '';
    if (isset($_POST["money"])) {
        $money =  implode("','", $_POST["money"]);
        if ($money == '0') {
            $query0 .= " AND tbl_chapter.money = 0 ";
        } else {
            $query0 .= " AND tbl_chapter.money > $money ";
        }
        unset($_SESSION['querychapter']);
    }
    if (isset($_POST["sort"])) {
        $sort = implode("','", $_POST["sort"]);
        $query5 .= " ORDER BY $sort";
        unset($_SESSION['querychapter']);
    }
    if (isset($_POST["show"]) && $_POST["show"] == 'Show tất cả') {
        unset($_SESSION['querychapter']);
    }
    $query .=  ' WHERE 1 ' . $query0 . $query5;
    $output = '';
    if (!isset($_SESSION['querychapter'])) {
        $sql_chapter = mysqli_query($con, $query);
        $_SESSION['querychapter'] = $query;
    } else {
        $sql_chapter = mysqli_query($con, $_SESSION['querychapter']);
    }
    if (mysqli_num_rows($sql_chapter) > 0) {
        $i = 0;
        while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
            $taikhoanuser = $_SESSION['loginuser'];
            $sql_taikhoan = mysqli_query($con, "SELECT * FROM tbl_accountuser WhERE username='$taikhoanuser' LIMIT 1");
            $idchap = $row_chapter['idchap'];
            $id = $row_chapter['idtruyen'];
            $row_taikhoan = mysqli_fetch_array($sql_taikhoan);
            $sql_chapter_taikhoan = mysqli_query($con, "SELECT * FROM tbl_chapter_taikhoan WHERE idchap ='$idchap' AND taikhoanuser = '$taikhoanuser'");

            $i++;
            $datechap  =  $row_chapter['datechap'];
            if ($count = mysqli_num_rows($sql_chapter_taikhoan) > 0 || $row_chapter['money'] == 0) {
                $output .= '<div class="story-item" onclick="window.location.href=\'./Chapter/handleHistoryChap.php?idchap=' . $idchap . '&taikhoanuser=' . $taikhoanuser . '&idtruyen=' . $id . '\'">';
            } else {
                if ($row_taikhoan['money'] >= $row_chapter['money']) {
                    $output .= '
                    <div class="story-item"  onclick="if (confirm(\'Chap có giá ' . $row_chapter['money'] . ' và tài khoản hiện tại bạn đang còn ' . $row_taikhoan['money'] . ' đ\')) {return window.location.href=\'./DetailStory/lockKeyChapter.php?idchap=' . $row_chapter['idchap'] . '&taikhoanuser=' . $taikhoanuser . '&id=' . $id . '\' }"> ';
                } else {

                    $output .= '<div class="story-item" onclick="alert(\'tài khoản của bạn không đủ vui lòng nạp thêm\')">';
                }
            }
            $output .= '
                    <img src="../StoryTranslates/StoryTrans/uploads/' . $row_chapter['image'] . '" alt="" />
                    <span class="hover-content">
                     ' . $row_chapter['name'] . '
                      <br />
                      ' . $row_chapter['summary'] . '
                     </span>

                      <h3 class="text-dot">' . $row_chapter['name'] . '</h3>
                      <p>chap ' . $row_chapter['chap'] . '</p>
     
                 </div>';
        }
        echo $output;
    }
}
