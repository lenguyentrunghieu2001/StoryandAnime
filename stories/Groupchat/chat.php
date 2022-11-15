<div class="nut-mo-chatbox">
    <p>Chat nhóm</p>
    <img src="../public/images/chat.gif" alt="" onclick="moForm()">
</div>

<div class="Chatbox" id="myForm">
    <div style="display: flex;justify-content:space-between;padding-left: 20px;align-items:center; border-bottom: 2px solid white;font-size: 20px; font-weight: 800;position: relative;">
        <p></p>
        <h1>NHÓM NHẮN TIN TRUYỆN HV </h1><button class="btn btn-danger" onclick="dongForm()">X</button>
        <div style="position: absolute; width: 40px;height: 40px;line-height:40px;color:white; border-radius: 50%; background-color: red;top:350px;left:48% ; text-align: center;" id="ontopchat"><i class="fa fa-arrow-up"></i></div>

    </div>
    <div class="comment_parent_chat" id="comment_parent_chat">

    </div>

    <form method="POST" id="insert_data_chat" class="SendChat">
        <input type="hidden" id="username" value="<?= $_SESSION['loginuser'] ?>">

        <textarea class="comment_input_chatting" id="comment_input_chatting" type="text" cols="30"> </textarea>
        <input type="button" value="Gửi" class="btn btn-primary" id="button_insert_chat" style="width: 120px;">
    </form>

</div>
<script>
    $("#ontopchat").hide();

    $("#ontopchat").click(function() {
        $("#comment_parent_chat").animate({
                scrollTop: 0,
            },
            "slow"
        );
        return false;
    });

    $('#comment_parent_chat').scroll(function() {
        if ($('#comment_parent_chat').scrollTop() > 200) {
            $("#ontopchat").fadeIn(100);
        } else {
            $("#ontopchat").fadeOut(100);
        }
    });
</script>
<script>
    $('.comment_input_chatting').emojioneArea({
        pickerPosition: 'top'
    })
</script>

<script>
    $(document).ready(function() {

        function fetch_data() {
            $.ajax({
                url: "./Groupchat/handlechat.php",
                method: "POST",
                success: function(data) {
                    $('.comment_parent_chat').html(data);
                    fetch_data();

                }
            })
        }

        fetch_data();
        $('#button_insert_chat').on('click', function() {
            var username = $('#username').val();
            var chat = $('#comment_input_chatting').val();
            $.ajax({
                url: "./Groupchat/handlechat.php",
                method: "POST",
                data: {
                    username: username,
                    chat: chat
                },
                success: function(data) {
                    $('#comment_input_chatting').val('');
                    $(".emojionearea-editor").html('');
                }

            });



        });

    });
</script>