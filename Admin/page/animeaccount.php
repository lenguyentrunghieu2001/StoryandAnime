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
                <h1>TRANG TÀI KHOẢN ANIME</h1>

            </div>
        </div>
    </div>

</main>
<!--end MAIN -->
<!-- list account -->
<?php
include '../AccountAnime/listaccountAnime.php';
?>
<!-- end list account -->
<?php
include '../inc/footer.php';
?>