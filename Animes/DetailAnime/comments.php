<link rel="stylesheet" href="./../public/css/user_css/DetailStory.css">
<style>
    #comment {
        width: 80%;
        margin: auto;
    }

    #comment .comment_input {
        min-height: 40px;
    }

    .emojionearea .emojionearea-editor {
        min-height: 5em;
    }
</style>



<section id="comment">
    <h4 class="title_comment"><i class="fa-sharp fa-solid fa-comments"></i> BÌNH LUẬN [<span class="count_comment"></span>]</h4>
    <form method="POST" id="insert_data_comment">
        <input type="hidden" id="id_anime" value="<?= $_GET['id_anime'] ?>">
        <input type="hidden" id="username" value="<?= $_SESSION['loginuser'] ?>">
        <textarea class="comment_input" type="text" id="comment_input" placeholder="Nhập bình luận ở đây " cols="30"> </textarea>
        <div style="text-align: right; margin-right: 30px;">
            <input type="button" value="Gửi" class="btn btn-success" id="button_insert">
        </div>
    </form>
    <div class="comment_parent">

    </div>




</section>

<script>
    $('.comment_input').emojioneArea({
        pickerPosition: 'bottom'
    })
</script>

<script>
    $(document).ready(function() {

        function fetch_data() {
            $.ajax({
                url: "./DetailAnime/handlecomment.php?id_anime=<?= $_GET['id_anime'] ?>&username=<?= $_SESSION['loginuser'] ?>",
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
            var id_anime = $('#id_anime').val();
            var username = $('#username').val();
            var comment = $('#comment_input').val();
            if (comment == '') {
                alert("vui lòng nhập bình luận")
            } else {
                $.ajax({
                    url: "./DetailAnime/handlecomment.php",
                    method: "POST",
                    data: {
                        id_anime: id_anime,
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