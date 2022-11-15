<?php
ob_start();
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<link rel="stylesheet" href="../../public/admin/css/news.css">
<?php

?>
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>THÊM TÀI KHOẢN</h1>
                <a href="../page/account.php"><i class="fa-sharp fa-solid fa-rotate-left"></i> Quay lại</a>
            </div>
        </div>
    </div>

</main>
<!--end MAIN -->
<!-- edit account -->
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
                        <label>Tên đăng nhập</label>
                        <input type="text" placeholder="Nhập tên đăng nhập" name="usernametrans" required oninvalid="this.setCustomValidity('tên đăng nhập không được trống')" onchange="this.setCustomValidity('')" value="<?= $usernametrans ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label>mật khẩu</label>
                        <input type="text" placeholder="Nhập mật khẩu" name="password" required oninvalid="this.setCustomValidity('mật khẩu không được trống')" onchange="this.setCustomValidity('')" value="<?= $password ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label>email</label>
                        <input type="email" placeholder="Nhập email" name="email" required value="<?= $email ?? '' ?>">
                    </div>

                    <div class="input-field">
                        <label>Số điện thoại</label>
                        <input type="tel" placeholder="Nhập số điện thoại" name="phone" placeholder="888 888 8888" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" maxlength="11" title="nhập đủ 10 số" required value="<?= $phone ?? '' ?>">
                    </div>
                    <div class="input-field">
                        <label>Thông tin ngân hàng</label>
                        <input type="text" placeholder="Nhập số thông tin ngân hàng" name="Bankcard" required oninvalid="this.setCustomValidity('thông tin ngân hàng không được trống')" onchange="this.setCustomValidity('')" value="<?= $Bankcard ?? '' ?>">
                    </div>


                    <input type="submit" value="Thêm" name="insert" class="btn btn-success">
                </div>

    </form>
</div>

<!-- end insert news -->
<?php
include '../inc/footer.php';
?>