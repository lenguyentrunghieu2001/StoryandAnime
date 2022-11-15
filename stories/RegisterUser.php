<?php
ob_start();
session_start();
include './../Database/Connect.php';
?>
<!-- register  -->

<?php
if (isset($_POST['register'])) {
    $username =  mysqli_real_escape_string($con, $_POST['username']);
    $email =  mysqli_real_escape_string($con, $_POST['email']);
    $password =  mysqli_real_escape_string($con, $_POST['password']);
    $rpassword =  mysqli_real_escape_string($con, $_POST['rpassword']);
    $name =  mysqli_real_escape_string($con, $_POST['name']);

    if (empty($username) || empty($password) || empty($email) || empty($rpassword) || $password != $rpassword || empty($name)) {
        if (empty($username)) {
            $errorregister = 'bạn chưa nhập username';
        }
        if (empty($name)) {
            $errorregister0 = 'bạn chưa nhập tên';
        }
        if (empty($password)) {
            $errorregister2 = 'bạn chưa nhập password';
        }
        if (empty($email)) {
            $errorregister3 = 'bạn chưa nhập email';
        }
        if (empty($rpassword)) {
            $errorregister4 = 'bạn chưa nhập xác nhận mật khẩu';
        }
        if ($password != $rpassword) {
            $errorregister5 = 'xác nhận password không trùng password';
        }
    } else {
        $sql_check_username = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username = '$username' OR email = '$email' LIMIT 1");
        $count = mysqli_num_rows($sql_check_username);
        if ($count > 0) {
            $errorregister6 = 'bị trùng username hoặc email';
        } else {
            $sql_insert_acount = mysqli_query($con, "INSERT INTO tbl_accountuser(username, password, email, money,name) VALUES('$username',md5('$password'),'$email',1000,'$name') ");
            // $succes = 'đăng ký thành công';
            $_SESSION['loginuser'] = $username;
            $_SESSION['setloading'] = true;
            header('Location:HomeStory.php');
            die();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./../public/css/reset.css">

    <link rel="icon" type="image/x-icon" href="./../public/images/logo.jpg">

    <link rel="stylesheet" href="../public/css/login.css">
    <title>Login User</title>
    <style>
        body {
            margin: 0;
            color: #6a6f8c;
            font: 600 16px/18px 'Open Sans', sans-serif;
            background-image: url('../public/images/backgroundLogin.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;

        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-6 mx-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip">
                        <input id="tab-2" type="radio" name="tab" class="sign-up" checked><label for="tab-2" class="tab">Đăng Ký</label>
                        <div class="login-space">
                            <!-- register -->
                            <form action="" method="post" autocomplete="off">
                                <div class=" mt-4">
                                    <p style="color:green" class="error">
                                        <?php
                                        if (isset($succes)) {
                                            echo $succes;
                                        }
                                        ?>
                                    </p>
                                    <p style="color:red" class="error">
                                        <?php
                                        if (isset($errorregister0)) {
                                            echo $errorregister0;
                                        } ?> </p>
                                    <div class="group">
                                        <label for="name" class="label">Họ tên</label>
                                        <input id="name" type="text" class="input" placeholder="Nhập tên của bạn" name="name" value="<?= $name ?? '' ?>">
                                    </div>
                                    <p style="color:red" class="error">
                                        <?php
                                        if (isset($errorregister)) {
                                            echo $errorregister;
                                        }
                                        if (isset($errorregister6)) {
                                            echo $errorregister6;
                                        }
                                        ?>
                                    </p>
                                    <div class="group">
                                        <label for="user" class="label">Tài khoản</label>
                                        <input id="user" type="text" class="input" placeholder="Nhập tên tài khoản" name="username" value="<?= $username ?? '' ?>" pattern="(?=.*\d)(?=.*[a-z]).{5,}" title="vui lòng nhập ít nhất 5 chữ cái trở lên trong đó chứa 1 số và 1 chữ cái">
                                    </div>

                                    <p style=" color:red" class="error">
                                        <?php
                                        if (isset($errorregister3)) {
                                            echo $errorregister3;
                                        }

                                        ?>
                                    </p>
                                    <div class="group">
                                        <label for="email" class="label">Email của bạn</label>
                                        <input type="email" class="input" value="<?= $email ?? '' ?>" placeholder=" Nhập vào email" name="email">
                                    </div>

                                    <p style="color:red" class="error">
                                        <?php
                                        if (isset($errorregister2)) {
                                            echo $errorregister2;
                                        }
                                        ?>
                                    </p>
                                    <div class="group">
                                        <label for="pass" class="label">Mật khẩu</label>
                                        <input id="pass" type="password" class="input" data-type="password" placeholder="Nhập mật khẩu" name="password" value="<?= $password ?? '' ?>">
                                    </div>

                                    <div class="group">
                                        <p style="color:red" class="error">
                                            <?php
                                            if (isset($errorregister4)) {
                                                echo $errorregister4;
                                            }
                                            ?>
                                            <br>
                                            <?php
                                            if (isset($errorregister5)) {
                                                echo $errorregister5;
                                            }
                                            ?>
                                        </p>
                                        <label for="rpass" class="label">mật khẩu</label>
                                        <input id="rpass" type="password" class="input" placeholder="Nhập lại mật khẩu" name="rpassword" value="<?= $rpassword ?? '' ?>">
                                    </div>

                                    <div class="group">
                                        <label style="color: white; text-shadow: 1px 2px 3px Indigo;">Khuyến mãi</label>
                                        <input name="money" value="1000" disabled style="width: 50px;">
                                        <label style="color: white; text-shadow: 1px 2px 3px Indigo;">đồng khi tạo tài khoản</label>

                                    </div>
                                    <div class="group mt-4">
                                        <input type="submit" class="button" value="Đăng ký" name="register">
                                    </div>
                                    <div class="foot">
                                        <a href="LoginUser.php" style="color: #160d0d; text-shadow: 1px 2px 3px Indigo; margin-top:50px; font-weight:600;">Bạn đã có tài khoản ?</a>
                                    </div>
                                    <div class="hr">

                                    </div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>