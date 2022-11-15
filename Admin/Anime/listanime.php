<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-4 createSegment">
                <a class="btn dim_button create_new" onclick="window.location.href='../Anime/insertanime.php'"> <span class="glyphicon glyphicon-plus"></span>Thêm</a>
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
                        <th>Tên anime</th>
                        <th>Hình</th>
                        <th>Mô tả</th>
                        <th>Hãng</th>
                        <th>Lượt xem</th>
                        <th>Hot</th>
                        <th>Ngày đăng</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_anime = mysqli_query($con, "SELECT * FROM tbl_anime order by id_anime desc");
                    $i = 0;
                    while ($row_animes  = mysqli_fetch_array($sql_anime)) {
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row_animes['name'] ?></td>
                            <td> <img src="../Anime/uploads/<?= $row_animes['image'] ?>" alt="" width="100px" height="100px"></td>
                            <td class="content_news"><?= $row_animes['summary'] ?></td>
                            <td><?= $row_animes['studio'] ?></td>
                            <td><?= $row_animes['view'] ?></td>
                            <td><?= $row_animes['hot'] ?></td>
                            <td><?= $row_animes['date_anime'] ?></td>
                            <td class="option">
                                <li>
                                    <a href="../Anime/editanime.php?id_anime=<?= $row_animes['id_anime'] ?>">
                                        <i class="fa fa-edit"></i>Sửa
                                    </a>
                                </li>
                                <li>
                                    <a href="./episode.php?id_anime=<?= $row_animes['id_anime'] ?>">
                                        <i class="fa fa-edit"></i>Danh sách tập
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