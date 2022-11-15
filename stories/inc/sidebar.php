<div class="sidebar col-3">
    <div class="history-sidebar">
        <img src="./../public/images/lichsu.png" alt="" style="height: 40px; width: 80%; margin-left: 10%;"></img>
        <div class=" history-sidebar-item">
            <?php
            $taikhoanuser = $_SESSION['loginuser'];
            $sql_history_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money',tbl_chapter.idchap AS 'idchap' FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id INNER JOIN tbl_history_chapter ON tbl_history_chapter.idchap = tbl_chapter.idchap WHERE tbl_history_chapter.taikhoanuser = '$taikhoanuser' ORDER BY tbl_history_chapter.id DESC LIMIT 4");
            while ($row_chapter = mysqli_fetch_array($sql_history_chapter)) {
            ?>
                <div class="story-item" style="border-bottom:1px solid ;" onclick="window.location.href='Chapter/handleHistoryChap.php?idchap=<?= $row_chapter['idchap'] ?>&taikhoanuser=<?= $taikhoanuser ?>&idtruyen=<?= $row_chapter['idtruyen'] ?>'">
                    <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                    <p>chap <?= $row_chapter['chap'] ?></p>
                </div>
            <?php
            }
            ?>
        </div>
        <button class="btn btn-primary" style="margin-left:90px;" onclick="window.location.href='../stories/HistoryChapter.php'">Xem thêm</button>
    </div>
    <div class="ratings-sidebar">
        <img src="./../public/images/xephang.png" alt="" style="height: 60px; width: 80%; margin:40px 0 0 10%;"></img>

        <div class="tab_navigation-story1 text-right">
            <li class="btn btn-outline-danger active">VIEW</li>
            <li class="btn btn-outline-danger">LIKE</li>
        </div>
        <div class="tab_container-story_area1">
            <div class="story">

                <div>
                    <?php
                    $sql_rating_story = mysqli_query($con, "SELECT * FROM tbl_story ORDER BY view DESC LIMIT 5");
                    $i = 0;
                    while ($row_rating_story = mysqli_fetch_array($sql_rating_story)) {
                        $i++;
                    ?>
                        <div class="story-item" style="display:flex; align-items:center; justify-content: space-between;" onclick="window.location.href='HomeStory/updateview.php?id=<?= $row_rating_story['id'] ?>'">
                            <div>
                                <p style="text-align: center;"> <?= $row_rating_story['view'] ?> view</p>
                                <i class="fa-sharp fa-solid fa-star" style="position: relative; font-size: 50px;color:red;"><span style="position: absolute; left:20px;top:15px; font-size: 24px; color:white;"><?= $i ?></span></i>
                            </div>
                            <div><img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_rating_story['image'] ?>" alt="" />
                                <span class="hover-content"><?= $row_rating_story['name'] ?>
                                    <br />
                                    <?= $row_rating_story['summary'] ?></span></span></span>
                                <h3 class="text-dot text-center"><?= $row_rating_story['name'] ?></h3>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="tab_container-story_area1">
            <div class="story" style="display:none;">
                <?php
                $sql_ratings_like = mysqli_query($con, "SELECT count(tbl_like.idtruyen) as count ,tbl_story.* FROM tbl_story INNER JOIN tbl_like ON tbl_story.id = tbl_like.idtruyen  GROUP BY tbl_like.idtruyen ORDER BY count DESC LIMIT 5");
                $i = 0;
                while ($row_ratings_like = mysqli_fetch_array($sql_ratings_like)) {
                    $i++;
                ?>
                    <div class="story-item" style="display:flex; align-items:center; justify-content: space-between;" onclick="window.location.href='HomeStory/updateview.php?id=<?= $row_ratings_like['id'] ?>'">
                        <div>
                            <p style="text-align: center;"> <?= $row_ratings_like['count'] ?> like</p>
                            <i class="fa-sharp fa-solid fa-star" style="position: relative; font-size: 50px;color:red;"><span style="position: absolute; left:20px;top:15px; font-size: 24px; color:white;"><?= $i ?></span></i>
                        </div>
                        <div><img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_ratings_like['image'] ?>" alt="" />
                            <span class="hover-content">
                                <?= $row_ratings_like['name'] ?>
                                <br />
                                <?= $row_ratings_like['summary'] ?></span>

                            <h3 class="text-dot text-center"> <?= $row_ratings_like['name'] ?></h3>
                        </div>
                    </div>
                <?php

                } ?>
            </div>


        </div>
    </div>
</div>
</div>
<script src="../public/js/tabstory.js"></script>

</script>