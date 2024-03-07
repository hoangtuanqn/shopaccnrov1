<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    CheckPartner();
    function status($data) {
        if($data == 1) return die(json_encode(['status' => 'success']));
        return  die(json_encode(['status' => 'error']));
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id    = check_string($_POST['id']);
        if(!$id) {
            status(0);
        }
        $ok = $TUANORI->get_row(" SELECT * FROM `ctv_ruttien` WHERE `id` = '$id' AND `status` = '0' AND `username` = '".$getUser['username']."' ");
        if($ok) {
            $TUANORI->cong("users", "money", $ok['sotien'], " `username` = '".$getUser['username']."'"); // cộng lại số tiền
            $TUANORI->insert("biendongsodu", [
                'username'  => $getUser['username'],
                'truoc'     => $getUser['money'],
                'tongtien'  => $ok['sotien'],
                'sau'       => $getUser['money'] + $ok['sotien'],
                'note'      => 'Hoàn tiền do yêu cầu thu hồi lệnh rút tiền mã #'.$id,
                'time'      => gettime()
            ]);
            $TUANORI->update("ctv_ruttien", array(
                'status'   => 2
            ), " `id` = '$id' ");
            status(1);
        }
    
    } else {
        msg_error2("Method không hợp lệ");
    }