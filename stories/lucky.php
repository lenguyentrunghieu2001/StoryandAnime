<?php
ob_start();
session_start();
include './../Database/Connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VÒNG QUAY MAY MẮN</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet" />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="./../public/css/user_css/lucky.css" />
</head>

<body>
    <img src="../public/images/background_lucky.gif" alt="" style="position: fixed; left:0; top:70%; width: 150px;">
    <img src="../public/images/background_lucky.gif" alt="" style="position: fixed; left:0; top:40%; width: 150px;">
    <img src="../public/images/background_lucky.gif" alt="" style="position: fixed; left:0; top:10%; width: 150px;">
    <img src="../public/images/background_lucky.gif" alt="" style="position: fixed; right:0; transform:scaleX(-1);top:70%; width: 150px;">
    <img src="../public/images/background_lucky.gif" alt="" style="position: fixed; right:0; transform:scaleX(-1);top:40%; width: 150px;">
    <img src="../public/images/background_lucky.gif" alt="" style="position: fixed; right:0;transform:scaleX(-1); top:10%; width: 150px;">
    <div style="display: flex; justify-content: space-around; align-items: center;">
        <a href="./HomeStory.php">Quay lại trang chủ</a>
        <h1 class="title">VÒNG QUAY MAY MẮN</h1>
        <div style="right: 0;">
            <?php
            $nameacount = $_SESSION['loginuser'];
            $sql_acount_user = mysqli_query($con, "SELECT * FROM tbl_accountuser WHERE username = '$nameacount'");
            while ($row_acount_user = mysqli_fetch_array($sql_acount_user)) {
            ?>
                <p> Tên : <?= $row_acount_user['name'] ?> </p>
                <p>Số Tiền: <?= number_format($row_acount_user['money']) . ' đ'  ?></p>

            <?php
            }
            ?>
        </div>
    </div>

    <?php
    if (isset($_SESSION['hat'])) {
    ?>
        <p style="text-align: center;"> Chúc mừng bạn đã trúng <?= $_SESSION['hat'] ?> vnd</p>
    <?php
        unset($_SESSION['hat']);
    }
    ?>

    <?php
    $username = $_SESSION['loginuser'];
    $sql_lucky = mysqli_query($con, "SELECT * FROM tbl_lucky WHERE username = '$username' AND DAY(datetime) = DAY(NOW())");
    if (mysqli_num_rows($sql_lucky) > 0) {
    ?>
        <h1>BẠN ĐÃ QUAY HẾT LƯỢT HÔM NAY</h1>
        <img src="./../public/images/vongquay.gif" alt="" class="wrapper">

    <?php
    } else {
    ?>
        <div class="wrapper">
            <div class="container">
                <canvas id="wheel"></canvas>
                <button id="spin-btn">Quay</button>
                <img src="../public/images/left.png" />
            </div>
            <div id="final-value">
                <p>Vui lòng ấn vào nút Quay</p>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Chart JS Plugin for displaying text over chart -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"></script>
    <!-- Script -->
    <script>
        const wheel = document.getElementById("wheel");
        const spinBtn = document.getElementById("spin-btn");
        const finalValue = document.getElementById("final-value");
        //Object that stores values of minimum and maximum angle for a value
        const rotationValues = [{
                minDegree: 0,
                maxDegree: 30,
                value: 50
            },
            {
                minDegree: 31,
                maxDegree: 90,
                value: 10
            },
            {
                minDegree: 91,
                maxDegree: 150,
                value: 300
            },
            {
                minDegree: 151,
                maxDegree: 210,
                value: 250
            },
            {
                minDegree: 211,
                maxDegree: 270,
                value: 200
            },
            {
                minDegree: 271,
                maxDegree: 330,
                value: 100
            },
            {
                minDegree: 331,
                maxDegree: 360,
                value: 50
            },
        ];
        //Size of each piece
        const data = [16, 16, 16, 16, 16, 16];
        //background color for each piece
        var pieColors = [
            "#FF6F61",
            "#6B5B95",
            "#8b35bc",
            "#b163da",
            "#88B04B",
            "#009B77",
        ];
        //Create chart
        let myChart = new Chart(wheel, {
            //Plugin for displaying text on pie chart
            plugins: [ChartDataLabels],
            //Chart Type Pie
            type: "pie",
            data: {
                //Labels(values which are to be displayed on chart)
                labels: [10, 50, 100, 200, 250, 300],
                //Settings for dataset/pie
                datasets: [{
                    backgroundColor: pieColors,
                    data: data,
                }, ],
            },
            options: {
                //Responsive chart
                responsive: true,
                animation: {
                    duration: 0
                },
                plugins: {
                    //hide tooltip and legend
                    tooltip: false,
                    legend: {
                        display: false,
                    },
                    //display labels inside pie chart
                    datalabels: {
                        color: "#ffffff",
                        formatter: (_, context) => context.chart.data.labels[context.dataIndex],
                        font: {
                            size: 24
                        },
                    },
                },
            },
        });
        var valueLuck = 0;
        //display value based on the randomAngle
        const valueGenerator = (angleValue) => {
            for (let i of rotationValues) {
                //if the angleValue is between min and max then display it
                if (angleValue >= i.minDegree && angleValue <= i.maxDegree) {
                    valueLuck = i.value;
                    finalValue.innerHTML = `<p>Bạn nhận được : ${i.value}</p>`;
                    spinBtn.disabled = false;
                    break;
                }
            }

        };


        //Spinner count
        let count = 0;
        //100 rotations for animation and last rotation for result
        let resultValue = 101;
        //Start spinning
        spinBtn.addEventListener("click", () => {
            spinBtn.disabled = true;
            //Empty final value
            finalValue.innerHTML = `<p>Chúc may mắn!</p>`;
            //Generate random degrees to stop at
            let randomDegree = Math.floor(Math.random() * (355 - 0 + 1) + 0);
            //Interval for rotation animation
            let rotationInterval = window.setInterval(() => {
                //Set rotation for piechart
                /*
                Initially to make the piechart rotate faster we set resultValue to 101 so it rotates 101 degrees at a time and this reduces by 1 with every count. Eventually on last rotation we rotate by 1 degree at a time.
                */
                myChart.options.rotation = myChart.options.rotation + resultValue;
                //Update chart with new value;
                myChart.update();
                //If rotation>360 reset it back to 0
                if (myChart.options.rotation >= 360) {
                    count += 1;
                    resultValue -= 5;
                    myChart.options.rotation = 0;
                } else if (count > 15 && myChart.options.rotation == randomDegree) {
                    valueGenerator(randomDegree);
                    clearInterval(rotationInterval);
                    count = 0;
                    resultValue = 101;
                    console.log(valueLuck);

                    const myTimeout = setTimeout(myGreeting, 1000);

                    function myGreeting() {
                        window.location.href = './lucky/handellucky.php?value=' + valueLuck;
                    }
                }
            }, 25);

        });
    </script>

</body>

</html>