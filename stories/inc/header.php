<?php
ob_start();
session_start();
if (!isset($_SESSION['loginuser'])) {
    header('location: LoginUser.php');
    die();
}
?>
<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['loginuser']);
    unset($_SESSION['setloading']);
    unset($_SESSION['query']);
    unset($_SESSION['querychapter']);

    header('location: LoginUser.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./../public/images/logo.jpg">
    <!-- Bootstraps -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">
    <!-- css -->
    <link rel="stylesheet" href="../public/css/loader.css">
    <link rel="stylesheet" href="../public/css/reset.css">
    <link rel="stylesheet" href="../public/css/header.css">
    <link rel="stylesheet" href="../public/css/menu.css">
    <link rel="stylesheet" href="../public/css/user_css/HomeStory.css">
    <link rel="stylesheet" href="../public/css/hovermouse.css">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link rel="stylesheet" href="../public/css/user_css/sidebar.css">
    <link rel="stylesheet" href="../public/css/user_css/DetailStory.css">
    <link rel="stylesheet" href="../public/css/user_css/ChapterStory.css">
    <link rel="stylesheet" href="../public/css/user_css/loadingmoney.css">
    <link rel="stylesheet" href="../public/css/user_css/NewsStory.css">


    <title>Web Truy??n Tranh HV</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script type="text/javascript" src="../public/js/turn.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<div class="header_user">
    <div class="container">
        <header class="row">
            <div class="logo_header col-md-4 col-sm-12 col-12" onclick="window.location.href='./HomeStory.php'">
                <img src="./../public/images/logo1.png" alt="">

            </div>
            <!-- search -->
            <div class="search-stories_header col-md-5 col-sm-8 col-8">
                <?php include 'searchstory.php'; ?>
            </div>
            <!--end search -->

            <div class=" user-info_header col-md-3 col-sm-12 col-12">
                <div class="name-user">
                    <div class="row">
                        <?php
                        $nameacount = $_SESSION['loginuser'];
                        $sql_acount_user = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username = '$nameacount'");
                        while ($row_acount_user = mysqli_fetch_array($sql_acount_user)) {
                        ?>
                            <button class="btn btn-primary col-6" onclick="window.location.href='../stories/InfoMyself.php'" style="display: flex; align-items: center ; justify-content: center;font-size: 14px;" data-toggle="tooltip" data-placement="top" title="<?= number_format($row_acount_user['money']) . ' ??'  ?>">

                                <img src="./../public/images/xu.png" alt="" style="width: 30px;height: 30px; margin-bottom: 0;"> <?= number_format($row_acount_user['money']) . ' ??' ?>

                            </button>
                            <button class="btn btn-info col-5 ml-2" onclick="window.location.href='../stories/InfoMyself.php'" style="display: flex; align-items: center ;justify-content: center;font-size: 14px;" data-toggle="tooltip" data-placement="top" title="<?= $row_acount_user['name'] ?>">
                                <i class="fa-solid fa-user mr-1"></i> <?= $row_acount_user['name'] ?>
                            </button>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="logout-user" style="margin-left: -12px;">

                    <button class="btn btn-danger" onclick="location.href='DetailStory.php?dangxuat=1'" style=" font-size: 14px; height: 38px;"><i class="fa-sharp fa-solid fa-arrow-right-from-bracket"></i> ????ng xu???t</button>
                </div>
            </div>
        </header>

    </div>
</div>