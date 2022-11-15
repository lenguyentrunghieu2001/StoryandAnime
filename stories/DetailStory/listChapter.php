<div class="list-chapter-story">
    <h1>DANH SÁCH CHAPTER</h1>
    <div class="chapter-story">
        <?php

        $idtruyen = $_GET['id'];
        $taikhoanuser = $_SESSION['loginuser'];
        $sql_list_chapter = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE idtruyen='$idtruyen' ORDER BY idchap DESC");
        $i = 0;
        while ($row_list_chapter = mysqli_fetch_array($sql_list_chapter)) {
            $i++;
            $idchap = $row_list_chapter['idchap'];
        ?>
            <div class="chapter-story-item">
                <div style="display: flex; align-items: center; justify-content: space-between;" class="col-10">
                    <div class="name-chapter-story-item">Chapter <?= $row_list_chapter['chap'] ?></div>
                    <div class="name-chapter-story-item"><?= $row_list_chapter['title'] ?></div>

                    <div class="date-chapter-story-item">
                        <?php $datechap = $row_list_chapter['datechap'];
                        echo date("d-m-Y", strtotime($datechap)); ?></div>
                </div>
                <?php
                $sql_taikhoan = mysqli_query($con, "SELECT * FROM tbl_accountuser WhERE username='$taikhoanuser' LIMIT 1");
                $row_taikhoan = mysqli_fetch_array($sql_taikhoan);
                $sql_chapter_taikhoan = mysqli_query($con, "SELECT * FROM tbl_chapter_taikhoan WHERE idchap ='$idchap' AND taikhoanuser = '$taikhoanuser'");
                if ($count = mysqli_num_rows($sql_chapter_taikhoan) > 0 || $row_list_chapter['money'] == 0) {
                ?>
                    <button class="btn btn-success col-1" style="width: 80px;" onclick="window.location.href='./Chapter/handleHistoryChap.php?idchap=<?= $idchap ?>&taikhoanuser=<?= $taikhoanuser ?>&idtruyen=<?= $_GET['id'] ?>'">
                        Đọc
                    </button>
                    <?php
                } else {
                    if ($row_taikhoan['money'] >= $row_list_chapter['money']) {
                    ?>
                        <button class="btn btn-secondary col-1" style="width: 80px;" data-toggle="modal" data-target="#exampleModal<?= $i ?>">
                            <?= $row_list_chapter['money'] ?>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="color:black">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Mua chapter</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Chap có giá <?= $row_list_chapter['money'] ?> và tài khoản hiện tại bạn đang còn <?= $row_taikhoan['money'] ?>đ
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Không</button>
                                        <button type="button" class="btn btn-primary" onclick="window.location.href='DetailStory/lockKeyChapter.php?idchap=<?= $idchap ?>&taikhoanuser=<?= $taikhoanuser ?>&id=<?= $_GET['id'] ?>'">Mua</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <button class="btn btn-secondary col-1" style="width: 80px;" onclick="alert('tài khoản của bạn không đủ vui lòng nạp thêm')">
                            <?= $row_list_chapter['money'] ?>
                        </button>
                <?php
                    }
                }

                ?>
            </div>

        <?php
        }
        ?>
    </div>
</div>