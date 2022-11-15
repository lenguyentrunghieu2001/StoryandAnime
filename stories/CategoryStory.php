<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';
?>

<?php
$category = $_GET['id'];
$i = 0;
$sql_category = mysqli_query($con, "SELECT * FROM tbl_category where idcategory='$category'");
while ($row_category = mysqli_fetch_array($sql_category)) {

?>
    <div class="content text-center" style="min-height: 400px;">
        <div class="container">
            <h1 class="title">THỂ LOẠI <?= $row_category['name'] ?></h1>
            <div class="story">
                <?php
                $idcategory = $row_category['idcategory'];
                $sql_story = mysqli_query($con, "SELECT * FROM tbl_story INNER JOIN tbl_story_category ON tbl_story.id = tbl_story_category.idtruyen WHERE tbl_story_category.idcategory = '$idcategory' ORDER BY tbl_story.id DESC");
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
        </div>
    </div>
<?php
}
include './inc/footer.php';
?>