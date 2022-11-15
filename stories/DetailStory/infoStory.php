<div class="info-main-story">
    <div class="row">
        <!-- thông tin bên phải -->
        <div class="col-3">
            <div>
                <img src="./../StoryTranslates/StoryTrans/uploads/<?= $row_detail_story['image'] ?>" alt="" class="w-100 h-100">
            </div>
            <!-- theo dõi -->
            <?php
            $acount_user = $_SESSION['loginuser'];
            $id = $row_detail_story['id'];
            $sql_follow_story = mysqli_query($con, "SELECT * FROM tbl_follow WHERE taikhoanuser = '$acount_user' AND idtruyen = '$id'");
            if ($count = mysqli_num_rows($sql_follow_story) > 0) {
            ?>
                <button class="follow btn btn-danger w-100" onclick="window.location.replace('DetailStory/handleFollowStory.php?xuly=0&id=<?= $id ?>&acount=<?= $acount_user ?>')">
                    Đang Theo dõi
                </button>
            <?php
            } else {
            ?>
                <button class="follow btn btn-primary w-100" onclick="window.location.replace('DetailStory/handleFollowStory.php?id=<?= $id ?>&acount=<?= $acount_user ?>')">
                    Theo dõi
                </button>
            <?php
            }
            ?>
            <!--end theo dõi -->
            <div class=" w-100 status-story">
                <div>Tình trạng: </div>
                <?php
                if ($row_detail_story['status'] == 0) {
                ?>
                    <div>Chưa hoàn thành</div>
                <?php
                } else {
                ?>
                    <div>hoàn thành</div>
                <?php
                }
                ?>
            </div>
        </div>
        <!--end thông tin bên phải -->

        <!-- thông tin bên trái -->

        <div class="col-9">
            <div class="name-story">
                <?= $row_detail_story['name'] ?>
            </div>
            <!-- like -->
            <div class="like">
                <?php

                $sql_like_story = mysqli_query($con, "SELECT * FROM tbl_like WHERE taikhoanuser = '$acount_user' AND idtruyen = '$id'");
                if ($count = mysqli_num_rows($sql_like_story) > 0) {
                ?>

                    <button class="btn-primary mt-2 mb-2" onclick="window.location.replace('DetailStory/likeStory.php?xuly=0&id=<?= $id ?>&acount=<?= $acount_user ?>')"><i class="fa-regular fa-thumbs-up"></i>Đã Like</button>


                <?php
                } else {
                ?>
                    <button class="btn-primary mt-2 mb-2" onclick="window.location.replace('DetailStory/likeStory.php?id=<?= $id ?>&acount=<?= $acount_user ?>')"><i class="fa-regular fa-thumbs-up"></i>Like</button>


                <?php
                }
                ?>
                <span>
                    <?php
                    $sql_like = mysqli_query($con, "SELECT * FROM tbl_like WHERE idtruyen='$id' GROUP BY id");
                    $count_like = mysqli_num_rows($sql_like);
                    ?>
                    <?= $count_like ?>
                    <?php


                    ?>
                </span>
            </div>
            <!-- end like -->
            <!-- star -->
            <div style="display: flex; justify-content: space-between;">
                <?php
                $sql_avg_star_history = mysqli_query($con, "SELECT ROUND(AVG(star),1) AS 'avgstar' ,COUNT(star) AS 'count' FROM tbl_star_story WHERE  idtruyen='$idtruyen' GROUP BY idtruyen");
                if ($count_star = mysqli_num_rows($sql_avg_star_history) > 0) {
                    while ($row_avg_star_history = mysqli_fetch_array($sql_avg_star_history)) {

                ?>
                        <div style="display:flex">

                            <div id="rateYo"></div><span style="margin-top: 5px;"><?= $row_avg_star_history['avgstar'] . ' sao và ' . $row_avg_star_history['count'] ?> người đã đánh giá </span>
                        </div>
                        <script>
                            $(function() {

                                $("#rateYo").rateYo({
                                    rating: <?= $row_avg_star_history['avgstar'] ?>,
                                    readOnly: true

                                });
                                var starWidth = $("#rateYo").rateYo("option", "starWidth"); //returns 40px
                                // Setter
                                $("#rateYo").rateYo("option", "starWidth", "20px"); //returns a jQuery Element

                            });
                        </script>
                    <?php
                    }
                } else {
                    ?>

                    <div style="display:flex">
                        <div id="rateYo"></div><span style="margin-top: 5px;">0 và chưa ai đánh giá</span>
                    </div>
                    <script>
                        $(function() {

                            $("#rateYo").rateYo({
                                rating: 0,
                                readOnly: true

                            });
                            var starWidth = $("#rateYo").rateYo("option", "starWidth"); //returns 40px
                            // Setter
                            $("#rateYo").rateYo("option", "starWidth", "20px"); //returns a jQuery Element

                        });
                    </script>

                <?php
                }
                ?>
                <div style="display: flex;">
                    <?php
                    $idtruyen = $_GET['id'];
                    $username = $_SESSION['loginuser'];
                    $sql_star_history = mysqli_query($con, "SELECT * FROM tbl_star_story WHERE username='$username' AND idtruyen='$idtruyen'");
                    if ($count = mysqli_num_rows($sql_star_history) > 0) {
                        while ($row_star_history = mysqli_fetch_array($sql_star_history)) {

                    ?>
                            <p class="mr-1" style="margin-top: 6px;">Đánh giá</p>
                            <select name="starinsert" id="starinsert" style="width: 100px; height:20px; " class="mt-1" onchange="changeFunc();">
                                <option>chưa có</option>
                                <option value="1" <?php if ($row_star_history['star'] == '1') echo ' selected="selected"'; ?>>1 sao</option>
                                <option value="2" <?php if ($row_star_history['star'] == '2') echo ' selected="selected"'; ?>>2 sao</option>
                                <option value="3" <?php if ($row_star_history['star'] == '3') echo ' selected="selected"'; ?>>3 sao</option>
                                <option value="4" <?php if ($row_star_history['star'] == '4') echo ' selected="selected"'; ?>>4 sao</option>
                                <option value="5" <?php if ($row_star_history['star'] == '5') echo ' selected="selected"'; ?>>5 sao</option>
                            </select>

                        <?php
                        }
                    } else {
                        ?>
                        <p class="mr-1" style="margin-top: 6px;">Đánh giá</p>
                        <select name="starinsert" id="starinsert" style="width: 100px; height:20px; " class="mt-1" onchange="changeFunc();">
                            <option>chưa có</option>
                            <option value="1">1 sao</option>
                            <option value="2">2 sao</option>
                            <option value="3">3 sao</option>
                            <option value="4">4 sao</option>
                            <option value="5">5 sao</option>
                        </select>
                    <?php
                    }
                    ?>
                    <script>
                        function changeFunc() {
                            var selectBox = document.getElementById("starinsert");
                            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                            window.location.replace('DetailStory/starstory.php?id=<?= $_GET['id'] ?>&username=<?= $_SESSION['loginuser'] ?>&star=' +
                                selectedValue)
                        }
                    </script>
                </div>
            </div>
            <!-- end star -->

            <div class=" summary-story">
                <div class="area-drawer" style="display: block;">
                    <p>Tóm tắt: </p>
                    <p style="margin-left: 4px;">
                        <?= $row_detail_story['summary'] ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-6 area-drawer author-story">
                    <p>Tác giả: </p>
                    <p><?= $row_detail_story['author'] ?></p>
                </div>
                <div class="col-6 area-drawer view-story">
                    <p>Lượt xem: </p>
                    <p><?= $row_detail_story['view'] ?></p>
                </div>
                <div class="col-6 area-drawer grouptrans-story">
                    <p>Nhóm dịch: </p>
                    <a href="./../stories/TransStory.php?usernametrans=<?= $row_detail_story['usernametrans'] ?>" class="name_trans">
                        <p><?= $row_detail_story['usernametrans'] ?></p>
                    </a>
                </div>
                <div class="col-6 area-drawer author-story">
                    <p>Kiểu truyện: </p>
                    <?php
                    if ($row_detail_story['type'] == 0) {
                    ?>
                        <p>Truyện chữ</p>
                    <?php
                    } else {
                    ?>
                        <p>Truyện tranh</p>

                    <?php
                    }
                    ?>
                </div>

            </div>
            <!-- thể  loại -->
            <div class="area-drawer category-story">
                <div class="row w-100">

                    <p class="col-3">Thể loại: </p>
                    <div class="col-8">
                        <?php
                        $idtruyen = $_GET['id'];
                        $sql_category_story = mysqli_query($con, "SELECT * FROM tbl_category INNER JOIN tbl_story_category ON tbl_category.idcategory = tbl_story_category.idcategory WHERE tbl_story_category.idtruyen = '$id'");
                        while ($row_category_story = mysqli_fetch_array($sql_category_story)) {
                        ?>
                            <button class="btn btn-outline-primary" onclick="window.location.href='./CategoryStory.php?id=<?= $row_category_story['idcategory'] ?>'"><?= $row_category_story['name'] ?></button>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- end thể loại -->

        </div>
        <!-- end thông tin bên phải -->

    </div>
</div>