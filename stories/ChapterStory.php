<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';
?>

<!-- đọc chapter kiểu khác -->
<?php
include './Chapter/Readdifirent.php';
?>
<!-- end đọc chapter kiểu khác -->

<div class="Chapter-Story container">
    <!-- cây thư mục -->
    <?php
    $id = $_GET['idtruyen'];
    $sql_detail_story = mysqli_query($con, "SELECT * FROM tbl_story WHERE id=$id");
    while ($row_detail_story = mysqli_fetch_array($sql_detail_story)) {
    ?>
        <div class="Tree">
            <a href="HomeStory.php">Home <i class="fa-solid fa-arrow-right"></i> </a>
            <a href="DetailStory.php?id=<?= $_GET['idtruyen'] ?>"><?= $row_detail_story['name'] ?></a>
        </div>
    <?php } ?>
    <!-- end cây thư mục -->

    <!-- thông tin chapter -->
    <?php
    include './Chapter/DetailChapter.php';
    ?>
    <!--end thông tin chapter -->

</div>

<!-- thanh chức năng-->
<div class="option-chapter-story">
    <div class="option undo-story-chapter" onclick="window.location.href='DetailStory.php?id=<?= $_GET['idtruyen'] ?>'"><i class="fa-solid fa-rotate-left"></i> Quay lại</div>
    <?php include './Chapter/ChapBefore.php' ?>
    <div class="option list-chapter">
        <?php
        include 'Chapter/tableOfContent.php';
        ?>
    </div>
    <?php
    include './Chapter/ChapNext.php'

    ?>
    <div class="option zoom-in-zoom-out">
        <span id="zoom-in">
            <i class="fa-sharp fa-solid fa-magnifying-glass-plus"></i> Phóng to |
        </span>
        <span id="zoom-out">thu nhỏ <i class="fa-sharp fa-solid fa-magnifying-glass-minus"></i></span>
    </div>
    <div id="btn-read-different" class="option">
        <i class="fa-brands fa-readme mr-1"></i><span>Đọc kiểu khác</span>
    </div>
</div>
<!-- end thanh chức năng-->
<?php
include './inc/footer.php';
?>
<script src="../public/js/zoomChapter.js">
</script>
<script>
    $('#btn-read-different').click(function() {
        $('#flipbook').show();
        $('.icon').show();
        $('.Chapter-Story').hide();

    });
    $('.icon').click(function() {
        $('#flipbook').hide();
        $('.icon').hide();
        $('.Chapter-Story').show();

    });
</script>
<script>
    $('#flipbook').turn()({
        width: 900,
        height: 800,
        autoCenter: true
    })
</script>