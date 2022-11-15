<?php
ob_start();
session_start();
include './../Database/Connect.php';

require_once 'google-api-php-client-2.4.0/vendor/autoload.php';
$client = new Google_Client();
$client->setClientId('556595615456-ekjhs14amp43a3mnodifth42uoag64oa.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost:8088/StoryAndAnime/stories/LoginGoogle.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

    $client->setAccessToken($token['access_token']);

    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;


    $check =  mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE email = '$email'");
    $row = mysqli_fetch_array($check);
    $rowcount = mysqli_num_rows($check);
    if ($rowcount > 0) {
        $_SESSION['loginuser'] = $row['username'];
        $_SESSION['setloading'] = 'isset';
        header('Location:HomeStory.php');
        die();
    } else {
        $sql_insert_acount = mysqli_query($con, "INSERT INTO tbl_accountuser(username, password, email, money,name) VALUES('$email',md5(123),'$email',1000,'$name') ");
        // $succes = 'đăng ký thành công';
        $_SESSION['loginuser'] = $email;
        $_SESSION['setloading'] = true;
        header('Location:HomeStory.php');
        die();
    }
} else {
    header('location: ' . $client->createAuthUrl());
}
