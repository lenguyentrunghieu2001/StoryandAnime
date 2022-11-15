<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-4 createSegment">
                <a class="btn dim_button create_new" onclick="window.location.href='../Episode/insertesp.php?id_anime=<?= $_GET['id_anime'] ?>'"> <span class="glyphicon glyphicon-plus"></span> Thêm</a>
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
                        <th>Tập phim</th>
                        <th>Video</th>
                        <th>Chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $id_anime = $_GET['id_anime'];
                    $sql_esp = mysqli_query($con, "SELECT * FROM tbl_espisode WHERE id_anime = '$id_anime' ORDER BY id DESC");
                    $i = 0;
                    while ($row_esp = mysqli_fetch_array($sql_esp)) {
                        $i++;
                    ?>
                        <tr>

                            <td><?= $i ?></td>
                            <td>Tập <?= $row_esp['espisode'] ?></td>
                            <td>
                                <video width="300px" controls>
                                    <source src="../Episode/uploads/<?= $row_esp['video'] ?>">
                                </video>
                            </td>
                            <td class="option">
                                <a href="../Episode/edit.php?id_esp=<?= $row_esp['id'] ?>&id_anime=<?= $id_anime ?>">
                                    <i class="fa fa-edit mr-1"></i>Sửa
                                </a>
                                <a href="../Episode/delete.php?id=<?= $row_esp['id'] ?>&id_anime=<?= $id_anime ?>" onclick="return confirm('Bạn có chắc xóa không !!!')">
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