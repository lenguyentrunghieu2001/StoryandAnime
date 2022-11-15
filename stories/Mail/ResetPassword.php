<?php
ob_start();
include '../../Database/Connect.php';

$code = $_GET['code'];
$email = $_GET['email'];
$sql_check = mysqli_query($con, "SELECT * FROM tbl_accountuser  WHERE email='$email' AND code='$code'");
if (mysqli_num_rows($sql_check) > 0) {
    if (isset($_POST['change'])) {
        $password = md5($_POST['password']);
        $sql_update = mysqli_query($con, "UPDATE tbl_accountuser SET password='$password' WHERE email='$email' AND code='$code'");
        $hate = 'Đổi mật khẩu thành công';
    }
} else {
    $hate = 'Bạn bị sai mã code vui lòng check mail lại';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body style="background-image: url(../../public/images/backgroundLogin.jpg); background-size: cover; color:white;text-shadow: 1px 2px 3px Indigo">
    <div class="container" style="margin: 150px auto;width: 50%;">
        <form method="post">
            <p style="color:chartreuse;"><?php if (isset($hate)) {
                                                echo $hate;
                                            } ?></p>
            <h1 style="color: white;font-size:43px;">ĐỔI MẬT KHẨU</h1>
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Nhập gmail" name="email" value="<?= $email ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mật khẩu mới</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nhập mật khẩu" name="password">
            </div>
            <button type="submit" class="btn btn-success" name="change">Đổi mật khẩu</button>
            <a class="btn btn-danger" onclick="window.location.href='../LoginUser.php'">Quay lại trang đăng nhập</a>
        </form>
    </div>
</body>

</html>