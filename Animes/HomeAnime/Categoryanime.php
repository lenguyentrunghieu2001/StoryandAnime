<?php
$sql_category = mysqli_query($con, "select * from tbl_category ");
while ($row_category = mysqli_fetch_array($sql_category)) {
?>
    <div class="content text-center" style="position: relative; ">
        <div style="display: flex; justify-content:space-between; align-items: center;">
            <h1 class="title" style="color:green; text-transform: uppercase;"><?= $row_category['name'] ?></h1>
            <div class="line-parent">
                <div class="line"></div>
                <i class="fa-sharp fa-solid fa-heart-pulse"></i>
                <div class="line"></div>
            </div>
            <a href="./allCategoryAnime.php?idcategory=<?= $row_category['idcategory'] ?>">Xem thêm</a>
        </div>


        <div class="anime_parent">
            <?php
            $id_category = $row_category['idcategory'];
            $sql_anime = mysqli_query($con, "SELECT * FROM tbl_anime INNER JOIN tbl_anime_category on tbl_anime.id_anime  = tbl_anime_category.id_anime WHERE tbl_anime_category.id_category = $id_category order by tbl_anime.date_anime desc limit 6");
            while ($row_anime = mysqli_fetch_array($sql_anime)) {
            ?>
                <div class="anime_item">
                    <img src="../Admin/Anime/uploads/<?= $row_anime['image'] ?>" alt="">
                    <img src="./../public/images/video.png" alt="" class="videohover">
                    <h3 class="text-dot"><?= $row_anime['name'] ?> </h3>
                </div>
            <?php
            }
            ?>
        </div>

    </div>
<?php
}
?>