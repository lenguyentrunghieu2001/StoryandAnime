<?php
include './ConnectDatabase.php';
include './inc/header.php';
include './inc/menu.php';

?>


<div class="content text-center">
    <div class="container">
        <div class="row">
            <div class="col-3 text-left">
                <div class="mt-4" style="color:black">
                    <h3>Sắp xếp</h3>
                    <div style="margin:10px 0px ;">

                        <div class="list-group-item checkbox">
                            <label><input type="radio" name="sort" class="common_selector sort" value="id DESC"> Theo mới nhất</label>
                        </div>
                        <div class="list-group-item checkbox">
                            <label><input type="radio" name="sort" class="common_selector sort" value="id ASC"> Theo cũ nhất</label>
                        </div>
                        <div class="list-group-item checkbox">
                            <label><input type="radio" name="sort" class="common_selector sort" value="view DESC"> Theo phổ biến</label>
                        </div>
                    </div>
                </div>
                <div style="color:black">
                    <h3>Trạng thái</h3>
                    <div style="margin:10px 0px ;height: 100px; overflow-y: auto; overflow-x: hidden;">
                        <?php
                        $query = mysqli_query($con, "SELECT DISTINCT(status) FROM tbl_story");
                        while ($row = mysqli_fetch_array($query)) {
                            if ($row['status'] == 1) {
                        ?>
                                <div class="list-group-item checkbox">
                                    <label><input type="radio" name="status" class="common_selector status" value="<?php echo $row['status']; ?>"> <?php echo 'Hoàn thành' ?></label>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="list-group-item checkbox">
                                    <label><input type="radio" name="status" class="common_selector status" value="<?php echo $row['status']; ?>"> <?php echo 'Chưa hoàn thành' ?></label>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>

                <div style="color:black">
                    <h3>Hot</h3>
                    <div style="margin:10px 0px;height: 100px; overflow-y: auto; overflow-x: hidden;">
                        <?php
                        $query = mysqli_query($con, "SELECT DISTINCT(hot) FROM tbl_story");
                        while ($row = mysqli_fetch_array($query)) {
                            if ($row['hot'] == 1) {
                        ?>
                                <div class="list-group-item checkbox">
                                    <label><input type="radio" name="hot" class="common_selector hot" value="<?php echo $row['hot']; ?>"> <?php echo 'Hot' ?></label>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="list-group-item checkbox">
                                    <label><input type="radio" name="hot" class="common_selector hot" value="<?php echo $row['hot']; ?>"> <?php echo 'Không ' ?></label>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <div style="color:black">
                    <h3>Nhóm dịch</h3>
                    <div style="margin:10px 0px ;height: 150px; overflow-y: auto; overflow-x: hidden;">
                        <?php
                        $query = mysqli_query($con, "SELECT DISTINCT(translate.usernametrans) AS 'usernametrans' FROM tbl_story INNER JOIN translate ON tbl_story.usernametrans=translate.usernametrans");
                        while ($row = mysqli_fetch_array($query)) {

                        ?>
                            <div class="list-group-item checkbox">
                                <label><input type="checkbox" name="usernametrans" class="common_selector usernametrans" value="<?php echo $row['usernametrans']; ?>"> <?php echo $row['usernametrans'] ?></label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div style="color:black;margin:20px 0">
                    <h3>Thể loại</h3>
                    <div style="margin:10px 0px ;height: 150px; overflow-y: auto; overflow-x: hidden;">
                        <?php
                        $query = mysqli_query($con, "SELECT DISTINCT(tbl_category.idcategory) AS 'id', tbl_category.name AS 'name' FROM tbl_category INNER JOIN tbl_story_category ON tbl_story_category.idcategory=tbl_category.idcategory");
                        while ($row = mysqli_fetch_array($query)) {

                        ?>
                            <div class="list-group-item checkbox">
                                <label><input type="radio" name="category" class="common_selector category" value="<?php echo $row['id']; ?>"> <?php echo $row['name'] ?></label>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>

                <label><input type="submit" name="show" class="common_selector show btn btn-danger mt-2" id="show" value="Hiển thị tất cả"></label>
            </div>
            <div class="col-9">
                <h1 class="title">LỌC TRUYỆN</h1>
                <div class="story">


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



<script script src="../public/js/fillerstory.js">
</script>


<?php
include './inc/footer.php';
?>