<?php
ob_start();
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<?php
if (isset($_POST['edit'])) {
    $name =  mysqli_real_escape_string($con, $_POST['name']);


    $sql_check_cate = mysqli_query($con, "SELECT * FROM tbl_category WHERE name = '$name' LIMIT 1");
    $count = mysqli_num_rows($sql_check_cate);
    if ($count > 0) {
        $errorregister = 'Tên thể loại đã có';
    } else {
        $id = $_GET['id'];
        $sql_edit_cate = mysqli_query($con, "UPDATE tbl_category SET name='$name' WHERE idcategory='$id'");

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
                <h1>SỬA THỂ LOẠI</h1>
                <a href="../page/categorystory.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->

<!-- insert category -->
<?php
$id = $_GET['id'];
$sql_cate_edit = mysqli_query($con, "SELECT * FROM tbl_category WHERE idcategory='$id' LIMIT 1");
$row_cate_edit = mysqli_fetch_array($sql_cate_edit);
?>
<div class="container">
    <form action="./editcategory.php?id=<?= $row_cate_edit['idcategory'] ?>" method="post">
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
                        <input type="text" placeholder="Nhập tên thể loại" name="name" required oninvalid="this.setCustomValidity('tên thể loại không được trống')" onchange="this.setCustomValidity('')" value="<?= $row_cate_edit['name'] ?>">
                    </div>
                </div>
                <input type="submit" value="Sửa" name="edit" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>

<!-- end insert news -->
<?php
include '../inc/footer.php';
?>