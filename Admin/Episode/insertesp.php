<?php
ob_start();
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<?php
if (isset($_POST['insert'])) {
    $id_anime =  mysqli_real_escape_string($con, $_POST['id_anime']);
    // $image =  mysqli_real_escape_string($con, $_POST['image']);
    $espisode =  mysqli_real_escape_string($con, $_POST['espisode']);
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_name = time() . '_' . $file_name;
    $file_tmp = $_FILES['file']['tmp_name'];

    $file_type = $_FILES['file']['type'];
    $sql_insert_eps = mysqli_query($con, "INSERT INTO tbl_espisode(id_anime, espisode, video) VALUES ('$id_anime','$espisode','$file_name')");
    move_uploaded_file($file_tmp, "uploads/" . $file_name);

    header('location:../page/episode.php?id_anime=' . $_GET['id_anime']);
    die();
}
?>
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>THÊM TẬP PHIM</h1>
                <a href="../page/episode.php?id_anime=<?= $_GET['id_anime'] ?>"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->

<!-- insert story -->
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
                        <input type="number" placeholder="Nhập tập" name="espisode" required oninvalid="this.setCustomValidity('Tập không được để trống')" onchange="this.setCustomValidity('')" value="<?= $espisode ?? '' ?>">
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
                        <source src="./uploads/1668066981_2022-02-28 21-06-33.mkv" id="video_here">
                    </video>
                </div>

                <input type="submit" value="Thêm" name="insert" class="btn btn-success mt-3">
            </div>
        </div>
    </form>
</div>
<!-- end insert story -->
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