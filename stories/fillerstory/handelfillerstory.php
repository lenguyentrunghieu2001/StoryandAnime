<?php
session_start();
include '../../Database/Connect.php';

if (isset($_POST["action"])) {
    $query = "SELECT * FROM tbl_story ";
    $query0 = $query1 = $query2 = $query3 = $query4 = $query5 = '';
    if (isset($_POST["sort"])) {
        $sort = implode("','", $_POST["sort"]);
        $query5 .= " ORDER BY $sort";
        unset($_SESSION['query']);
    }
    if (isset($_POST["status"])) {
        $status =  implode("','", $_POST["status"]);
        $query1 .= "AND status ='$status' ";
        unset($_SESSION['query']);
    }
    if (isset($_POST["hot"])) {
        $hot = implode("','", $_POST["hot"]);
        $query2 .= "AND  hot = '$hot'";
        unset($_SESSION['query']);
    }
    if (isset($_POST["usernametrans"])) {
        $usernametrans = implode("','", $_POST["usernametrans"]);
        $query3 .= "AND  usernametrans IN('" . $usernametrans . "') ";
        unset($_SESSION['query']);
    }
    if (isset($_POST["category"])) {
        $category = implode("','", $_POST["category"]);
        $query0 .= "INNER JOIN tbl_story_category ON tbl_story_category.idtruyen = tbl_story.id";
        $query4 .= "AND  idcategory IN('" . $category . "') ";
        unset($_SESSION['query']);
    }

    if (isset($_POST["show"]) && $_POST["show"] == 'Show tất cả') {
        unset($_SESSION['query']);
    }

    $query .=  $query0 . ' WHERE 1 ' .  $query4 . $query1 . $query2 . $query3 . $query5;

    $output = '';
    if (!isset($_SESSION['query'])) {
        $sql_query = mysqli_query($con, $query);
        $_SESSION['query'] = $query;
    } else {
        $sql_query = mysqli_query($con,  $_SESSION['query']);
    }


    if (mysqli_num_rows($sql_query) > 0) {
        $i = 0;
        while ($row_story = mysqli_fetch_array($sql_query)) {
            $i++;
            $output .= '<div class="story-item" onclick="window.location.href=\'../stories/HomeStory/updateview.php?id=' . $row_story['id'] . '\'">

            <img src="../StoryTranslates/StoryTrans/uploads/' . $row_story['image'] . '" alt="" />
            <span class="hover-content">
                ' . $row_story['name'] . '
                <br />
                ' . $row_story['summary'] . '</span></span>
           ';
            if ($row_story['hot'] == '1') {
                $output .= '<div class="story-hot">Hot</div>';
            }
            $output .= '
            <div class="story-item-info" style="bottom:32px">
                <p><i class="fa-solid fa-eye"></i>' . $row_story['view'] . '</p>
                <p><i class="fa-solid fa-thumbs-up"></i>
                    ';
            $id = $row_story['id'];
            $sql_like = mysqli_query($con, "SELECT * FROM tbl_like WHERE idtruyen='$id' GROUP BY id");
            $count_like = mysqli_num_rows($sql_like);

            $output .= ' ' . $count_like . '
                </p>
            </div>
            <h3 class="text-dot"> ' . $row_story['name'] . '</h3>
            
        </div>';
        }
        echo $output;
    } else {
        $output = '<h3>Không có dữ liệu</h3>';
    }
}
