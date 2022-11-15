<?php
include '../Database/Connect.php';
include './inc/header.php';
include './inc/menu.php';
?>
<!-- hot anime -->
<div id="HomeAnime">

    <?php
    include './HomeAnime/Hotanime.php';
    ?>
    <!--end  hot anime -->

    <!-- thể loại -->
    <?php
    include './HomeAnime/Categoryanime.php';
    ?>
    <!--end thể loại -->

</div>
<?php
include './inc/footer.php';
?>