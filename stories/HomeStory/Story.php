<?php
$sql_story = mysqli_query($con, "SELECT * FROM tbl_story ORDER BY id DESC LIMIT 15");
$i = 0;
while ($row_story = mysqli_fetch_array($sql_story)) {
    $i++;
?>
    <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_story['id'] ?>'">
        <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_story['image'] ?>" alt="" />
        <span class="hover-content">
            <?= $row_story['name'] ?>
            <br />
            <?= $row_story['summary'] ?></span>
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