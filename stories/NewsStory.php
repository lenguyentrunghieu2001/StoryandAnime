<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';
?>
<link rel="stylesheet" href="../public/admin/css/news.css">
<div id="new">
    <div>
        <h1 class="title-popular">TIN TỨC</h1>
        <div style="display: flex; justify-content: space-between;margin:20px 0;cursor: pointer; font-weight: 800;">
            <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalNews">Thêm tin tức</button>

        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalNews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="font-size: 18px; color: red;">
                        <h5 class="modal-title" id="exampleModalLabel"> Thêm mới tin tức
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="./News/insertNews.php" method="post">
                                <div class="form first">
                                    <div class="details personal">
                                        <div class="fields">
                                            <div class="input-field">
                                                <label>Tiêu đề bài viết</label>
                                                <input type="text" placeholder="Nhập tiêu đề bài viết" name="title" required oninvalid="this.setCustomValidity('tiêu đề không được trống')" onchange="this.setCustomValidity('')">
                                            </div>

                                            <div class="input-field">
                                                <label>Ngày đăng</label>
                                                <input type="datetime-local" placeholder="Nhập ngày đăng" name="datetime" required oninvalid="this.setCustomValidity('ngày đăng không được trống')" onchange="this.setCustomValidity('')">
                                            </div>
                                            <div class="input-field">
                                                <label>Người đăng</label>
                                                <input type="text" value="<?= $_SESSION['loginuser'] ?>" name="author">
                                            </div>
                                            <div class="input-field">
                                                <label>Hình ảnh</label>
                                                <div>
                                                    <input type="text" placeholder="Nhập link hình ảnh " name="image" class="image required w-100 " id="imagename">
                                                    <div style="display: flex; align-items: center;">
                                                        <a id="btnshow" class="btn btn-primary" style="margin: 0 20px; color:white">kiểm tra hình ảnh</a>
                                                        <img src="" class="image_src" alt="" width="150px" height="150px" id="image" oninvalid="this.setCustomValidity('link ảnh không được trống')" onchange="this.setCustomValidity('')">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="input-field">
                                                <label>Nội dung bài viết</label>
                                                <textarea name="contentnewsstory"></textarea>
                                            </div>
                                            <script>
                                                CKEDITOR.replace('contentnewsstory');
                                            </script>
                                        </div>

                                        <div class="buttons">
                                            <button class="sumbit btn btn-success">
                                                <span class="btnText">Thêm</span>
                                                <i class="uil uil-navigator"></i>
                                            </button>
                                        </div>
                                    </div>

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="grid-container">
    <?php
    $sql_news_hot = mysqli_query($con, "SELECT * FROM tbl_news WHERE datetime > DATE_SUB(NOW(), INTERVAL 7 DAY) ORDER BY RAND() LIMIT 7");
    $i = 0;
    while ($row_news_hot = mysqli_fetch_array($sql_news_hot)) {
        $i++;
        if ($i == 1) {
    ?>
            <div class="grid-item" data-toggle=" tooltip" data-placement="top" title="<?= $row_news_hot['title'] ?>">
                <img src="<?= $row_news_hot['image'] ?>" alt="">
                <div class="content">
                    <div class="content_name"><?= $row_news_hot['title'] ?> </div>
                </div>
                <div style="display: flex; justify-content: space-between;">

                    <div class="content-date"> <?= date("d-m-Y", strtotime($row_news_hot['datetime'])) ?> </div>
                    <div> <?= $row_news_hot['author'] ?> </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg<?= $i ?>">Xem</button>
            </div>


            <div class="modal fade bd-example-modal-lg<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h1><?= $row_news_hot['title'] ?></h1>
                        <p> <?= $row_news_hot['content'] ?></p>
                    </div>
                </div>
            </div>
        <?php
        } else {

        ?>
            <div class="grid-item" data-toggle=" tooltip" data-placement="top" title="<?= $row_news_hot['title'] ?>">
                <img src="<?= $row_news_hot['image'] ?>" alt="">
                <div class="content">
                    <div class="content_name"><?= $row_news_hot['title'] ?> </div>
                </div>
                <div style="display: flex; justify-content: space-between;">

                    <div class="content-date"> <?= date("d-m-Y", strtotime($row_news_hot['datetime'])) ?> </div>
                    <div> <?= $row_news_hot['author'] ?> </div>

                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg<?= $i ?>">Xem</button>
            </div>
            <div class="modal fade bd-example-modal-lg<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <h1><?= $row_news_hot['title'] ?></h1>
                        <p> <?= $row_news_hot['content'] ?></p>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>

<h1 class="title-popular">TIN TỨC PHỔ BIẾN</h1>
<div class="news-popular">
    <?php
    $j = 8;
    $sql_news = mysqli_query($con, "SELECT * FROM tbl_news ORDER BY datetime DESC");
    while ($row_news = mysqli_fetch_array($sql_news)) {
        $j++;
    ?>
        <div class="news-item">
            <img src="<?= $row_news['image'] ?>" alt="">
            <div>
                <h1><?= $row_news['title'] ?></h1>
                <div class="content"><?= $row_news['content'] ?>
                </div>
                <div class="content-info">

                    <div class="content_date">Ngày : <?= date("d-m-Y", strtotime($row_news['datetime'])) ?></div>

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg<?= $j ?>" style="height: 40px; margin-top: 20px;">Xem</button>
                </div>
                <p style="text-align: end;">người đăng : <?= $row_news['author'] ?></p>

            </div>

        </div>
        <div class="modal fade bd-example-modal-lg<?= $j ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <h1><?= $row_news['title'] ?></h1>
                    <p> <?= $row_news['content'] ?></p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <div class="text-center">
        <button class="load-more btn btn-outline-dark">Tải thêm <span class="loading"><span></span></span></button>

    </div>
</div>
</div>
<script type="text/javascript">
    document.getElementById('btnshow').onclick = function() {
        img = document.createElement('img');
        document.getElementById('image').src = document.getElementById('imagename').value;
        document.body.appendChild(img);
    }
</script>
<script>
    const loadmore = document.querySelector(".load-more");
    let currentItems = 3;
    loadmore.addEventListener("click", (e) => {
        const elementList = [...document.querySelectorAll(".news-popular .news-item")];
        e.target.classList.add("show-loader");
        for (let i = currentItems; i < currentItems + 3; i++) {
            setTimeout(function() {
                e.target.classList.remove("show-loader");
                if (elementList[i]) {
                    elementList[i].style.display = "flex";
                }
            }, 2000);
        }
        currentItems += 3;
        if (currentItems >= elementList.length) {
            event.target.classList.add('loaded');
        }

    });
</script>
<?php
include './inc/footer.php';
?>