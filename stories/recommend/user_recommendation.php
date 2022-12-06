<?php

include './recommend/recommend.php';
$username_ss = $_SESSION['loginuser'];
$matrix = array();
$story_star = mysqli_query($con, "SELECT * FROM tbl_star_story");
$story_star_check = mysqli_query($con, "SELECT * FROM tbl_star_story WHERE username = '$username_ss'");
$array = array();
if (mysqli_num_rows($story_star_check) > 0) {

    $matrix = array();
    while ($row_story_star = mysqli_fetch_array($story_star)) {

        $username = $row_story_star['username'];
        $idtruyen = $row_story_star['idtruyen'];


        $story = mysqli_query($con, "SELECT * FROM tbl_story WHERE id = $idtruyen");
        $row_story = mysqli_fetch_array($story);

        $name = $row_story['name'];
        $matrix[$username][$name] = $row_story_star['star'];
    }
    $array = getRecommendation($matrix, $username_ss);
} else {
?>
    <p style="margin: 11px auto;">Vui lòng đánh giá 1 truyện bất kỳ</p>
<?php
}


// foreach ($array as $key => $value) {
//     echo $key . '</br> ';
// }


?>

<?php



$n = 0;
foreach ($array as $key => $value) {

    if ($n == 10) {
        break;
    }

    $sql_story = mysqli_query($con, "SELECT * FROM tbl_story WHERE name = '$key' LIMIT 1");

    while ($row_story = mysqli_fetch_array($sql_story)) {
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

            <div class="story-item-info" style="bottom: 73px;">
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
                        <div id="rateYos<?= $n ?>">
                        </div>
                        <script>
                            $(function() {

                                $("#rateYos<?= $n ?>").rateYo({
                                    rating: <?= $row_avg_star_history['avgstar'] ?>,
                                    readOnly: true
                                });
                                var starWidth = $("#rateYos<?= $n ?>").rateYo("option", "starWidth"); //returns 40px
                                // Setter
                                $("#rateYos<?= $n ?>").rateYo("option", "starWidth", "20px"); //returns a jQuery Element

                            });
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <div style="display:flex">
                        <div id="rateYos<?= $n ?>"></div>
                    </div>
                    <script>
                        $(function() {
                            $("#rateYos<?= $n ?>").rateYo({
                                rating: 0,
                                readOnly: true
                            });
                            var starWidth = $("#rateYos<?= $n ?>").rateYo("option", "starWidth"); //returns 40px
                            // Setter
                            $("#rateYos<?= $n ?>").rateYo("option", "starWidth", "20px"); //returns a jQuery Element
                        });
                    </script>
                <?php
                }
                ?>
            </div>
            <div style="margin-bottom: 5px;">
                <?= round($value, 5) ?>
            </div>

        </div>

<?php
    }
    $n++;
} ?>