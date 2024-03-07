<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    // CheckAdmin();
    // require_once('../../class/class.smtp.php');
    // require_once('../../class/PHPMailerAutoload.php');
    // require_once('../../class/class.phpmailer.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_COOKIE['token'])) {
        msg_error('Vui lòng đăng nhập để tiếp tục', BASE_URL('login'), 1000);
    }
    if($getUser['level'] != 'admin') {
        msg_error2("Bạn chưa phải là ADMIN");
    }
    $mk    = check_string($_POST['matkhau']);
    if(!$mk) {
        msg_error2("Bạn chưa nhập mật khẩu");
    }
    if($getUser['saimkad'] <= 0) {
        msg_error2("Bạn không thể Login Vào Quản Trị Vĩnh Viễn. Liên hệ Developers Zalo: 0812665001");
    }

    if(md5($mk) != $getUser['passwordc2']) {
        $TUANORI->tru("users", "saimkad", 1, " `username` = '".$getUser['username']."' AND `level` = 'admin'");
        msg_error2("Sai mật khẩu cấp 2, bạn còn ".--$getUser['saimkad']." lần thử");
    }
    $_SESSION['admin'] = true; // tạo session tạm thời
    $u = 6 - $getUser['saimkad'];
    /*RESET SỐ LẦN LOGIN ADMIN VỀ BAN ĐẦU*/
    $TUANORI->cong("users", "saimkad", $u, " `username` = '".$getUser['username']."' AND `level` = 'admin'");
    msg_success("Login Vào ADMIN thành công", BASE_URL("admin"), 1000);
} else {
    msg_error2("Method không hợp lệ");
}