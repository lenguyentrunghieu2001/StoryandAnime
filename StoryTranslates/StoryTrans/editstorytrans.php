<?php
ob_start();
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<?php
if (isset($_POST['insert'])) {
    $idtruyen = $_POST['idtruyen'];
    $name =  mysqli_real_escape_string($con, $_POST['name']);
    $summary =  mysqli_real_escape_string($con, $_POST['summary']);
    $author =  mysqli_real_escape_string($con, $_POST['author']);
    $status = $_POST['status'];
    $type = $_POST['type'];
    $usernametrans =   $_POST['usernametrans'];
    $categorystory =  $_POST['categorystory'];
    $image = $_FILES['image']['name'];
    $image = time() . '_' . $image;
    $image_tmp = $_FILES['image']['tmp_name'];
    if (!empty($image)) {
        move_uploaded_file($image_tmp, 'uploads/' . $image);
        $sql = mysqli_query($con, "SELECT * FROM tbl_story WHERE id='$idtruyen' LIMIT 1");
        while ($row = mysqli_fetch_array($sql)) {
            unlink('uploads/' . $row['image']);
        }
        $sql_update_story = mysqli_query($con, "UPDATE tbl_story SET name='$name',image='$image',summary='$summary',author='$author',status='$status',usernametrans='$usernametrans',type='$type' WHERE id='$idtruyen'");

        $sql_delete = mysqli_query($con, "DELETE FROM tbl_story_category WHERE idtruyen='$idtruyen'");

        foreach ($categorystory as $caterow) {
            $sql_insert_cate_story = mysqli_query($con, "INSERT INTO tbl_story_category(idtruyen, idcategory) VALUES ('$idtruyen','$caterow')");
        }
    } else {
        $sql_update_story = mysqli_query($con, "UPDATE tbl_story SET name='$name',summary='$summary',author='$author',status='$status',usernametrans='$usernametrans',type='$type' WHERE id='$idtruyen'");

        $sql_delete = mysqli_query($con, "DELETE FROM tbl_story_category WHERE idtruyen='$idtruyen'");

        foreach ($categorystory as $caterow) {
            $sql_insert_cate_story = mysqli_query($con, "INSERT INTO tbl_story_category(idtruyen, idcategory) VALUES ('$idtruyen','$caterow')");
        }
    }

    header('location:../page/storytrans.php');
    die();
    // exit; 
}
?>
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>S???A TRUY???N</h1>
                <a href="../page/storytrans.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay l???i</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->

<!-- insert story -->
<div style="width: 95%; margin: 30px auto;">
    <?php
    $idtruyen = $_GET['idtruyen'];
    $sql_story_list = mysqli_query($con, "SELECT * FROM tbl_story WHERE id='$idtruyen'");
    while ($row_story_list = mysqli_fetch_array($sql_story_list)) {
    ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form first">
                <div class="details personal">
                    <input type="hidden" name="idtruyen" value="<?= $idtruyen ?>">
                    <p style="color:red" class="error">
                        <?php
                        if (isset($errorregister)) {
                            echo $errorregister;
                        } ?> </p>
                    <div class="fields">
                        <div class="input-field">
                            <label>T??n Truy???n</label>
                            <input type="text" placeholder="Nh???p t??n truy???n" name="name" required oninvalid="this.setCustomValidity('t??n th??? lo???i kh??ng ???????c tr???ng')" onchange="this.setCustomValidity('')" value="<?= $row_story_list['name'] ?>">
                        </div>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>H??nh ???nh truy???n</label>
                            <div style="display: flex; align-items: center;">
                                <input type="file" name="image" id="imagename" accept="image/*" onchange="loadFile(event)">
                                <img src="../StoryTrans/uploads/<?= $row_story_list['image'] ?>" class="image_src" alt="" width="250px" height="250px" id="output">
                            </div>

                        </div>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>T??m t???t</label>
                            <textarea name="summary" rows="4" cols="50" oninvalid="this.setCustomValidity('n???i dung kh??ng ???????c tr???ng')" onchange="this.setCustomValidity('')" required><?= $row_story_list['summary'] ?></textarea>
                        </div>
                        <script>
                            CKEDITOR.replace('summary');
                        </script>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>T??c gi???</label>
                            <input type="text" placeholder="Nh???p t??n t??c gi???" name="author" required oninvalid="this.setCustomValidity('t??n th??? lo???i kh??ng ???????c tr???ng')" onchange="this.setCustomValidity('')" value="<?= $row_story_list['author'] ?>">
                        </div>
                    </div>
                    <div class="fields">
                        <label>Tr???ng th??i</label>
                        <select name="status" id="" style="width: 100%;">
                            <option value="0" <?php if ($row_story_list['status'] == 0) echo 'selected' ?>>Ch??a ho??n th??nh</option>
                            <option value="1" <?php if ($row_story_list['status'] == 1) echo 'selected' ?>>ho??n th??nh</option>

                        </select>
                    </div>
                    <div class="fields">
                        <label>Ki???u truy???n</label>
                        <select name="type" id="" style="width: 100%;">
                            <option value="0" <?php if ($row_story_list['type'] == 0) echo 'selected' ?>>Truy???n ch???</option>
                            <option value="1" <?php if ($row_story_list['type'] == 1) echo 'selected' ?>>Truy???n tranh</option>

                        </select>
                    </div>
                    <div class="fields">
                        <div class="input-field">
                            <label>T??n nh??m d???ch</label>
                            <input type="text" placeholder="Nh???p t??n th??? lo???i" name="usernametrans" value="<?= $_SESSION['logintrans'] ?>" readonly>
                        </div>
                    </div>
                    <div class="fields">
                        <?php
                        $idtruyen = $_GET['idtruyen'];
                        $sql_list = mysqli_query($con, "SELECT * FROM tbl_story_category WHERE idtruyen='$idtruyen'");
                        $uh_array = [];
                        foreach ($sql_list as $rowlist) {
                            array_push($uh_array, $rowlist['idcategory']);
                        }
                        ?>
                        <label for="">Th??? lo???i </label>
                        <select name="categorystory[]" id="" class="multiple-select" multiple style="width: 100%; " data-placeholder='C?? th??? ch???n 1 ho???c nhi???u th??? lo???i'>
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
                    <input type="submit" value="S???a" name="insert" class="btn btn-primary mt-3">
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