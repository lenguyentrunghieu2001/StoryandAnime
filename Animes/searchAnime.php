<?php
include '../Database/Connect.php';
include './inc/header.php';
include './inc/menu.php';
?>
<?php
$name = $_GET['search'];
?>
<div id="HomeAnime">
    <div class="HotAnime">
        <div class="content text-center" style="position: relative; ">
            <div style="display: flex; justify-content:center; align-items: center; margin:10px 20px;">
                <h1 class="title" style="color:red;font-size: 40px;">KẾT QUẢ TÌM KIẾM</h1>
            </div>
            <div class="anime_parent">
                <?php
                $sql_search = mysqli_query($con, "SELECT * from tbl_anime where name like '%$name%' ");

                if ($name != "" && mysqli_num_rows($sql_search) > 0) {
                    while ($row_search  = mysqli_fetch_array($sql_search)) {
                ?>
                        <div class="anime_item" onclick="window.location.href='DetailAnime/updateviewAnime.php?id_anime=<?= $row_search['id_anime'] ?>'">
                            <img src="../Admin/Anime/uploads/<?= $row_search['image'] ?>" alt="">
                            <img src="./../public/images/video.png" alt="" class="videohover">
                            <h3 class="text-dot"><?= $row_search['name'] ?> </h3>
                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <p style="display: block;text-align: center; width: 100%;min-height: 420px;font-size: 20px;">Không tìm thấy!!</p>
                <?php
                }

                ?>


            </div>

        </div>
    </div>
</div>
<?php
include './inc/footer.php';
?>