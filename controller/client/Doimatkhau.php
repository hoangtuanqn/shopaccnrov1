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
    $mkcu       = check_string($_POST['mkcu']);
    $mknew      = check_string($_POST['mknew']);
    $mknew2      = check_string($_POST['mknew2']);
    if(!$mkcu || !$mknew || !$mknew2) {
        msg_error2("Vui lòng nhâp đầy đủ thông tin");
    }
    $mkcu = md5($mkcu);
    $row = $TUANORI->get_row(" SELECT * FROM `users` WHERE `tokenlog` = '".$_COOKIE['token']."' AND `password` = '$mkcu' ");
    if(!$row) {
        msg_error2("Mật khẩu cũ nhập không chính xác");
    }
    if(strlen($mknew) < 6) {
        msg_error2("Mật khẩu của bạn phải trên 6 kí tự");
    }
    if($mknew != $mknew2) {
        msg_error2("Nhập lại mật khẩu không khớp");
    }
    if($mkcu == md5($mknew)) {
        msg_error2("Mật khẩu mới không được trùng với mật khẩu cũ");
    } else {
        $TUANORI->update("users", array(
            'password'  => md5($mknew)
        ), " `tokenlog` = '".$_COOKIE['token']."' ");
        unset($_COOKIE['token']);
        setcookie('token', null, -1, '/');
        msg_success('Đã thay đổi mật khẩu thành công. Vui lòng đăng nhập lại', BASE_URL('login'), 1000);
    }
} else {
    msg_error2("Method không hợp lệ");
} 