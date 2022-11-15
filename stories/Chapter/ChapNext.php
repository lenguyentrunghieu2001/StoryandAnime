<?php
$taikhoanuser = $_SESSION['loginuser'];
$idchap =  $_GET['idchap'];
$idtruyen = $_GET['idtruyen'];

$sql_isset_prev_chapter = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE idchap = '$idchap' LIMIT 1");
$row_isset_prev_chapter = mysqli_fetch_array($sql_isset_prev_chapter);

$chapprev = $row_isset_prev_chapter['chap'] + 1;
$sql_prev_chapter = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE chap = '$chapprev' AND idtruyen = '$idtruyen' LIMIT 1");
$row_prev_chapter = mysqli_fetch_array($sql_prev_chapter);


if ($countprev = mysqli_num_rows($sql_prev_chapter) > 0) {
    $sql_taikhoan = mysqli_query($con, "SELECT * FROM tbl_accountuser WhERE username='$taikhoanuser' LIMIT 1");
    $row_taikhoan = mysqli_fetch_array($sql_taikhoan);
    $sql_chapter_taikhoan = mysqli_query($con, "SELECT * FROM tbl_chapter_taikhoan WHERE idchap ='" . $row_prev_chapter['idchap'] . "' AND taikhoanuser = '$taikhoanuser'");

    if ($row_prev_chapter['money'] == 0 || $count = mysqli_num_rows($sql_chapter_taikhoan) > 0) { ?>
        <div class="option next-chapter" onclick="window.location.href='./Chapter/handleHistoryChap.php?idchap=<?= $row_prev_chapter['idchap'] ?>&taikhoanuser=<?= $taikhoanuser ?>&idtruyen=<?= $idtruyen ?>'"> Chương Sau <i class="fa-solid fa-arrow-right"></i></div>
        <?php
    } else {
        if ($row_taikhoan['money'] >= $row_prev_chapter['money']) {
        ?>
            <div class="option prev-chapter" onclick="if (confirm('Chap có giá <?= $row_prev_chapter['money'] ?> và tài khoản hiện tại bạn đang còn <?= $row_taikhoan['money'] ?>đ')) {return window.location.href='DetailStory/lockKeyChapter.php?idchap=<?= $row_prev_chapter['idchap'] ?>&taikhoanuser=<?= $taikhoanuser ?>&id=<?= $idtruyen ?>' }">Chương Sau <i class="fa-solid fa-arrow-right"></i></div>
        <?php
        } else { ?>

            <div class="option prev-chapter" onclick="alert('tài khoản của bạn không đủ vui lòng nạp thêm')">Chương Sau <i class="fa-solid fa-arrow-right"></i></div>
    <?php
        }
    }
    ?>


<?php
} else {
?>
    <div class="option prev-chapter" style="opacity: 0.5;">Hết chương<i class="fa-solid fa-arrow-right"></i> </div>

<?php
}
