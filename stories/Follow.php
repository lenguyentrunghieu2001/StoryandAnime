<?php
include './ConnectDatabase.php';

include './inc/header.php';
include './inc/menu.php';

?>
<style>
    .content .title-follow {
        background-image: url('./../public/images/bg-bookmark.png');
        background-position: center center;
        background-repeat: no-repeat;
        color: black;
    }
</style>
<div class="content text-center" style="min-height: 400px;">
    <div class="container">
        <h1 class="title title-follow">trang Theo dõi truyện</h1>
        <div class="story">
            <?php
            $acount_follow =  $_SESSION['loginuser'];
            $i = 0;
            $sql_follow = mysqli_query($con, "SELECT tbl_story.* FROM tbl_story INNER JOIN tbl_follow ON tbl_follow.idtruyen = tbl_story.id INNER JOIN tbl_accountuser ON tbl_accountuser.username = tbl_follow.taikhoanuser WHERE  tbl_follow.taikhoanuser='$acount_follow'  ORDER BY tbl_follow.id DESC");

            while ($row_follow = mysqli_fetch_array($sql_follow)) {
                $i++;
            ?>
                <div class="story-item">
                    <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_follow['image'] ?>" alt="" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_follow['id'] ?>'" />
                    <span class="hover-content">
                        <?= $row_follow['name'] ?>
                        <br />
                        <?= $row_follow['summary'] ?></span></span>
                    <?php
                    if ($row_follow['hot'] == 1) {
                    ?>
                        <div class="story-hot">Hot</div>
                    <?php
                    }
                    ?>

                    <div class="story-item-info" style="bottom:90px;">
                        <p><i class="fa-solid fa-eye"></i><?= $row_follow['view'] ?></p>
                        <p><i class="fa-solid fa-thumbs-up"></i>
                            <?php
                            $id = $row_follow['id'];
                            $sql_like = mysqli_query($con, "SELECT * FROM tbl_like WHERE idtruyen='$id' GROUP BY id");
                            $count_like = mysqli_num_rows($sql_like);
                            ?>
                            <?= $count_like ?></p>
                    </div>
                    <h3 class="text-dot"> <?= $row_follow['name'] ?></h3>

                    <button class="btn btn-danger" onclick="window.location.replace('../stories/Follow/deletefollow.php?id=<?= $row_follow['id'] ?>&acount=<?= $acount_follow ?>')">Xóa</button>
                </div>

            <?php

            } ?>
        </div>
    </div>
</div>
<?php
include './inc/footer.php';
?>