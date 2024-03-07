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
    if($getUser['bonus']) {
        msg_error2("Bạn đã nhận quà rồi");
    }
    if(!$getUser['total_money']) {
        msg_error2("Bạn vui lòng 'nạp lần đầu' để nhận quà");
    }
    $sotien = rand(1000, 10000); // 1k đến 10k
    $TUANORI->update("users", array(
        'bonus'      => 1
    ), " `id` = '$my_id'");
    $TUANORI->insert("biendongsodu", [
        'username'  => $getUser['username'],
        'truoc'     => $getUser['money'],
        'sau'       => $getUser['money'] + $sotien,
        'note'      => "Nhận ".number_format($sotien)."đ từ quà nạp lần đầu",
        'tongtien'  => $sotien,
        'time'      => gettime()
    ]);
    $TUANORI->cong("users", "money", $sotien, " `username` = '".$getUser['username']."'");
    msg_success("Chúc mừng bạn đã nhận được ".number_format($sotien)."đ thành công", "", 2000);
} else {
    msg_error2("Method không hợp lệ");
} 