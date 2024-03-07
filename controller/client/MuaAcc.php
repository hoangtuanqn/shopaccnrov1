<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    // require_once('../../class/class.smtp.php');
    // require_once('../../class/PHPMailerAutoload.php');
    // require_once('../../class/class.phpmailer.php');
function msg($color, $data, $url = '') {
    die('<b style="color: '.$color.'">'.$data.'</b>'.$url);
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_COOKIE['token'])) {
        msg('red', 'Vui lòng đăng nhập để tiếp tục');
    }
    $id = check_string($_GET['id']);
    if(!$id) msg("error", "ID tài khoản không hợp lệ");
    $row = $TUANORI->get_row(" SELECT * FROM `list_acc_game` WHERE `id` = '$id'");
    if(!$row) {
        msg("error", "Tài khoản này không tồn tại".$id);
    }
    $cate = $TUANORI->get_row(" SELECT * FROM `category_game` WHERE `id` = '".$row['category_game']."'");

    if($row['username']) {
        msg("error", "Tài khoản này đã được mua vào lúc ".intg(strtotime($row['timemua'])));
    }
    $sotien = $row['card'];
    if($sotien > $getUser['money']) {
        msg("error", "Tài khoản của bạn không đủ tiền để thanh toán. Vui lòng nạp thêm ".number_format($sotien - $getUser['money'])."đ");
    }
    $mgg = $notemgg = '';
    if($_POST['coupon']) {
        $mgg = check_string($_POST['coupon']);
        if(!$mg = $TUANORI->get_row(" SELECT * FROM `coupon` WHERE `code` = '$mgg' AND `conlai` >= 1")) {
            msg("error", "Mã giảm giá này không tồn tại");
        }
        if($mg['apply'] !== $row['type']) {
            msg("error", "Mã giảm giá này không áp dụng cho danh mục này.");
        }
        if($mg['money_toithieu'] > $sotien) {
            msg("error", "Mã giảm giá này áp dụng cho đơn hàng từ <b style='color: green'>".number_format($mg['money_toithieu'])."đ</b> trở lên");
        }
        if(!$mg['type'] &&  ($TUANORI->num_rows(" SELECT * FROM `list_acc_game` WHERE `dichvu` > 0 AND `coupon` = '$mgg' ") >=1)) {
            msg("danger", "Bạn đã sử dụng mã giảm giá này 1 lần rồi.");
        }
        $sotien -=$sotien * $mg['giam']/100;
        $notemgg = $mgg;
    }
    $TUANORI->tru("users", "money", $sotien, " `username` = '".$getUser['username']."'"); // trừ tiền thành viên
    $TUANORI->cong("category_game", "num_sell", 1, " `id` = '".$row['category_game']."'"); // cộng 1 đơn hàng

    $TUANORI->update("list_acc_game", array(
        'username'      => $getUser['username'],
        'timemua'       => gettime(),
        'mgg'           => $notemgg,
        'thanhtoan'     => $sotien
    ), " `id` = '$id'");
    $TUANORI->insert("biendongsodu", [
        'username'  => $getUser['username'],
        'truoc'     => $getUser['money'],
        'sau'       => $getUser['money'] - $sotien,
        'note'      => "Mua tài khoản ".$cate['title']." #$id với số tiền ".number_format($sotien)."đ",
        'tongtien'  => $sotien,
        'time'      => gettime()
    ]);
    $users = getUser($row['ctv']);
    if($users['level'] == 'ctv') {
        $tien = $row['card'] - $row['card']*$TUANORI->site('ctv_banacc')/100;
        $TUANORI->insert("biendongsodu", [
            'username'  => $users['username'],
            'truoc'     => $users['money'],
            'sau'       => $users['money'] + $tien,
            'note'      => "Tiền bán tài khoản mã #$id với số tiền thực nhận ".number_format($tien)."đ",
            'tongtien'  => $tien,
            'time'      => gettime()
        ]);
    }
    if(isset($mgg) && $mgg) {
        $isMoney = $TUANORI->tru("coupon", "conlai", 1, " `code` = '$mgg' AND `conlai` >=1");
    }
    send_tele("Bạn vừa có khách hàng mua tài khoản mã #$id có giá tiền ".number_format($sotien)." vào lúc ".gettime());

    if($row['type'] == 'account') {
        $url = '<meta http-equiv="Refresh" content="1;url=/profile/tai-khoan-da-mua">';
    } else {
        $url = '<meta http-equiv="Refresh" content="1;url=/profile/random-da-mua">';
    }
    msg("green", "Đã mua tài khoản #$id thành công với giá ".number_format($sotien)."đ", $url);
} else {
    msg("red","Method không hợp lệ");
}