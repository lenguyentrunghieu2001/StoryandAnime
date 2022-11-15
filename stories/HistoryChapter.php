<?php
include './ConnectDatabase.php';

include './inc/header.php';
include './inc/menu.php';
include './HomeStory/converTime.php';

?>
<style>
    .content .title-history {
        background-image: url('./../public/images/history.PNG');
        background-position: center center;
        background-repeat: no-repeat;
        height: 80px;
    }
</style>
<div class="content text-center" style="min-height: 400px;">
    <div class="container">
        <h1 class="title title-history"></h1>
        <div class="story">
            <?php
            $taikhoanuser = $_SESSION['loginuser'];
            $sql_history_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money',tbl_chapter.datechap AS 'datechap' ,tbl_chapter.idchap AS 'idchap'  FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id INNER JOIN tbl_history_chapter ON tbl_history_chapter.idchap = tbl_chapter.idchap WHERE tbl_history_chapter.taikhoanuser = '$taikhoanuser' ORDER BY tbl_history_chapter.id DESC");
            while ($row_chapter = mysqli_fetch_array($sql_history_chapter)) {
            ?>
                <div class="story-item">
                    <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" onclick="window.location.href='Chapter/handleHistoryChap.php?idchap=<?= $row_chapter['idchap'] ?>&taikhoanuser=<?= $taikhoanuser ?>&idtruyen=<?= $row_chapter['idtruyen'] ?>'" />
                    <span class="hover-content">
                        <?= $row_chapter['name'] ?>
                        <br />
                        <?= $row_chapter['summary'] ?>
                    </span>

                    <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                    <p>chap <?= $row_chapter['chap'] ?></p>
                    <p style="font-size: 13px; margin: 5px;padding:5px;border-radius: 5px; position:absolute; top:0; z-index: 3; background-color: orange; color:white">
                        <?php $datechap = $row_chapter['datechap'];
                        timeAgo($datechap) ?></p>

                    <i class="fa-solid fa-trash" onclick="window.location.replace('../stories/History/deletehistory.php?id=<?= $row_chapter['idtruyen'] ?>&acount=<?= $taikhoanuser ?>')" style="font-size: 15px; color:red; margin: 5px 0;">
                        <span style="font-family: Georgia, 'Times New Roman', Times, serif;">Xóa</span> </i>

                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
include './inc/footer.php';
?>