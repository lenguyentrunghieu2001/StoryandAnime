<?php
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';

?>
<style>
    .overflow-x .content_news {
        text-align: justify;
        text-overflow: ellipsis;
        overflow-y: scroll;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        width: 120px;
    }

    .overflow-x .content_news img {
        display: none;
    }

    .overflow-x .option {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 120px;
    }
</style>
<!-- MAIN -->
<?php
$idtruyen_chapter = $_GET['idtruyen'];
$sql_story = mysqli_query($con, "SELECT * FROM tbl_story WHERE id='$idtruyen_chapter'");
$row_story = mysqli_fetch_array($sql_story);
?>
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>Trang Chapter</h1>
                <h1>Tên truyện: <?= $row_story['name'] ?></h1>
            </div>
        </div>
    </div>
</main>

<?php
include '../ChapterTrans/listchapter.php';
?>
<?php
include '../inc/footer.php';

?>