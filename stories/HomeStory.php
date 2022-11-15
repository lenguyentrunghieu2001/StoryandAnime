<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';
if (isset($_SESSION['setloading']) && $_SESSION['setloading'] == true) {
    $_SESSION['setloading'] = false;
?>
    <div class="loader">
        <div class="circ">
            <div class="load">Loading . . . </div>
            <div class="hands"></div>
            <div class="body"></div>
            <div class="head">
                <div class="eye"></div>
            </div>
        </div>
    </div>

    <!-- truyện hot -->
<?php
}
include './HomeStory/StoryHot.php';

?>
<!--end  truyện hot -->
<!--  infinite scroll carousel -->
<?php
include './HomeStory/InfiniteScroll.php';
?>
<!--  end infinite scroll carousel -->
<!--  infinite scroll carousel -->

<!--  end infinite scroll carousel -->

<!-- truyện home -->
<div id="main-homestory">
    <div class="container">
        <div class="row">
            <!-- col-9 danh sách truyện -->
            <div class="col-9">


                <!-- danh sach chap -->
                <div class="content text-center" style="position: relative; ">
                    <a onclick="window.location.href='AllChapter.php?page=1'" style="position: absolute; right: 15px; top:22px;cursor: pointer; font-weight: 800;">Xem Thêm <i class="fa-solid fa-forward"></i></a>
                    <?php
                    include './HomeStory/ListChapterStory.php';
                    ?>


                </div>
                <!-- end danh sach chap -->
                <!-- đề xuất -->
                <div class="content text-center" style="position: relative; ">
                    <h1 class="title" style="color:rgb(8 195 30)">ĐỀ XUẤT TRUYỆN</h1>
                    <div style=" display: flex; flex-wrap: wrap; margin-left: 10px;">
                        <?php
                        include './recommend/user_recommendation.php';
                        ?>
                    </div>

                </div>

                <!--end đề xuất -->
                <!-- truyện mới cập nhật -->

                <div class="content text-center" style="position: relative;">
                    <h1 class="title">DANH SÁCH TRUYỆN</h1>
                    <p onclick="window.location.href='AllStory.php?page=1'" style="position: absolute; right: 15px; top:22px;cursor: pointer; font-weight: 800;">Xem Thêm <i class="fa-solid fa-forward"></i></p>
                    <div class="story">
                        <?php include 'HomeStory/Story.php' ?>
                    </div>

                </div>

                <!-- truyện mới cập nhật -->
                <div class="content text-center">
                    <h1 class="title" style="color: #ebba00;">NHÓM DỊCH</h1>
                    <div class="story">
                        <?php include 'HomeStory/TransStoryHome.php' ?>
                    </div>
                </div>
                <!-- tab truyện trong 7 ngày-->

                <div class="content text-center">
                    <?php include './HomeStory/ChapterDay.php' ?>

                </div>
                <!-- tab truyện trong 7 ngày-->

                <!--end col-9 danh sách truyện -->

                <?php include './inc/sidebar.php' ?>
            </div>
        </div>

    </div>
    <!-- end truyện home -->


    <?php
    include './inc/footer.php';
    ?>


    <script script src="../public/js/tabdate.js">
    </script>