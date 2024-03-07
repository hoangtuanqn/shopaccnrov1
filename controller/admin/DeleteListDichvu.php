<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    CheckAdmin();
    function status($data) {
        if($data == 1) return die(json_encode(['status' => 'success']));
        return  die(json_encode(['status' => 'error']));
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id    = check_string($_POST['id']);
        if(!$id) {
            status(0);
        }
        $TUANORI->remove("banggia_dichvu", " `id` = '$id' ");
        status(1);
    } else {
        msg_error2("Method không hợp lệ");
    }