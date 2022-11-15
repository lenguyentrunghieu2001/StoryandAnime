<?php
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">

<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>XEM TÀI KHOẢN</h1>
                <a href="../page/account.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->
<!-- edit account -->
<?php
$usernametrans = $_GET['usernametrans'];
$sql_trans = mysqli_query($con, "SELECT * FROM translate WHERE usernametrans='$usernametrans' LIMIT 1");
$row_trans = mysqli_fetch_array($sql_trans);
?>
<div class="container">
    <form action="" method="post">
        <div class="form first">
            <div class="details personal">

                <div class="fields">
                    <div class="input-field">
                        <label>Tên đăng nhập</label>
                        <input type="text" placeholder="Nhập tiêu đề bài viết" name="usernametrans" value="<?= $row_trans['usernametrans'] ?>" readonly>
                    </div>
                    <div class="input-field">
                        <label>email</label>
                        <input type="email" placeholder="Nhập email" name="email" required value="<?= $row_trans['email'] ?>">
                    </div>

                    <div class="input-field">
                        <label>Số điện thoại</label>
                        <input type="tel" placeholder="Nhập số điện thoại" name="phone" placeholder="888 888 8888" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" maxlength="11" title="nhập đủ 10 số" required value="<?= $row_trans['phone'] ?>">
                    </div>
                    <div class="input-field">
                        <label>Thông tin ngân hàng</label>
                        <input type="text" placeholder="Nhập số thông tin ngân hàng" name="Bankcard" required oninvalid="this.setCustomValidity('thông tin ngân hàng không được trống')" onchange="this.setCustomValidity('')" value="<?= $row_trans['Bankcard'] ?>">
                    </div>
                </div>

    </form>
</div>

<!-- end insert news -->
<?php
include '../inc/footer.php';
?>