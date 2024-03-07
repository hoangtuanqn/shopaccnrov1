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
    $tk     = check_string($_POST['taikhoan']);
    $mk     = check_string($_POST['matkhau']);
    $sotien = check_string(numb($_POST['sotien']));
    $server = check_string($_POST['server']);
    $note   = check_string($_POST['ghichu']);
    if(!$tk || !$mk || !$sotien || !$server || !$note) {
        msg_error2("Vui lòng nhập đầy đủ thông tin");
    }
    if($sotien <= 0) {
        msg_error2("Số tiền bán không hợp lệ");
    }
    if($server < 1 || $server > 10) {
        msg_error2("Server không hợp lệ");
    }
    if($TUANORI->num_rows("SELECT * FROM `nhapnick_game` WHERE `status` = '0' AND `username` = '".$getUser['username']."' ") >= 3) {
        msg_error2("Bạn đang có rất nhiều nick chờ xem xét, vui lòng đợi");
    }
    $create = $TUANORI->insert("nhapnick_game", [
        'username'  => $getUser['username'],
        'game'      => 'ngocrong',
        'tk'        => $tk,
        'mk'        => $mk,
        'sotien'    => $sotien,
        'server'    => $server,
        'note'      => $note,
        'thoigian'  => gettime(),
        'status'    => '0'
    ]);
    send_tele("Bạn vừa có khách hàng yêu cầu bán nick cho bạn vào lúc ".gettime());

    msg_success("Đã đăng bán nick thành công, vui  lòng chờ ADMIN xử lý", "", 1000);

} else {
    msg_error2("Method không hợp lệ");
}