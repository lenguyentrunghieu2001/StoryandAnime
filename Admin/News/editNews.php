<?php
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<!-- MAIN -->
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>SỬA TIN TỨC</h1>
                <a href="../page/news.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->
<!-- edit news -->
<?php
$id = $_GET['id'];
$sql_news = mysqli_query($con, "SELECT * FROM tbl_news WHERE id='$id' LIMIT 1");
$row_news = mysqli_fetch_array($sql_news);
?>
<div class="container">
    <form action="./handleNews.php?edit=1" method="post">
        <div class="form first">
            <div class="details personal">

                <div class="fields">
                    <div class="input-field">
                        <input type="hidden" placeholder="Nhập tiêu đề bài viết" name="id" value="<?= $row_news['id'] ?>">
                    </div>
                    <div class="input-field">
                        <label>Tiêu đề bài viết</label>
                        <input type="text" placeholder="Nhập tiêu đề bài viết" name="title" required oninvalid="this.setCustomValidity('tiêu đề không được trống')" onchange="this.setCustomValidity('')" value="<?= $row_news['title'] ?>">
                    </div>

                    <div class="input-field">
                        <label>Ngày đăng</label>
                        <input type="datetime-local" placeholder="Nhập ngày đăng" name="datetime" required oninvalid="this.setCustomValidity('ngày đăng không được trống')" onchange="this.setCustomValidity('')" value="<?= $row_news['datetime'] ?>">
                    </div>
                    <div class="input-field">
                        <label>Người đăng</label>
                        <input type="text" name="author" value="<?= $row_news['author'] ?>">
                    </div>
                    <div class="input-field">
                        <label>Hình ảnh</label>
                        <div style="display: flex; align-items: center;">
                            <input type="text" placeholder="Nhập link hình ảnh " name="image" required style="width: 80%;" class="image" id="imagename" value="<?= $row_news['image'] ?>">
                            <a id="btnshow" class="btn btn-primary" style="margin: 0 20px; color:white">kiểm tra hình ảnh</a>
                            <img src="<?= $row_news['image'] ?>" class="image_src" alt="" width="150px" height="150px" id="image" oninvalid="this.setCustomValidity('link ảnh không được trống')" onchange="this.setCustomValidity('')">
                        </div>

                    </div>

                    <div class="input-field">
                        <label>Nội dung bài viết</label>
                        <textarea name="contentnews" rows="4" cols="50" oninvalid="this.setCustomValidity('nội dung không được trống')" onchange="this.setCustomValidity('')" required><?= $row_news['content'] ?></textarea>
                    </div>
                    <script>
                        CKEDITOR.replace('contentnews');
                    </script>
                </div>

                <div class="buttons">
                    <button class="sumbit">
                        <span class="btnText">Sửa</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>
            </div>

    </form>
</div>
<script type="text/javascript">
    document.getElementById('btnshow').onclick = function() {
        img = document.createElement('img');
        document.getElementById('image').src = document.getElementById('imagename').value;
        document.body.appendChild(img);
    }
</script>

<!-- end insert news -->
<?php
include '../inc/footer.php';
?>