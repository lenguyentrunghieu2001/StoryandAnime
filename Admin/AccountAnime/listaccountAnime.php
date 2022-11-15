<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-8 createSegment">
                <a class="btn dim_button create_new" onclick="window.location.href='../AccountAnime/handleaccountAnime.php?xoa=1'"> <span class="glyphicon glyphicon-plus"></span>Xóa gói 1 tháng</a>
                <a class="btn dim_button create_new" onclick="window.location.href='../AccountAnime/handleaccountAnime.php?xoa=2'"> <span class="glyphicon glyphicon-plus"></span>Xóa gói 6 tháng</a>
                <a class="btn dim_button create_new" onclick="window.location.href='../AccountAnime/handleaccountAnime.php?xoa=3'"> <span class="glyphicon glyphicon-plus"></span>Xóa gói 1 năm</a>
            </div>
            <div class="col-sm-4 add_flex">
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
                        <th>Tên người mua</th>
                        <th>Gói</th>
                        <th>Ngày mua</th>
                        <th>Đã sử dụng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_account_anime = mysqli_query($con, "SELECT * FROM tbl_account_anime");
                    $i = 0;
                    while ($row_account_anime  = mysqli_fetch_array($sql_account_anime)) {
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row_account_anime['username'] ?></td>
                            <td><?= $row_account_anime['value'] ?></td>
                            <td><?= date("d-m-Y", strtotime($row_account_anime['date']))  ?></td>

                            <?php
                            if ($row_account_anime['value'] == 1) {
                            ?>
                                <td><?php
                                    $today = new DateTime(date('Y-m-d'));
                                    $date_account = new DateTime(date('Y-m-d', strtotime($row_account_anime['date'])));
                                    $diff = $date_account->diff($today);
                                    $date = $diff->format('%r%a');
                                    echo $date . ' ngày';
                                    ?></td>

                            <?php
                            } else if ($row_account_anime['value'] == 2) {
                            ?>
                                <td><?php
                                    $today = new DateTime(date('Y-m-d'));
                                    $date_account = new DateTime(date('Y-m-d', strtotime($row_account_anime['date'])));
                                    $diff = $date_account->diff($today);
                                    $date = $diff->format('%r%a');
                                    echo $date . ' ngày';
                                    ?></td>


                            <?php
                            } else if ($row_account_anime['value'] == 3) {
                            ?>
                                <td><?php
                                    $today = new DateTime(date('Y-m-d'));
                                    $date_account = new DateTime(date('Y-m-d', strtotime($row_account_anime['date'])));
                                    $diff = $date_account->diff($today);
                                    $date = $diff->format('%r%a');
                                    echo $date . ' ngày';
                                    ?></td>
                            <?php
                            }
                            ?>
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