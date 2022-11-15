<?php
ob_start();
session_start();
include '../../Database/Connect.php';
?>
<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    $sql_login = mysqli_query($con, "SELECT * FROM translate WHERE usernametrans = '$username' and password = '$password'");
    $row_login = mysqli_fetch_array($sql_login);
    if (empty($username) || empty($password)) {
        $error = "vui lòng nhập đầy đủ thông tin";
    } else {
        if ($count_login = mysqli_num_rows($sql_login) > 0) {
            if ($row_login['lockaccount'] == 1) {
                $_SESSION['logintrans'] = $username;
                header('Location: hometrans.php');
                die();
            } else if ($row_login['lockaccount'] == 0) {
                $error = "Tài khoản đang được duyệt vui lòng chờ thêm hoặc liên hệ với 0363151035";
            } else if ($row_login['lockaccount'] == 2) {
                $error = "Tài khoản của bạn đã bị khóa liên hệ với 0363151035";
            }
        } else {
            $error = "Tài khoản hoặc mật khẩu sai";
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
    <link rel="stylesheet" href="../../public/css/reset.css">
    <link rel="stylesheet" href="../../public/css/login.css">
    <link rel="icon" type="image/x-icon" href="../../public/images/logo.jpg">
    <title>Login User</title>
    <style>
        body {
            margin: 0;
            color: #6a6f8c;

            font: 600 16px/18px 'Open Sans', sans-serif;
            background-image: url('../../public/images/backgroundTrans.jpg');
            background-repeat: no-repeat;
            background-size: cover;

        }

        .login-snip .sign-in:checked+.tab,
        .login-snip .sign-up:checked+.tab {
            font-size: 28px;
        }

        button:focus {
            outline: none;
            border: none;
        }

        .login-box {
            min-height: 420px;
        }

        .card {
            top: 100px;
        }

        .error {
            top: -10px;
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-md-6 mx-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip">
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Đăng Nhập Nhóm Dịch</label>
                        <div class="login-space">
                            <p style="color:red" class="error">
                                <?php
                                if (isset($error)) {
                                    echo $error;
                                }
                                ?></p>
                            <form action="" method="post">
                                <div class="mt-4">
                                    <div class="group">
                                        <label for="user" class="label">Tài khoản</label>
                                        <div>
                                            <input id="user" type="text" class="input" placeholder="Nhập tên tài khoản" name="username">
                                        </div>
                                    </div>
                                    <div class="group">
                                        <label for="pass" class="label">Mật khẩu</label>
                                        <input id="pass" type="password" class="input" placeholder="Nhập mật khẩu" name="password">
                                    </div>
                                    <div class="group  mt-4">
                                        <input type="submit" class="button" value="Đăng nhập" name="login">
                                    </div>
                                    <div class="foot">
                                        <a href="RegisterTrans.php" style=" color: yellow; text-shadow: 1px 2px 3px Indigo; margin-top:50px; font-weight:600;">Bạn chưa có tài khoản ?</a>
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