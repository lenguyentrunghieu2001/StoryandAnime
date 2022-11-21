

<?php
// ob_start();
include '../../Database/Connect.php';

if (isset($_POST['comment'])) {
    $id_anime = $_POST['id_anime'];
    $username = $_POST['username'];
    $comment = $_POST['comment'];

    $sql_insert_comment = mysqli_query($con, "INSERT INTO tbl_comment_anime(username, datetime, id_anime, content) VALUES ('$username',NOW(),'$id_anime','$comment')");

    if ($sql_insert_comment) {
        echo 1;
    } else {
        echo 0;
    }
}


$output = "";
$id_anime = $_GET['id_anime'];
$sql_select_comment = mysqli_query($con, "SELECT * FROM tbl_comment_anime WHERE id_anime='$id_anime' ORDER BY id DESC");



while ($row = mysqli_fetch_array($sql_select_comment)) {
    $username_acount = $row['username'];
    $sql_select_user = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username='$username_acount' LIMIT 1");
    $rowuser = mysqli_fetch_array($sql_select_user);
    $output .= '<div class="comment_child">
<img class="rounded-circle shadow-1-strong me-3" src="./../public/images/user.gif" alt="avatar" />
<div class="comment_info">
    <div class="comment_name">
        <span>' . $rowuser['name'] . '</span> <span>CẤP ' . $rowuser['level'] . '</span>
    </div>
    <div class="comment_time">' .  $row['datetime'] . '</div>
    <div class="comment_content">' . $row['content'] . '</div>
</div>
</div>';
}
echo $output;
