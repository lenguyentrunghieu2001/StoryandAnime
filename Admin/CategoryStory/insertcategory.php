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


    $sql_check_cate = mysqli_query($con, "SELECT * FROM tbl_category WHERE name = '$name' LIMIT 1");
    $count = mysqli_num_rows($sql_check_cate);
    if ($count > 0) {
        $errorregister = 'Tên thể loại đã có';
    } else {
        $sql_insert_cate = mysqli_query($con, "INSERT INTO tbl_category(name) VALUES('$name') ");

        header('location:../page/categorystory.php');
        die();
        // exit;
    }
}
?>
<!-- MAIN -->
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>THÊM THỂ LOẠI</h1>
                <a href="../page/categorystory.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->

<!-- insert category -->
<div class="container">
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
                        <label>Tên thể loại</label>
                        <input type="text" placeholder="Nhập tên thể loại" name="name" required oninvalid="this.setCustomValidity('tên thể loại không được trống')" onchange="this.setCustomValidity('')" value="<?= $name ?? '' ?>">
                    </div>
                </div>
                <input type="submit" value="Thêm" name="insert" class="btn btn-success">
            </div>
        </div>
    </form>
</div>

<!-- end insert news -->
<?php
include '../inc/footer.php';
?>