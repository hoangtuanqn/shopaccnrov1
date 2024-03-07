<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id     = check_string($_GET['loaithe']);
    echo '<option value="">Vui lòng chọn mệnh giá</option>';
    foreach($TUANORI->get_list(" SELECT * FROM `category_banthe` WHERE `id` = '$id' AND `status` = '1' ORDER BY id DESC LIMIT 1") as $row) {
        $row2 = explode("\n", $row['ck']);
        $i = 0;
        foreach(explode("\n", $row['menhgia']) as $ok) {
            echo '<option value="'.$ok.'">'.format_cash($ok).'đ - Giảm '.$row2[$i].'%</option>';
            ++$i;
        }
    }
}