<?php
    /*MÃ NGUỒN NÀY ĐƯỢC PHÁT TRIỂN BỞI TUANORI - ZALO: 0812665001*/
    define("IN_SITE", true);
    require_once(__DIR__."/core/config.php");
    require_once(__DIR__."/core/function.php");
    if($_GET) {
        $pin            = check_string($_GET['code']);
        $seri           = check_string($_GET['serial']);
        $randid         = check_string($_GET['request_id']);
        $status         = check_string($_GET['status']);
        if($pin && $seri && $randid && $status) {
            $data           = $TUANORI->get_row(" SELECT * FROM `napcard` WHERE `requestid` = '$randid' AND `pin` = '$pin' AND `seri` = '$seri' AND `status` = '0'");
            if(!$data) die;
            $sotien = $data['thucnhan'];
            $user   = $data['username'];
            $data_us = $TUANORI->getUser($user);
            if($status == 1) {
                $TUANORI->update("napcard", array(
                    'status'  => 1
                ), " `id` = '".$data['id']."' ");
                $isMoney = $TUANORI->cong("users", "money", $sotien, " `username` = '$user'");
                $isMoney = $TUANORI->cong("users", "total_money", $sotien, " `username` = '$user'");
                if($isMoney) {
                    $TUANORI->insert("biendongsodu", [
                        'username'  => $user,
                        'truoc'     => $data_us['money'],
                        'sau'       => $data_us['money'] + $sotien,
                        'note'      => "Seri $seri có mệnh giá ".format_cash($data['menhgia'])."đ được duyệt. Thực nhận ".format_cash($sotien)." đ",
                        'tongtien'  => $sotien,
                        'time'      => gettime()
                    ]);
                    send_tele("Khánh hàng ".$getUser['username']." nạp card giá ".number_format($data['menhgia'])." thành công vào lúc ".gettime());
                    /*HÀM HIỆN THÔNG BÁO*/
                    // pusher($user, "success", "Mã thẻ $pin của bạn đã được duyệt thành công. Bạn nhận được ".format_cash($sotien)."đ vào tài khoản");
                }
            } else {
                $TUANORI->update("napcard", array(
                    'status'  => 2,
                    'thucnhan'  => 0
                ), " `id` = '".$data['id']."' ");
                /*HÀM HIỆN THÔNG BÁO*/
                // pusher($user, "error", "Thẻ ".$data['loaithe']." có mệnh giá ".format_cash($data['menhgia'])." của bạn đã nạp thất bại");
            }
        }
    } else {
        die('Request không hợp lệ.');
    }