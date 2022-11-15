<?php
ob_start();
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<?php

if (isset($_POST['update'])) {
    $id =  $_GET['id_esp'];
    $id_anime =  mysqli_real_escape_string($con, $_POST['id_anime']);
    // $image =  mysqli_real_escape_string($con, $_POST['image']);
    $espisode =  mysqli_real_escape_string($con, $_POST['espisode']);
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_name = time() . '_' . $file_name;
    $file_tmp = $_FILES['file']['tmp_name'];

    $file_type = $_FILES['file']['type'];
    move_uploaded_file($file_tmp, "uploads/" . $file_name);
    $sql = mysqli_query($con, "SELECT * FROM tbl_espisode WHERE id='$id' LIMIT 1");
    while ($row = mysqli_fetch_array($sql)) {
        unlink('uploads/' . $row['video']);
    }
    $sql_update_eps = mysqli_query($con, "UPDATE tbl_espisode SET espisode='$espisode',video='$file_name' WHERE id =$id ");


    header('location:../page/episode.php?id_anime=' . $_GET['id_anime']);
    die();
}
?>
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>SỬA TẬP PHIM</h1>
                <a href="../page/episode.php?id_anime=<?= $_GET['id_anime'] ?>"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->
<?php
$id_anime = $_GET['id_anime'];
$id_esp = $_GET['id_esp'];
$sql_find = mysqli_query($con, "select * from tbl_espisode where id = '$id_esp' ");
while ($row_find = mysqli_fetch_array($sql_find)) {
?>
    <div style="width: 95%; margin: 30px auto;">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    <p style="color:red" class="error">
                        <?php
                        if (isset($errorregister)) {
                            echo $errorregister;
                        } ?> </p>
                    <div class="fields">
                        <div class="input-field">
                            <label>id anime</label>
                            <input type="text" name="id_anime" value="<?= $_GET['id_anime'] ?>" readonly>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>Tập phim</label>
                            <input value="<?= $row_find['espisode'] ?>" type="number" placeholder="Nhập tập" name="espisode" required oninvalid="this.setCustomValidity('Tập không được để trống')" onchange="this.setCustomValidity('')" value="<?= $espisode ?? '' ?>">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>Video</label>
                            <div style="display:flex ;">
                                <input type="file" class="file_multi_video" name="file" accept="file_extension|audio/*|video/*|image/*|media_type">
                            </div>

                        </div>

                        <video width="400" controls>
                            <source src="./uploads/<?= $row_find['video'] ?>" id="video_here">
                        </video>
                    </div>

                    <input type="submit" value="Sửa" name="update" class="btn btn-success mt-3">
                </div>
            </div>
        </form>
    </div>
<?php

}
?>

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<script type="text/javascript">
    document.getElementById('btnshow').onclick = function() {
        img = document.createElement('img');
        document.getElementById('image').src = document.getElementById('imagename').value;
        document.body.appendChild(img);
    }
</script>
<script>
    $(".multiple-select").select2({
        // maximumSelectionLength: 2
    });
</script>
<script>
    $(document).on("change", ".file_multi_video", function(evt) {
        var $source = $('#video_here');
        $source[0].src = URL.createObjectURL(this.files[0]);
        $source.parent()[0].load();
    });
</script>
<?php
include '../inc/footer.php';
?>