<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-4 createSegment">
                <a class="btn dim_button create_new" onclick="window.location.href='../Account/handleaccount.php?all=1'"> <span class="glyphicon glyphicon-plus"></span>Duyệt nhanh</a>
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
                        <th>tên đăng nhập</th>
                        <th>email</th>
                        <th>số điện thoại</th>
                        <th>thông tin ngân hàng</th>
                        <th>khóa tài khoản</th>
                        <th>chức năng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_trans = mysqli_query($con, "SELECT * FROM translate");
                    $i = 0;
                    while ($row_trans  = mysqli_fetch_array($sql_trans)) {
                        $i++;
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row_trans['usernametrans'] ?></td>
                            <td><?= $row_trans['email'] ?></td>
                            <td><?= $row_trans['phone'] ?></td>
                            <td><?= $row_trans['Bankcard'] ?></td>
                            <?php
                            if ($row_trans['lockaccount'] == 0) {
                            ?>
                                <td style="cursor: pointer;" onclick="window.location.href='../Account/handleaccount.php?lock=0&usernametrans=<?= $row_trans['usernametrans'] ?>'"><span class="mode mode_off">đang duyệt</span></td>

                            <?php
                            } else if ($row_trans['lockaccount'] == 1) {
                            ?>
                                <td style="cursor: pointer;" onclick="window.location.href='../Account/handleaccount.php?lock=1&usernametrans=<?= $row_trans['usernametrans'] ?>'"><span class="mode mode_on">đang mở</span></td>

                            <?php
                            } else if ($row_trans['lockaccount'] == 2) {
                            ?>
                                <td style="cursor: pointer;" onclick="window.location.href='../Account/handleaccount.php?lock=2&usernametrans=<?= $row_trans['usernametrans'] ?>'"><span class="mode mode_danger">đang khóa</span></td>

                            <?php
                            }
                            ?>
                            <td class="option">
                                <li>
                                    <a href="../Account/showaccount.php?usernametrans=<?= $row_trans['usernametrans'] ?>">
                                        <i class="fa fa-edit"></i>Xem
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