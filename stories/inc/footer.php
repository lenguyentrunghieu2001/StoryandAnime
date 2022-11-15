<footer>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <img src="./../public/images/logo1.png" alt="">
            </div>

            <div class="col-6 text-justify">
                <b class="zoom-text">HV truyện</b> - Kho truyện tranh online miễn phí | Truyện Hay. Truyện Mới. Website luôn cập nhập những bộ truyện mới nhất thuộc các thể loại đặc sắc như truyện tiên hiệp, kiếm hiệp, truyện teen, tiểu thuyết ngôn tình hay nhất. Hỗ trợ mọi thiết bị di động và máy tính bảng ...
            </div>
            <div class="col-4">
                <p>Email: lenguyentrunghieu2001@gmail.com</p>
                <p>Email: lamhuuvinh@gmail.com</p>
                <p>Fanpage: <a href="https://www.facebook.com/">https://www.facebook.com/</a></p>
                <p> Chính sách riêng tư</p>
            </div>
        </div>
    </div>
</footer>
<div id="lucky">
    <p>Vòng Quay May Mắn</p>
    <img src=" ../public/images/lucky.png" onclick="window.location.href='lucky.php'">
</div>
<input type="checkbox" id="toggle">
<button id="top" style="position: fixed; right: 20px; bottom: 70px; height:50px; width: 50px; border-radius: 50%; padding:5px; cursor: pointer; border:none; background-color:#3785c9; color:#fff;z-index:9999">TOP <i class="fa-regular fa-circle-up"></i></button>

<?php
include './Groupchat/chat.php';
?>

<script>
    function scrollbottom() {
        var objDiv = document.getElementById("comment_parent_chat");
        objDiv.scrollTop = objDiv.scrollHeight;
    }
</script>


<script src="../public/js/slick.js"></script>
<!-- <script src="../public/js/disCopy.js"></script> -->
<script src="../public/js/darkmode.js"></script>
<script src="../public/js/ontop.js"></script>
<script src="../public/js/serchStory.js"></script>
<script src="../public/js/loadHome.js"></script>

<script>
    function moForm() {
        document.getElementById("myForm").style.display = "block";
    }
    /*Hàm Đóng Form*/
    function dongForm() {
        document.getElementById("myForm").style.display = "none";
    }
</script>


</body>

</html>