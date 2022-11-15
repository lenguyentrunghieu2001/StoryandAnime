<menu>
    <nav>
        <li><a href="./HomeStory.php">Trang chủ</a></li>
        <li class="dropdown-category"><a href="#">Thể Loại
                <i class="fa-sharp fa-solid fa-caret-down"></i>
            </a>
            <ul class="child-nav">
                <div class="row">
                    <?php
                    $sql_category = mysqli_query($con, "SELECT * FROM tbl_category");
                    while ($row_category = mysqli_fetch_array($sql_category)) {


                    ?>
                        <li class="col-md-3" onclick="window.location.href='./CategoryStory.php?id=<?= $row_category['idcategory'] ?>'"><a href="./CategoryStory.php?id=<?= $row_category['idcategory'] ?>"><?= $row_category['name'] ?></a></li>
                    <?php
                    }
                    ?>
                </div>
            </ul>
        </li>
        <li><a href="./Allstoryimage.php?page=1">Truyện tranh</a></li>
        <li><a href="./Allstorytext.php?page=1">Truyện chữ</a></li>
        <li><a href="./Follow.php">Theo dõi</a></li>
        <li><a href="./HistoryChapter.php">Lịch sử</a></li>
        <li><a href="./NewsStory.php">Tin Tức</a></li>
        <li class="dropdown-category"><a href="#">Lọc & Tìm
                <i class="fa-sharp fa-solid fa-caret-down"></i>
            </a>
            <ul class="child-nav">
                <div class="row">
                    <li class="col-md-6" onclick="window.location.href='./fillerStory.php'"><a href="./fillerStory.php">Lọc Theo Truyện</a></li>
                    <li class="col-md-6" onclick="window.location.href='./fillerChapter.php'"><a href="./fillerChapter.php">Lọc Theo Chapter</a></li>
                </div>
            </ul>
        </li>
        <li><a href="./loadingmoney.php">Nạp Tiền</a></li>
        <li><a href="./packetAnime.php">Anime</a></li>
    </nav>
</menu>