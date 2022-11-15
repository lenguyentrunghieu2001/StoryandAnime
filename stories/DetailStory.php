<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';
?>


<div id="main-detailstory">
    <div class="container">

        <div class="row">
            <!-- thông tin truyện -->
            <?php
            $id = $_GET['id'];
            $sql_detail_story = mysqli_query($con, "SELECT * FROM tbl_story WHERE id=$id");
            while ($row_detail_story = mysqli_fetch_array($sql_detail_story)) {
            ?>
                <div class="col-9">
                    <div class="Tree">
                        <a href="HomeStory.php">Home <i class="fa-solid fa-arrow-right"></i></a>
                        <?php
                        $idtruyen = $_GET['id'];
                        $sql_category_story = mysqli_query($con, "SELECT * FROM tbl_category INNER JOIN tbl_story_category ON tbl_category.idcategory = tbl_story_category.idcategory WHERE tbl_story_category.idtruyen = '$id'");
                        $count_cate = mysqli_num_rows($sql_category_story);
                        $i = 0;
                        while ($row_category_story = mysqli_fetch_array($sql_category_story)) {
                            $i++;
                        ?>
                            <a href='./CategoryStory.php?id=<?= $row_category_story['idcategory'] ?>'> <?= $row_category_story['name'] ?></a>
                        <?php
                            if ($count_cate > $i) {
                                echo '<a href="#"> & </a>';
                            }
                        }
                        ?>
                    </div>
                    <!-- gồm hình ảnh button theo dõi và tình trạng -->
                    <?php include './DetailStory/infoStory.php' ?>
                    <!-- end gồm hình ảnh button theo dõi và tình trạng -->

                    <!-- danh sách chương -->
                    <?php include './DetailStory/listChapter.php' ?>
                    <!-- end danh sách chương -->


                    <!-- truyện khác-->
                    <?php include './DetailStory/StoryDifferent.php' ?>
                    <!-- end truyệnkhác -->

                    <!-- danh sách comment -->
                    <?php include './DetailStory/comment.php' ?>
                    <!-- end danh sách comment -->

                </div>
            <?php
            }
            ?>
            <!-- end thông tin truyện -->

            <?php include './inc/sidebar.php' ?>
        </div>
    </div>

</div>

<?php
include './inc/footer.php';
?>