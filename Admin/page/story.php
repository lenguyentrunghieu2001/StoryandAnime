<?php
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';
?>
<style>
    .overflow-x .content_news {
        text-align: justify;
        text-overflow: ellipsis;
        overflow-y: scroll;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        width: 120px;
    }

    .overflow-x .content_news img {
        display: none;
    }

    .overflow-x .option {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 120px;
    }
</style>
<!-- MAIN -->
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>TRANG TRUYỆN</h1>

            </div>
        </div>
    </div>

</main>
<!--end MAIN -->

<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-4 createSegment">
                <a class="btn dim_button create_new" onclick="window.location.href='../Story/updatehot.php'"> <span class="glyphicon glyphicon-plus"></span> Cập nhật truyện hot</a>
            </div>
            <div class="col-sm-8 add_flex">
                <div class="form-group searchInput">
                    <label for="email">Tìm:</label>
                    <input type="search" class="form-control" id="filterbox" placeholder=" ">
                </div>
            </div>
        </div>
        <div class="overflow-x">
            <table style="width:100%;" id="filtertable" class="table cust-datatable dataTable no-footer">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>tên</th>
                        <th>hình ảnh</th>
                        <th>tóm tắt</th>
                        <th>tác giả</th>
                        <th>lượt xem</th>
                        <th>trạng thái</th>
                        <th>hot</th>
                        <th>kiểu truyện</th>
                        <th>nhóm dịch</th>
                        <th>chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_story = mysqli_query($con, "SELECT * FROM tbl_story ORDER BY id DESC");
                    $i = 0;
                    while ($row_story = mysqli_fetch_array($sql_story)) {
                        $i++;
                    ?>
                        <tr>

                            <td><?= $i ?></td>
                            <td style=" width: 45px;"><?= $row_story['name'] ?></td>
                            <td><img src="../../StoryTranslates/StoryTrans/uploads/<?= $row_story['image'] ?>" width="100px" alt=""></td>
                            <td class="content_news"><?= $row_story['summary'] ?></td>
                            <td><?= $row_story['author'] ?></td>
                            <td><?= $row_story['view'] ?></td>
                            <?php
                            if ($row_story['status'] == 0) {
                            ?>
                                <td style="cursor: pointer; width: 145px; padding: 0;"><span class="mode mode_off">chưa hoàn thành</span></td>

                            <?php
                            } else {
                            ?>
                                <td style="cursor: pointer; padding: 0;"><span class="mode mode_on">hoàn thành</span></td>

                            <?php
                            }
                            ?>
                            <?php
                            if ($row_story['hot'] == 0) {
                            ?>
                                <td style="cursor: pointer;  padding: 0;"><span class="mode mode_off">chưa hot</span></td>

                            <?php
                            } else {
                            ?>
                                <td style="cursor: pointer; padding: 0;"><span class="mode mode_danger">hot</span></td>

                            <?php
                            }
                            ?>

                            <?php
                            if ($row_story['type'] == 0) {
                            ?>
                                <td style="padding:0 ;">Truyện chữ</td>

                            <?php
                            } else {
                            ?>
                                <td style="padding:0 ;">Truyện tranh</td>

                            <?php
                            }
                            ?>

                            <td><?= $row_story['usernametrans'] ?></td>
                            <!-- <td><span class="mode mode_off">Inactive</span></td> -->
                            <td class="option">
                                <li type="button" data-toggle="modal" data-target=".bd-example-modal-lg<?= $i ?>">
                                    <button>
                                        <i class="fa fa-edit"></i>Xem
                                    </button>
                                </li>

                            </td>
                            <div class="modal fade bd-example-modal-lg<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" style="right: -150px;">
                                    <div class="modal-content p-4">
                                        <p><b>Tên truyện: </b> <?= $row_story['name'] ?></p>
                                        <p><b>Hình ảnh: </b> <img src="../../StoryTranslates/StoryTrans/uploads/<?= $row_story['image'] ?>" alt="" style="width: 160px; height: 100%"></p>
                                        <p><b>Tóm tắt: </b> <?= $row_story['summary'] ?></p>
                                        <p><b>Tác giả: </b> <?= $row_story['author'] ?></p>
                                        <p><b>lượt xem: </b> <?= $row_story['view'] ?></p>
                                        <p><b>Tình trạng: </b>
                                            <?php
                                            if ($row_story['status'] == 1) {
                                            ?>
                                                hoàn thành
                                            <?php
                                            } else {
                                            ?>
                                                chưa hoàn thành
                                            <?php
                                            }
                                            ?>
                                        </p>
                                        <p><b>Kiểu truyện </b>
                                            <?php
                                            if ($row_story['type'] == 0) {
                                            ?>
                                                Truyện chữ
                                            <?php
                                            } else {
                                            ?>
                                                Truyện tranh
                                            <?php
                                            }
                                            ?>
                                        </p>
                                        <p><b>Hot: </b>
                                            <?php
                                            if ($row_story['hot'] == 1) {
                                            ?>
                                                đang hot
                                            <?php
                                            } else {
                                            ?>
                                                chưa hot
                                            <?php
                                            }
                                            ?>
                                        </p>
                                        <p><b>Tác giả: </b> <?= $row_story['author'] ?></p>
                                        <p><b>Nhóm dịch: </b> <?= $row_story['usernametrans'] ?></p>
                                        <p><b>Thể loại : </b>
                                            <?php
                                            $id_truyen = $row_story['id'];
                                            $sql_cate_story = mysqli_query($con, "SELECT tbl_category.name as 'name' FROM tbl_story_category INNER JOIN tbl_category ON tbl_category.idcategory=tbl_story_category.idcategory WHERE idtruyen = '$id_truyen'");
                                            while ($row_cate_story = mysqli_fetch_array($sql_cate_story)) {
                                                echo ' ' . $row_cate_story['name'];
                                            }
                                            ?></p>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<script>
    $(document).ready(function() {

        var dataTable = $('#filtertable').DataTable({
            "pageLength": 5,
            // "order": true,
            "bLengthChange": false,
            "dom": '<"top">ct<"top"p><"clear">'
        });
        $("#filterbox").keyup(function() {
            dataTable.search(this.value).draw();
        });
    });
</script>
<?php
include '../inc/footer.php';
?>