<div id="story-hot">
    <h1 class="title" style="transform: translateY(25px); margin-left: 90px;">DANH SÁCH HOT</h1>
    <div class="slider">
        <?php
        $sql_story_hot = mysqli_query($con, "SELECT * FROM tbl_story WHERE hot = '1' ORDER BY id DESC LIMIT 14");
        while ($row_story_hot = mysqli_fetch_array($sql_story_hot)) {
        ?>
            <div class="slide">
                <div class="slide-child">
                    <div class="slide-hot">Hot</div>
                    <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_story_hot['image'] ?>" alt="" onclick="window.location.href='HomeStory/updateview.php?id=<?= $row_story_hot['id'] ?>'" />
                    <span class="hover-content">
                        <?= $row_story_hot['name'] ?>
                        <br />
                        <?= $row_story_hot['summary'] ?></span>
                </div>

            </div>
        <?php
        }
        ?>
    </div>
</div>