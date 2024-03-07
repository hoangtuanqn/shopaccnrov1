<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    // require_once('../../class/class.smtp.php');
    // require_once('../../class/PHPMailerAutoload.php');
    // require_once('../../class/class.phpmailer.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_COOKIE['token'])) {
        msg_error('Bạn đã đăng nhập trước đó rồi', BASE_URL(''), 1000);
    }
    $email      = check_string($_POST['email']);
    $user       = check_string($_POST['taikhoan']);
    $pass       = check_string($_POST['matkhau']);
    $pass2      = check_string($_POST['matkhau2']);
    $name       = check_string($_POST['name']);
    if(!$email || !$user || !$pass || !$name) {
        msg_error2('Vui lòng không để trống thông tin');
    }
    if(strlen($user) < 6) {
        msg_error2("Tài khoản của bạn phải trên 6 kí tự");
    }
    if(strlen($pass) < 6) {
        msg_error2("Mật khẩu của bạn phải trên 6 kí tự");
    }
    if(check_email($email) != 'True') {
        msg_error2("Email của bạn không hợp lệ để đăng ký");
    }
    if(check_username($user) != 'True') {
        msg_error2("Tài khoản của bạn không được chứa kí tự lạ");
    }
    if($pass != $pass2) {
        msg_error2("Nhập lại mật khẩu không đúng");
    }
    if($TUANORI->get_row(" SELECT * FROM `users` WHERE `username` = '$user' ")) {
        msg_error2('Tên đăng nhập đã tồn tại!');
    }
    if($TUANORI->get_row(" SELECT * FROM `users` WHERE `email` = '$email' ")) {
        msg_error2('Email đã tồn tại!');
    }
    if($TUANORI->num_rows(" SELECT * FROM `users` WHERE `ip` = '".myip()."' ") >= 10) {
        msg_error2('Bạn đã đạt giới hạn tạo tài khoản');
    }
    $token = randomtoken();
    $token_api = randomtoken2();
    $timegio = time();

    $create = $TUANORI->insert("users", [
        'username'          => $user,
        'password'          => md5($pass),
        'email'             => $email,
        'fullname'          => $name,
        'money'             => 0,
        'total_money'       => 0,
        'level'             => 'member',
        'tokenlog'          => $token,
        'timereg'           => gettime(),
        'timeon'            => gettime(),
        'online'            => 'ONLINE',
        'ip'                => myip()
    ]);
    if($create) {
        setcookie('token', $token, time() + 2678400, '/');
        msg_success('Đăng ký thành công! Chờ chuyển hướng ..', BASE_URL(''), 1000);

    } else {
        msg_error2("Không thể lưu vào CDSL");
    }
} else {
    msg_error2("Method không hợp lệ");
}