<?php
include '../Database/Connect.php';
include './inc/header.php';
include './inc/menu.php';
?>

<?php
$id_anime = $_GET['id_anime'];
$sql_detail_anime = mysqli_query($con, "SELECT * FROM tbl_anime WHERE id_anime = '$id_anime'");
while ($row_detail_anime = mysqli_fetch_array($sql_detail_anime)) {
?>
    <div id="DetailAnime">
        <div class="container">
            <div class="name"><?= $row_detail_anime['name'] ?></div>

            <div class="row">
                <div class="image col-3">
                    <img src="../Admin/Anime/uploads/<?= $row_detail_anime['image'] ?>" alt="" width="250px">
                </div>
                <div class="info_anime col-8">
                    <div class="anime">
                        <div class="title">Hãng:</div>
                        <div class="content-status"><?= $row_detail_anime['studio'] ?></div>
                    </div>

                    <div class="anime">
                        <div class="title">Lược xem:</div>
                        <div class="content-view"><?= $row_detail_anime['view'] ?></div>
                    </div>
                    <div class="anime">
                        <div class="title">Thể loại:</div>
                        <div class="content-cate">
                            <?php
                            $sql_category = mysqli_query($con, "SELECT * FROM tbl_anime_category INNER JOIN tbl_category on tbl_anime_category.id_category = tbl_category.idcategory  WHERE tbl_anime_category.id_anime = '$id_anime'");
                            while ($row_category = mysqli_fetch_array($sql_category)) {
                            ?>
                                <button onclick="window.location.href='./allCategoryAnime.php?idcategory=<?= $row_category['idcategory'] ?>'" class="btn btn-primary"><?= $row_category['name'] ?></button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="anime" style="display: block;">
                        <div class="title">Tập phim:</div>
                        <div class="tonghop">
                            <?php
                            $sql_esp = mysqli_query($con, "SELECT * FROM tbl_espisode where  id_anime = '$id_anime'");
                            while ($row_esp = mysqli_fetch_array($sql_esp)) {
                            ?>
                                <div onclick="window.location.href='./DetailEsp.php?id_esp=<?= $row_esp['id'] ?>'" class="content-number">Tập <?= $row_esp['espisode'] ?></div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="summary">
                <div class="title">Nội dung</div>
                <div class="content-summary"><?= $row_detail_anime['summary'] ?></div>
            </div>
        </div>
        <?php
        include 'DetailAnime/comments.php';
        ?>
    </div>
<?php

}
?>

<?php
include './inc/footer.php';
?>