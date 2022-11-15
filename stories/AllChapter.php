<?php

include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';
include './HomeStory/converTime.php';

?>
<style>
    .content .btn {
        border-radius: 50% !important;
    }
</style>
<div class="content text-center">
    <div class="container">
        <h1 class="title">TẤT CẢ CÁC CHAPTER MỚI CẬP NHẬT</h1>
        <div class="story">
            <?php
            $taikhoanuser = $_SESSION['loginuser'];

            $sql_chapter_count = mysqli_query($con, "SELECT * FROM tbl_chapter ORDER BY idchap");
            $count = mysqli_num_rows($sql_chapter_count);

            $avgcount = ROUND($count / 12);
            $page = $_GET['page'];
            $startpage = ($page - 1) * 12;

            $sql_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money',tbl_chapter.datechap AS 'datechap',tbl_chapter.idchap AS 'idchap' FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id ORDER BY datechap DESC LIMIT $startpage,12");
            $i = 0;
            while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
                $i++;
                $sql_taikhoan = mysqli_query($con, "SELECT * FROM tbl_accountuser WhERE username='$taikhoanuser' LIMIT 1");
                $idchap = $row_chapter['idchap'];
                $id = $row_chapter['idtruyen'];
                $row_taikhoan = mysqli_fetch_array($sql_taikhoan);
                $sql_chapter_taikhoan = mysqli_query($con, "SELECT * FROM tbl_chapter_taikhoan WHERE idchap ='$idchap' AND taikhoanuser = '$taikhoanuser'");
                if ($count = mysqli_num_rows($sql_chapter_taikhoan) > 0 || $row_chapter['money'] == 0) {
            ?>
                    <div class="story-item" onclick="window.location.href='./Chapter/handleHistoryChap.php?idchap=<?= $idchap ?>&taikhoanuser=<?= $taikhoanuser ?>&idtruyen=<?= $id ?>'">
                        <?php
                    } else {
                        if ($row_taikhoan['money'] >= $row_chapter['money']) {
                        ?>
                            <div class="story-item" data-toggle="modal" data-target="#exampleModal<?= $i ?>">
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Mua chapter</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Chap có giá <?= $row_chapter['money'] ?> và tài khoản hiện tại bạn đang còn <?= $row_taikhoan['money'] ?>đ
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                                <button type="button" class="btn btn-primary" onclick="window.location.href='./DetailStory/lockKeyChapter.php?idchap=<?= $idchap ?>&taikhoanuser=<?= $taikhoanuser ?>&id=<?= $id ?>'">Mua</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                        } else {
                            ?>
                                <div class="story-item" onclick="alert('tài khoản của bạn không đủ vui lòng nạp thêm')">

                            <?php
                        }
                    }

                            ?>

                            <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" />
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
                                </div>
                            <?php
                        }
                            ?>
                            </div>
                            <div style="display: flex; justify-content: center; align-items: center;">
                                <!-- prev -->
                                <?php $pageprev = $_GET['page'] - 1;
                                if ($pageprev < 1) {
                                ?>
                                    <button class="btn" style="background: gray;">&laquo;</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn" style="background: #3785c9;" onclick="window.location.href='AllChapter.php?page=<?= $pageprev ?>'">&laquo;</button>
                                <?php
                                }
                                ?>
                                <!-- for -->
                                <?php for ($k = 1; $k <= $avgcount; $k++) {
                                    if ($k == $_GET['page']) {            ?>
                                        <button style="margin: 20px 3px; border: 1px solid;background: #3785c9;" class="btn" onclick="window.location.href='AllChapter.php?page=<?= $k ?>'"><?= $k ?></button>
                                    <?php } else {
                                    ?>
                                        <button style="margin: 20px 3px; border: 1px solid" class="btn" onclick="window.location.href='AllChapter.php?page=<?= $k ?>'"><?= $k ?></button>
                                <?php
                                    }
                                } ?>
                                <!-- next -->
                                <?php $pageprev = $_GET['page'] + 1;
                                if ($pageprev > $avgcount) {
                                ?>
                                    <button class="btn" style="background: gray;">&raquo;</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn" style="background: #3785c9;" onclick="window.location.href='AllChapter.php?page=<?= $pageprev ?>'">&raquo;</button>
                                <?php
                                }
                                ?>
                            </div>
                    </div>
        </div>
    </div>
</div>

<?php
include './inc/footer.php';
?>