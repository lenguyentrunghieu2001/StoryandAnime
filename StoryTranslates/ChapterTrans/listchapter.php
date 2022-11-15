<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-4 createSegment">
                <a class="btn dim_button create_new" onclick="window.location.href='../ChapterTrans/insertchapter.php?idtruyen=<?= $_GET['idtruyen'] ?>'"> <span class="glyphicon glyphicon-plus"></span> Thêm</a>
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
                        <th>Tên chap</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Tiền</th>
                        <th>Ngày đăng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idtruyen = $_GET['idtruyen'];
                    $usernametrans = $_SESSION['logintrans'];
                    $sql_chapter = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE idtruyen = '$idtruyen' ORDER BY idchap DESC");
                    $i = 0;
                    while ($row_chapter = mysqli_fetch_array($sql_chapter)) {
                        $i++;
                    ?>
                        <tr>

                            <td><?= $i ?></td>
                            <td>Chap <?= $row_chapter['chap'] ?></td>
                            <td><?= $row_chapter['title'] ?></td>
                            <td class="content_news"><?= $row_chapter['content'] ?></td>
                            <td><?= $row_chapter['money'] ?></td>
                            <td><?= date("d-m-Y", strtotime($row_chapter['datechap'])) ?></td>

                            <!-- <td><span class="mode mode_off">Inactive</span></td> -->
                            <td class="option">
                                <a href="../ChapterTrans/editchapter.php?idchap=<?= $row_chapter['idchap'] ?>&idtruyen=<?= $row_chapter['idtruyen'] ?>">
                                    <i class="fa fa-edit mr-1"></i>Sửa
                                </a>
                                <a href="../ChapterTrans/deletechapter.php?idchap=<?= $row_chapter['idchap'] ?>&idtruyen=<?= $_GET['idtruyen'] ?>" onclick="return confirm('Bạn có chắc xóa không !!!')">
                                    <i class=" fa fa-trash ml-2"></i>Xóa
                                </a>
                            </td>
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