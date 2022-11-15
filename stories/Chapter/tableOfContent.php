<?php
$idchap = $_GET['idchap'];
$idtruyen = $_GET['idtruyen'];
$taikhoanuser = $_SESSION['loginuser'];

$sql_chapter_name = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE idchap = '$idchap' LIMIT 1");
$row_chapter_name = mysqli_fetch_array($sql_chapter_name);
?>
Chapter <?= $row_chapter_name['chap'] ?><i class="fa-sharp fa-solid fa-hand-point-up ml-2"></i>
<ul>
    <?php
    $sql_list_chapter = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE idtruyen='$idtruyen' ORDER BY idchap DESC");
    while ($row_list_chapter = mysqli_fetch_array($sql_list_chapter)) {
        $idchap = $row_list_chapter['idchap'];
    ?>
        <li>
            <?php
            if ($row_chapter_name['idchap'] == $idchap) {
            ?>
                <div style="color:aquamarine">Chapter <?= $row_list_chapter['chap'] ?></div>
            <?php
            } else {
            ?>
                <div>Chapter <?= $row_list_chapter['chap'] ?></div>
            <?php
            }
            ?>
            <?php
            $sql_taikhoan = mysqli_query($con, "SELECT * FROM tbl_accountuser WhERE username='$taikhoanuser' LIMIT 1");
            $row_taikhoan = mysqli_fetch_array($sql_taikhoan);
            $sql_chapter_taikhoan = mysqli_query($con, "SELECT * FROM tbl_chapter_taikhoan WHERE idchap ='$idchap' AND taikhoanuser = '$taikhoanuser'");
            if ($count = mysqli_num_rows($sql_chapter_taikhoan) > 0 || $row_list_chapter['money'] == 0) {
            ?>
                <button class="btn btn-success" style="width: 80px;" onclick="window.location.href='./Chapter/handleHistoryChap.php?idchap=<?= $idchap ?>&taikhoanuser=<?= $taikhoanuser ?>&idtruyen=<?= $_GET['idtruyen'] ?>'">
                    Đọc
                </button>
                <?php
            } else {
                if ($row_taikhoan['money'] >= $row_list_chapter['money']) {
                ?>
                    <button class="btn btn-secondary" style="width: 80px;" onclick="if (confirm('Chap có giá <?= $row_list_chapter['money'] ?> và tài khoản hiện tại bạn đang còn <?= $row_taikhoan['money'] ?>đ')) {return window.location.href='DetailStory/lockKeyChapter.php?idchap=<?= $idchap ?>&taikhoanuser=<?= $taikhoanuser ?>&id=<?= $_GET['idtruyen'] ?>' }">
                        <?= $row_list_chapter['money'] ?>
                    </button>
                <?php
                } else {
                ?>
                    <button class="btn btn-secondary" style="width: 80px;" onclick="alert('tài khoản của bạn không đủ vui lòng nạp thêm')">
                        <?= $row_list_chapter['money'] ?>
                    </button>
            <?php
                }
            }

            ?>
        </li>
    <?php } ?>

</ul>