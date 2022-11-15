<?php
ob_start();

include  "PHPMailer/src/PHPMailer.php";
include  "PHPMailer/src/Exception.php";
include  "PHPMailer/src/OAuthTokenProvider.php";
include  "PHPMailer/src/OAuth.php";
include  "PHPMailer/src/POP3.php";
include  "PHPMailer/src/SMTP.php";
include '../../Database/Connect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['check'])) {
    $mail = new PHPMailer(true);
    $email = $_POST['email'];
    $code = rand(0, 1000000);

    // Passing `true` enables exceptions
    try {
        $sql_taikhoan = mysqli_query($con, "UPDATE tbl_accountuser SET code='$code' WHERE email='$email'");
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'lenguyentrunghieu2001@gmail.com';                 // SMTP username
        $mail->Password = 'utcmlhphivfsxzzh';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('lenguyentrunghieu2001@gmail.com', 'Mailer');
        $mail->addAddress($email);     // Add a recipient
        // $mail->addAddress('lenguyentrunghieu2001@gmail.com');     // Add a recipient

        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'New password';
        $mail->Body    = 'http://localhost:8088/StoryAndAnime/stories/Mail/ResetPassword.php?code=' . $code . '&email=' . $email;

        $mail->send();
        $hate = 'Vui lòng kiểm tra gmail';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
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
    <div class="container" style="margin: 150px auto;width: 40%;">
        <form method="post">
            <p style="color:chartreuse;"><?php if (isset($hate)) {
                                                echo $hate;
                                            } ?></p>
            <h1 style="color: white;font-size:43px;">TRANG QUÊN MẬT KHẨU</h1>
            <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" id="exampleInputPassword1" placeholder="Nhập gmail của bạn" name="email">
            </div>
            <button type="submit" class="btn btn-primary" name="check">kiểm tra</button>
            <a class="btn btn-danger" onclick="window.location.href='../LoginUser.php'">Quay lại trang đăng nhập</a>
        </form>
    </div>
</body>

</html>