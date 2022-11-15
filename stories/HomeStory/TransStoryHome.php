<div class='parent'>
    <?php
    $sql_trans_story_home = mysqli_query($con, "SELECT * FROM translate");
    while ($row_trans_story_home = mysqli_fetch_assoc($sql_trans_story_home)) {
    ?>
        <div onclick="window.location.href='./../stories/TransStory.php?usernametrans=<?= $row_trans_story_home['usernametrans'] ?>'">
            <img src="./../public/images/group.gif" alt="cat photo" />
            <p><?= $row_trans_story_home['usernametrans'] ?></p>
        </div>

    <?php
    }
    ?>
</div>
<style>
    .parent {
        display: flex;
        max-width: 100%;
        /* overflow: auto; */
        /* white-space: nowrap; */
        margin: 10px;
        flex-wrap: wrap;
    }



    .parent img {
        height: 120px;
        width: 120px;
        margin: 0 20px;
        border-radius: 50%;
        box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
    }

    .parent p {
        margin: 15px 0;
        font-weight: 700;
    }
</style>