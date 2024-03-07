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
    $email      = check_string($_POST['email']);
    $name       = check_string($_POST['name']);
    if(!$email || !$name) {
        msg_error2('Vui lòng không để trống thông tin');
    }

    if(check_email($email) != 'True') {
        msg_error2("Email của bạn không hợp lệ để đăng ký");
    }
    if($TUANORI->get_row(" SELECT * FROM `users` WHERE `email` = '$email' AND `id` != '$my_id' ")) {
        msg_error2('Email đã tồn tại!');
    }
    $update= $TUANORI->update("users", array(
        'fullname'      => $name,
        'email'         => $email
    ), " `id` = '".$getUser['id']."'");
    if($update) {
        msg_success('Đã cập nhật thông tin thành công.', BASE_URL('/profile/info'), 1000);
    } else {
        msg_error2("Không thể lưu vào CDSL");
    }
} else {
    msg_error2("Method không hợp lệ");
}