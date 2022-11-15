<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-4 createSegment">
                <a class="btn dim_button create_new" onclick="window.location.href='../News/insertNews.php'"> <span class="glyphicon glyphicon-plus"></span> Thêm</a>
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
                        <th>tiêu đề</th>
                        <th>hình ảnh</th>
                        <th>nội dung</th>
                        <th>người đăng</th>
                        <th>ngày giờ</th>
                        <th>chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_news = mysqli_query($con, "SELECT * FROM tbl_news ORDER BY datetime DESC");
                    $i = 0;
                    while ($row_news = mysqli_fetch_array($sql_news)) {
                        $i++;
                    ?>
                        <tr>

                            <td><?= $i ?></td>
                            <td><?= $row_news['title'] ?></td>
                            <td><img src="<?= $row_news['image'] ?>" width="100px" alt=""></td>
                            <td class="content_news"><?= $row_news['content'] ?></td>
                            <td><?= $row_news['author'] ?></td>
                            <td><?= $row_news['datetime'] ?></td>
                            <td class="option">
                                <li>
                                    <a href="../News/editNews.php?id=<?= $row_news['id'] ?>">
                                        <i class="fa fa-edit"></i>Sửa
                                    </a>
                                </li>
                                <li>
                                    <a href="../News/handleNews.php?xoa=1&id=<?= $row_news['id'] ?>" onclick="return confirm('Bạn có chắc xóa không !!!')">
                                        <i class="fa fa-trash"></i> Xóa
                                    </a>
                                </li>

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