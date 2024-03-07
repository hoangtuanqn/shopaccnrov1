<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id     = check_string($_GET['id']);
    $server = check_string($_GET['server']);
    echo '<option value="">Vui lòng chọn dịch vụ</option>';
    foreach($TUANORI->get_list(" SELECT * FROM `banggia_dichvu` WHERE `category_dichvu` = '$id' ORDER BY id DESC") as $row) {
        foreach(json_decode($row['author'], true)['server'] as $ok) {
            if($ok == $server) {
                echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                break;
            }
            if($ok > $server) break;
        }
    }
}