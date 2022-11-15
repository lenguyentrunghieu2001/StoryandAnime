<?php
include '../Database/Connect.php';
include './inc/header.php';
include './inc/menu.php';
?>
<div id="HomeAnime">


    <?php
    $id_category = $_GET['idcategory'];
    $sql_name_category = mysqli_query($con, "select * from tbl_category where idcategory ='$id_category'");
    while ($row_name_category = mysqli_fetch_array($sql_name_category)) {
    ?>
        <div class="content text-center" style="position: relative; ">
            <div style="display: flex; justify-content:center; align-items: center; margin:10px 20px;">
                <h1 class="title" style="color:green;font-size: 40px;text-transform: uppercase;"><?= $row_name_category['name'] ?></h1>
            </div>
            <div class="anime_parent">
                <?php
                $sql_anime = mysqli_query($con, "SELECT * FROM tbl_anime INNER JOIN tbl_anime_category on tbl_anime.id_anime  = tbl_anime_category.id_anime WHERE tbl_anime_category.id_category = $id_category order by tbl_anime.date_anime desc");
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

</div>
<?php
include './inc/footer.php';
?>