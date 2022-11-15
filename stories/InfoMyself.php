<?php
include './ConnectDatabase.php';

include './inc/header.php';
include './inc/menu.php';

?>
<div class="row">
    <div class="container col-5" style="width: 50%; margin-top:30px; margin-bottom:30px;">
        <h1 class="text-center mb-3" style="color:red; font-size: 28px; text-transform: uppercase;">Thông tin cá nhân của tài khoản</h1>
        <?php
        $username = $_SESSION['loginuser'];
        $sql_acount = mysqli_query($con, "SELECT * FROM `tbl_accountuser` WHERE username='$username'");
        while ($row_acount = mysqli_fetch_array($sql_acount)) {
        ?>
            <form>
                <div class="form-group">
                    <label>Tên</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="<?= $row_acount['name'] ?>" readonly>

                </div>
                <div class="form-group">
                    <label>Tên đăng nhập</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" value="<?= $row_acount['username'] ?>" readonly>

                </div>
                <div class="form-group">
                    <label>Địa chỉ email</label>
                    <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="<?= $row_acount['email'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Tiền hiện tại của bạn</label>
                    <input type="text" class="form-control" id="money" name="money" aria-describedby="emailHelp" value="<?= $row_acount['money'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Tiền đã nạp</label>
                    <input type="text" class="form-control" id="summoney" name="summoney" aria-describedby="emailHelp" value="<?= $row_acount['summoney'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Level hiện tại</label>
                    <input type="text" class="form-control" id="level" name="level" aria-describedby="emailHelp" value="<?= $row_acount['level'] ?>" readonly>
                </div>

            </form>

    </div>
    <div class="col-4" style="margin-top:30px ;font-size: 18px;">
        <h1 style="font-size: 25px;margin-left: -10px;text-transform: uppercase;">Cấp hiện tại của mạo hiểm giả</h1>
        <?php
            $money = "";
            for ($i = 0; $i <= 7; $i++) {
                if ($i == 1) {
                    $money = 'Hạn mức nạp ít hơn 10k';
                } else if ($i == 2) {
                    $money = 'Hạn mức nạp 10k đến 50k';
                } else if ($i == 3) {
                    $money = 'Hạn mức nạp 50k đến 100k';
                } else if ($i == 4) {
                    $money = 'Hạn mức nạp 100k đến 200k';
                } else if ($i == 5) {
                    $money = 'Hạn mức nạp 200k đến 500k';
                } else if ($i == 6) {
                    $money = 'Hạn mức nạp 500k đến 1 triệu';
                } else if ($i == 7) {
                    $money = 'Hạn mức nạp lớn hơn 1 triệu';
                }

                if ($i == 0) {
                    echo '<p style="color:blue;margin-top:35px;">cấp 0</p>';
                } else if ($i <= $row_acount['level']) { ?>
                <p style="color:blue;"><i class="fa-solid fa-arrow-down mt-1 mb-1" style="display: block; margin-left: 15px;"></i>cấp <?= $i . ' ' . $money ?></p>

            <?php
                } else { ?>
                <p style="color:gray;"><i class="fa-solid fa-arrow-down mt-1 mb-1" style="display: block; margin-left: 15px;"></i>cấp <?= $i . ' ' . $money  ?></p>
    <?php
                }
            }
        } ?>
    </div>
</div>
<?php
include './inc/footer.php';
?>