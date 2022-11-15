<?php
ob_start();
session_start();
include './../Database/Connect.php';
?>
<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);


    $sql_login = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username = '$username' and password = '$password'");
    if (empty($username) || empty($password)) {
        $error = "vui lòng nhập đầy đủ thông tin";
    } else {


        if ($count_login = mysqli_num_rows($sql_login) > 0) {
            $_SESSION['loginuser'] = $username;
            $_SESSION['setloading'] = 'isset';
            header('Location:HomeStory.php');
            die();
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
    <link rel="stylesheet" href="./../public/css/reset.css">
    <link rel="stylesheet" href="../public/css/login.css">
    <link rel="icon" type="image/x-icon" href="./../public/images/logo.jpg">
    <title>Login User</title>
    <style>
        body {
            margin: 0;
            color: #6a6f8c;

            font: 600 16px/18px 'Open Sans', sans-serif;
            background-image: url('../public/images/backgroundLogin.jpg');
            background-repeat: no-repeat;
            background-size: cover;

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



        /* CSS */
        .button-49,
        .button-49:after {
            width: 250px;
            height: 76px;
            line-height: 78px;
            font-size: 13px;
            font-family: 'Bebas Neue', sans-serif;
            /* background-color: #FF013C; */
            background: #FF013C 5%;

            /* background: linear-gradient(135deg, transparent 5%, #FF013C 5%); */
            border: 0;
            color: #fff;
            letter-spacing: 3px;
            box-shadow: 6px 0px 0px #00E6F6;
            outline: transparent;
            position: relative;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            /* font-weight: 500; */
        }

        .button-49:after {
            --slice-0: inset(50% 50% 50% 50%);
            --slice-1: inset(80% -6px 0 0);
            --slice-2: inset(50% -6px 30% 0);
            --slice-3: inset(10% -6px 85% 0);
            --slice-4: inset(40% -6px 43% 0);
            --slice-5: inset(80% -6px 5% 0);

            content: 'ALTERNATE TEXT';
            display: block;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(#00E6F6 3%, #00E6F6 5%, #FF013C 5%);
            text-shadow: -3px -3px 0px #F8F005, 3px 3px 0px #00E6F6;
            clip-path: var(--slice-0);
        }

        .button-49:hover:after {
            animation: 1s glitch;
            animation-timing-function: steps(2, end);
        }

        @keyframes glitch {
            0% {
                clip-path: var(--slice-1);
                transform: translate(-20px, -10px);
            }

            10% {
                clip-path: var(--slice-3);
                transform: translate(10px, 10px);
            }

            20% {
                clip-path: var(--slice-1);
                transform: translate(-10px, 10px);
            }

            30% {
                clip-path: var(--slice-3);
                transform: translate(0px, 5px);
            }

            40% {
                clip-path: var(--slice-2);
                transform: translate(-5px, 0px);
            }

            50% {
                clip-path: var(--slice-3);
                transform: translate(5px, 0px);
            }

            60% {
                clip-path: var(--slice-4);
                transform: translate(5px, 10px);
            }

            70% {
                clip-path: var(--slice-2);
                transform: translate(-10px, 10px);
            }

            80% {
                clip-path: var(--slice-5);
                transform: translate(20px, -10px);
            }

            90% {
                clip-path: var(--slice-1);
                transform: translate(-10px, 0px);
            }

            100% {
                clip-path: var(--slice-1);
                transform: translate(0);
            }
        }

        @media (min-width: 768px) {

            .button-49,
            .button-49:after {
                cursor: pointer;
                position: absolute;
                top: 30%;
                right: 5px;
                width: 260px;
                height: 86px;
                line-height: 88px;
            }
        }
    </style>
</head>

<body>
    <div class="foot">
        <button class="button-49" role="button" onclick="window.location.href='../StoryTranslates/page/hometrans.php'">BẠN MUỐN ĐĂNG TRUYỆN?</button>

    </div>
    <div class="row">
        <div class="col-md-6 mx-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip">
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Đăng Nhập</label>
                        <div class="login-space">
                            <p style="color:red" class="error"><?php
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
                                    <a href="./Mail/CheckMail.php" style="color: blue; margin-left: 5px;">Quên mật khẩu</a>
                                    <div class="group  mt-4" style="display: flex; cursor: pointer;">
                                        <input type="submit" class="button mr-2" value="Đăng nhập" name="login">
                                        <img src="./../public/images/google.jpg" alt="" onclick="window.location.href='./LoginGoogle.php'" height="50" style="border-radius: 30px;">
                                    </div>

                                    <div class="foot">
                                        <a href="RegisterUser.php" style=" color: #160d0d; text-shadow: 1px 2px 3px Indigo; margin-top:50px; font-weight:600;">Bạn chưa có tài khoản ?</a>
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