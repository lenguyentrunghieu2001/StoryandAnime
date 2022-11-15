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
    }

    .overflow-x .option li {
        padding: 0 10px;

    }
</style>
<!-- MAIN -->
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>TRANG THỂ LOẠI</h1>

            </div>
        </div>
    </div>

</main>
<!--end MAIN -->

<!-- list new -->
<?php
include '../CategoryStory/listcategory.php'; ?>
<!-- end list new -->
<?php
include '../inc/footer.php';
?>