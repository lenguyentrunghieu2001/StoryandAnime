<div class="icon"><i class="fa-solid fa-xmark"></i></div>

<div id="flipbook">
    <?php
    function get_page($text, $page_index, $line_length = 76, $page_length = 40)
    {
        $lines = explode("\n", wordwrap($text, $line_length, "\n"));
        $page_lines = array_slice($lines, $page_index * $page_length, $page_length);
        return implode("\n", $page_lines);
    }
    $idchap = $_GET['idchap'];
    $sql_chapter_detail = mysqli_query($con, "SELECT * FROM tbl_chapter WHERE idchap = '$idchap' LIMIT 1");
    while ($row_chapter_detail = mysqli_fetch_array($sql_chapter_detail)) {
    ?>
        <div class="hard" style="background-image: url('./../public/images/background.jpg'); background-size: cover;display: flex; justify-content: center;align-items: center;font-size: 30px; color:white;text-transform: uppercase;font-weight: bold;"> Chap <?= $row_chapter_detail['chap'] ?> : <?= $row_chapter_detail['title'] ?> </div>

        <?php
        $longtext = $row_chapter_detail['content'];
        $page = 1;
        $str = '';
        while ($text = get_page($longtext, $page - 1, 60, 20)) {
            $str .=  trim($text) . str_repeat("/", 3);
            $page++;
        }
        $array = explode("///", $str);
        array_pop($array);
        foreach ($array as $key => $val) {
        ?>
            <div class="hard">
                <div>
                    <p><?= $val ?></p>
                    <p>Trang <?= $key + 1 ?>/<?= count($array); ?></p>
                </div>
            </div>

    <?php
        }
    }
    ?>
    <div class="hard" style="background-color: #007bff;"></div>
    <div class="hard" style="background-image: url('./../public/images/background.jpg'); background-size: cover;display: flex; justify-content: center;align-items: center;font-size: 30px; color:white;text-transform: uppercase;font-weight: bold;"></div>
</div>