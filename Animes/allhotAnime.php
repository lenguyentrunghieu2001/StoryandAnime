<?php
include '../Database/Connect.php';
include './inc/header.php';
include './inc/menu.php';
?>
<div id="HomeAnime">
    <div class="HotAnime">
        <div class="content text-center" style="position: relative; ">
            <div style="display: flex; justify-content:center; align-items: center; margin:10px 20px;">
                <h1 class="title" style="color:red;font-size: 40px;">ANIME HOT</h1>
            </div>
            <div class="anime_parent">
                <?php
                $sql_hotanime = mysqli_query($con, "SELECT * from tbl_anime where hot =1  order by view desc");
                while ($row_hotanime  = mysqli_fetch_array($sql_hotanime)) {
                ?>
                    <div class="anime_item" onclick="window.location.href='DetailAnime/updateviewAnime.php?id_anime=<?= $row_hotanime['id_anime'] ?>'">
                        <img src="../Admin/Anime/uploads/<?= $row_hotanime['image'] ?>" alt="">
                        <img src="./../public/images/video.png" alt="" class="videohover">
                        <h3 class="text-dot"><?= $row_hotanime['name'] ?> </h3>
                    </div>
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