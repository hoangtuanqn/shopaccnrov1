<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    // require_once('../../class/class.smtp.php');
    // require_once('../../class/PHPMailerAutoload.php');
    // require_once('../../class/class.phpmailer.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_COOKIE['token'])) {
        msg_error('Vui lòng đăng nhập để tiếp tục', BASE_URL('login'), 1000);
    }
    $vang   = check_string(numb($_POST['vang'], ','));
    $tennv  = check_string($_POST['tennv']);
    $server = check_string($_POST['server']);
    if(!$vang || !$tennv || !$server) {
        msg_error2("Vui lòng nhập đầy đủ thông tin");
    }
    if($vang < 10000000) {
        msg_error2("Số vàng rút tối thiểu là 10 triệu");
    }
    if($vang > 200000000) {
        msg_error2("Số vàng rút tối đa là 200 triệu");
    }
    if($ngoc > $getUser['iteam']) {
        msg_error2("Bạn đã rút số vàng nhiều hơn số vàng đang có");
    }
    $next = true;
    $ok = json_decode($TUANORI->site('server_banvang'), true);
    for($i = 0; $i < count($ok['maychu']); ++$i) {
        if($ok['maychu'][$i] == $server) {
            $next = false;
            if($ok['status'][$i] != 1) {
                msg_error2("Server này hiện đang bảo trì, vui lòng rút lại sau");
            }
        } else {
            continue;
        }
    }
    if($next) {
        msg_error2("Hệ thống không hỗ trợ rút vàng vể server này");
    }
    $TUANORI->tru("users", "iteam", $vang, " `username` = '".$getUser['username']."'"); // trừ vàng đã rút
    $TUANORI->insert("history_rutvang", [
        'username'  => $getUser['username'],
        'tennv'     => $tennv,
        'server'    => $server,
        'vang'      => $vang,
        'status'    => 0,
        'thoigian'  => gettime()
    ]);
    send_tele("Vừa có lệnh yêu cầu rút vàng của thành viên ".$getUser['username']." vào lúc ".gettime());
    msg_success("Đã tạo lệnh rút thành công ".number_format($vang)." vàng", "", 1000);
} else {
    msg_error2("Method không hợp lệ");
}