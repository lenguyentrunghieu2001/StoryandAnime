<h1 class="title" style="color:#d98a98">Chapter truyện xem nhiều nhất 7 ngày gần đây</h1>

<div class="tab_navigation-story">
    <?php
    $today = date('Y-m-d');
    ?>
    <li class="btn btn-outline-primary active"><?= $today ?></li>
    <li class="btn btn-outline-primary"><?= $NewDate = Date('Y-m-d', strtotime('-1 days')); ?></li>
    <li class="btn btn-outline-primary"><?= $NewDate = Date('Y-m-d', strtotime('-2 days')); ?></li>
    <li class="btn btn-outline-primary"><?= $NewDate = Date('Y-m-d', strtotime('-3 days')); ?></li>
    <li class="btn btn-outline-primary"><?= $NewDate = Date('Y-m-d', strtotime('-4 days')); ?></li>
    <li class="btn btn-outline-primary"><?= $NewDate = Date('Y-m-d', strtotime('-5 days')); ?></li>
    <li class="btn btn-outline-primary"><?= $NewDate = Date('Y-m-d', strtotime('-6 days')); ?></li>
</div>
<div class="tab_container-story_area">
    <div class="story">
        <?php
        $sql_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money'FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id WHERE tbl_chapter.datechap >= DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY view DESC LIMIT 10");
        while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
        ?>
            <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_chapter['idtruyen'] ?>'">
                <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" />
                <span class="hover-content">
                    <?= $row_chapter['name'] ?>
                    <br />
                    <?= $row_chapter['summary'] ?>
                </span>

                <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                <p>chap <?= $row_chapter['chap'] ?></p>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="story">
        <?php
        $sql_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money'FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id WHERE tbl_chapter.datechap >= DATE_SUB(NOW(), INTERVAL 2 DAY) AND  tbl_chapter.datechap <= DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY view DESC LIMIT 10");
        while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
        ?>
            <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_chapter['idtruyen'] ?>'">
                <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" />
                <span class="hover-content">
                    <?= $row_chapter['name'] ?>
                    <br />
                    <?= $row_chapter['summary'] ?>
                </span>

                <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                <p>chap <?= $row_chapter['chap'] ?></p>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="story">
        <?php
        $sql_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money'FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id WHERE tbl_chapter.datechap >= DATE_SUB(NOW(), INTERVAL 3 DAY) AND  tbl_chapter.datechap <= DATE_SUB(NOW(), INTERVAL 2 DAY) ORDER BY view DESC LIMIT 10");
        while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
        ?>
            <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_chapter['idtruyen'] ?>'">
                <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" />
                <span class="hover-content">
                    <?= $row_chapter['name'] ?>
                    <br />
                    <?= $row_chapter['summary'] ?>
                </span>

                <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                <p>chap <?= $row_chapter['chap'] ?></p>
            </div>
        <?php
        }
        ?>

    </div>
    <div class="story">
        <?php
        $sql_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money'FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id WHERE tbl_chapter.datechap >= DATE_SUB(NOW(), INTERVAL 4 DAY) AND  tbl_chapter.datechap <= DATE_SUB(NOW(), INTERVAL 3 DAY) ORDER BY view DESC LIMIT 10");
        while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
        ?>
            <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_chapter['idtruyen'] ?>'">
                <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" />
                <span class="hover-content">
                    <?= $row_chapter['name'] ?>
                    <br />
                    <?= $row_chapter['summary'] ?>
                </span>

                <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                <p>chap <?= $row_chapter['chap'] ?></p>
            </div>
        <?php
        }
        ?>

    </div>
    <div class="story">
        <?php
        $sql_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money'FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id WHERE tbl_chapter.datechap >= DATE_SUB(NOW(), INTERVAL 5 DAY) AND  tbl_chapter.datechap <= DATE_SUB(NOW(), INTERVAL 4 DAY) ORDER BY view DESC LIMIT 10");
        while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
        ?>
            <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_chapter['idtruyen'] ?>'">
                <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" />
                <span class="hover-content">
                    <?= $row_chapter['name'] ?>
                    <br />
                    <?= $row_chapter['summary'] ?>
                </span>

                <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                <p>chap <?= $row_chapter['chap'] ?></p>

            </div>
        <?php
        }
        ?>
    </div>
    <div class="story">
        <?php
        $sql_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money'FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id WHERE tbl_chapter.datechap >= DATE_SUB(NOW(), INTERVAL 6 DAY) AND  tbl_chapter.datechap <= DATE_SUB(NOW(), INTERVAL 5 DAY) ORDER BY view DESC LIMIT 10");
        while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
        ?>
            <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_chapter['idtruyen'] ?>'">
                <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" />
                <span class="hover-content">
                    <?= $row_chapter['name'] ?>
                    <br />
                    <?= $row_chapter['summary'] ?>
                </span>

                <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                <p>chap <?= $row_chapter['chap'] ?></p>
            </div>
        <?php
        }
        ?>

    </div>
    <div class="story">
        <?php
        $sql_chapter = mysqli_query($con, "SELECT tbl_story.id AS 'idtruyen', tbl_story.image AS 'image', tbl_story.name AS 'name',tbl_chapter.title AS 'title',tbl_story.summary AS 'summary', tbl_chapter.chap AS 'chap' ,tbl_chapter.money AS 'money'FROM tbl_chapter INNER JOIN tbl_story ON tbl_chapter.idtruyen =tbl_story.id WHERE tbl_chapter.datechap >= DATE_SUB(NOW(), INTERVAL 7 DAY) AND  tbl_chapter.datechap <= DATE_SUB(NOW(), INTERVAL 6 DAY) ORDER BY view DESC LIMIT 10");
        while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
        ?>
            <div class="story-item" onclick="window.location.href='../stories/HomeStory/updateview.php?id=<?= $row_chapter['idtruyen'] ?>'">
                <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_chapter['image'] ?>" alt="" />
                <span class="hover-content">
                    <?= $row_chapter['name'] ?>
                    <br />
                    <?= $row_chapter['summary'] ?>
                </span>

                <h3 class="text-dot"><?= $row_chapter['name'] ?></h3>
                <p>chap <?= $row_chapter['chap'] ?></p>
            </div>
        <?php
        }
        ?>
    </div>
</div>
</div>