<?php
include '../Database/Connect.php';
include './inc/header.php';
include './inc/menu.php';
?>
<style>
    #detail_esp .video {
        text-align: center;
    }

    #detail_esp .anime .title {
        margin-bottom: 20px;
        font-size: 20px;
    }

    #detail_esp .anime {
        text-align: center;
        margin: 20px auto;
    }
</style>
<?php
$id = $_GET['id_esp'];
$sql_esp = mysqli_query($con, "SELECT * FROM tbl_espisode where id = '$id'");
$row_esp = mysqli_fetch_array($sql_esp);
?>
<div id="detail_esp">
    <div class="video">
        <video id="vid1" width="80%" controls autoplay>
            <source src="../Admin/Episode/uploads/<?= $row_esp['video'] ?>">
        </video>
    </div>

    <div class="anime" style="display: block;">
        <div class="title">Tập phim:</div>
        <div class="tonghop">
            <?php
            $sql_esp_list = mysqli_query($con, "SELECT * FROM tbl_espisode Where id_anime = '$row_esp[id_anime]'");
            while ($row_esp_list = mysqli_fetch_array($sql_esp_list)) {
                if ($id == $row_esp_list['id']) {
            ?>
                    <button onclick="window.location.href='DetailEsp.php?id_esp=<?= $row_esp_list['id'] ?>'" class="content-number btn btn-danger">Tập <?= $row_esp_list['espisode'] ?></button>
                <?php
                } else {
                ?>
                    <button onclick="window.location.href='DetailEsp.php?id_esp=<?= $row_esp_list['id'] ?>'" class="content-number btn btn-primary">Tập <?= $row_esp_list['espisode'] ?></button>
            <?php
                }
            }
            ?>

        </div>
    </div>

</div>


<?php
include './inc/footer.php';
?>

<script>
    document.getElementById('vid1').currentTime = 50;
</script>