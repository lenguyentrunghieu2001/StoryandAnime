<?php
ob_start();
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<?php
if (isset($_POST['insert'])) {
    $chap =  mysqli_real_escape_string($con, $_POST['chap']);
    $title =  mysqli_real_escape_string($con, $_POST['title']);
    $content_chapter =  mysqli_real_escape_string($con, $_POST['content_chapter']);
    $money =  mysqli_real_escape_string($con, $_POST['money']);
    $datechap = $_POST['datechap'];
    $idtruyen =   $_GET['idtruyen'];
    // $categorystory =  $_POST['categorystory'];


    $sql_check_chapter = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE chap = '$chap' AND idtruyen='$idtruyen' LIMIT 1");
    $count = mysqli_num_rows($sql_check_chapter);
    if ($count > 0) {
        $errorregister = 'Chap của truyện đã có';
    } else {
        $sql_insert_chapter  = mysqli_query($con, "INSERT INTO tbl_chapter(chap, content, money, title, idtruyen, datechap) VALUES ('$chap','$content_chapter','$money','$title','$idtruyen','$datechap')");


        header('location:../page/chaptertrans.php?idtruyen=' . $idtruyen);
        die();
        // exit;
    }
}
?>
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>THÊM CHAPTER</h1>
                <a href="../page/chaptertrans.php?idtruyen=<?= $_GET['idtruyen'] ?>"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->

<!-- insert story -->
<div style="width: 95%; margin: 30px auto;">
    <form action="" method="post">
        <div class="form first">
            <div class="details personal">
                <p style="color:red" class="error">
                    <?php
                    if (isset($errorregister)) {
                        echo $errorregister;
                    } ?> </p>
                <div class="fields">
                    <div class="input-field">
                        <label>Tên Chapter</label>
                        <input type="number" placeholder="Nhập số chap" name="chap" required oninvalid="this.setCustomValidity('tên thể loại không được trống')" onchange="this.setCustomValidity('')" value="<?= $chap ?? '' ?>">
                    </div>
                </div>
                <div class="fields">
                    <div class="input-field">

                        <label>Tiêu đề chapter</label>
                        <input type="text" placeholder="Nhập tiêu đề" name="title" required oninvalid="this.setCustomValidity('tiêu đề không được trống')" onchange="this.setCustomValidity('')" value="<?= $title ?? '' ?>">
                    </div>
                </div>
                <div class="fields">
                    <div class="input-field">
                        <label>Nội dung truyện</label>
                        <textarea name="content_chapter" rows="4" cols="50" required><?= $content_chapter ?? '' ?></textarea>
                    </div>
                    <script>
                        CKEDITOR.replace('content_chapter');
                    </script>
                </div>
                <div class="fields">
                    <div class="input-field">
                        <label>Số tiền</label>
                        <input type="number" placeholder="Nhập tiền chapter lưu ý 0 là free" name="money" required oninvalid="this.setCustomValidity('tên thể loại không được trống')" onchange="this.setCustomValidity('')" value="<?= $money ?? '' ?>">
                    </div>
                </div>

                <div class="fields">
                    <div class="input-field">
                        <label>Ngày đăng</label>
                        <input type="datetime-local" placeholder="Nhập ngày đăng" name="datechap" required oninvalid="this.setCustomValidity('ngày đăng không được trống')" onchange="this.setCustomValidity('')" value="<?= $datechap ?? '' ?>">
                    </div>
                </div>

                <input type="submit" value="Thêm" name="insert" class="btn btn-success mt-3">
            </div>
        </div>
    </form>
</div>
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