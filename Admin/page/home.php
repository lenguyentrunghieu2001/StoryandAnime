<?php
include '../../Database/Connect.php';
include '../inc/header.php';
include '../inc/menu.php';

?>
<?php
$query_momo = "SELECT sum(amount) as amount FROM tbl_momo WHERE Year(date)=Year(NOW())";
$result_momo = mysqli_query($con, $query_momo);
$row_momo = mysqli_fetch_array($result_momo);

$query_vnpay = "SELECT sum(vnp_Amount) as amount FROM tbl_vnpay WHERE Year(date)=Year(NOW())";
$result_vnpay = mysqli_query($con, $query_vnpay);
$row_vnp = mysqli_fetch_array($result_vnpay);
$dataPoints = array(
    array("label" => "Momo", "y" => $row_momo['amount']),
    array("label" => "Vnpay", "y" => $row_vnp['amount'])
);

$dataPointsTrans = [];

$query_trans = "SELECT uernametrans, SUM(money) as money FROM `tbl_moneytranslate` WHERE Month(datetime)=Month(now()) GROUP BY uernametrans";
$result_trans = mysqli_query($con, $query_trans);
while ($row_trans = mysqli_fetch_array($result_trans)) {
    array_push(
        $dataPointsTrans,
        array("label" => $row_trans['uernametrans'], "y" => $row_trans['money']),
    );
}

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
<div style="margin: 30px auto; display: flex; flex-direction: column; align-items: center;">
    <h5>THỐNG KÊ TIỀN NẠP TRONG NĂM <?php echo date("Y"); ?> THEO MOMO VÀ VNPAY</h5>
    <div id="chartContainer" style="height: 370px; width: 50%;"></div>
</div>

<div style="display: flex;">
    <div class="col-md-6 main-datatable">
        <div class="card_body">
            <div class="row d-flex">
                <div class="col-sm-4 createSegment">
                    VNPAY
                </div>
                <div class="col-sm-8 add_flex">
                    <div class="form-group searchInput">
                        <label for="email">Tìm:</label>
                        <input type="search" class="form-control" id="filterbox1" placeholder=" ">
                    </div>
                </div>
            </div>
            <div class="overflow-x">
                <table style="width:100%;" id="filtertable1" class="table cust-datatable dataTable no-footer">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên</th>
                            <th>ngày tháng</th>
                            <th>Số tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_vnpay = mysqli_query($con, "SELECT * FROM tbl_vnpay ORDER BY id DESC");
                        $i = 0;
                        while ($row_vnpay  = mysqli_fetch_array($sql_vnpay)) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row_vnpay['username'] ?></td>
                                <td><?= date("d-m-Y", strtotime($row_vnpay['date'])) ?></td>
                                <td><?= number_format($row_vnpay['vnp_Amount']) ?></td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <div class="col-md-6 main-datatable">
        <div class="card_body">
            <div class="row d-flex">
                <div class="col-sm-4 createSegment">
                    MOMO
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
                            <th>Tên</th>
                            <th>ngày tháng</th>
                            <th>Số tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_momo = mysqli_query($con, "SELECT * FROM tbl_momo ORDER BY id DESC");
                        $i = 0;
                        while ($row_momo  = mysqli_fetch_array($sql_momo)) {
                            $i++;
                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $row_momo['username'] ?></td>
                                <td><?= date("d-m-Y", strtotime($row_momo['date'])) ?></td>
                                <td><?= number_format($row_momo['amount']) ?></td>

                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<div style="margin: 30px 20px; display: flex; flex-direction: column; align-items: center;">
    <h5>THỐNG KÊ TIỀN MỞ KHÓA CỦA NHÓM DỊCH TRONG THÁNG <?php echo date("m"); ?> </h5>
    <div id="chartContainer1" style="height: 300px; width: 100%;"></div>

</div>
<div class="col-md-12 main-datatable">
    <div class="card_body">
        <div class="row d-flex">
            <div class="col-sm-4 createSegment">
                TIỀN NHÓM DỊCH
            </div>
            <div class="col-sm-8 add_flex">
                <div class="form-group searchInput">
                    <label for="email">Tìm:</label>
                    <input type="search" class="form-control" id="filterbox2" placeholder=" ">
                </div>
            </div>
        </div>
        <div class="overflow-x">
            <table style="width:100%;" id="filtertable2" class="table cust-datatable dataTable no-footer">
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
                    $sql_moneytranslate = mysqli_query($con, "SELECT * FROM tbl_moneytranslate ORDER BY datetime DESC");
                    $i = 0;
                    while ($row_moneytranslate  = mysqli_fetch_array($sql_moneytranslate)) {
                        $i++;
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
            </table>
        </div>

    </div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
    window.onload = function() {


        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            data: [{
                type: "pie",
                yValueFormatString: "#,##0\" vnđ\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
        var chart = new CanvasJS.Chart("chartContainer1", {
            animationEnabled: true,
            theme: "light2", // "light1", "light2", "dark1", "dark2"

            data: [{
                type: "column",
                showInLegend: true,
                legendMarkerColor: "grey",
                indexLabel: "{y}",
                yValueFormatString: "#,##0\" vnđ\"",
                legendText: "Nhóm dịch",
                dataPoints: <?php echo json_encode($dataPointsTrans, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    }
</script>

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
        var dataTable1 = $('#filtertable1').DataTable({
            "pageLength": 5,
            // "order": true,
            "bLengthChange": false,
            "dom": '<"top">ct<"top"p><"clear">'
        });
        $("#filterbox1").keyup(function() {
            dataTable1.search(this.value).draw();
        });
        var dataTable2 = $('#filtertable2').DataTable({
            "pageLength": 5,
            // "order": true,
            "bLengthChange": false,
            "dom": '<"top">ct<"top"p><"clear">'
        });
        $("#filterbox2").keyup(function() {
            dataTable2.search(this.value).draw();
        });
    });
</script>
<script>
    $(document).ready(function() {


    });
</script>
<?php
include '../inc/footer.php';

?>