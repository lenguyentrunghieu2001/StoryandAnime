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

    #option_video {
        position: absolute;
        background: black;
        height: 100%;
        z-index: 9999;
        margin: 0 auto;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
    }

    #continue_video {
        margin-right: 20px;
    }
</style>
<?php
$id = $_GET['id_esp'];
$sql_esp = mysqli_query($con, "SELECT * FROM tbl_espisode where id = '$id'");
$row_esp = mysqli_fetch_array($sql_esp);
?>
<?php
$sql_time = mysqli_query($con, "SELECT * FROM tbl_position_esp WHERE username = '{$_SESSION['loginuser']}' and id_esp = '{$_GET['id_esp']}'");
if (mysqli_num_rows($sql_time) > 0) {
    $row_time = mysqli_fetch_array($sql_time);
    $time = $row_time['time'];
?>
    <div id="option_video">
        <button id="continue_video" class="btn btn-primary" onclick="continue_video()">Tiếp tục</button>
        <button id="start_video" class="btn btn-success" onclick="start_video()">Xem lại từ đầu</button>
    </div>
    <script>
        function start_video() {
            document.getElementById('vid1').currentTime = 0;
            document.getElementById('option_video').style.display = 'none';
            document.getElementById('vid1').play();
        }

        function continue_video() {
            document.getElementById('vid1').currentTime = <?= $time ?>;
            document.getElementById('option_video').style.display = 'none';
            document.getElementById('vid1').play();
        }
    </script>
<?php
}
?>

<div id="detail_esp">
    <div class="video">
        <video id="vid1" width="80%" controls onclick="gettimevideo()">
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
$usernamepos = $_SESSION['loginuser'];
$id_esp = $_GET['id_esp'];
?>
<input type="hidden" id="usernamepos" value="<?= $usernamepos ?>">
<input type="hidden" id="id_esp" value="<?= $id_esp ?>">
<?php
include './inc/footer.php';
?>

<script type="text/javascript">
    window.onbeforeunload = function() {
        var id_esp = $('#id_esp').val();
        var usernamepos = $('#usernamepos').val();
        var time = document.getElementById('vid1').currentTime;
        $.ajax({
            url: "./DetailEsp/handletime.php",
            type: "POST",
            data: {
                id_esp: id_esp,
                usernamepos: usernamepos,
                time: time
            }
        });
    }
</script>