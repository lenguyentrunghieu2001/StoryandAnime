<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';

$username = $_SESSION['loginuser'];
$sql_package_anime_checkusername = mysqli_query($con, "SELECT * FROM tbl_account_anime WHERE username = '$username'");
if (mysqli_num_rows($sql_package_anime_checkusername) > 0) {
    header('location: ../Animes/HomeAnime.php');
    die();
}


$username = $_SESSION['loginuser'];
$sql_money = mysqli_query($con, "Select * from tbl_accountuser WHERE username = '$username' LIMIT 1");
$row_money = mysqli_fetch_array($sql_money);
?>
<link rel="stylesheet" href="../public/css/user_css/packetanime.css">

<div class="pricing-area">
    <div class="container">
        <h1 class="title_packet">ĐĂNG KÝ GÓI XEM ANIME</h1>
        <div class="row">
            <div class="col-lg-4">
                <div class="single-pricing">
                    <div class="deal-type">1 tháng</div>
                    <div class="deal-amount">
                        <div class="price">
                            <span class="money">20000<sup>đ</sup></span>
                        </div>
                    </div>
                    <ul class="single-deal">
                        <li>Xem phim tốc đô cao</li>
                        <li>Không yêu cầu cấu hình máy</li>
                        <li>20000đ / 1 tháng</li>

                    </ul>
                    <button class="btn" data-toggle="modal" data-target="#exampleModal">Mua</button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mua gói 1 tháng?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                                if ($row_money['money'] >= 20000) {
                                ?>
                                    <div class="modal-body">
                                        Bạn có muốn mua gói 1 tháng không với giá 20 000đ ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" margin-right: 150px;background:grey">Không</button>
                                        <a href="./packageanime/handlepackage.php?value=1" type="button" class="btn btn-primary" style="background:green;margin-right: 20px">Mua</a>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="modal-body">
                                        Bạn không đủ tiền! Vui lòng nạp thêm !!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" margin-right: 150px;background:grey">Không</button>
                                        <a href="./loadingmoney.php" type="button" class="btn btn-primary" style="background:red;margin-right: 20px">Nạp</a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-pricing">
                    <div class="deal-type">6 tháng</div>
                    <div class="deal-amount">
                        <div class="price">
                            <span class="money">100000<sup>đ</sup></span>
                        </div>
                    </div>
                    <ul class="single-deal">
                        <li>Được ưu đãi tới 20000đ</li>
                        <li>Xem phim tốc đô cao</li>
                        <li>Không yêu cầu cấu hình máy</li>
                    </ul>
                    <button class="btn" data-toggle="modal" data-target="#exampleModal1">Mua</button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mua gói 6 tháng?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                                if ($row_money['money'] >= 100000) {
                                ?>
                                    <div class="modal-body">
                                        Bạn có muốn mua gói 6 tháng không với giá 100 000đ ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" margin-right: 150px;background:grey">Không</button>
                                        <a href="./packageanime/handlepackage.php?value=2" type="button" class="btn btn-primary" style="background:green;margin-right: 20px">Mua</a>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="modal-body">
                                        Bạn không đủ tiền! Vui lòng nạp thêm !!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" margin-right: 150px;background:grey">Không</button>
                                        <a href="./loadingmoney.php" type="button" class="btn btn-primary" style="background:red;margin-right: 20px">Nạp</a>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="single-pricing">
                    <div class="deal-type">1 năm</div>
                    <div class="deal-amount">
                        <div class="price">
                            <span class="money">200000<sup>đ</sup></span>
                        </div>
                    </div>
                    <ul class="single-deal">
                        <li>Được ưu đãi tới 40000đ</li>
                        <li>Xem phim tốc đô cao</li>
                        <li>Không yêu cầu cấu hình máy</li>
                    </ul>
                    <button class="btn" data-toggle="modal" data-target="#exampleModal2">Mua</button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mua gói 1 năm?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                                if ($row_money['money'] >= 200000) {
                                ?>
                                    <div class="modal-body">
                                        Bạn có muốn mua gói 1 năm không với giá 200 000đ ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" margin-right: 150px;background:grey">Không</button>
                                        <a href="./packageanime/handlepackage.php?value=3" type="button" class="btn btn-primary" style="background:green;margin-right: 20px">Mua</a>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="modal-body">
                                        Bạn không đủ tiền! Vui lòng nạp thêm !!
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" style=" margin-right: 150px;background:grey">Không</button>
                                        <a href="./loadingmoney.php" type="button" class="btn btn-primary" style="background:red;margin-right: 20px">Nạp</a>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include './inc/footer.php';
?>