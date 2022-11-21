    <div class="HotAnime">
        <div class="content text-center" style="position: relative; ">
            <div style="display: flex; justify-content:space-between; align-items: center;">
                <h1 class="title" style="color:red">ANIME HOT</h1>
                <div class="line-parent" style="color:red">
                    <div class="line"></div>
                    <i class="fa-solid fa-fire"></i>
                    <div class="line"></div>
                </div>
                <a href="./allhotAnime.php" style="color:red">Xem thêm</a>
            </div>

            <div class="anime_parent">
                <?php
                $sql_hotanime = mysqli_query($con, "SELECT * from tbl_anime where hot =1  order by view desc limit 6");
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