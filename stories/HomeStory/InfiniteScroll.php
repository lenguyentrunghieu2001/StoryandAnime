<style>
    .slider-infi {
        margin-top: -60px;
        background: #e7e7e7;
    }

    .slider-infi .slide-track {
        animation: scroll 22s linear infinite;
        display: flex;
    }

    .slider-infi .slide-track .slide {
        background: #e7e7e7;
        display: flex;
        align-items: center;
        margin: 0 60px;
    }

    .slider-infi .slide-track .slide img {
        margin-bottom: 0;
        background: #e7e7e7;
        border-radius: 0;
        height: auto;
        width: 90px;
    }



    .slider-infi .slide-track .slide p {
        font-size: 15px;
        color: black;
        font-weight: 600;
        text-align: center;
        letter-spacing: 1px;

    }

    .slider-infi .slide-track .slide p:first-child {
        color: black;
        font: bold 100px Georgia, Serif;
        font-size: 21px;
        text-transform: uppercase;
    }



    @keyframes scroll {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(calc(-250px * 6));
        }
    }
</style>
<div class="slider-infi">
    <div class="slide-track">
        <?php
        $sql_topAmount = mysqli_query($con, "SELECT * FROM tbl_accountuser ORDER BY summoney DESC LIMIT 5");
        $i = 0;
        while ($row_topAmount = mysqli_fetch_array($sql_topAmount)) {
            $i++;
        ?>
            <div class="slide">
                <?php if ($i == 1) { ?>
                    <img src="./../public/images/top1.png">
                    <div>
                        <p><?= $row_topAmount['username'] ?></p>
                        <p>Level <?= $row_topAmount['level'] ?></p>
                        <p><?= number_format($row_topAmount['summoney']) . 'đ' ?></p>
                    </div>
                <?php
                } else if ($i == 2) { ?>
                    <img src="./../public/images/top2.png">
                    <div>
                        <p><?= $row_topAmount['username'] ?></p>
                        <p>Level <?= $row_topAmount['level'] ?></p>
                        <p><?= number_format($row_topAmount['summoney']) . 'đ' ?></p>
                    </div>
                <?php
                } else if ($i == 3) { ?>
                    <img src="./../public/images/top3.png">
                    <div>
                        <p><?= $row_topAmount['username'] ?></p>
                        <p>Level <?= $row_topAmount['level'] ?></p>
                        <p><?= number_format($row_topAmount['summoney']) . 'đ' ?></p>
                    </div>
                <?php
                } else if ($i == 4) { ?>
                    <img src="./../public/images/top4.png">
                    <div>
                        <p><?= $row_topAmount['username'] ?></p>
                        <p>Level <?= $row_topAmount['level'] ?></p>
                        <p><?= number_format($row_topAmount['summoney']) . 'đ' ?></p>
                    </div>
                <?php
                } else if ($i == 5) { ?>
                    <img src="./../public/images/top5.png">
                    <div>
                        <p><?= $row_topAmount['username'] ?></p>
                        <p>Level <?= $row_topAmount['level'] ?></p>
                        <p><?= number_format($row_topAmount['summoney']) . 'đ' ?></p>
                    </div>
                <?php
                } ?>
            </div>
        <?php
        }
        ?>
    </div>

</div>
</div>