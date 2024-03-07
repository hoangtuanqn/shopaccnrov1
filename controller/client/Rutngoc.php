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
    $ngoc   = check_string(numb($_POST['ngoc'], ','));
    $tk     = check_string($_POST['tk']);
    $mk     = check_string($_POST['mk']);
    $server = check_string($_POST['server']);
    if(!$ngoc || !$tk || !$tk || !$server) {
        msg_error2("Vui lòng nhập đầy đủ thông tin");
    }
    if($ngoc < 100) {
        msg_error2("Số ngọc rút tối thiểu là 100 ngọc");
    }
    if($ngoc > 2000) {
        msg_error2("Số ngọc rút tối đa là 2000 ngọc");
    }
    if($ngoc > $getUser['iteam_ngoc']) {
        msg_error2("Bạn đã rút số ngọc nhiều hơn số ngọc đang có");
    }
    $next = true;
    $ok = json_decode($TUANORI->site('server_banngoc'), true);
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
        msg_error2("Hệ thống không hỗ trợ rút ngọc vể server này");
    }
    $TUANORI->tru("users", "iteam_ngoc", $ngoc, " `username` = '".$getUser['username']."'"); // trừ ngọc đã rút
    $TUANORI->insert("history_rutngoc", [
        'username'  => $getUser['username'],
        'tk'        => $tk,
        'mk'        => $mk,
        'server'    => $server,
        'ngoc'      => $ngoc,
        'status'    => 0,
        'thoigian'  => gettime()
    ]);
    send_tele("Vừa có lệnh yêu cầu rút ngọc của thành viên ".$getUser['username']." vào lúc ".gettime());

    msg_success("Đã tạo lệnh rút thành công ".number_format($ngoc)." ngọc", "", 1000);
} else {
    msg_error2("Method không hợp lệ");
}