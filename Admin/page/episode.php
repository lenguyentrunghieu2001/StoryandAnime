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
                <h1>TRANG DANH SÁCH TẬP CỦA PHIM:
                    <?php
                    $id_anime = $_GET["id_anime"];
                    $sql_name_anime = mysqli_query($con, "select * from tbl_anime where id_anime = $id_anime ");
                    $row_name_anime = mysqli_fetch_array($sql_name_anime);
                    echo $row_name_anime["name"];
                    ?></h1>
                <a href="../page/anime.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>

            </div>
        </div>
    </div>

</main>
<!--end MAIN -->
<!-- list account -->
<?php
include '../Episode/listepisode.php';
?>
<!-- end list account -->
<?php
include '../inc/footer.php';
?>