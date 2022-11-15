<?php
session_start();
include '../../Database/Connect.php';

if (isset($_POST['chat'])) {
    $username = $_POST['username'];
    $chat = $_POST['chat'];
    $sql_insert_chat = mysqli_query($con, "INSERT INTO tbl_chat(username, datetime, content) VALUES ('$username',NOW(),'$chat')");
    if ($sql_insert_chat) {
        echo 1;
    } else {
        echo 0;
    }
}


$output = "";
$sql_select_comment = mysqli_query($con, "SELECT * FROM tbl_chat ORDER BY id DESC");



while ($row = mysqli_fetch_array($sql_select_comment)) {
    $username_acount = $row['username'];
    $sql_select_user = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username='$username_acount' LIMIT 1");
    $rowuser = mysqli_fetch_array($sql_select_user);
    if ($row['username'] ==  $_SESSION['loginuser']) {
        $output .= ' 
        <div class="comment_child_you">
        <div class="comment_info_chat">
            <div class="comment_name">
                <span class="span1">' . $rowuser['name'] . '</span> <span class="span2">CẤP ' . $rowuser['level'] . '</span>
            </div>
            <div class="comment_content">' . $row['content'] . '</div>
            <div class="comment_time">' .  $row['datetime'] . '</div>

        </div>
        <img class="rounded-circle shadow-1-strong me-3" src="../public/images/user.gif" alt="avatar" />
    </div>';
    } else {
        $output .= ' 
        <div class="comment_child_chat">
        <img class="rounded-circle shadow-1-strong me-3" src="../public/images/user.gif" alt="avatar" />
        <div class="comment_info_chat">
            <div class="comment_name">
                <span class="span2">CẤP ' . $rowuser['level'] . '</span> <span class="span1">' . $rowuser['name'] . '</span>
            </div>
            <div class="comment_content">' . $row['content'] . '</div>
            <div class="comment_time">' .  $row['datetime'] . '</div>

        </div>
    </div>';
    }
}
echo $output;
