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
    $tk = check_string($_POST['taikhoan']);
    $mk = check_string(md5($_POST['matkhau']));
    if(isset($_SESSION['lanspam'])) {
        if($_SESSION['lanspam'] >= 5) {
            $giay = $_SESSION['timeblock'] - time();
            if($giay < 1) {
                $_SESSION['lanspam'] = 0;
                msg_error2("Vui lòng bấm đăng nhập lại 1 lần nữa");
            } else {
                msg_error2("Vui lòng thử lại sau ".$giay."s");
            }
        }
        
    }
    if(!$tk || !$mk) {
        msg_error2("Vui lòng không để trống thông tin");
    }
    if(strlen($tk) < 6) {
        msg_error2("Tài khoản của bạn phải trên 6 kí tự");
    }
    if(strlen($mk) < 6) {
        msg_error2("Mật khẩu của bạn phải trên 6 kí tự");
    }
    $CheckUser = $TUANORI->get_row(" SELECT * FROM `users` WHERE `username` = '$tk' ");
    if(!$CheckUser) {
        msg_error2('Tên đăng nhập không tồn tại');
    }
    if($CheckUser['banned'] == 'OFF') {
        msg_error2('Bạn bị đình chỉ vô thời hạn. Hãy liên hệ với BQT');
    }
    if(!$TUANORI->get_row(" SELECT * FROM `users` WHERE `username` = '$tk' AND `password` = '$mk' ")) {
        $_SESSION['timeblock'] = time() + 30;
        if(empty($_SESSION['lanspam'])) {
            $_SESSION['lanspam'] = 1;
        } else {
            $_SESSION['lanspam'] = $_SESSION['lanspam'] + 1;
        }
        msg_error2('Mật khẩu đăng nhập không chính xác');
    }
    $check_login = $TUANORI->get_row(" SELECT * FROM `users` WHERE `username` = '$tk' AND `password` = '$mk' ");
    if($check_login) {
       
        // $token = randomtoken();
        $token = $check_login['tokenlog'];
        $token_api = randomtoken2();
        setcookie('token', $token, time() + 2678400, '/');
        $TUANORI->update("users", array(
            // 'tokenlog'      => $token,
            'timeon'        => gettime(),
            'ip'            => myip()
        ), " `username` = '$tk'");
        msg_success('Đăng nhập vào tài khoản thành công', BASE_URL(''), 1000);
    }
} else {
    msg_error2("Method không hợp lệ");
}