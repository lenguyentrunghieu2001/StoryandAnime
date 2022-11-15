<?php
$usernamepos = $_SESSION['loginuser'];
$idchappos = $_GET['idchap'];
?>
<input type="hidden" id="usernamepos" value="<?= $usernamepos ?>">
<input type="hidden" id="idchappos" value="<?= $idchappos ?>">

<script type="text/javascript">
    window.onbeforeunload = function() {
        var idchappos = $('#idchappos').val();
        var usernamepos = $('#usernamepos').val();
        var position = window.pageYOffset;
        $.ajax({
            url: "./Chapter/handlepos.php",
            type: "POST",
            data: {
                idchappos: idchappos,
                usernamepos: usernamepos,
                position: position
            },
        });
    }
</script>