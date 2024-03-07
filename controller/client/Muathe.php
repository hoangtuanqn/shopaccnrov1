<?php
/*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once("../../core/config.php");
    require_once("../../core/function.php");
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
    $loaithe    = check_string($_POST['loaithe']);
    $menhgia    = check_string($_POST['menhgia']);
    $amount     = check_string($_POST['amount']);
    if(!$loaithe || !$menhgia || !$amount) {
        msg("danger", "Vui lòng chọn và nhập đủ thông tin để mua");
    }
    if(!$row = $TUANORI->get_row(" SELECT * FROM `category_banthe` WHERE `id` = '$loaithe' AND `status` = '1'")) {
        msg("danger", "Nhà mạng không hợp lệ");
    }
    $data = explode("\n", $row['menhgia']);
    if(!in_array($menhgia, $data ) ) {
        msg("danger", "Mệnh giá của bạn chọn không hợp lệ");
    }
    if($amount <= 0) {
        msg("danger", "Số lượng mua thẻ không hợp lệ");
    }
    $conlai = $TUANORI->num_rows(" SELECT * FROM `list_khothe` WHERE `loaithe` = '".$row['nhamang']."' AND `menhgia` = '$menhgia' AND `username` IS NULL ") ?? 0;
    if($conlai <= 0) {
        msg("danger", "Hiện tại loại thẻ ".$row['nhamang']." có mệnh giá ".format_cash($menhgia)."đ hiện đang hết trong kho");
    }
    if($conlai < $amount) {
        msg("danger", "Hiện tại loại thẻ ".$row['nhamang']." có mệnh giá ".format_cash($menhgia)."đ hiện đang có ".format_cash($conlai)." thẻ, vui lòng mua ít lại hoặc chờ đợt khác");
        
    }
    $tien = 0;
    $data2 = explode("\n", $row['ck']);

    for($i = 0; $i < count($data); ++$i) {
        if($data[$i] == $menhgia) {
            $tien = $menhgia - round($menhgia*$data2[$i]/100);
            break;
        }
    }
    $sotien = $amount*$tien;
    $TUANORI->tru("users", "money", $sotien, " `username` = '".$getUser['username']."'"); // trừ tiền thành viên
    $TUANORI->insert("biendongsodu", [
        'username'  => $getUser['username'],
        'truoc'     => $getUser['money'],
        'sau'       => $getUser['money'] - $sotien,
        'note'      => "Mua thẻ ".$row['nhamang'].", số lượng ".format_cash($amount)." thẻ với giá ".number_format($sotien)."đ",
        'tongtien'  => $sotien,
        'time'      => gettime()
    ]);
    /*CẬP NHẬT THẺ ĐÃ BÁN, THẺ NÀO ĐĂNG TRƯỚC THÌ ƯU TIÊN TRƯỚC*/
    $TUANORI->update("list_khothe", array(
        'username'  => $getUser['username'],
        'thucnhan'  => $tien,
        'thoigian'  => gettime(),
        'status'    => 1
    ), " `username` IS NULL ORDER BY `id` ASC LIMIT $amount  ");
    send_tele("Khách hàng ".$getUser['username'].", mua thẻ ".$row['nhamang'].", số lượng ".format_cash($amount)." thẻ với giá ".number_format($sotien)."đ");

    msg("success", "Bạn đã mua thẻ thành công, vui lòng chờ giây lát", '<meta http-equiv="Refresh" content="1;url=/profile/mua-the">');

} else {
    msg("danger","Method không hợp lệ");
}