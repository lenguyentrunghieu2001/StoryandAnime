<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';

?>
<style>
    .content .btn {
        border-radius: 50% !important;
    }
</style>
<div class="content text-center">
    <div class="container">
        <h1 class="title">TẤT CẢ TRUYỆN</h1>
        <div class="story">
            <?php
            $sql_story_count = mysqli_query($con, "SELECT * FROM tbl_story ORDER BY id");
            $count = mysqli_num_rows($sql_story_count);

            $avgcount = ROUND($count / 12);
            $num = $count % 12;
            if ($num > 0 && $num <= 5) {
                $avgcount++;
            }
            $page = $_GET['page'];
            $startpage = ($page - 1) * 12;
            $sql_story = mysqli_query($con, "SELECT * FROM tbl_story ORDER BY id DESC LIMIT $startpage,12");
            $i = 0;
            while ($row_story = mysqli_fetch_array($sql_story)) {
                $i++;
            ?>
                <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_story['id'] ?>'">

                    <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_story['image'] ?>" alt="" />
                    <span class="hover-content">
                        <?= $row_story['name'] ?>
                        <br />
                        <?= $row_story['summary'] ?></span></span>
                    <?php
                    if ($row_story['hot'] == 1) {
                    ?>
                        <div class="story-hot">Hot</div>
                    <?php
                    }
                    ?>

                    <div class="story-item-info">
                        <p><i class="fa-solid fa-eye"></i><?= $row_story['view'] ?></p>
                        <p><i class="fa-solid fa-thumbs-up"></i>
                            <?php
                            $id = $row_story['id'];
                            $sql_like = mysqli_query($con, "SELECT * FROM tbl_like WHERE idtruyen='$id' GROUP BY id");
                            $count_like = mysqli_num_rows($sql_like);
                            ?>
                            <?= $count_like ?>
                        </p>
                    </div>
                    <h3 class="text-dot"> <?= $row_story['name'] ?></h3>
                    <div style="margin-left:15px ;">
                        <?php
                        $id = $row_story['id'];
                        $sql_avg_star_history = mysqli_query($con, "SELECT ROUND(AVG(star),2) AS 'avgstar' FROM tbl_star_story WHERE  idtruyen='$id' GROUP BY idtruyen");
                        if ($count_star = mysqli_num_rows($sql_avg_star_history) > 0) {
                            while ($row_avg_star_history = mysqli_fetch_array($sql_avg_star_history)) {

                        ?>
                                <div id="rateYo<?= $i ?>">
                                </div>
                                <script>
                                    $(function() {

                                        $("#rateYo<?= $i ?>").rateYo({
                                            rating: <?= $row_avg_star_history['avgstar'] ?>,
                                            readOnly: true
                                        });
                                        var starWidth = $("#rateYo<?= $i ?>").rateYo("option", "starWidth"); //returns 40px
                                        // Setter
                                        $("#rateYo<?= $i ?>").rateYo("option", "starWidth", "20px"); //returns a jQuery Element

                                    });
                                </script>
                            <?php
                            }
                        } else {
                            ?>
                            <div style="display:flex">
                                <div id="rateYo<?= $i ?>"></div>
                            </div>
                            <script>
                                $(function() {
                                    $("#rateYo<?= $i ?>").rateYo({
                                        rating: 0,
                                        readOnly: true
                                    });
                                    var starWidth = $("#rateYo<?= $i ?>").rateYo("option", "starWidth"); //returns 40px
                                    // Setter
                                    $("#rateYo<?= $i ?>").rateYo("option", "starWidth", "20px"); //returns a jQuery Element
                                });
                            </script>
                        <?php
                        }
                        ?>
                    </div>
                </div>

            <?php

            } ?>

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
                <button class="btn" style="background: #3785c9;" onclick="window.location.href='AllStory.php?page=<?= $pageprev ?>'">&laquo;</button>
            <?php
            }
            ?>
            <!-- for -->
            <?php
            for ($k = 1; $k <= $avgcount; $k++) {
                if ($k == $_GET['page']) {            ?>
                    <button style="margin: 20px 3px; border: 1px solid;background: #3785c9;" class="btn" onclick="window.location.href='AllStory.php?page=<?= $k ?>'"><?= $k ?></button>
                <?php } else {
                ?>
                    <button style="margin: 20px 3px; border: 1px solid" class="btn" onclick="window.location.href='AllStory.php?page=<?= $k ?>'"><?= $k ?></button>
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
                <button class="btn" style="background: #3785c9;" onclick="window.location.href='AllStory.php?page=<?= $pageprev ?>'">&raquo;</button>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
include './inc/footer.php';
?>