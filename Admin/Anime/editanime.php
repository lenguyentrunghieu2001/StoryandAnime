<?php
ob_start();
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<?php
if (isset($_POST['insert'])) {
    $id_anime = $_POST['id_anime'];
    $name =  mysqli_real_escape_string($con, $_POST['name']);
    // $image =  mysqli_real_escape_string($con, $_POST['image']);
    $summary =  mysqli_real_escape_string($con, $_POST['summary']);
    $studio =  mysqli_real_escape_string($con, $_POST['studio']);
    $categorystory =  $_POST['categorystory'];
    $image = $_FILES['image']['name'];
    $image = time() . '_' . $image;
    $image_tmp = $_FILES['image']['tmp_name'];
    $date_anime = $_POST['date_anime'];

    if (!empty($image)) {
        move_uploaded_file($image_tmp, 'uploads/' . $image);
        $sql = mysqli_query($con, "SELECT * FROM tbl_anime WHERE id_anime='$id_anime' LIMIT 1");
        while ($row = mysqli_fetch_array($sql)) {
            unlink('uploads/' . $row['image']);
        }
        $sql_update_anime = mysqli_query($con, "UPDATE tbl_anime SET name='$name',image='$image',summary='$summary',studio='$studio',date_anime='$date_anime' WHERE id_anime = $id_anime");

        $sql_delete = mysqli_query($con, "DELETE FROM tbl_anime_category WHERE id_anime='$id_anime'");

        foreach ($categorystory as $caterow) {
            $sql_insert_cate_anime = mysqli_query($con, "INSERT INTO tbl_anime_category(id_anime, id_category) VALUES ('$id_anime','$caterow')");
        }
    } else {
        $sql_update_anime = mysqli_query($con, "UPDATE tbl_anime SET name='$name',image='$image',summary='$summary',studio='$studio',date_anime='$date_anime' WHERE id_anime = $id_anime");

        $sql_delete = mysqli_query($con, "DELETE FROM tbl_anime_category WHERE id_anime='$id_anime'");

        foreach ($categorystory as $caterow) {
            $sql_insert_cate_anime = mysqli_query($con, "INSERT INTO tbl_anime_category(id_anime, id_category) VALUES ('$id_anime','$caterow')");
        }
    }

    header('location:../page/anime.php');
    die();
    // exit; 
}
?>
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>SỬA Anime</h1>
                <a href="../page/anime.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->

<!-- insert story -->
<div style="width: 95%; margin: 30px auto;">
    <?php
    $id_anime = $_GET['id_anime'];
    $sql_anime_list = mysqli_query($con, "SELECT * FROM tbl_anime WHERE id_anime='$id_anime'");
    while ($row_anime_list = mysqli_fetch_array($sql_anime_list)) {
    ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    <input type="hidden" name="id_anime" value="<?= $id_anime ?>">
                    <p style="color:red" class="error">
                        <?php
                        if (isset($errorregister)) {
                            echo $errorregister;
                        } ?> </p>
                    <div class="fields">
                        <div class="input-field">
                            <label>Tên Anime</label>
                            <input type="text" placeholder="Nhập tên anime" name="name" required oninvalid="this.setCustomValidity('Tên anime không được trống')" onchange="this.setCustomValidity('')" value="<?= $row_anime_list['name'] ?>">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>Hình ảnh anime</label>
                            <div style="display: flex; align-items: center;">
                                <input type="file" placeholder="Nhập link hình ảnh " name="image" required class="image" id="imagename" value="<?= $row_anime_list['image'] ?>" accept="image/*" onchange="loadFile(event)">
                                <img src="./uploads/<?= $row_anime_list['image'] ?>" class="image_src" alt="" width="250px" height="250px" id="output">
                            </div>
                        </div>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>Tóm tắt</label>
                            <textarea name="summary" rows="4" cols="50" oninvalid="this.setCustomValidity('nội dung không được trống')" onchange="this.setCustomValidity('')" required><?= $row_anime_list['summary'] ?></textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('summary');
                        </script>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>Hãng</label>
                            <input type="text" placeholder="Nhập tên hãng" name="studio" required oninvalid="this.setCustomValidity('Tên hãng không được trống')" onchange="this.setCustomValidity('')" value="<?= $row_anime_list['studio'] ?>">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>Ngày đăng</label>
                            <input type="datetime-local" placeholder="Nhập ngày đăng" name="date_anime" required oninvalid="this.setCustomValidity('ngày đăng không được trống')" onchange="this.setCustomValidity('')" value="<?= $row_anime_list['date_anime'] ?>">
                        </div>
                    </div>
                    <div class="fields">
                        <?php
                        $id_anime = $_GET['id_anime'];
                        $sql_list = mysqli_query($con, "SELECT * FROM tbl_anime_category WHERE id_anime='$id_anime'");
                        $uh_array = [];
                        foreach ($sql_list as $rowlist) {
                            array_push($uh_array, $rowlist['id_category']);
                        }
                        ?>
                        <label for="">Thể loại </label>
                        <select name="categorystory[]" id="" class="multiple-select" multiple style="width: 100%; " data-placeholder='Có thể chọn 1 hoặc nhiều thể loại'>
                            <?php
                            $category = mysqli_query($con, "SELECT * FROM tbl_category ");
                            foreach ($category as $row_category) {
                            ?>
                                <option value="<?= $row_category['idcategory'] ?>
                                " <?php
                                    echo in_array($row_category['idcategory'], $uh_array) ? 'selected' : '';
                                    ?>>
                                    <?= $row_category['name'] ?>
                                </option>

                            <?php
                            }

                            ?>
                    </div>
                    <input type="submit" value="Sửa" name="insert" class="btn btn-primary mt-3">
                </div>
            </div>
        </form>
    <?php
    }
    ?>
</div>

<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<!-- end insert story -->
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
<?php
include '../inc/footer.php';
?>