<?php
ob_start();
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<?php
if (isset($_POST['insert'])) {
    $name =  mysqli_real_escape_string($con, $_POST['name']);
    // $image =  mysqli_real_escape_string($con, $_POST['image']);
    $summary =  mysqli_real_escape_string($con, $_POST['summary']);
    $author =  mysqli_real_escape_string($con, $_POST['author']);
    $status = $_POST['status'];
    $type = $_POST['type'];
    $usernametrans =   $_POST['usernametrans'];
    $categorystory =  $_POST['categorystory'];
    $image = $_FILES['image']['name'];
    $image = time() . '_' . $image;
    $image_tmp = $_FILES['image']['tmp_name'];


    $sql_check_story = mysqli_query($con, "SELECT * FROM tbl_story WHERE name = '$name' LIMIT 1");
    $count = mysqli_num_rows($sql_check_story);
    if ($count > 0) {
        $errorregister = 'Truyện đã có nhóm dịch';
    } else {
        $sql_insert_story = mysqli_query($con, "INSERT INTO tbl_story(name, image, summary, author, status, usernametrans,type) VALUES ('$name','$image','$summary','$author','$status','$usernametrans','$type')");

        $sql_find_id = mysqli_query($con, "SELECT * FROM tbl_story ORDER BY id DESC LIMIT 1");
        $row_story_cate = mysqli_fetch_array($sql_find_id);
        $id_story_cate = $row_story_cate['id'];

        foreach ($categorystory as $caterow) {
            $sql_insert_cate_story = mysqli_query($con, "INSERT INTO tbl_story_category(idtruyen, idcategory) VALUES ('$id_story_cate','$caterow')");
        }
        move_uploaded_file($image_tmp, 'uploads/' . $image);

        header('location:../page/storytrans.php');
        die();
        // exit;
    }
}
?>
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>THÊM TRUYỆN</h1>
                <a href="../page/storytrans.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
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
                        <label>Tên Truyện</label>
                        <input type="text" placeholder="Nhập tên truyện" name="name" required oninvalid="this.setCustomValidity('tên thể loại không được trống')" onchange="this.setCustomValidity('')" value="<?= $name ?? '' ?>">
                    </div>
                </div>
                <div class="fields">
                    <div class="input-field">
                        <label>Hình ảnh truyện</label>
                        <div style="display: flex; align-items: center;">
                            <input type="file" placeholder="Nhập link hình ảnh " name="image" required class="image" id="imagename" value="<?= $image ?? '' ?>" accept="image/*" onchange="loadFile(event)">
                            <img src="" class="image_src" alt="" width="250px" height="250px" id="output">
                        </div>
                    </div>
                </div>
                <div class="fields">
                    <div class="input-field">
                        <label>Tóm tắt</label>
                        <textarea name="summary" rows="4" cols="50" oninvalid="this.setCustomValidity('nội dung không được trống')" onchange="this.setCustomValidity('')" required><?= $summary ?? '' ?></textarea>
                    </div>
                    <script>
                        CKEDITOR.replace('summary');
                    </script>
                </div>
                <div class="fields">
                    <div class="input-field">
                        <label>Tác giả</label>
                        <input type="text" placeholder="Nhập tên tác giả" name="author" required oninvalid="this.setCustomValidity('tên thể loại không được trống')" onchange="this.setCustomValidity('')" value="<?= $author ?? '' ?>">
                    </div>
                </div>
                <div class="fields">
                    <label>Trạng thái</label>
                    <select name="status" id="" style="width: 100%;">
                        <option value="0">Chưa hoàn thành</option>
                        <option value="1">hoàn thành</option>
                    </select>
                </div>
                <div class="fields">
                    <label>Kiểu Truyện</label>
                    <select name="type" id="" style="width: 100%;">
                        <option value="0">Truyện chữ</option>
                        <option value="1">Truyện tranh</option>
                    </select>
                </div>
                <div class="fields">
                    <div class="input-field">
                        <label>Tên nhóm dịch</label>
                        <input type="text" placeholder="Nhập tên thể loại" name="usernametrans" value="<?= $_SESSION['logintrans'] ?>" readonly>
                    </div>
                </div>
                <div class="fields">
                    <label for="">Thể loại </label>
                    <select name="categorystory[]" id="" class="multiple-select" multiple style="width: 100%; " data-placeholder='Có thể chọn 1 hoặc nhiều thể loại'>
                        <?php
                        $category = mysqli_query($con, "SELECT * FROM tbl_category ");
                        foreach ($category as $row_category) {
                        ?>
                            <option value="<?= $row_category['idcategory'] ?>"><?= $row_category['name'] ?></option>

                        <?php
                        }

                        ?>
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
<?php
include '../inc/footer.php';
?>