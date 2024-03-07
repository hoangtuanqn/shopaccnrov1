<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
    // require_once('../../class/class.smtp.php');
    // require_once('../../class/PHPMailerAutoload.php');
    // require_once('../../class/class.phpmailer.php');
function msg($color, $data, $meta = '') {
    die('<div class="alert alert-'.$color.' alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            '.$data.'
        </div>
        '.$meta);
}
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_COOKIE['token'])) {
        msg("danger",'Vui lòng đăng nhập để tiếp tục');
    }
    $id     = check_string($_POST['id']);
    $server = check_string($_POST['server']);
    $dichvu = check_string($_POST['dichvu']);
    $tk     = check_string($_POST['taikhoan']);
    $mk     = check_string($_POST['matkhau']);
    if(!$id || !$server || !$dichvu || !$tk || !$mk) {
        msg("danger", "Bạn còn thiếu thông tin");
    }
    if(!$row = $TUANORI->get_row(" SELECT * FROM `category_dichvu` WHERE `id` = '$id' AND `status` = '1'")) {
        msg("danger", "Dịch vụ bạn chọn không hợp lệ");
    }
    if(!in_array($server, json_decode($row['server'], true))) {
        msg("danger", "Server của bạn chọn không tồn tại");
    }
    if(!$dichvu2 = $TUANORI->get_row(" SELECT * FROM `banggia_dichvu` WHERE `id` = '$dichvu' AND `category_dichvu` = '$id' ")) {
        msg("danger", "Gói thuê bạn chọn không hợp lệ");
    }
    $js = json_decode($dichvu2['author'],true);
    if(!in_array($server,  $js['server'] )) {
        msg("danger", "Gói thuê không có hỗ trợ máy chủ ".$server);
    }
    $sotien = $js['gia'][$server];
    if($sotien <= 0) {
        msg("danger", "Gói này tạm bảo trì");
    }
    if($_POST['coupon']) {
        $mgg = check_string($_POST['coupon']);
        if(!$mg = $TUANORI->get_row(" SELECT * FROM `coupon` WHERE `code` = '$mgg' AND `conlai` >= 1")) {
            msg("danger", "Mã giảm giá này không tồn tại");
        }
        if($mg['apply'] !== 'dichvu') {
            msg("danger", "Mã giảm giá này không áp dụng cho danh mục này.");
        }
        if($mg['money_toithieu'] > $sotien) {
            msg("danger", "Mã giảm giá này áp dụng cho đơn hàng từ <b style='color: green'>".number_format($mg['money_toithieu'])."đ</b> trở lên");
        }
        if(!$mg['type'] &&  ($TUANORI->num_rows(" SELECT * FROM `history_dichvu` WHERE `dichvu` >=1 AND `coupon` = '$mgg' ") >=1)) {
            msg("danger", "Bạn đã sử dụng mã giảm giá này 1 lần rồi.");
        }
        $sotien -=$sotien * $mg['giam']/100;
        $notemgg = $mgg.' - Giảm giá '.$mg['giam'].'%';
    }
    if($sotien > $getUser['money']) {
        msg("danger", "Số tiền của bạn không đủ để thanh toán");
    }
    if(isset($mgg) && $msg) {
        $TUANORI->tru("coupon", "conlai", 1, " `code` = '$mgg' AND `conlai` >= 1  AND `apply` = 'dichvu'"); // giảm lượt dùng coupon
    }
    $TUANORI->tru("users", "money", $sotien, " `username` = '".$getUser['username']."'"); // trừ tiền thành viên
    $TUANORI->insert("biendongsodu", [
        'username'  => $getUser['username'],
        'truoc'     => $getUser['money'],
        'sau'       => $getUser['money'] - $sotien,
        'note'      => "Thuê dịch vụ ".$dichvu2['title']." với giá ".number_format($sotien)."đ",
        'tongtien'  => $sotien,
        'time'      => gettime()
    ]);
    $TUANORI->insert("history_dichvu", [
        'username'          => $getUser['username'],
        'category_dichvu'   => $id,
        'dichvu'            => $dichvu,
        'server'            => $server,
        'tongtien'          => $sotien,
        'tk'                => $tk,
        'mk'                => $mk,
        'status'            => 0,
        'thoigian'          => gettime(),
        'coupon'            => $mgg ?? ''
    ]);
    $TUANORI->cong("category_dichvu", "num_sell", 1, " `id` = '$id'"); // cộng 1 số tiền
    send_tele("Bạn vừa có đơn hàng cày thuê của thành viên ".$getUser['username']." vào lúc ".gettime());

    msg("success", "Bạn đã đặt hàng thành công, vui lòng chờ Admin xử lý", '<meta http-equiv="Refresh" content="1;url=/profile/dich-vu">');

} else {
    msg("danger","Method không hợp lệ");
}