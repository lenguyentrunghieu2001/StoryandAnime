<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.css">

<style>
    .btn.active {
        opacity: 0.5;
    }
</style>

<?php
$sql_position = mysqli_query($con, "SELECT * FROM tbl_position WHERE username = '{$_SESSION['loginuser']}' and idchap = '{$_GET['idchap']}'");
if (mysqli_num_rows($sql_position) > 0) {
    $row_position = mysqli_fetch_array($sql_position);
    $position = $row_position['position'];
?>
    <button onclick="scrollWin()" class="btn btn-success" style="position:fixed;right:10px; bottom:140px">Đọc tiếp</button>

    <script>
        function scrollWin() {
            window.scrollTo(0, <?= $position ?>);
        }
    </script>
<?php
}
?>

<?php
$idchap = $_GET['idchap'];
$sql_chapter_detail = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE idchap = '$idchap' LIMIT 1");
while ($row_chapter_detail = mysqli_fetch_array($sql_chapter_detail)) {
    $idtruyen = $row_chapter_detail['idtruyen'];
    $sql_story_type = mysqli_query($con, "SELECT * FROM tbl_story WHERE id='$idtruyen'");
    $row_story_type = mysqli_fetch_array($sql_story_type);
    if ($row_story_type['type'] == 1) {
    } else {
?>
        <div class="container mt-5 bg-dark text-center" style="padding:5px ;">
            <p class="lead text-light mb-2">Chọn ngôn ngữ máy đọc</p>

            <!-- Select Menu for Voice -->
            <select id="voices" class="form-select bg-secondary text-light" style="width: 100%;"></select>

            <!-- Range Slliders for Volume, Rate & Pitch -->
            <div class="d-flex mt-4 text-light" style="justify-content: center;">
                <div>
                    <p class="lead">Âm thanh</p>
                    <input type="range" min="0" max="1" value="1" step="0.1" id="volume" />
                    <span id="volume-label" class="ms-2">1</span>
                </div>
                <div class="mx-5">
                    <p class="lead">Tốc độ</p>
                    <input type="range" min="0.1" max="10" value="1" id="rate" step="0.1" />
                    <span id="rate-label" class="ms-2">1</span>
                </div>
                <div>
                    <p class="lead">Âm giọng</p>
                    <input type="range" min="0" max="2" value="1" step="0.1" id="pitch" />
                    <span id="pitch-label" class="ms-2">1</span>
                </div>
            </div>

        </div>

        <!-- Control Buttons -->
        <div class="mb-5 text-center">
            <p style="color:red;margin: 10px ; font-weight: 700;">Vui lòng ấn nút (dừng và reset) sau đó mới chỉnh hoặc trước khi thoát trang</p>
            <button id="start" class="btn btn-success">Bắt Đầu</button>
            <button id="pause" class="btn btn-warning" style="color:white;">Tạm dừng</button>
            <button id="resume" class="btn btn-info">Tiếp tục</button>
            <button id="cancel" class="btn btn-danger">Dừng và Reset</button>
        </div>

    <?php } ?>

    <textarea class="form-control bg-dark text-light mt-5" cols="30" rows="10" placeholder="Type here..." hidden>
        <?= $row_chapter_detail['content'] ?>
    </textarea>



    <div class="info-chapter">
        <div class="name-chapter">
            <h1>Chap <?= $row_chapter_detail['chap'] ?>:</h1>
            <h1><?= $row_chapter_detail['title'] ?></h1>
        </div>
        <div class="content-chapter">
            <?=
            $line_broken = str_replace("\n", "<br />", $row_chapter_detail['content']);
            ?>
        </div>
    </div>
<?php
}
?>


<section id="comment">
    <h4 class="title_comment"><i class="fa-sharp fa-solid fa-comments"></i> BÌNH LUẬN [<span class="count_comment"></span>]</h4>
    <form method="POST" id="insert_data_comment">
        <input type="hidden" id="idtruyen" value="<?= $_GET['idtruyen'] ?>">
        <input type="hidden" id="username" value="<?= $_SESSION['loginuser'] ?>">
        <textarea class="comment_input" type="text" id="comment_input" placeholder="Nhập bình luận ở đây " cols="30"> </textarea>
        <div style="text-align: right; margin-right: 30px;">
            <input type="button" value="Gửi" class="btn btn-success" id="button_insert">
        </div>
    </form>
    <div class="comment_parent">

    </div>
</section>

<?php include './Chapter/postionchapter.php' ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $('.comment_input').emojioneArea({
        pickerPosition: 'bottom'
    })
</script>

<script src="../public/js/voice.js"></script>
<script>
    $(document).ready(function() {

        function fetch_data() {
            $.ajax({
                url: "./DetailStory/handlecomment.php?idtruyen=<?= $_GET['idtruyen'] ?>&username=<?= $_SESSION['loginuser'] ?>",
                method: "POST",
                success: function(data) {
                    $('.comment_parent').html(data);
                    fetch_data();
                }
            })
            $('.count_comment').text($('.comment_child').length);

        }

        fetch_data();

        $('#button_insert').on('click', function() {
            var idtruyen = $('#idtruyen').val();
            var username = $('#username').val();
            var comment = $('#comment_input').val();
            if (comment == '') {
                alert("vui lòng nhập bình luận")
            } else {
                $.ajax({
                    url: "./DetailStory/handlecomment.php",
                    method: "POST",
                    data: {
                        idtruyen: idtruyen,
                        username: username,
                        comment: comment
                    },
                    success: function(data) {
                        $('#comment_input').val('');
                        $(".emojionearea-editor").html('');

                    }
                })
            }
        });

    });
</script>