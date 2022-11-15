<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';
// include './HomeStory/converTime.php';

?>


<div class="content text-center">
    <div class="container" style="min-height: 600px;">
        <div class="row">
            <div class="col-3 text-left">
                <div class="fillerchapter mt-4" style="color:black">
                    <h3>Sắp xếp</h3>
                    <div style="margin:10px 0px ;">

                        <div class="list-group-item checkbox">
                            <label><input type="radio" name="sort" class="common_selector sort" value="datechap DESC"> Theo mới nhất</label>
                        </div>
                        <div class="list-group-item checkbox">
                            <label><input type="radio" name="sort" class="common_selector sort" value="datechap ASC"> Theo cũ nhất</label>
                        </div>
                    </div>
                </div>
                <div class="fillerchapter" style="color:black">
                    <h3>Giá tiền</h3>
                    <div style="margin:10px 0px ;height: 100px; overflow-y: auto; overflow-x: hidden;">

                        <div class="list-group-item checkbox">
                            <label><input type="radio" name="money" class="common_selector money" value="0"> Miễn phí</label>
                        </div>
                        <div class="list-group-item checkbox">
                            <label><input type="radio" name="money" class="common_selector money" value="10"> Có phí</label>
                        </div>
                    </div>
                </div>

                <label><input type="submit" name="show" class="common_selector show btn btn-danger mt-2" id="show" value="Hiển thị tất cả"></label>
            </div>
            <div class="col-9">
                <h1 class="title">LỌC Chapter</h1>
                <div class="content text-center">

                    <div class="story">
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .col-3 h3 {
        color: red;
    }

    #loading {
        text-align: center;
        background: url('loader.gif') no-repeat center;
        height: 150px;
    }
</style>

<script src="../public/js/fillerChapter.js"></script>
<?php
include './inc/footer.php';
?>