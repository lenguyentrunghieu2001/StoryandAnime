<?php

include '../../Database/Connect.php';
if (isset($_POST['query'])) {
    $output = '';

    $query = mysqli_query($con, "SELECT * FROM tbl_story WHERE name LIKE '%" . trim($_POST['query']) . "%'");
    while ($row = mysqli_fetch_array($query)) {
        $output .= '<li class="list-group-item contsearch" style="width:400px;display: flex;" onclick="window.location.href=\'../../../StoryAndAnime/stories/HomeStory/updateview.php?id=' . $row['id'] . '\'">
        <img src="./../StoryTranslates/StoryTrans/uploads/' . $row['image'] . '" style="height:40px;width:40px; margin-right:10px;"/>
        <a href="javascript:void()" class="gsearch" style="color:black;">' . $row['name'] . ' </a>
        </li>';
    }


    echo $output;
}
