<?php
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';

?>

<!-- MAIN -->
<main>
    <div id="home">
        <div class="head-title">
            <div class="left">
                <h1>Trang Thống Kê</h1>
            </div>
        </div>
    </div>
</main>

<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-4 createSegment" style="text-transform: uppercase; font-weight: 700;">
                TIỀN NHÓM DỊCH <?= $_SESSION['logintrans'] ?>
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
                        <th>Tên nhóm dịch</th>
                        <th>ngày tháng</th>
                        <th>Số tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usernametrans = $_SESSION['logintrans'];
                    $sql_moneytranslate_month = mysqli_query($con, "SELECT * FROM tbl_moneytranslate WHERE uernametrans ='$usernametrans' AND  Month(datetime)=Month(now())");
                    $sum_month = 0;
                    $sum = 0;
                    while ($row_moneytranslate_month  = mysqli_fetch_array($sql_moneytranslate_month)) {
                        $sum_month += $row_moneytranslate_month['money'];
                    }

                    $sql_moneytranslate = mysqli_query($con, "SELECT * FROM tbl_moneytranslate WHERE uernametrans ='$usernametrans' ORDER BY datetime DESC");
                    $i = 0;


                    while ($row_moneytranslate  = mysqli_fetch_array($sql_moneytranslate)) {
                        $i++;
                        $sum += $row_moneytranslate['money'];
                    ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row_moneytranslate['uernametrans'] ?></td>
                            <td><?= date("d-m-Y", strtotime($row_moneytranslate['datetime'])) ?></td>
                            <td><?= number_format($row_moneytranslate['money']) ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                <p style="margin-left: 20px; color:blue;">Tổng tiền là : <?= $sum; ?></p>
                <p style="margin-left: 20px; color:blue;">Tổng tiền tháng <?php echo date("m"); ?> là : <?= $sum_month; ?></p>
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