<?php
include './ConnectDatabase.php';

include './inc/header.php';
include './inc/menu.php';
?>
<div id="page-loadingmoney">
    <div>
        <img src="./../public/images/napgame.jpg" class="banner_loadingmoney" alt="">
        <div class="banggia">
            <div class="row ">
                <div class="col-7 mr-4">
                    <img src="./../public/images/vnpay.png" alt="">
                    <img src="./../public/images/momoQRpng.png" alt="">
                    <img src="./../public/images/momo.PNG" alt="" style="height: 70px;">
                    <form action="loadingmoney/congthanhtoanvnpay.php" method="post">
                        <p>NẠP BẰNG VNPAY</p>
                        <select name="money" id="">
                            <option value="10000">10,000</option>
                            <option value="20000">20,000</option>
                            <option value="50000">50,000</option>
                            <option value="100000">100,000</option>
                            <option value="200000">200,000</option>
                        </select>
                        <button class="btn btn-danger" name="redirect" id="redirect">VNPAY</button>
                    </form>
                    <form action="loadingmoney/congthanhtoanmomo.php" method="post">
                        <p> NẠP BẰNG MOMO</p>
                        <select name="money" id="">
                            <option value="10000">10,000</option>
                            <option value="20000">20,000</option>
                            <option value="50000">50,000</option>
                            <option value="100000">100,000</option>
                            <option value="200000">200,000</option>
                        </select>
                        <button class="btn" style="color:white;background-color:blueviolet ;" name="captureWallet" id="captureWallet">MOMO QR</button>
                        <button class="btn" style="color:white;background-color:blueviolet ;" name="payWithATM" id="payWithATM">MOMO ATM</button>
                    </form>
                </div>
                <div class="col-4">
                    <p style="color:#af1010; font-size:20px">Nạp tối thiểu 10000 đồng</p>
                    <p>Nạp 10,000đ tặng 1000đ </p>
                    <p>Nạp 20,000đ tặng 2500đ </p>
                    <p>Nạp 50,000đ tặng 7000đ </p>
                    <p>Nạp 100,000đ tặng 12,000đ </p>
                    <p>Nạp 200,000đ tặng 26,000đ </p>
                </div>
            </div>
        </div>

    </div>


</div>


<?php
include './inc/footer.php';
?>